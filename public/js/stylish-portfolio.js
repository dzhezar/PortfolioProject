(function($) {
  "use strict"; // Start of use strict

  // Closes the sidebar menu
  $(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
    $('html').css('-webkit-overflow-scrolling','hidden');
    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
    $(this).toggleClass("active");
  });

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('#sidebar-wrapper .js-scroll-trigger').click(function() {
    $("#sidebar-wrapper").removeClass("active");
    $(".menu-toggle").removeClass("active");
    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
  });

  // Scroll to top button appear
  $(document).scroll(function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  $('#contactForm').on('submit', function(event){
    event.preventDefault();
    submitForm();
  });

  function submitForm(){
    var name = $('#contact_form_name').val();
    var email = $('#contact_form_email').val();
    var text = $('#contact_form_text').val();

    $.ajax({
      url: "/sendMail",
      data: {
            name: name,
            email: email,
            text : text
          },
    })
    .done(function () {
      $('#contact_form_name').val('');
      $('#contact_form_email').val('');
      $('#contact_form_text').val('');
      $('#contactModal').modal('show');
    })

  }

  $('.sidebar-link').on('click',function () {
      $('#menu-button').click();
      $('html').css('overflow','auto');
  });


  // $('.custom-file input').change(function (e) {
  //   var files = [];
  //   for (var i = 0; i < $(this)[0].files.length; i++) {
  //     files.push($(this)[0].files[i].name);
  //   }
  //   $(this).next('.custom-file-label').html(files.join(', '));
  // });
})(jQuery); // End of use strict