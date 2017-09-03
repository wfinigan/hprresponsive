<?php
	get_header();

	// Make sure posts appear at most one on this whole page.
	$do_not_duplicate = array();

	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$cat_slug = $yourcat->slug;
	$cat_color = category_color($cat_slug);

?>
<div id="main">
  <div id = "cat_name"><? single_cat_title(); ?></div>
     <div id="cat_sidebar">
      <?php get_sidebar(); ?>
    </div>

  <hr size='4' id='sectionhr' style="background-color: <? echo $cat_color; ?>;">

<!--FEATURED -->
  <div id="featured">
    <div id = "big_feature">

    <?

    	$cat = get_query_var('cat');
        $yourcat = get_category($cat);
    	$args = array( 'posts_per_page' => 1, 'category' => $yourcat->term_id, 'tag' => 'featured');
		$myposts = get_posts( $args );

		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<? array_push($do_not_duplicate, get_the_ID()); ?>
			 <!--<div id = "big_img">-->
			 	<a href="<?php the_permalink(); ?>">
			 		<? generate_nice_cropped_img(get_the_ID(), 325, 217, "cat_big_ftr_img");?>
			 	</a>
			 <!--</div>-->
			  <div id = "big_text_wrapper">
				<div id = "big_ftr_name"><a href="<?php the_permalink(); ?>"><? the_title(); ?></a></div>
				<div id = "big_ftr_author"><? the_author_posts_link(); ?> | <? the_time('F j, Y'); ?></div>
				<div id = "big_ftr_desc"><?php the_excerpt(); ?></div>
			  </div>
		<?php endforeach;
		wp_reset_postdata();

	?>
    </div>

		<!-- Separator -->
		<hr style="margin-top:15px; margin-bottom: 15px;">

    <div id="sml_ftrs_bottom">

    <?

    	$cat = get_query_var('cat');
        $yourcat = get_category($cat);
    	$args = array( 'posts_per_page' => 2, 'category' => $yourcat->term_id, 'tag' => 'featured', 'exclude' => $do_not_duplicate);
		$myposts = get_posts( $args );

		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<? array_push($do_not_duplicate, get_the_ID()); ?>
			<div class="small_feature">
			 <div class = "sml_img cat_small_ftr_img">
			 	<a href="<?php the_permalink(); ?>">
			 		<? generate_nice_cropped_img(get_the_ID(), 242, 162, "cat_small_ftr_img"); ?>
			 	</a>
			 </div>
			  <div class = "sml_text_wrapper">
				<div class = "sml_ftr_name"><a href="<?php the_permalink(); ?>"><? the_title(); ?></a></div>
				<div class = "sml_ftr_author"><? the_author_posts_link(); ?> | <? the_time('F j, Y'); ?></div>
			  </div>
			</div>
		<?php endforeach;
		wp_reset_postdata();


      ?>
    </div>

  </div>



  <div id="unfeatured">
    <div id="article_list">
    	<hr size='3' class = 'articleline' id='fstarticleline'>
    <?
  		$cat = get_query_var('cat');
        $yourcat = get_category($cat);
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    	$args = array( 'posts_per_page' => 6, 'category' => $yourcat->term_id, 'exclude' => $do_not_duplicate, 'paged' => $paged);
		$myposts = get_posts( $args );

		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<? array_push($do_not_duplicate, get_the_ID()); ?>
			<div class="article_entry">
			 <div class="entry_pic">
			 	<a href="<?php the_permalink(); ?>">
			 		<? generate_nice_cropped_img(get_the_ID(), 200, 150); ?>
			 	</a>
			 </div>
			 <div class="entry_text_wrapper">
				<div class="entry_title"><a href="<?php the_permalink(); ?>"><? the_title(); ?></a></div>
			  	<div class="entry_desc"><? the_excerpt(); ?></div>
			  	<div class="entry_author_date"><? the_author_posts_link(); ?> | <? the_time('F j, Y'); ?></div>
			  </div>
			</div>
			<hr size='3' class = 'articleline'>
		<?php endforeach; ?>

		<div class="pagenavi">
			 <?
			 next_posts_link('&larr; Older Entries ');
			 previous_posts_link( ' Newer Entries &rarr;');
			 ?>
		</div>
		<?
		wp_reset_postdata();
    	?>
	</div>
  </div>


</div>


<?php get_footer(); ?>
