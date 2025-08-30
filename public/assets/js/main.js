
$(function() {
	"use strict";



// Theme switcher 

$("#LightTheme").on("click", function() {
  $("html").attr("class", "light-theme")
}),


$("#DarkTheme").on("click", function() {
$("html").attr("class", "dark-theme")
}),


$(".dark-mode-icon").on("click", function() {

  $(".mode-icon i").toggleClass("bi bi-brightness-high bi bi-moon")
  $("html").toggleClass("dark-theme")
})



/* Back to top */
$(document).ready(function() {
  $(window).on("scroll", function() {
    $(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
  }), $(".back-to-top").on("click", function() {
    return $("html, body").animate({
      scrollTop: 0
    }, 600), !1
  })
})


/* list active */
$(function() {
  for (var e = window.location, o = $(".primary-menu li a").filter(function() {
      return this.href == e
    }).addClass("active").parent().addClass("active"); o.is("li");) o = o.parent("").addClass("show").parent("").addClass("active")
})



});


const carousel = document.querySelector('#productCarousel');
const thumbnails = document.querySelectorAll('.thumbnail-img');
const bsCarousel = new bootstrap.Carousel(carousel, {
  interval: 3000,
  ride: 'carousel'
});

// Sync thumbnail highlight with active slide
carousel.addEventListener('slid.bs.carousel', function (event) {
  thumbnails.forEach(t => t.classList.remove('active-thumb'));
  if (thumbnails[event.to]) {
    thumbnails[event.to].classList.add('active-thumb');
  }
});