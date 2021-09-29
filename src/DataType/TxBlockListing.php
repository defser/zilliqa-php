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
 * Zilliqa data type TxBlockListing.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class TxBlockListing extends ZilliqaDataType {

	/**
	 * @var ZilliqaNumber
	 */
	public $BlockNum;

	/**
	 * @var ZilliqaHash
	 */
	public $Hash;

	/**
	 * @param ZilliqaNumber $BlockNum
	 * @param ZilliqaHash $Hash
	 */
	public function __construct(ZilliqaNumber $BlockNum, ZilliqaHash $Hash) {
		$this->BlockNum = $BlockNum;
		$this->Hash = $Hash;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'BlockNum' => 'ZilliqaNumber',
			'Hash' => 'ZilliqaHash',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'BlockNum' => !is_null($this->BlockNum) ?? $this->BlockNum->val(),
			'Hash' => !is_null($this->Hash) ?? $this->Hash->val(),
		];
	}
}