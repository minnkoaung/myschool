<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bootstrap Theme by @Graphikaria</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="">
	<link rel="stylesheet" href="themes/<?php echo $this->settings->theme; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="themes/<?php echo $this->settings->theme; ?>/assets/css/theme.css">
	<link rel="stylesheet" href="themes/<?php echo $this->settings->theme; ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="themes/<?php echo $this->settings->theme; ?>/assets/css/bootstrap-select.min.css">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="themes/<?php echo $this->settings->theme; ?>/assets/js/respond.min.js"></script>
	<![endif]-->

	 <?php // CSS files ?>
    <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
                <link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->settings->site_version; ?>"><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
	<!-- Main Navbar -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<section class="wrapper-xs bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-10">
						<i class="fa fa-question-circle"></i> Have any question? Email us at <i class="fa fa-envelope"></i> <a href="#link"><span class="text-light">info@myschool.com</span></a>
					</div><!-- /.col -->
					<div class="col-sm-12 col-md-2">
						<ul class="list-inline no-margin-bottom pull-right">
							<li><a href="#"><i class="text-light fa fa-lg fa-fw fa-twitter"></i></a></li>
							<li><a href="#"><i class="text-light fa fa-lg fa-fw fa-facebook"></i></a></li>
							
						</ul>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.wrapper -->
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">
					<img src="<?php echo base_url(); ?>/themes/<?php echo $this->settings->theme; ?>/assets/img/logo-dark.png" alt="Website Logo">
				</a>
			</div>
			<!-- Navbar -->
			<div class="collapse navbar-collapse navbar-main-collapse">
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="<?php echo base_url(); ?>">Home</a>
					</li>
					<li class="">
						<a href="<?php echo base_url(); ?>">About School</a>
					</li>
					<li class="">
						<a href="<?php echo base_url(); ?>">News</a>
					</li>
					<li class="">
						<a href="<?php echo base_url(); ?>">Events</a>
					</li>
					<li class="">
						<a href="<?php echo base_url(); ?>">Contact Us</a>
					</li>
					<!-- <li class="dropdown">
						<a href="#link" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="search_results.html">Search Results</a></li>
							<li><a href="item_page.html">Item Page</a></li>
							<li><a href="services.html">Services</a></li>
							<li><a href="gallery.html">Gallery</a></li>
						</ul>
					</li> -->
					<!-- <li class="dropdown">
						<a href="#link" class="dropdown-toggle" data-toggle="dropdown">Agents <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="team.html">All Agents</a></li>
							<li><a href="team_member.html">Agent Profile</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#link" class="dropdown-toggle" data-toggle="dropdown">Corporate <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="about.html">About</a></li>
							<li><a href="contact.html">Contact 1</a></li>
							<li><a href="contact_2.html">Contact 2</a></li>
							<li><a href="login.html">Login/Signup</a></li>
						</ul>
					</li> -->
				</ul><!-- /.navbar-nav -->
			</div><!-- /.collapse -->
		</div><!-- /.container -->
	</nav><!-- /.navbar -->