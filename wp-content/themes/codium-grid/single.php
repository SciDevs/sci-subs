<?php get_header() ?>
	<div id="container">
		<div id="content" class="grid_10 postsingle push_5">
		<?php the_post(); ?>
			
			<div <?php post_class('cat-links'); ?>><?php printf(__('%s', 'codium_grid'), get_the_category_list(' ')) ?></div>
			<div class="postsingletext">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<h1 class="single-entry-title"><?php the_title(); ?></h1>
					
				<div class="linebreak"></div>
				<div class="entry-content">
					<?php the_content(''.__('', 'codium_grid').''); ?>
					
					<div class="clear"></div>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'codium_grid' ), 'after' => '</div>' ) ); ?>
					
				</div>

				<div class="entry-meta">
					<?php codium_grid_posted_on(); ?>
					<?php codium_grid_posted_in(); ?>	
					<?php edit_post_link(__('Edit', 'codium_grid'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
				</div>
				<div class="clear"></div>
			</div><!-- .post -->

			<div class="linebreak"></div>
			
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&laquo;</span> %title') ?></div>
				<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&raquo;</span>') ?></div>
			</div>
			
			
			
			<?php  comments_template(); ?> 

		</div>
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>
