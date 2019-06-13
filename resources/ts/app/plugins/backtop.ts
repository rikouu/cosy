import $ from 'jquery'

$(() => {
  const onScroll = () => {
    const thisWindow = $(window);
    const container = $("#back-to-top");
    const windowW = <number>(thisWindow.width());
    const windowH = <number>(thisWindow.height());
    const scroll = <number>(thisWindow.scrollTop());
    const startPoint = windowH / 2;

    if (scroll > 72) {
      $('.fixed-top').addClass('scroll');
    } else {
      $('.fixed-top').removeClass('scroll');
    }

    if (scroll >= startPoint && windowW >= 1024) {
      container.addClass('active');
    } else {
      container.removeClass('active');
    }
  };

  $(window).on('scroll', onScroll);
});

