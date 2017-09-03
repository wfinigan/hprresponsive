<?php get_header(); ?>

<div id="main">
 <div id="unfeatured">
    <div id="article_list">
	<h2><? echo single_tag_title(); ?></h2> 
  <?
 		while ( have_posts() ) : the_post(); ?>

			<div class="author_article">
			 <div class = "sml_img">
			 	<a href="<?php the_permalink(); ?>">
			 		<? generate_nice_cropped_img(get_the_ID(), 275, 170); ?>
			 	</a>
			 </div>
			  <div class = "sml_text_wrapper">
				<div class = "sml_ftr_name"><a href="<?php the_permalink(); ?>"><? the_title(); ?></a></div>
				<div class = "sml_ftr_author"><? the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><? the_time('F j, Y'); ?></a></div>
			  </div>
			</div>
		<?php endwhile;  ?>
		</div>
		<div class="pagenavi">
			 <?
			 next_posts_link('&larr; Older Entries ');
			 previous_posts_link( ' Newer Entries &rarr;');
			 ?>
		</div>
	</div>

    <div id="cat_sidebar">
      <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>