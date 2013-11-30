<?php get_header() ?>

	<div id="container">
		<div id="content" class="grid_10 postsingle push_5">
		<div class="postsingletext">
			
<?php the_post() ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
				<h1 class="single-entry-title"><?php the_title(); ?></h1>
				<div class="linebreak clear"></div>
				<div class="entry-content">
<?php the_content() ?>

<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_grid'), "</div>\n", 'number'); ?>

<div class="clear"></div>
<?php edit_post_link(__('Edit', 'codium_grid'),'<span class="edit-link">','</span>') ?>

				</div>
			</div><!-- .post -->

<?php comments_template(); ?>

</div>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>