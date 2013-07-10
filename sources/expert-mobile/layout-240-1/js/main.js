$(document).ready(function(){
	function setScroll(){
		var $bH = $(window).height(),
			$dH = $('#content').height();
		if($dH > $bH){
			var myScroll;
			function loaded() {
				myScroll = new iScroll('content', { scrollbarClass: 'myScrollbar' });
			}
			document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
			document.addEventListener('DOMContentLoaded', loaded, false);
		}
	}
	setScroll();
	$(window).resize(function() {
        setScroll();
    })
})