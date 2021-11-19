(function ($) {
  $(document).ready(function () {
    var the_terms = $(".c-Acknowledge");

    the_terms.click(function () {
      if ($(this).is(":checked")) {
        $(".c-Registration__Button").removeAttr("disabled");
      } else {
        $(".c-Registration__Button").attr("disabled", "disabled");
      }
    });
  });
})(jQuery);
