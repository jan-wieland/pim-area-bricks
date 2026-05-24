let jwScrollSmall = false,
  jwScrollLast = 0,
  jwScrollDown = -1,
  jwScrollMinimum = 0,
  jwScrollMaximum = 0

document.addEventListener('scroll', () => {
  let jwScrollPos = window.scrollY
  if (jwScrollPos !== jwScrollLast && jwScrollPos > 102) {
    if (jwScrollPos > jwScrollMaximum) {
      jwScrollMaximum = jwScrollPos
    }
    if (jwScrollPos < jwScrollMinimum) {
      jwScrollMinimum = jwScrollPos
    }
    if (jwScrollDown === -1) {
      jwScrollDown = 1
      jwScrollMinimum = jwScrollPos
      jwScrollMaximum = jwScrollPos
      jwScrollSmall = true
      document.body.classList.add('jw-state-scrolled')
    }
    if (jwScrollDown === 1) {
      if (jwScrollSmall && jwScrollPos < jwScrollMaximum - 68) {
        jwScrollDown = 0
        jwScrollMinimum = jwScrollPos
        jwScrollSmall = false
        document.body.classList.remove('jw-state-scrolled')
      }
    } else {
      if (!jwScrollSmall && jwScrollPos > jwScrollMinimum + 68) {
        jwScrollDown = 1
        jwScrollMaximum = jwScrollPos
        jwScrollSmall = true
        document.body.classList.add('jw-state-scrolled')
      }
    }
  }
  if (jwScrollSmall && jwScrollPos < 1) {
    jwScrollDown = -1
    jwScrollSmall = false
    document.body.classList.remove('jw-state-scrolled')
  }
  jwScrollLast = jwScrollPos
})
