<?php
/*

Template Name: About

*/
?>
<?php include("php/phpHeader.php"); get_header(); ?>
<div class="" style="background-color:rgb(238,238,234); height:40px;"></div>


<!-- Page Sub Nav breadcrumbs -->
<div class="container">
	<!-- breadcrumbs -->
	<div id="sub_nav">
		<nav class="col-md-offset-1">
			<ol class="breadcrumb">
 				 <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
 				 <li class="active">About Us</li>
			</ol>
		</nav>
	</div>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Page Title -->
<div class="page-header col-md-12" id="body_header">
	<header class="container">
		<h1 class="col-md-offset-1"><?php the_title(); ?></h1>
	</header>
</div>


<div class="container">
	<!-- SideBar Nav -->
	<aside class="col-md-2 col-md-offset-1" id="sidebar_nav">
		<?php wp_nav_menu( 'sort_column=menu_order&menu_class=sf-menu&theme_location=second-menu' ); ?>
	</aside>


	<!-- Body Content -->
	<article class="col-md-5" id="article_wrap">
    	<div>
    		
            <?php the_content(); ?>
            
        </div>
	</article>



	<?php get_sidebar(); ?>
</div>

<?php endwhile; ?>
<?php endif; ?>


<?php $connect = NULL; get_footer(); ?>
