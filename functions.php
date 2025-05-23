<?php

/******* Atos Stock Data Collection */ 

$is_admin = current_user_can( 'manage_options' );
 
if($is_admin){
    include_once('stock-data-collection/all-data-loader.php');
}

include_once('stock-data-collection/shareholders/add-data.php');


function getAtosData() {
    global $wpdb;
    $table = $wpdb->prefix . "atos_stock_data";    
    return $wpdb->get_var( "SELECT SUM(stock) FROM $table");
}

function getAtosParticipation() {
    global $wpdb;
    $table = $wpdb->prefix . "atos_stock_data";    
    return $wpdb->get_var( "SELECT SUM(participation) FROM $table");
}

function getAtosRows() {
    global $wpdb;
    $table = $wpdb->prefix . "atos_stock_data";    
    return $wpdb->get_var( "SELECT COUNT(*) FROM $table");
}

function load_custom_atos_stock_ajax() {

    if(is_front_page() || is_page_template('template-custom-home.php') || is_page_template('template-home-v2.php')){
        wp_register_script( 'ajax_front', get_stylesheet_directory_uri() . '/stock-data-collection/shareholders/ajax_front.js', array('jquery'), false, true  );
        wp_localize_script( 'ajax_front', 'ajax_front', array(
            'total_share' => getAtosData(),
            'total_people' => getAtosRows(),
		    ));
    wp_enqueue_script( "ajax_front" );
    }

    if(is_page_template('template-home-v2.php')){
      	$version = "6.1.10";
        wp_register_script( 'json-reader', get_stylesheet_directory_uri() . '/json_reader.js', array('jquery'), $version, true );

        wp_enqueue_script ("json-reader");
    }

	if ( is_page_template( 'atos-data-collect-template.php' ) ) {
	wp_register_script( 'ajax', get_stylesheet_directory_uri() . '/stock-data-collection/shareholders/ajax.js', array('jquery'), false, true  );
	wp_localize_script( 'ajax', 'ajax', array(
			'url' => admin_url( 'admin-ajax.php' ),
            'total_share' => getAtosData()
		));

	wp_enqueue_script( "ajax" );

	}
}
add_action( 'wp_enqueue_scripts', 'load_custom_atos_stock_ajax', 10);


/***** Load Stylesheets *****/

function mh_newsdesk_child_styles() {
    wp_enqueue_style('mh-newsdesk-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('mh-newsdesk-child-style', get_stylesheet_directory_uri() . '/style.css', array('mh-newsdesk-parent-style'));
}
add_action('wp_enqueue_scripts', 'mh_newsdesk_child_styles');


//Remove error for username, only show error for email only.
function atos_registration_errors($wp_error, $sanitized_user_login, $user_email){
    if(isset($wp_error->errors['empty_username'])){
        unset($wp_error->errors['empty_username']);
    }
    
    return $wp_error;
}
add_filter('registration_errors', 'atos_registration_errors', 10, 3);

function atos_set_username(){

    if( empty( $_POST['user_login'] ) ){

        //if there is anything set for user email
        if( isset($_POST['user_email']) && ! empty( $_POST['user_email'] ) ){

            //replace login with user email

            $email = $_POST['user_email'];

            $name = explode('@',$email,2);

            $_POST['user_login'] = $name [0];
        }
    }
}
add_action('login_form_register', 'atos_set_username');


add_filter('script_loader_tag', 'module_tag_loader' , 10, 3);

function module_tag_loader($tag, $handle, $src) {
    if ( 'json-reader' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" crossorigin src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

function atos_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'atos_remove_schedule_delete' );

// adding css to admin wp list table for atos shareholder's database
add_action('admin_head', 'atos_shareholder_css_list_table');

function atos_shareholder_css_list_table() {
	$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
	if( 'atos_shareholders' != $page )
	return;
	
	echo '<style type="text/css">';
	echo '.wp-list-table .column-id { width: 5%; }';
	echo '.wp-list-table .column-stockholder_name { width: 10%; }';
	echo '.wp-list-table .column-email { width: 15%; }';
	echo '.wp-list-table .column-phone { width: 10%; }';
	echo '.wp-list-table .column-stock { width: 10%; }';
	echo '.wp-list-table .column-participation { width: 10%; }';
	echo '.wp-list-table .column-ip { width: 15%; }';
	echo '.wp-list-table .column-country { width: 10%; }';
	echo '.wp-list-table .column-remarks { width: 15%; }';
	echo '</style>';
}


add_filter( 'rest_authentication_errors', function( $result ) {
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }

    return $result;
});