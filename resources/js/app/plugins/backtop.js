(function ($) {
  // 回到顶部
  function backTop(scrollTopBtn) {
    const w = $(window);
    const windowW = w.width();
    const windowH = w.height();
    const scroll = w.scrollTop();
    const startPoint = windowH / 2;

    if (scroll > 72) {
      $('.fixed-top').addClass('scroll');
    } else {
      $('.fixed-top').removeClass('scroll');
    }

    if (scroll >= startPoint && windowW >= 1024) {
      scrollTopBtn.addClass('active');
    } else {
      scrollTopBtn.removeClass('active');
    }
  }

  $(document).ready(function () {
    $('#back-to-top').click(() => {
      $('html, body').stop().animate({scrollTop: 0}, 600);
    });
  });

  $(window).scroll(function () {
    backTop($('#back-to-top'));
  });

})(jQuery);
