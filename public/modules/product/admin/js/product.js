!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=248)}({248:function(e,t,n){e.exports=n(292)},292:function(e,t,n){"use strict";function o(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}n.r(t);var r=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.downloadHtml=this.getDownloadHtml(t)}var t,n,r;return t=e,(n=[{key:"getDownloadHtml",value:function(e){var t=_.template($("#product-download-template").html());return $(t(e))}},{key:"render",value:function(){return this.attachEventListeners(),this.downloadHtml}},{key:"attachEventListeners",value:function(){var e=this;this.downloadHtml.find(".delete-row").on("click",(function(){e.downloadHtml.remove()})),this.downloadHtml.find(".btn-choose-file").on("click",(function(){(new MediaPicker).on("select",(function(t){e.downloadHtml.find(".download-name").val(t.filename),e.downloadHtml.find(".download-file").val(t.id)}))}))}}])&&o(t.prototype,n),r&&o(t,r),e}();function a(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=function(e,t){if(!e)return;if("string"==typeof e)return i(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return i(e,t)}(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var o=0,r=function(){};return{s:r,n:function(){return o>=e.length?{done:!0}:{done:!1,value:e[o++]}},e:function(e){throw e},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,l=!0,u=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return l=e.done,e},e:function(e){u=!0,a=e},f:function(){try{l||null==n.return||n.return()}finally{if(u)throw a}}}}function i(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,o=new Array(t);n<t;n++)o[n]=e[n];return o}function l(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}var u=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.downloadsCount=0,this.addDownloads(FleetCart.data["product.downloads"]),0===this.downloadsCount&&this.addDownload(),this.attachEventListeners(),this.makeDownloadsSortable()}var t,n,o;return t=e,(n=[{key:"addDownloads",value:function(e){var t,n=a(e);try{for(n.s();!(t=n.n()).done;){var o=t.value;this.addDownload(o)}}catch(e){n.e(e)}finally{n.f()}}},{key:"addDownload",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=new r({download:e});$("#downloads-wrapper").append(t.render()),this.downloadsCount++,window.admin.tooltip()}},{key:"attachEventListeners",value:function(){var e=this;$("#add-new-file").on("click",(function(){e.addDownload()}))}},{key:"makeDownloadsSortable",value:function(){Sortable.create(document.getElementById("downloads-wrapper"),{handle:".drag-icon",animation:150})}}])&&l(t.prototype,n),o&&l(t,o),e}();function d(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.managerStock(),window.admin.removeSubmitButtonOffsetOn(["#images","#downloads","#attributes","#options","#related_products","#cross_sells","#reviews"]),$("#product-create-form, #product-edit-form").on("submit",this.submit),""===$("#slug").val()&&$("#name").on("blur",(function(){$("#slug").val(window.admin.generateSlug($(this).val()))}))}var t,n,o;return t=e,(n=[{key:"managerStock",value:function(){$("#manage_stock").on("change",(function(e){"1"===e.currentTarget.value?$("#qty-field").removeClass("hide"):$("#qty-field").addClass("hide")}))}},{key:"submit",value:function(e){e.preventDefault(),DataTable.removeLengthFields(),window.form.appendHiddenInputs("#product-create-form, #product-edit-form","cross_sells",DataTable.getSelectedIds("#cross_sells .table")),window.form.appendHiddenInputs("#product-create-form, #product-edit-form","related_products",DataTable.getSelectedIds("#related_products .table")),e.currentTarget.submit()}}])&&d(t.prototype,n),o&&d(t,o),e}()),new u}});
//# sourceMappingURL=product.js.map