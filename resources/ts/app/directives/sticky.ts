import {VNode} from "vue";
import {DirectiveBinding, DirectiveOptions} from "vue/types/options";

const StickyDirective: DirectiveOptions = {
    bind: (el: HTMLElement, binding: DirectiveBinding, vnode: VNode, oldVnode: VNode) => {
        // $(() => {
        //     require('theia-sticky-sidebar');
        //     console.log(2);
        //     (<any>$('#sidebar')).theiaStickySidebar({
        //         additionalMarginTop: 20,
        //         additionalMarginBottom: 100,
        //     });
        // });
    },
};

export default StickyDirective;
