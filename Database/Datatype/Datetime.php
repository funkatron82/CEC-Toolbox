<?php
namespace CEC\Toolbox\Database\DataType;

class Datetime extends \CEC\Toolbox\Database\DataType  {
	const NAME = 'DATETIME';

	function setLength( $length ) {
		$this->length =  NULL;
	}
}
