$(document).ready(function() {
    $(window).trigger('resize');
    $('.btn-fab-user').hide();
    $('.sub-fab').hide(); 
    
    var offset = $('.page-content').offset().top;
    $(window).scroll(function(){
       if($(window).scrollTop() > offset){
           $('.btn-fab-user').show(300);

       }else{
           $('.btn-fab-user').hide(200);

       }
    });
    
    $('#toggle-fab').hover(function(){
       $('.sub-fab').show(200); 
    });
    
    $('.btn-fab-user').mouseleave(function(){
       $('.sub-fab').hide(200); 
    });
});