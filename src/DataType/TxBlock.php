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
 * Zilliqa data type TxBlock.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class TxBlock extends ZilliqaDataType {

	/**
	 * @var TxBlockBody
	 */
	public $body;

	/**
	 * @var TxBlockHeader
	 */
	public $header;

	/**
	 * @param $body
	 * @param $header
	 */
	public function __construct($body, $header) {
		$this->body = $body;  
		$this->header = $header;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'body' => 'TxBlockBody',
			'header' => 'TxBlockHeader',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'body' => $this->body->toArray(),
			'header' => $this->header->toArray(),
		];
	}
}