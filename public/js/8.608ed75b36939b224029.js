(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{"+ndo":function(t,a,n){"use strict";n.r(a);var e={name:"Register",components:{AuthLayout:n("5VZO").a},data:function(){return{submitting:!1,form:this.$form.createForm(this)}},methods:{handleSubmit:function(t){var a=this;t.preventDefault(),this.form.validateFields(function(t,n){t||(a.submitting=!0,a.$store.dispatch("auth/Register",n).then(function(t){a.submitting=!1,a.$router.push({path:a.$route.query.redirect||"/"})}).catch(function(t){console.log(t),a.submitting=!1}))})}}},i=(n("shZa"),n("KHd+")),r=Object(i.a)(e,function(){var t=this,a=t.$createElement,n=t._self._c||a;return n("auth-layout",[n("div",{staticClass:"main"},[n("h3",[t._v("\n      "+t._s(t.$t("layout.auth.register.name"))+"\n    ")]),t._v(" "),n("a-form",{attrs:{form:t.form},on:{submit:t.handleSubmit}},[n("a-form-item",[n("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,message:t.$t("validation.required",{attribute:t.$t("validation.attributes.username")})}],validateTrigger:["change","blur"]}],expression:"[\n            'name',\n            {\n              rules: [\n                { required: true, message: $t('validation.required', { attribute: $t('validation.attributes.username') }) }\n              ],\n              validateTrigger: ['change', 'blur']\n            }\n          ]"}],attrs:{size:"large",placeholder:t.$t("validation.attributes.username")},scopedSlots:t._u([{key:"default",fn:function(t){return[n("a-icon",{staticStyle:{color:"rgba(0,0,0,.25)"},attrs:{type:"user"}})]}}])})],1),t._v(" "),n("a-form-item",[n("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["email",{rules:[{required:!0,message:t.$t("validation.required",{attribute:t.$t("validation.attributes.email")})},{type:"email",message:t.$t("validation.wrong-format",{attribute:t.$t("validation.attributes.email")})}],validateTrigger:["change","blur"]}],expression:"[\n            'email',\n            {\n              rules: [\n                { required: true, message: $t('validation.required', { attribute: $t('validation.attributes.email') }) },\n                { type: 'email', message: $t('validation.wrong-format', { attribute: $t('validation.attributes.email') }) }\n              ],\n              validateTrigger: ['change', 'blur']\n            }\n          ]"}],attrs:{size:"large",placeholder:t.$t("validation.attributes.email")},scopedSlots:t._u([{key:"default",fn:function(t){return[n("a-icon",{staticStyle:{color:"rgba(0,0,0,.25)"},attrs:{type:"mail"}})]}}])})],1),t._v(" "),n("a-form-item",[n("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["password",{rules:[{required:!0,message:t.$t("validation.required",{attribute:t.$t("validation.attributes.password")})}],validateTrigger:["change","blur"]}],expression:"[\n            'password',\n            {\n              rules: [\n                { required: true, message: $t('validation.required', { attribute: $t('validation.attributes.password') }) }\n              ],\n              validateTrigger: ['change', 'blur']\n            }\n          ]"}],attrs:{size:"large",placeholder:t.$t("validation.attributes.password"),type:"password"},scopedSlots:t._u([{key:"default",fn:function(t){return[n("a-icon",{staticStyle:{color:"rgba(0,0,0,.25)"},attrs:{type:"lock"}})]}}])})],1),t._v(" "),n("a-form-item",[n("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["password_confirmation",{rules:[{required:!0,message:t.$t("validation.required",{attribute:t.$t("validation.attributes.password_confirmation")})}],validateTrigger:["change","blur"]}],expression:"[\n            'password_confirmation',\n            {\n              rules: [\n                { required: true, message: $t('validation.required', { attribute: $t('validation.attributes.password_confirmation') }) }\n              ],\n              validateTrigger: ['change', 'blur']\n            }\n          ]"}],attrs:{size:"large",placeholder:t.$t("validation.attributes.password_confirmation"),type:"password"},scopedSlots:t._u([{key:"default",fn:function(t){return[n("a-icon",{staticStyle:{color:"rgba(0,0,0,.25)"},attrs:{type:"lock"}})]}}])})],1),t._v(" "),n("a-form-item",[n("a-button",{staticClass:"submit",attrs:{loading:t.submitting,size:"large",type:"primary",htmlType:"submit"}},[t._v("\n          "+t._s(t.$t("messages.register"))+"\n        ")]),t._v(" "),n("router-link",{staticClass:"login",attrs:{to:{name:"login"}}},[t._v("\n          "+t._s(t.$t("messages.sign_in"))+"\n        ")])],1)],1)],1)])},[],!1,null,"fa1af368",null);a.default=r.exports},"+r5C":function(t,a,n){(t.exports=n("JPst")(!1)).push([t.i,"/* stylelint-disable at-rule-empty-line-before,at-rule-name-space-after,at-rule-no-unknown */\n/* stylelint-disable no-duplicate-selectors */\n/* stylelint-disable */\n/* stylelint-disable declaration-bang-space-before,no-duplicate-selectors,string-no-newline */\n.globalFooter[data-v-57fc8f04] {\n  padding: 0 16px;\n  margin: 48px 0 24px 0;\n  text-align: center;\n}\n.globalFooter .links[data-v-57fc8f04] {\n  margin-bottom: 8px;\n}\n.globalFooter .links a[data-v-57fc8f04] {\n  color: rgba(0, 0, 0, 0.45);\n  -webkit-transition: all 0.3s;\n  transition: all 0.3s;\n}\n.globalFooter .links a[data-v-57fc8f04]:not(:last-child) {\n  margin-right: 40px;\n}\n.globalFooter .links a[data-v-57fc8f04]:hover {\n  color: rgba(0, 0, 0, 0.65);\n}\n.globalFooter .copyright[data-v-57fc8f04] {\n  color: rgba(0, 0, 0, 0.45);\n  font-size: 14px;\n}\n",""])},"2hmg":function(t,a,n){"use strict";var e=n("VfG/"),i=n("pgDu"),r={zh_CN:"简体中文",en_US:"English"},o={zh_CN:"🇨🇳",en_US:"🇬🇧"},s=["zh_CN","en_US"],l={name:"SelectLang",components:{ADropdown:i.a,AMenu:e.a,AMenuItem:e.a.Item},inject:["reload"],data:function(){return{locales:s,languageIcons:o,languageLabels:r}},computed:{locale:function(){return this.$i18n.locale}},methods:{changeLang:function(t){var a=t.key;this.$store.dispatch("app/SetLocale",a),this.$i18n.locale=a,this.$message.success(this.$t("navBar.lang.switch")),this.reload()}}},c=(n("9lzH"),n("KHd+")),u=Object(c.a)(l,function(){var t=this,a=t.$createElement,n=t._self._c||a;return n("a-dropdown",{attrs:{placement:"bottomRight"},scopedSlots:t._u([{key:"overlay",fn:function(){return[n("a-menu",{staticClass:"menu",attrs:{selectedKeys:[t.locale]},on:{click:t.changeLang}},t._l(t.locales,function(a){return n("a-menu-item",{key:a},[n("span",{attrs:{role:"img",title:t.languageLabels[a],"aria-label":t.languageLabels[a]}},[t._v("\n          "+t._s(t.languageIcons[a])+"\n        ")]),t._v("\n        "+t._s(t.languageLabels[a])+"\n      ")])}),1)]},proxy:!0}])},[n("span",{staticClass:"dropDown"},[n("a-icon",{attrs:{type:"global"}})],1)])},[],!1,null,"7a313a45",null);a.a=u.exports},"5VZO":function(t,a,n){"use strict";n("f3/d");var e=n("p1AO"),i=n("2hmg"),r=n("RogN"),o={name:"AuthLayout",components:{SelectLang:i.a,GlobalFooter:e.a},data:function(){return{year:(new Date).getFullYear(),name:r.a.name,description:r.a.description}}},s=(n("nSes"),n("KHd+")),l=Object(s.a)(o,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"container",style:{backgroundImage:"'url("+n("gAQC")+")'"}},[e("div",{staticClass:"lang"},[e("select-lang")],1),t._v(" "),e("div",{staticClass:"content"},[e("div",{staticClass:"top"},[e("div",{staticClass:"header"},[e("router-link",{attrs:{to:{path:"/"}}},[e("img",{staticClass:"logo",attrs:{alt:"logo",src:n("PK2o")}}),t._v(" "),e("span",{staticClass:"title"},[t._v(t._s(t.name))])])],1),t._v(" "),e("div",{staticClass:"desc"},[t._v("\n        "+t._s(t.description)+"\n      ")])]),t._v(" "),t._t("default")],2),t._v(" "),e("global-footer",{attrs:{links:[{key:"github",icon:"github",path:"https://github.com/loyep/cosy",blankTarget:!0}]},scopedSlots:t._u([{key:"copyright",fn:function(){return[t._v("\n      Copyright\n      "),e("a-icon",{attrs:{type:"copyright"}}),t._v("\n      "+t._s(t.year)+" Power By\n      "),e("a",{attrs:{href:"https://github.com/loyep/cosy"}},[t._v("Cosy")])]},proxy:!0}])})],1)},[],!1,null,"7f1cae58",null);a.a=l.exports},"9lzH":function(t,a,n){"use strict";var e=n("duEq");n.n(e).a},MOmO:function(t,a,n){(t.exports=n("JPst")(!1)).push([t.i,"/* stylelint-disable at-rule-empty-line-before,at-rule-name-space-after,at-rule-no-unknown */\n/* stylelint-disable no-duplicate-selectors */\n/* stylelint-disable */\n/* stylelint-disable declaration-bang-space-before,no-duplicate-selectors,string-no-newline */\n.container[data-v-7f1cae58] {\n  display: -webkit-box;\n  display: flex;\n  -webkit-box-orient: vertical;\n  -webkit-box-direction: normal;\n          flex-direction: column;\n  height: 100vh;\n  overflow: auto;\n  background: #f0f2f5;\n}\n.lang[data-v-7f1cae58] {\n  text-align: right;\n  width: 100%;\n  height: 40px;\n  line-height: 44px;\n}\n.lang[data-v-7f1cae58] :global(.ant-dropdown-trigger) {\n  margin-right: 24px;\n}\n.content[data-v-7f1cae58] {\n  padding: 32px 0;\n  -webkit-box-flex: 1;\n          flex: 1;\n}\n@media (min-width: 768px) {\n.container[data-v-7f1cae58] {\n    /*background-image: url(require('@/assets/images/loginBg.svg'));*/\n    background-repeat: no-repeat;\n    background-position: center 110px;\n    background-size: 100%;\n}\n.content[data-v-7f1cae58] {\n    padding: 32px 0 24px 0;\n}\n}\n.top[data-v-7f1cae58] {\n  text-align: center;\n}\n.header[data-v-7f1cae58] {\n  height: 44px;\n  line-height: 44px;\n}\n.header a[data-v-7f1cae58] {\n  text-decoration: none;\n}\n.logo[data-v-7f1cae58] {\n  height: 44px;\n  vertical-align: top;\n  margin-right: 16px;\n}\n.title[data-v-7f1cae58] {\n  font-size: 33px;\n  color: rgba(0, 0, 0, 0.85);\n  font-family: Avenir, \"Helvetica Neue\", Arial, Helvetica, sans-serif;\n  font-weight: 600;\n  position: relative;\n  top: 2px;\n}\n.desc[data-v-7f1cae58] {\n  font-size: 14px;\n  color: rgba(0, 0, 0, 0.45);\n  margin-top: 12px;\n  margin-bottom: 40px;\n}\n",""])},N0rg:function(t,a,n){var e=n("O9Lc");"string"==typeof e&&(e=[[t.i,e,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(e,i);e.locals&&(t.exports=e.locals)},O9Lc:function(t,a,n){(t.exports=n("JPst")(!1)).push([t.i,"/* stylelint-disable at-rule-empty-line-before,at-rule-name-space-after,at-rule-no-unknown */\n/* stylelint-disable no-duplicate-selectors */\n/* stylelint-disable */\n/* stylelint-disable declaration-bang-space-before,no-duplicate-selectors,string-no-newline */\n.main[data-v-fa1af368] {\n  width: 368px;\n  margin: 0 auto;\n}\n.main h3[data-v-fa1af368] {\n  font-size: 16px;\n  margin-bottom: 20px;\n}\n.main .getCaptcha[data-v-fa1af368] {\n  display: block;\n  width: 100%;\n}\n.main .submit[data-v-fa1af368] {\n  width: 50%;\n}\n.main .login[data-v-fa1af368] {\n  float: right;\n  line-height: 40px;\n}\n.success[data-v-fa1af368],\n.warning[data-v-fa1af368],\n.error[data-v-fa1af368] {\n  -webkit-transition: color 0.3s;\n  transition: color 0.3s;\n}\n.success[data-v-fa1af368] {\n  color: #52c41a;\n}\n.warning[data-v-fa1af368] {\n  color: #faad14;\n}\n.error[data-v-fa1af368] {\n  color: #f5222d;\n}\n.progress-pass > .progress :global .ant-progress-bg[data-v-fa1af368] {\n  background-color: #faad14;\n}\n",""])},PK2o:function(t,a){t.exports="/images/logo.png?c924155285cdba2f57cbd751674c1bb0"},RogN:function(t,a,n){"use strict";a.a={name:"Cosy",description:"简约是隐藏的精致"}},S0h1:function(t,a,n){var e=n("MOmO");"string"==typeof e&&(e=[[t.i,e,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(e,i);e.locals&&(t.exports=e.locals)},ZjSD:function(t,a,n){(t.exports=n("JPst")(!1)).push([t.i,"/* stylelint-disable at-rule-empty-line-before,at-rule-name-space-after,at-rule-no-unknown */\n/* stylelint-disable no-duplicate-selectors */\n/* stylelint-disable */\n/* stylelint-disable declaration-bang-space-before,no-duplicate-selectors,string-no-newline */\n.menu[data-v-7a313a45] :global(.anticon) {\n  margin-right: 8px;\n}\n.menu[data-v-7a313a45] :global(.ant-dropdown-menu-item) {\n  min-width: 160px;\n}\n.dropDown[data-v-7a313a45] {\n  line-height: 64px;\n  vertical-align: top;\n  cursor: pointer;\n}\n.dropDown > i[data-v-7a313a45] {\n  font-size: 16px !important;\n  -webkit-transform: none !important;\n          transform: none !important;\n}\n.dropDown > i svg[data-v-7a313a45] {\n  position: relative;\n  top: -1px;\n}\n",""])},duEq:function(t,a,n){var e=n("ZjSD");"string"==typeof e&&(e=[[t.i,e,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(e,i);e.locals&&(t.exports=e.locals)},gAQC:function(t,a){t.exports="/images/loginBg.svg?5825f033c6ff12cd1ed1f3c99dff5e4b"},n03A:function(t,a,n){var e=n("+r5C");"string"==typeof e&&(e=[[t.i,e,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(e,i);e.locals&&(t.exports=e.locals)},nSes:function(t,a,n){"use strict";var e=n("S0h1");n.n(e).a},p1AO:function(t,a,n){"use strict";var e={name:"GlobalFooter",props:{links:{type:Array,default:function(){return[]}}},computed:{footerLinks:function(){var t=this;return this.links.map(function(a){return void 0!==a.path&&"http://"!==a.path.substr(0,7).toLowerCase()&&"https://"!==a.path.substr(0,8).toLowerCase()&&(a.path="".concat(t.$router.base,"/").concat("hash"===t.$router.mode?"#/":"").concat(a.path)),a.blankTarget?a.target="_blank":a.target="_self",a})}}},i=(n("wbNC"),n("KHd+")),r=Object(i.a)(e,function(){var t=this,a=t.$createElement,n=t._self._c||a;return n("footer",{staticClass:"globalFooter"},[n("div",{staticClass:"links"},t._l(t.footerLinks,function(a){return n("a",{key:a.key,attrs:{href:a.path,target:a.target||"_blank"}},[a.icon?n("a-icon",{attrs:{type:a.icon}}):t._e(),t._v(" "+t._s(a.title)+"\n    ")],1)}),0),t._v(" "),n("div",{staticClass:"copyright"},[t._t("copyright")],2)])},[],!1,null,"57fc8f04",null);a.a=r.exports},shZa:function(t,a,n){"use strict";var e=n("N0rg");n.n(e).a},wbNC:function(t,a,n){"use strict";var e=n("n03A");n.n(e).a}}]);