<?php get_header(); ?>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		 

		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>	</h1>
		

		<div class="entry">
			<?php the_content(); ?>
		</div>
		


		<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
		
		<?php edit_post_link( __('Edit this page', 'wpzoom'), '<div class="after-meta"> ', '</div>');
	get_footer(); ?>		
  	</div> <!-- /.single -->
  		
	<?php endwhile; endif; ?>
   	<?php wp_reset_query();

?>