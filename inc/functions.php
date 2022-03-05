<?php

/**
 * Adds a submenu page under a custom post type parent.
 */
function itestimo_register_ref_page(){
    add_submenu_page(
        'edit.php?post_type=testimonials',
        __( 'Settings', 'itestimo' ),
        __( 'Settings', 'itestimo' ),
        'manage_options',
        'itestimo-setting-page',
        'itestimo_setting_page'
    );
}
// initiazlize it 
add_action('admin_menu','itestimo_register_ref_page');
 
/**
 * Display callback for the submenu page.
 */
function itestimo_setting_page() { 
    ?>
     <div class="my profile">
        <h1>About Developer</h1>
        <h3>Imtiaz Habib</h3>
        <p>Hello, I am Imtiaz habib.This is my first developed plugin. This is just simple tesmmonial plugin where you can add custom quote/reviews in admin dashboard  and it will dynamically add in the page/section  via shortcode-    [itesto] . This plugin has shortcode and custom function features. You can change the color of the quote in settings.This is just start point of my plugin develop journey. Thanks for downloading my plugin. Feel free to email me : imtiazhabib7@gmail.com. My protfolio link : <a href="https://imtiazhabib.com/">imtiazhabib.com</a></p>
    </div>

    <div class="wrap">
        <h1><?php _e( 'Settings', 'itestimo' ); ?></h1>
        
        <!-- form of the setting page start -->
        <!-- options.php in wordpress database file and its post type -->
        <form action="options.php" method="post">

        <!-- this line excet to be same as it is  -->
        <?php wp_nonce_field('update-options'); ?>

         
        <!-- get user value as change colour of the fonts -->
        <label name="font_colour_change" for="font_colour_change">Font Colour</label>
         <input type="text" name="font_colour_change" value="<?php echo get_option( 'font_colour_change' ); ?>" class="color-picker"/>

        <!-- hidden values send with the form -->
         <input type="hidden" name="action" value="update" />
         <!-- in value="the filed i want to pass through the form" -->
         <input type="hidden" name="page_options" value="font_colour_change" />

         <!-- submit trigger -->
         <input type="submit" name="submit" value="<?php _e( 'Save Changes', 'itestimo' ); ?>" />

        </form>

        <!-- form of the setting page end  -->
    </div>
   
    <?php
}
?>