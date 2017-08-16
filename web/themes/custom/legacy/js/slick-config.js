$(document).ready(function () {
  let $ = jQuery
  $('.js-slick').slick({
    dots: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
  })
})


/* To pause the autoplay, paste this code into the console and run:
```
jQuery('.js-slick').slick('slickPause');
```
*/
