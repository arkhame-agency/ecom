!function(t){var e={};function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(o,r,function(e){return t[e]}.bind(null,r));return o},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=243)}({243:function(t,e,n){t.exports=n(287)},287:function(t,e,n){"use strict";function o(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==n)return;var o,r,i=[],a=!0,u=!1;try{for(n=n.call(t);!(a=(o=n.next()).done)&&(i.push(o.value),!e||i.length!==e);a=!0);}catch(t){u=!0,r=t}finally{try{a||null==n.return||n.return()}finally{if(u)throw r}}return i}(t,e)||r(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function r(t,e){if(t){if("string"==typeof t)return i(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?i(t,e):void 0}}function i(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}function a(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}n.r(e);var u=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t)}var e,n,i;return e=t,(n=[{key:"addOptionsErrors",value:function(t){for(var e in t){var n=this.getInputFieldForErrorKey(e);n.closest(".option").addClass("option-has-errors"),n.parent().append('<span class="help-block">'.concat(t[e][0],"</span>"))}}},{key:"getRowTemplate",value:function(t){var e=_.template($("#option-select-values-template").html());return $(e(t))}},{key:"changeOptionType",value:function(t){var e=t.optionId,n=t.type,o=t.values,r=void 0===o?[]:o,i=this.getOptionValuesElement(e),a=this.getTemplateType(n,i),u={optionId:e,value:{id:"",label:"",price:"",price_type:"fixed"}};if(!this.shouldNotChangeTemplate(a,i)){0!==r.length&&"text"===a&&(u.value=r[0]);var l=_.template($("#option-".concat(a,"-template")).html());i.html(l(u)),"select"===a&&(this.addOptionRowEventListener(e),this.addOptionRows({optionId:e,values:r}),0===r.length&&this.getAddNewRowButton(e).trigger("click"))}}},{key:"addOptionRows",value:function(t){var e,n=t.optionId,i=function(t,e){var n="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!n){if(Array.isArray(t)||(n=r(t))||e&&t&&"number"==typeof t.length){n&&(t=n);var o=0,i=function(){};return{s:i,n:function(){return o>=t.length?{done:!0}:{done:!1,value:t[o++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,u=!0,l=!1;return{s:function(){n=n.call(t)},n:function(){var t=n.next();return u=t.done,t},e:function(t){l=!0,a=t},f:function(){try{u||null==n.return||n.return()}finally{if(l)throw a}}}}(t.values.entries());try{for(i.s();!(e=i.n()).done;){var a=o(e.value,2),u=a[0],l=a[1];this.addOptionRow({optionId:n,valueId:u,value:l})}}catch(t){i.e(t)}finally{i.f()}}},{key:"getTemplateType",value:function(t){return this.templateTypeIsText(t)?"text":this.templateTypeIsSelect(t)?"select":void 0}},{key:"templateTypeIsText",value:function(t){return["field","textarea","date","date_time","time"].includes(t)}},{key:"templateTypeIsSelect",value:function(t){return["dropdown","checkbox","checkbox_custom","radio","radio_custom","multiple_select"].includes(t)}},{key:"shouldNotChangeTemplate",value:function(t,e){return void 0===t||this.alreadyHasCurrentTemplate(t,e)}},{key:"alreadyHasCurrentTemplate",value:function(t,e){return"text"===t?e.children().hasClass("option-text"):"select"===t?e.children().hasClass("option-select"):void 0}},{key:"initOptionRow",value:function(t,e){0===e.length||e.is(".sortable")||(this.makeSortable(e[0]),e.addClass("sortable")),this.deleteOptionRowEventListener(t),window.admin.tooltip()}},{key:"deleteOptionRowEventListener",value:function(t){t.find(".delete-row").on("click",(function(t){$(t.currentTarget).closest(".option-row").remove()}))}},{key:"makeSortable",value:function(t){Sortable.create(t,{handle:".drag-icon",animation:150})}}])&&a(e.prototype,n),i&&a(e,i),t}();function l(t){return(l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}function p(t,e){return(p=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,o=v(t);if(e){var r=v(this).constructor;n=Reflect.construct(o,arguments,r)}else n=o.apply(this,arguments);return s(this,n)}}function s(t,e){return!e||"object"!==l(e)&&"function"!=typeof e?d(t):e}function d(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}function y(t,e,n){return(y="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){var o=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=v(t)););return t}(t,e);if(o){var r=Object.getOwnPropertyDescriptor(o,e);return r.get?r.get.call(n):r.value}})(t,e,n||t)}function v(t){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var h=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&p(t,e)}(i,t);var e,n,o,r=f(i);function i(){var t,e,n;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,i),n=r.call(this);var o=FleetCart.data["option.values"];return $("#type").on("change",(function(r){y((t=d(n),v(i.prototype)),"changeOptionType",t).call(t,{type:r.currentTarget.value,values:o}),y((e=d(n),v(i.prototype)),"addOptionsErrors",e).call(e,FleetCart.errors["option.values"])})),$("#type").trigger("change"),window.admin.removeSubmitButtonOffsetOn("#values"),n}return e=i,(n=[{key:"addOptionRow",value:function(t){var e=t.valueId,n=t.value,o=void 0===n?{label:"",price:"",price_type:"fixed"}:n,r=this.getRowTemplate({optionId:void 0,valueId:e,value:o}),a=$("#select-values").append(r);y(v(i.prototype),"initOptionRow",this).call(this,r,a)}},{key:"addOptionRowEventListener",value:function(){var t=this;$("#add-new-row").on("click",(function(){var e=$("#option-values .option-row").length;t.addOptionRow({valueId:e})}))}},{key:"getOptionValuesElement",value:function(){return $("#option-values")}},{key:"getAddNewRowButton",value:function(){return $("#add-new-row")}},{key:"getInputFieldForErrorKey",value:function(t){var e=t.split(".");return e=e.map((function(t){return t.split("_").join("-")})),$("#".concat(e.join("-")))}}])&&c(e.prototype,n),o&&c(e,o),i}(u);function m(t){return(m="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function b(t,e){var n="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!n){if(Array.isArray(t)||(n=function(t,e){if(!t)return;if("string"==typeof t)return g(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return g(t,e)}(t))||e&&t&&"number"==typeof t.length){n&&(t=n);var o=0,r=function(){};return{s:r,n:function(){return o>=t.length?{done:!0}:{done:!1,value:t[o++]}},e:function(t){throw t},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,a=!0,u=!1;return{s:function(){n=n.call(t)},n:function(){var t=n.next();return a=t.done,t},e:function(t){u=!0,i=t},f:function(){try{a||null==n.return||n.return()}finally{if(u)throw i}}}}function g(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}function w(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}function O(t,e){return(O=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function k(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,o=S(t);if(e){var r=S(this).constructor;n=Reflect.construct(o,arguments,r)}else n=o.apply(this,arguments);return T(this,n)}}function T(t,e){return!e||"object"!==m(e)&&"function"!=typeof e?j(t):e}function j(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}function R(t,e,n){return(R="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){var o=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=S(t)););return t}(t,e);if(o){var r=Object.getOwnPropertyDescriptor(o,e);return r.get?r.get.call(n):r.value}})(t,e,n||t)}function S(t){return(S=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}var I=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&O(t,e)}(i,t);var e,n,o,r=k(i);function i(){var t,e;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,i),(e=r.call(this)).optionsCount=0,e.addOptions(FleetCart.data["product.options"]),0===e.optionsCount&&e.addOption(),e.optionsCount>3&&e.collapseOptions(),R((t=j(e),S(i.prototype)),"addOptionsErrors",t).call(t,FleetCart.errors["product.options"]),$("#add-new-option").on("click",(function(){return e.addOption()})),$("#add-global-option").on("click",(function(){return e.addGlobalOption()})),e}return e=i,(n=[{key:"addOptions",value:function(t){var e,n=b(t);try{for(n.s();!(e=n.n()).done;){var o=e.value;this.addOption(o)}}catch(t){n.e(t)}finally{n.f()}}},{key:"collapseOptions",value:function(){var t,e=b($(".option:not(.option-has-errors)"));try{for(e.s();!(t=e.n()).done;){var n=t.value;$(n).find("[data-toggle=collapse]").trigger("click")}}catch(t){e.e(t)}finally{e.f()}}},{key:"addGlobalOption",value:function(){var t=this,e=$("#global-option").val();if(""===e)return window.admin.stopButtonLoading($("#add-global-option"));$.ajax({type:"GET",url:route("admin.options.show",e),dataType:"json",success:function(e){t.addOption(e),window.admin.stopButtonLoading($("#add-global-option"))}})}},{key:"addOption",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{id:null,name:null,type:null,is_required:!1,values:[]};t.is_required=!!JSON.parse(t.is_required);var e=this.optionsCount,n=_.template($("#option-template").html()),o=$(n({option:t,optionId:e}));null!==t.name&&setTimeout((function(){$("#option-".concat(e)).find("#option-name").text(t.name)}));var r=$("#options-group").append(o);r.is(".sortable")||(R(S(i.prototype),"makeSortable",this).call(this,r[0]),r.addClass("sortable")),this.deleteOptionEventListener(o),this.updateOptionNameEventListener(e),this.updateTemplateEventListener(e,t.values),window.admin.tooltip(),this.optionsCount++}},{key:"deleteOptionEventListener",value:function(t){t.find(".delete-option").on("click",(function(t){return $(t.currentTarget).closest(".option").remove()}))}},{key:"updateOptionNameEventListener",value:function(t){var e=$("#option-".concat(t)),n=e.find("#option-name").text();$(e).find(".option-name-field").on("input",(function(t){var o=""!==t.currentTarget.value?t.currentTarget.value:n;e.find("#option-name").text(o)}))}},{key:"updateTemplateEventListener",value:function(t){var e=this,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[],o=$("#option-".concat(t,"-type"));o.on("change",(function(o){var r=o.currentTarget.value;if(""===r)return e.getOptionValuesElement(t).html("");R(S(i.prototype),"changeOptionType",e).call(e,{optionId:t,type:r,values:n})})),o.trigger("change")}},{key:"addOptionRow",value:function(t){var e=t.optionId,n=t.valueId,o=t.value,r=void 0===o?{label:"",price:"",price_type:"fixed"}:o,a=this.getRowTemplate({optionId:e,valueId:n,value:r}),u=$("#option-".concat(e,"-select-values")).append(a);R(S(i.prototype),"initOptionRow",this).call(this,a,u)}},{key:"addOptionRowEventListener",value:function(t){var e=this;$("#option-".concat(t,"-add-new-row")).on("click",(function(){var n=$("#option-".concat(t,"-values .option-row")).length;e.addOptionRow({optionId:t,valueId:n})}))}},{key:"getOptionValuesElement",value:function(t){return $("#option-".concat(t,"-values"))}},{key:"getAddNewRowButton",value:function(t){return $("#option-".concat(t,"-add-new-row"))}},{key:"getInputFieldForErrorKey",value:function(t){var e=t.split(".");return e.shift(),e=e.map((function(t){return t.split("_").join("-")})),$("#option-".concat(e.join("-")))}}])&&w(e.prototype,n),o&&w(e,o),i}(u);0!==$("#option-create-form, #option-edit-form").length&&new h,0!==$("#product-create-form, #product-edit-form").length&&new I}});
//# sourceMappingURL=option.js.map