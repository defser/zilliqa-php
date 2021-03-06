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
 * Zilliqa data type Transition.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class Transition extends ZilliqaDataType {

	/**
	 * @var ZilliqaHash
	 */
	public $addr;

	/**
	 * @var ZilliqaNumber
	 */
	public $depth;

	/**
	 * @var Message
	 */
	public $msg;

	/**
	 * @param ZilliqaHash $addr
	 * @param ZilliqaNumber $depth
	 * @param $msg
	 */
	public function __construct(ZilliqaHash $addr, ZilliqaNumber $depth, $msg) {
		$this->addr = $addr;
		$this->depth = $depth;
		$this->msg = $msg;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'addr' => 'ZilliqaHash',
			'depth' => 'ZilliqaNumber',
			'msg' => 'Message',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'addr' => !is_null($this->addr) ? $this->addr->val() : null,
			'depth' => !is_null($this->depth) ? $this->depth->val() : null,
			'msg' => !is_null($this->msg) ? $this->msg->toArray() : null,
		];
	}
}