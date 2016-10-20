# jcrop: Cropping for SilverStripe. Cropp selected part of the image.

## Overview

The goal of this module is to provide control over automatic image cropping in SilverStripe.

**Problem:** SilverStripe crops all images from the centre. If the subject is off-centre, it may be cropped out.

**Solution:** jcrop allows you to select the subject in an image and ensures it is not lost during cropping.

## Requirements

SilverStripe 3.x

## Installation

**Manually:** Download, place the folder in your project root and run a dev/build?flush=1.

**Composer/Packagist:** Add "kalakotra/jcrop" to your requirements.

## Usage

**In templates:** Use just like CroppedImage, but use CroppedFocusedImage instead.

**In the CMS:** When you edit an image in the CMS there should be an extra 'jCrop' field. Select the subject of the image to set the cropped area and save the image.

## To Do

 * Override CroppedImage() instead of adding new method
 
## Maintainer contact

[dany.ba](http://dany.ba)
