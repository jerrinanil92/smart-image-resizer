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
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    	<!-- meta character set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TP Smart Image Resizer</title>		
	
		
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- CSS
		================================================== -->
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		
		<!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/jquery.fancybox.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/slit-slider.css">
		<!-- bootstrap.min -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="css/main.css">

		<!-- Modernizer Script for old Browsers -->
        <script src="js/modernizr-2.6.2.min.js"></script>
		
		 <link href="dist/dropzone.css" type="text/css" rel="stylesheet" />
  <script src="dist/dropzone.js"></script>

    </head>
	
    <body id="body">

		<!-- preloader -->
		<div id="preloader">
            <div class="loder-box">
            	<div class="battery"></div>
            </div>
		</div>
		<!-- end preloader -->

        <!--
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
                    </button>
					<!-- /responsive nav button -->
					
					<!-- logo -->
					<h1 class="navbar-brand">
						<img src="img/travellerlogo.png" style="width: 200px;">
					</h1>
					<!-- /logo -->
                </div>

				<!-- main nav -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="processor.php">Workspace</a></li>
                        
                    </ul>
                </nav>
				<!-- /main nav -->
				
            </div>
        </header>
        <!--
        End Fixed Navigation
        ==================================== -->
		
		<main class="site-content" role="main">
		
       <!-- about section -->
			<section id="about" style="padding-top: 100px;background-color: #113756;">
				<div class="container">
					<div class="sec-title text-center">
							<h2 class="wow animated bounceInLeft" style="color:white">Image Analyzer Results</h2>
							
							<div class="row">
							<div class="wow animated bounceInLeft">
						
						<form action="upload.php"  id="myDropzone" class="dropzone needsclick dz-clickable" style="width: 1300px;">
 <div class="dz-message needsclick" style="color:#000">
    <button type="button" class="dz-button">Add images to workspace.</button><br>
    <span class="note needsclick">(Upload in <strong>batches</strong>. This is a real-time upload. Refresh the workspace once upload is done.)</span>
  </div>
 
 </form></div>
							
							</div>
							
							<div class="row" style="margin-top: 50px;padding-left: 55px;">
							
						
						<div class="col-md-6 wow animated fadeInLeft">
							<p class="wow animated bounceInRight">Workspace Options<br>
							
							
							<form action="clearWorkspace.php" method="post">
								<button class="btn btn-danger"  id="clickMe" name="clearSpace" type="submit" value="Clear Workspace">Clear Workspace</button>
							</form>					
							
						</div>
						
						<div class="col-md-4 wow animated fadeInLeft">
							<p class="wow animated bounceInRight">Current Workspace<br><form method='post' action=''>
   <button class="btn btn-success" type='submit' name='create' value='Download Zipped Images'>Download Zipped Images</button>&nbsp;
 </form></p>
						</div>
							
							
							</div>
							
						</div>
					
					
					
				</div>
			</section>
			<!-- end about section -->
			
			
			<!-- Service section -->
			<section>
				<div class="container" id="analyzer" style="padding-left: 100px;">
				
					<div class="row">
					
					<div class="row">
					<h2 class="wow animated bounceInLeft">Workspace Overview</h2>
								<?php
								$directory = "photo_gallery/";
								$filecount = 0;
								$files = glob($directory . "*");
								if ($files){
								$filecount = count($files);
								}
								
								if($filecount==0)
								{
									$avgKB="-";
								}else{
								$path="images/OutCompressed/";
								  $bytestotal = 0;
									$path = realpath($path);
												if($path!==false && $path!='' && file_exists($path)){
								foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
											$bytestotal += round($object->getSize() / 1024, 2);
												}
												}
								$avgKB=round($bytestotal/$filecount, 2);
								
								}
											
								
								
								
								
								?>
							
								<div class="col-md-4 wow animated fadeInLeft">
								<h2 class="animated fadeInDown" style="font-size:50px;font-family: 'Bebas Neue', sans-serif;"><?php echo $filecount;?></h2>
								<h2 class="animated fadeInDown" style="font-size:20px;font-family: 'Anton', sans-serif;">Images</h2>
								</div>
								<div class="col-md-4 wow animated fadeInLeft">
								<h2 class="animated fadeInDown" style="font-size:10px;">* Face Recognition<br>* Rule Of Thirds Analysis<br>* Saliency Analysis</h2>
								<h2 class="animated fadeInDown" style="font-size:20px;margin-top: 40px;">Image Processing Algo</h2>
								</div>
								<div class="col-md-4 wow animated fadeInLeft">
								<h2 class="animated fadeInDown" style="font-size:50px;font-family:'Anton', sans-serif;"><?php echo $avgKB." kb";?></h2>
								<h2 class="animated fadeInDown" style="font-size:20px;;margin-top: 15px;">Average Compressed File Size</h2>
								</div>
								</div>
					
						<div class="sec-title text-center">
							
							
							
							
						</div>
						
						<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">File Name</th>
	   <th scope="col">Image</th>
	   <th scope="col">AI Analysis</th>
	   <th scope="col">Output</th>
      
    </tr>
  </thead>
  <tbody>
   
						
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
			 ?>
			
			 <tr style="height:100px;">
      <th scope="row"><?php echo $i; ?></th>
	  <td><?php echo basename($image)."<br />"; ?></td>
      <td><?php echo '<img src="'.$image .'" style="max-width:250px;max-height: 450px;" alt="'.$withoutExt.'" />'."<br /><br />"; ?></td>
	   <td class="aianalysis<?php echo $withoutExt;?>"></td>
	   <td class="output<?php echo $withoutExt;?>"></td>
    </tr>
           
             
            
			
			
			
			<?php
			} else {
                continue;
            }
          }
       ?>

		 
   
  </tbody>
</table>				
						
						
						
					</div>
				</div>
			</section>
			<!-- end Service section -->
			
			
		
		</main>
		
		
		
		<!-- Essential jQuery Plugins
		================================================== -->
		<!-- Main jQuery -->
        <script src="js/jquery-1.11.1.min.js"></script>
		<!-- Twitter Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
		<!-- Single Page Nav -->
        <script src="js/jquery.singlePageNav.min.js"></script>
		<!-- jquery.fancybox.pack -->
        <script src="js/jquery.fancybox.pack.js"></script>
		<!-- Google Map API -->
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<!-- Owl Carousel -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
        <!-- Fullscreen slider -->
        <script src="js/jquery.slitslider.js"></script>
        <script src="js/jquery.ba-cond.min.js"></script>
		<!-- onscroll animation -->
        <script src="js/wow.min.js"></script>
		<!-- Custom Functions -->
        <script src="js/main.js"></script>
        <script>myDropzone.on("complete", removeAllFiles());</script>
		
		  <script src=jquery.js></script>
  <script src="smartcrop.js"></script>
  <script src=smartcrop-debug.js></script>
  <script src=testsuite.js></script>
	
    </body>
</html>