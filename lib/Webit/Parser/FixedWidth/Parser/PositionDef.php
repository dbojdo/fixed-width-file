<?php
namespace Webit\Parser\FixedWidth\Parser;
class PositionDef {
	const ALIGN_LEFT = 'left';
	const ALIGN_RIGHT = 'right';

	const TYPE_INT = 'int';
	const TYPE_FLOAT = 'float';
	const TYPE_STRING = 'string';
	const TYPE_BOOL = 'bool';
	const TYPE_DATE = 'date';

	const DEFAULT_DATE_FORMAT = 'YmdHis';
	
	/**
	 * 
	 * @var int
	 */
	private $start;

	/**
	 * 
	 * @var int
	 */
	private $end;

	/**
	 * 
	 * @var string
	 */
	private $type;

	/**
	 * 
	 * @var string
	 */
	private $dateFormat;

	/**
	 * 
	 * @var string
	 */
	private $align;

	/**
	 * 
	 * @var string
	 */
	private $property;

	/**
	 * @return int
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * @param int $start
	 */
	public function setStart($start) {
		$this->start = $start;
	}

	/**
	 * @return int
	 */
	public function getEnd() {
		return $this->end;
	}

	/**
	 * @param int $end
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getDateFormat() {
		return $this->dateFormat;
	}

	/**
	 * @param string $dateFormat
	 */
	public function setDateFormat($dateFormat) {
		$this->dateFormat = $dateFormat;
	}

	/**
	 * @return string
	 */
	public function getAlign() {
		return $this->align;
	}

	/**
	 * @param string $align
	 */
	public function setAlign($align) {
		$this->align = $align;
	}

	/**
	 * @return string
	 */
	public function getProperty() {
		return $this->property;
	}

	/**
	 * @param string $property
	 */
	public function setProperty($property) {
		$this->property = $property;
	}
}
?>
