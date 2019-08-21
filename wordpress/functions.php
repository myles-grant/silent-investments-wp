<?php 


if(function_exists("register_sidebar"))
{

	register_sidebar(array(

		"name" => "Sidebar Widgets",
		"id" => "sidebar-widgets",
		"description" => "These are widgets for the sidebar",
		"before_widget" => "<div id='%1$s' class='widget %2$s'>",
		"after_widget" => "</div>",
		"before_title" => "<h2>",
		"after_title" => "</h2>",
		));
}


function register_my_menus() {
register_nav_menus(
array(

		'main_menu' => __( 'main menu' ),
		'second-menu' => __( 'Second Menu' )

		));

}
add_action( 'init', 'register_my_menus' );



?>