  $(document).ready(function () {

      $(window).scroll(function () {
          if ($(this).scrollTop() > 200) {
              $('.scrollup').fadeIn();
          } else {
              $('.scrollup').fadeOut();
          }
      });

      $('.back-to-top-link').click(function () {
          $("html, body").animate({
              scrollTop: 0
          }, 1000);
          return false;
      });

  });