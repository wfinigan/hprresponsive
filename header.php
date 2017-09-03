<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? wp_title(); ?></title>

    <?
		// Required for popular posts hook.
		wp_head();
	?>

    <!-- HPR Stylesheet -->
    <link rel="shortcut icon" href="http://harvardpolitics.com/favicon.png" type="image/x-icon" />
  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

	<!-- Google analytics tracking code -->
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-8260251-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

</head>
<body>
<!-- container = all homepage content. 985px wide. -->
<div id="container">

  <!-- longad -->
	<!-- <div id="longad">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
		<!-- Leaderboard #2 -->
		<!-- <ins class="adsbygoogle"
			 style="display:inline-block;width:728px;height:90px"
			 data-ad-client="ca-pub-3400480658110397"
			 data-ad-slot="4320807475"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div> -->
	<!-- End longad. -->


	<!-- header = Nav menus and title. -->
	<div id="header">

		<!-- titlerow = site title, latest posts. -->
		<div id="titlerow">

			<div id="title">
				<a class="title-link" href="http://harvardpolitics.com">
         <img width="80" height="56px" src="http://harvardpolitics.com/blog/wp-content/uploads/2017/04/HPR-Logo.png">
         HARVARD POLITICAL REVIEW
        </a>
			</div>

			<!-- contains search bar and social media -->
			<div id="search_and_social">

				<!-- contains search bar -->
				<div id="searchbar">
					<script>
					  (function() {
						var cx = '003308913052408506793:bxdbssecuwa';
						var gcse = document.createElement('script');
						gcse.type = 'text/javascript';
						gcse.async = true;
						gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
							'//www.google.com/cse/cse.js?cx=' + cx;
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(gcse, s);
					  })();
					</script>
					<gcse:searchbox-only></gcse:searchbox-only>


				</div>
				<!-- end search bar -->

				<!-- contains facebook like and twitter follow -->
				<div id="socialmedia">

				</div>
				<!-- end socialmedia -->

			</div>
			<!-- end search bar and social media -->

		</div>
		<!-- End titlerow. -->

		<!--sectionnavbar -->
		<div id="sectionnavbar">
      <ul>
			<li> <a class="sectionnav nav-covers" href="http://harvardpolitics.com/category/<? echo $GLOBALS['covers']['slug']; ?>">
            <? echo str_replace("the ", "", category_name_from_slug($GLOBALS['covers']['slug'])); ?> </a> </li>

			<li> <a class="sectionnav nav-us" href="http://harvardpolitics.com/category/united-states/">United States</a> </li>

      <li> <a class="sectionnav nav-world" href="http://harvardpolitics.com/category/world/">World</a> </li>

			<li> <a class="sectionnav nav-culture" href="http://harvardpolitics.com/category/culture/">Culture</a> </li>

			<li> <a class="sectionnav nav-campus" href="http://harvardpolitics.com/category/harvard/">Campus</a> </li>

			<li> <a class="sectionnav nav-interviews" href="http://harvardpolitics.com/category/interviews">Interviews</a> </li>

			<li> <a class="sectionnav nav-media" href="http://harvardpolitics.com/category/media">Media</a> </li>

			<li> <a class="sectionnav nav-magazine"href="http://harvardpolitics.com/category/<? echo $GLOBALS['magazine']['slug']; ?>">Magazine</a> </li>

      <li> <a class="subscribe"href="http://harvardpolitics.com/">Subscribe</a> </li>

		</div>
		<!-- End sectionnavbar. -->

	</div>

	<!-- Javascript SDK for facebook -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=623995790958357";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- end Javascript SDK for facebook -->

	<!-- SDK for Twitter -->
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<!-- end SDK for Twitter -->

	<!-- World dropdown -->
	<script>

	$(document).ready(function() {

		$("#worldnav").hover(function() {
			$("#worlddropdown").show();
			}, function() {
			$("#worlddropdown").hide();
			}
		);
	});
	</script>
	<!-- End world dropdown. -->
	<!-- End header. -->
