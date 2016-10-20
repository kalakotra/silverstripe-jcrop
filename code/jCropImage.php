<?php

class jCropImage extends DataExtension {

	private static $db = array(
		'x1' => 'Double',
		'y1' => 'Double',
		'x2' => 'Double',
		'y2' => 'Double',
		'w' => 'Double',
		'h' => 'Double'
	);

	private static $defaults = array(
		'x1' => '0',
		'y1' => '0',
		'x2' => '0',
		'y2' => '0',
		'w' => '0',
		'h' => '0'
	);
	
	public function updateCMSFields(FieldList $fields) {
		$myValue = $this->owner->x1.','.$this->owner->y1.','.$this->owner->x2.','.$this->owner->y2.','.$this->owner->w.','.$this->owner->h;
		if ($this->owner->x2 == 0 || $this->owner->y2 == 0) {
			$myValue = "";
		}

		$f = new jCropField(
			$name = "jCropXY",
			$title = "jCrop",
			$value = $myValue,
			$imageID = $this->owner->ID
		);
		$fields->addFieldToTab("Root.Main", $f);
	}
	
	public function onBeforeWrite() {
		if ($this->owner->jCropXY){
			$coords = jCropField::fieldValueToSourceCoords($this->owner->jCropXY);
			$this->owner->x1 = $coords[0];
			$this->owner->y1 = $coords[1];
			$this->owner->x2 = $coords[2];
			$this->owner->y2 = $coords[3];
			$this->owner->w = $coords[4];
			$this->owner->h = $coords[5];
			
		} else {
			$this->owner->x1 = 0;
			$this->owner->y1 = 0;
			$this->owner->x2 = 0;
			$this->owner->y2 = 0;
			$this->owner->w = 0;
			$this->owner->h = 0;
		}

		if ($this->owner->isChanged('jCropXY') || $this->owner->isChanged('jCropXY')) $this->owner->deleteFormattedImages();

		parent::onBeforeWrite();
	}
	
	/**
	 * Generate a resized copy of this image with the given width & height, cropping to maintain aspect ratio and focus point.
	 * Use in templates with $CroppedFocusedImage
	 * 
	 * @param integer $width Width to crop to
	 * @param integer $height Height to crop to
	 * @return Image
	 */
	public function CroppedFocusedImage($width,$height) {
		return $this->owner->getFormattedImage('CroppedFocusedImage', $width, $height);
	}

	public function CroppedImage($width,$height) {
		return $this->owner->getFormattedImage('CroppedImage', $width, $height);
	}

	/**
	 * Generate a resized copy of this image with the given width & height, cropping to maintain aspect ratio and focus point.
	 * Use in templates with $CroppedFocusedImage
	 * 
	 * @param Image_Backend $backend
	 * @param integer $width Width to crop to
	 * @param integer $height Height to crop to
	 * @return Image_Backend
	 */
	public function generateCroppedFocusedImage(Image_Backend $backend, $width, $height){
		
		$width = round($width);
		$height = round($height);
		$top = 0;
		$left = 0;
		$originalWidth = $this->owner->width;
		$originalHeight = $this->owner->height;

		$myReferent = 350/$originalWidth;

		if ($this->owner->x1 == "" || $this->owner->x2 == 0 || $this->owner->y2 == 0) {
			$firstCropX = 0;
			$firstCropY = 0;
			$firstCropW = $this->owner->width;
			$firstCropH = $this->owner->height;
		} else {
			$firstCropX = $this->owner->x1/$myReferent;
			$firstCropY = $this->owner->y1/$myReferent;
			$firstCropW = $this->owner->w/$myReferent;
			$firstCropH = $this->owner->h/$myReferent;
		}
		
		

		if ($width == 0 || $height == 0) {
			return $backend->crop($firstCropY, $firstCropX, $firstCropW, $firstCropH);
		} else {
			return $backend->crop($firstCropY, $firstCropX, $firstCropW, $firstCropH)->croppedResize($width, $height);
		}
		
	}


}