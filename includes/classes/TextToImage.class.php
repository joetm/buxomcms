<?php
/**
 * Class for converting Text to Image.
 *
 * @author Taslim Mazumder Sohel
 * @deprecated 1.0 - 2007/07/25
 *
 */

class TextToImage {

	private $im;

    /**
     * @name 				   : makeImageF
     *
     * Function for create image from text with selected font.
     *
     * @param String $text     : String to convert into the Image.
     * @param String $font     : Font name of the text.
     * @param int    $width        : Width of the Image.
     * @param int    $height        : Hight of the Image.
     * @param int	 $X        : x-coordinate of the text into the image.
     * @param int    $Y        : y-coordinate of the text into the image.
     * @param int    $fontsize    : Font size of text.
     * @param array  $color	   : RGB color array for text color.
     * @param array  $bgcolor  : RGB color array for background.
     *
     */
    public function makeImageF($text, $font = "../../img/fonts/times.ttf", $X=0, $Y=0, $fontsize = 18, $color = array(0x0,0x0,0x0), $bgcolor = array(0xFF,0xFF,0xFF)){

		//get bounding box of text
		$size = imagettfbbox($fontsize, 0, $font, $text);
		$width = $size[2];
		$height = $size[3] + $fontsize;

	    	$this->im = @imagecreate($width, $height)
		    or die("Cannot Initialize new GD image stream");

		//RGB color background.
		if($bgcolor)
			$background_color = imagecolorallocate($this->im, $bgcolor[0], $bgcolor[1], $bgcolor[2]);
		else
		{
			//set background color to pink
			//and set the transparent color to pink
			$background_color  = imagecolorallocate($this->im, 0xFE, 0x00, 0xFE);
			$transparent_color = imagecolortransparent($this->im, $background_color);
		}

		//RGB color text.
		$text_color = imagecolorallocate($this->im, $color[0], $color[1], $color[2]);

		imagettftext($this->im, $fontsize, $X, $Y, $fontsize, $text_color, $font, $text);
    }

    /**
     * @name showAsPng
     *
     * Function to show text as Png image.
     *
     */
    public function showAsPng(){

		header("Content-type: image/png");
		return imagepng($this->im);
	}

    /**
     * @name saveAsPng
     *
     * Function to save text as Png image.
     *
     * @param String $filename 		: File name to save as.
     * @param String $location 		: Location to save image file.
     */
    public function saveAsPng($fileName, $location= null){

		$_fileName = $fileName.".png";
		$_fileName = is_null($location)?$_fileName:$location.$_fileName;
		return imagepng($this->im, $_fileName);
	}

    /**
     * @name showAsJpg
     *
     * Function to show text as JPG image.
     *
     */
    public function showAsJpg(){

		header("Content-type: image/jpg");
		return imagejpeg($this->im);
	}

    /**
     * @name saveAsJpg
     *
     * Function to save text as JPG image.
     *
     * @param String $filename 		: File name to save as.
     * @param String $location 		: Location to save image file.
     */
    public function saveAsJpg($fileName, $location= null){

		$_fileName = $fileName.".jpg";
		$_fileName = is_null($location)?$_fileName:$location.$_fileName;
		return imagejpeg($this->im, $_fileName);
	}

	/**
     * @name showAsGif
     *
     * Function to show text as GIF image.
     *
     */
	public function showAsGif(){

		header("Content-type: image/gif");
		return imagegif($this->im);
	}

    /**
     * @name saveAsGif
     *
     * Function to save text as GIF image.
     *
     * @param String $filename 		: File name to save as.
     * @param String $location 		: Location to save image file.
     */
    public function saveAsGif($fileName, $location= null){

		$_fileName = $fileName.".gif";
		$_fileName = is_null($location)?$_fileName:$location.$_fileName;
		return imagegif($this->im, $_fileName);
	}

}
?>