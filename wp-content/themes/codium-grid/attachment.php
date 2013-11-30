<?php get_header() ?>

	<div id="container" class="">
		<div id="content" class="container_12 grid_10 postsingle push_5">
		<div class="postsingletext">
            <?php the_post() ?>

			<h2 class="single-entry-title"><a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php printf(__('Attachment : ', 'codium_grid' )) ?><?php echo get_the_title($post->post_parent) ?></a></h2>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h3 class="entry-title"><?php the_title() ?></h3>
				<div class="entry-content">
<p style="text-align: center;"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'codium_grid').''); ?>

<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_grid'), "</div>\n", 'number'); ?>
<?php printf(__('Back to post : ', 'codium_grid')) ?><a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php echo get_the_title($post->post_parent) ?></a>	
				</div>

<div class="grid_5 thumbnav alignleft">
<?php previous_image_link('thumbnail') ?>
</div>
<div class="grid_5 thumbnav alignright">
<?php next_image_link('thumbnail') ?>
</div>

<div class="clear"></div>

				<div class="entry-meta">
					<?php codium_grid_posted_on(); ?>
					<?php codium_grid_posted_in(); ?>	
					<?php edit_post_link(__('Edit', 'codium_grid'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
				</div>
			</div><!-- .post -->

<?php comments_template(); ?>
</div>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>