///////////////////////////////////////////////////////////////////////////////
//////////////                                                  ///////////////
//////////////    TODO: MOVE THESE SCRIPTS TO A PROPER FILE!    ///////////////
//////////////                                                  ///////////////
///////////////////////////////////////////////////////////////////////////////


$('.js-xo-_1').addClass('-xo-_1');
$('.o-Drawer').find('a').attr('tabindex', -1);
$('.c-Toggle__Check').change(function () {
  $(this).parents('.c-Toggle').siblings('.o-Drawer').toggleClass('o-Drawer--open');
  $(this).parents('.c-Toggle').siblings('.o-Drawer').find('a').each(function () {
    if ($(this).attr('tabindex') === '0') $(this).attr('tabindex', -1)
    else $(this).attr('tabindex', 0)
  })
  $(this).siblings('.c-Toggle__Viz').toggleClass('glyphicons-menu-hamburger glyphicons-remove-circle -ps-f -r-1')
})
