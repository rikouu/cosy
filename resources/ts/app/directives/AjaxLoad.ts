
import Vue, { VNode } from "vue";
import { DirectiveBinding, DirectiveOptions } from "vue/types/options";
import axios from 'axios'

function isElementInViewport(el: HTMLElement) {
  const rect = el.getBoundingClientRect();
  console.log(rect);
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

function givenElementInViewport(el: HTMLElement, fn: any) {
  return function () {
    if (isElementInViewport(el)) {
      console.log('2222222')
      fn();
    }
  }
}

function addViewportEvent(el: HTMLElement, fn: any) {
  if (window.addEventListener) {
    addEventListener('DOMContentLoaded', givenElementInViewport(el, fn), false);
    addEventListener('load', givenElementInViewport(el, fn), false);
    addEventListener('scroll', givenElementInViewport(el, fn), false);
    addEventListener('resize', givenElementInViewport(el, fn), false);
  }
}

const AjaxLoadDirective: DirectiveOptions = {
  bind: (el: HTMLElement, binding: DirectiveBinding, vnode: VNode, oldVnode: VNode) => {
    console.log('ajax');
    addViewportEvent(el, addViewportEvent(el, function () {
      console.log(1);
    }))
  },
};

export default AjaxLoadDirective;
