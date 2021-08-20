<?php 
// Create ZIP file
if(isset($_POST['create'])){
    $zip = new ZipArchive();
	
     $filename = "./TPImages_Compressed_".time()."_dated.zip";

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    $dir = 'images/OutCompressed/';

    // Create zip
    createZip($zip,$dir);

    $zip->close();
	
	if (file_exists($filename)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));

        flush();
        readfile($filename);
        // delete file
        unlink($filename);
    

    }
	
	
}

// Create zip
function createZip($zip,$dir){
    if (is_dir($dir)){

        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                
                // If file
                if (is_file($dir.$file)) {
                    if($file != '' && $file != '.' && $file != '..'){
                        
                        $zip->addFile($dir.$file);
                    }
                }else{
                    // If directory
                    if(is_dir($dir.$file) ){

                        if($file != '' && $file != '.' && $file != '..'){

                            // Add empty directory
                            $zip->addEmptyDir($dir.$file);

                            $folder = $dir.$file.'/';
                            
                            // Read data of the folder
                            createZip($zip,$folder);
                        }
                    }
                    
                }
                    
            }
            closedir($dh);
        }
    }
}


?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title>Image Testing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel=stylesheet href=style.css>
 
</head>

<body class=testsuite>

  <form action="uploader.php" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td>Select Photo (one or multiple):</td>
            <td><input type="file" name="files[]" multiple/></td>
        </tr>
        <tr>
            <td colspan="2" align="center">Image format: .jpeg, .jpg, .png, .gif</td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Upload to Gallery" id="selectedButton"/></td>
        </tr>
		
    </table>
</form>

<form action="clearWorkspace.php" method="post">
    <table width="100%">
       
		 <tr>
            <td colspan="2" align="center"><input id="clickMe" name="clearSpace" type="submit" value="Clear Workspace" /></td>
        </tr>
    </table>
</form>


<form method='post' action=''>
   <input type='submit' name='create' value='Download Zipped Images' />&nbsp;
 </form>




 <?php
     $files = glob("photo_gallery/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );
		 
		 $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($image));

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
            echo basename($image)."<br />"; // show only image name if you want to show full path then use this code // echo $image."<br />";
             echo '<img src="'.$image .'" alt="'.$withoutExt.'" />'."<br /><br />";
            } else {
                continue;
            }
          }
       ?>

 
    <script src=jquery.js></script>
  <script src="smartcrop.js"></script>
  <script src=smartcrop-debug.js></script>
  <script src=testsuite.js></script>
	
 

 
</body>

</html>
