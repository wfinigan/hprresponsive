<?php
/*
Template Name Posts: fullsize
*/

$posttags = get_the_tags();
$hprgument_tag = '';

if ($posttags){
    foreach($posttags as $tags){
        if (stristr($tags->slug, 'hprgument')){
            $hprgument_tag = $tags;
            break;
        }
    }
    $tax = get_term_by('id', $hprgument_tag->term_id, 'post_tag');
    $post_array = get_objects_in_term($hprgument_tag->term_id, 'post_tag', array('asc'));
    
    $hprgument_id = $post_array[0];
    $first_article_id = $post_array[0];
    foreach ($post_array as $pid){
        if(count(get_coauthors($pid)) > count(get_coauthors($hprgument_id))){
            $hprgument_id= $pid;
        }
    }
    
    foreach ($post_array as $pid){
        if($pid != $hprgument_id){
            $first_article_id = $pid;
            break;
        }
    }
    
    $q_post = get_post($hprgument_id, ARRAY_A);
    
    $discussion_link = get_permalink($hprgument_id);
    
    $first_article_link = get_permalink($first_article_id);
    $rfd_title = $q_post['post_title'];
    $rfd_tag = $hprgument_tag->slug;
    $rfd_description = $q_post['post_content'];
    $image_id = get_post_thumbnail_id($hprgument_id);
    $image_array = wp_get_attachment_image_src($image_id);
    $piclink = $image_array[0];
    $arr = array("first-article-link"=>$first_article_link, "piclink"=>$piclink, "rfd-title"=>$rfd_title, "rfd-tag"=>$rfd_tag, "discussion-link"=>$discussion_link, "rfd-description"=>$rfd_description);
    
}

?>

<?php get_header(); ?>

  <div class="single">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Main article -->
<div id="singlepostwide">
	<span class="singledate">
	<?
		$categories = get_the_category();
		if($categories){
		foreach($categories as $category) 
		{
			echo '<a class="singlecat" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>';
			break;
		}
		}
	?>
	| <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>
	</span> 
  <h1 class="singletitle"> <a href="<?php the_permalink() ?>" rel="bookmark" 
                title="Permanent Link to <?php the_title_attribute(); ?>">
  <?php the_title(); ?></a></h1>

  <span class="singleauthor">
    By <?php if(function_exists('coauthors_posts_links')){
      coauthors_posts_links();}
    else{
      the_author_posts_link();} ?>
  </span>
	<? if( current_user_can( 'edit_posts' ) ) { ?>
	<span class="singleedit">
		  <?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?>
	</span>
	<? } ?>
			
  <div class="entry">
    <?php the_content(); ?>
  </div>
<!-- **** c/p disqus code **** -->
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'hpronline'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
<!-- **** end c/p disqus code **** -->

<?php endwhile; endif; wp_reset_query(); ?>

  </div> <!-- /.post -->

<?php get_footer(); ?>