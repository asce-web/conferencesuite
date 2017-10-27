///////////////////////////////////////////////////////////////////////////////
//////////////                                                  ///////////////
//////////////    TODO: MOVE THESE SCRIPTS TO A PROPER FILE!    ///////////////
//////////////                                                  ///////////////
///////////////////////////////////////////////////////////////////////////////


$('.js-xo-_1').addClass('-xo-_1');
$('.o-Drawer:not(.o-Drawer--open)').find('a').attr('tabindex', -1);
$('.c-Toggle').click(function () {
  var drawer = $(this).siblings('.o-Drawer')
  var is_open = drawer.attr('aria-expanded') === 'true'
  drawer
    .toggleClass('o-Drawer--open')
    .attr('aria-expanded', !is_open)
    .attr('aria-hidden'  ,  is_open)
  $(this).find('.c-Toggle__Viz').toggleClass('glyphicons-menu-hamburger glyphicons-remove-circle')
})
