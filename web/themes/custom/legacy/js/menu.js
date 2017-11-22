(function ($) {
  $.fn.menuify = function() {
      var activeNavEl = null;
      var activeTargetEl = null;
      var overHandler = null;
      var overTarget = false;
      var currentPageNavEl = null;
      var currentPageTargetEl = null;

      function show(navEl, targetEl) {
          if (activeTargetEl && activeNavEl) {
              activeTargetEl.removeClass('active');
              activeNavEl.removeClass('active');
          }

          activeNavEl = navEl;
          activeTargetEl = targetEl;

          if (currentPageNavEl && currentPageNavEl != navEl) {
              currentPageTargetEl.removeClass('current-page');
          }

          targetEl.addClass('active');
          navEl.addClass('active');

          overHandler = targetEl.hover(function () {
              overTarget = true;
          }, function () {
              overHandler = null;
              overTarget = false;
              hide(navEl, targetEl);
          });
      }

      function hide(navEl, targetEl) {
          if ((!overHandler && !overTarget) || (overHandler && !overTarget)) {
              targetEl.removeClass('active');
              navEl.removeClass('active');

              if (currentPageNavEl && currentPageNavEl != navEl) {
                  currentPageTargetEl.addClass('current-page');
              }
          }
      }

      this.each(function () {
          var el = $(this);
          var target = $(el.data('menu-target'));
          if (el.hasClass('active')) {
              activeNavEl = el;
              activeTargetEl = target;
          }

          if (el.hasClass('current-page')) {
              currentPageNavEl = el;
              currentPageTargetEl = target;
          }

          el.hoverIntent(function () {
              show(el, target);
          }, function () {
              hide(el, target);
          });

          el.on('touchstart', function (e) {
              var body = $('body');
              if (!$(this).hasClass('active')) {
                  e.preventDefault();
                  e.stopPropagation();
                  show(el, target);

                  body.off('touchstart');
                  body.on('touchstart', function (e) {
                      if (!$(e.target).closest('.navigation-level2').length) {
                          hide(el, target);
                          body.off('touchstart');
                      }
                  });
              }
          });
      });
  };

  $( "[data-menu-target]").menuify(); // Makes all the links green.
})(jQuery)
