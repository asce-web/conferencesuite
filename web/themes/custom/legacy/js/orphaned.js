///////////////////////////////////////////////////////////////////////////////
//////////////                                                  ///////////////
//////////////    TODO: MOVE THESE SCRIPTS TO A PROPER FILE!    ///////////////
//////////////                                                  ///////////////
///////////////////////////////////////////////////////////////////////////////


$('.js-xo-_1').addClass('-xo-_1');
$('.o-Drawer').find('a').attr('tabindex', -1);
$('.c-Toggle__Check').change(function () {
  var checked = !($(this).val() === 'closed')
  $(this).val((checked) ? 'closed' : 'open')
  $(this).attr('aria-checked', !checked)
  $(this).parents('nav').find('.o-Drawer').toggleClass('o-Drawer--open');
  $(this).parents('nav').find('.o-Drawer').find('a').attr('tabindex', (checked) ? -1 : 0)
  $(this).siblings('.c-Toggle__Viz').toggleClass('glyphicons-menu-hamburger glyphicons-remove-circle -ps-f -r-1')
})