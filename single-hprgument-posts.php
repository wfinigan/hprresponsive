<?php

$this_post_id = get_the_ID();
$posttags = get_the_tags();
$hprgument_tag = '';

if ($posttags)
{
    foreach($posttags as $tags)
    {
    	if (stristr($tags->slug, 'hprgument'))
    	{
            $hprgument_tag = $tags;
            break;
    	}
    }
}

?>

<?php get_header(); ?>
  <div class="single">
    
<? 	
	generate_hprgument_sidebar($hprgument_tag); 
	query_posts("p=".$this_post_id);
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Main article -->
<div id="singlepost">
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