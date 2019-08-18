<?php
namespace CEC\Toolbox\Database\DataType;

class Number extends \CEC\Toolbox\Database\DataType {
	public $unsigned = FALSE;
	public $zerofill = FALSE;
	public $allowedArgs = array( 'unsigned',	'zerofill');
	
	function setArgs( $args ){
		$args = array_map( 'boolval', $args );
		parent::setArgs( $args );
	}

	function renderArgs() {
		$output = '';
		$output .= $this->unsigned ? " UNSIGNED" : '';
		$output .= $this->zerofill ? " ZEROFILL" : '';
		return $output;
	}
}
