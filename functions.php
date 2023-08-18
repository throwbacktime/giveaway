<?php

// Add svg uploads
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}

add_filter('upload_mimes', 'add_file_types_to_uploads');
// Add svg uploads

// Add theme support
function template_theme_support() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme','template_theme_support');
// Add theme support

// Register styles - main
function template_register_styles() {
    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style('template-style', get_template_directory_uri() . "/style.css", array(), $version, 'all');
}
add_action('wp_enqueue_scripts', 'template_register_styles');
// Register styles - main

// Register scripts - main
function template_register_scripts(){
    $jsversion = wp_get_theme()->get( 'Version' );
    wp_enqueue_script('counter-script', get_template_directory_uri() . "/assets/js/counter.js", array(), $jsversion, false);
	wp_enqueue_script('form-script', get_template_directory_uri() . "/assets/js/form.js", array(), $jsversion, false);
}
add_action('wp_enqueue_scripts', 'template_register_scripts');
// Register scripts - main

// Custom post type - Clients
function create_clients_post_type() {
    $labels = array(
        'name' => __( 'Clients' ),
        'singular_name' => __( 'Client' ),
        'all_items'           => __( 'All Clients' ),
        'view_item'           => __( 'View Clients' ),
        'add_new_item'        => __( 'Add New Clients' ),
        'add_new'             => __( 'Add New' ),
        'new_item'            => __( 'New Clients' ),
        'edit_item'           => __( 'Edit Client' ),
        'update_item'         => __( 'Update' ),
        'search_items'        => __( 'Search Clients' ),
        'not_found'           => __( 'No client found' ),
        'not_found_in_trash'  => __( 'No client found in the Trash' ), 
    );
   
    $args = array(
        'labels' => $labels,
        'description' => 'Add new clients',
        'public' => true,
        'has_archive' => true,
        'map_meta_cap' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => false),
        'supports' => array(
            'title'
        ),
    );
	
    register_post_type( 'clients', $args);
}

add_action( 'init', 'create_clients_post_type' );
    
add_action( 'init', function() {
    remove_post_type_support( 'clients', 'slug' );
});
// Custom post type - Clients

// Custom metabox - Clients
function custom_input() {
    add_meta_box( 'input_data', __( 'Password', 'input-textdomain' ), 'input_data_callback', 'clients' );
}
add_action( 'add_meta_boxes', 'custom_input' );

function input_data_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'input_nonce' );
    $input_stored_meta = get_post_meta( $post->ID );
    $mail = array('password');

    if ( isset ( $input_stored_meta[$mail[0]] ) ) {
        $default_mail = $input_stored_meta[$mail[0]];
    }
?>

    <input type="text" style="width:100%;" name="<?php echo $mail[0] ?>" id="<?php echo $mail[0] ?>" value="<?php echo esc_attr( $default_mail[0] ); ?>" />

<?php
}

function input_data_save( $post_id ) {

    $mail = array('password');
 
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'input_nonce' ] ) && wp_verify_nonce( $_POST[ 'input_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    foreach($mail as $mails){
        if ( isset( $_POST[ $mails ] ) ) {
            update_post_meta( $post_id, $mails, $_POST[ $mails ] );
        }
    }
}
add_action( 'save_post', 'input_data_save' );
// Custom metabox - Clients

// Ajax Form - Clients Sign Up
function ajax_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_enqueue_script('ajax', get_template_directory_uri() . "/assets/js/ajax.js", array( 'jquery' ));
    wp_localize_script( 'ajax', 'cpm_object', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );

add_action( 'wp_ajax_set_form', 'set_form' );
add_action( 'wp_ajax_nopriv_set_form', 'set_form');


function set_form(){
	$email = $_POST['email'];
	$password = $_POST['password'];

    $new_post = array(
        'post_title'    => $email,
        'post_status'   => 'draft',
        'post_type' => 'clients'
    );
    
    $pid = wp_insert_post($new_post);
    if ( empty( $password ) OR ! $password ) {
        delete_post_meta( $pid,  'password');
    } elseif ( ! get_post_meta( $pid, 'password' ) ) {
        add_post_meta( $pid, 'password', $email );
    } else {
        update_post_meta( $pid, 'password', $email );
    }

	die();
}
// Ajax Form - Clients Sign Up
?>