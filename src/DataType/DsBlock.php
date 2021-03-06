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
 * Zilliqa data type DsBlock.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class DsBlock extends ZilliqaDataType {

	/**
	 * @var DsBlockHeader
	 */
	public $header;

	/**
	 * @var ZilliqaSignature
	 */
	public $signature;

	/**
	 * @param $header
	 * @param ZilliqaSignature $signature
	 */
	public function __construct($header, ZilliqaSignature $signature) {
		$this->header = $header;
		$this->signature = $signature;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'header' => 'DsBlockHeader',
			'signature' => 'ZilliqaSignature',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'header' => !is_null($this->header) ? $this->header->toArray() : null,
			'signature' => !is_null($this->signature) ? $this->signature->val() : null,
		];
	}
}