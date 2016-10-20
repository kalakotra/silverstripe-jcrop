<?php

class jCropDimensions extends DataObject {

	public static $db = array(
		'Width' => 'Int',
		'Height' => 'Int'
	);
	
	public static $summary_fields = array(
		'Width' => 'Width',
		'Height' => 'Height'
	);

}

?>