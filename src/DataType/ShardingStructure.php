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
 * Zilliqa data type ShardingStructure.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class ShardingStructure extends ZilliqaDataType {

	/**
	 * @var ZilliqaNumber[]
	 */
	public $NumPeers;

	/**
	 * @param array $NumPeers Array of ZilliqaNumber
	 */
	public function __construct(array $NumPeers) {
		$this->NumPeers = $NumPeers;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'NumPeers' => '[ZilliqaNumber]',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'NumPeers' => !is_null($this->NumPeers) ? \Zilliqa\Zilliqa::valueArray($this->NumPeers, 'ZilliqaNumber') : null,
		];
	}
}