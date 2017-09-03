function scrollTo(element, to, duration) {
    var start = element.scrollTop,
        change = to - start,
        currentTime = 0,
        increment = 20;
        
    var animateScroll = function(){ 
        currentTime += increment;
        var val = Math.easeInOutQuad(currentTime, start, change, duration);
        element.scrollTop = val;
        if(currentTime < duration) {
            setTimeout(animateScroll, increment);
        }
    };
    animateScroll();
}

Math.easeInOutQuad = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t + b;
	t--;
	return -c/2 * (t*(t-2) - 1) + b;
};

$(document).ready(function() {

	$('.sec1but').on("click", function() {
		scrollTo(document.body, $('#sec1').offset().top, 1250);
	});
	$('.sec2but').on("click", function() {
		scrollTo(document.body, $('#sec2').offset().top, 1250);
	});
	$('.sec3but').on("click", function() {
		scrollTo(document.body, $('#sec3').offset().top, 1250);
	});
	
	$('.sec4but').on("click", function() {
		scrollTo(document.body, $('#sec4').offset().top, 1250);
	});
	
	$('.sec5but').on("click", function() {
		scrollTo(document.body, $('#sec5').offset().top, 1250);
	});
	
	$('.sec6but').on("click", function() {
		scrollTo(document.body, $('#sec6').offset().top, 1250);
	});
	
	$('.sec7but').on("click", function() {
		scrollTo(document.body, $('#sec7').offset().top, 1250);
	});

});	