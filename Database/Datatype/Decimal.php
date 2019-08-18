<?php
namespace CEC\Toolbox\Database\DataType;

class Decimal extends Number  {
	const NAME = 'DECIMAL';

	function setLength( $length ) {
		$this->length =  array_map( 'absint', array_slice( (array) $length, 0, 2 ) );
	}
}
