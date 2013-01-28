<?php
namespace Webit\Parser\FixedWidth\File;
class FileRow implements FileRowInterface {
	protected $rowIndex;

	/**
	 * 
	 * @param int $rowIndex
	 */
	public function __construct($rowIndex) {
		$this->rowIndex = (int)$rowIndex;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Webit\Parser\FixedWidth\File\FileRowInterface::getRowIndex()
	 */
	public function getRowIndex() {
		return $this->rowIndex;
	}
}
