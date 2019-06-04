import jQuery from 'jquery'

export class BackTop {

  public container: JQuery<HTMLElement>;
  private window: JQuery<Window>;

  constructor() {
    this.window = $(window);
    this.container = $("#back-to-top");
  }

  public start() {
    const that = this;
    this.window.on('scroll', function () {
      that.backTop();
    });

    this.container.on('click', function () {
      $('html, body').stop().animate({scrollTop: 0}, 600);
    });
  }

  public backTop() {
    const windowW = <number>(this.window.width());
    const windowH = <number>(this.window.height());
    const scroll = <number>(this.window.scrollTop());
    const startPoint = windowH / 2;

    if (scroll > 72) {
      $('.fixed-top').addClass('scroll');
    } else {
      $('.fixed-top').removeClass('scroll');
    }

    if (scroll >= startPoint && windowW >= 1024) {
      this.container.addClass('active');
    } else {
      this.container.removeClass('active');
    }
  }
}

jQuery(($) => {
  const backTop = new BackTop();
  backTop.start();
});

