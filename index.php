<?php get_header(); ?>
<!-- main = everything between longad and footer -->
<div id="main">

	<!-- content = slider + sections -->
	<div id="content">
		<!-- slider = sliding pic etc. -->
		<? construct_main_features(); ?>
		<!-- End slider. -->

		<!-- sectionblocks = all the sections -->
		<div id="sectionblocks">
			<div class="sectionrow">
				<div id="multimediablock" class="sectionblock">

					<?php home_category_block("media"); ?>

				</div>
				<div id="coversblock" class="sectionblock">
					<?php home_category_block($GLOBALS['covers']['slug']); ?>

				</div>
			</div>
			<div class="sectionrow">
				<div id="usblock" class="sectionblock">

					<?php home_category_block("united-states"); ?>

				</div>
				<div id="worldblock" class="sectionblock">

					<?php home_category_block("world"); ?>

				</div>
			</div>
			<div class="sectionrow">
				<div id="bablock" class="sectionblock">

					<?php home_category_block("culture"); ?>

				</div>
				<div id="campusblock" class="sectionblock">

					<?php home_category_block("harvard"); ?>

				</div>
			</div>
			<div class="sectionrow">
				<div id="popularblock" class="sectionblock">


					<?php home_category_block("humor"); ?>


				</div>
				<div id="shortlistblock" class="sectionblock">

					<?php home_category_block("interviews"); ?>

				</div>
			</div>
		</div>
		<!-- End sectionblocks. -->


	<?php get_sidebar(); ?>
 </div>

	<!-- End content. -->

</div>

<div id="delimiter"></div>

<script>

	$(document).ready(function() {

	$("#slide0").removeClass("unselectedslide");;
	$("#slide0").addClass("selectedslide");
    $("#slider_text0").removeClass("unselectedtext");;
	$("#slider_text0").addClass("selectedtext");
	$("#slider_cap0").removeClass("unselectedcap");;
	$("#slider_cap0").addClass("selectedcap");

    $('.unselectedslide').hide();
    $('.unselectedtext').hide();
    $('.unselectedcap').hide();


	var currentslide = 0;

	function toggleslide(prev,next)
	{
		if (prev == next)
			return 0;

		$("#slide"+next).width(700);
		$("#slide"+next).show();
		$("#slide"+prev).animate({
			width: 0
		  }, 2000, function() {
		  	$("#slide"+prev).hide();
		  });

		setTimeout(function()
		{
			$("#slide"+prev).removeClass("selectedslide");;
			$("#slide"+prev).addClass("unselectedslide");
			$("#slide"+next).removeClass("unselectedslide");
			$("#slide"+next).addClass("selectedslide");
		}, 2000);

		$("#slider_text"+next).show();
		$("#slider_text"+next).animate({
			opacity: 1.0
		  }, 2000, function() {
		  });
		$("#slider_text"+prev).animate({
			opacity: 0.0
			}, 2000, function() {
				$("#slider_text"+prev).hide();
		  });

		setTimeout(function()
		{
			$("#slider_text"+prev).removeClass("selectedtext");;
			$("#slider_text"+prev).addClass("unselectedtext");
			$("#slider_text"+next).removeClass("unselectedtext");
			$("#slider_text"+next).addClass("selectedtext");
		}, 2000);
	}


	function sliding()
	{
		prev = currentslide;
		currentslide = (currentslide + 1) % 6;
		$('.navselected').removeClass("navselected");
		$("#"+currentslide).addClass("navselected");
		toggleslide(prev, currentslide);
	};

	var slidingtime = setInterval(sliding, 6000);

	$('.slide').mouseover(function(){
    	clearInterval(slidingtime);
	});

	$('.slide').mouseout(function(){
    	slidingtime = setInterval(sliding, 6000);
	});

	$('.circle').click(function() {
		clearInterval(slidingtime);
		$('.navselected').removeClass("navselected");
		$(this).addClass("navselected");
		  toggleslide(currentslide, this.id);
		  currentslide = this.id;
		});
	});
</script>

<?php get_footer(); ?>
