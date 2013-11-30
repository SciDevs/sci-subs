<div id="primary" class="sidebar alpha grid_5 pull_10">
	<ul class="">
	<?php if ( is_active_sidebar( 'sidebartop' ) ) : ?>
        <?php dynamic_sidebar( 'sidebartop' ); ?>
	<?php endif; // end primary sidebar widgets  ?>
	</ul>
	
</div><!-- #primary .sidebar -->

<div id="secondary" class="sidebar alpha grid_5 pull_10">
	<ul class="">
	<?php if ( is_active_sidebar( 'sidebarbottom' ) ) : ?>
        <?php dynamic_sidebar( 'sidebarbottom' ); ?>
	<?php endif; // end secondary sidebar widgets  ?>
	</ul>
    
</div><!-- #secondary .sidebar -->