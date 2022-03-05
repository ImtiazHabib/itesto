<?php

//  All dynamic css will be including here 

?>
<!-- here you have to give style because css only written in style tag -->
<style type="text/css" media="all">
/* q is in main css but there was not color attributes in main.css  */
    q{
        /* color: here is the dynamic values get from the user in functions.php form */
        color: <?php echo get_option( 'font_colour_change' ); ?>;
    }

</style>