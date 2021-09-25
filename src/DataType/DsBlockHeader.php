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
 * Zilliqa data type DsBlockHeader.
 * 
 * Generated by scripts/generate-complex-datatypes.php based on resources/zilliqa-schema.json.
 */
class DsBlockHeader extends ZilliqaDataType {

	/**
	 * @var ZilliqaNumber
	 */
	public $BlockNum;

	/**
	 * @var ZilliqaQuantity
	 */
	public $Difficulty;

	/**
	 * @var ZilliqaQuantity
	 */
	public $DifficultyDS;

	/**
	 * @var ZilliqaQuantity
	 */
	public $GasPrice;

	/**
	 * @var ZilliqaHash
	 */
	public $LeaderPubKey;

	/**
	 * @var ZilliqaHash[]
	 */
	public $PoWWinners;

	/**
	 * @var ZilliqaHash
	 */
	public $PrevHash;

	/**
	 * @var ZilliqaTimestamp
	 */
	public $Timestamp;

	/**
	 * @param ZilliqaNumber $BlockNum
	 * @param ZilliqaQuantity $Difficulty
	 * @param ZilliqaQuantity $DifficultyDS
	 * @param ZilliqaQuantity $GasPrice
	 * @param ZilliqaHash $LeaderPubKey
	 * @param array $PoWWinners Array of ZilliqaHash
	 * @param ZilliqaHash $PrevHash
	 * @param ZilliqaTimestamp $Timestamp
	 */
	public function __construct(ZilliqaNumber $BlockNum, ZilliqaQuantity $Difficulty, ZilliqaQuantity $DifficultyDS, ZilliqaQuantity $GasPrice, ZilliqaHash $LeaderPubKey, array $PoWWinners, ZilliqaHash $PrevHash, ZilliqaTimestamp $Timestamp) {
		$this->BlockNum = $BlockNum;  
		$this->Difficulty = $Difficulty;  
		$this->DifficultyDS = $DifficultyDS;  
		$this->GasPrice = $GasPrice;  
		$this->LeaderPubKey = $LeaderPubKey;  
		$this->PoWWinners = $PoWWinners;  
		$this->PrevHash = $PrevHash;  
		$this->Timestamp = $Timestamp;
	}

	/**
	 * @return array
	 */
	public static function getTypeArray(): array {
		return [
			'BlockNum' => 'ZilliqaNumber',
			'Difficulty' => 'ZilliqaQuantity',
			'DifficultyDS' => 'ZilliqaQuantity',
			'GasPrice' => 'ZilliqaQuantity',
			'LeaderPubKey' => 'ZilliqaHash',
			'PoWWinners' => '[ZilliqaHash]',
			'PrevHash' => 'ZilliqaHash',
			'Timestamp' => 'ZilliqaTimestamp',
		];
	}

	/**
	 * Returns array with values.
	 *
	 * @return array
	 */
	public function toArray(): array {
		return [
			'BlockNum' => $this->BlockNum->val(),
			'Difficulty' => $this->Difficulty->val(),
			'DifficultyDS' => $this->DifficultyDS->val(),
			'GasPrice' => $this->GasPrice->val(),
			'LeaderPubKey' => $this->LeaderPubKey->val(),
			'PoWWinners' => \Zilliqa\Zilliqa::valueArray($this->PoWWinners, 'ZilliqaHash'),
			'PrevHash' => $this->PrevHash->val(),
			'Timestamp' => $this->Timestamp->val(),
		];
	}
}