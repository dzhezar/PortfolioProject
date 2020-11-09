(function($) {
  "use strict"; // Start of use strict

  // Closes the sidebar menu
  $(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
    $(this).toggleClass("active");
  });

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      let target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        if (window.screen.width > 992) {
          $('html, body').stop().animate({
            'scrollTop': target.offset().top - 20
          }, 500, 'swing', function() {
            window.location.hash = target.selector;
          });
        }
        else {
          $('html, body').stop().animate({
            'scrollTop': target.offset().top
          }, 500, 'swing', function() {
            window.location.hash = target.selector;
          });
        }
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('#sidebar-wrapper .js-scroll-trigger').click(function() {
    $("#sidebar-wrapper").removeClass("active");
    $(".menu-toggle").removeClass("active");
    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
  });

  $('.sidebar-nav-item').click(function () {
    $("#sidebar-wrapper").removeClass("active");
    $(".menu-toggle").removeClass("active");
    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
  });

  let fancybox = $("[data-fancybox]");
  if (fancybox.length) {
    fancybox.fancybox({
      buttons: ["close"],
      loop: true,
      clickContent: false,
      overlay: null
    });
  }

  //Is Posted Toggle

  //Smooth Scroll On NavBar
  $(window).scroll(function() {
    if (window.screen.width > 992) {
      var scroll = $(window).scrollTop();
      if (scroll > 200) {
        $("#main-nav, #main-nav-subpage").slideDown(500);
        $("#main-nav-subpage").removeClass('subpage-nav');
      } else {
        $("#main-nav").slideUp(500);
        $("#main-nav-subpage").hide();
        $("#main-nav-subpage").addClass('subpage-nav');
      }
  }
  });

  $('.lazy').Lazy({
    // your configuration goes here
    scrollDirection: 'vertical',
    effect: 'fadeIn',
    visibleOnly: true,
    onError: function(element) {
      console.log('error loading ' + element.data('src'));
    }
  });


  $("#page-top").click(function() {
    var div = $('#portfolio');
    if (window.screen.width > 992) {
      $('html,body').animate({scrollTop: div.offset().top + 95}, 400, 'linear');
    }
    else
      $('html,body').animate({scrollTop: div.offset().top}, 400, 'linear');
  });

  let photoshootsCounter = $('.portfolio-window').length;
  if (photoshootsCounter > 3 || window.screen.width < 769) {
    $('.footer').css('position','unset');
  }

  $('input').each(function () {
    var attr = $(this).attr('maxlength');
    if (typeof attr !== typeof undefined && attr !== false) {
      let label = $(this).parent().find('label');
      label.append(' <span>0/'+attr+'</span>');
    }

    $('input').on('change paste keyup keydown',function () {
      let attr = $(this).attr('maxlength');
      let inputlength = $(this).val().length;
      if (typeof attr !== typeof undefined && attr !== false) {
        let span = $(this).parent().find('span');
        span.text(inputlength+'/'+attr);
      }
    });

    $("[data-fancybox]").fancybox({
      toolbar         : false,
      loop            : true
    });

  });
})(jQuery); // End of use strict

// const backatage = document.querySelector('#aa');
const photos = document.querySelectorAll('.photo');


// observer = new IntersectionObserver((entry) => {
//     if (window.screen.width > 992) {
//         if (entry[0].intersectionRatio > 0) {
//             entry[0].target.style.animation = 'anim 1s forwards ease-out';
//         } else {
//             entry[0].target.style.animation = 'none';
//         }
//     }
// });

observer1 = new IntersectionObserver((entries) => {
  if (window.screen.width > 992) {
    entries.forEach(entry => {
      let delay = entry.target.dataset.delay;
      if (entry.intersectionRatio > 0) {
        entry.target.style.animation = `anim1 ${delay} ease-out`;
        disable(observer1);
      }
      else {
        entry.target.style.animation = 'none';
      }
    })
  }
});
// observer.observe(backatage);
photos.forEach(image => {
  observer1.observe(image);
});
function disable(observer) {
  observer.disconnect();
}
