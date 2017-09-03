<?php

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
    $image_array = wp_get_attachment_image_src($image_id, array(300,300));
    $piclink = $image_array[0];
    $arr = array("first-article-link"=>$first_article_link, "piclink"=>$piclink, "rfd-title"=>$rfd_title, "rfd-tag"=>$rfd_tag, "discussion-link"=>$discussion_link, "rfd-description"=>$rfd_description);
    
}

?>

<?php get_header(); ?>

<div class="single">

	<div class="meta">
		<?php if ($wpzoom_singlepost_cat == 'Show') { ?>
		<?php the_category(', ') ?><?php } ?> &mdash; 
		<?php if ($wpzoom_singlepost_date == 'Show') { ?>
		<?php the_time("$dateformat $timeformat"); ?><?php } ?>

		<span>
		<?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?>
		</span> 
	</div>

    <h1> <a href="<?php the_permalink() ?>" rel="bookmark" 
            title="Permanent Link to <?php the_title_attribute(); ?>">
    <?php the_title(); ?></a> 
    </h1>
    <div>
    	<? 
    	dd_fblike_generate('Like Button Count');
    	dd_twitter_generate('Compact','harvardpolitics'); 
    	
    	?> 
    </div>
    
    <div class="rfd-left">
      <h3>Introduction</h3>
      <img width="300px" src=<?php echo($arr["piclink"]);?> >
      <p><?php echo($arr["rfd-description"]);?></p>
      <br>
      <a class="discussion-link" href="<?php echo($arr['first-article-link']);?>" >
        Read the Discussion
      </a>
    </div>

    
    <div class="main-authors">
      <h3>Contributors</h3>
      <ul>
        <?php 
          query_posts('posts_per_page=-1&cat=4251&tag='.$arr["rfd-tag"]);
          while (have_posts()) : the_post();
        ?>
        <li class="blocks"> 
          <?php 
          	$img_url = get_avatar_url(get_avatar( get_the_author_id()));
          	
          	if ($img_url)
        		generate_nice_cropped_img_from_url($img_url, 75, 75, 'author-photo');
        	else
        		generate_nice_cropped_img_from_url("http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536", 75, 75, 'author-photo');
          ?>
          <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
          <?php the_title(); ?></a></h4>
				
          <span class="main-authors-author">By 
            <?php if(function_exists('coauthors_posts_links')){
              coauthors_posts_links();}
            else{
              the_author_posts_link();} ?>
          </span>
          <br>

          <div class="excerpt">
            <p><?php the_excerpt(); ?></p>
          </div>
        </li> 
        <?php endwhile; ?>
      </ul>
  	</div> <!-- end main authors -->

</div> <!-- /.post -->

<!-- Set the blocks to the height of the tallest one -->
<script>
	$(document).ready(function() {
		
		var maxHeight = 0;
		
		$('.blocks').each(function(){
		   maxHeight = $(this).height() > maxHeight ? $(this).height() : maxHeight;
		});
		
		$('.blocks').height(maxHeight);
	});
</script>
<?php get_footer(); ?>