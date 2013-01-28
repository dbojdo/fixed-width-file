<?php
namespace Webit\Parser\FixedWidth\Parser;

class Row {
	/**
	 * 
	 * @var string
	 */
	private $resultType = null;
	
	/**
	 * 
	 * @var array
	 */
	private $positions = array();
	
	public function getResultType() {
		return $this->resultType;
	}
	
	public function setResultType($resultType) {
		$this->resultType = $resultType;
	}
	
	/**
	 * 
	 * @param Position $position
	 */
	public function addPosition(Position $position) {
		$this->positions[] = $position;
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getPositions() {
		return $this->positions;
	}
	
	/**
	 * @param mixed $key array key or property name
	 * @return Position|null
	 */
	public function getPosition($key) {
		if(isset($this->positions[$key])) {
			return $this->positions[$key];
		} else {
			$arPositions = array_filter($this->positions,function($position) use ($key) {
				return $position->getProperty() == $key;
			});
			
			return count($arPositions) > 0 ? array_shift($arPositions) : null;
		}
		
		return null;
	}
}
?>
