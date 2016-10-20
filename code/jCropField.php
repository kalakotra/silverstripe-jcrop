<?php

class jCropField extends FormField {

	public function __construct($name, $title=null, $value='', $imageID=null, $form=null) {
	
		$this->setImage($imageID);

		parent::__construct($name, ($title===null) ? $name : $title, $value, $form);
	}
	
	public function Field($properties = array()) {
	
		Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
		Requirements::javascript('jcrop/javascript/jquery.Jcrop.js');
		Requirements::javascript('jcrop/javascript/jquery.Jcrop.call.js');
		Requirements::css('jcrop/css/jquery.Jcrop.css');
		
		$obj = ($properties) ? $this->customise($properties) : $this;
		return $obj->renderWith($this->getTemplates());
	}

	public function setImage($imageID) {
		if ($imageID) {
			$this->ImageID = $imageID;
		}
	}

	public function getImage() {
		if ($this->ImageID) {
			return Image::get()->byID($this->ImageID);
		}
	}

	public static function fieldValueToSourceCoords($fieldVal) {
		return explode(',',$fieldVal);
		
	}
	
	public function PreviewImage() {
		//Use same image as CMS preview to save generating a new image - copied from File::getCMSFields()
		$image = $this->getImage();
		if ($image) {
			return $this->getImage()->getFormattedImage(
				'SetWidth', 350);
		}
	}

	public function getImageFields($field = "x1") {
		$image = $this->getImage();
		return $image->$field;
	}

	public function getPredefinedDimensions() {
		return jCropDimensions::get();
	}

}