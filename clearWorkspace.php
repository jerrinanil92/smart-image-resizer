<?php
// PHP program to delete all
// file from a folder
   
// Folder path to be flushed
$folder_path = "images/Output";
$folder_path2 = "images/OutCompressed";
$folder_path3 = "photo_gallery";
   
// List of name of files inside
// specified folder
$files = glob($folder_path.'/*'); 
$files2 = glob($folder_path2.'/*'); 
$files3 = glob($folder_path3.'/*'); 
   
// Deleting all the files in the list
foreach($files as $file) {
   
    if(is_file($file)) 
    
        // Delete the given file
        unlink($file); 
}

foreach($files2 as $file2) {
   
    if(is_file($file2)) 
    
        // Delete the given file
        unlink($file2); 
}

foreach($files3 as $file3) {
   
    if(is_file($file3)) 
    
        // Delete the given file
        unlink($file3); 
}

header("Location: processor.php");
exit();

?>