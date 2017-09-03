<?php

	// CHANGE COVERS, MAGAZINE, AND LITSUP HERE!!
	global $covers;
	global $magazine;
	global $litsup;
	global $chapters;
	$covers['slug'] = 'covers-spring-2017'; // The current covers category
	$magazine['slug'] = 'magazine-fall-2016'; // The current magazine category
	$litsup['slug'] = 'lit-supplement-2015'; // The current lit supp category
	$chapters = 3; //the current number of chapters

	add_theme_support( 'post-thumbnails' );

	// This makes sure that HPRgument main pages redirect to single-hprgument.php
	add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
	);

	// Helper function for the function below.
	function load_mag_helper($cat_slug)
	{
		$exploded = explode("-", $cat_slug);
		$mag_exploded = explode("-", $GLOBALS['magazine']['slug']);

		if (count($exploded) != 3)
			return false;

		if ($exploded[0] != "magazine")
			return false;

		$mag_year = $mag_exploded[2];


		if ($mag_exploded[2] < $exploded[2])
			return false;

		$seasons = Array('spring', 'summer', 'fall', 'winter');

		if ($mag_exploded[2] == $exploded[2] && array_search($mag_exploded[1], $seasons) < array_search($exploded[1], $seasons))
			return false;

		return true;

	}

	// Helper function for litsup purposes
	function load_litsup_helper($cat_slug)
	{
		$exploded = explode("-", $cat_slug);
		$mag_exploded = explode("-", $GLOBALS['litsup']['slug']);

		if (count($exploded) != 3)
			return false;

		if ($exploded[0] != "lit")
			return false;

		if ($exploded[1] != "supplement")
			return false;

		$mag_year = $mag_exploded[2];

		if ($mag_exploded[2] < $exploded[2])
			return false;

		return true;
	}

	// Force magazine sections to use category-magazine.php and litsup sections to use category-litsup.php
	function load_magazine_template($template)
	{

		$cat_ID = absint( get_query_var('cat') );
		$category = get_category( $cat_ID );

		$templates = array();

		if (load_mag_helper($category->slug))
			$templates[] = "category-magazine.php";

		if (load_litsup_helper($category->slug))
			$templates[] = "category-litsup.php";

		$templates[] = "category-$cat_ID.php";

		$templates[] = "category.php";
		$template = locate_template($templates);

		return $template;
	}
	add_action('category_template', 'load_magazine_template');

	// Get the hex code given a category slug
	function category_color($slug)
	{
		switch($slug)
		{
			case "united-states":
			return "#3C4D7F";
			break;

			case "world":
			return "#21591A";
			break;

			case "books-arts":
			return "#DD654F";
			break;

			case "harvard":
			return "#D7373D";
			break;

			case "interviews":
			return "#8965B7";
			break;

			case "arusa":
			return "#000066";
			break;

			case "media":
			return "#DAB920";
			break;

			default:
			return "#942415";
			break;

		}
	}

	function generate_author_string($author_array)
	{
		$numauthors = count($author_array);
		$author_string = '';
		foreach($author_array as $author)
		{
			$author_string .= $author->display_name;
			if ($numauthors > 2)
				$author_string .= ', ';
			elseif ($numauthors == 2)
				$author_string .= ' and ';
			else
				$author_string .= '';
			$numauthors--;
		}
		return $author_string;
	}

	function category_name_from_slug($slug)
	{
		$cat = get_category_by_slug($slug);
		return $cat->name;
	}

	function tag_name_from_slug($slug)
	{
		$tag = get_term_by('slug', $slug, 'post_tag');
		return $tag->name;
	}

	function nice_date_from_slug($slug)
	{
		$seasons = Array('Spring', 'Summer', 'Fall', 'Winter');
		$exploded = explode("-", $slug);
		if (count($exploded) == 3)
		{
			$season = ucfirst($exploded[1]);
			$year = $exploded[2];
			if (in_array($season, $seasons) && is_numeric($year))
			{
				return $season." ".$year;
			}
		}

		return "Unknown quarter";
	}

	function nice_year_from_slug($slug)
	{
		$exploded = explode("-", $slug);
		return $exploded[2];
	}

	function category_desc_from_slug($slug)
	{
		$cat = get_category_by_slug($slug);
		return $cat->description;
	}

	function mag_cover_from_slug($slug)
	{
		$cat = get_category_by_slug($slug);
		return z_taxonomy_image_url($cat->term_id);
	}

	// Generates an image with given dimensions, cropped around center.
	// Logic based on this: http://stackoverflow.com/questions/11552380/how-to-automatically-crop-and-center-an-image
	// The class parameter is so you can add additional CSS to the image without modifying this function.
	function generate_nice_cropped_img_from_url($img_url, $width, $height, $class='cropped_image')
	{
		$style .= 'width: '.$width.'%; ';
		// $style .= 'height: '.$height.'%; ';
		$style .= 'background-size: cover; background-position: center center; background-repeat: no-repeat; ';

		echo '<img';
		echo ' src="'.$img_url.'"';
		echo ' style="'.$style.'"';
		echo ' class="'.$class.'">';
	}

	// Generates a post thumbnail with given dimensions, cropped around center.
	function generate_nice_cropped_img($post_id, $width, $height, $class='cropped_image')
	{
		$thumbnail_id = get_post_thumbnail_id($post_id);
		if ($thumbnail_id)
		{
			$img_arr = wp_get_attachment_image_src($thumbnail_id, 'large');
			generate_nice_cropped_img_from_url($img_arr[0], $width, $height, $class);
		}
		else
		{
			$img = first_post_image($thumbnail_id);
			generate_nice_cropped_img_from_url($img, $width, $height, $class);
		}
	}

	// To deal with author photo problems
//	function get_avatar_url($get_avatar)
//	{
//		//echo $get_avatar;
//    	preg_match('/src="(.*?)"/i', $get_avatar, $matches);
//   	 	return $matches[1];
//   	}


	    // Get first image from post.
	function first_post_image($post_id) {
		$first_img = '';
		$content_post = get_post($post_id);
		$content = $content_post->post_content;
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches, PREG_SET_ORDER);
		$first_img = $matches [0] [1];
		if(empty($first_img)){
			$first_img = get_bloginfo('template_url').'/img/default.jpg';
		}
		return $first_img;
	}

	// Given a category slug
	function home_category_block($slug)
	{
		$category = get_category_by_slug( $slug );
		if ($category)
		{
			$name = $category->cat_name;
			if ($name == "Harvard")
				$name = "Campus";
			echo '<h1><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "%s" ), $category->name ) ) . '">'.$name.'</a></h1>';
			echo '<hr style="background-color: '.category_color($slug).';">';

 			// Get the most recent three posts in the category
			$args = array( 'posts_per_page' => 3, 'category' => $category->term_id );
			$myposts = get_posts($args);

			$count = 0;

			global $post;
			foreach ( $myposts as $post )
			{
				setup_postdata( $post );
				if ($count == 0)
				{
					echo '<a href="';
					the_permalink();
					echo '">';

					generate_nice_cropped_img(get_the_ID(), 100, 162, 'cat_box_img');

					echo '</a><h2><a href="';
					the_permalink();
					echo '">';
					the_title();
					echo '</a></h2><h3>';
					the_author_posts_link();
					echo ' | ';
					the_time("F j, Y");
					echo '</h3><hr \>';
					$count++;
				}

				elseif ($count == 1)
				{
					echo '<ul><li><a href="';
					the_permalink();
					echo '">';
					the_title();
					echo '</a></li><hr \>';
					$count++;
				}

				else
				{
					echo '<li><a href="';
					the_permalink();
					echo '">';
					the_title();
					echo '</a></li>';
				}
			}
			echo "</ul>";
			wp_reset_postdata();
		}
	}


	function construct_main_features ()
	{
		$args = array( 'posts_per_page' => 3, 'tag' => "featured" );
		$myposts = get_posts($args);
		if ($myposts)
		{
			$mypostarr = Array();
			global $post;
			foreach ($myposts as $post)
			{
				setup_postdata($post);
				// Deal with coauthors
				$author_string = generate_author_string(get_coauthors());
				array_push($mypostarr, Array(get_the_ID(), get_the_title(), get_permalink(), $author_string, get_the_excerpt(), get_the_date("F j, Y")));
			}
			echo '<div id="featured">';
			$count = 0;
			foreach ($mypostarr as $p) {
				if ($count == 0) {
					echo '<div id="featured_main">';
					echo '<a class="featured_main_img" href="'.$p[2].'">';
					generate_nice_cropped_img($p[0], 100, 267, 'featured_thumbnail');
					echo '</a></div>';
					echo '<div class="featured_main_text">';
					echo '<a href="'.$p[2].'">';
					echo '<h2>'.$p[1].'</h2></a>';
					echo '<div class="item-desc"><p>'.$p[4].'</p></div>';
					echo '<h3>'.$p[3].' | '.$p[5].'</h3>';
					echo '</div></div>';
					echo '<div class="clearfix"></div><hr><div class="featured_row">';
					$count++;
				}
				else {
					echo '<div class="featured_main_sm"> <div class="featured_main_sm_img';
					echo '<a href="'.$p[2].'">';
					generate_nice_cropped_img($p[0], 100, 267, 'featured_thumbnail');
					echo '</a></div>';
					echo '<div class="featured_main_sm_text">';
					echo '<a href="'.$p[2].'">';
					echo '<h2>'.$p[1].'</h2></a>';
					echo '<p>'.$p[4].'</p>';
					echo '<h3>'.$p[3].' | '.$p[5].'</h3>';
					echo '</div></div>';
					$count++;
				}
			}
			echo '</div>';
			//
			// $count = 0;
			// foreach($mypostarr as $p)
			// {
			// 	echo '<div id="slider_text'.$count.'" class="slider_text unselectedtext">';
			// 	echo '<a href="'.$p[2].'">';
			// 	echo '<h2>'.$p[1].'</h2></a>';
			// 	echo '<p>'.$p[4].'</p>';
			// 	echo '<h3>'.$p[3].' | '.$p[5].'</h3>';
			// 	echo '</div>';
			// 	$count++;
			// }
			//
			// echo '</div></div><div id="slider_nav"><div class="circle navselected" id="0"></div><div class="circle" id="1"></div><div class="circle" id="2"></div><div class="circle" id="3"></div><div class="circle" id="4"></div><div class="circle" id="5"></div></div>';
			// echo '</div>';
			//
			// wp_reset_postdata();
		}
	}


	function construct_postbox()
	{
		$totalposts = 10;

		// popular posts
        echo "<div class='postbox-section postbox-section--popular'>";
		echo "<h1 class='postbox-title postbox-title--popular'>Popular</h1>";
		echo "<hr />";
		wpp_get_mostpopular("wpp_start='<ol class=\"postbox-list postbox-list--popular\">'&wpp_end='</ol>'&post_html='<li class=\"postbox-post postbox-post--popular\"><a href=\"{url}\">{text_title}</a></li>'&post_type='post'&order_by='views'&range='monthly'&freshness=1");
		echo "</div>";

		// recent posts
        echo "<div class='postbox-section postbox-section--recent'>";
		echo "<ol class='postbox-list postbox-list--recent'>";
		echo "<h1 class='postbox-title postbox-title--recent'>Recent</h1>";
		echo "<hr />";

		$mypostarr = Array();

		$args = array( 'posts_per_page' => $totalposts);
		$myposts = get_posts( $args );

		global $post;
		foreach ($myposts as $post)
		{
			setup_postdata($post);
			array_push($mypostarr, Array(get_the_title(), get_the_ID()));
		}

		$count = 0;
		foreach($mypostarr as $p)
		{
			echo '<li class="postbox-post postbox-post--recent"><a href="?p='.$p[1].'">';
			echo $p[0];
			echo '</a></li>';
			$count++;
		}
		wp_reset_postdata();

		echo "</ol>";
        echo "</div>";
	}

	function generate_magazine_posts($mag_cat_slug, $section_cat_slug)
	{
		$mag_cat = get_category_by_slug($mag_cat_slug);
		$mag_cat_ID = $mag_cat->term_id;

		$section_cat = get_category_by_slug($section_cat_slug);
		$section_cat_name = $section_cat->name;
		$section_cat_ID = $section_cat->term_id;


		query_posts(array('category__and'=>array($mag_cat_ID, $section_cat_ID)));

		if ( have_posts() ) {

		echo "<div class='mag_cat'>";
		echo "<div class='mag_cat_ttl' align='center'><p class='mag_box_".$section_cat_slug."' style='padding-left: 0.5em; padding-right: 0.5em;'>".$section_cat_name."</p></div>";
		echo "<div class='mag_art_list'>";

		while ( have_posts() ) : the_post();

					echo "<div class='mag_art'>";
						generate_nice_cropped_img(get_the_ID(), 100, 200, "mag_art_img");
						echo "<div class='mag_art_text'>";
							echo "<div class='mag_art_ttl'><a href='";
								the_permalink();
								echo "' rel='bookmark'>";
								the_title();
							echo "</a></div>";
							echo "<div class='mag_art_auth'>";
								the_author_posts_link();
							echo "</div>";
						echo "</div>";
					echo "</div>";

			endwhile;


		echo "<hr class='mag_line' size='1'>";
		echo "</div></div>";
		}

		wp_reset_query();
	}

	function generate_litsup_posts($litsup_cat_slug, $section_cat_slug, $n)
	{
		$litsup_cat = get_category_by_slug($litsup_cat_slug);
		$litsup_cat_ID = $litsup_cat->term_id;

		$section_cat = get_category_by_slug($section_cat_slug);
		$section_cat_name = $section_cat->name;
		$section_cat_ID = $section_cat->term_id;


		query_posts(array('category__and'=>array($litsup_cat_ID, $section_cat_ID)));

		if ( have_posts() ) {

			while (have_posts()) : the_post();

				echo "<div class='litsup_cat'>";
				echo "<div class='litsup_cat_head'>";
				echo "<div class='litsup_cat_num'> Chapter ".$n.": </div>";
				echo "<div class='litsup_cat_ttl'>".$section_cat_name."</div>";
				echo "</div>";
				echo "<div class='litsup_cat_date'> Published ";
				the_date("F j, Y");
				echo "</div>";
				echo "<div class='mag_art_list'>";
				break;
			endwhile;
		}

		rewind_posts();

		if (have_posts()) {

			while ( have_posts() ) : the_post();

					echo "<div class='mag_art'>";
						generate_nice_cropped_img(get_the_ID(), 100, 200, "mag_art_img");
						echo "<div class='mag_art_text'>";
							echo "<div class='mag_art_ttl'><a href='";
								the_permalink();
								echo "' rel='bookmark'>";
								the_title();
							echo "</a></div>";
							echo "<div class='mag_art_auth'>";
								the_author_posts_link();
							echo "</div>";
						echo "</div>";
					echo "</div>";

			endwhile;

			echo "<hr class='mag_line' size='1'>";
			echo "</div> </div>";
		}

		wp_reset_query();
	}

	function generate_concise_magazine_posts($mag_cat_slug, $section_cat_slug)
	{
		$mag_cat = get_category_by_slug($mag_cat_slug);
		$mag_cat_ID = $mag_cat->term_id;

		$section_cat = get_category_by_slug($section_cat_slug);
		$section_cat_name = $section_cat->name;
		$section_cat_ID = $section_cat->term_id;


		query_posts(array('category__and'=>array($mag_cat_ID, $section_cat_ID),'showposts'=>1));

		if ( have_posts() ) {

			while ( have_posts() ) : the_post();

					echo "<a id='editors_note' href='";
					the_permalink();
					echo "' rel='bookmark'>";
					echo $section_cat_name;
					echo "</a>";

			endwhile;
			echo "</h3>";
			wp_reset_query();
			return true;
		}

		wp_reset_query();
		return false;
	}

	function generate_hprgument_sidebar($hprgument_tag)
	{

		$post_array = get_objects_in_term($hprgument_tag->term_id, 'post_tag', array('asc'));

		$hprgument_id = $post_array[0];
		foreach ($post_array as $pid)
		{
			if (!in_category("hprgument-posts", $pid))
			{
				$hprgument_id= $pid;
				break;
			}
		}

		$q_post = get_post($hprgument_id, ARRAY_A);

		$discussion_link = get_permalink($hprgument_id);

		$rfd_title = $q_post['post_title'];
		$rfd_tag = $hprgument_tag->slug;
		$rfd_description = $q_post['post_content'];
		$image_id = get_post_thumbnail_id($hprgument_id);
		$image_array = wp_get_attachment_image_src($image_id, array(300,300));
		$piclink = $image_array[0];



		echo '<div class="rfd-left">';
		echo '<h3>Introduction</h3>';
		echo '<img width="300px" src="'.$piclink.'">';
		echo '<p>'.$rfd_description.'</p>';
		echo '<h3>Contributors</h3>';
		echo '<div id="hprgument-contributors">';
		echo '  <ul>';

		query_posts('posts_per_page=-1&cat=4251&tag='.$rfd_tag);
		while (have_posts()) : the_post();
			echo '<li>';
			$img_url = get_avatar_url(get_avatar( get_the_author_id()));
			if ($img_url)
				generate_nice_cropped_img_from_url($img_url, 75, 75, 'author-photo');
			else
				generate_nice_cropped_img_from_url("http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536", 75, 75, 'author-photo');
			echo '<h4><a href="';
			the_permalink();
			echo '" title="';
			the_title();
			echo '">';
			the_title();
			echo '</a></h4>';
			echo '<span class="main-authors-author">By ';
			if(function_exists('coauthors_posts_links'))
				coauthors_posts_links();
			else
				the_author_posts_link();
			echo '</span><br></li>';
			endwhile;
		echo '</ul></div> <!-- end main authors --></div>';

		wp_reset_query();

 	}

 	function generate_issue_thumbnail($year, $quarter)
 	{
 		$slug = "covers-".$quarter."-".$year;
 		echo "<a href='http://harvardpolitics.com/category/".$slug."'>";
 		echo "<img class='mag_img' src='";
 		echo mag_cover_from_slug($slug);
 		echo "'></a>";
 	}

 	function generate_past_issues()
 	{
 		echo "<div id='mag_imgs'>";
        echo "<div class='mag_img_row'>";
        $count = 0;
        $seasons = Array(0 => "spring", 1 => "summer", 2 => "fall", 3 => "winter");

        $exploded = explode("-", $GLOBALS['magazine']['slug']);
		$year = $exploded[2];
		$season = array_search($exploded[1], $seasons);

        while ($year > 2008)
        {
        	if ($season < 0)
        		$season = 3;

        	while ($season >= 0)
        	{
				$count++;

				generate_issue_thumbnail($year, $seasons[$season]);

				if ($count % 2 == 0)
				{
					echo "</div>";
					echo "<div class='mag_img_row'>";
				}
				$season--;
			}

			$year--;
		}

        echo "</div>";
      	echo "</div>";
 	}

?>
