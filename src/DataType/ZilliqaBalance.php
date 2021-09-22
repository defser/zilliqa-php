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
 * Zilliqa data type ZilliqaBalance.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class ZilliqaBalance extends ZilliqaDataType {

	/**
	 * @var ZilliqaQuantity
	 */
	public $balance;

	/**
	 * @var ZilliqaQuantity
	 */
	public $nonce;

	/**
	 * @param ZilliqaQuantity $balance
	 * @param ZilliqaQuantity $nonce
	 */
	public function __construct(ZilliqaQuantity $balance, ZilliqaQuantity $nonce) {
		$this->balance = $balance;  
		$this->nonce = $nonce;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'balance' => 'ZilliqaQuantity',
			'nonce' => 'ZilliqaQuantity',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		$return = [];
		!is_null($this->balance) ?? $return['balance'] = $this->balance->val();
		!is_null($this->nonce) ?? $return['nonce'] = $this->nonce->val();
		return $return;
	}
}