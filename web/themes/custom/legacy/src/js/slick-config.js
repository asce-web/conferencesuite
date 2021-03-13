;(function ($) {
$(document).ready(function () {
  $('.js-slick').slick({
    dots: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
  })
})

// To pause the autoplay, run this function in your browser console:
function slickPause() {
  $('.js-slick').slick('slickPause');
}
})(jQuery)
