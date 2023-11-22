const showMenu = (menu, hideMenuBg) => {
  menu.style.display = 'flex'
  hideMenuBg.style.display = 'block'
  setTimeout(() => {
    menu.style.right = 0
    menu.style.opacity = 1
    hideMenuBg.style.opacity = 1
  }, 100)
}

const hideMenu = (menu, menuWidth, hideMenuBg) => {
  menu.style.right = `-${menuWidth}`
  menu.style.opacity = 0
  hideMenuBg.style.opacity = 0
  setTimeout(() => {
    menu.style.display = 'none'
    hideMenuBg.style.display = 'none'
  }, 500)
}

document.addEventListener("DOMContentLoaded", () => {
  const menu = document.getElementById('menu')
  const hideMenuBg = document.getElementById('hide-menu-bg')
  const showMenuBtn = document.getElementById('show-menu')
  let menuWidth =
    window.innerWidth > 768 
      ? '30%' 
      : window.innerWidth > 480
        ? '50%'
        : '80%'

  menu.style.width = menuWidth

  showMenuBtn.addEventListener('click', () => {
    showMenu(menu, hideMenuBg)
  })

  hideMenuBg.addEventListener('click', () => {
    hideMenu(menu, menuWidth, hideMenuBg)
  })

  window.addEventListener('resize', () => {
    menuWidth =
      window.innerWidth > 768
        ? '30%'
        : window.innerWidth > 480
          ? '50%'
          : '80%'
    menu.style.width = menuWidth
    hideMenu(menu, menuWidth, hideMenuBg)
  })
})
