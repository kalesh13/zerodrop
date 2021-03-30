(self.webpackChunk=self.webpackChunk||[]).push([[617],{9152:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>c});var a=r(2934),s=r(8379),n=r(3988),o=r(1135),i=r(7810),l=r(6736),u=r(7233);const c={name:"Settings",mounted:function(){var t=this;this.df.fetchData(null,(function(e){return t.form_data=e}))},data:function(){return{form_data:{logo:"",contact_email:"",address_line_1:"",street_address:"",city:"",state:"",country:"",pin:"",phone_1:"",phone_2:"",fb_url:"",twitter_url:"",insta_url:"",youtube_url:""},pu:new s.PageUpdater,df:new a.DataFetcher("/api/page/settings")}},methods:{onSubmit:function(){this.pu.updatePage("/api/admin/page/settings",this.form_data)}},components:{LoadingComponent:i.default,SeoFields:o.default,UpdateWidget:l.default,Uploader:n.default,CustomInput:u.default}}},1826:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>a});const a={inheritAttrs:!1,name:"formGroupInput",props:["label","error","value"]}},5113:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>a});const a={name:"loading"}},9057:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>a});const a={name:"SeoWidget",props:["fields"],watch:{fields:function(t){this.meta_title=t.meta_title,this.meta_keywords=t.meta_keywords,this.meta_description=t.meta_description},meta_title:function(t){this.$emit("onChange","meta_title",t)},meta_keywords:function(t){this.$emit("onChange","meta_keywords",t)},meta_description:function(t){this.$emit("onChange","meta_description",t)}},data:function(){return{meta_title:this.fields.meta_title,meta_keywords:this.fields.meta_keywords,meta_description:this.fields.meta_description}},components:{CustomInput:r(7233).default}}},118:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>a});const a={name:"UpdateWidget",props:["update","submitted","status"],computed:{responseStatusClass:function(){return this.status?this.status.error?"text-danger":"text-success":""},serverResponse:function(){return this.status&&this.status.message}}}},6234:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>s});var a=r(2934);const s={name:"Uploader",inheritAttrs:!1,props:["label","value","error"],data:function(){return{uh:new a.UploadHandler("/api/upload"),file_name:this.$attrs.name||"file"}},methods:{onFileChanged:function(t){this.uh.upload(t.target.files,this.file_name,this.onUploadSuccess)},onUploadSuccess:function(t){this.$emit("input",t[this.file_name])}},computed:{errors:function(){return this.uh.errors&&this.uh.errors[this.file_name]}}}},8379:(t,e,r)=>{"use strict";r.r(e),r.d(e,{PageUpdater:()=>m});var a=r(2934);function s(t){return(s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function o(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){i(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function i(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function l(t,e){for(var r=0;r<e.length;r++){var a=e[r];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(t,a.key,a)}}function u(t,e){return(u=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function c(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}();return function(){var r,a=f(t);if(e){var s=f(this).constructor;r=Reflect.construct(a,arguments,s)}else r=a.apply(this,arguments);return d(this,r)}}function d(t,e){return!e||"object"!==s(e)&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function f(t){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var m=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&u(t,e)}(n,t);var e,r,a,s=c(n);function n(){var t;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,n),(t=s.call(this)).submissionResponse={error:!1,message:""},t}return e=n,(r=[{key:"updatePage",value:function(t,e){var r=this;this.submissionResponse={error:!1,message:""},this.formPost(t,o(o({},e),{},{_method:"PATCH"}),(function(){return r.submissionResponse={message:"Data saved successfully."}}),this.onError.bind(this))}},{key:"onError",value:function(){this.submissionResponse={error:!!this.errors.server_error,message:this.errors.server_error||""}}}])&&l(e.prototype,r),a&&l(e,a),n}(a.DataPoster)},2477:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(3645),s=r.n(a)()((function(t){return t[1]}));s.push([t.id,".update-box[data-v-60cae2cf]{width:100%;padding:15px;background-color:#efefef}.update-box .title[data-v-60cae2cf]{text-align:left;font-size:1.1rem;border-bottom:1px dashed rgba(0,0,0,.2)}.update-box ul[data-v-60cae2cf]{list-style:none;padding:0;margin:0}.update-box ul li[data-v-60cae2cf]{display:inline-block}.update-box .theme-btn.disabled[data-v-60cae2cf]{cursor:not-allowed}",""]);const n=s},6548:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>i});var a=r(3379),s=r.n(a),n=r(2477),o={insert:"head",singleton:!1};s()(n.default,o);const i=n.default.locals||{}},5617:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(6674),s=r(24),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,null,null).exports},7233:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(8796),s=r(7182),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,null,null).exports},7810:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(6621),s=r(5322),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,null,null).exports},1135:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(5776),s=r(6977),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,null,null).exports},6736:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(6445),s=r(6786),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);r(4231);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,"60cae2cf",null).exports},3988:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>o});var a=r(8187),s=r(4763),n={};for(const t in s)"default"!==t&&(n[t]=()=>s[t]);r.d(e,n);const o=(0,r(1900).default)(s.default,a.render,a.staticRenderFns,!1,null,null,null).exports},24:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(9152),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},7182:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(1826),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},5322:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(5113),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},6977:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(9057),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},6786:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(118),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},4763:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>n});var a=r(6234),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s);const n=a.default},6674:(t,e,r)=>{"use strict";r.r(e);var a=r(125),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},8796:(t,e,r)=>{"use strict";r.r(e);var a=r(4873),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},6621:(t,e,r)=>{"use strict";r.r(e);var a=r(4390),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},5776:(t,e,r)=>{"use strict";r.r(e);var a=r(9483),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},6445:(t,e,r)=>{"use strict";r.r(e);var a=r(6870),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},8187:(t,e,r)=>{"use strict";r.r(e);var a=r(9061),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},4231:(t,e,r)=>{"use strict";r.r(e);var a=r(6548),s={};for(const t in a)"default"!==t&&(s[t]=()=>a[t]);r.d(e,s)},125:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"section single-section"},[r("div",{staticClass:"container-fluid"},[t._m(0),r("div",{staticClass:"col-sm-12 pt-4"},[t.df.fetching?r("loading-component"):r("div",{staticClass:"row"},[r("form",{staticClass:"form-horizontal col-md-7",attrs:{method:"POST"},on:{submit:function(t){t.preventDefault()}}},[r("div",{staticClass:"course-form"},[r("uploader",{attrs:{label:"Site Logo",name:"logo",error:t.pu.errors.logo},model:{value:t.form_data.logo,callback:function(e){t.$set(t.form_data,"logo",e)},expression:"form_data.logo"}}),r("custom-input",{attrs:{error:t.pu.errors.contact_email,label:"Contact email address",name:"contact_email",required:""},model:{value:t.form_data.contact_email,callback:function(e){t.$set(t.form_data,"contact_email",e)},expression:"form_data.contact_email"}}),r("div",{staticClass:"address-title"},[t._v("Address")]),r("custom-input",{attrs:{error:t.pu.errors.address_line_1,label:"Address line 1 (Company name)",name:"address_line_1",required:""},model:{value:t.form_data.address_line_1,callback:function(e){t.$set(t.form_data,"address_line_1",e)},expression:"form_data.address_line_1"}}),r("custom-input",{attrs:{error:t.pu.errors.street_address,label:"Address line 2",name:"street_address",required:""},model:{value:t.form_data.street_address,callback:function(e){t.$set(t.form_data,"street_address",e)},expression:"form_data.street_address"}}),r("custom-input",{attrs:{error:t.pu.errors.city,label:"City",name:"city",required:""},model:{value:t.form_data.city,callback:function(e){t.$set(t.form_data,"city",e)},expression:"form_data.city"}}),r("custom-input",{attrs:{error:t.pu.errors.state,label:"State",name:"state",required:""},model:{value:t.form_data.state,callback:function(e){t.$set(t.form_data,"state",e)},expression:"form_data.state"}}),r("custom-input",{attrs:{error:t.pu.errors.country,label:"Country",name:"country",required:""},model:{value:t.form_data.country,callback:function(e){t.$set(t.form_data,"country",e)},expression:"form_data.country"}}),r("custom-input",{attrs:{error:t.pu.errors.pin,label:"Postal code",name:"pin",required:""},model:{value:t.form_data.pin,callback:function(e){t.$set(t.form_data,"pin",e)},expression:"form_data.pin"}}),r("div",{staticClass:"address-title"},[t._v("Phone numbers")]),r("custom-input",{attrs:{error:t.pu.errors.phone_1,label:"Phone number 1",name:"phone_1",required:""},model:{value:t.form_data.phone_1,callback:function(e){t.$set(t.form_data,"phone_1",e)},expression:"form_data.phone_1"}}),r("custom-input",{attrs:{error:t.pu.errors.phone_2,label:"Phone number 2",name:"phone_2",required:""},model:{value:t.form_data.phone_2,callback:function(e){t.$set(t.form_data,"phone_2",e)},expression:"form_data.phone_2"}}),r("div",{staticClass:"address-title"},[t._v("Social links")]),r("custom-input",{attrs:{error:t.pu.errors.fb_url,label:"Facebook page url",name:"fb_url",required:""},model:{value:t.form_data.fb_url,callback:function(e){t.$set(t.form_data,"fb_url",e)},expression:"form_data.fb_url"}}),r("custom-input",{attrs:{error:t.pu.errors.twitter_url,label:"Twitter profile url",name:"twitter_url",required:""},model:{value:t.form_data.twitter_url,callback:function(e){t.$set(t.form_data,"twitter_url",e)},expression:"form_data.twitter_url"}}),r("custom-input",{attrs:{error:t.pu.errors.insta_url,label:"Instagram profile url",name:"insta_url",required:""},model:{value:t.form_data.insta_url,callback:function(e){t.$set(t.form_data,"insta_url",e)},expression:"form_data.insta_url"}}),r("custom-input",{attrs:{error:t.pu.errors.youtube_url,label:"YouTube channel url",name:"youtube_url",required:""},model:{value:t.form_data.youtube_url,callback:function(e){t.$set(t.form_data,"youtube_url",e)},expression:"form_data.youtube_url"}})],1)]),r("update-widget",{attrs:{status:t.pu.submissionResponse,update:!0},on:{publish:t.onSubmit,cancel:function(e){return t.$emit("cancel")}}})],1)],1)])])},s=[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"col-sm-12"},[r("div",{staticClass:"title text-left d-inline-block"},[r("span",[t._v("About Page")])])])}]},4873:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[r("label",{staticClass:"login-label",domProps:{textContent:t._s(t.label)}}),r("input",t._b({staticClass:"form-control",class:{"is-invalid":t.error},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},"input",t.$attrs,!1)),t.error?r("div",{staticClass:"small text-danger mt-2",domProps:{textContent:t._s(t.error[0])}}):t._e()])},s=[]},4390:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},s=[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"section single-section"},[e("div",{staticClass:"container text-center"},[e("div",{staticClass:"col-sm-12 main-error"},[e("img",{attrs:{src:"/images/loading.gif",alt:"Loading Image"}})])])])}]},9483:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"seo-fields"},[r("div",{staticClass:"address-title"},[t._v("SEO fields")]),r("custom-input",{attrs:{label:"Meta title",name:"meta_title"},model:{value:t.meta_title,callback:function(e){t.meta_title=e},expression:"meta_title"}}),r("custom-input",{attrs:{label:"Meta Description",name:"meta_description"},model:{value:t.meta_description,callback:function(e){t.meta_description=e},expression:"meta_description"}}),r("custom-input",{attrs:{label:"Meta Keywords",name:"meta_keywords"},model:{value:t.meta_keywords,callback:function(e){t.meta_keywords=e},expression:"meta_keywords"}})],1)},s=[]},6870:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"col-md-5"},[r("div",{staticClass:"update-box clearfix"},[r("div",{staticClass:"title text-left"},[t._v("Actions")]),t._t("default"),r("div",{staticClass:"d-flex"},[r("div",{staticClass:"my-auto mr-4 ml-auto"},[r("ul",[r("li",[r("a",{attrs:{href:"/"},on:{click:function(e){return e.preventDefault(),t.$emit("cancel")}}},[t._v("Cancel")])])])]),r("div",{staticClass:"theme-btn all-btn",class:{disabled:t.submitted},on:{click:function(e){return t.$emit("publish")}}},[t.submitted?r("span",{staticClass:"fa fa-circle-o-notch fa-spin"}):t._e(),t._v(t._s(t.update?"Update":"Publish"))])]),!t.submitted&&t.serverResponse?r("div",{staticClass:"small mt-2",class:t.responseStatusClass},[t._v(t._s(t.serverResponse))]):t._e()],2)])},s=[]},9061:(t,e,r)=>{"use strict";r.r(e),r.d(e,{render:()=>a,staticRenderFns:()=>s});var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[r("label",{staticClass:"login-label",domProps:{textContent:t._s(t.label)}}),r("div",{staticClass:"file-input"},[r("input",t._b({attrs:{type:"file"},on:{change:t.onFileChanged}},"input",t.$attrs,!1)),t.uh.submitted?r("span",{staticClass:"fa fa-circle-o-notch fa-spin ml-auto"}):t._e(),t.value&&!t.uh.submitted?r("span",{staticClass:"fa fa-check ml-auto"}):t._e()]),t.value?r("div",{staticClass:"mt-2"},[r("a",{staticClass:"small",attrs:{href:t.value,target:"_blank"}},[t._v("Download")]),t.uh.errors[t.file_name]?r("div",{staticClass:"small text-danger mt-2",domProps:{textContent:t._s(t.uh.errors[t.file_name][0])}}):t._e()]):t._e()])},s=[]}}]);