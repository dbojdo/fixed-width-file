<?php
namespace Webit\Parser\FixedWidth\RowConfig;

use Symfony\Component\Yaml\Yaml;
use Webit\Parser\FixedWidth\Parser\RowDef;
use Webit\Parser\FixedWidth\Parser\PositionDef;

class YamlDriver {
	/**
	 * 
	 * @param string $file
	 * @throws \InvalidArgumentException
	 * @return RowDef
	 */
	public function buildRow($file) {
		$arYaml = Yaml::parse($file);
		$resultType = array_shift(array_keys($arYaml));
		
		$row = new RowDef();
		$row->setResultType($resultType);
		if(isset($arYaml[$resultType]['positions'])) {
			foreach($arYaml[$resultType]['positions'] as $arPosition) {
				$position = new PositionDef();
				
				if(!isset($arPosition['start']) || !isset($arPosition['end'])) {
					throw new \InvalidArgumentException('Missing key start od end');
				}
				
				$position->setStart($arPosition['start']);
				$position->setEnd($arPosition['end']);
				
				if(isset($arPosition['property'])) {
					$position->setProperty($arPosition['property']);
				}
				
				if(isset($arPosition['type'])) {
					$position->setType($arPosition['type']);
					if($arPosition['type'] == Position::TYPE_DATE) {
						$dateFormat = isset($arPosition['dateFormat']) ? $arPosition['dateFormat'] : Position::DEFAULT_DATE_FORMAT;
						$position->setDateFormat($dateFormat);
					}
				}

				if(isset($arPosition['align'])) {
					$position->setAlign($arPosition['align']);
				}
				
				$row->addPosition($position);
			}
		}
		
		return $row;
	}
}
?>
