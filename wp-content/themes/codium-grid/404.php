<?php get_header() ?>

	<div id="container">
		<div id="content" class="grid_10 postsingle push_5">
		<div class="postsingletext">
			
                      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                                <h1 class="entry-title"><?php _e( 'Error', 'codium_grid' ); ?></h1>
	                                <div class="entry-content">
	                                        <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'codium_grid' ); ?></p>
                                        <?php get_search_form(); ?>
                                        <br />
                                </div><!-- .entry-content -->
                        </div><!-- #post-0 -->
	

		</div>
		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
	                // focus on search field after it has loaded
	                document.getElementById('s') && document.getElementById('s').focus();
	</script>
	

<?php get_sidebar() ?>
<?php get_footer() ?>