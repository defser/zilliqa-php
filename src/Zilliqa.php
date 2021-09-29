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
                $requestParams = [];

                $method = debug_backtrace()[2]['args'][0];
                $this->debug('Called function name', $method);

                $paramDefinition = $this->definition['methods'][$method];

                $validArguments = $paramDefinition[0];
                $argumentClassNames = [];
                if (count($validArguments)) {
                    $this->debug('Valid arguments', $validArguments);
                    foreach ($validArguments as $type) {
                        $argumentClassNames[] = ZilliqaData::typeMap($type);
                    }
                    $this->debug('Valid arguments class names', $argumentClassNames);
                }

                $args = func_get_args();
                if (count($args) && isset($argumentClassNames)) {
                    $this->debug('Arguments', $args);
                    foreach ($args as $i => $arg) {
                        if (is_subclass_of($arg, ZilliqaDataType::class)) {
                            $argType = basename(str_replace('\\', '/', get_class($arg)));
                            if ($argumentClassNames[$i] !== $argType) {
                                throw new InvalidArgumentException("Argument $i is "
                                    . $argType
                                    . " but expected $argumentClassNames[$i] in $method().");
                            } else {
                                $requestParams[] = $arg->val();
                            }
                        } else {
                            throw new InvalidArgumentException('Arg ' . $i . ' is not a ZilliqaDataType.');
                        }
                    }
                }

                if (isset($paramDefinition[2])) {
                    $requiredParams = array_slice($paramDefinition[0], 0, $paramDefinition[2]);
                    $this->debug('Required Params', $requiredParams);
                }

                if (isset($requiredParams) && count($requiredParams)) {
                    foreach ($requiredParams as $i => $param) {
                        if (!isset($requestParams[$i])) {
                            throw new InvalidArgumentException("Required argument $i $argumentClassNames[$i] is missing in $method().");
                        }
                    }
                }

                $returnType = $paramDefinition[1];
                $this->debug('Return value type', $returnType);

                $isPrimitive = (is_array($returnType)) ? (bool)ZilliqaData::typeMap($returnType[0]) : (bool)ZilliqaData::typeMap($returnType);

                if (is_array($returnType)) {
                    $returnTypeClass = '[' . ZilliqaData::typeMap($returnType[0]) . ']';
                } elseif ($isPrimitive) {
                    $returnTypeClass = ZilliqaData::typeMap($returnType);
                } else {
                    $returnTypeClass = $returnType;
                }
                $this->debug('Return value Class name ', $returnTypeClass);

                $this->debug('Final request params', $requestParams);
                $value = $this->zilliqaRequest($method, $requestParams);

                $return = $this->createReturnValue($value, $returnTypeClass, $method);
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
    private function createReturnValue($value, string $returnTypeClass, string $method)
    {
        $return = null;

        if (is_null($value)) {
            return null;
        }

        $className = '\\' . __NAMESPACE__ . '\\DataType\\' . ZilliqaDataType::getTypeClass($returnTypeClass);
        $arrayVal = $this->isArrayType($returnTypeClass);
        $isPrimitive = $className::isPrimitive();

        if ($isPrimitive && $arrayVal && is_array($value)) {
            $return = $this->valueArray($value, $className);
        } elseif ($isPrimitive && !$arrayVal && !is_array($value)) {
            $return = new $className($value);
        }

        if (!$isPrimitive && !$arrayVal && is_array($value)) {
            $return = $this->arrayToComplexType($className, $value);
        }

        if (!$return && !is_array($return)) {
            throw new Exception(
                sprintf('Expected %s at %s(), couldn not be decoded. Value was:%s', $returnTypeClass, $method, print_r($value, true))
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
    protected static function arrayToComplexType(string $className, array $values, bool $initial = true): ZilliqaDataType
    {
        $classValues = [];

        /** @var $className ZilliqaDataType or a derived class. */
        $typeMap = $className::getTypeArray();

        foreach ($typeMap as $name => $valClass) {
            $valueClass = '\\' . __NAMESPACE__ . '\\DataType\\' . ZilliqaDataType::getTypeClass($valClass);
            if (isset($values[$name])) {
                if (is_array($values[$name])) {
                    if (ZilliqaDataType::getTypeClass($valClass, true) !== 'array') {
                        $classValues[] = self::arrayToComplexType($valueClass, $values[$name]);
                    } else {
                        $subValues = [];
                        foreach ($values[$name] as $subVal) {
                            if (is_array($subVal)) {
                                $subValues[] = self::arrayToComplexType($valueClass, $subVal, false);
                            } else {
                                $subValues[] = new $valueClass($subVal);
                            }
                        }
                        $classValues[] = $subValues;
                    }
                } else {
                    $classValues[] = new $valueClass($values[$name]);
                }
            } else {
                if ($initial) {
                    $classValues[] = null;
                    continue;
                }
                $subValues = [];
                foreach ($values as $subVal) {
                    if (is_array($subVal)) {
                        $subValues[] = self::arrayToComplexType($valueClass, $subVal, false);
                    } else {
                        $subValues[] = new $valueClass($subVal);
                    }
                }
                $classValues[] = $subValues;
            }
        }

        $return = new $className(...$classValues);

        if (!$return && !is_array($return)) {
            throw new Exception(sprintf('Complex type %s could not be created with values: %s', $className, $values));
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
                continue;
            }
            if (is_array($val)) {
                $return[$i] = self::arrayToComplexType($typeClass, $val);
                continue;
            }
            $return[$i] = new $typeClass($val);
        }
        return $return;
    }
}
