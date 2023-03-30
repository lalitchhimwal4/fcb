  $(".table-responsive").mCustomScrollbar({
  axis:"x"
  });

  window.scroll({
    behavior: 'smooth'
  });
    //   navbar-fixed JS Start
    $(window).scroll(function () {
       // console.log($(window).scrollTop())
       var scrollHeight = $(".top-header").height();
        if ($(window).scrollTop() > scrollHeight) {
        var topHeight = $(".top-header").height();
        $('header1').css({'transform' : 'translateY(-' + topHeight +'px)'});
        }
        else{
        $('header').css({'transform' : ''}); 
        }
    });
    //   navbar-fixed JS End

    // back-to-top button JS Start 
    var btn = $('#button');
    $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
    // back-to-top button JS End 

    // Add class in header Start  
    $(document).ready(d=function(){
        $('.navbar-toggler').click(function(){
            $('header').toggleClass('header-bg');
          });
    });
    // Add class in header End  

    // Tooltip JS 
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
    // Tooltip JS End
    
    // Counter JS Start 
    $(document).ready(function($) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
    // Counter JS Start 

    //   magnific-popup JS Start 
    $(document).ready(function() {
        $('.popup-btn').magnificPopup({
            type: 'iframe'
        });
    });
    //   magnific-popup JS End 


    //member header banner height
     $(document).ready(function(){ 
     $( window ).on("resize", function() {
      var heightCs = $("header").height();       
       $(".main-page-wrap").css("margin-top",heightCs);
       $(".main-div").css("margin-top",heightCs);
    });
   });

     $(document).ready(function(){ 
     $( window ).on("load", function() { 
      var heightCs = $("header").height();
       $(".main-page-wrap").css("margin-top",heightCs);
       $(".main-div").css("margin-top",heightCs);

    });
   });
     


