// import $ from 'jquery'

// require('theia-sticky-sidebar');

// declare global {
//     interface Window {
//         jQuery: JQueryStatic,
//         $: JQueryStatic,
//     }
// }

// export function popup(type: string, html: any, maskStyle?: string, btnCallBack?: Function) {
//     const mask = maskStyle ? 'style="' + maskStyle + '"' : '';

//     let size = '';
//     if (type === 'big') {
//         size = 'cosy-tips-lg';
//     } else if (type === 'no-padding') {
//         size = 'cosy-tips-nopd';
//     } else if (type === 'cover') {
//         size = 'cosy-tips-cover cosy-tips-nopd';
//     } else if (type === 'full') {
//         size = 'cosy-tips-xl';
//     } else if (type === 'small') {
//         size = 'cosy-tips-sm';
//     }

//     const template = `
//   <div class="cosy-tips ${size} cosy-tips-open">
//   <div class="cosy-tips-overlay" ${mask}></div>
//   <div class="cosy-tips-body">
//   <div class="cosy-tips-content">${html}</div>
//   <div class="btn-close-tips">
//       <svg t="1553064665406" class="icon w-32" style="" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3368" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">
//       <defs><style type="text/css"></style></defs>
//       <path d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z" p-id="3369"></path>
//       </svg>
//   </div>
//   </div>
//   </div>
//   `;
//     const popup = $(template);
//     $('#app').append(popup);
//     $('body').addClass('modal-open');
//     // const lazyLoadInstance = (<any>window).lazyLoadInstance;
//     // if (typeof lazyLoadInstance !== "undefined") {
//     //     lazyLoadInstance.update();
//     // }

//     const close = function () {
//         $('body').removeClass('modal-open');
//         $(popup).removeClass('cosy-tips-open');
//         $(popup).addClass('cosy-tips-close');
//         setTimeout(function () {
//             $(popup).removeClass('cosy-tips-close');
//             setTimeout(function () {
//                 popup.remove();
//             }, 200);
//         }, 600);
//     };

//     $(popup).on('click', '.btn-close-tips, .cosy-tips-overlay', function (e) {
//         e.preventDefault();
//         close();
//     });

//     if (typeof btnCallBack === 'object') {
//         Object.keys(btnCallBack).forEach(function (key) {
//             $(popup).on('click touchstart', key, function (event) {
//                 let _ = (<any>btnCallBack)[key](event, close);
//             });
//         });
//     }
//     return popup;
// }

export class Cosy {
    loaded() {
        // $('.search-popup').off('click').on('click', function (e) {
        //     e.preventDefault();
        //     popup('full', $('#search-popup-wrap').html());
        // });

        // const sidebar = $(".sidebar");
        // console.log(sidebar)
        // if (sidebar !== undefined) {
        //     (<any>sidebar).theiaStickySidebar({
        //         additionalMarginTop: 20,
        //         additionalMarginBottom: 100,
        //     });
        // }
    }
}

export const app = new Cosy();

(function () {
    app.loaded();
})();
