<?php
/**
 * @file
 * This is a file generated by scripts/generate-complex-datatypes.php.
 *
 * DO NOT EDIT THIS FILE.
 *
 * @ingroup generated
 * @ingroup dataTypesComplex
 */
namespace Zilliqa\DataType;

/**
 * Zilliqa data type Shard.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class Shard extends ZilliqaDataType {

	/**
	 * @var ZilliqaHash[]
	 */
	public $nodes;

	/**
	 * @var ZilliqaNumber
	 */
	public $size;

	/**
	 * @param array $nodes Array of ZilliqaHash
	 * @param ZilliqaNumber $size
	 */
	public function __construct(array $nodes, ZilliqaNumber $size) {
		$this->nodes = $nodes;  
		$this->size = $size;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'nodes' => '[ZilliqaHash]',
			'size' => 'ZilliqaNumber',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'nodes' => \Zilliqa\Zilliqa::valueArray($this->nodes, 'ZilliqaHash'),
			'size' => $this->size->val(),
		];
	}
}