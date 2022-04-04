!function(e){var t={};function n(r){if(t[r])return t[r].exports;var a=t[r]={i:r,l:!1,exports:{}};return e[r].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(r,a,function(t){return e[t]}.bind(null,a));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=231)}({231:function(e,t,n){e.exports=n(294)},294:function(e,t,n){"use strict";function r(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}n.r(t);var a=function(){function e(t,n){var r=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.selector=n,$.jstree.defaults.dnd.touch=!0,$.jstree.defaults.dnd.copy=!1,this.fetchCategoryTree(),n.on("select_node.jstree",(function(e,n){return t.fetchCategory(n.selected[0])})),n.on("loaded.jstree",(function(){return n.jstree("open_all")})),this.selector.on("move_node.jstree",(function(e,t){r.updateCategoryTree(t)}))}var t,n,a;return t=e,(n=[{key:"fetchCategoryTree",value:function(){this.selector.jstree({core:{data:{url:route("admin.categories.tree")},check_callback:!0},plugins:["dnd"]})}},{key:"updateCategoryTree",value:function(e){var t=this;this.loading(e.node,!0),$.ajax({type:"PUT",url:route("admin.categories.tree.update"),data:{category_tree:this.getCategoryTree()},success:function(e){function t(t){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}((function(n){success(n),t.loading(e.node,!1)})),error:function(e){function t(t){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}((function(n){error(n.responseJSON.message),t.loading(e.node,!1)}))})}},{key:"getCategoryTree",value:function(){return this.selector.jstree(!0).get_json("#",{flat:!0}).reduce((function(e,t){return e.concat({id:t.id,parent_id:"#"===t.parent?null:t.parent,position:t.data.position})}),[])}},{key:"loading",value:function(e,t){var n=this.selector.jstree().get_node(e,!0);t?$(n).addClass("jstree-loading"):$(n).removeClass("jstree-loading")}}])&&r(t.prototype,n),a&&r(t,a),e}();function o(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e);var t=$(".category-tree");new a(this,t),this.collapseAll(t),this.expandAll(t),this.addRootCategory(),this.addSubCategory(),$("#category-form").on("submit",this.submit),""===$("#slug").val()&&$("#name").on("blur",(function(){$("#slug").val(window.admin.generateSlug($(this).val()))})),window.admin.removeSubmitButtonOffsetOn("#image",".category-details-tab li > a")}var t,n,r;return t=e,(n=[{key:"collapseAll",value:function(e){$(".collapse-all").on("click",(function(t){t.preventDefault(),e.jstree("close_all")}))}},{key:"expandAll",value:function(e){$(".expand-all").on("click",(function(t){t.preventDefault(),e.jstree("open_all")}))}},{key:"addRootCategory",value:function(){var e=this;$(".add-root-category").on("click",(function(){e.loading(!0),$(".add-sub-category").addClass("disabled"),$(".category-tree").jstree("deselect_all"),e.clear(),setTimeout(e.loading,150,!1)}))}},{key:"addSubCategory",value:function(){var e=this;$(".add-sub-category").on("click",(function(){var t=$(".category-tree").jstree("get_selected")[0];void 0!==t&&(e.clear(),e.loading(!0),window.form.appendHiddenInput("#category-form","parent_id",t),setTimeout(e.loading,150,!1))}))}},{key:"fetchCategory",value:function(e){var t=this;this.loading(!0),$(".add-sub-category").removeClass("disabled"),$.ajax({type:"GET",url:route("admin.categories.show",e),success:function(e){t.update(e),t.loading(!1)},error:function(e){function t(t){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}((function(e){error(e.responseJSON.message),t.loading(!1)}))})}},{key:"update",value:function(e){window.form.removeErrors(),$(".btn-delete").removeClass("hide"),$(".form-group .help-block").remove(),$("#confirmation-form").attr("action",route("admin.categories.destroy",e.id)),$("#id-field").removeClass("hide"),$("#id").val(e.id),$("#name").val(e.name),""===e.slug&&$("#name").on("blur",(function(){$("#slug").val(window.admin.generateSlug($(this).val()))})),$("#slug").val(e.slug),$("#slug-field").removeClass("hide"),$(".category-details-tab .seo-tab").removeClass("hide"),$("#is_searchable").prop("checked",e.is_searchable),$("#is_active").prop("checked",e.is_active),$(".logo .image-holder-wrapper").html(this.categoryImage("logo",e.logo)),$(".banner .image-holder-wrapper").html(this.categoryImage("banner",e.banner)),$('#category-form input[name="parent_id"]').remove()}},{key:"categoryImage",value:function(e,t){return t.exists?'\n            <div class="image-holder">\n                <img src="'.concat(t.path,'">\n                <button type="button" class="btn remove-image" data-input-name="files[').concat(e,']"></button>\n                <input type="hidden" name="files[').concat(e,']" value="').concat(t.id,'">\n            </div>\n        '):this.imagePlaceholder()}},{key:"clear",value:function(){$("#id-field").addClass("hide"),$("#id").val(""),$("#name").val(""),$("#slug").val(""),$("#slug-field").addClass("hide"),$(".category-details-tab .seo-tab").addClass("hide"),$("#is_searchable").prop("checked",!1),$("#is_active").prop("checked",!1),$(".logo .image-holder-wrapper").html(this.imagePlaceholder()),$(".banner .image-holder-wrapper").html(this.imagePlaceholder()),$(".btn-delete").addClass("hide"),$(".form-group .help-block").remove(),$('#category-form input[name="parent_id"]').remove(),$(".general-information-tab a").click()}},{key:"imagePlaceholder",value:function(){return'\n            <div class="image-holder placeholder">\n                <i class="fa fa-picture-o"></i>\n            </div>\n        '}},{key:"loading",value:function(e){!0===e?$(".overlay.loader").removeClass("hide"):$(".overlay.loader").addClass("hide")}},{key:"submit",value:function(e){var t=$(".category-tree").jstree("get_selected")[0];$("#slug-field").hasClass("hide")||(window.form.appendHiddenInput("#category-form","_method","put"),$("#category-form").attr("action",route("admin.categories.update",t))),e.currentTarget.submit()}}])&&o(t.prototype,n),r&&o(t,r),e}())}});
//# sourceMappingURL=category.js.map