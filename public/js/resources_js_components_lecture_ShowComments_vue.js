"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_lecture_ShowComments_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tiptap-vuetify */ "./node_modules/tiptap-vuetify/dist/bundle-esm.js");
/* harmony import */ var _services_auth_auth__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/auth/auth */ "./resources/js/services/auth/auth.js");
/* harmony import */ var _loader_ExportLoading__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../loader/ExportLoading */ "./resources/js/components/loader/ExportLoading.vue");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "ShowComments",
  data: function data() {
    return {
      user: _services_auth_auth__WEBPACK_IMPORTED_MODULE_1__["default"].user().id,
      is_admin: _services_auth_auth__WEBPACK_IMPORTED_MODULE_1__["default"].user().role[0].name === 'admin',
      dialog: false,
      newComment: {
        user_id: 0,
        lecture_id: this.$route.params.id,
        comment: ''
      },
      editField: false,
      extensions: [tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.History, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Blockquote, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Link, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Underline, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Strike, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Italic, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.ListItem, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.BulletList, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.OrderedList, [tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Heading, {
        options: {
          levels: [1, 2, 3]
        }
      }], tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Bold, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Code, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.HorizontalRule, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.Paragraph, tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.HardBreak]
    };
  },
  components: {
    ExportLoading: _loader_ExportLoading__WEBPACK_IMPORTED_MODULE_2__["default"],
    TiptapVuetify: tiptap_vuetify__WEBPACK_IMPORTED_MODULE_0__.TiptapVuetify
  },
  computed: (0,vuex__WEBPACK_IMPORTED_MODULE_3__.mapState)({
    comments: function comments(state) {
      return state.comment.comments;
    },
    quantity: function quantity(state) {
      return state.comment.quantity;
    },
    loading: function loading(state) {
      return state.comment.loading;
    },
    limit: function limit(state) {
      return state.comment.limit;
    },
    busy: function busy(state) {
      return state.comment.busy;
    }
  }),
  mounted: function mounted() {},
  methods: _objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_3__.mapActions)('comment', ['getComments', 'addComment', 'updateComment', 'exportComments'])), {}, {
    loadMore: function loadMore() {
      this.getComments(this.$route.params.id);
    },
    update: function update(data) {
      this.updateComment(data);
    }
  })
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "mt-3"
  }, [_c("v-dialog", {
    attrs: {
      width: "500"
    },
    model: {
      value: _vm.dialog,
      callback: function callback($$v) {
        _vm.dialog = $$v;
      },
      expression: "dialog"
    }
  }, [_c("export-loading")], 1), _vm._v(" "), _c("v-layout", {
    attrs: {
      "justify-center": ""
    }
  }, [_c("v-card", {
    attrs: {
      width: "50%"
    }
  }, [_c("v-card-title", {
    staticClass: "text-h4"
  }, [_vm._v("Comments " + _vm._s(_vm.quantity))]), _c("hr", {
    staticClass: "marg-auto",
    attrs: {
      width: "90%"
    }
  }), _vm._v(" "), _c("v-card-subtitle", {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.is_admin,
      expression: "is_admin"
    }]
  }, [_c("v-btn", {
    attrs: {
      color: "blue",
      text: ""
    },
    on: {
      click: function click($event) {
        _vm.exportComments(_vm.$route.params.id);
        _vm.dialog = true;
      }
    }
  }, [_vm._v("Export comments")])], 1), _vm._v(" "), _c("v-card-text", [_c("v-form", {
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.addComment(_vm.newComment);
      }
    }
  }, [_c("tiptap-vuetify", {
    staticClass: "mb-2",
    attrs: {
      extensions: _vm.extensions
    },
    model: {
      value: _vm.newComment.comment,
      callback: function callback($$v) {
        _vm.$set(_vm.newComment, "comment", $$v);
      },
      expression: "newComment.comment"
    }
  }), _vm._v(" "), _c("v-btn", {
    attrs: {
      color: "secondary",
      type: "submit"
    }
  }, [_vm._v("Send")])], 1)], 1), _vm._v(" "), _c("v-card-text", {
    staticClass: "text--primary"
  }, [_c("div", {
    directives: [{
      name: "infinite-scroll",
      rawName: "v-infinite-scroll",
      value: _vm.loadMore,
      expression: "loadMore"
    }],
    attrs: {
      "infinite-scroll-disabled": "busy",
      "infinite-scroll-distance": "limit"
    }
  }, [_vm._l(_vm.comments, function (comment) {
    return _c("v-card", {
      key: comment.id,
      staticClass: "mb-2"
    }, [_c("v-card-title", {
      staticClass: "text-h6"
    }, [_vm._v(_vm._s(comment.firstname) + " " + _vm._s(comment.lastname))]), _vm._v(" "), _c("v-card-subtitle", [_vm._v(_vm._s(new Date(comment.created_at).toLocaleDateString("en-us", {
      weekday: "long",
      year: "numeric",
      month: "short",
      day: "numeric"
    })))]), _vm._v(" "), _c("v-card-text", {
      staticClass: "text--primary",
      domProps: {
        innerHTML: _vm._s(comment.comment)
      }
    }), _vm._v(" "), comment.user_id === _vm.user && Math.round((new Date() - new Date(comment.created_at)) % 86400000 % 3600000 / 60000) < 10 ? _c("v-card-actions", [_c("v-btn", {
      attrs: {
        text: "",
        align: "right"
      },
      on: {
        click: function click($event) {
          _vm.editField = !_vm.editField;
        }
      }
    }, [_vm._v("Edit")]), _vm._v(" "), _vm.editField ? _c("v-card-text", [_c("v-form", {
      on: {
        submit: function submit($event) {
          $event.preventDefault();
          return _vm.updateComment(comment);
        }
      }
    }, [_c("tiptap-vuetify", {
      staticClass: "mb-2",
      attrs: {
        extensions: _vm.extensions
      },
      model: {
        value: comment.comment,
        callback: function callback($$v) {
          _vm.$set(comment, "comment", $$v);
        },
        expression: "comment.comment"
      }
    }), _vm._v(" "), _c("v-btn", {
      attrs: {
        text: "",
        type: "submit"
      }
    }, [_vm._v("Save")])], 1)], 1) : _vm._e()], 1) : _vm._e()], 1);
  }), _vm._v(" "), _vm.loading ? _c("v-progress-circular", {
    attrs: {
      indeterminate: "",
      color: "primary"
    }
  }) : _vm._e()], 2)])], 1)], 1)], 1);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/lecture/ShowComments.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/lecture/ShowComments.vue ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShowComments.vue?vue&type=template&id=7516de26&scoped=true& */ "./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true&");
/* harmony import */ var _ShowComments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShowComments.vue?vue&type=script&lang=js& */ "./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ShowComments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "7516de26",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/lecture/ShowComments.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowComments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowComments.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowComments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true& ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowComments_vue_vue_type_template_id_7516de26_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowComments.vue?vue&type=template&id=7516de26&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowComments.vue?vue&type=template&id=7516de26&scoped=true&");


/***/ })

}]);