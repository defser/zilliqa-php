<?php

namespace Zilliqa;

use Closure;
use Graze\GuzzleHttp\JsonRpc\Client as RpcClient;

use InvalidArgumentException;
use Zilliqa\DataType\ZilliqaDataType;
use Exception;
use Zilliqa\DataType\ZilliqaData;

/**
 * @defgroup client Zilliqa Web3 Client
 *
 * %Zilliqa Web3 (JsonRPC) client.
 */

/**
 * %Zilliqa Web3 API for PHP.
 *
 * @page ZilliqaClient Web3 Client
 *
 * Zilliqa::Zilliqa is the starting point to communicate with any %Zilliqa JSON-RPC API (like [mainnet](https://api.zilliqa.com/), [developer testnet](https://dev-api.zilliqa.com/), [local testnet](http://localhost:4201/), [Isolated server](https://zilliqa-isolated-server.zilliqa.com/)).
 *
 * Implements %Zilliqa Web3 JsonRPC API for PHP. Read more about it at the [Zilliqa-docs](https://dev.zilliqa.com/docs/apis/api-introduction).
 *
 * To get started you might check the hierarchical [class list](hierarchy.html) to get an easy overview about the available Data structures.
 *
 * Web3Interface
 *
 */

/**
 * Zilliqa Web3 API for PHP.
 *
 * @ingroup client
 */
class Zilliqa extends ZilliqaStatic implements Web3Interface
{
    use Web3Methods;

    private $definition;
    private $methods;
    private $id = 0;
    public $client;
    public $debugHtml = '';

    public function __construct(string $url = 'http://localhost:4201')
    {
        $this->client = RpcClient::factory($url, [
            'debug' => false,
            'rpc_error' => true,
        ]);

        $this->definition = self::getDefinition();

        foreach ($this->definition['methods'] as $name => $params) {
            ${$name} = function () {
                $request_params = [];

                $method = debug_backtrace()[2]['args'][0];
                $this->debug('Called function name', $method);

                $param_definition = $this->definition['methods'][$method];

                $valid_arguments = $param_definition[0];
                $argument_class_names = [];
                if (count($valid_arguments)) {
                    $this->debug('Valid arguments', $valid_arguments);
                    foreach ($valid_arguments as $type) {
                        $argument_class_names[] = ZilliqaData::typeMap($type);
                    }
                    $this->debug('Valid arguments class names', $argument_class_names);
                }

                $args = func_get_args();
                if (count($args) && isset($argument_class_names)) {
                    $this->debug('Arguments', $args);
                    foreach ($args as $i => $arg) {
                        if (is_subclass_of($arg, ZilliqaDataType::class)) {
                            $argType = basename(str_replace('\\', '/', get_class($arg)));
                            if ($argument_class_names[$i] !== $argType) {
                                throw new InvalidArgumentException("Argument $i is "
                                    . $argType
                                    . " but expected $argument_class_names[$i] in $method().");
                            } else {
                                $request_params[] = $arg->val();
                            }
                        } else {
                            throw new InvalidArgumentException('Arg ' . $i . ' is not a ZilliqaDataType.');
                        }
                    }
                }

                if (isset($param_definition[2])) {
                    $required_params = array_slice($param_definition[0], 0, $param_definition[2]);
                    $this->debug('Required Params', $required_params);
                }

                if (isset($required_params) && count($required_params)) {
                    foreach ($required_params as $i => $param) {
                        if (!isset($request_params[$i])) {
                            throw new InvalidArgumentException("Required argument $i $argument_class_names[$i] is missing in $method().");
                        }
                    }
                }

                $return_type = $param_definition[1];
                $this->debug('Return value type', $return_type);

                $is_primitive = (is_array($return_type)) ? (bool)ZilliqaData::typeMap($return_type[0]) : (bool)ZilliqaData::typeMap($return_type);

                if (is_array($return_type)) {
                    $return_type_class = '[' . ZilliqaData::typeMap($return_type[0]) . ']';
                } elseif ($is_primitive) {
                    $return_type_class = ZilliqaData::typeMap($return_type);
                } else {
                    $return_type_class = $return_type;
                }
                $this->debug('Return value Class name ', $return_type_class);

                $this->debug('Final request params', $request_params);
                $value = $this->zilliqaRequest($method, $request_params);

                $return = $this->createReturnValue($value, $return_type_class, $method);
                $this->debug('Final return object', $return);
                $this->debug('<hr />');

                return $return;
            };
            $this->methods[$name] = Closure::bind(${$name}, $this, get_class());
        }
    }

    public function __call(string $method, array $args)
    {
        if (isset($this->methods[$method]) && is_callable($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $args);
        } else {
            throw new InvalidArgumentException('Unknown Method: ' . $method);
        }
    }

    /**
     * @throws Exception
     */
    private function createReturnValue($value, string $return_type_class, string $method)
    {
        $return = null;

        if (is_null($value)) {
            return null;
        }

        $class_name = '\\' . __NAMESPACE__ . '\\DataType\\' . ZilliqaDataType::getTypeClass($return_type_class);
        $array_val = $this->isArrayType($return_type_class);
        $is_primitive = $class_name::isPrimitive();

        if ($is_primitive && $array_val && is_array($value)) {
            $return = $this->valueArray($value, $class_name);
        } elseif ($is_primitive && !$array_val && !is_array($value)) {
            $return = new $class_name($value);
        }

        if (!$is_primitive && !$array_val && is_array($value)) {
            $return = $this->arrayToComplexType($class_name, $value);
        }

        if (!$return && !is_array($return)) {
            throw new Exception(
                sprintf('Expected %s at %s(), couldn not be decoded. Value was:%s', $return_type_class, $method, print_r($value, true))
            );
        }

        return $return;
    }

    protected static function isArrayType(string $type): bool
    {
        return (strpos($type, '[') !== false);
    }

    public function request(string $method, array $params = [])
    {
        $this->id++;
        return $this->client->send($this->client->request($this->id, $method, $params))->getRpcResult();
    }

    /**
     * @throws Exception
     */
    public function zilliqaRequest(string $method, array $params = [])
    {
        try {
            return $this->request($method, $params);
        } catch (Exception $e) {
            if ($e->getCode() === 405) {
                return [
                    'error' => true,
                    'code' => 405,
                    'message' => $e->getMessage(),
                ];
            } else {
                throw $e;
            }
        }
    }

    public function debug(string $title, $content = null): string
    {
        $return = '<p style="margin-left: 1em"><b>' . $title . "</b></p>";
        if ($content) {
            $return .= '<pre style="background: rgba(0,0,0, .1); margin: .5em; padding: .25em; ">';
            if (is_object($content) || is_array($content)) {
                ob_start();
                var_dump($content);
                $return .= ob_get_clean();
            } else {
                $return .= ($content);
            }
            $return .= "</pre>";
        }
        $this->debugHtml .= $return;

        return $return;
    }

    /**
     * @throws Exception
     */
    protected static function arrayToComplexType(string $class_name, array $values): ZilliqaDataType
    {
        $class_values = [];

        /** @var $class_name ZilliqaDataType or a derived class. */
        $type_map = $class_name::getTypeArray();

        foreach ($type_map as $name => $val_class) {
            $value_class = '\\' . __NAMESPACE__ . '\\DataType\\' . ZilliqaDataType::getTypeClass($val_class);
            if (isset($values[$name])) {
                if (is_array($values[$name])) {
                    if (ZilliqaDataType::getTypeClass($val_class, true) !== 'array') {
                        $class_values[] = self::arrayToComplexType($value_class, $values[$name]);
                    } else {
                        $sub_values = [];
                        foreach ($values[$name] as $sub_val) {
                            if (is_array($sub_val)) {
                                $sub_values[] = self::arrayToComplexType($value_class, $sub_val);
                            } else {
                                $sub_values[] = new $value_class($sub_val);
                            }
                        }
                        $class_values[] = $sub_values;
                    }
                } else {
                    $class_values[] = new $value_class($values[$name]);
                }
            } else {
                $sub_values = [];
                foreach ($values as $sub_val) {
                    if (is_array($sub_val)) {
                        $sub_values[] = self::arrayToComplexType($value_class, $sub_val);
                    } else {
                        $sub_values[] = new $value_class($sub_val);
                    }
                }
                $class_values[] = $sub_values;
            }
        }
        $return = new $class_name(...$class_values);

        if (!$return && !is_array($return)) {
            throw new Exception(sprintf('Complex type %s could not be created with values: %s', $class_name, $values));
        }

        return $return;
    }

    /**
     * @throws Exception
     */
    public static function valueArray(array $values, string $typeClass): array
    {
        $return = [];
        if (!class_exists($typeClass)) {
            $typeClass = '\\' . __NAMESPACE__ . '\\DataType\\' . $typeClass;
        }
        foreach ($values as $i => $val) {
            if (is_object($val)) {
                $return[$i] = $val->toArray();
            }
            if (is_array($val)) {
                $return[$i] = self::arrayToComplexType($typeClass, $val);
            }
            $return[$i] = new $typeClass($val);
        }
        return $return;
    }
}
