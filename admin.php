<?php
require_once( dirname(__FILE__).'/../../../wp-admin/admin.php' );


add_action( 'admin_enqueue_scripts', 'simpler_admin_styles' );
function simpler_admin_styles(){
	wp_enqueue_style( 'wp-simpler', plugins_url( 'css/simpler.css', __FILE__ ) );
	if( false ) { // Do we want to yank all stock styles?
		wp_dequeue_style( 'wp-admin' );
		wp_dequeue_style( 'colors' );
		wp_dequeue_style( 'ie' );
	}
}

add_filter( 'admin_body_class', 'simpler_admin_body_class' );
function simpler_admin_body_class( $body_class ){
	return $body_class . ' simpler ';
}

add_filter( 'admin_footer_text', 'simpler_admin_footer_text', 20 );
function simpler_admin_footer_text( $footer_text ){
	return '<a class="leave-simpler" href="'.admin_url().'?wp-simpler=deactivate">'.__( 'Return to the traditional UI?' ).'</a>';
}


// The page output ...
require_once( dirname(__FILE__) . '/inc/simpler-header.php' );

if( isset( $_GET['page'] ) && ( $page = $_GET['page'] ) ):
	do_action( "simpler_page-$page" );
else: ?>
	<h1><?php _e('Simpler UI'); ?></h1>
	<p><?php _e('No Page Recognized.  Sorry!'); ?></p>
<?php endif;

require_once( dirname(__FILE__) . '/inc/simpler-footer.php' );
