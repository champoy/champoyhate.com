$(window).load(function(){			

		$("a[rel^='prettyPhoto']").prettyPhoto();
		$(".gallery-item a").prettyPhoto();
		$("#sub-sidebar .social a").tipsy({gravity: 's', fade: true});
		$(".tipsy").tipsy({gravity: 's', fade: true});

		Cufon.replace('ul.navigation li a', {
			hover: true
		});
		
		Cufon.replace('h1, h2, h3, h4, h5, h6, .vcard, .widget_tag_cloud a, .taxonomy a');
		
		$('.navigation>li').hover(function(){
			$(this).find('ul').slideDown(function(){ 
			 	Cufon.refresh('ul.navigation li');
			});
		}, 
  		function () {
  			$(this).find('ul').stop(true, true).slideUp(function(){
  				Cufon.refresh('ul.navigation li');
  			});
  		});
		
		$("#grid-content").vgrid({
		    easeing: "easeOutQuint",
		    time: 400,
		    delay: 20,
		    fadeIn: {
		    	time: 500,
		    	delay: 50
		    }
		});
		
		var hsort_flg = false;
		$("#hsort").click(function(e){
			hsort_flg = !hsort_flg;
			$("#grid-content").vgsort(function(a, b){
				var _a = $(a).find('div').text();
				var _b = $(b).find('div').text();
				var _c = hsort_flg ? 1 : -1 ;
				return (_a > _b) ? _c * -1 : _c ;
			}, "easeInOutExpo", 300, 0);
			return false;
		});
	
		$("#rsort").click(function(e){
			$("#grid-content").vgsort(function(a, b){
				return Math.random() > 0.5 ? 1 : -1 ;
			}, "easeOutQuint", 300, 50);
			return false;
		});		


});