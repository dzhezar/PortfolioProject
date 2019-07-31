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

  $('.set_posted').change(function () {
    let value = $(this).prop('checked');
    let id = $(this).attr('id');
    if(value === true)
      value = 1;
    else
      value = 0;
    $.ajax({
          url:'/admin/is_posted',
          data: {
            id: id,
            is_posted: value,
          }
        }
    )
  });

  $('#menu-button').on('click', function () {
    if($('#sidebar-wrapper').hasClass('active')){
      $('html').css('overflow-y','hidden').css('position','fixed');
    }
    else{
      $('html').css('overflow-y','auto').css('position','unset');
    }
  });
  $('.sidebar-link').on('click',function () {
      $('#menu-button').click();
      $('html').css('overflow','auto');
  });


  document.querySelectorAll('section[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

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

  });
})(jQuery); // End of use strict