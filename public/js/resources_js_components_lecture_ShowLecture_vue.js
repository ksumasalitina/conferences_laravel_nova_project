"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_lecture_ShowLecture_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _services_auth_auth__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/auth/auth */ "./resources/js/services/auth/auth.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "ShowLecture",
  data: function data() {
    return {
      user: _services_auth_auth__WEBPACK_IMPORTED_MODULE_0__["default"].user().id
    };
  },
  computed: (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapState)({
    lecture: function lecture(state) {
      return state.lecture.lectures;
    }
  }),
  mounted: function mounted() {
    this.getLecture(this.$route.params.id);
  },
  methods: _objectSpread(_objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapActions)('meeting', ['cancel'])), (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapActions)('lecture', ['getLecture', 'deleteLecture'])), {}, {
    cancelParticipation: function cancelParticipation() {
      this.deleteLecture(this.lecture.id);
      this.cancel(this.lecture.meeting_id);
      this.$router.push({
        name: 'home'
      });
    }
  })
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("v-layout", {
    attrs: {
      "justify-center": ""
    }
  }, [_c("v-card", {
    attrs: {
      width: "40%"
    }
  }, [_c("v-card-title", {
    staticClass: "text-h4"
  }, [_vm._v(_vm._s(_vm.lecture.theme))]), _c("hr", {
    staticClass: "marg-auto",
    attrs: {
      width: "90%"
    }
  }), _vm._v(" "), _c("v-card-text", {
    staticClass: "text--primary"
  }, [_vm._v(_vm._s(_vm.lecture.start) + " - " + _vm._s(_vm.lecture.end))]), _vm._v(" "), _c("hr", {
    staticClass: "marg-auto",
    attrs: {
      width: "90%"
    }
  }), _vm._v(" "), _c("v-card-text", {
    staticClass: "text--primary"
  }, [_vm._v(_vm._s(_vm.lecture.description))]), _c("hr", {
    staticClass: "marg-auto",
    attrs: {
      width: "90%"
    }
  }), _vm._v(" "), _vm.lecture.user_id === _vm.user ? _c("v-card-actions", [_c("v-btn", {
    attrs: {
      color: "blue",
      to: {
        name: "edit_lecture"
      }
    }
  }, [_vm._v("Edit")]), _vm._v(" "), _c("v-btn", {
    attrs: {
      color: "red"
    },
    on: {
      click: _vm.cancelParticipation
    }
  }, [_vm._v("Cancel participation")])], 1) : _vm._e()], 1)], 1);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/lecture/ShowLecture.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/lecture/ShowLecture.vue ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true& */ "./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true&");
/* harmony import */ var _ShowLecture_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ShowLecture.vue?vue&type=script&lang=js& */ "./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ShowLecture_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "6ae06695",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/lecture/ShowLecture.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowLecture_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowLecture.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowLecture_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true& ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ShowLecture_vue_vue_type_template_id_6ae06695_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/lecture/ShowLecture.vue?vue&type=template&id=6ae06695&scoped=true&");


/***/ })

}]);