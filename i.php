<?php

//  plugin informations

/**
 * Plugin Name:       itestimo
 * Plugin URI:        https://imtiazhabib.com/
 * Description:       this is a testimonail carosel plugin. i am Imtiaz habib. This is my first developed plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Imtiaz habib
 * Author URI:        https://imtiazhabib.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       itestimo
 * 
 */

//  css include 
/**
 * Proper way to enqueue styles
 */
function itestimo_enqueue_style() {

   
    wp_enqueue_style( 'itestimo-style', plugins_url( 'css/bwpt-style.css', __FILE__ ) );

    
}
add_action( 'wp_enqueue_scripts', 'itestimo_enqueue_style' );

// js links including 
function itestimo_enqueue_script() {

    
    wp_enqueue_script( 'itestimo.js', plugins_url( 'js/bwpt-js.js', __FILE__ ), array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'itestimo_enqueue_script' );

// include admin scripts
function itestimo_enqueue_admin_style() {
    wp_enqueue_style( 'itestimo-admin-style', plugins_url( 'css/itestimo-admin-style.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
	wp_enqueue_script( 'cp-active', plugins_url('/js/cp-active.js', __FILE__), array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'itestimo_enqueue_admin_style' );


// Register Custom Post Type
function itestimo_custom_post_type() {

    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'itestimo' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'itestimo' ),
        'menu_name'             => __( 'Testimonials', 'itestimo' ),
        'name_admin_bar'        => __( 'Testimonial', 'itestimo' ),
        'archives'              => __( 'Item Archives', 'itestimo' ),
        'attributes'            => __( 'Item Attributes', 'itestimo' ),
        'parent_item_colon'     => __( 'Parent Item:', 'itestimo' ),
        'all_items'             => __( 'All Items', 'itestimo' ),
        'add_new_item'          => __( 'Add New Item', 'itestimo' ),
        'add_new'               => __( 'Add New Testimonial', 'itestimo' ),
        'new_item'              => __( 'New Item', 'itestimo' ),
        'edit_item'             => __( 'Edit Item', 'itestimo' ),
        'update_item'           => __( 'Update Item', 'itestimo' ),
        'view_item'             => __( 'View Item', 'itestimo' ),
        'view_items'            => __( 'View Items', 'itestimo' ),
        'search_items'          => __( 'Search Item', 'itestimo' ),
        'not_found'             => __( 'Not found', 'itestimo' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'itestimo' ),
        'featured_image'        => __( 'Featured Image', 'itestimo' ),
        'set_featured_image'    => __( 'Set featured image', 'itestimo' ),
        'remove_featured_image' => __( 'Remove featured image', 'itestimo' ),
        'use_featured_image'    => __( 'Use as featured image', 'itestimo' ),
        'insert_into_item'      => __( 'Insert into item', 'itestimo' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'itestimo' ),
        'items_list'            => __( 'Items list', 'itestimo' ),
        'items_list_navigation' => __( 'Items list navigation', 'itestimo' ),
        'filter_items_list'     => __( 'Filter items list', 'itestimo' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'itestimo' ),
        'description'           => __( 'Here you can add testimonial and it will appear dynamically on page.', 'itestimo' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'testimonials', $args );

}
add_action( 'init', 'itestimo_custom_post_type', 0 );

    

// itestimo post loop

function itestimo_loop(){

    ?>
      <div class="slideshow-container">
    <?php
   
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'testimonials' ),
        'post_status'            => array( 'published' ),
    );

    // The Query
    $itestimo_query = new WP_Query( $args );

    // The Loop
    if ( $itestimo_query->have_posts() ) {

        while ( $itestimo_query->have_posts() ) {
            $itestimo_query->the_post();
            // do something
    ?>
           <div class="mySlides">
              <q><?php the_content(); ?></q>
              <p class="author"><?php echo get_post_meta( get_the_ID(), 'itestimo_name', true ); ?></p>
            </div>


  <?php
 
        }
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();

?>
   <a class="prev" onclick="plusSlides(-1)">❮</a>
   <a class="next" onclick="plusSlides(1)">❯</a>
 </div>
<?php
    
}

// adding shaortcode feature in our plugin
    // shortcode main function
    function itestimo_add_custom_shortcode() {

        // add_shortcode one- tag,two-main plugin function.
        add_shortcode( 'itestimo', 'itestimo_loop' );

    }
    // initiazlizing shortcode to the wordpress.
    // here parametre one- initiazlize two- function name.
    add_action( 'init', 'itestimo_add_custom_shortcode' );


/**
	Get all php file.
**/
foreach ( glob( plugin_dir_path( __FILE__ )."inc/*.php" ) as $php_file )
    include_once $php_file;

// redirect plugin activation page code-- start

// 165- register activation hook(type,function name of action).
register_activation_hook(__FILE__,'itestimo_plugin_activate');

// initialize the function
add_action('admin_init','itestimo_plugin_redirect');

function itestimo_plugin_activate(){
    // making true to redirect option.
    add_option('itestimo_do_activation_redirect',true);
}

function itestimo_plugin_redirect(){
//    check redirect true or not 
    if(get_option('itestimo_do_activation_redirect',false)){

        delete_option( 'itestimo_do_activation_redirect' );

        // if plugin activate this tigger will occur
        if(!isset($_GET['activate-multi'])){
            // redirect path will be given here there has to be exect link here  
            wp_redirect("edit.php?post_type=testimonials&page=itestimo-setting-page");
        }
    }
}
// redirect plugin activation page code-- end  
?>

