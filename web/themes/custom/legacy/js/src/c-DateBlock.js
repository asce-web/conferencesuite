;(function ($) {
  // Add expired Important Date style.
  //
  // NOTE: we are using a front-end script to add the style,
  // instead of the back-end Drupal theme, because we want the current date
  // to be truly current---when the user loads the page.
  // If we did this in Drupal, the ‘current date’ would be the build date,
  // which depends on caching settings.
  $('.c-DateBlock__Date > time[datetime]').each(function () {
    let start = new Date(this.dateTime).getTime()
    if (start < Date.now()) {
      $(this).parents('.c-DateBlock__Item').addClass('c-DateBlock__Item--expired')
    }
  })
  // without jQuery:
  // document.querySelectorAll('.c-DateBlock__Date > time').forEach((time) => {
  //   let start = new Date(time.dateTime).getTime()
  //   if (start < Date.now()) {
  //     // WARNING: depends on DOM structure (calling `.parentElement` twice)
  //     time.parentElement.parentElement.classList.add('c-DateBlock__Item--expired')
  //   }
  // })
})(jQuery)
