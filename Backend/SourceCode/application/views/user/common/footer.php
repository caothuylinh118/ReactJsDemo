<!-- End Contact -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<![endif]-->
<!--[if IE 9]><!-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
<!--<![endif]-->

<script src="<?php echo base_url(); ?>asset/js/user/scripts.js"></script>
<script src="<?php echo base_url(); ?>asset/js/user/katana.js"></script>
<script src="<?php echo base_url(); ?>asset/js/user/jquery.clipthru.js"></script>
<script src="<?php echo base_url(); ?>asset/js/user/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/datepicker.min.js"></script>

<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;language=en&#038;key=AIzaSyChMUgKs4_sZTIAI_2TwtFrho8XFs2JL-8'></script>
<script>
  $(document).ready(function(){
    var owlAg = $("#clientAgency .owl-carousel");
    var owlBr = $("#clientBrand .owl-carousel");
    var owlFm = $("#clientFilm .owl-carousel");

    owlAg.owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: false
        },
        1000: {
          items: 5,
          nav: false,
          loop: true
        }
      },
      // autoplay: true,
      // autoplayTimeout: 1000,
      // autoplayHoverPause: true
    });

    owlBr.owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: false
        },
        1000: {
          items: 5,
          nav: false,
          loop: true
        }
      },
      // autoplay: true,
      // autoplayTimeout: 1000,
      // autoplayHoverPause: true
    });

    owlFm.owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: false
        },
        1000: {
          items: 5,
          nav: false,
          loop: true
        }
      },
      // autoplay: true,
      // autoplayTimeout: 1000,
      // autoplayHoverPause: true
    });


    $('#agencyRight').click(function() {
      owlAg.trigger('next.owl.carousel');
    })
    $('#agencyLeft').click(function() {
      owlAg.trigger('prev.owl.carousel', [300]);
    })

    $('#brandRight').click(function() {
      owlBr.trigger('next.owl.carousel');
    })
    $('#brandLeft').click(function() {
      owlBr.trigger('prev.owl.carousel', [300]);
    })

    $('#filmRight').click(function() {
      owlFm.trigger('next.owl.carousel');
    })
    $('#filmLeft').click(function() {
      owlFm.trigger('prev.owl.carousel', [300]);
    })

    window.smoothScroll = function(target) {
      var scrollContainer = target;
    do { //find scroll container
      scrollContainer = scrollContainer.parentNode;
      if (!scrollContainer) return;
      scrollContainer.scrollTop += 1;
    } while (scrollContainer.scrollTop == 0);

    var targetY = 0;
    do { //find the top of target relatively to the container
      if (target == scrollContainer) break;
      targetY += target.offsetTop;
    } while (target = target.offsetParent);

    scroll = function(c, a, b, i) {
      i++; if (i > 30) return;
      c.scrollTop = a + (b - a) / 30 * i;
      setTimeout(function(){ scroll(c, a, b, i); }, 20);
    }
    // start scrolling
    scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
    }


      $('.movie_poster_slide').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll:1
          }
        }]
      });

      // Hover Change Image --------------------
      var index = 1;
      var ti;
      function changeImageHover () {
        ti = setTimeout(changeImageHover, 1000);
        $('#img_hover').attr('src','assets/img/work_photo/' + index + '.jpg');
        index++;
        if (index>20){
          index = 1;
        }
      }
      function stopImageHover() { // to be called when you want to stop the timer
        clearTimeout(ti);
      }
});

</script>
<script>
  $(document).ready(function() {
    // $('.where_select').select2({
    //   placeholder: 'Select an option',
    //   minimumResultsForSearch: Infinity
    // });
    $('[data-toggle="start_date"]').datepicker({
      autoHide: true,
      zIndex: 999999999,
    });
  });
</script>

</body>
</html>
