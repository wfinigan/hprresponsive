<div id="sidebar">


	<!-- latest posts -->
	<div id="postbox">
		<?
			construct_postbox();
		?>
	</div>
	<hr \>
	<!-- end latest posts -->

   <script>
   $(document).ready(function(){
     var url ='http://harvardtalkspolitics.us2.list-manage1.com/subscribe?u=c4dbf7996ca3faec756c99b7c&id=cefff01280&MERGE0=';
     $('#dispatchsubmit').click(function() {
     	url += $('#dispatchemail').val();
     	window.location.href = url;
     });
    $("#dispatchemail").keyup(function(event){
      if(event.keyCode == 13){
        $("#dispatchsubmit").click();
      }
    });
   });
     </script>

	<!-- hpr dispatch box -->
	<div id="dispatch">
		<h1>HPR Dispatch</h1>
		<p style="font-size: 11pt">Your guide to the best political writing on Harvard's campus.</p>
		<input id='dispatchemail' type="text" placeholder="email">
		<button id='dispatchsubmit' type="submit">Subscribe Now</button>
	</div>
	<!-- end hpr dispatch -->

	<!-- first advertisement -->
	<div id="ad1">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Sidebar Middle Ad -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:300px;height:250px"
			 data-ad-client="ca-pub-3400480658110397"
			 data-ad-slot="1635783470"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<!-- end ad1 -->

	<!-- second advertisement -->
	<div id="ad2">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Sidebar Bottom -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:300px;height:250px"
			 data-ad-client="ca-pub-3400480658110397"
			 data-ad-slot="8751007073"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<!-- end ad2 -->

	<!-- javascript for postbox navigation -->
	<script>
		$('#postbox h1').on('click', function() {
			$('.selectedpostbox').addClass('unselectedpostbox');
			$('.selectedpostbox').removeClass('selectedpostbox');
			$(this).addClass('selectedpostbox');
			$(this).removeClass('unselectedpostbox');

			name_of_id = $(this).attr('id');
			$('#postbox ol').hide();
			$('#'+name_of_id+'ol').css('display', 'inline-block');

		});
	</script>
	<!-- end javascript for postbox navigation -->

</div>
