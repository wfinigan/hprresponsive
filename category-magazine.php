<?php 
	get_header(); 

	// Get the slug of this magazine.
	// It will be of the form magazine-season-year.
	$cat = get_query_var('cat');
	$magcat = get_category($cat);
	$magcatslug = $magcat->slug;
  
?>

<div id="main">
  
  <div id='mag_wrapper'>
    <div id='mag_title' style="background-image: url('<? echo "http://www.harvardpolitics.com/blog/wp-content/mag-background/".$magcatslug.".jpg"; ?>')">
        <div id='mag_title_date'><? echo nice_date_from_slug($magcatslug); ?></div>
        <div id='mag_title_text'><? echo category_name_from_slug($magcatslug); ?></div>
        <div id='editors_note' align='center'>
	    <? 	
		generate_concise_magazine_posts($magcatslug, "editors-note"); 
	    ?>
        </div>
    </div>
        
      <? 

      $sections = Array("covers", "united-states", "world", "books-arts", "harvard", "interviews", "humor", "endpapers");
      
      foreach ($sections as $section)
      	generate_magazine_posts($magcatslug, $section);
      
      ?>
  </div>

</div>

<?php get_footer(); ?>