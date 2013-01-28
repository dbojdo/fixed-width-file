<?php
namespace Webit\Parser\FixedWidth\Parser;

use Webit\Tools\Object\ObjectCreator;
use Webit\Tools\Object\ObjectUpdater;

class Parser {
	const RESULT_ARRAY = 'array';

	/**
	 * 
	 * @param string $line
	 * @param RowDef $row
	 */
	public function parseRow($line, RowDef $row, $resultType = null) {
		$arRow = array();
		foreach ($row->getPositions() as $property => $position) {
			$arRow[$property] = $this->parsePosition($line, $position);
		}

		$resultType = $resultType ? $resultType : $row->getResultType();
		$resultType = $resultType ?: self::RESULT_ARRAY;
		
		$result = $this->prepareResult($arRow, $resultType);

		return $result;
	}

	/**
	 * 
	 * @param string $line
	 * @param PositionDef $position
	 * @return mixed
	 */
	public function parsePosition($line, PositionDef $position) {
		$start = ($position->getStart() - 1);
		$length = ($position->getEnd() - $position->getStart() + 1);

		$rawValue = substr($line, $start, $length);
		$value = $this->getValue($rawValue, $position);

		return $value;
	}

	/**
	 * 
	 * @param string $rawValue
	 * @param PositionDef $position
	 * @return mixed
	 */
	private function getValue($rawValue, PositionDef $position) {
		$value = trim($rawValue);
		if (empty($value)) {
			return null;
		}

		switch ($position->getType()) {
		case Position::TYPE_BOOL:
			return (bool) $rawValue;
			break;
		case Position::TYPE_INT:
			return (int) $rawValue;
			break;
		case Position::TYPE_FLOAT:
			return (float) $rawValue;
			break;
		case Position::TYPE_DATE:
			return \DateTime::createFromFormat($position->getDateFormat(), $rawValue);
			break;
		default:
			return $rawValue;
		}
	}

	/**
	 * 
	 * @param array $arRow
	 * @param string $resultType
	 * @throws \InvalidArgumentException
	 * @return mixed ($resultType)
	 */
	private function prepareResult($arRow, $resultType) {
		if ($resultType == self::RESULT_ARRAY) {
			return $arRow;
		}
		
		$result = ObjectCreator::newInstance($resultType);
		$updater = new ObjectUpdater();
		$updater->fromArray($result, $arRow);
		
		return $result;
	}
}
?>
