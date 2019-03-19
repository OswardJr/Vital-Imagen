$(document).ready(function() {
    $(window).trigger('resize');
    $('.btn-fab-user').hide();
    $('.sub-fab').hide(); 
    $('.side-menu>.submenu-content>.submenu').hide();
    
    var offset = $('.page-content').offset().top;
    $(window).scroll(function(){
       if($(window).scrollTop() > offset){
           $('.btn-fab-user').show(300);

       }else{
           $('.btn-fab-user').hide(200);

       }
    });
    
    $('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
    
    $('#toggle-fab').click(function(){
       $('.sub-fab').toggle(200); 
    });
    
    $('.btn-fab-user').mouseleave(function(){
       $('.sub-fab').hide(200); 
    });
    
    $('.side-menu>.submenu-content').click(function(){
        if($('.side-menu>.submenu-content>.submenu-open').length == '1'){
            if($(this).children('ul').hasClass('submenu-open')){
                $(this).children('.submenu-open').slideUp(); 
                $(this).children('.submenu').removeClass('submenu-open');
            }else{
                $('.submenu-content>.submenu-open').slideUp();
                $('.submenu-content>.submenu-open').removeClass('submenu-open');
                $(this).children('.submenu').addClass('submenu-open');
                $(this).children('.submenu-open').slideDown(); 
            }
        }else{
            $(this).children('.submenu').toggleClass('submenu-open');
            $(this).children('.submenu-open').slideToggle();   
        }
    });
});