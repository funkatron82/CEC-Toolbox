<?php
namespace CEC\Toolbox\Database\DataType;

class Timestamp extends \CEC\Toolbox\Database\DataType  {
	const NAME = 'TIMESTAMP';

	function setLength( $length ) {
		$this->length =  NULL;
	}
}
