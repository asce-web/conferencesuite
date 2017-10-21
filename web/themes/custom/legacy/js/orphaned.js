///////////////////////////////////////////////////////////////////////////////
//////////////                                                  ///////////////
//////////////    TODO: MOVE THESE SCRIPTS TO A PROPER FILE!    ///////////////
//////////////                                                  ///////////////
///////////////////////////////////////////////////////////////////////////////


$('.js-xo-_1').addClass('-xo-_1');
$('.o-Drawer:not(.o-Drawer--open)').find('a').attr('tabindex', -1);
$('.c-Toggle').click(function () {
  var is_open = ($(this).attr('aria-expanded') === 'true')
  $(this).attr('aria-expanded', !is_open)
  $(this).parents('nav').find('.o-Drawer').toggleClass('o-Drawer--open')
    .find('a').attr('tabindex', (is_open) ? -1 : 0)
  $(this).find('.c-Toggle__Viz').toggleClass('glyphicons-menu-hamburger glyphicons-remove-circle')
})
