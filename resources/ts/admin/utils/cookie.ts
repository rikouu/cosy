import Cookies from 'js-cookie'

export const setCookie = (key: string, content: any, expires: number = 7) => {
  if (typeof content !== 'string') {
    content = JSON.stringify(content)
  }
  Cookies.set(key, content, { expires })
}

export const getCookie = (key: string, def: any = undefined) => {
  let content = Cookies.get(key)
  if (content !== null && content !== undefined) {
    try {
      content = JSON.parse(content)
    } catch (e) {
      return content
    }
    return content
  }

  return def
}

export const removeCookie = (key: string) => {
  Cookies.remove(key)
}

const Cookie = {
  get: getCookie,
  set: setCookie,
  remove: removeCookie
}

export default Cookie
