<?php $count = 0; ?>
			
<?php get_header( ); ?>
	<div id="container" class="">
		<div id="content" class="container_12 grid_10 push_5">
			<?php if (have_posts()) : 
			while (have_posts()) : the_post(); 
			$count++;
			?>
			<div class="grid_4 alpha<?php echo $count;?> omega<?php echo $count;?>">
            <!-- Category title only the fist one is display -->
			<div <?php body_class('cat-links'); ?>>
                <?php 
                $category = get_the_category();
                if ($category ) {
                  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . $category[0]->name . '" ' . '>' . $category[0]->name.'</a>';
                  if(isset($category[1])){
                    echo ' ...';
                  }
                }
                ?>
            </div>
                
			<!-- Begin post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class('posthome'); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
							<div class="">
								<a href="<?php the_permalink(); ?>">
									<?php 
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'post-thumbnail' );
                                        $title = get_the_title();           
	     								echo '<img src="' . $image_src[0]  . '" width="100%" alt="'.$title.'" />';
                                    ?>
					        	</a>
					    	</div><!-- End Thumb Container -->
							
							<div class="posthometext">
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Link to %s', 'codium_grid'), esc_html(get_the_title(), 1)) ?>" rel="bookmark"><?php echo codium_grid_short_title(get_the_title()); ?></a></h2>
							<div class="entry-content-home">
							<?php echo substr(get_the_excerpt(), 0,140); ?> [...]
							</div>
                            <?php if(get_the_title() == ''){ ?>
                                <div class="entry-content-home">
							        <a href="<?php the_permalink() ?>" title="<?php printf(__('read this post', 'codium_grid')) ?>" rel="bookmark">&raquo; <?php echo (__('read this post', 'codium_grid')) ?></a>
                                </div>    
                            <?php } ?>
							</div>
						
                <?php } else { ?>
						<div class="posthometext">
						<br />
						<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Link to %s', 'codium_grid'), esc_html(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
							<div class="entry-content-home">
							<?php echo substr(get_the_excerpt(), 0,140); ?> [...]
							</div>
                            <?php if(get_the_title() == ''){ ?>
                                <div class="entry-content-home">
							        <a href="<?php the_permalink() ?>" title="<?php printf(__('read this post', 'codium_grid')) ?>" rel="bookmark">&raquo; <?php echo (__('read this post', 'codium_grid')) ?></a>
                                </div>    
                            <?php } ?>
						</div>
				
					<?php }?> 

						
			</div>
			<!-- End post -->
			</div>
			
<?php endwhile; endif ?>

<div class="clear"></div>				
						
<div class="center">			
	<?php if(function_exists('wp_pagenavi')) { 
		wp_pagenavi();
	} else {?>
		<div class="navigation mobileoff"><p><?php posts_nav_link(); ?></p></div>
		 <?php } ?>  
		<div class="navigation_mobile"><p><?php posts_nav_link(); ?></p></div> 
</div>


		</div><!-- #content -->
	</div><!-- #container -->
	
<?php get_sidebar() ?>
<?php get_footer() ?>