<?php 
$root = 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>Arkana | The IoT pLatform</title>
		<meta name="description" content="Worthy a Bootstrap-based, Responsive HTML5 Template">
		<meta name="author" content="htmlcoder.me">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo $root ?>asset/images/ico_logo.png">		
		<link href="<?php echo $root ?>asset/css/root.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo $root ?>asset/plugins/jquery.min.js"></script>
	</head>

	<body class="no-trans">		
		<div class="scrollToTop"><i class="icon-up-open-big"></i></div>
		<div id="banner" class="banner" style="background-image: url('http://localhost/development-workflow/asset/images/banner.jpg')">
			<div class="banner-image" ></div>
			<div class="banner-caption" >
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 object-non-visible" data-animation-effect="fadeIn">
							<div class=" clearfix a-center">
								<div class="logo smooth-scroll">
									<a href="#banner"><img id="logo" src="<?php echo $root ?>asset/images/ico_logo.png" alt="Worthy" width="60px"></a>
								</div>
								<div class="site-name-and-slogan smooth-scroll">
									<div class="site-name"><a href="#banner">Arkana</a></div>
									<div class="site-slogan">IoT Platform <a target="_blank" href="http://arkana.iot-platform.id/">Arkana</a></div>
								</div>
							</div>
							<p class="a-header text-center">404 Not Found</p>
							<p class="a-header-level-two text-center"><span class="orange">Arkana</span> adalah platform Internet of Things yang mempunyai misi untuk mendidik pelajar SMK/SMA dan mahasiswa agar menjadi ahli Internet of Things (IoT) di masa depan.</p>
							
							<div class="line-orange"></div>

						
							<br>
							
											
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<footer id="footer">


			<!-- .subfooter start -->
			<!-- ================ -->
			<div class="subfooter">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">Copyright © 2017 by <a target="_blank" href="">Arkana IoT Platform</a>.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- .subfooter end -->

		</footer>
		<!-- footer end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		
		<script type="text/javascript" src="<?php echo $root ?>asset/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="<?php echo $root ?>asset/plugins/modernizr.js"></script>

		
		<!-- Backstretch javascript -->
		<script type="text/javascript" src="<?php echo $root ?>asset/plugins/jquery.backstretch.min.js"></script>

		<!-- Appear javascript -->
		<script type="text/javascript" src="<?php echo $root ?>asset/plugins/jquery.appear.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="<?php echo $root ?>asset/js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="<?php echo $root ?>asset/js/custom.js"></script>

	</body>
</html>

