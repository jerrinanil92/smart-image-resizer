
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
		<!-- Meta Description -->
        
        
       
		
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
  
   <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Georama">
    <style>
	 <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Oswald">
    <style>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&display=swap" rel="stylesheet">
      
    </style>

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
		
        <!--
        Home Slider
        ==================================== -->
		
		<section id="home-slider" style="height: 1500px;">
            <div id="slider" class="sl-slider-wrapper" style="height: 1500px;">

				<div class="sl-slider">
				
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">

						<div class="bg-img bg-img-1"></div>

						<div class="slide-caption">
                            <div class="caption-content">
                                <h2 class="animated fadeInDown"><img src="img/travellerlogo2.png" style="width: 375px;"></h2>
                                <center><form action="upload.php"  id="myDropzone" class="dropzone needsclick dz-clickable" style="width: 1300px;">
 <div class="dz-message needsclick" style="color:#000">
    <button type="button" class="dz-button">Drop files here or click to upload.</button><br>
    <span class="note needsclick">(Upload in <strong>batches</strong>. This is a real-time upload)</span>
  </div>
 
 </form></center><br><br>
                                <a href="processor.php" class="btn btn-blue btn-effect">Process Images</a>
                            </div>
                        </div>
						
					</div>
					
					<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
					
						<div class="bg-img bg-img-2"></div>
						<div class="slide-caption">
                            <div class="caption-content">
                                 <h2 class="animated fadeInDown"><img src="img/travellerlogo2.png" style="width: 250px;"></h2>
                                <span style="font-family: 'Anton', sans-serif;">Workspace Overview</span>
								<div class="row">
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
								<h2 class="animated fadeInDown" style="font-size:20px;">Image Processing Algo</h2>
								</div>
								<div class="col-md-4 wow animated fadeInLeft">
								<h2 class="animated fadeInDown" style="font-size:50px;font-family:'Anton', sans-serif;"><?php echo $avgKB." KB";?></h2>
								<h2 class="animated fadeInDown" style="font-size:20px;">Average Compressed File Size</h2>
								</div>
								</div>
                                 <a href="processor.php" class="btn btn-blue btn-effect">Go to  workspace</a>
                            </div>
                        </div>
						
					</div>
					
					

				</div><!-- /sl-slider -->

                <!-- 
                <nav id="nav-arrows" class="nav-arrows">
                    <span class="nav-arrow-prev">Previous</span>
                    <span class="nav-arrow-next">Next</span>
                </nav>
                -->
                
                <nav id="nav-arrows" class="nav-arrows hidden-xs hidden-sm visible-md visible-lg">
                    <a href="javascript:;" class="sl-prev">
                        <i class="fa fa-angle-left fa-3x"></i>
                    </a>
                    <a href="javascript:;" class="sl-next">
                        <i class="fa fa-angle-right fa-3x"></i>
                    </a>
                </nav>
                

				<nav id="nav-dots" class="nav-dots visible-xs visible-sm hidden-md hidden-lg">
					<span class="nav-dot-current"></span>
					<span></span>
					<span></span>
				</nav>

			</div><!-- /slider-wrapper -->
		</section>
		
        <!--
        End Home SliderEnd
        ==================================== -->
			
			
		
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
    </body>
</html>