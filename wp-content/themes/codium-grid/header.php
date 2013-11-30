<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script> -->
<script src="<?php echo get_template_directory_uri();?>/lib/jquery-1.8.1.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/lib/jquery.popupoverlay.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/lib/functions.js"></script>


<?php wp_head() ?>
</head>

<body <?php body_class(); ?>> 
<div id="my_modal_background" class="popup_background" style="background-color: black; opacity: 0.4; position: fixed; top: 0px; right: 0px; bottom: 0px; left: 0px; display: none;"></div>
<div id="wrappermenu" class="">
	<div id="access" class="container_15">
		<?php wp_nav_menu(array( 'container_class' => 'menu-header', 'theme_location' => 'primary-menu',)); ?>			
	</div><!--  #access -->	
    <div class="clear"></div>
</div>
<div id="wrapperheader" class="container_15">
	<div id="header">
		<div class="headertop">
			<?php if((is_home() && ($paged < 2 )) ){ ?>
            <h1 id="blog-title" class="blogtitle"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
            <?php } else { ?>
            <div id="blog-title" class="blogtitle"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></div>
            <?php } ?>
			<div class="description"><?php bloginfo('description'); ?> </div>
		</div>

    </div><!--  #header -->	
</div><!--  #wrapperpub -->			
<div class="clear"></div>
<div id="wrapper" class="container_15">	
<div class="clear"></div>		
	