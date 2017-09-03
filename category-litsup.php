<?php 
	get_header(); 

	// Get the slug of this litsup.
	// It will be of the form lit-supplement-year.
	$cat = get_query_var('cat');
	$litsupcat = get_category($cat);
	$litsupcatslug = $litsupcat->slug;
  
?>

<div id="main">
  
  <div id='litsup_wrapper'>
    <div id='litsup_title' style="background-image: url('<? echo mag_cover_from_slug($litsupcatslug); ?>')">
    	<div id='litsup_title_box' style="background-color: #d12127; padding-top: 0.5em; padding-bottom: 0.5em;">
        	<div id='litsup_title_date' > <p style='background-color: #d12127; margin-top: 0em; margin-bottom: 0em;'> <? echo "Literary Supplement ".nice_year_from_slug($litsupcatslug); ?> </p> </div>
        	<div id='litsup_title_text' > <p style='background-color: #d12127; margin-top: 0em; margin-bottom: 0em;'> <? echo category_name_from_slug($litsupcatslug); ?></p> </div>
        </div>
        <div id='editors_note' align='center'>
            <?
            	generate_concise_magazine_posts($litsupcatslug, "editors-note");
            ?>
        </div>
        <div id='editors_note' align='center'>
	    <? 	
		generate_concise_magazine_posts($litsupcatslug, "editors-note-litsup"); 
	    ?>
        </div>
    </div>
        
      <? 
      $chapters = $GLOBALS['chapters'];
      
      for ($i = 1; $i <= $chapters; $i++) {
      	      generate_litsup_posts($litsupcatslug, "chapter-".$i."-".nice_year_from_slug($litsupcatslug), $i);
      }
      
      ?>
      <!--<div class='litsup_cat_ttl' style='margin-bottom: 0px;'>
      	<p align='center' style='margin-top: 0px; margin-bottom: 0px;'> Coming next: Lexicon of War. </p>
      </div>
      <div class='litsup_cat_date' style='margin-top: 0px;'>
      	February 23.
      </div>-->
      
   </div>

</div>

<?php get_footer(); ?>