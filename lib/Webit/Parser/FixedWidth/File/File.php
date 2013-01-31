<?php
namespace Webit\Parser\FixedWidth\File;

class File extends \SplFileInfo {
	/**
	 * @var string
	 */
	protected $rows = array();
	
	/**
	 * @param FileRowInterface $row
	 */
	public function addRow(FileRowInterface $row) {	
		$this->rows[$row->getRowIndex()] = $row;
	}
	
	/**
	 * @return array
	 */
	public function getRows() {
		return $this->rows;
	}
	
	/**
	 * @param int $rowIndex
	 * @return FileRowInterface|NULL
	 */
	public function getRow($rowIndex) {
		if (key_exists($rowIndex, $this->rows)) {
			return $this->rows[$rowIndex];
		}
	
		return null;
	}
	
	/**
	 * @param string $property
	 * @param mixed $value
	 * @return array
	 */
	public function getRowsBy($property, $value) {
		$arProp = array();
		$arRows = array_filter($this->rows, function($row) use ($property, $value, &$arProp) {
			$class = get_class($row);
			if(!key_exists($class,$arProp)) {
				$refClass = new \ReflectionClass($class);
				if(!$refClass->hasProperty($property)) {
					$arProp[$class] = false;
					return false;
				}
				
				$prop = $refClass->getProperty($property);
				$prop->setAccessible(true);
				
				$arProp[$class] = $prop;
			}
			$prop = $arProp[$class];
			
			return $value = $prop->getValue($row);
		});
		
		return $arRows;
	}
}
?>
