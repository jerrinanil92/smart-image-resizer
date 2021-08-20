<?php


define('UPLOAD_DIR', 'images/Output/');
define('UPLOAD_DIR_COMPRESSED', 'images/OutCompressed/');
	$img = $_POST['imgBase64'];
	$imgName = $_POST['imageName'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . $imgName .'.png';
	$success = file_put_contents($file, $data);
	
	
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


$source_img = $file;
$destination_img = UPLOAD_DIR_COMPRESSED . $imgName .'.png';;

$d = compress($source_img, $destination_img, 75);


	print $success ? $file : 'Unable to save the file.';

?>


