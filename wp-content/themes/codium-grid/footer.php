</div>
<div class="clear"></div>  

<div id="footer" class="container_15">

<?php if ( is_active_sidebar( 'widgetfooterleft' ) ) : ?>
        <?php dynamic_sidebar( 'widgetfooterleft' ); ?>
<?php endif; // end widgetfooterleft  ?>
	        
<?php if ( is_active_sidebar( 'widgetfootercenter' ) ) : ?>
        <?php dynamic_sidebar( 'widgetfootercenter' ); ?>
<?php endif; // end widgetfootercenter  ?>
    
<?php if ( is_active_sidebar( 'widgetfooterright' ) ) : ?>
        <?php dynamic_sidebar( 'widgetfooterright' ); ?>
<?php endif; // end widgetfooterright  ?>
	
<div class="clear"></div>  

    
</div>
<div id="accessmobile" class="mobileonfooter">
	<?php wp_nav_menu(array('link_before' => '', 'container_class' => 'menu-header', 'theme_location' => 'primary-menu',)); ?>			
</div><!--  #accessmobile -->	
<div class="clear"></div>
<?php wp_footer() ?>
</body>
</html>