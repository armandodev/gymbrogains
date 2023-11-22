const showMenu = (menu, hideMenuBg) => {
  $(document.body).css('overflow', 'hidden');
  $(menu).css('display', 'flex');
  $(hideMenuBg).css('display', 'block');
  window.scrollTo(0, 0);
  setTimeout(() => {
    $(menu).css('right', 0);
    $(menu).css('opacity', 1);
    $(hideMenuBg).css('opacity', 1);
  }, 100);
};

const hideMenu = (menu, menuWidth, hideMenuBg) => {
  $(menu).css('right', `-${menuWidth}`);
  $(menu).css('opacity', 0);
  $(hideMenuBg).css('opacity', 0);
  setTimeout(() => {
    $(menu).css('display', 'none');
    $(hideMenuBg).css('display', 'none');
  }, 500);
};

$(document).ready(() => {
  const menu = $('#menu');
  const hideMenuBg = $('#hide-menu-bg');
  const showMenuBtn = $('#show-menu');
  let menuWidth =
    $(window).innerWidth() > 768
      ? '30%'
      : $(window).innerWidth() > 480
        ? '50%'
        : '80%';

  menu.css('width', menuWidth);

  showMenuBtn.on('click', () => {
    showMenu(menu, hideMenuBg);
  });

  hideMenuBg.on('click', () => {
    hideMenu(menu, menuWidth, hideMenuBg);
  });

  $(window).on('resize', () => {
    menuWidth =
      $(window).innerWidth() > 768
        ? '30%'
        : $(window).innerWidth() > 480
          ? '50%'
          : '80%';
    menu.css('width', menuWidth);
    hideMenu(menu, menuWidth, hideMenuBg);
  });
});
