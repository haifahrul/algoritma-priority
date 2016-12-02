	function affixChange() {
			$('#nav').affix({
						offset: {
							top: $('header').height()-$('#nav').height()
						}
			}); 
			$('body').scrollspy({ target: '#nav' })
			$('.scroll-top').click(function(){
				$('body,html').animate({scrollTop:0},1000);
			})

			$('#nav .navbar-nav li>a').click(function(){
				var link = $(this).attr('href');
				var posi = $(link).offset().top;
				$('body,html').animate({scrollTop:posi},700);
			});
	}

$( document ).ready(function() {
	// affixChange()	
	// open dropdwon
	 $(function(){
			$(".dropdown").hover(            
				function() {
						$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
					 // $(this).toggleClass('open');
						//$('b', this).toggleClass("caret caret-up");                
				},
				function() {
						$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
						// $(this).toggleClass('open');
						// $('b', this).toggleClass("caret caret-up");                
				});
		});

	 /* To initialize BS3 tooltips set this below */
		$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
		});;
		/* To initialize BS3 popovers set this below */
		$(function () { 
				$("[data-toggle='popover']").popover(); 
		});			
});

$(window).resize(function() {
  // affixChange();
});

