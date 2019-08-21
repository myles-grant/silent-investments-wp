
<!doctype html <?php language_attributes(); ?>>
<html>
<head>
<meta charset="<?php bloginfo('charset') ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="../../assets/ico/favicon.ico">
<script src="<?php bloginfo('template_url'); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
<title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>

<!-- Bootstrap core CSS -->
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" />
<!-- Custom styles for this template -->
<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/layout.css">
<link type="text/css" rel="stylesheet" href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' >


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<!-- Header/Nav -->
<header>

	<!-- Main Nav --><!--Login/Signup -->
	<nav id="main_nav" class="navbar-default navbar-static-top navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Logo -->
			<img class="si-logo" src="<?php bloginfo('template_url'); ?>/images/silent-investments-logo.png" width="269" height="57" alt="Silent Investments"/>
				
				<ul class="nav nav-pills pull-right">
					<?php if(!isset($_SESSION["userID"])) { ?>

						<li style="margin-left:7px; margin-right:0; border:none;"><span><a href="<?php get_the_permalink();?>?page_id=108"><button type="button" class="btn btn-default" id="login">LOGIN</button></a></span></li>
						<li style="margin-left:0; border:none"><span><a href="<?php get_the_permalink();?>?page_id=110"><button type="button" class="btn btn-default" id="signup">SIGNUP</button></a></span></li>

					<?php } else { ?>

						<li><a href="#">Profile</a></li>
						<li id="userLogged"><?php echo "Welcome, " . ucfirst($_SESSION["username"]); echo $GLOBALS["notification"]; ?></li>
						<li id="logout"><a href="<?php bloginfo('template_url'); ?>/php/logoutUser.php"><button type="button" class="btn btn-default">LOGOUT</button></a></li>

					<?php } ?>
				</ul>
				

				<div id="wp_nav" class="pull-right">
					<?php wp_nav_menu( array('menu' => 'main menu')); ?>
				</div>
			
		</div>
	</nav>
</header>
<?php echo $GLOBALS["changePasswordModal"]; ?>

<div style="height:55px;"></div> 
<!-- <div class="" style="background-color:rgb(238,238,234); height:40px;"></div> -->


