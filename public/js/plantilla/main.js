"use strict";
(self["webpackChunkbase_angular"] = self["webpackChunkbase_angular"] || []).push([["main"],{

/***/ 92:
/*!**********************************!*\
  !*** ./src/app/app.component.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   AppComponent: () => (/* binding */ AppComponent),
/* harmony export */   AppInjector: () => (/* binding */ AppInjector)
/* harmony export */ });
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/router */ 5072);
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs */ 3942);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/platform-browser */ 436);





let AppInjector;
class AppComponent {
  constructor(injector, routerBase, activatedRouteBase, titleServiceBase) {
    this.injector = injector;
    this.routerBase = routerBase;
    this.activatedRouteBase = activatedRouteBase;
    this.titleServiceBase = titleServiceBase;
    // Titulos
    this.title = 'Gestión Académica';
    this.title_componentBase = '';
    AppInjector = this.injector;
  }
  ngOnInit() {
    // Cambiar nombre de ruta
    this.routerBase.events.subscribe(event => {
      if (event instanceof _angular_router__WEBPACK_IMPORTED_MODULE_0__.NavigationEnd) {
        this.title_componentBase = this.getRouteDataBase(this.activatedRouteBase.root, 'title') || 'Default Title';
        // Encuentra la posición del último "/"
        const lastIndex = this.title_componentBase.lastIndexOf('/');
        // Extrae el texto después del último "/"
        const extractedTitle = lastIndex !== -1 ? this.title_componentBase.substring(lastIndex + 1) : this.title_componentBase;
        // Formatea el texto extraído (capitaliza la primera letra y reemplaza guiones con espacios)
        const formattedTitle = this.formatTitle(extractedTitle);
        // Establece el título en la pestaña del navegador
        this.titleServiceBase.setTitle(formattedTitle);
        // Url de la ruta
        document.documentElement.style.setProperty('--title-length', formattedTitle.length.toString());
      }
    });
  }
  // Navegacion
  getRouteDataBase(route, key) {
    if (route.firstChild) {
      const childData = this.getRouteDataBase(route.firstChild, key);
      return childData instanceof rxjs__WEBPACK_IMPORTED_MODULE_1__.Observable ? null : childData;
    }
    return route && route.snapshot && route.snapshot.data && route.snapshot.data[key];
  }
  // Convertir primera en mayuscula
  capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  // Capitalizar la primera letra de una cadena y reemplazar guiones con espacios
  formatTitle(text) {
    const titleWithoutDash = text.replace(/-/g, ' ');
    return this.capitalizeFirstLetter(titleWithoutDash);
  }
  static #_ = this.ɵfac = function AppComponent_Factory(t) {
    return new (t || AppComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_core__WEBPACK_IMPORTED_MODULE_2__.Injector), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_0__.Router), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_0__.ActivatedRoute), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__.Title));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: AppComponent,
    selectors: [["app-root"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵStandaloneFeature"]],
    decls: 1,
    vars: 0,
    template: function AppComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](0, "router-outlet");
      }
    },
    dependencies: [_angular_router__WEBPACK_IMPORTED_MODULE_0__.RouterOutlet],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n\n\n\n\nbody[_ngcontent-%COMP%]::-webkit-scrollbar {\n  width: 5px;\n  height: 5px;\n}\nbody[_ngcontent-%COMP%]::-webkit-scrollbar-track {\n  background: rgba(64, 69, 108, 0.2);\n}\nbody[_ngcontent-%COMP%]::-webkit-scrollbar-thumb {\n  border: 1px solid #1a1c2c;\n  background: rgba(64, 69, 108, 0.1);\n  border-radius: 20px;\n  box-shadow: inset 1px 1px 0 rgba(64, 69, 108, 0.9), inset -1px -1px 0 rgba(64, 69, 108, 0.9);\n}\nbody[_ngcontent-%COMP%]::-webkit-scrollbar-thumb:hover {\n  background: rgba(64, 69, 108, 0.9);\n}\nbody[_ngcontent-%COMP%]::-webkit-scrollbar-button {\n  width: 0px;\n  height: 0px;\n}\n\n\n\n\n\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]::-webkit-scrollbar {\n  width: 5px;\n  height: 5px;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]::-webkit-scrollbar-track {\n  background: rgba(128, 128, 128, 0.2);\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]::-webkit-scrollbar-thumb {\n  background: rgba(128, 128, 128, 0.8);\n  -webkit-transition: 0.5s;\n  transition: 0.5s;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]::-webkit-scrollbar-thumb:hover {\n  -webkit-transition: 0.5s;\n  transition: 0.5s;\n  background: rgba(64, 69, 108, 0.8);\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]::-webkit-scrollbar-button {\n  width: 0px;\n  height: 0px;\n}\n\n  *,   *::after,   *::before {\n  box-sizing: border-box;\n}\n\n  body {\n  background-color: #ecf0f3;\n}\n\n  .global_contenedor {\n  position: absolute;\n  width: 100%;\n  height: 100vh;\n  min-height: 520px;\n  display: grid;\n  left: 50%;\n  justify-content: center;\n  align-items: center;\n  color: #808080;\n  align-content: center;\n  overflow: hidden !important;\n  transform: translate(-50%, 0%);\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC9hcHAuY29tcG9uZW50LnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvY29tcG9uZW50cy9fc2Nyb2xsLnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fY29sb3JzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNSRjs7QUNoQ0E7O3NDQUFBO0FBS0U7RUFDRSxVQUFBO0VBQ0EsV0FBQTtBRGlDSjtBQzlCRTtFQUNFLGtDQUFBO0FEZ0NKO0FDN0JFO0VBQ0UseUJBQUE7RUFDQSxrQ0FBQTtFQUNBLG1CQUFBO0VBQ0EsNEZBQ0U7QUQ4Qk47QUMxQkU7RUFDRSxrQ0FBQTtBRDRCSjtBQ3pCRTtFQUNFLFVBQUE7RUFDQSxXQUFBO0FEMkJKOztBQ3ZCQTs7c0NBQUE7QUFNSTtFQUNFLFVBQUE7RUFDQSxXQUFBO0FEdUJOO0FDcEJJO0VBQ0Usb0NBQUE7QURzQk47QUNuQkk7RUFDRSxvQ0FBQTtFQUNBLHdCQUFBO0VBQUEsZ0JBQUE7QURxQk47QUNuQk07RUFDRSx3QkFBQTtFQUFBLGdCQUFBO0VBQ0Esa0NBQUE7QURxQlI7QUNqQkk7RUFDRSxVQUFBO0VBQ0EsV0FBQTtBRG1CTjs7QUF6RUE7OztFQUdFLHNCQUFBO0FBNEVGOztBQXpFQTtFQUNFLHlCRVBZO0FGbUZkOztBQXpFQTtFQUNFLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLGFBQUE7RUFDQSxpQkFBQTtFQUNBLGFBQUE7RUFDQSxTQUFBO0VBQ0EsdUJBQUE7RUFDQSxtQkFBQTtFQUNBLGNFWEs7RUZZTCxxQkFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUE0RUYiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBDb2xvcmVzIHJvb3RcclxuOnJvb3Qge1xyXG5cclxuICAvLyBzb2xpZFxyXG4gIC0tamV0OiBoc2woMCwgMCUsIDIyJSk7XHJcbiAgLS1vbnl4OiBoc2woMjQwLCAxJSwgMTclKTtcclxuXHJcbiAgLS1ibGFjazogaHNsKDAsIDAlLCAwJSk7XHJcbiAgLS1ibGFjay05MDogaHNsYSgwLCAwJSwgMCUsIDAuOSk7XHJcbiAgLS1ibGFjay04MDogaHNsYSgwLCAwJSwgMCUsIDAuOCk7XHJcbiAgLS1ibGFjay03MDogaHNsYSgwLCAwJSwgMCUsIDAuNyk7XHJcbiAgLS1ibGFjay02MDogaHNsYSgwLCAwJSwgMCUsIDAuNik7XHJcbiAgLS1ibGFjay01MDogaHNsYSgwLCAwJSwgMCUsIDAuNSk7XHJcbiAgLS1ibGFjay00MDogaHNsYSgwLCAwJSwgMCUsIDAuNCk7XHJcbiAgLS1ibGFjay0zMDogaHNsYSgwLCAwJSwgMCUsIDAuMyk7XHJcbiAgLS1ibGFjay0yMDogaHNsYSgwLCAwJSwgMCUsIDAuMik7XHJcbiAgLS1ibGFjay0xMDogaHNsYSgwLCAwJSwgMCUsIDAuMSk7XHJcblxyXG4gIC0td2hpdGU6IGhzbCgwLCAwJSwgMTAwJSk7XHJcbiAgLS13aGl0ZS05MDogaHNsKDAsIDAlLCAxMDAlLCAwLjkpO1xyXG4gIC0td2hpdGUtODA6IGhzbCgwLCAwJSwgMTAwJSwgMC44KTtcclxuICAtLXdoaXRlLTcwOiBoc2woMCwgMCUsIDEwMCUsIDAuNyk7XHJcbiAgLS13aGl0ZS02MDogaHNsKDAsIDAlLCAxMDAlLCAwLjYpO1xyXG4gIC0td2hpdGUtNTA6IGhzbCgwLCAwJSwgMTAwJSwgMC41KTtcclxuICAtLXdoaXRlLTQwOiBoc2woMCwgMCUsIDEwMCUsIDAuNCk7XHJcbiAgLS13aGl0ZS0zMDogaHNsKDAsIDAlLCAxMDAlLCAwLjMpO1xyXG4gIC0td2hpdGUtMjA6IGhzbCgwLCAwJSwgMTAwJSwgMC4yKTtcclxuICAtLXdoaXRlLTEwOiBoc2woMCwgMCUsIDEwMCUsIDAuMSk7XHJcblxyXG4gIC8vIHNoYWRvd1xyXG4gIC0tc2hhZG93LTE6IC00cHggOHB4IDI0cHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTI6IDVweCA1cHggMTBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMzogMCAxNnB4IDQwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTQ6IDAgMjVweCA1MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjE1KTtcclxuICAtLXNoYWRvdy01OiAwIDI0cHggODBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNjogMCAxNnB4IDNweCBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuXHJcbiAgLy8gQ29sb3JzXHJcbiAgLS1yZWQ6IGhzbCgwLCAxMDAlLCA1MCUpO1xyXG4gIC0teWVsbG93OiBoc2woNjAsIDEwMCUsIDUwJSk7XHJcbiAgLS1ncmVlbjogaHNsKDEyMCwgMTAwJSwgMjUlKTtcclxuICAtLWJsdWU6IGhzbCgyNDAsIDEwMCUsIDUwJSk7XHJcbiAgLS1wdXJwbGU6IGhzbCgzMDAsIDEwMCUsIDI1JSk7XHJcbn1cclxuIiwiQHVzZSBcIi4uL2Fzc2V0cy9zY3NzL3ZhcnMvY29sb3JzXCIgYXMgY29sb3JzO1xyXG5AdXNlIFwiLi4vYXNzZXRzL3Njc3MvdmFycy9mb250c1wiIGFzIGZvbnRzO1xyXG5AdXNlIFwiLi4vYXNzZXRzL3Njc3MvY29tcG9uZW50cy9zY3JvbGxcIjtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBDb250ZW5lZG9yIGRlIHZpc3Rhc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbjo6bmctZGVlcCAqLFxyXG46Om5nLWRlZXAgKjo6YWZ0ZXIsXHJcbjo6bmctZGVlcCAqOjpiZWZvcmUge1xyXG4gIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XHJcbn1cclxuXHJcbjo6bmctZGVlcCBib2R5IHtcclxuICBiYWNrZ3JvdW5kLWNvbG9yOiBjb2xvcnMuJGJnLWVsZW1lbnRzO1xyXG59XHJcblxyXG46Om5nLWRlZXAgLmdsb2JhbF9jb250ZW5lZG9yIHtcclxuICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgd2lkdGg6IDEwMCU7XHJcbiAgaGVpZ2h0OiAxMDB2aDtcclxuICBtaW4taGVpZ2h0OiA1MjBweDtcclxuICBkaXNwbGF5OiBncmlkO1xyXG4gIGxlZnQ6IDUwJTtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIGNvbG9yOiBjb2xvcnMuJGdyYXk7XHJcbiAgYWxpZ24tY29udGVudDogY2VudGVyO1xyXG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcclxuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgtNTAlLCAwJSk7XHJcbn1cclxuXHJcblxyXG4iLCJAdXNlIFwiLi4vdmFycy9jb2xvcnNcIiBhcyBjb2xvcnM7XHJcblxyXG4vKi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tKlxcXHJcbiAgIyBTY3JvbGwgUEFHRVxyXG5cXCotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovXHJcblxyXG5ib2R5IHtcclxuICAmOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICB3aWR0aDogNXB4O1xyXG4gICAgaGVpZ2h0OiA1cHg7XHJcbiAgfVxyXG5cclxuICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICBiYWNrZ3JvdW5kOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKTtcclxuICB9XHJcblxyXG4gICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkIGRhcmtlbihjb2xvcnMuJHByaW1hcnksIDIwKTtcclxuICAgIGJhY2tncm91bmQ6IHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjEpO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMjBweDtcclxuICAgIGJveC1zaGFkb3c6XHJcbiAgICAgIGluc2V0IDFweCAxcHggMCByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC45KSxcclxuICAgICAgaW5zZXQgLTFweCAtMXB4IDAgcmdiYShjb2xvcnMuJHByaW1hcnksIDAuOSk7XHJcbiAgfVxyXG5cclxuICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICBiYWNrZ3JvdW5kOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC45KTtcclxuICB9XHJcblxyXG4gICY6Oi13ZWJraXQtc2Nyb2xsYmFyLWJ1dHRvbiB7XHJcbiAgICB3aWR0aDogMHB4O1xyXG4gICAgaGVpZ2h0OiAwcHg7XHJcbiAgfVxyXG59XHJcblxyXG4vKi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tKlxcXHJcbiAgIyBTY3JvbGwgVGFibGVcclxuXFwqLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qL1xyXG5cclxuLmNvbnRlbmVkb3JfdGFibGEge1xyXG4gIC50YWJsZS1jb250YWluZXIge1xyXG4gICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICB3aWR0aDogNXB4O1xyXG4gICAgICBoZWlnaHQ6IDVweDtcclxuICAgIH1cclxuXHJcbiAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgIGJhY2tncm91bmQ6IHJnYmEoY29sb3JzLiRncmF5LCAwLjIpO1xyXG4gICAgfVxyXG5cclxuICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcclxuICAgICAgYmFja2dyb3VuZDogcmdiYShjb2xvcnMuJGdyYXksIDAuOCk7XHJcbiAgICAgIHRyYW5zaXRpb246IDAuNXM7XHJcblxyXG4gICAgICAmOmhvdmVyIHtcclxuICAgICAgICB0cmFuc2l0aW9uOiAwLjVzO1xyXG4gICAgICAgIGJhY2tncm91bmQ6IHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjgpO1xyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItYnV0dG9uIHtcclxuICAgICAgd2lkdGg6IDBweDtcclxuICAgICAgaGVpZ2h0OiAwcHg7XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcbiIsIi8vIEltcG9ydHNcclxuQHVzZSAncm9vdF9jb2xvcnMnO1xyXG5cclxuLy8gVmFyaWFibGVzIGRlIGNvbG9yZXNcclxuJHByaW1hcnk6ICM0MDQ1NmM7XHJcbiRmb2N1cy1pbnB1dDogbGlnaHRlbigkcHJpbWFyeSwgMzAlKTtcclxuXHJcbiRiZzogI2YxZjBmNjtcclxuJGJnLWVsZW1lbnRzOiAjZWNmMGYzO1xyXG4kc2hhMTogI2Y5ZjlmOTtcclxuJHNoYTI6ICNkMWQ5ZTY7XHJcbiR3aGl0ZTogI2ZmZjtcclxuXHJcbiRibGFjazogIzAwMDAwMDtcclxuJGJsYWNrLXNoYTogIzE4MTgxYztcclxuXHJcbiRncmF5OiAjODA4MDgwO1xyXG4kZ3JheS10ZXh0OiAjNDk0OTQ5O1xyXG5cclxuJG9ybzogIzcxNmI0MTtcclxuJHNoYWRvdy1vcm86ICMxNzE4MWM7XHJcblxyXG5cclxuLy8gQ29sb3IgZGUgYm90b25lc1xyXG4kYnRuczogIzNjNjhlMztcclxuJGJ0bi1jb2xvci0xOiAkYnRucztcclxuJGJ0bi1jb2xvci0yOiBkYXJrZW4oJGJ0bnMsIDEwKTtcclxuJGJ0bi1jb2xvci0zOiBkYXJrZW4oJGJ0bnMsIDIwKTtcclxuJGJ0bi1jb2xvci00OiBkYXJrZW4oJGJ0bnMsIDMwKTtcclxuJGJ0bi1jb2xvci01OiBkYXJrZW4oJGJ0bnMsIDQwKTtcclxuJGJ0bi1jb2xvci02OiBkYXJrZW4oJGJ0bnMsIDUwKTtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWJ1c2NhcjogIzI5ODBiOTtcclxuJGJ0bi1jb2xvci1pbmdyZXNhcjogIzFhNzUwMDtcclxuJGJ0bi1jb2xvci1uYXZlZ2FjaW9uOiAjMDA5YzhjO1xyXG5cclxuXHJcbiRidG4tY29sb3ItZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1idXNjYXIsIDEwKTtcclxuJGJ0bi1jb2xvci1kZWxldGUtZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1maWx0cm8sIDEwKTtcclxuJGJ0bi1jb2xvci1jb3B5OiAjMDA2ZDc3O1xyXG4kYnRuLWNvbG9yLWV4Y2VsOiAjMGU3NTNjO1xyXG4kYnRuLWNvbG9yLWNzdjogI2ZmOTgwMDtcclxuJGJ0bi1jb2xvci1wcmludDogIzE3YTJiODtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWVudmlhcjogIzI3YWU2MDtcclxuJGJ0bi1jb2xvci1udWV2bzogIzM0OThkYjtcclxuJGJ0bi1jb2xvci1lZGl0YXI6ICNmMzljMTI7XHJcbiRidG4tY29sb3ItYWN0dWFsaXphcjogIzJlY2M3MTtcclxuJGJ0bi1jb2xvci1lbGltaW5hcjogI2U3NGMzYztcclxuJGJ0bi1jb2xvci1jYW5jZWxhcjogIzk1YTVhNjtcclxuXHJcbiJdLCJzb3VyY2VSb290IjoiIn0= */"]
  });
}

/***/ }),

/***/ 289:
/*!*******************************!*\
  !*** ./src/app/app.config.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   appConfig: () => (/* binding */ appConfig)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 5072);
/* harmony import */ var _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/platform-browser/animations */ 3835);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common/http */ 6443);
/* harmony import */ var primeng_api__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! primeng/api */ 7780);
/* harmony import */ var ngx_mask__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ngx-mask */ 6769);
/* harmony import */ var _app_routes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app.routes */ 2181);
/* harmony import */ var _views_Module_module_routes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./views/Module/module.routes */ 1560);
/* harmony import */ var _core_interceptors_error_interceptor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./core/interceptors/error.interceptor */ 9446);









const appConfig = {
  providers: [(0,_angular_router__WEBPACK_IMPORTED_MODULE_3__.provideRouter)(_views_Module_module_routes__WEBPACK_IMPORTED_MODULE_1__.routesModulo1), (0,_angular_router__WEBPACK_IMPORTED_MODULE_3__.provideRouter)(_app_routes__WEBPACK_IMPORTED_MODULE_0__.routes),
  // Configura el idioma español
  {
    provide: _angular_core__WEBPACK_IMPORTED_MODULE_4__.LOCALE_ID,
    useValue: 'es'
  }, (0,_angular_common_http__WEBPACK_IMPORTED_MODULE_5__.provideHttpClient)((0,_angular_common_http__WEBPACK_IMPORTED_MODULE_5__.withInterceptors)([_core_interceptors_error_interceptor__WEBPACK_IMPORTED_MODULE_2__.errorInterceptor])), (0,_angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_6__.provideAnimations)(), primeng_api__WEBPACK_IMPORTED_MODULE_7__.MessageService, (0,ngx_mask__WEBPACK_IMPORTED_MODULE_8__.provideNgxMask)()]
};

/***/ }),

/***/ 2181:
/*!*******************************!*\
  !*** ./src/app/app.routes.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   routes: () => (/* binding */ routes),
/* harmony export */   routesArray: () => (/* binding */ routesArray)
/* harmony export */ });
/* harmony import */ var _views_error_error_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./views/error/error.component */ 1957);
/* harmony import */ var _auth_auth_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./auth/auth.component */ 998);


// Nombre de rutas
const error = '404'; // 0
const login = 'login'; // 1
// Definir el array de rutas en el constructor
const routesArray = ['/' + error, '/' + login];
// Convertir primera en mayuscula
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
const routes = [{
  path: login,
  redirectTo: login,
  pathMatch: 'full'
}, {
  path: login,
  component: _auth_auth_component__WEBPACK_IMPORTED_MODULE_1__.AuthComponent,
  data: {
    title: capitalizeFirstLetter(login)
  }
}, {
  path: error,
  component: _views_error_error_component__WEBPACK_IMPORTED_MODULE_0__.ErrorComponent,
  data: {
    title: capitalizeFirstLetter(error)
  }
},
// Redirige todas las demás rutas a la ruta de error
{
  path: '**',
  redirectTo: routesArray[0]
}];

/***/ }),

/***/ 998:
/*!****************************************!*\
  !*** ./src/app/auth/auth.component.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   AuthComponent: () => (/* binding */ AuthComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 7580);

class AuthComponent {
  static #_ = this.ɵfac = function AuthComponent_Factory(t) {
    return new (t || AuthComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: AuthComponent,
    selectors: [["app-auth"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵStandaloneFeature"]],
    decls: 2,
    vars: 0,
    template: function AuthComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1, "auth works!");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
      }
    },
    styles: ["/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 9446:
/*!********************************************************!*\
  !*** ./src/app/core/interceptors/error.interceptor.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   errorInterceptor: () => (/* binding */ errorInterceptor)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs */ 1318);
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs */ 7919);
/* harmony import */ var _services_alerts_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../services/alerts.service */ 983);
/* harmony import */ var src_app_app_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! src/app/app.component */ 92);



const errorInterceptor = (req, next) => {
  const alertService = src_app_app_component__WEBPACK_IMPORTED_MODULE_1__.AppInjector.get(_services_alerts_service__WEBPACK_IMPORTED_MODULE_0__.AlertService);
  return next(req).pipe((0,rxjs__WEBPACK_IMPORTED_MODULE_2__.catchError)(error => {
    if (error.status === 401 || error.status === 403) {
      // No autorizado o prohibido
      const title = 'Acceso no autorizado o prohibido';
      const message = 'Por favor, Inicie sesión nuevamente...';
      alertService.toastMessage('error', title, message, true);
      console.error(`${title}: ${message}`);
    } else if (error.status === 500) {
      // Error interno del servidor
      const title = 'Algo anda mal!';
      const message = 'Error del servidor, recargar la pagina. Si el problema persiste contacte un administrador.';
      alertService.toastMessage('error', title, message, true);
      console.error(message);
    }
    // Continúa lanzando el error para que pueda ser manejado por otros catchers
    return (0,rxjs__WEBPACK_IMPORTED_MODULE_3__.throwError)(() => error);
  }));
};

/***/ }),

/***/ 983:
/*!*************************************************!*\
  !*** ./src/app/core/services/alerts.service.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   AlertService: () => (/* binding */ AlertService)
/* harmony export */ });
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sweetalert2 */ 7581);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var primeng_api__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! primeng/api */ 7780);



class AlertService {
  constructor(messageService) {
    this.messageService = messageService;
  }
  // ================================================================
  // SweetAlert2
  // ================================================================
  // Alerta cuando hay alguna falla en el servidor
  alert_error_servidor() {
    sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().fire({
      title: 'Algo anda mal!',
      text: 'Por favor, contactese con un administrador.',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }
  /**
   * Alerta para respuestas de servidor
   * (response.data.json_data)
   * @param data
   */
  alert_response_server(data) {
    sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().fire({
      title: data.title,
      text: data.message,
      icon: data.type,
      confirmButtonText: 'Aceptar'
    });
  }
  // Alerta de carga
  alert_carga() {
    return new Promise((resolve, reject) => {
      sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().fire({
        title: 'Cargando...',
        html: 'Por favor espere.',
        timerProgressBar: true,
        allowOutsideClick: false,
        // Evita que la alerta se cierre al hacer clic fuera de ella
        didOpen: () => {
          sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().showLoading(); // Muestra la animación de carga circular
          const timer = sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().getPopup()?.querySelector('b');
          if (timer) {
            this.timerInterval = setInterval(() => {
              timer.textContent = `${sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().getTimerLeft()}`;
            }, 100);
          }
        },
        willClose: () => {
          clearInterval(this.timerInterval);
          resolve(); // Resolver la promesa cuando la alerta se cierre
        }
      });
    });
  }
  // Alerta cuando se necesita confirmar una acción
  alert_confirmation(message) {
    return new Promise(resolve => {
      sweetalert2__WEBPACK_IMPORTED_MODULE_0___default().fire({
        title: 'Confirmar!',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then(result => {
        if (result.isConfirmed) {
          // Si se hace clic en Aceptar, resuelve la promesa como true
          resolve(true);
        } else {
          // Si se hace clic en Cancelar o se cierra la alerta, resuelve la promesa como false
          resolve(false);
        }
      });
    });
  }
  // ================================================================
  // Primeng Alerts
  // ================================================================
  toastMessage(type = 'info', title = 'Info', message = 'Mensaje por defecto', temp = false) {
    this.messageService.add({
      severity: type,
      summary: title,
      detail: message,
      sticky: temp
    });
  }
  static #_ = this.ɵfac = function AlertService_Factory(t) {
    return new (t || AlertService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](primeng_api__WEBPACK_IMPORTED_MODULE_2__.MessageService));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: AlertService,
    factory: AlertService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 1563:
/*!************************************************!*\
  !*** ./src/app/core/services/excel.service.ts ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ExcelService: () => (/* binding */ ExcelService)
/* harmony export */ });
/* harmony import */ var C_xampp_htdocs_plantilla_TESIS_ESPESS_WebApplication_Frontend_node_modules_babel_runtime_helpers_esm_asyncToGenerator_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js */ 9204);
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! file-saver */ 5841);
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(file_saver__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var exceljs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! exceljs */ 4058);
/* harmony import */ var exceljs__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(exceljs__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common/http */ 6443);





class ExcelService {
  constructor(http) {
    this.http = http;
    // Comienzo de la data
    this.initData = 7;
    // Imagen de ITIN
    this.urlLogoITIN = 'assets/img/logos/bytes/ITIN.bin';
    this.widthLogoITIN = 150;
    this.heightLogoITIN = 50;
    this.topITIN = 1;
    // leftITIN: number = 3;
    // Imagen de LOGO
    this.urlLogoLOGO = 'assets/img/logos/bytes/logo.bin';
    this.widthLogoLOGO = 60;
    this.heightLogoLOGO = 60;
    this.topLOGO = 0.8;
    // Establecer el estilo de los bordes exteriores
    this.borderStyles = {
      top: {
        style: 'thin'
      },
      left: {
        style: 'thin'
      },
      bottom: {
        style: 'thin'
      },
      right: {
        style: 'thin'
      }
    };
    // =====================================================================================
    // Columnas de matriz notas con configuración de ancho y alineación
    this.columnNotasStudents = {
      'ESTUDIANTE': {
        width: 35
      },
      'ID': {
        width: 12
      },
      'CEDULA': {
        width: 12
      },
      'A_CONOCIMIENTO': {
        width: 40
      },
      'DEPARTAMENTO': {
        width: 15
      },
      'CURSO': {
        width: 10,
        align: 'center'
      },
      'MATERIA': {
        width: 35
      },
      'NRC': {
        width: 8,
        align: 'center'
      },
      'ESTADO': {
        width: 8,
        align: 'center'
      },
      'PROMEDIO': {
        width: 8
      },
      'NOTA1': {
        width: 8
      },
      'NOTA2': {
        width: 8
      },
      'NOTA3': {
        width: 8
      },
      'DOCENTE': {
        width: 40
      },
      'NIVEL': {
        width: 15
      },
      'PERIODO': {
        width: 10,
        align: 'center'
      },
      'GENERO': {
        width: 8,
        align: 'center'
      }
    };
  }
  // leftLOGO: number = 13.5;
  // Descargar datos en excel
  exportAsExcelFile(data, headersColumns, excelFileName, leftITIN, leftLOGO) {
    var _this = this;
    return (0,C_xampp_htdocs_plantilla_TESIS_ESPESS_WebApplication_Frontend_node_modules_babel_runtime_helpers_esm_asyncToGenerator_js__WEBPACK_IMPORTED_MODULE_0__["default"])(function* () {
      const workbook = new exceljs__WEBPACK_IMPORTED_MODULE_2__.Workbook();
      const worksheet = workbook.addWorksheet('NotasITIN');
      // Cargar y agregar imagen de forma asincrónica, sin detener el flujo principal
      yield _this.loadAndAddImage(workbook, worksheet, _this.urlLogoITIN, _this.widthLogoITIN, _this.heightLogoITIN, _this.topITIN, leftITIN);
      yield _this.loadAndAddImage(workbook, worksheet, _this.urlLogoLOGO, _this.widthLogoLOGO, _this.heightLogoLOGO, _this.topLOGO, leftLOGO);
      // Estableciendo las cabeceras
      const headers = _this.createHeaders(headersColumns);
      // Agregar encabezado general para la universidad
      const titleRowESPE = worksheet.getRow(_this.initData - 5);
      const totalColumnsESPE = headers.length;
      const startColESPE = 1; // Inicio de la primera columna
      const endColESPE = totalColumnsESPE; // Fin de la última columna
      worksheet.mergeCells(_this.initData - 5, startColESPE, _this.initData - 5, endColESPE);
      titleRowESPE.getCell(1).value = 'UNIVERSIDAD DE LAS FUERZAS ARMADAS - ESPE';
      titleRowESPE.getCell(1).alignment = {
        vertical: 'middle',
        horizontal: 'center'
      };
      titleRowESPE.getCell(1).font = {
        bold: true,
        size: 14
      };
      // Agregar encabezado general para la carrera
      const titleRowITIN = worksheet.getRow(_this.initData - 4);
      const totalColumnsITIN = headers.length;
      const startColITIN = 1; // Inicio de la primera columna
      const endColITIN = totalColumnsITIN; // Fin de la última columna
      worksheet.mergeCells(_this.initData - 4, startColITIN, _this.initData - 4, endColITIN);
      titleRowITIN.getCell(1).value = 'CARRERA DE INGENIERÍA EN TECNOLOGÍAS DE LA INFORMACIÓN';
      titleRowITIN.getCell(1).alignment = {
        vertical: 'middle',
        horizontal: 'center'
      };
      titleRowITIN.getCell(1).font = {
        bold: true,
        size: 14
      };
      // Agregar encabezado general titulo
      const titleRow = worksheet.getRow(_this.initData - 1);
      const totalColumns = headers.length;
      const startCol = 1; // Inicio de la primera columna
      const endCol = totalColumns; // Fin de la última columna
      worksheet.mergeCells(_this.initData - 1, startCol, _this.initData - 1, endCol);
      titleRow.getCell(1).value = 'INFORME DE NOTAS';
      titleRow.getCell(1).alignment = {
        vertical: 'middle',
        horizontal: 'center'
      };
      titleRow.getCell(1).font = {
        bold: true,
        size: 14,
        color: {
          argb: 'ffffff'
        }
      };
      titleRow.getCell(1).fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: {
          argb: '40456c'
        }
      };
      titleRow.eachCell(cell => {
        cell.border = _this.borderStyles;
      });
      // Encabezado de tabla
      worksheet.columns = headers.map(col => ({
        key: col.key,
        width: col.width
      }));
      // Configuración de posicionamiento de las cabezeras
      const headerRow = worksheet.getRow(_this.initData);
      headers.forEach((col, index) => {
        headerRow.getCell(index + 1).value = col.header;
        headerRow.getCell(index + 1).font = {
          bold: true,
          color: {
            argb: 'ffffff'
          }
        };
        headerRow.getCell(index + 1).fill = {
          type: 'pattern',
          pattern: 'solid',
          fgColor: {
            argb: '4d5484'
          }
        };
        headerRow.eachCell(cell => {
          cell.border = _this.borderStyles;
        });
      });
      // Aplicando estilos después de definir las columnas
      _this.applyStyles(worksheet, headersColumns);
      // Agregando datos a la hoja
      data.forEach((item, index) => {
        const row = worksheet.getRow(index + (_this.initData + 1));
        headers.forEach((col, colIndex) => {
          if (item.hasOwnProperty(col.key)) {
            row.getCell(colIndex + 1).value = item[col.key];
          }
        });
      });
      // Aplicar el filtro automático en todas las columnas
      _this.applyAutoFilter(worksheet, headersColumns);
      // Generar y guardar el archivo
      const buffer = yield workbook.xlsx.writeBuffer();
      const blob = new Blob([buffer], {
        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8'
      });
      file_saver__WEBPACK_IMPORTED_MODULE_1__.saveAs(blob, `${excelFileName}.xlsx`);
    })();
  }
  /**
   * Cabezeras
   * @param columnConfig
   * @returns
   */
  createHeaders(columnConfig) {
    return Object.keys(columnConfig).map(key => {
      const config = columnConfig[key];
      return {
        header: key,
        key: key,
        width: config.width
      };
    });
  }
  /**
   * Estilos
   * @param worksheet
   * @param columnsConfig
   */
  applyStyles(worksheet, columnsConfig) {
    worksheet.columns.forEach(column => {
      if (column.key) {
        const config = columnsConfig[column.key];
        if (config && config.align) {
          // Aplicar alineación si está especificada a la columna completa
          column.alignment = {
            horizontal: config.align
          };
        }
      }
    });
  }
  /**
   * Aplicar el filtro automático
   * @param worksheet
   * @param columnsConfig
   */
  applyAutoFilter(worksheet, columnsConfig) {
    // Puedes ajustar las celdas que deseas que tengan filtro automático, aquí asumimos que es toda la primera fila
    if (Object.keys(columnsConfig).length > 0) {
      worksheet.autoFilter = {
        from: {
          row: this.initData,
          column: 1
        },
        to: {
          row: this.initData,
          column: Object.keys(columnsConfig).length
        }
      };
    }
  }
  /**
   * Cargar imagen bin
   * @param workbook
   * @param worksheet
   * @param url
   * @param width
   * @param height
   * @param top
   * @param left
   * @returns
   */
  loadAndAddImage(workbook, worksheet, url, width, height, top, left) {
    var _this2 = this;
    return (0,C_xampp_htdocs_plantilla_TESIS_ESPESS_WebApplication_Frontend_node_modules_babel_runtime_helpers_esm_asyncToGenerator_js__WEBPACK_IMPORTED_MODULE_0__["default"])(function* () {
      const response = yield _this2.http.get(url, {
        responseType: 'blob'
      }).toPromise();
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => {
          const base64Image = reader.result;
          const imageId = workbook.addImage({
            base64: base64Image,
            extension: 'png'
          });
          worksheet.addImage(imageId, {
            tl: {
              col: left,
              row: top
            },
            // top left
            ext: {
              width: width,
              height: height
            } // tamaño de la imagen
          });
          resolve();
        };
        reader.onerror = reject;
        reader.readAsDataURL(response);
      });
    })();
  }
  static #_ = this.ɵfac = function ExcelService_Factory(t) {
    return new (t || ExcelService)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_4__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineInjectable"]({
    token: ExcelService,
    factory: ExcelService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 3875:
/*!*******************************************************!*\
  !*** ./src/app/core/services/menu-profile.service.ts ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MenuService: () => (/* binding */ MenuService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 5797);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);


class MenuService {
  constructor() {
    // Ocultar el menu de perfil al hacer clic en cualquier parte de la pagina que no sea el componente del menu
    this.showMenuProfileSubject = new rxjs__WEBPACK_IMPORTED_MODULE_0__.BehaviorSubject(false);
    this.showMenuProfile$ = this.showMenuProfileSubject.asObservable();
  }
  toggleMenuProfile() {
    this.showMenuProfileSubject.next(!this.showMenuProfileSubject.value);
  }
  closeMenuProfile() {
    this.showMenuProfileSubject.next(false);
  }
  static #_ = this.ɵfac = function MenuService_Factory(t) {
    return new (t || MenuService)();
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: MenuService,
    factory: MenuService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 9964:
/*!**************************************************!*\
  !*** ./src/app/core/services/sidebar.service.ts ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   SidebarService: () => (/* binding */ SidebarService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 5797);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);


class SidebarService {
  constructor() {
    // Sidebar
    this.sidebarHidden = true;
    this.originalDividerContents = {}; // Almacena los contenidos originales de los dividers
    this.sidebarHiddenSubject = new rxjs__WEBPACK_IMPORTED_MODULE_0__.BehaviorSubject(this.checkSidebarStorage()); // BehaviorSubject para emitir el estado del sidebar
  }
  // Cambiar estado del sidebar
  toggleSidebar() {
    this.sidebarHidden = !this.sidebarHidden;
    const element_autors = document.querySelector('.content-autors');
    // Cambiar de texto segun el estado del sidebar
    const dividers = document.querySelectorAll('.divider');
    dividers.forEach((divider, index) => {
      if (divider instanceof HTMLElement) {
        // Si es la primera vez que se ejecuta toggleSidebar(), almacena el contenido original
        if (!this.originalDividerContents[index]) {
          this.originalDividerContents[index] = divider.textContent || '';
        }
        // Actualizar el texto de acuerdo al estado del sidebar
        if (this.sidebarHidden) {
          divider.textContent = '-';
          if (element_autors) {
            element_autors.style.opacity = '0';
          }
        } else {
          // Restaurar el contenido original
          divider.textContent = this.originalDividerContents[index];
          // Después de 0.03 segundos, mostrar el elemento .content-autors
          setTimeout(() => {
            if (element_autors) {
              element_autors.style.opacity = '1';
            }
          }, 30); // 30 milisegundos = 0.03 segundos
        }
      }
    });
    // Actualizar el valor de 'sidebar' en el localStorage
    localStorage.setItem('sidebar', this.sidebarHidden.toString());
    this.sidebarHiddenSubject.next(this.sidebarHidden); // Emitir el nuevo estado del sidebar
    return this.sidebarHidden;
  }
  // Verifica el estado del sidebar
  checkSidebarStorage() {
    // Obtener el valor de 'sidebar' del localStorage
    const sidebarValue = localStorage.getItem('sidebar');
    // Si 'sidebar' existe en el localStorage, establecer sidebarHidden en su valor
    if (sidebarValue !== null) {
      this.sidebarHidden = sidebarValue === 'true';
    } else {
      // Si 'sidebar' no existe en el localStorage, establecer sidebarHidden en true
      this.sidebarHidden = true;
      // Guardar sidebarHidden en el localStorage
      localStorage.setItem('sidebar', 'true');
    }
    return this.sidebarHidden;
  }
  // Cambiar nombre de dividers del sidebar
  changeNameDividers(sidebar) {
    // Almacenar el contenido original de los dividers cuando carga la página
    const dividers = document.querySelectorAll('.divider');
    dividers.forEach((divider, index) => {
      if (divider instanceof HTMLElement) {
        this.originalDividerContents[index] = divider.textContent || '';
      }
      // Asignar si el sidebar esta oculto
      if (sidebar) {
        divider.textContent = '-';
      } else {
        const element_autors = document.querySelector('.content-autors');
        element_autors.style.opacity = '1';
      }
    });
  }
  getSidebarHidden() {
    return this.sidebarHiddenSubject.asObservable();
  }
  static #_ = this.ɵfac = function SidebarService_Factory(t) {
    return new (t || SidebarService)();
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: SidebarService,
    factory: SidebarService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 3735:
/*!********************************************************************************!*\
  !*** ./src/app/views/Module/components/menu-profile/menu-profile.component.ts ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MenuProfileComponent: () => (/* binding */ MenuProfileComponent)
/* harmony export */ });
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ 5072);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 7580);


const _c0 = () => ({
  exact: true
});
class MenuProfileComponent {
  constructor() {
    this.title = '';
    this.sidebarHidden = false;
    this.routes = [];
  }
  ngOnInit() {}
  // Cerrar Sesion
  logout() {}
  static #_ = this.ɵfac = function MenuProfileComponent_Factory(t) {
    return new (t || MenuProfileComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: MenuProfileComponent,
    selectors: [["app-menu-profile"]],
    inputs: {
      title: "title",
      sidebarHidden: "sidebarHidden",
      routes: "routes"
    },
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵStandaloneFeature"]],
    decls: 10,
    vars: 2,
    consts: [[1, "popup-menu-profile"], [1, "container"], ["routerLinkActive", "active-section", 3, "routerLink", "routerLinkActiveOptions"], [1, "bx", "bx-user"], [1, "logout", 3, "click"], [1, "bx", "bx-log-out"]],
    template: function MenuProfileComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0)(1, "div", 1)(2, "a", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](3, "i", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](4, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](5, "Perfil");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](6, "a", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function MenuProfileComponent_Template_a_click_6_listener() {
          return ctx.logout();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](7, "i", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](8, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](9, "Cerrar Sesi\u00F3n");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](1, _c0));
      }
    },
    dependencies: [_angular_router__WEBPACK_IMPORTED_MODULE_1__.RouterLinkActive, _angular_router__WEBPACK_IMPORTED_MODULE_1__.RouterLink],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n.popup-menu-profile[_ngcontent-%COMP%] {\n  position: fixed;\n  top: 75px;\n  right: 10px;\n  width: 175px;\n  padding: 10px;\n  border-radius: 10px;\n  background-color: white;\n  box-shadow: 5px 5px 10px #808080, inset 8px 8px 12px #9fb0cb, inset -8px -8px 12px #f9f9f9;\n  z-index: 100;\n}\n.popup-menu-profile[_ngcontent-%COMP%]::before {\n  content: \"\";\n  position: absolute;\n  width: 20px;\n  height: 10px;\n  top: -9px;\n  right: 30px;\n  background-color: #adbbd2;\n  clip-path: polygon(50% 0, 0% 100%, 100% 100%);\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 4px;\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 10px;\n  padding: 7px 10px;\n  text-decoration: none;\n  color: #18181c;\n  border-radius: 10px;\n  border: 1px solid transparent;\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n  display: grid;\n  align-items: center;\n  font-size: 0.75em;\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]:hover {\n  border: 1px solid rgba(128, 128, 128, 0.4);\n}\n.popup-menu-profile[_ngcontent-%COMP%]   .container[_ngcontent-%COMP%]   .active-section[_ngcontent-%COMP%] {\n  color: #fff;\n  background-color: #40456c;\n  border: 1px solid rgba(64, 69, 108, 0.4);\n  box-shadow: inset 2px 2px 10px #1a1c2c, inset -2px -2px 10px #6b72a7;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvY29tcG9uZW50cy9tZW51LXByb2ZpbGUvbWVudS1wcm9maWxlLmNvbXBvbmVudC5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2ZvbnRzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNSRjs7QUE3QkE7RUFDRSxlQUFBO0VBQ0EsU0FBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBVG1CO0VBVW5CLDBGQUNFO0VBR0YsWUFBQTtBQTZCRjtBQTNCRTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsU0FBQTtFQUNBLFdBQUE7RUFDQSx5QkFBQTtFQUNBLDZDQUFBO0FBNkJKO0FBMUJFO0VBQ0UsYUFBQTtFQUNBLFFBQUE7QUE0Qko7QUExQkk7RUFDRSxhQUFBO0VBQ0EsU0FBQTtFQUNBLGlCQUFBO0VBQ0EscUJBQUE7RUFDQSxjQ3pCTTtFRDBCTixtQkFBQTtFQUNBLDZCQUFBO0FBNEJOO0FBMUJNO0VBQ0UsZ0JFVEk7QUZxQ1o7QUF6Qk07RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkVkVztBRnlDbkI7QUF4Qk07RUFDRSwwQ0FBQTtBQTBCUjtBQXRCSTtFQUNFLFdDaERFO0VEaURGLHlCQ3hESTtFRHlESix3Q0FBQTtFQUNBLG9FQUNFO0FBdUJSIiwic291cmNlc0NvbnRlbnQiOlsiLy8gQ29sb3JlcyByb290XHJcbjpyb290IHtcclxuXHJcbiAgLy8gc29saWRcclxuICAtLWpldDogaHNsKDAsIDAlLCAyMiUpO1xyXG4gIC0tb255eDogaHNsKDI0MCwgMSUsIDE3JSk7XHJcblxyXG4gIC0tYmxhY2s6IGhzbCgwLCAwJSwgMCUpO1xyXG4gIC0tYmxhY2stOTA6IGhzbGEoMCwgMCUsIDAlLCAwLjkpO1xyXG4gIC0tYmxhY2stODA6IGhzbGEoMCwgMCUsIDAlLCAwLjgpO1xyXG4gIC0tYmxhY2stNzA6IGhzbGEoMCwgMCUsIDAlLCAwLjcpO1xyXG4gIC0tYmxhY2stNjA6IGhzbGEoMCwgMCUsIDAlLCAwLjYpO1xyXG4gIC0tYmxhY2stNTA6IGhzbGEoMCwgMCUsIDAlLCAwLjUpO1xyXG4gIC0tYmxhY2stNDA6IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG4gIC0tYmxhY2stMzA6IGhzbGEoMCwgMCUsIDAlLCAwLjMpO1xyXG4gIC0tYmxhY2stMjA6IGhzbGEoMCwgMCUsIDAlLCAwLjIpO1xyXG4gIC0tYmxhY2stMTA6IGhzbGEoMCwgMCUsIDAlLCAwLjEpO1xyXG5cclxuICAtLXdoaXRlOiBoc2woMCwgMCUsIDEwMCUpO1xyXG4gIC0td2hpdGUtOTA6IGhzbCgwLCAwJSwgMTAwJSwgMC45KTtcclxuICAtLXdoaXRlLTgwOiBoc2woMCwgMCUsIDEwMCUsIDAuOCk7XHJcbiAgLS13aGl0ZS03MDogaHNsKDAsIDAlLCAxMDAlLCAwLjcpO1xyXG4gIC0td2hpdGUtNjA6IGhzbCgwLCAwJSwgMTAwJSwgMC42KTtcclxuICAtLXdoaXRlLTUwOiBoc2woMCwgMCUsIDEwMCUsIDAuNSk7XHJcbiAgLS13aGl0ZS00MDogaHNsKDAsIDAlLCAxMDAlLCAwLjQpO1xyXG4gIC0td2hpdGUtMzA6IGhzbCgwLCAwJSwgMTAwJSwgMC4zKTtcclxuICAtLXdoaXRlLTIwOiBoc2woMCwgMCUsIDEwMCUsIDAuMik7XHJcbiAgLS13aGl0ZS0xMDogaHNsKDAsIDAlLCAxMDAlLCAwLjEpO1xyXG5cclxuICAvLyBzaGFkb3dcclxuICAtLXNoYWRvdy0xOiAtNHB4IDhweCAyNHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0yOiA1cHggNXB4IDEwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTM6IDAgMTZweCA0MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy00OiAwIDI1cHggNTBweCBoc2xhKDAsIDAlLCAwJSwgMC4xNSk7XHJcbiAgLS1zaGFkb3ctNTogMCAyNHB4IDgwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTY6IDAgMTZweCAzcHggaHNsYSgwLCAwJSwgMCUsIDAuNCk7XHJcblxyXG4gIC8vIENvbG9yc1xyXG4gIC0tcmVkOiBoc2woMCwgMTAwJSwgNTAlKTtcclxuICAtLXllbGxvdzogaHNsKDYwLCAxMDAlLCA1MCUpO1xyXG4gIC0tZ3JlZW46IGhzbCgxMjAsIDEwMCUsIDI1JSk7XHJcbiAgLS1ibHVlOiBoc2woMjQwLCAxMDAlLCA1MCUpO1xyXG4gIC0tcHVycGxlOiBoc2woMzAwLCAxMDAlLCAyNSUpO1xyXG59XHJcbiIsIkB1c2UgXCIuLi8uLi8uLi8uLi8uLi9hc3NldHMvc2Nzcy92YXJzL2NvbG9yc1wiIGFzIGNvbG9ycztcclxuQHVzZSBcIi4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvZm9udHNcIiBhcyBmb250cztcclxuXHJcbiRiYWNrZ3JvdW5kX2NvbnRlbnQ6IHJnYmEobGlnaHRlbihjb2xvcnMuJHdoaXRlLCAxMCksIDEpO1xyXG5cclxuLnBvcHVwLW1lbnUtcHJvZmlsZSB7XHJcbiAgcG9zaXRpb246IGZpeGVkO1xyXG4gIHRvcDogNzVweDtcclxuICByaWdodDogMTBweDtcclxuICB3aWR0aDogMTc1cHg7XHJcbiAgcGFkZGluZzogMTBweDtcclxuICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICRiYWNrZ3JvdW5kX2NvbnRlbnQ7XHJcbiAgYm94LXNoYWRvdzpcclxuICAgIDVweCA1cHggMTBweCBjb2xvcnMuJGdyYXksXHJcbiAgICBpbnNldCA4cHggOHB4IDEycHggZGFya2VuKGNvbG9ycy4kc2hhMiwgMTUpLFxyXG4gICAgaW5zZXQgLThweCAtOHB4IDEycHggY29sb3JzLiRzaGExO1xyXG4gIHotaW5kZXg6IDEwMDtcclxuXHJcbiAgJjo6YmVmb3JlIHtcclxuICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB3aWR0aDogMjBweDtcclxuICAgIGhlaWdodDogMTBweDtcclxuICAgIHRvcDogLTlweDtcclxuICAgIHJpZ2h0OiAzMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogZGFya2VuKGNvbG9ycy4kc2hhMiwgMTEpO1xyXG4gICAgY2xpcC1wYXRoOiBwb2x5Z29uKDUwJSAwLCAwJSAxMDAlLCAxMDAlIDEwMCUpO1xyXG4gIH1cclxuXHJcbiAgLmNvbnRhaW5lciB7XHJcbiAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgZ2FwOiA0cHg7XHJcblxyXG4gICAgYSB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGdhcDogMTBweDtcclxuICAgICAgcGFkZGluZzogN3B4IDEwcHg7XHJcbiAgICAgIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcclxuICAgICAgY29sb3I6IGNvbG9ycy4kYmxhY2stc2hhO1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgICBib3JkZXI6IDFweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuXHJcbiAgICAgIGkge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJGljb24tc2l6ZTtcclxuICAgICAgfVxyXG5cclxuICAgICAgc3BhbiB7XHJcbiAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtYnV0dG9uLXNpemU7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgICY6aG92ZXIge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoY29sb3JzLiRncmF5LCA0MCUpO1xyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmFjdGl2ZS1zZWN0aW9uIHtcclxuICAgICAgY29sb3I6IGNvbG9ycy4kd2hpdGU7XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6IGNvbG9ycy4kcHJpbWFyeTtcclxuICAgICAgYm9yZGVyOiAxcHggc29saWQgcmdiYShjb2xvcnMuJHByaW1hcnksIDQwJSk7XHJcbiAgICAgIGJveC1zaGFkb3c6XHJcbiAgICAgICAgaW5zZXQgMnB4IDJweCAxMHB4IGRhcmtlbihjb2xvcnMuJHByaW1hcnksIDIwJSksXHJcbiAgICAgICAgaW5zZXQgLTJweCAtMnB4IDEwcHggbGlnaHRlbihjb2xvcnMuJHByaW1hcnksIDIwJSk7XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcbiIsIi8vIEltcG9ydHNcclxuQHVzZSAncm9vdF9jb2xvcnMnO1xyXG5cclxuLy8gVmFyaWFibGVzIGRlIGNvbG9yZXNcclxuJHByaW1hcnk6ICM0MDQ1NmM7XHJcbiRmb2N1cy1pbnB1dDogbGlnaHRlbigkcHJpbWFyeSwgMzAlKTtcclxuXHJcbiRiZzogI2YxZjBmNjtcclxuJGJnLWVsZW1lbnRzOiAjZWNmMGYzO1xyXG4kc2hhMTogI2Y5ZjlmOTtcclxuJHNoYTI6ICNkMWQ5ZTY7XHJcbiR3aGl0ZTogI2ZmZjtcclxuXHJcbiRibGFjazogIzAwMDAwMDtcclxuJGJsYWNrLXNoYTogIzE4MTgxYztcclxuXHJcbiRncmF5OiAjODA4MDgwO1xyXG4kZ3JheS10ZXh0OiAjNDk0OTQ5O1xyXG5cclxuJG9ybzogIzcxNmI0MTtcclxuJHNoYWRvdy1vcm86ICMxNzE4MWM7XHJcblxyXG5cclxuLy8gQ29sb3IgZGUgYm90b25lc1xyXG4kYnRuczogIzNjNjhlMztcclxuJGJ0bi1jb2xvci0xOiAkYnRucztcclxuJGJ0bi1jb2xvci0yOiBkYXJrZW4oJGJ0bnMsIDEwKTtcclxuJGJ0bi1jb2xvci0zOiBkYXJrZW4oJGJ0bnMsIDIwKTtcclxuJGJ0bi1jb2xvci00OiBkYXJrZW4oJGJ0bnMsIDMwKTtcclxuJGJ0bi1jb2xvci01OiBkYXJrZW4oJGJ0bnMsIDQwKTtcclxuJGJ0bi1jb2xvci02OiBkYXJrZW4oJGJ0bnMsIDUwKTtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWJ1c2NhcjogIzI5ODBiOTtcclxuJGJ0bi1jb2xvci1pbmdyZXNhcjogIzFhNzUwMDtcclxuJGJ0bi1jb2xvci1uYXZlZ2FjaW9uOiAjMDA5YzhjO1xyXG5cclxuXHJcbiRidG4tY29sb3ItZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1idXNjYXIsIDEwKTtcclxuJGJ0bi1jb2xvci1kZWxldGUtZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1maWx0cm8sIDEwKTtcclxuJGJ0bi1jb2xvci1jb3B5OiAjMDA2ZDc3O1xyXG4kYnRuLWNvbG9yLWV4Y2VsOiAjMGU3NTNjO1xyXG4kYnRuLWNvbG9yLWNzdjogI2ZmOTgwMDtcclxuJGJ0bi1jb2xvci1wcmludDogIzE3YTJiODtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWVudmlhcjogIzI3YWU2MDtcclxuJGJ0bi1jb2xvci1udWV2bzogIzM0OThkYjtcclxuJGJ0bi1jb2xvci1lZGl0YXI6ICNmMzljMTI7XHJcbiRidG4tY29sb3ItYWN0dWFsaXphcjogIzJlY2M3MTtcclxuJGJ0bi1jb2xvci1lbGltaW5hcjogI2U3NGMzYztcclxuJGJ0bi1jb2xvci1jYW5jZWxhcjogIzk1YTVhNjtcclxuXHJcbiIsIi8vIEZ1ZW50ZSBwcmluY2lwYWxcclxuJGZvbnQtcHJpbWFyeTogJ0FyaWFsJywgc2Fucy1zZXJpZjtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBUYW1hw4PCsW9zIFZhcmlhYmxlc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbi8vIE5hdmJhclxyXG4kdGV4dC1uYXY6IDEuMTVlbTsgICAgICAvLyAxOHB4XHJcblxyXG4vLyBTaWRlYmFyXHJcbiR0aXRsZS1zaWRlYmFyOiAxLjJlbTsgIC8vIDIwcHhcclxuJGl0ZW0tdGV4dDogMC43NWVtOyAgICAgLy8gMTJweFxyXG4kaXRlbS1kaXZpZGVyOiAwLjZlbTsgICAvLyAxMHB4XHJcbiRpdGVtLWF1dG9yczogMC41NWVtOyAgIC8vIDlweFxyXG5cclxuLy8gQ29udGVudFxyXG4kdGl0bGUtY29udGVudDogMS4yZW07XHJcblxyXG4vLyBFcnJvciA0MDRcclxuJHRpdGxlLWVycm9yOiA5LjVlbTsgICAgICAvLyAxNTBweFxyXG4kc3VidGl0bGUtZXJyb3I6IDMuMWVtOyAgIC8vIDUwcHhcclxuJHRleHQtZXJyb3I6IDEuMmVtO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIEVzdGFuZGFyXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kdGl0bGUtdGV4dC1oMTogMmVtO1xyXG4kdGl0bGUtdGV4dC1oMjogMS41ZW07XHJcbiR0aXRsZS10ZXh0LWgzOiAxLjE3ZW07XHJcbiR0aXRsZS10ZXh0LWg0OiAxZW07XHJcbiR0aXRsZS10ZXh0LWg1OiAwLjgzZW07XHJcbiR0aXRsZS10ZXh0LWg2OiAwLjY3ZW07XHJcbiR0ZXh0LXA6IDFlbTtcclxuXHJcbiRpY29uLXNpemU6IDEuMmVtO1xyXG4kdGV4dC1idXR0b24tc2l6ZTogMC43NWVtO1xyXG5cclxuLy8gVGFibGV0XHJcbiR0aXRsZS10ZXh0LWgxLXRhYmxldDogMS44ZW07XHJcbiR0aXRsZS10ZXh0LWgyLXRhYmxldDogMS4zNWVtO1xyXG4kdGl0bGUtdGV4dC1oMy10YWJsZXQ6IDEuMDVlbTtcclxuJHRpdGxlLXRleHQtaDQtdGFibGV0OiAwLjllbTtcclxuJHRpdGxlLXRleHQtaDUtdGFibGV0OiAwLjc1ZW07XHJcbiR0aXRsZS10ZXh0LWg2LXRhYmxldDogMC42ZW07XHJcbiR0ZXh0LXAtdGFibGV0OiAwLjllbTtcclxuXHJcbi8vIE1vdmlsXHJcbiR0aXRsZS10ZXh0LWgxLXBob25lOiAxLjZlbTtcclxuJHRpdGxlLXRleHQtaDItcGhvbmU6IDEuMmVtO1xyXG4kdGl0bGUtdGV4dC1oMy1waG9uZTogMWVtO1xyXG4kdGl0bGUtdGV4dC1oNC1waG9uZTogMC44ZW07XHJcbiR0aXRsZS10ZXh0LWg1LXBob25lOiAwLjdlbTtcclxuJHRpdGxlLXRleHQtaDYtcGhvbmU6IDAuNWVtO1xyXG4kdGV4dC1wLXBob25lOiAwLjg1ZW07XHJcblxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgZGUgbGV0cmEgcGFyYSBmb3JtdWxhcmlvc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuJGZvcm0taW5wdXQ6IDAuOGVtO1xyXG4kZm9ybS1sYWJlbDogMC43NWVtO1xyXG4kZm9ybS1yZXF1aWVyZWQ6IDAuNTVlbTtcclxuXHJcblxyXG5cclxuJGRpYWxvZy1oZWFkZXItdGl0bGU6IDAuOGVtO1xyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iXSwic291cmNlUm9vdCI6IiJ9 */"]
  });
}

/***/ }),

/***/ 9892:
/*!*****************************************************************!*\
  !*** ./src/app/views/Module/designs/navbar/navbar.component.ts ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   NavbarComponent: () => (/* binding */ NavbarComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _components_menu_profile_menu_profile_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/menu-profile/menu-profile.component */ 3735);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var src_app_core_services_menu_profile_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! src/app/core/services/menu-profile.service */ 3875);





const _c0 = a0 => ({
  "dimension-nav-hidden": a0
});
const _c1 = (a0, a1) => ({
  "bx-menu": a0,
  "bx-menu-alt-left": a1
});
const _c2 = a0 => ({
  "active-menu-profile": a0
});
function NavbarComponent_Conditional_13_Template(rf, ctx) {
  if (rf & 1) {
    const _r1 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "button", 10);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function NavbarComponent_Conditional_13_Template_button_click_0_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵrestoreView"](_r1);
      const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵresetView"](ctx_r1.scrollToTop());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](1, "i", 11);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
  }
}
function NavbarComponent_Conditional_14_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](0, "app-menu-profile", 9);
  }
  if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("routes", ctx_r1.routes);
  }
}
class NavbarComponent {
  triggerToggleSidebar() {
    this.toggleSidebar.emit();
  }
  constructor(menuService) {
    this.menuService = menuService;
    // DATOS DE LA SESION
    this.firstname_user = 'Admin';
    this.lastname_user = 'Sistema';
    this.toggleSidebar = new _angular_core__WEBPACK_IMPORTED_MODULE_2__.EventEmitter();
    // Button top
    this.showScrollButton = false;
  }
  ngOnInit() {
    // Detectar el scroll y mostrar/ocultar el botón
    window.addEventListener('scroll', () => {
      this.showScrollButton = window.pageYOffset > 100;
      this.toggleButtonOpacity(); // Llamar a la función para controlar la opacidad del botón
    });
  }
  // Mostrar / Ocultar menu de perfil
  toggleMenuProfile() {
    this.menuService.toggleMenuProfile();
  }
  // Función para volver hacia arriba
  scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }
  // Transición de boton top
  toggleButtonOpacity() {
    const button = document.getElementById('btn_top');
    if (button) {
      if (this.showScrollButton) {
        button.classList.add('visible');
      } else {
        button.classList.remove('visible');
      }
    }
  }
  // Evento para mostrar el menu de perfil
  handleClickOutside(event) {
    const target = event.target;
    if (!target.closest('.profile-icon')) {
      this.menuService.closeMenuProfile();
    }
  }
  static #_ = this.ɵfac = function NavbarComponent_Factory(t) {
    return new (t || NavbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](src_app_core_services_menu_profile_service__WEBPACK_IMPORTED_MODULE_1__.MenuService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: NavbarComponent,
    selectors: [["app-navbar"]],
    hostBindings: function NavbarComponent_HostBindings(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function NavbarComponent_click_HostBindingHandler($event) {
          return ctx.handleClickOutside($event);
        }, false, _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵresolveDocument"]);
      }
    },
    inputs: {
      sidebarHidden: "sidebarHidden",
      routes: "routes"
    },
    outputs: {
      toggleSidebar: "toggleSidebar"
    },
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵStandaloneFeature"]],
    decls: 16,
    vars: 18,
    consts: [[1, "content-navbar", "dimension-nav", 3, "ngClass"], [1, "icon-menu-sidebar", 3, "click"], [1, "bx", "bx-menu-alt-left", 3, "ngClass"], [1, "navbar"], [1, "profile-icon", 3, "click", "ngClass"], [1, "name-profile"], [1, "icon-profile"], ["src", "assets/img/default/user.svg"], ["id", "btn_top"], [3, "routes"], ["id", "btn_top", 3, "click"], [1, "bx", "bxs-chevrons-up"]],
    template: function NavbarComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "section", 0)(1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function NavbarComponent_Template_div_click_1_listener() {
          return ctx.triggerToggleSidebar();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](2, "i", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](3, "main", 3)(4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpipe"](5, "async");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function NavbarComponent_Template_button_click_4_listener() {
          return ctx.toggleMenuProfile();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](6, "div", 5)(7, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](8);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](9, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](10);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](11, "div", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](12, "img", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](13, NavbarComponent_Conditional_13_Template, 2, 0, "button", 8)(14, NavbarComponent_Conditional_14_Template, 1, 1, "app-menu-profile", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpipe"](15, "async");
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpureFunction1"](11, _c0, ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpureFunction2"](13, _c1, ctx.sidebarHidden, !ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpureFunction1"](16, _c2, _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpipeBind1"](5, 7, ctx.menuService.showMenuProfile$)));
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](ctx.firstname_user);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](ctx.lastname_user);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵconditional"](13, ctx.showScrollButton ? 13 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵconditional"](14, _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpipeBind1"](15, 9, ctx.menuService.showMenuProfile$) ? 14 : -1);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_3__.NgClass, _components_menu_profile_menu_profile_component__WEBPACK_IMPORTED_MODULE_0__.MenuProfileComponent, _angular_common__WEBPACK_IMPORTED_MODULE_3__.AsyncPipe],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n  *,   *::after,   *::before {\n  box-sizing: content-box;\n}\n\n  html,   body {\n  padding: 0;\n}\n\n  .views {\n  background-color: #f1f0f6;\n  margin: 0;\n}\n\n.content-views[_ngcontent-%COMP%] {\n  display: block;\n  padding: 20px;\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%] {\n  display: grid;\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%]   .title-content[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n  font-weight: bold;\n  margin-bottom: 5px;\n  color: rgba(0, 0, 0, 0.8);\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%]   .divisor-title[_ngcontent-%COMP%] {\n  height: 3px;\n  margin-bottom: 5px;\n  border-radius: 50px;\n  background-color: #40456c;\n  width: calc(5px * var(--title-length, 0));\n}\n.content-views[_ngcontent-%COMP%]   .views[_ngcontent-%COMP%] {\n  position: relative;\n  padding: 10px 20px;\n  border-radius: 10px;\n  background-color: #fff;\n  border: 1px solid rgba(0, 0, 0, 0.05);\n}\n@media (max-width: 630px) {\n  .content-views[_ngcontent-%COMP%]   .views[_ngcontent-%COMP%] {\n    position: absolute;\n  }\n}\n@media (max-width: 630px) {\n  .content-views[_ngcontent-%COMP%]   .views-active[_ngcontent-%COMP%] {\n    position: relative !important;\n  }\n}\n@media (max-width: 470px) {\n  .content-views[_ngcontent-%COMP%]   .views-active[_ngcontent-%COMP%] {\n    position: absolute !important;\n  }\n}\n\n.dimension-content[_ngcontent-%COMP%] {\n  position: relative;\n  margin-top: 60px;\n}\n\n.dimension-nav[_ngcontent-%COMP%], .dimension-content[_ngcontent-%COMP%] {\n  width: calc(100% - 270px);\n  left: 230px;\n  gap: 10px;\n  transition: all 0.3s ease;\n}\n\n.dimension-nav-hidden[_ngcontent-%COMP%], .dimension-content-hidden[_ngcontent-%COMP%] {\n  width: calc(100% - 105px);\n  left: 65px;\n  transition: all 0.3s ease;\n}\n\n.content-navbar[_ngcontent-%COMP%] {\n  display: flex;\n  position: fixed;\n  top: 0;\n  right: 0;\n  padding: 8px 20px;\n  align-items: center;\n  color: #fff;\n  background-color: #40456c;\n  border-radius: 0px 0px 0px 20px;\n  box-shadow: 0px 8px 10px #d1d9e6, -10px -10px 10px #f9f9f9;\n  z-index: 100;\n  overflow-x: hidden;\n  transition: all 0.3s ease;\n}\n.content-navbar[_ngcontent-%COMP%]   .icon-menu-sidebar[_ngcontent-%COMP%] {\n  display: grid;\n  width: 20px;\n  height: 20px;\n  padding: 5px;\n  font-size: 1.2em;\n  border-radius: 5px;\n  cursor: pointer;\n  align-items: center;\n  justify-content: center;\n  box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.5), inset -2px -2px 3px rgba(160, 160, 160, 0.3);\n  transition: 0.3s;\n}\n.content-navbar[_ngcontent-%COMP%]   .icon-menu-sidebar[_ngcontent-%COMP%]:hover {\n  background-color: #373b5c;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%] {\n  display: flex;\n  width: 100%;\n  min-height: 50px;\n  align-items: center;\n  justify-content: right;\n}\n@media screen and (max-width: 300px) {\n  .content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%] {\n    width: auto;\n  }\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 10px;\n  color: #fff;\n  text-align: end;\n  padding: 5px 10px;\n  padding-left: 20px;\n  border: none;\n  border-radius: 10px;\n  align-items: center;\n  justify-content: end;\n  background-color: transparent;\n  cursor: pointer;\n  box-shadow: inset 5px 5px 15px #1a1c2c, inset -5px 10px 10px #6b72a7;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%]   .name-profile[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 1px;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%]   .name-profile[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n  font-size: 1.15em;\n  letter-spacing: 1.7px;\n  text-align: left;\n  text-transform: capitalize;\n  text-shadow: 2px 2px 5px #1a1c2c;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%]   .icon-profile[_ngcontent-%COMP%] {\n  display: grid;\n  width: 40px;\n  height: 40px;\n  border-radius: 50px;\n  align-items: center;\n  justify-content: center;\n  border: 1px solid #1a1c2c;\n  transition: 0.3s;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%]   .icon-profile[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n  width: 35px;\n}\n.content-navbar[_ngcontent-%COMP%]   .navbar[_ngcontent-%COMP%]   .profile-icon[_ngcontent-%COMP%]:hover   .icon-profile[_ngcontent-%COMP%] {\n  background-color: #373b5c;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvZGVzaWducy9uYXZiYXIvbmF2YmFyLmNvbXBvbmVudC5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvbW9kdWxlLmNvbXBvbmVudC5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2ZvbnRzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNSRjs7QUMzQkE7OztFQUdFLHVCQUFBO0FEOEJGOztBQzNCQTs7RUFFRSxVQUFBO0FEOEJGOztBQzNCQTtFQUNFLHlCQ1pHO0VEYUgsU0FBQTtBRDhCRjs7QUMzQkE7RUFDRSxjQUFBO0VBQ0EsYUFBQTtBRDhCRjtBQzVCRTtFQUNFLGFBQUE7QUQ4Qko7QUM1Qkk7RUFDRSxnQkVkVTtFRmVWLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSx5QkFBQTtBRDhCTjtBQzFCSTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0EseUJDdENJO0VEdUNKLHlDQUFBO0FENEJOO0FDeEJFO0VBQ0Usa0JBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0Esc0JDeENJO0VEeUNKLHFDQUFBO0FEMEJKO0FDeEJJO0VBUEY7SUFRSSxrQkFBQTtFRDJCSjtBQUNGO0FDdkJJO0VBREY7SUFFSSw2QkFBQTtFRDBCSjtBQUNGO0FDeEJJO0VBTEY7SUFNSSw2QkFBQTtFRDJCSjtBQUNGOztBQ3JCQTtFQUNFLGtCQUFBO0VBQ0EsZ0JBQUE7QUR3QkY7O0FDckJBOztFQUVFLHlCQUFBO0VBQ0EsV0FBQTtFQUNBLFNBQUE7RUFDQSx5QkFBQTtBRHdCRjs7QUNwQkE7O0VBRUUseUJBQUE7RUFDQSxVQUFBO0VBQ0EseUJBQUE7QUR1QkY7O0FBL0ZBO0VBQ0UsYUFBQTtFQUNBLGVBQUE7RUFDQSxNQUFBO0VBQ0EsUUFBQTtFQUNBLGlCQUFBO0VBQ0EsbUJBQUE7RUFDQSxXRWRNO0VGZU4seUJFdEJRO0VGdUJSLCtCQUFBO0VBQ0EsMERBQ0U7RUFFRixZQUFBO0VBQ0Esa0JBQUE7RUFDQSx5QkFBQTtBQWdHRjtBQTlGRTtFQUNFLGFBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLFlBQUE7RUFDQSxnQkdMUTtFSE1SLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7RUFDQSw4RkFDRTtFQUVGLGdCQUFBO0FBOEZKO0FBNUZJO0VBQ0UseUJBdENlO0FBb0lyQjtBQTFGRTtFQUNFLGFBQUE7RUFDQSxXQUFBO0VBQ0EsZ0JBQUE7RUFDQSxtQkFBQTtFQUNBLHNCQUFBO0FBNEZKO0FBekZJO0VBUkY7SUFTSSxXQUFBO0VBNEZKO0FBQ0Y7QUExRkk7RUFDRSxhQUFBO0VBQ0EsU0FBQTtFQUNBLFdFM0RFO0VGNERGLGVBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLG1CQUFBO0VBQ0EsbUJBQUE7RUFDQSxvQkFBQTtFQUNBLDZCQUFBO0VBQ0EsZUFBQTtFQUNBLG9FQUNFO0FBMkZSO0FBeEZNO0VBQ0UsYUFBQTtFQUNBLFFBQUE7QUEwRlI7QUF4RlE7RUFDRSxpQkdqRkM7RUhrRkQscUJBQUE7RUFDQSxnQkFBQTtFQUNBLDBCQUFBO0VBQ0EsZ0NBQUE7QUEwRlY7QUF0Rk07RUFDRSxhQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7RUFDQSx5QkFBQTtFQUNBLGdCQUFBO0FBd0ZSO0FBdEZRO0VBQ0UsV0FBQTtBQXdGVjtBQWpGUTtFQUNFLHlCQXZHVztBQTBMckIiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBDb2xvcmVzIHJvb3RcclxuOnJvb3Qge1xyXG5cclxuICAvLyBzb2xpZFxyXG4gIC0tamV0OiBoc2woMCwgMCUsIDIyJSk7XHJcbiAgLS1vbnl4OiBoc2woMjQwLCAxJSwgMTclKTtcclxuXHJcbiAgLS1ibGFjazogaHNsKDAsIDAlLCAwJSk7XHJcbiAgLS1ibGFjay05MDogaHNsYSgwLCAwJSwgMCUsIDAuOSk7XHJcbiAgLS1ibGFjay04MDogaHNsYSgwLCAwJSwgMCUsIDAuOCk7XHJcbiAgLS1ibGFjay03MDogaHNsYSgwLCAwJSwgMCUsIDAuNyk7XHJcbiAgLS1ibGFjay02MDogaHNsYSgwLCAwJSwgMCUsIDAuNik7XHJcbiAgLS1ibGFjay01MDogaHNsYSgwLCAwJSwgMCUsIDAuNSk7XHJcbiAgLS1ibGFjay00MDogaHNsYSgwLCAwJSwgMCUsIDAuNCk7XHJcbiAgLS1ibGFjay0zMDogaHNsYSgwLCAwJSwgMCUsIDAuMyk7XHJcbiAgLS1ibGFjay0yMDogaHNsYSgwLCAwJSwgMCUsIDAuMik7XHJcbiAgLS1ibGFjay0xMDogaHNsYSgwLCAwJSwgMCUsIDAuMSk7XHJcblxyXG4gIC0td2hpdGU6IGhzbCgwLCAwJSwgMTAwJSk7XHJcbiAgLS13aGl0ZS05MDogaHNsKDAsIDAlLCAxMDAlLCAwLjkpO1xyXG4gIC0td2hpdGUtODA6IGhzbCgwLCAwJSwgMTAwJSwgMC44KTtcclxuICAtLXdoaXRlLTcwOiBoc2woMCwgMCUsIDEwMCUsIDAuNyk7XHJcbiAgLS13aGl0ZS02MDogaHNsKDAsIDAlLCAxMDAlLCAwLjYpO1xyXG4gIC0td2hpdGUtNTA6IGhzbCgwLCAwJSwgMTAwJSwgMC41KTtcclxuICAtLXdoaXRlLTQwOiBoc2woMCwgMCUsIDEwMCUsIDAuNCk7XHJcbiAgLS13aGl0ZS0zMDogaHNsKDAsIDAlLCAxMDAlLCAwLjMpO1xyXG4gIC0td2hpdGUtMjA6IGhzbCgwLCAwJSwgMTAwJSwgMC4yKTtcclxuICAtLXdoaXRlLTEwOiBoc2woMCwgMCUsIDEwMCUsIDAuMSk7XHJcblxyXG4gIC8vIHNoYWRvd1xyXG4gIC0tc2hhZG93LTE6IC00cHggOHB4IDI0cHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTI6IDVweCA1cHggMTBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMzogMCAxNnB4IDQwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTQ6IDAgMjVweCA1MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjE1KTtcclxuICAtLXNoYWRvdy01OiAwIDI0cHggODBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNjogMCAxNnB4IDNweCBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuXHJcbiAgLy8gQ29sb3JzXHJcbiAgLS1yZWQ6IGhzbCgwLCAxMDAlLCA1MCUpO1xyXG4gIC0teWVsbG93OiBoc2woNjAsIDEwMCUsIDUwJSk7XHJcbiAgLS1ncmVlbjogaHNsKDEyMCwgMTAwJSwgMjUlKTtcclxuICAtLWJsdWU6IGhzbCgyNDAsIDEwMCUsIDUwJSk7XHJcbiAgLS1wdXJwbGU6IGhzbCgzMDAsIDEwMCUsIDI1JSk7XHJcbn1cclxuIiwiQHVzZSBcIi4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvY29sb3JzXCIgYXMgY29sb3JzO1xyXG5AdXNlIFwiLi4vLi4vLi4vLi4vLi4vYXNzZXRzL3Njc3MvdmFycy9mb250c1wiIGFzIGZvbnRzO1xyXG5AdXNlIFwiLi4vLi4vbW9kdWxlLmNvbXBvbmVudC5zY3NzXCI7XHJcblxyXG4uZGltZW5zaW9uLW5hdiB7XHJcbiAgQGV4dGVuZCAuZGltZW5zaW9uLW5hdjtcclxufVxyXG5cclxuLmRpbWVuc2lvbi1uYXYtaGlkZGVuIHtcclxuICBAZXh0ZW5kIC5kaW1lbnNpb24tbmF2LWhpZGRlbjtcclxufVxyXG5cclxuLy8gdmFyc1xyXG4kZm9uZG8tYWN0aXZlLWhvdmVyOiBkYXJrZW4oY29sb3JzLiRwcmltYXJ5LCA1KTtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBOQVZCQVJcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi5jb250ZW50LW5hdmJhciB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBwb3NpdGlvbjogZml4ZWQ7XHJcbiAgdG9wOiAwO1xyXG4gIHJpZ2h0OiAwO1xyXG4gIHBhZGRpbmc6IDhweCAyMHB4O1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgY29sb3I6IGNvbG9ycy4kd2hpdGU7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gIGJvcmRlci1yYWRpdXM6IDBweCAwcHggMHB4IDIwcHg7XHJcbiAgYm94LXNoYWRvdzpcclxuICAgIDBweCA4cHggMTBweCBjb2xvcnMuJHNoYTIsXHJcbiAgICAtMTBweCAtMTBweCAxMHB4IGNvbG9ycy4kc2hhMTtcclxuICB6LWluZGV4OiAxMDA7XHJcbiAgb3ZlcmZsb3cteDogaGlkZGVuO1xyXG4gIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2U7XHJcblxyXG4gIC5pY29uLW1lbnUtc2lkZWJhciB7XHJcbiAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgd2lkdGg6IDIwcHg7XHJcbiAgICBoZWlnaHQ6IDIwcHg7XHJcbiAgICBwYWRkaW5nOiA1cHg7XHJcbiAgICBmb250LXNpemU6IGZvbnRzLiRpY29uLXNpemU7XHJcbiAgICBib3JkZXItcmFkaXVzOiA1cHg7XHJcbiAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBib3gtc2hhZG93OlxyXG4gICAgICBpbnNldCAycHggMnB4IDRweCByZ2JhKGNvbG9ycy4kYmxhY2ssIDAuNSksXHJcbiAgICAgIGluc2V0IC0ycHggLTJweCAzcHggcmdiYShkYXJrZW4oY29sb3JzLiRzaGExLCAzNSUpLCAwLjMpO1xyXG4gICAgdHJhbnNpdGlvbjogLjNzO1xyXG5cclxuICAgICY6aG92ZXIge1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAkZm9uZG8tYWN0aXZlLWhvdmVyO1xyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgLm5hdmJhciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgd2lkdGg6IDEwMCU7XHJcbiAgICBtaW4taGVpZ2h0OiA1MHB4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGp1c3RpZnktY29udGVudDogcmlnaHQ7XHJcblxyXG4gICAgLy8gVE9ETzogcmVzcG9uc2l2ZSAzMDBweFxyXG4gICAgQG1lZGlhIHNjcmVlbiBhbmQgKG1heC13aWR0aDogMzAwcHgpIHtcclxuICAgICAgd2lkdGg6IGF1dG87XHJcbiAgICB9XHJcblxyXG4gICAgLnByb2ZpbGUtaWNvbiB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGdhcDogMTBweDtcclxuICAgICAgY29sb3I6IGNvbG9ycy4kd2hpdGU7XHJcbiAgICAgIHRleHQtYWxpZ246IGVuZDtcclxuICAgICAgcGFkZGluZzogNXB4IDEwcHg7XHJcbiAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZDtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgYm94LXNoYWRvdzpcclxuICAgICAgICBpbnNldCA1cHggNXB4IDE1cHggZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMjAlKSxcclxuICAgICAgICBpbnNldCAtNXB4IDEwcHggMTBweCBsaWdodGVuKGNvbG9ycy4kcHJpbWFyeSwgMjAlKTtcclxuXHJcbiAgICAgIC5uYW1lLXByb2ZpbGUge1xyXG4gICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgZ2FwOiAxcHg7XHJcblxyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgZm9udC1zaXplOiBmb250cy4kdGV4dC1uYXY7XHJcbiAgICAgICAgICBsZXR0ZXItc3BhY2luZzogMS43cHg7XHJcbiAgICAgICAgICB0ZXh0LWFsaWduOiBsZWZ0O1xyXG4gICAgICAgICAgdGV4dC10cmFuc2Zvcm06IGNhcGl0YWxpemU7XHJcbiAgICAgICAgICB0ZXh0LXNoYWRvdzogMnB4IDJweCA1cHggZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMjAlKTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5pY29uLXByb2ZpbGUge1xyXG4gICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgd2lkdGg6IDQwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDUwcHg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBkYXJrZW4oY29sb3JzLiRwcmltYXJ5LCAyMCk7XHJcbiAgICAgICAgdHJhbnNpdGlvbjogLjNzO1xyXG5cclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgd2lkdGg6IDM1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcblxyXG5cclxuXHJcbiAgICAgICY6aG92ZXIge1xyXG4gICAgICAgIC5pY29uLXByb2ZpbGUge1xyXG4gICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogJGZvbmRvLWFjdGl2ZS1ob3ZlcjtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbn1cclxuIiwiQHVzZSBcIi4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvY29sb3JzXCIgYXMgY29sb3JzO1xyXG5AdXNlIFwiLi4vLi4vLi4vYXNzZXRzL3Njc3MvdmFycy9mb250c1wiIGFzIGZvbnRzO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIENvbnRlbmVkb3IgZGUgdmlzdGFzXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuOjpuZy1kZWVwICosXHJcbjo6bmctZGVlcCAqOjphZnRlcixcclxuOjpuZy1kZWVwICo6OmJlZm9yZSB7XHJcbiAgYm94LXNpemluZzogY29udGVudC1ib3g7XHJcbn1cclxuXHJcbjo6bmctZGVlcCBodG1sLFxyXG46Om5nLWRlZXAgYm9keSB7XHJcbiAgcGFkZGluZzogMDtcclxufVxyXG5cclxuOjpuZy1kZWVwIC52aWV3cyB7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRiZztcclxuICBtYXJnaW46IDA7XHJcbn1cclxuXHJcbi5jb250ZW50LXZpZXdzIHtcclxuICBkaXNwbGF5OiBibG9jaztcclxuICBwYWRkaW5nOiAyMHB4O1xyXG5cclxuICAudGl0bGUtY29tcG9uZW50IHtcclxuICAgIGRpc3BsYXk6IGdyaWQ7XHJcblxyXG4gICAgLnRpdGxlLWNvbnRlbnQge1xyXG4gICAgICBmb250LXNpemU6IGZvbnRzLiR0aXRsZS1jb250ZW50O1xyXG4gICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgbWFyZ2luLWJvdHRvbTogNXB4O1xyXG4gICAgICBjb2xvcjogcmdiYShjb2xvcnMuJGJsYWNrLCAwLjgpO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIERpdmlzb3JcclxuICAgIC5kaXZpc29yLXRpdGxlIHtcclxuICAgICAgaGVpZ2h0OiAzcHg7XHJcbiAgICAgIG1hcmdpbi1ib3R0b206IDVweDtcclxuICAgICAgYm9yZGVyLXJhZGl1czogNTBweDtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gICAgICB3aWR0aDogY2FsYyg1cHggKiB2YXIoLS10aXRsZS1sZW5ndGgsIDApKTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC52aWV3cyB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICBwYWRkaW5nOiAxMHB4IDIwcHg7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiR3aGl0ZTtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoY29sb3JzLiRibGFjaywgMC4wNSk7XHJcblxyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDYzMHB4KSB7XHJcbiAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC52aWV3cy1hY3RpdmUge1xyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDYzMHB4KSB7XHJcbiAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOiA0NzBweCkge1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICB9XHJcbn1cclxuXHJcbi8vIEVzcGVjaWZpY2EgbGFzIGRpbWVuY2lvbmVzIGVuIGxhcyBxdWUgc2UgZGViZW4gcG9uZXIgZWwgbmF2IHkgZWwgY29udGVuZWRvclxyXG4vLyBTaWRlYmFyIEV4cGFuZGlkb1xyXG4uZGltZW5zaW9uLWNvbnRlbnQge1xyXG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICBtYXJnaW4tdG9wOiA2MHB4O1xyXG59XHJcblxyXG4uZGltZW5zaW9uLW5hdixcclxuLmRpbWVuc2lvbi1jb250ZW50IHtcclxuICB3aWR0aDogY2FsYygxMDAlIC0gMjcwcHgpO1xyXG4gIGxlZnQ6IDIzMHB4O1xyXG4gIGdhcDogMTBweDtcclxuICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG59XHJcblxyXG4vLyBTaWRlYmFyIFJldHJhaWRvXHJcbi5kaW1lbnNpb24tbmF2LWhpZGRlbixcclxuLmRpbWVuc2lvbi1jb250ZW50LWhpZGRlbiB7XHJcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDEwNXB4KTtcclxuICBsZWZ0OiA2NXB4O1xyXG4gIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2U7XHJcbn1cclxuIiwiLy8gSW1wb3J0c1xyXG5AdXNlICdyb290X2NvbG9ycyc7XHJcblxyXG4vLyBWYXJpYWJsZXMgZGUgY29sb3Jlc1xyXG4kcHJpbWFyeTogIzQwNDU2YztcclxuJGZvY3VzLWlucHV0OiBsaWdodGVuKCRwcmltYXJ5LCAzMCUpO1xyXG5cclxuJGJnOiAjZjFmMGY2O1xyXG4kYmctZWxlbWVudHM6ICNlY2YwZjM7XHJcbiRzaGExOiAjZjlmOWY5O1xyXG4kc2hhMjogI2QxZDllNjtcclxuJHdoaXRlOiAjZmZmO1xyXG5cclxuJGJsYWNrOiAjMDAwMDAwO1xyXG4kYmxhY2stc2hhOiAjMTgxODFjO1xyXG5cclxuJGdyYXk6ICM4MDgwODA7XHJcbiRncmF5LXRleHQ6ICM0OTQ5NDk7XHJcblxyXG4kb3JvOiAjNzE2YjQxO1xyXG4kc2hhZG93LW9ybzogIzE3MTgxYztcclxuXHJcblxyXG4vLyBDb2xvciBkZSBib3RvbmVzXHJcbiRidG5zOiAjM2M2OGUzO1xyXG4kYnRuLWNvbG9yLTE6ICRidG5zO1xyXG4kYnRuLWNvbG9yLTI6IGRhcmtlbigkYnRucywgMTApO1xyXG4kYnRuLWNvbG9yLTM6IGRhcmtlbigkYnRucywgMjApO1xyXG4kYnRuLWNvbG9yLTQ6IGRhcmtlbigkYnRucywgMzApO1xyXG4kYnRuLWNvbG9yLTU6IGRhcmtlbigkYnRucywgNDApO1xyXG4kYnRuLWNvbG9yLTY6IGRhcmtlbigkYnRucywgNTApO1xyXG5cclxuXHJcbiRidG4tY29sb3ItYnVzY2FyOiAjMjk4MGI5O1xyXG4kYnRuLWNvbG9yLWluZ3Jlc2FyOiAjMWE3NTAwO1xyXG4kYnRuLWNvbG9yLW5hdmVnYWNpb246ICMwMDljOGM7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1maWx0cm86IGRhcmtlbigkYnRuLWNvbG9yLWJ1c2NhciwgMTApO1xyXG4kYnRuLWNvbG9yLWRlbGV0ZS1maWx0cm86IGRhcmtlbigkYnRuLWNvbG9yLWZpbHRybywgMTApO1xyXG4kYnRuLWNvbG9yLWNvcHk6ICMwMDZkNzc7XHJcbiRidG4tY29sb3ItZXhjZWw6ICMwZTc1M2M7XHJcbiRidG4tY29sb3ItY3N2OiAjZmY5ODAwO1xyXG4kYnRuLWNvbG9yLXByaW50OiAjMTdhMmI4O1xyXG5cclxuXHJcbiRidG4tY29sb3ItZW52aWFyOiAjMjdhZTYwO1xyXG4kYnRuLWNvbG9yLW51ZXZvOiAjMzQ5OGRiO1xyXG4kYnRuLWNvbG9yLWVkaXRhcjogI2YzOWMxMjtcclxuJGJ0bi1jb2xvci1hY3R1YWxpemFyOiAjMmVjYzcxO1xyXG4kYnRuLWNvbG9yLWVsaW1pbmFyOiAjZTc0YzNjO1xyXG4kYnRuLWNvbG9yLWNhbmNlbGFyOiAjOTVhNWE2O1xyXG5cclxuIiwiLy8gRnVlbnRlIHByaW5jaXBhbFxyXG4kZm9udC1wcmltYXJ5OiAnQXJpYWwnLCBzYW5zLXNlcmlmO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgVmFyaWFibGVzXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuLy8gTmF2YmFyXHJcbiR0ZXh0LW5hdjogMS4xNWVtOyAgICAgIC8vIDE4cHhcclxuXHJcbi8vIFNpZGViYXJcclxuJHRpdGxlLXNpZGViYXI6IDEuMmVtOyAgLy8gMjBweFxyXG4kaXRlbS10ZXh0OiAwLjc1ZW07ICAgICAvLyAxMnB4XHJcbiRpdGVtLWRpdmlkZXI6IDAuNmVtOyAgIC8vIDEwcHhcclxuJGl0ZW0tYXV0b3JzOiAwLjU1ZW07ICAgLy8gOXB4XHJcblxyXG4vLyBDb250ZW50XHJcbiR0aXRsZS1jb250ZW50OiAxLjJlbTtcclxuXHJcbi8vIEVycm9yIDQwNFxyXG4kdGl0bGUtZXJyb3I6IDkuNWVtOyAgICAgIC8vIDE1MHB4XHJcbiRzdWJ0aXRsZS1lcnJvcjogMy4xZW07ICAgLy8gNTBweFxyXG4kdGV4dC1lcnJvcjogMS4yZW07XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gRXN0YW5kYXJcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiR0aXRsZS10ZXh0LWgxOiAyZW07XHJcbiR0aXRsZS10ZXh0LWgyOiAxLjVlbTtcclxuJHRpdGxlLXRleHQtaDM6IDEuMTdlbTtcclxuJHRpdGxlLXRleHQtaDQ6IDFlbTtcclxuJHRpdGxlLXRleHQtaDU6IDAuODNlbTtcclxuJHRpdGxlLXRleHQtaDY6IDAuNjdlbTtcclxuJHRleHQtcDogMWVtO1xyXG5cclxuJGljb24tc2l6ZTogMS4yZW07XHJcbiR0ZXh0LWJ1dHRvbi1zaXplOiAwLjc1ZW07XHJcblxyXG4vLyBUYWJsZXRcclxuJHRpdGxlLXRleHQtaDEtdGFibGV0OiAxLjhlbTtcclxuJHRpdGxlLXRleHQtaDItdGFibGV0OiAxLjM1ZW07XHJcbiR0aXRsZS10ZXh0LWgzLXRhYmxldDogMS4wNWVtO1xyXG4kdGl0bGUtdGV4dC1oNC10YWJsZXQ6IDAuOWVtO1xyXG4kdGl0bGUtdGV4dC1oNS10YWJsZXQ6IDAuNzVlbTtcclxuJHRpdGxlLXRleHQtaDYtdGFibGV0OiAwLjZlbTtcclxuJHRleHQtcC10YWJsZXQ6IDAuOWVtO1xyXG5cclxuLy8gTW92aWxcclxuJHRpdGxlLXRleHQtaDEtcGhvbmU6IDEuNmVtO1xyXG4kdGl0bGUtdGV4dC1oMi1waG9uZTogMS4yZW07XHJcbiR0aXRsZS10ZXh0LWgzLXBob25lOiAxZW07XHJcbiR0aXRsZS10ZXh0LWg0LXBob25lOiAwLjhlbTtcclxuJHRpdGxlLXRleHQtaDUtcGhvbmU6IDAuN2VtO1xyXG4kdGl0bGUtdGV4dC1oNi1waG9uZTogMC41ZW07XHJcbiR0ZXh0LXAtcGhvbmU6IDAuODVlbTtcclxuXHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gVGFtYcODwrFvcyBkZSBsZXRyYSBwYXJhIGZvcm11bGFyaW9zXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kZm9ybS1pbnB1dDogMC44ZW07XHJcbiRmb3JtLWxhYmVsOiAwLjc1ZW07XHJcbiRmb3JtLXJlcXVpZXJlZDogMC41NWVtO1xyXG5cclxuXHJcblxyXG4kZGlhbG9nLWhlYWRlci10aXRsZTogMC44ZW07XHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcbiJdLCJzb3VyY2VSb290IjoiIn0= */"]
  });
}

/***/ }),

/***/ 6946:
/*!*******************************************************************!*\
  !*** ./src/app/views/Module/designs/sidebar/sidebar.component.ts ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   SidebarComponent: () => (/* binding */ SidebarComponent)
/* harmony export */ });
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ 5072);
/* harmony import */ var primeng_tooltip__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! primeng/tooltip */ 405);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 7580);





const _c0 = a0 => ({
  "content-sidebar-hidden": a0
});
const _c1 = () => ({
  exact: true
});
const _c2 = a0 => ({
  "item-list-active-section": a0
});
function SidebarComponent_Conditional_64_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "i", 30);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
  }
}
function SidebarComponent_Conditional_65_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "i", 31);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
  }
}
function SidebarComponent_Conditional_66_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 24)(1, "a", 10)(2, "div", 11)(3, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](4, "i", 32);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "div", 13)(6, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](7, "Subitem 1");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](8, "a", 10)(9, "div", 11)(10, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](11, "i", 33);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](12, "div", 13)(13, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](14, "Subitem 2");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](15, "a", 10)(16, "div", 11)(17, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](18, "i", 34);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](19, "div", 13)(20, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](21, "Subitem 3");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()()();
  }
  if (rf & 2) {
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx_r0.routes[1])("pTooltip", ctx_r0.sidebarHidden ? "Subitem 1" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](9, _c1));
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx_r0.routes[2])("pTooltip", ctx_r0.sidebarHidden ? "Subitem 2" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](10, _c1));
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx_r0.routes[3])("pTooltip", ctx_r0.sidebarHidden ? "Subitem 3" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](11, _c1));
  }
}
class SidebarComponent {
  constructor() {
    // Elementos de lista
    this.elementList = {};
  }
  // ====================================================================
  // Funciones para elementos en lista
  // ====================================================================
  toggleSection(sectionKey) {
    this.elementList[sectionKey] = !this.elementList[sectionKey];
  }
  isSectionVisible(sectionKey) {
    return !!this.elementList[sectionKey];
  }
  static #_ = this.ɵfac = function SidebarComponent_Factory(t) {
    return new (t || SidebarComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: SidebarComponent,
    selectors: [["app-sidebar"]],
    inputs: {
      title: "title",
      sidebarHidden: "sidebarHidden",
      routes: "routes"
    },
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵStandaloneFeature"]],
    decls: 102,
    vars: 51,
    consts: [[1, "content-sidebar", 3, "ngClass"], [1, "content", "scroll-small"], [1, "sidebar"], [1, "logo_site", 3, "routerLink"], [1, "img_logo"], ["src", "assets/img/logos/logo_tesis.png", "alt", "logo"], [1, "title-text"], [1, "links_site"], [1, "nav"], [1, "nav-list"], ["routerLinkActive", "active-section", 3, "routerLink", "pTooltip", "routerLinkActiveOptions"], [1, "icon-sidebar-item"], [1, "fa-solid", "fa-house", "fontawesome"], [1, "name-sidebar-item"], [1, "fa-solid", "fa-file-import"], [1, "divider", 3, "pTooltip"], [1, "fa-solid", "fa-users", "fontawesome"], [1, "fa-solid", "fa-books", "fontawesome"], [1, "fa-solid", "fa-chart-mixed", "fontawesome"], [1, "fa-solid", "fa-chart-user", "fontawesome"], [1, "fa-duotone", "fa-microchip-ai"], ["routerLinkActive", "active-section", 3, "click", "routerLinkActiveOptions", "pTooltip", "ngClass"], [1, "fa-regular", "fa-list-tree"], [1, "icon-sidebar-item-list"], [1, "item-list"], [1, "fa-solid", "fa-clipboard-list"], [1, "fa-solid", "fa-book-open-cover", "fontawesome"], [1, "content-autors"], [1, "autors1"], ["href", "https://armandovelasquez.com", "target", "_blank"], [1, "fa-regular", "fa-angle-up"], [1, "fa-regular", "fa-angle-down"], [1, "fa-solid", "fa-user-tie"], [1, "fa-solid", "fa-user-pilot"], [1, "fa-solid", "fa-user-doctor"]],
    template: function SidebarComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "section", 0)(1, "div", 1)(2, "div", 2)(3, "a", 3)(4, "div", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](5, "img", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](6, "div", 6)(7, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](8);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](9, "div", 7)(10, "nav", 8)(11, "ul", 9)(12, "a", 10)(13, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](14, "i", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](15, "div", 13)(16, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](17, "Inicio");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](18, "a", 10)(19, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](20, "i", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](21, "div", 13)(22, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](23, "Cargar per\u00EDodos");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](24, "li", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](25, "Director");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](26, "a", 10)(27, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](28, "i", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](29, "div", 13)(30, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](31, "Estudiantes");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](32, "a", 10)(33, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](34, "i", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](35, "div", 13)(36, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](37, "Historico de notas");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](38, "a", 10)(39, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](40, "i", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](41, "div", 13)(42, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](43, "Tasa estadistica");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](44, "a", 10)(45, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](46, "i", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](47, "div", 13)(48, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](49, "Estadisticas de la carrera");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](50, "a", 10)(51, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](52, "i", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](53, "div", 13)(54, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](55, "Predicciones de estudiantes");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](56, "li", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](57, "Coordinador");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](58, "a", 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function SidebarComponent_Template_a_click_58_listener() {
          return ctx.toggleSection("lista");
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](59, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](60, "i", 22);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](61, "div", 13)(62, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](63, "Item de lista");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](64, SidebarComponent_Conditional_64_Template, 2, 0, "div", 23)(65, SidebarComponent_Conditional_65_Template, 2, 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](66, SidebarComponent_Conditional_66_Template, 22, 12, "div", 24);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](67, "li", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](68, "Docente");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](69, "li", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](70, "Estudiante");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](71, "a", 10)(72, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](73, "i", 25);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](74, "div", 13)(75, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](76, "Materias");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](77, "a", 10)(78, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](79, "i", 26);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](80, "div", 13)(81, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](82, "Notas");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](83, "a", 10)(84, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](85, "i", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](86, "div", 13)(87, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](88, "Predicci\u00F3n");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()()()()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](89, "div", 27)(90, "span", 28)(91, "i");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](92, "Designed by ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](93, "b")(94, "a", 29);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](95, "Josue Velasquez");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](96, "i");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](97, " & ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](98, "b")(99, "a");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](100, "Julissa Renteria");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](101, ". ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](36, _c0, ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx.routes[0]);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.title);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx.routes[0])("pTooltip", ctx.sidebarHidden ? "Inicio" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](38, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx.routes[1])("pTooltip", ctx.sidebarHidden ? "Cargar per\u00EDodos" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](39, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "DIRECTOR" : undefined);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx.routes[2])("pTooltip", ctx.sidebarHidden ? "Estudiantes" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](40, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", ctx.routes[3])("pTooltip", ctx.sidebarHidden ? "Historico de notas" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](41, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Tasa estadistica" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](42, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Estadisticas de la carrera" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](43, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Predicciones de estudiantes" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](44, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "COORDINDOR" : undefined);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](45, _c1))("pTooltip", ctx.sidebarHidden ? "Item de lista" : undefined)("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](46, _c2, ctx.isSectionVisible("lista")));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵconditional"](64, ctx.isSectionVisible("lista") ? 64 : 65);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵconditional"](66, ctx.isSectionVisible("lista") ? 66 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "DOCENTE" : undefined);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "ESTUDIANTE" : undefined);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Materias" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](48, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Notas" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](49, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("pTooltip", ctx.sidebarHidden ? "Predicci\u00F3n" : undefined)("routerLinkActiveOptions", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](50, _c1));
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_1__.NgClass, _angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterLink, _angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterLinkActive, primeng_tooltip__WEBPACK_IMPORTED_MODULE_3__.TooltipModule, primeng_tooltip__WEBPACK_IMPORTED_MODULE_3__.Tooltip],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%] {\n  position: fixed;\n  top: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n  max-width: 220px;\n  background: #fff;\n  border-radius: 0px 0px 20px 0px;\n  box-shadow: 10px 10px 10px #d1d9e6, -10px -10px 10px #f9f9f9;\n  z-index: 98;\n  overflow-x: hidden;\n  overflow-y: auto;\n  scrollbar-width: none;\n  transition: all 0.3s ease;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   .logo_site[_ngcontent-%COMP%] {\n  position: sticky;\n  display: flex;\n  width: 100%;\n  height: min-content;\n  gap: 10px;\n  font-weight: bold;\n  align-items: center;\n  text-decoration: none;\n  padding: 5px 0px;\n  color: rgba(0, 0, 0, 0.7);\n  background: #f1f0f6;\n  box-shadow: 0px 8px 5px #d1d9e6, -10px -10px 10px #f9f9f9;\n  transition: all 0.3s ease;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   .logo_site[_ngcontent-%COMP%]   .img_logo[_ngcontent-%COMP%] {\n  display: grid;\n  min-width: 55px;\n  justify-content: center;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   .logo_site[_ngcontent-%COMP%]   .img_logo[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n  width: 50px;\n  height: 50px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   .title-text[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: start;\n  text-transform: uppercase;\n  justify-items: center;\n  align-content: center;\n  align-items: center;\n  color: #18181c;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   p[_ngcontent-%COMP%] {\n  margin: 0;\n  font-size: 1.2em;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%] {\n  padding-top: 15px;\n  padding-bottom: 40px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%] {\n  display: grid;\n  position: relative;\n  width: 206px;\n  margin-top: 10px;\n  gap: 10px;\n  padding-left: 6px;\n  list-style: none;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr 15fr 1fr;\n  gap: 0px;\n  padding-right: 20px;\n  align-items: center;\n  justify-content: left;\n  text-decoration: none;\n  border-radius: 30px;\n  border: 1px solid rgba(0, 0, 0, 0.1);\n  box-shadow: inset 5px 5px 15px #8fa2c2, inset -5px 10px 10px white;\n  transition: all 0.3s ease;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%] {\n  display: grid;\n  width: 40px;\n  height: 40px;\n  align-items: center;\n  justify-content: center;\n  border-radius: 30px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n  color: #2d314c;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   .fontawesome[_ngcontent-%COMP%] {\n  font-size: 1em;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: left;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%] {\n  font-size: 0.75em;\n  color: #2d314c;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]:hover {\n  transition: all 0.3s ease;\n  box-shadow: inset 5px 5px 15px rgba(143, 162, 194, 0.5), inset -5px 10px 10px rgba(255, 255, 255, 0.5);\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 3px;\n  padding-left: 5px;\n  margin-left: 5px;\n  border-left: 1px solid rgba(64, 69, 108, 0.2);\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr 15fr 1fr;\n  gap: 0px;\n  padding-right: 20px;\n  align-items: center;\n  justify-content: left;\n  text-decoration: none;\n  border-radius: 30px;\n  border: 1px solid rgba(0, 0, 0, 0.1);\n  box-shadow: inset 5px 5px 15px #8fa2c2, inset -5px 10px 10px white;\n  transition: all 0.3s ease;\n  height: 30px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%] {\n  display: grid;\n  width: 40px;\n  height: 40px;\n  align-items: center;\n  justify-content: center;\n  border-radius: 30px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n  color: #2d314c;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   .fontawesome[_ngcontent-%COMP%] {\n  font-size: 1em;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: left;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%] {\n  font-size: 0.75em;\n  color: #2d314c;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]:hover {\n  transition: all 0.3s ease;\n  box-shadow: inset 5px 5px 15px rgba(143, 162, 194, 0.5), inset -5px 10px 10px rgba(255, 255, 255, 0.5);\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%] {\n  height: 30px;\n}\n.content-sidebar[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .divider[_ngcontent-%COMP%] {\n  margin-top: 10px;\n  padding-left: 5px;\n  font-size: 0.6em;\n  text-transform: uppercase;\n  font-weight: bold;\n  color: #808080;\n  white-space: nowrap;\n  transition: all 0.3s ease;\n}\n\n.content-autors[_ngcontent-%COMP%] {\n  display: grid;\n  position: fixed;\n  bottom: 0;\n  left: 0;\n  width: 200px;\n  padding: 10px;\n  border-radius: 0px 0px 20px 0px;\n  background: #f1f0f6;\n  text-align: center;\n  opacity: 0;\n  z-index: 1000;\n  transition: all 5s ease;\n}\n.content-autors[_ngcontent-%COMP%]   .autors1[_ngcontent-%COMP%] {\n  display: block;\n  color: #18181c;\n  font-size: 0.55em;\n}\n.content-autors[_ngcontent-%COMP%]   .autors1[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  color: #40456c;\n  text-decoration: none;\n}\n.content-autors[_ngcontent-%COMP%]   .autors1[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]:hover {\n  color: #2d314c;\n}\n\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%] {\n  max-width: 55px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .sidebar[_ngcontent-%COMP%]   .logo_site[_ngcontent-%COMP%]   .title-text[_ngcontent-%COMP%] {\n  display: none;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%] {\n  width: 0px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  grid-template-columns: 1fr;\n  padding-right: 0px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%] {\n  display: none;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: center;\n  font-size: 0.7em;\n  margin-top: -13px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .divider[_ngcontent-%COMP%] {\n  text-align: center;\n  padding-left: 0px;\n  transition: all 0.3s ease;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%] {\n  padding-left: 0px;\n  margin-left: 0px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n  grid-template-columns: 1fr;\n  padding-right: 0px;\n  transform: scale(0.8);\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%] {\n  display: none;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content[_ngcontent-%COMP%]   .links_site[_ngcontent-%COMP%]   .nav[_ngcontent-%COMP%]   .nav-list[_ngcontent-%COMP%]   .item-list[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: center;\n  font-size: 0.7em;\n  margin-top: -13px;\n}\n.content-sidebar-hidden[_ngcontent-%COMP%]   .content-autors[_ngcontent-%COMP%] {\n  display: none;\n}\n\n.active-section[_ngcontent-%COMP%] {\n  box-shadow: inset 5px 5px 15px rgba(26, 28, 44, 0.5), inset -5px 10px 10px rgba(51, 51, 51, 0.5) !important;\n  transition: all 0s ease;\n  background-color: #40456c;\n}\n.active-section[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%], .active-section[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: #fff !important;\n}\n.active-section[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%]   li[_ngcontent-%COMP%] {\n  color: #fff;\n}\n.active-section[_ngcontent-%COMP%]:hover {\n  box-shadow: inset 5px 5px 15px rgba(26, 28, 44, 0.5), inset -5px 10px 10px rgba(51, 51, 51, 0.5) !important;\n}\n\n.item-list-active-section[_ngcontent-%COMP%] {\n  box-shadow: inset 5px 5px 15px rgba(26, 28, 44, 0.5), inset -5px 10px 10px rgba(51, 51, 51, 0.5) !important;\n  transition: all 0s ease;\n  background-color: rgba(64, 69, 108, 0.8);\n}\n.item-list-active-section[_ngcontent-%COMP%]   .icon-sidebar-item[_ngcontent-%COMP%]   i[_ngcontent-%COMP%], .item-list-active-section[_ngcontent-%COMP%]   .icon-sidebar-item-list[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  color: #fff !important;\n}\n.item-list-active-section[_ngcontent-%COMP%]   .name-sidebar-item[_ngcontent-%COMP%]   li[_ngcontent-%COMP%] {\n  color: #fff;\n}\n.item-list-active-section[_ngcontent-%COMP%]:hover {\n  box-shadow: inset 5px 5px 15px rgba(26, 28, 44, 0.5), inset -5px 10px 10px rgba(51, 51, 51, 0.5) !important;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvZGVzaWducy9zaWRlYmFyL3NpZGViYXIuY29tcG9uZW50LnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fY29sb3JzLnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fZm9udHMuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDQTtFQUdFLHNCQUFBO0VBQ0EseUJBQUE7RUFFQSx1QkFBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUVBLHlCQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBR0EsK0NBQUE7RUFDQSw4Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSw2Q0FBQTtFQUNBLDJDQUFBO0VBR0Esd0JBQUE7RUFDQSw0QkFBQTtFQUNBLDRCQUFBO0VBQ0EsMkJBQUE7RUFDQSw2QkFBQTtBQ1JGOztBQTBCRTtFQUNFLGVBQUE7RUFDQSxNQUFBO0VBQ0EsT0FBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkN4REk7RUR5REosK0JBQUE7RUFDQSw0REFDRTtFQUVGLFdBQUE7RUFDQSxrQkFBQTtFQUNBLGdCQUFBO0VBQ0EscUJBQUE7RUFDQSx5QkFBQTtBQXpCSjtBQTRCTTtFQUNFLGdCQUFBO0VBQ0EsYUFBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtFQUNBLFNBQUE7RUFDQSxpQkFBQTtFQUNBLG1CQUFBO0VBQ0EscUJBQUE7RUFD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N0NWLDBCQUFBO0VBQ0Esa0JBQUE7RUE4Q1kscUJBQUE7QUFXZDtBQXZERTtFQUNFLGFBQUE7QUF5REo7QUF0REU7RUFDRSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSxnQkFBQTtFQUNBLGlCQUFBO0FBd0RKO0FBWkU7RUFDRSxhQUFBO0FBY0o7O0FBaUJBO0VBekJFLDJHQUNFO0VBRUYsdUJBQUE7RUF3QkEseUJDclNRO0FEd1JWO0FBUEk7O0VBQ0Usc0JBQUE7QUFVTjtBQUxJO0VBQ0UsV0NqUkU7QUR3UlI7QUFIRTtFQUNFLDJHQUNFO0FBSU47O0FBTUE7RUE5QkUsMkdBQ0U7RUFFRix1QkFBQTtFQTZCQSx3Q0FBQTtBQUZGO0FBdkJJOztFQUNFLHNCQUFBO0FBMEJOO0FBckJJO0VBQ0UsV0NqUkU7QUR3U1I7QUFuQkU7RUFDRSwyR0FDRTtBQW9CTiIsInNvdXJjZXNDb250ZW50IjpbIi8vIENvbG9yZXMgcm9vdFxyXG46cm9vdCB7XHJcblxyXG4gIC8vIHNvbGlkXHJcbiAgLS1qZXQ6IGhzbCgwLCAwJSwgMjIlKTtcclxuICAtLW9ueXg6IGhzbCgyNDAsIDElLCAxNyUpO1xyXG5cclxuICAtLWJsYWNrOiBoc2woMCwgMCUsIDAlKTtcclxuICAtLWJsYWNrLTkwOiBoc2xhKDAsIDAlLCAwJSwgMC45KTtcclxuICAtLWJsYWNrLTgwOiBoc2xhKDAsIDAlLCAwJSwgMC44KTtcclxuICAtLWJsYWNrLTcwOiBoc2xhKDAsIDAlLCAwJSwgMC43KTtcclxuICAtLWJsYWNrLTYwOiBoc2xhKDAsIDAlLCAwJSwgMC42KTtcclxuICAtLWJsYWNrLTUwOiBoc2xhKDAsIDAlLCAwJSwgMC41KTtcclxuICAtLWJsYWNrLTQwOiBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuICAtLWJsYWNrLTMwOiBoc2xhKDAsIDAlLCAwJSwgMC4zKTtcclxuICAtLWJsYWNrLTIwOiBoc2xhKDAsIDAlLCAwJSwgMC4yKTtcclxuICAtLWJsYWNrLTEwOiBoc2xhKDAsIDAlLCAwJSwgMC4xKTtcclxuXHJcbiAgLS13aGl0ZTogaHNsKDAsIDAlLCAxMDAlKTtcclxuICAtLXdoaXRlLTkwOiBoc2woMCwgMCUsIDEwMCUsIDAuOSk7XHJcbiAgLS13aGl0ZS04MDogaHNsKDAsIDAlLCAxMDAlLCAwLjgpO1xyXG4gIC0td2hpdGUtNzA6IGhzbCgwLCAwJSwgMTAwJSwgMC43KTtcclxuICAtLXdoaXRlLTYwOiBoc2woMCwgMCUsIDEwMCUsIDAuNik7XHJcbiAgLS13aGl0ZS01MDogaHNsKDAsIDAlLCAxMDAlLCAwLjUpO1xyXG4gIC0td2hpdGUtNDA6IGhzbCgwLCAwJSwgMTAwJSwgMC40KTtcclxuICAtLXdoaXRlLTMwOiBoc2woMCwgMCUsIDEwMCUsIDAuMyk7XHJcbiAgLS13aGl0ZS0yMDogaHNsKDAsIDAlLCAxMDAlLCAwLjIpO1xyXG4gIC0td2hpdGUtMTA6IGhzbCgwLCAwJSwgMTAwJSwgMC4xKTtcclxuXHJcbiAgLy8gc2hhZG93XHJcbiAgLS1zaGFkb3ctMTogLTRweCA4cHggMjRweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMjogNXB4IDVweCAxMHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0zOiAwIDE2cHggNDBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNDogMCAyNXB4IDUwcHggaHNsYSgwLCAwJSwgMCUsIDAuMTUpO1xyXG4gIC0tc2hhZG93LTU6IDAgMjRweCA4MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy02OiAwIDE2cHggM3B4IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG5cclxuICAvLyBDb2xvcnNcclxuICAtLXJlZDogaHNsKDAsIDEwMCUsIDUwJSk7XHJcbiAgLS15ZWxsb3c6IGhzbCg2MCwgMTAwJSwgNTAlKTtcclxuICAtLWdyZWVuOiBoc2woMTIwLCAxMDAlLCAyNSUpO1xyXG4gIC0tYmx1ZTogaHNsKDI0MCwgMTAwJSwgNTAlKTtcclxuICAtLXB1cnBsZTogaHNsKDMwMCwgMTAwJSwgMjUlKTtcclxufVxyXG4iLCJAdXNlIFwiLi4vLi4vLi4vLi4vLi4vYXNzZXRzL3Njc3MvdmFycy9jb2xvcnNcIiBhcyBjb2xvcnM7XHJcbkB1c2UgXCIuLi8uLi8uLi8uLi8uLi9hc3NldHMvc2Nzcy92YXJzL2ZvbnRzXCIgYXMgZm9udHM7XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gU0lERUJBUlxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbkBtaXhpbiBpdGVtcy1zaWRlYmFyLXN0eWxlcyB7XHJcbiAgZGlzcGxheTogZ3JpZDtcclxuICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmciAxNWZyIDFmcjtcclxuICBnYXA6IDBweDtcclxuICBwYWRkaW5nLXJpZ2h0OiAyMHB4O1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAganVzdGlmeS1jb250ZW50OiBsZWZ0O1xyXG4gIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcclxuICBib3JkZXItcmFkaXVzOiAzMHB4O1xyXG4gIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoY29sb3JzLiRibGFjaywgMTAlKTtcclxuICBib3gtc2hhZG93OlxyXG4gICAgaW5zZXQgNXB4IDVweCAxNXB4IGRhcmtlbihjb2xvcnMuJHNoYTIsIDIwJSksXHJcbiAgICBpbnNldCAtNXB4IDEwcHggMTBweCBsaWdodGVuKGNvbG9ycy4kc2hhMSwgMjAlKTtcclxuICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG5cclxuICAuaWNvbi1zaWRlYmFyLWl0ZW0ge1xyXG4gICAgZGlzcGxheTogZ3JpZDtcclxuICAgIHdpZHRoOiA0MHB4O1xyXG4gICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMzBweDtcclxuXHJcbiAgICBpIHtcclxuICAgICAgZm9udC1zaXplOiBmb250cy4kaWNvbi1zaXplO1xyXG4gICAgICBjb2xvcjogZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMTAlKTtcclxuICAgIH1cclxuXHJcbiAgICAuZm9udGF3ZXNvbWUge1xyXG4gICAgICBmb250LXNpemU6IGZvbnRzLiRpY29uLXNpemUgLSAwLjJlbTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC5pY29uLXNpZGViYXItaXRlbS1saXN0IHtcclxuICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGxlZnQ7XHJcbiAgfVxyXG5cclxuICAubmFtZS1zaWRlYmFyLWl0ZW0ge1xyXG4gICAgZm9udC1zaXplOiBmb250cy4kaXRlbS10ZXh0O1xyXG4gICAgY29sb3I6IGRhcmtlbihjb2xvcnMuJHByaW1hcnksIDEwJSk7XHJcbiAgfVxyXG5cclxuICAmOmhvdmVyIHtcclxuICAgIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2U7XHJcbiAgICBib3gtc2hhZG93OlxyXG4gICAgICBpbnNldCA1cHggNXB4IDE1cHggcmdiYShkYXJrZW4oY29sb3JzLiRzaGEyLCAyMCUpLCAwLjUpLFxyXG4gICAgICBpbnNldCAtNXB4IDEwcHggMTBweCByZ2JhKGxpZ2h0ZW4oY29sb3JzLiRzaGExLCAyMCUpLCAwLjUpO1xyXG4gIH1cclxufVxyXG5cclxuLy8gRXhwYW5kaWRvXHJcbi5jb250ZW50LXNpZGViYXIge1xyXG4gIC5jb250ZW50IHtcclxuICAgIHBvc2l0aW9uOiBmaXhlZDtcclxuICAgIHRvcDogMDtcclxuICAgIGxlZnQ6IDA7XHJcbiAgICB3aWR0aDogMTAwJTtcclxuICAgIGhlaWdodDogMTAwJTtcclxuICAgIG1heC13aWR0aDogMjIwcHg7XHJcbiAgICBiYWNrZ3JvdW5kOiBjb2xvcnMuJHdoaXRlO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMHB4IDBweCAyMHB4IDBweDtcclxuICAgIGJveC1zaGFkb3c6XHJcbiAgICAgIDEwcHggMTBweCAxMHB4IGNvbG9ycy4kc2hhMixcclxuICAgICAgLTEwcHggLTEwcHggMTBweCBjb2xvcnMuJHNoYTE7XHJcbiAgICB6LWluZGV4OiA5ODtcclxuICAgIG92ZXJmbG93LXg6IGhpZGRlbjtcclxuICAgIG92ZXJmbG93LXk6IGF1dG87XHJcbiAgICBzY3JvbGxiYXItd2lkdGg6IG5vbmU7XHJcbiAgICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG5cclxuICAgIC5zaWRlYmFyIHtcclxuICAgICAgLmxvZ29fc2l0ZSB7XHJcbiAgICAgICAgcG9zaXRpb246IHN0aWNreTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIGhlaWdodDogbWluLWNvbnRlbnQ7XHJcbiAgICAgICAgZ2FwOiAxMHB4O1xyXG4gICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgICAgIHBhZGRpbmc6IDVweCAwcHg7XHJcbiAgICAgICAgY29sb3I6IHJnYmEoY29sb3JzLiRibGFjaywgMC43KTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiBjb2xvcnMuJGJnO1xyXG4gICAgICAgIGJveC1zaGFkb3c6XHJcbiAgICAgICAgICAwcHggOHB4IDVweCBjb2xvcnMuJHNoYTIsXHJcbiAgICAgICAgICAtMTBweCAtMTBweCAxMHB4IGNvbG9ycy4kc2hhMTtcclxuICAgICAgICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG5cclxuICAgICAgICAuaW1nX2xvZ28ge1xyXG4gICAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICAgIG1pbi13aWR0aDogNTVweDtcclxuICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG5cclxuICAgICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDUwcHg7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcblxyXG4gICAgICAudGl0bGUtdGV4dCB7XHJcbiAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHN0YXJ0O1xyXG4gICAgICAgIHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7XHJcbiAgICAgICAganVzdGlmeS1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGFsaWduLWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGNvbG9yOiBjb2xvcnMuJGJsYWNrLXNoYTtcclxuICAgICAgfVxyXG5cclxuICAgICAgcCB7XHJcbiAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJHRpdGxlLXNpZGViYXI7XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubGlua3Nfc2l0ZSB7XHJcbiAgICAgIHBhZGRpbmctdG9wOiAxNXB4O1xyXG4gICAgICBwYWRkaW5nLWJvdHRvbTogNDBweDtcclxuXHJcbiAgICAgIC5uYXYge1xyXG4gICAgICAgIC5uYXYtbGlzdCB7XHJcbiAgICAgICAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgd2lkdGg6IDIwNnB4O1xyXG4gICAgICAgICAgbWFyZ2luLXRvcDogMTBweDtcclxuICAgICAgICAgIGdhcDogMTBweDtcclxuICAgICAgICAgIHBhZGRpbmctbGVmdDogNnB4O1xyXG4gICAgICAgICAgbGlzdC1zdHlsZTogbm9uZTtcclxuXHJcbiAgICAgICAgICBhIHtcclxuICAgICAgICAgICAgQGluY2x1ZGUgaXRlbXMtc2lkZWJhci1zdHlsZXM7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgLml0ZW0tbGlzdCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgICAgIGdhcDogM3B4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDVweDtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDVweDtcclxuICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKTtcclxuXHJcbiAgICAgICAgICAgIGEge1xyXG4gICAgICAgICAgICAgIEBpbmNsdWRlIGl0ZW1zLXNpZGViYXItc3R5bGVzO1xyXG4gICAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuXHJcbiAgICAgICAgICAgICAgLmljb24tc2lkZWJhci1pdGVtIHtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAuZGl2aWRlciB7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogNXB4O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IGZvbnRzLiRpdGVtLWRpdmlkZXI7XHJcbiAgICAgICAgICAgIHRleHQtdHJhbnNmb3JtOiB1cHBlcmNhc2U7XHJcbiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgICBjb2xvcjogY29sb3JzLiRncmF5O1xyXG4gICAgICAgICAgICB3aGl0ZS1zcGFjZTogbm93cmFwO1xyXG4gICAgICAgICAgICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxufVxyXG5cclxuLy8gQVVUSE9SU1xyXG4uY29udGVudC1hdXRvcnMge1xyXG4gIGRpc3BsYXk6IGdyaWQ7XHJcbiAgcG9zaXRpb246IGZpeGVkO1xyXG4gIGJvdHRvbTogMDtcclxuICBsZWZ0OiAwO1xyXG4gIHdpZHRoOiAyMDBweDtcclxuICBwYWRkaW5nOiAxMHB4O1xyXG4gIGJvcmRlci1yYWRpdXM6IDBweCAwcHggMjBweCAwcHg7XHJcbiAgYmFja2dyb3VuZDogY29sb3JzLiRiZztcclxuICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgb3BhY2l0eTogMDtcclxuICB6LWluZGV4OiAxMDAwO1xyXG4gIHRyYW5zaXRpb246IGFsbCA1cyBlYXNlO1xyXG5cclxuICAuYXV0b3JzMSB7XHJcbiAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIGNvbG9yOiBjb2xvcnMuJGJsYWNrLXNoYTtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJGl0ZW0tYXV0b3JzO1xyXG5cclxuICAgIGEge1xyXG4gICAgICBjb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gICAgICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XHJcblxyXG4gICAgICAmOmhvdmVyIHtcclxuICAgICAgICBjb2xvcjogZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMTApO1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcblxyXG4vLyBSRVRSQUlET1xyXG5AbWl4aW4gaXRlbXMtc2lkZWJhci1zdHlsZXMtcmV0cmFpZG8ge1xyXG4gIGdyaWQtdGVtcGxhdGUtY29sdW1uczogMWZyO1xyXG4gIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuXHJcbiAgLm5hbWUtc2lkZWJhci1pdGVtIHtcclxuICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgfVxyXG5cclxuICAuaWNvbi1zaWRlYmFyLWl0ZW0tbGlzdCB7XHJcbiAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBmb250LXNpemU6IGZvbnRzLiRpY29uLXNpemUgLSAwLjVlbTtcclxuICAgIG1hcmdpbi10b3A6IC0xM3B4O1xyXG4gIH1cclxufVxyXG4uY29udGVudC1zaWRlYmFyLWhpZGRlbiB7XHJcbiAgLmNvbnRlbnQge1xyXG4gICAgbWF4LXdpZHRoOiA1NXB4O1xyXG5cclxuICAgIC5zaWRlYmFyIHtcclxuICAgICAgLmxvZ29fc2l0ZSB7XHJcbiAgICAgICAgLnRpdGxlLXRleHQge1xyXG4gICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubGlua3Nfc2l0ZSB7XHJcbiAgICAgIC5uYXYge1xyXG4gICAgICAgIC5uYXYtbGlzdCB7XHJcbiAgICAgICAgICB3aWR0aDogMHB4O1xyXG5cclxuICAgICAgICAgIGEge1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBpdGVtcy1zaWRlYmFyLXN0eWxlcy1yZXRyYWlkbztcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAuZGl2aWRlciB7XHJcbiAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgICAgIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2U7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgLml0ZW0tbGlzdCB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMHB4O1xyXG5cclxuICAgICAgICAgICAgYSB7XHJcbiAgICAgICAgICAgICAgQGluY2x1ZGUgaXRlbXMtc2lkZWJhci1zdHlsZXMtcmV0cmFpZG87XHJcbiAgICAgICAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgwLjgpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG5cclxuICAuY29udGVudC1hdXRvcnMge1xyXG4gICAgZGlzcGxheTogbm9uZTtcclxuICB9XHJcbn1cclxuXHJcbi8vIElsdW1pbmFyb3IgZGUgbG9zIGl0ZW1zIGRlbCBzaWRlYmFyXHJcbkBtaXhpbiBhY3RpdmUtc2VjdGlvbi1zdHlsZSB7XHJcbiAgYm94LXNoYWRvdzpcclxuICAgIGluc2V0IDVweCA1cHggMTVweCByZ2JhKGRhcmtlbihjb2xvcnMuJHByaW1hcnksIDIwJSksIDAuNSksXHJcbiAgICBpbnNldCAtNXB4IDEwcHggMTBweCByZ2JhKGxpZ2h0ZW4oY29sb3JzLiRibGFjaywgMjAlKSwgMC41KSAhaW1wb3J0YW50O1xyXG4gIHRyYW5zaXRpb246IGFsbCAwcyBlYXNlO1xyXG5cclxuICAuaWNvbi1zaWRlYmFyLWl0ZW0sXHJcbiAgLmljb24tc2lkZWJhci1pdGVtLWxpc3Qge1xyXG4gICAgaSB7XHJcbiAgICAgIGNvbG9yOiBjb2xvcnMuJHdoaXRlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgfVxyXG5cclxuICAubmFtZS1zaWRlYmFyLWl0ZW0ge1xyXG4gICAgbGkge1xyXG4gICAgICBjb2xvcjogY29sb3JzLiR3aGl0ZTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gICY6aG92ZXIge1xyXG4gICAgYm94LXNoYWRvdzpcclxuICAgICAgaW5zZXQgNXB4IDVweCAxNXB4IHJnYmEoZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMjAlKSwgMC41KSxcclxuICAgICAgaW5zZXQgLTVweCAxMHB4IDEwcHggcmdiYShsaWdodGVuKGNvbG9ycy4kYmxhY2ssIDIwJSksIDAuNSkgIWltcG9ydGFudDtcclxuICB9XHJcbn1cclxuXHJcbi5hY3RpdmUtc2VjdGlvbiB7XHJcbiAgQGluY2x1ZGUgYWN0aXZlLXNlY3Rpb24tc3R5bGU7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG59XHJcblxyXG4uaXRlbS1saXN0LWFjdGl2ZS1zZWN0aW9uIHtcclxuICBAaW5jbHVkZSBhY3RpdmUtc2VjdGlvbi1zdHlsZTtcclxuICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC44KTtcclxufVxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgJ3Jvb3RfY29sb3JzJztcclxuXHJcbi8vIFZhcmlhYmxlcyBkZSBjb2xvcmVzXHJcbiRwcmltYXJ5OiAjNDA0NTZjO1xyXG4kZm9jdXMtaW5wdXQ6IGxpZ2h0ZW4oJHByaW1hcnksIDMwJSk7XHJcblxyXG4kYmc6ICNmMWYwZjY7XHJcbiRiZy1lbGVtZW50czogI2VjZjBmMztcclxuJHNoYTE6ICNmOWY5Zjk7XHJcbiRzaGEyOiAjZDFkOWU2O1xyXG4kd2hpdGU6ICNmZmY7XHJcblxyXG4kYmxhY2s6ICMwMDAwMDA7XHJcbiRibGFjay1zaGE6ICMxODE4MWM7XHJcblxyXG4kZ3JheTogIzgwODA4MDtcclxuJGdyYXktdGV4dDogIzQ5NDk0OTtcclxuXHJcbiRvcm86ICM3MTZiNDE7XHJcbiRzaGFkb3ctb3JvOiAjMTcxODFjO1xyXG5cclxuXHJcbi8vIENvbG9yIGRlIGJvdG9uZXNcclxuJGJ0bnM6ICMzYzY4ZTM7XHJcbiRidG4tY29sb3ItMTogJGJ0bnM7XHJcbiRidG4tY29sb3ItMjogZGFya2VuKCRidG5zLCAxMCk7XHJcbiRidG4tY29sb3ItMzogZGFya2VuKCRidG5zLCAyMCk7XHJcbiRidG4tY29sb3ItNDogZGFya2VuKCRidG5zLCAzMCk7XHJcbiRidG4tY29sb3ItNTogZGFya2VuKCRidG5zLCA0MCk7XHJcbiRidG4tY29sb3ItNjogZGFya2VuKCRidG5zLCA1MCk7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1idXNjYXI6ICMyOTgwYjk7XHJcbiRidG4tY29sb3ItaW5ncmVzYXI6ICMxYTc1MDA7XHJcbiRidG4tY29sb3ItbmF2ZWdhY2lvbjogIzAwOWM4YztcclxuXHJcblxyXG4kYnRuLWNvbG9yLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItYnVzY2FyLCAxMCk7XHJcbiRidG4tY29sb3ItZGVsZXRlLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItZmlsdHJvLCAxMCk7XHJcbiRidG4tY29sb3ItY29weTogIzAwNmQ3NztcclxuJGJ0bi1jb2xvci1leGNlbDogIzBlNzUzYztcclxuJGJ0bi1jb2xvci1jc3Y6ICNmZjk4MDA7XHJcbiRidG4tY29sb3ItcHJpbnQ6ICMxN2EyYjg7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1lbnZpYXI6ICMyN2FlNjA7XHJcbiRidG4tY29sb3ItbnVldm86ICMzNDk4ZGI7XHJcbiRidG4tY29sb3ItZWRpdGFyOiAjZjM5YzEyO1xyXG4kYnRuLWNvbG9yLWFjdHVhbGl6YXI6ICMyZWNjNzE7XHJcbiRidG4tY29sb3ItZWxpbWluYXI6ICNlNzRjM2M7XHJcbiRidG4tY29sb3ItY2FuY2VsYXI6ICM5NWE1YTY7XHJcblxyXG4iLCIvLyBGdWVudGUgcHJpbmNpcGFsXHJcbiRmb250LXByaW1hcnk6ICdBcmlhbCcsIHNhbnMtc2VyaWY7XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gVGFtYcODwrFvcyBWYXJpYWJsZXNcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcblxyXG4vLyBOYXZiYXJcclxuJHRleHQtbmF2OiAxLjE1ZW07ICAgICAgLy8gMThweFxyXG5cclxuLy8gU2lkZWJhclxyXG4kdGl0bGUtc2lkZWJhcjogMS4yZW07ICAvLyAyMHB4XHJcbiRpdGVtLXRleHQ6IDAuNzVlbTsgICAgIC8vIDEycHhcclxuJGl0ZW0tZGl2aWRlcjogMC42ZW07ICAgLy8gMTBweFxyXG4kaXRlbS1hdXRvcnM6IDAuNTVlbTsgICAvLyA5cHhcclxuXHJcbi8vIENvbnRlbnRcclxuJHRpdGxlLWNvbnRlbnQ6IDEuMmVtO1xyXG5cclxuLy8gRXJyb3IgNDA0XHJcbiR0aXRsZS1lcnJvcjogOS41ZW07ICAgICAgLy8gMTUwcHhcclxuJHN1YnRpdGxlLWVycm9yOiAzLjFlbTsgICAvLyA1MHB4XHJcbiR0ZXh0LWVycm9yOiAxLjJlbTtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBFc3RhbmRhclxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuJHRpdGxlLXRleHQtaDE6IDJlbTtcclxuJHRpdGxlLXRleHQtaDI6IDEuNWVtO1xyXG4kdGl0bGUtdGV4dC1oMzogMS4xN2VtO1xyXG4kdGl0bGUtdGV4dC1oNDogMWVtO1xyXG4kdGl0bGUtdGV4dC1oNTogMC44M2VtO1xyXG4kdGl0bGUtdGV4dC1oNjogMC42N2VtO1xyXG4kdGV4dC1wOiAxZW07XHJcblxyXG4kaWNvbi1zaXplOiAxLjJlbTtcclxuJHRleHQtYnV0dG9uLXNpemU6IDAuNzVlbTtcclxuXHJcbi8vIFRhYmxldFxyXG4kdGl0bGUtdGV4dC1oMS10YWJsZXQ6IDEuOGVtO1xyXG4kdGl0bGUtdGV4dC1oMi10YWJsZXQ6IDEuMzVlbTtcclxuJHRpdGxlLXRleHQtaDMtdGFibGV0OiAxLjA1ZW07XHJcbiR0aXRsZS10ZXh0LWg0LXRhYmxldDogMC45ZW07XHJcbiR0aXRsZS10ZXh0LWg1LXRhYmxldDogMC43NWVtO1xyXG4kdGl0bGUtdGV4dC1oNi10YWJsZXQ6IDAuNmVtO1xyXG4kdGV4dC1wLXRhYmxldDogMC45ZW07XHJcblxyXG4vLyBNb3ZpbFxyXG4kdGl0bGUtdGV4dC1oMS1waG9uZTogMS42ZW07XHJcbiR0aXRsZS10ZXh0LWgyLXBob25lOiAxLjJlbTtcclxuJHRpdGxlLXRleHQtaDMtcGhvbmU6IDFlbTtcclxuJHRpdGxlLXRleHQtaDQtcGhvbmU6IDAuOGVtO1xyXG4kdGl0bGUtdGV4dC1oNS1waG9uZTogMC43ZW07XHJcbiR0aXRsZS10ZXh0LWg2LXBob25lOiAwLjVlbTtcclxuJHRleHQtcC1waG9uZTogMC44NWVtO1xyXG5cclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBUYW1hw4PCsW9zIGRlIGxldHJhIHBhcmEgZm9ybXVsYXJpb3NcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiRmb3JtLWlucHV0OiAwLjhlbTtcclxuJGZvcm0tbGFiZWw6IDAuNzVlbTtcclxuJGZvcm0tcmVxdWllcmVkOiAwLjU1ZW07XHJcblxyXG5cclxuXHJcbiRkaWFsb2ctaGVhZGVyLXRpdGxlOiAwLjhlbTtcclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuIl0sInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 2335:
/*!**************************************************!*\
  !*** ./src/app/views/Module/module.component.ts ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ModuleComponent: () => (/* binding */ ModuleComponent)
/* harmony export */ });
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/router */ 5072);
/* harmony import */ var _module_routes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module.routes */ 1560);
/* harmony import */ var _designs_navbar_navbar_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./designs/navbar/navbar.component */ 9892);
/* harmony import */ var primeng_toast__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! primeng/toast */ 1225);
/* harmony import */ var _designs_sidebar_sidebar_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./designs/sidebar/sidebar.component */ 6946);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/platform-browser */ 436);
/* harmony import */ var _core_services_sidebar_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../core/services/sidebar.service */ 9964);











const _c0 = a0 => ({
  "dimension-content-hidden": a0
});
const _c1 = a0 => ({
  "views-active": a0
});
class ModuleComponent {
  constructor(titleService, sidebarService, router) {
    this.titleService = titleService;
    this.sidebarService = sidebarService;
    this.router = router;
    // Titulos
    this.title = 'Gestión Académica';
    this.title_component = '';
    // Timer
    this.timeRemaining = null;
    // Sidebar
    this.sidebarHidden = true;
    this.routesArray = [];
    // Suscribirse a eventos de cambio de navegación
    this.router.events.subscribe(event => {
      this.updateTitle();
    });
  }
  ngOnInit() {
    // Rutas
    this.routesArray = _module_routes__WEBPACK_IMPORTED_MODULE_0__.routesArrayModulo1;
    // Actualizar el título cuando se carga la página por primera vez
    this.updateTitle();
    // Obtener el valor de 'sidebar' del localStorage
    this.sidebarHidden = this.sidebarService.checkSidebarStorage();
    // Cambiar nombre de dividers a -
    this.sidebarService.changeNameDividers(this.sidebarHidden);
  }
  // Cambiar estado del sidebar
  toggleSidebar() {
    this.sidebarHidden = this.sidebarService.toggleSidebar();
  }
  // Función para actualizar el título de la página
  updateTitle() {
    const path = window.location.pathname;
    let newPath;
    // Verificar si la ruta incluye "/base-angular"
    const index = path.indexOf('/base-angular');
    if (index !== -1) {
      // Obtener la parte de la ruta después de "/base-angular"
      newPath = path.substring(index + '/base-angular'.length);
    } else {
      // Si no hay "/base-angular" en la ruta, simplemente usar la ruta completa
      newPath = path;
    }
    // Titulo de componente
    if (this.routesArray.includes(newPath)) {
      const parts = newPath.split('/');
      const lastPart = parts[parts.length - 1];
      const newTitle = this.formatTitle(lastPart) || 'Default Title'; // Se asegura de que el título no esté vacío
      // Decorador de titulo de componente
      if (this.title_component !== newTitle) {
        this.title_component = newTitle;
        this.titleService.setTitle(this.title_component);
        document.documentElement.style.setProperty('--title-length', this.title_component.length.toString());
      }
    }
  }
  // Capitalizar la primera letra de una cadena y reemplazar guiones con espacios
  formatTitle(text) {
    const titleWithoutDash = text.replace(/-/g, ' ');
    return this.capitalizeFirstLetter(titleWithoutDash);
  }
  // Convertir primera en mayuscula
  capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  // Redimencionar el contenido del contenedor
  ngAfterViewInit() {
    this.adjustViewsMinHeight();
    window.addEventListener('resize', () => this.adjustViewsMinHeight());
  }
  adjustViewsMinHeight() {
    const viewsElement = document.querySelector('.views');
    if (viewsElement) {
      const windowHeight = window.innerHeight;
      const currentTop = viewsElement.getBoundingClientRect().top;
      const minHeight = Math.max(windowHeight - currentTop - 45, 0);
      viewsElement.style.minHeight = `${minHeight}px`;
    }
  }
  static #_ = this.ɵfac = function ModuleComponent_Factory(t) {
    return new (t || ModuleComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_angular_platform_browser__WEBPACK_IMPORTED_MODULE_5__.Title), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_core_services_sidebar_service__WEBPACK_IMPORTED_MODULE_3__.SidebarService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_6__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdefineComponent"]({
    type: ModuleComponent,
    selectors: [["modulo1-root"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵStandaloneFeature"]],
    decls: 10,
    vars: 17,
    consts: [[3, "toggleSidebar", "routes", "sidebarHidden"], [3, "title", "routes", "sidebarHidden"], [1, "content-views", "dimension-content", 3, "ngClass"], [1, "title-component"], [1, "title-content"], [1, "divisor-title"], [1, "views", 3, "ngClass"], [3, "life", "showTransformOptions", "showTransitionOptions", "hideTransitionOptions"]],
    template: function ModuleComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "app-navbar", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("toggleSidebar", function ModuleComponent_Template_app_navbar_toggleSidebar_0_listener() {
          return ctx.toggleSidebar();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](1, "app-sidebar", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](2, "section", 2)(3, "div", 3)(4, "span", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](6, "div", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](7, "div", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](8, "router-outlet");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](9, "p-toast", 7);
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("routes", ctx.routesArray)("sidebarHidden", ctx.sidebarHidden);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("title", ctx.title)("routes", ctx.routesArray)("sidebarHidden", ctx.sidebarHidden);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](13, _c0, ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](ctx.title_component);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](15, _c1, ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("life", 10000)("showTransformOptions", "translateY(100%)")("showTransitionOptions", "500ms")("hideTransitionOptions", "500ms")("showTransformOptions", "translateX(100%)");
      }
    },
    dependencies: [_angular_router__WEBPACK_IMPORTED_MODULE_6__.RouterOutlet, _designs_navbar_navbar_component__WEBPACK_IMPORTED_MODULE_1__.NavbarComponent, _designs_sidebar_sidebar_component__WEBPACK_IMPORTED_MODULE_2__.SidebarComponent, _angular_common__WEBPACK_IMPORTED_MODULE_7__.NgClass, primeng_toast__WEBPACK_IMPORTED_MODULE_8__.ToastModule, primeng_toast__WEBPACK_IMPORTED_MODULE_8__.Toast],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n  *,   *::after,   *::before {\n  box-sizing: content-box;\n}\n\n  html,   body {\n  padding: 0;\n}\n\n  .views {\n  background-color: #f1f0f6;\n  margin: 0;\n}\n\n.content-views[_ngcontent-%COMP%] {\n  display: block;\n  padding: 20px;\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%] {\n  display: grid;\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%]   .title-content[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n  font-weight: bold;\n  margin-bottom: 5px;\n  color: rgba(0, 0, 0, 0.8);\n}\n.content-views[_ngcontent-%COMP%]   .title-component[_ngcontent-%COMP%]   .divisor-title[_ngcontent-%COMP%] {\n  height: 3px;\n  margin-bottom: 5px;\n  border-radius: 50px;\n  background-color: #40456c;\n  width: calc(5px * var(--title-length, 0));\n}\n.content-views[_ngcontent-%COMP%]   .views[_ngcontent-%COMP%] {\n  position: relative;\n  padding: 10px 20px;\n  border-radius: 10px;\n  background-color: #fff;\n  border: 1px solid rgba(0, 0, 0, 0.05);\n}\n@media (max-width: 630px) {\n  .content-views[_ngcontent-%COMP%]   .views[_ngcontent-%COMP%] {\n    position: absolute;\n  }\n}\n@media (max-width: 630px) {\n  .content-views[_ngcontent-%COMP%]   .views-active[_ngcontent-%COMP%] {\n    position: relative !important;\n  }\n}\n@media (max-width: 470px) {\n  .content-views[_ngcontent-%COMP%]   .views-active[_ngcontent-%COMP%] {\n    position: absolute !important;\n  }\n}\n\n.dimension-content[_ngcontent-%COMP%] {\n  position: relative;\n  margin-top: 60px;\n}\n\n.dimension-nav[_ngcontent-%COMP%], .dimension-content[_ngcontent-%COMP%] {\n  width: calc(100% - 270px);\n  left: 230px;\n  gap: 10px;\n  transition: all 0.3s ease;\n}\n\n.dimension-nav-hidden[_ngcontent-%COMP%], .dimension-content-hidden[_ngcontent-%COMP%] {\n  width: calc(100% - 105px);\n  left: 65px;\n  transition: all 0.3s ease;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvbW9kdWxlLmNvbXBvbmVudC5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2ZvbnRzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNSRjs7QUEzQkE7OztFQUdFLHVCQUFBO0FBOEJGOztBQTNCQTs7RUFFRSxVQUFBO0FBOEJGOztBQTNCQTtFQUNFLHlCQ1pHO0VEYUgsU0FBQTtBQThCRjs7QUEzQkE7RUFDRSxjQUFBO0VBQ0EsYUFBQTtBQThCRjtBQTVCRTtFQUNFLGFBQUE7QUE4Qko7QUE1Qkk7RUFDRSxnQkVkVTtFRmVWLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSx5QkFBQTtBQThCTjtBQTFCSTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0EseUJDdENJO0VEdUNKLHlDQUFBO0FBNEJOO0FBeEJFO0VBQ0Usa0JBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0Esc0JDeENJO0VEeUNKLHFDQUFBO0FBMEJKO0FBeEJJO0VBUEY7SUFRSSxrQkFBQTtFQTJCSjtBQUNGO0FBdkJJO0VBREY7SUFFSSw2QkFBQTtFQTBCSjtBQUNGO0FBeEJJO0VBTEY7SUFNSSw2QkFBQTtFQTJCSjtBQUNGOztBQXJCQTtFQUNFLGtCQUFBO0VBQ0EsZ0JBQUE7QUF3QkY7O0FBckJBOztFQUVFLHlCQUFBO0VBQ0EsV0FBQTtFQUNBLFNBQUE7RUFDQSx5QkFBQTtBQXdCRjs7QUFwQkE7O0VBRUUseUJBQUE7RUFDQSxVQUFBO0VBQ0EseUJBQUE7QUF1QkYiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBDb2xvcmVzIHJvb3RcclxuOnJvb3Qge1xyXG5cclxuICAvLyBzb2xpZFxyXG4gIC0tamV0OiBoc2woMCwgMCUsIDIyJSk7XHJcbiAgLS1vbnl4OiBoc2woMjQwLCAxJSwgMTclKTtcclxuXHJcbiAgLS1ibGFjazogaHNsKDAsIDAlLCAwJSk7XHJcbiAgLS1ibGFjay05MDogaHNsYSgwLCAwJSwgMCUsIDAuOSk7XHJcbiAgLS1ibGFjay04MDogaHNsYSgwLCAwJSwgMCUsIDAuOCk7XHJcbiAgLS1ibGFjay03MDogaHNsYSgwLCAwJSwgMCUsIDAuNyk7XHJcbiAgLS1ibGFjay02MDogaHNsYSgwLCAwJSwgMCUsIDAuNik7XHJcbiAgLS1ibGFjay01MDogaHNsYSgwLCAwJSwgMCUsIDAuNSk7XHJcbiAgLS1ibGFjay00MDogaHNsYSgwLCAwJSwgMCUsIDAuNCk7XHJcbiAgLS1ibGFjay0zMDogaHNsYSgwLCAwJSwgMCUsIDAuMyk7XHJcbiAgLS1ibGFjay0yMDogaHNsYSgwLCAwJSwgMCUsIDAuMik7XHJcbiAgLS1ibGFjay0xMDogaHNsYSgwLCAwJSwgMCUsIDAuMSk7XHJcblxyXG4gIC0td2hpdGU6IGhzbCgwLCAwJSwgMTAwJSk7XHJcbiAgLS13aGl0ZS05MDogaHNsKDAsIDAlLCAxMDAlLCAwLjkpO1xyXG4gIC0td2hpdGUtODA6IGhzbCgwLCAwJSwgMTAwJSwgMC44KTtcclxuICAtLXdoaXRlLTcwOiBoc2woMCwgMCUsIDEwMCUsIDAuNyk7XHJcbiAgLS13aGl0ZS02MDogaHNsKDAsIDAlLCAxMDAlLCAwLjYpO1xyXG4gIC0td2hpdGUtNTA6IGhzbCgwLCAwJSwgMTAwJSwgMC41KTtcclxuICAtLXdoaXRlLTQwOiBoc2woMCwgMCUsIDEwMCUsIDAuNCk7XHJcbiAgLS13aGl0ZS0zMDogaHNsKDAsIDAlLCAxMDAlLCAwLjMpO1xyXG4gIC0td2hpdGUtMjA6IGhzbCgwLCAwJSwgMTAwJSwgMC4yKTtcclxuICAtLXdoaXRlLTEwOiBoc2woMCwgMCUsIDEwMCUsIDAuMSk7XHJcblxyXG4gIC8vIHNoYWRvd1xyXG4gIC0tc2hhZG93LTE6IC00cHggOHB4IDI0cHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTI6IDVweCA1cHggMTBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMzogMCAxNnB4IDQwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTQ6IDAgMjVweCA1MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjE1KTtcclxuICAtLXNoYWRvdy01OiAwIDI0cHggODBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNjogMCAxNnB4IDNweCBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuXHJcbiAgLy8gQ29sb3JzXHJcbiAgLS1yZWQ6IGhzbCgwLCAxMDAlLCA1MCUpO1xyXG4gIC0teWVsbG93OiBoc2woNjAsIDEwMCUsIDUwJSk7XHJcbiAgLS1ncmVlbjogaHNsKDEyMCwgMTAwJSwgMjUlKTtcclxuICAtLWJsdWU6IGhzbCgyNDAsIDEwMCUsIDUwJSk7XHJcbiAgLS1wdXJwbGU6IGhzbCgzMDAsIDEwMCUsIDI1JSk7XHJcbn1cclxuIiwiQHVzZSBcIi4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvY29sb3JzXCIgYXMgY29sb3JzO1xyXG5AdXNlIFwiLi4vLi4vLi4vYXNzZXRzL3Njc3MvdmFycy9mb250c1wiIGFzIGZvbnRzO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIENvbnRlbmVkb3IgZGUgdmlzdGFzXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuOjpuZy1kZWVwICosXHJcbjo6bmctZGVlcCAqOjphZnRlcixcclxuOjpuZy1kZWVwICo6OmJlZm9yZSB7XHJcbiAgYm94LXNpemluZzogY29udGVudC1ib3g7XHJcbn1cclxuXHJcbjo6bmctZGVlcCBodG1sLFxyXG46Om5nLWRlZXAgYm9keSB7XHJcbiAgcGFkZGluZzogMDtcclxufVxyXG5cclxuOjpuZy1kZWVwIC52aWV3cyB7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRiZztcclxuICBtYXJnaW46IDA7XHJcbn1cclxuXHJcbi5jb250ZW50LXZpZXdzIHtcclxuICBkaXNwbGF5OiBibG9jaztcclxuICBwYWRkaW5nOiAyMHB4O1xyXG5cclxuICAudGl0bGUtY29tcG9uZW50IHtcclxuICAgIGRpc3BsYXk6IGdyaWQ7XHJcblxyXG4gICAgLnRpdGxlLWNvbnRlbnQge1xyXG4gICAgICBmb250LXNpemU6IGZvbnRzLiR0aXRsZS1jb250ZW50O1xyXG4gICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgbWFyZ2luLWJvdHRvbTogNXB4O1xyXG4gICAgICBjb2xvcjogcmdiYShjb2xvcnMuJGJsYWNrLCAwLjgpO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIERpdmlzb3JcclxuICAgIC5kaXZpc29yLXRpdGxlIHtcclxuICAgICAgaGVpZ2h0OiAzcHg7XHJcbiAgICAgIG1hcmdpbi1ib3R0b206IDVweDtcclxuICAgICAgYm9yZGVyLXJhZGl1czogNTBweDtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gICAgICB3aWR0aDogY2FsYyg1cHggKiB2YXIoLS10aXRsZS1sZW5ndGgsIDApKTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC52aWV3cyB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICBwYWRkaW5nOiAxMHB4IDIwcHg7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiR3aGl0ZTtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoY29sb3JzLiRibGFjaywgMC4wNSk7XHJcblxyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDYzMHB4KSB7XHJcbiAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC52aWV3cy1hY3RpdmUge1xyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDYzMHB4KSB7XHJcbiAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOiA0NzBweCkge1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICB9XHJcbn1cclxuXHJcbi8vIEVzcGVjaWZpY2EgbGFzIGRpbWVuY2lvbmVzIGVuIGxhcyBxdWUgc2UgZGViZW4gcG9uZXIgZWwgbmF2IHkgZWwgY29udGVuZWRvclxyXG4vLyBTaWRlYmFyIEV4cGFuZGlkb1xyXG4uZGltZW5zaW9uLWNvbnRlbnQge1xyXG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICBtYXJnaW4tdG9wOiA2MHB4O1xyXG59XHJcblxyXG4uZGltZW5zaW9uLW5hdixcclxuLmRpbWVuc2lvbi1jb250ZW50IHtcclxuICB3aWR0aDogY2FsYygxMDAlIC0gMjcwcHgpO1xyXG4gIGxlZnQ6IDIzMHB4O1xyXG4gIGdhcDogMTBweDtcclxuICB0cmFuc2l0aW9uOiBhbGwgMC4zcyBlYXNlO1xyXG59XHJcblxyXG4vLyBTaWRlYmFyIFJldHJhaWRvXHJcbi5kaW1lbnNpb24tbmF2LWhpZGRlbixcclxuLmRpbWVuc2lvbi1jb250ZW50LWhpZGRlbiB7XHJcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDEwNXB4KTtcclxuICBsZWZ0OiA2NXB4O1xyXG4gIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2U7XHJcbn1cclxuIiwiLy8gSW1wb3J0c1xyXG5AdXNlICdyb290X2NvbG9ycyc7XHJcblxyXG4vLyBWYXJpYWJsZXMgZGUgY29sb3Jlc1xyXG4kcHJpbWFyeTogIzQwNDU2YztcclxuJGZvY3VzLWlucHV0OiBsaWdodGVuKCRwcmltYXJ5LCAzMCUpO1xyXG5cclxuJGJnOiAjZjFmMGY2O1xyXG4kYmctZWxlbWVudHM6ICNlY2YwZjM7XHJcbiRzaGExOiAjZjlmOWY5O1xyXG4kc2hhMjogI2QxZDllNjtcclxuJHdoaXRlOiAjZmZmO1xyXG5cclxuJGJsYWNrOiAjMDAwMDAwO1xyXG4kYmxhY2stc2hhOiAjMTgxODFjO1xyXG5cclxuJGdyYXk6ICM4MDgwODA7XHJcbiRncmF5LXRleHQ6ICM0OTQ5NDk7XHJcblxyXG4kb3JvOiAjNzE2YjQxO1xyXG4kc2hhZG93LW9ybzogIzE3MTgxYztcclxuXHJcblxyXG4vLyBDb2xvciBkZSBib3RvbmVzXHJcbiRidG5zOiAjM2M2OGUzO1xyXG4kYnRuLWNvbG9yLTE6ICRidG5zO1xyXG4kYnRuLWNvbG9yLTI6IGRhcmtlbigkYnRucywgMTApO1xyXG4kYnRuLWNvbG9yLTM6IGRhcmtlbigkYnRucywgMjApO1xyXG4kYnRuLWNvbG9yLTQ6IGRhcmtlbigkYnRucywgMzApO1xyXG4kYnRuLWNvbG9yLTU6IGRhcmtlbigkYnRucywgNDApO1xyXG4kYnRuLWNvbG9yLTY6IGRhcmtlbigkYnRucywgNTApO1xyXG5cclxuXHJcbiRidG4tY29sb3ItYnVzY2FyOiAjMjk4MGI5O1xyXG4kYnRuLWNvbG9yLWluZ3Jlc2FyOiAjMWE3NTAwO1xyXG4kYnRuLWNvbG9yLW5hdmVnYWNpb246ICMwMDljOGM7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1maWx0cm86IGRhcmtlbigkYnRuLWNvbG9yLWJ1c2NhciwgMTApO1xyXG4kYnRuLWNvbG9yLWRlbGV0ZS1maWx0cm86IGRhcmtlbigkYnRuLWNvbG9yLWZpbHRybywgMTApO1xyXG4kYnRuLWNvbG9yLWNvcHk6ICMwMDZkNzc7XHJcbiRidG4tY29sb3ItZXhjZWw6ICMwZTc1M2M7XHJcbiRidG4tY29sb3ItY3N2OiAjZmY5ODAwO1xyXG4kYnRuLWNvbG9yLXByaW50OiAjMTdhMmI4O1xyXG5cclxuXHJcbiRidG4tY29sb3ItZW52aWFyOiAjMjdhZTYwO1xyXG4kYnRuLWNvbG9yLW51ZXZvOiAjMzQ5OGRiO1xyXG4kYnRuLWNvbG9yLWVkaXRhcjogI2YzOWMxMjtcclxuJGJ0bi1jb2xvci1hY3R1YWxpemFyOiAjMmVjYzcxO1xyXG4kYnRuLWNvbG9yLWVsaW1pbmFyOiAjZTc0YzNjO1xyXG4kYnRuLWNvbG9yLWNhbmNlbGFyOiAjOTVhNWE2O1xyXG5cclxuIiwiLy8gRnVlbnRlIHByaW5jaXBhbFxyXG4kZm9udC1wcmltYXJ5OiAnQXJpYWwnLCBzYW5zLXNlcmlmO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgVmFyaWFibGVzXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuLy8gTmF2YmFyXHJcbiR0ZXh0LW5hdjogMS4xNWVtOyAgICAgIC8vIDE4cHhcclxuXHJcbi8vIFNpZGViYXJcclxuJHRpdGxlLXNpZGViYXI6IDEuMmVtOyAgLy8gMjBweFxyXG4kaXRlbS10ZXh0OiAwLjc1ZW07ICAgICAvLyAxMnB4XHJcbiRpdGVtLWRpdmlkZXI6IDAuNmVtOyAgIC8vIDEwcHhcclxuJGl0ZW0tYXV0b3JzOiAwLjU1ZW07ICAgLy8gOXB4XHJcblxyXG4vLyBDb250ZW50XHJcbiR0aXRsZS1jb250ZW50OiAxLjJlbTtcclxuXHJcbi8vIEVycm9yIDQwNFxyXG4kdGl0bGUtZXJyb3I6IDkuNWVtOyAgICAgIC8vIDE1MHB4XHJcbiRzdWJ0aXRsZS1lcnJvcjogMy4xZW07ICAgLy8gNTBweFxyXG4kdGV4dC1lcnJvcjogMS4yZW07XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gRXN0YW5kYXJcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiR0aXRsZS10ZXh0LWgxOiAyZW07XHJcbiR0aXRsZS10ZXh0LWgyOiAxLjVlbTtcclxuJHRpdGxlLXRleHQtaDM6IDEuMTdlbTtcclxuJHRpdGxlLXRleHQtaDQ6IDFlbTtcclxuJHRpdGxlLXRleHQtaDU6IDAuODNlbTtcclxuJHRpdGxlLXRleHQtaDY6IDAuNjdlbTtcclxuJHRleHQtcDogMWVtO1xyXG5cclxuJGljb24tc2l6ZTogMS4yZW07XHJcbiR0ZXh0LWJ1dHRvbi1zaXplOiAwLjc1ZW07XHJcblxyXG4vLyBUYWJsZXRcclxuJHRpdGxlLXRleHQtaDEtdGFibGV0OiAxLjhlbTtcclxuJHRpdGxlLXRleHQtaDItdGFibGV0OiAxLjM1ZW07XHJcbiR0aXRsZS10ZXh0LWgzLXRhYmxldDogMS4wNWVtO1xyXG4kdGl0bGUtdGV4dC1oNC10YWJsZXQ6IDAuOWVtO1xyXG4kdGl0bGUtdGV4dC1oNS10YWJsZXQ6IDAuNzVlbTtcclxuJHRpdGxlLXRleHQtaDYtdGFibGV0OiAwLjZlbTtcclxuJHRleHQtcC10YWJsZXQ6IDAuOWVtO1xyXG5cclxuLy8gTW92aWxcclxuJHRpdGxlLXRleHQtaDEtcGhvbmU6IDEuNmVtO1xyXG4kdGl0bGUtdGV4dC1oMi1waG9uZTogMS4yZW07XHJcbiR0aXRsZS10ZXh0LWgzLXBob25lOiAxZW07XHJcbiR0aXRsZS10ZXh0LWg0LXBob25lOiAwLjhlbTtcclxuJHRpdGxlLXRleHQtaDUtcGhvbmU6IDAuN2VtO1xyXG4kdGl0bGUtdGV4dC1oNi1waG9uZTogMC41ZW07XHJcbiR0ZXh0LXAtcGhvbmU6IDAuODVlbTtcclxuXHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gVGFtYcODwrFvcyBkZSBsZXRyYSBwYXJhIGZvcm11bGFyaW9zXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kZm9ybS1pbnB1dDogMC44ZW07XHJcbiRmb3JtLWxhYmVsOiAwLjc1ZW07XHJcbiRmb3JtLXJlcXVpZXJlZDogMC41NWVtO1xyXG5cclxuXHJcblxyXG4kZGlhbG9nLWhlYWRlci10aXRsZTogMC44ZW07XHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcbiJdLCJzb3VyY2VSb290IjoiIn0= */"]
  });
}

/***/ }),

/***/ 1560:
/*!***********************************************!*\
  !*** ./src/app/views/Module/module.routes.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   routesArrayModulo1: () => (/* binding */ routesArrayModulo1),
/* harmony export */   routesModulo1: () => (/* binding */ routesModulo1)
/* harmony export */ });
/* harmony import */ var _module_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module.component */ 2335);
/* harmony import */ var _views_home_home_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./views/home/home.component */ 7471);
/* harmony import */ var _views_Director_load_periods_load_periods_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./views/Director/load-periods/load-periods.component */ 1132);
/* harmony import */ var _views_Director_all_students_all_students_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./views/Director/all-students/all-students.component */ 4930);
/* harmony import */ var _views_Director_history_note_history_note_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./views/Director/history-note/history-note.component */ 3600);





// Nombre de rutas
const home = 'inicio'; // 0
const director = 'director/';
const loadPeriods = `${director}cargar-periodos`; // 1
const allStudents = `${director}estudiantes`; // 2
const historyNote = `${director}historial-de-notas`; // 3
const coordinador = 'coordinador/';
const docente = 'docente/';
const estudiante = 'estudiante/';
// Definir el array de rutas en el constructor
const routesArrayModulo1 = ['/' + home, '/' + loadPeriods, '/' + allStudents, '/' + historyNote];
// Convertir primera en mayuscula
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
const routesModulo1 = [{
  path: '',
  component: _module_component__WEBPACK_IMPORTED_MODULE_0__.ModuleComponent,
  children: [{
    path: '',
    redirectTo: home,
    pathMatch: 'full'
  },
  // GENERAL
  {
    path: home,
    component: _views_home_home_component__WEBPACK_IMPORTED_MODULE_1__.HomeComponent,
    data: {
      title: capitalizeFirstLetter(home)
    }
  },
  // DIRECTOR
  {
    path: loadPeriods,
    component: _views_Director_load_periods_load_periods_component__WEBPACK_IMPORTED_MODULE_2__.LoadPeriodsComponent,
    data: {
      title: capitalizeFirstLetter(loadPeriods)
    }
  }, {
    path: allStudents,
    component: _views_Director_all_students_all_students_component__WEBPACK_IMPORTED_MODULE_3__.AllStudentsComponent,
    data: {
      title: capitalizeFirstLetter(allStudents)
    }
  }, {
    path: historyNote,
    component: _views_Director_history_note_history_note_component__WEBPACK_IMPORTED_MODULE_4__.HistoryNoteComponent,
    data: {
      title: capitalizeFirstLetter(historyNote)
    }
  }
  // COORDINADOR
  // DOCENTE
  // ESTUDIANTE
  ]
}];

/***/ }),

/***/ 1112:
/*!*******************************************************!*\
  !*** ./src/app/views/Module/services/data.service.ts ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   DataService: () => (/* binding */ DataService)
/* harmony export */ });
/* harmony import */ var src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! src/environments/environment.development */ 3587);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 6443);



class DataService {
  constructor(http) {
    this.http = http;
    // Endpoint Servidor
    this.baseURL = `${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlBase}${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlData}`;
  }
  // Obtener las notas
  getNotasData() {
    return this.http.get(`${this.baseURL}/notas`);
  }
  // Obtener la lista de periodos
  getPeriodoList() {
    return this.http.get(`${this.baseURL}/listPeriodo`);
  }
  // Obtener la lista de niveles
  getNivelList() {
    return this.http.get(`${this.baseURL}/listNivel`);
  }
  // Obtener la lista de departamentos
  getDepartamentosList() {
    return this.http.get(`${this.baseURL}/listDepartamento`);
  }
  // Obtener la lista de materias
  getMateriaList() {
    return this.http.get(`${this.baseURL}/listMateria`);
  }
  // Obtener la lista de docentes
  getDocenteList() {
    return this.http.get(`${this.baseURL}/listDocente`);
  }
  // Obtener la lista de estados
  getEstadoList() {
    return this.http.get(`${this.baseURL}/listEstado`);
  }
  // Obtener la lista de mallas
  getMallaList() {
    return this.http.get(`${this.baseURL}/listMalla`);
  }
  // Obtener la lista de generos
  getGeneroList() {
    return this.http.get(`${this.baseURL}/listGenero`);
  }
  // Obtener los generos
  getGenerosData(namefile) {
    return this.http.get(`${this.baseURL}/genero/${namefile}`);
  }
  // Actualizar los generos
  uploadGeneros(namefile, formData) {
    return this.http.put(`${this.baseURL}/genero/${namefile}`, formData);
  }
  static #_ = this.ɵfac = function DataService_Factory(t) {
    return new (t || DataService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: DataService,
    factory: DataService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 9562:
/*!*******************************************************!*\
  !*** ./src/app/views/Module/services/file.service.ts ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   FileService: () => (/* binding */ FileService)
/* harmony export */ });
/* harmony import */ var src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! src/environments/environment.development */ 3587);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 6443);



class FileService {
  constructor(http) {
    this.http = http;
    // Endpoint Servidor
    this.baseURL = `${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlBase}${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlFile}`;
  }
  // Obtener las referencias a los archivos de notas
  getFilesNotas() {
    return this.http.get(`${this.baseURL}/noteStudent`);
  }
  deleteFileNotas(filename) {
    return this.http.delete(`${this.baseURL}/noteStudent/${filename}`);
  }
  static #_ = this.ɵfac = function FileService_Factory(t) {
    return new (t || FileService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: FileService,
    factory: FileService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 1756:
/*!**************************************************************!*\
  !*** ./src/app/views/Module/services/upload-data.service.ts ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   UploadDataService: () => (/* binding */ UploadDataService)
/* harmony export */ });
/* harmony import */ var src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! src/environments/environment.development */ 3587);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 6443);



class UploadDataService {
  constructor(http) {
    this.http = http;
    // Endpoint Servidor
    this.baseURL = `${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlBase}${src_environments_environment_development__WEBPACK_IMPORTED_MODULE_0__.environment.urlUpload}`;
  }
  // Método para subir un archivo al servidor
  uploadFile(formData) {
    return this.http.post(`${this.baseURL}/notas_estudiante`, formData);
  }
  static #_ = this.ɵfac = function UploadDataService_Factory(t) {
    return new (t || UploadDataService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: UploadDataService,
    factory: UploadDataService.ɵfac,
    providedIn: 'root'
  });
}

/***/ }),

/***/ 4930:
/*!************************************************************************************!*\
  !*** ./src/app/views/Module/views/Director/all-students/all-students.component.ts ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   AllStudentsComponent: () => (/* binding */ AllStudentsComponent)
/* harmony export */ });
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/forms */ 4456);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _services_file_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../services/file.service */ 9562);
/* harmony import */ var src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! src/app/core/services/alerts.service */ 983);




class AllStudentsComponent {
  constructor(fileService, alertService) {
    this.fileService = fileService;
    this.alertService = alertService;
  }
  ngOnInit() {}
  static #_ = this.ɵfac = function AllStudentsComponent_Factory(t) {
    return new (t || AllStudentsComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_services_file_service__WEBPACK_IMPORTED_MODULE_0__.FileService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_1__.AlertService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: AllStudentsComponent,
    selectors: [["app-all-students"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵStandaloneFeature"]],
    decls: 1,
    vars: 0,
    consts: [[1, ""]],
    template: function AllStudentsComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](0, "section", 0);
      }
    },
    dependencies: [_angular_forms__WEBPACK_IMPORTED_MODULE_3__.FormsModule],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvdmlld3MvRGlyZWN0b3IvYWxsLXN0dWRlbnRzL2FsbC1zdHVkZW50cy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDQTtFQUdFLHNCQUFBO0VBQ0EseUJBQUE7RUFFQSx1QkFBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUVBLHlCQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBR0EsK0NBQUE7RUFDQSw4Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSw2Q0FBQTtFQUNBLDJDQUFBO0VBR0Esd0JBQUE7RUFDQSw0QkFBQTtFQUNBLDRCQUFBO0VBQ0EsMkJBQUE7RUFDQSw2QkFBQTtBQ1JGIiwic291cmNlc0NvbnRlbnQiOlsiLy8gQ29sb3JlcyByb290XHJcbjpyb290IHtcclxuXHJcbiAgLy8gc29saWRcclxuICAtLWpldDogaHNsKDAsIDAlLCAyMiUpO1xyXG4gIC0tb255eDogaHNsKDI0MCwgMSUsIDE3JSk7XHJcblxyXG4gIC0tYmxhY2s6IGhzbCgwLCAwJSwgMCUpO1xyXG4gIC0tYmxhY2stOTA6IGhzbGEoMCwgMCUsIDAlLCAwLjkpO1xyXG4gIC0tYmxhY2stODA6IGhzbGEoMCwgMCUsIDAlLCAwLjgpO1xyXG4gIC0tYmxhY2stNzA6IGhzbGEoMCwgMCUsIDAlLCAwLjcpO1xyXG4gIC0tYmxhY2stNjA6IGhzbGEoMCwgMCUsIDAlLCAwLjYpO1xyXG4gIC0tYmxhY2stNTA6IGhzbGEoMCwgMCUsIDAlLCAwLjUpO1xyXG4gIC0tYmxhY2stNDA6IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG4gIC0tYmxhY2stMzA6IGhzbGEoMCwgMCUsIDAlLCAwLjMpO1xyXG4gIC0tYmxhY2stMjA6IGhzbGEoMCwgMCUsIDAlLCAwLjIpO1xyXG4gIC0tYmxhY2stMTA6IGhzbGEoMCwgMCUsIDAlLCAwLjEpO1xyXG5cclxuICAtLXdoaXRlOiBoc2woMCwgMCUsIDEwMCUpO1xyXG4gIC0td2hpdGUtOTA6IGhzbCgwLCAwJSwgMTAwJSwgMC45KTtcclxuICAtLXdoaXRlLTgwOiBoc2woMCwgMCUsIDEwMCUsIDAuOCk7XHJcbiAgLS13aGl0ZS03MDogaHNsKDAsIDAlLCAxMDAlLCAwLjcpO1xyXG4gIC0td2hpdGUtNjA6IGhzbCgwLCAwJSwgMTAwJSwgMC42KTtcclxuICAtLXdoaXRlLTUwOiBoc2woMCwgMCUsIDEwMCUsIDAuNSk7XHJcbiAgLS13aGl0ZS00MDogaHNsKDAsIDAlLCAxMDAlLCAwLjQpO1xyXG4gIC0td2hpdGUtMzA6IGhzbCgwLCAwJSwgMTAwJSwgMC4zKTtcclxuICAtLXdoaXRlLTIwOiBoc2woMCwgMCUsIDEwMCUsIDAuMik7XHJcbiAgLS13aGl0ZS0xMDogaHNsKDAsIDAlLCAxMDAlLCAwLjEpO1xyXG5cclxuICAvLyBzaGFkb3dcclxuICAtLXNoYWRvdy0xOiAtNHB4IDhweCAyNHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0yOiA1cHggNXB4IDEwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTM6IDAgMTZweCA0MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy00OiAwIDI1cHggNTBweCBoc2xhKDAsIDAlLCAwJSwgMC4xNSk7XHJcbiAgLS1zaGFkb3ctNTogMCAyNHB4IDgwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xyXG4gIC0tc2hhZG93LTY6IDAgMTZweCAzcHggaHNsYSgwLCAwJSwgMCUsIDAuNCk7XHJcblxyXG4gIC8vIENvbG9yc1xyXG4gIC0tcmVkOiBoc2woMCwgMTAwJSwgNTAlKTtcclxuICAtLXllbGxvdzogaHNsKDYwLCAxMDAlLCA1MCUpO1xyXG4gIC0tZ3JlZW46IGhzbCgxMjAsIDEwMCUsIDI1JSk7XHJcbiAgLS1ibHVlOiBoc2woMjQwLCAxMDAlLCA1MCUpO1xyXG4gIC0tcHVycGxlOiBoc2woMzAwLCAxMDAlLCAyNSUpO1xyXG59XHJcbiIsIjpyb290IHtcbiAgLS1qZXQ6IGhzbCgwLCAwJSwgMjIlKTtcbiAgLS1vbnl4OiBoc2woMjQwLCAxJSwgMTclKTtcbiAgLS1ibGFjazogaHNsKDAsIDAlLCAwJSk7XG4gIC0tYmxhY2stOTA6IGhzbGEoMCwgMCUsIDAlLCAwLjkpO1xuICAtLWJsYWNrLTgwOiBoc2xhKDAsIDAlLCAwJSwgMC44KTtcbiAgLS1ibGFjay03MDogaHNsYSgwLCAwJSwgMCUsIDAuNyk7XG4gIC0tYmxhY2stNjA6IGhzbGEoMCwgMCUsIDAlLCAwLjYpO1xuICAtLWJsYWNrLTUwOiBoc2xhKDAsIDAlLCAwJSwgMC41KTtcbiAgLS1ibGFjay00MDogaHNsYSgwLCAwJSwgMCUsIDAuNCk7XG4gIC0tYmxhY2stMzA6IGhzbGEoMCwgMCUsIDAlLCAwLjMpO1xuICAtLWJsYWNrLTIwOiBoc2xhKDAsIDAlLCAwJSwgMC4yKTtcbiAgLS1ibGFjay0xMDogaHNsYSgwLCAwJSwgMCUsIDAuMSk7XG4gIC0td2hpdGU6IGhzbCgwLCAwJSwgMTAwJSk7XG4gIC0td2hpdGUtOTA6IGhzbCgwLCAwJSwgMTAwJSwgMC45KTtcbiAgLS13aGl0ZS04MDogaHNsKDAsIDAlLCAxMDAlLCAwLjgpO1xuICAtLXdoaXRlLTcwOiBoc2woMCwgMCUsIDEwMCUsIDAuNyk7XG4gIC0td2hpdGUtNjA6IGhzbCgwLCAwJSwgMTAwJSwgMC42KTtcbiAgLS13aGl0ZS01MDogaHNsKDAsIDAlLCAxMDAlLCAwLjUpO1xuICAtLXdoaXRlLTQwOiBoc2woMCwgMCUsIDEwMCUsIDAuNCk7XG4gIC0td2hpdGUtMzA6IGhzbCgwLCAwJSwgMTAwJSwgMC4zKTtcbiAgLS13aGl0ZS0yMDogaHNsKDAsIDAlLCAxMDAlLCAwLjIpO1xuICAtLXdoaXRlLTEwOiBoc2woMCwgMCUsIDEwMCUsIDAuMSk7XG4gIC0tc2hhZG93LTE6IC00cHggOHB4IDI0cHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xuICAtLXNoYWRvdy0yOiA1cHggNXB4IDEwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xuICAtLXNoYWRvdy0zOiAwIDE2cHggNDBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XG4gIC0tc2hhZG93LTQ6IDAgMjVweCA1MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjE1KTtcbiAgLS1zaGFkb3ctNTogMCAyNHB4IDgwcHggaHNsYSgwLCAwJSwgMCUsIDAuMjUpO1xuICAtLXNoYWRvdy02OiAwIDE2cHggM3B4IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xuICAtLXJlZDogaHNsKDAsIDEwMCUsIDUwJSk7XG4gIC0teWVsbG93OiBoc2woNjAsIDEwMCUsIDUwJSk7XG4gIC0tZ3JlZW46IGhzbCgxMjAsIDEwMCUsIDI1JSk7XG4gIC0tYmx1ZTogaHNsKDI0MCwgMTAwJSwgNTAlKTtcbiAgLS1wdXJwbGU6IGhzbCgzMDAsIDEwMCUsIDI1JSk7XG59Il0sInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 3600:
/*!************************************************************************************!*\
  !*** ./src/app/views/Module/views/Director/history-note/history-note.component.ts ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   HistoryNoteComponent: () => (/* binding */ HistoryNoteComponent)
/* harmony export */ });
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/forms */ 4456);
/* harmony import */ var _angular_material_form_field__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/material/form-field */ 4950);
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material/paginator */ 4624);
/* harmony import */ var _angular_material_select__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/material/select */ 5175);
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/table */ 7697);
/* harmony import */ var _angular_material_input__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @angular/material/input */ 5541);
/* harmony import */ var primeng_dialog__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! primeng/dialog */ 6280);
/* harmony import */ var primeng_selectbutton__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! primeng/selectbutton */ 9656);
/* harmony import */ var primeng_tooltip__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! primeng/tooltip */ 405);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/sort */ 2047);
/* harmony import */ var _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/material/progress-spinner */ 1134);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../services/data.service */ 1112);
/* harmony import */ var src_app_core_services_sidebar_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! src/app/core/services/sidebar.service */ 9964);
/* harmony import */ var src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/core/services/alerts.service */ 983);
/* harmony import */ var src_app_core_services_excel_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! src/app/core/services/excel.service */ 1563);






















const _c0 = ["input"];
const _c1 = a0 => ({
  "sidebar_active_content_acciones_tabla": a0
});
const _c2 = () => ["num"];
const _c3 = () => [20, 30, 40, 50];
const _c4 = () => ({
  width: "240px",
  left: "0vw"
});
function HistoryNoteComponent_Conditional_8_For_9_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const periodo_r4 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", periodo_r4);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](periodo_r4);
  }
}
function HistoryNoteComponent_Conditional_8_For_18_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const nivel_r5 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", nivel_r5);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](nivel_r5);
  }
}
function HistoryNoteComponent_Conditional_8_For_27_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const departamento_r6 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", departamento_r6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](departamento_r6);
  }
}
function HistoryNoteComponent_Conditional_8_For_36_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const materia_r7 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", materia_r7);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](materia_r7);
  }
}
function HistoryNoteComponent_Conditional_8_For_45_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const docente_r8 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", docente_r8);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](docente_r8);
  }
}
function HistoryNoteComponent_Conditional_8_For_54_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const estado_r9 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", estado_r9);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](estado_r9);
  }
}
function HistoryNoteComponent_Conditional_8_For_63_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const malla_r10 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", malla_r10);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](malla_r10);
  }
}
function HistoryNoteComponent_Conditional_8_For_72_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const genero_r11 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", genero_r11);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](genero_r11);
  }
}
function HistoryNoteComponent_Conditional_8_Template(rf, ctx) {
  if (rf & 1) {
    const _r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 8)(1, "div")(2, "label", 35);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](3, "Periodo");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](4, "div")(5, "select", 36);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_5_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedPeriod, $event) || (ctx_r2.selectedPeriod = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_5_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyPeriodFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](6, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](7, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](8, HistoryNoteComponent_Conditional_8_For_9_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](10, "div")(11, "label", 39);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](12, "Nivel");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](13, "div")(14, "select", 40);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_14_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedNivel, $event) || (ctx_r2.selectedNivel = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_14_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyNivelFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](15, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](16, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](17, HistoryNoteComponent_Conditional_8_For_18_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](19, "div")(20, "label", 41);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](21, "Departamento");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](22, "div")(23, "select", 42);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_23_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedDepartamento, $event) || (ctx_r2.selectedDepartamento = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_23_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyDepartamentoFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](24, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](25, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](26, HistoryNoteComponent_Conditional_8_For_27_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](28, "div")(29, "label", 43);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](30, "Materia");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](31, "div")(32, "select", 44);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_32_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedMateria, $event) || (ctx_r2.selectedMateria = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_32_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyMateriaFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](33, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](34, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](35, HistoryNoteComponent_Conditional_8_For_36_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](37, "div")(38, "label", 45);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](39, "Docente");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](40, "div")(41, "select", 46);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_41_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedDocente, $event) || (ctx_r2.selectedDocente = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_41_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyDocenteFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](42, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](43, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](44, HistoryNoteComponent_Conditional_8_For_45_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](46, "div")(47, "label", 47);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](48, "Estado matricula");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](49, "div")(50, "select", 48);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_50_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedEstado, $event) || (ctx_r2.selectedEstado = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_50_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyEstadoFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](51, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](52, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](53, HistoryNoteComponent_Conditional_8_For_54_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](55, "div")(56, "label", 49);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](57, "Malla");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](58, "div")(59, "select", 50);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_59_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedMalla, $event) || (ctx_r2.selectedMalla = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_59_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyMallaFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](60, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](61, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](62, HistoryNoteComponent_Conditional_8_For_63_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](64, "div")(65, "label", 51);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](66, "Genero");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](67, "div")(68, "select", 52);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Conditional_8_Template_select_ngModelChange_68_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx_r2.selectedGenero, $event) || (ctx_r2.selectedGenero = $event);
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Conditional_8_Template_select_change_68_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.applyGeneroFilter());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](69, "option", 37);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](70, "Todos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](71, HistoryNoteComponent_Conditional_8_For_72_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()()();
  }
  if (rf & 2) {
    const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](5);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedPeriod);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.periodos);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedNivel);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.niveles);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedDepartamento);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.departamentos);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedMateria);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.materias);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedDocente);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.docentes);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedEstado);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.estados);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedMalla);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.mallas);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx_r2.selectedGenero);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx_r2.generos);
  }
}
function HistoryNoteComponent_Conditional_12_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 12);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](1, "img", 53);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function HistoryNoteComponent_Conditional_13_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "i", 54);
  }
}
function HistoryNoteComponent_th_29_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "th", 55);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, " N\u00B0 ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function HistoryNoteComponent_td_30_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "td", 56);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const i_r12 = ctx.index;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
    const paginator_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵreference"](38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate1"](" ", paginator_r13.pageIndex * paginator_r13.pageSize + i_r12 + 1, " ");
  }
}
function HistoryNoteComponent_For_32_th_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "th", 59);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const column_r14 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵclassMapInterpolate1"]("", column_r14.split(".").join("-"), "-header");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](column_r14);
  }
}
function HistoryNoteComponent_For_32_td_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "td", 56);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const element_r15 = ctx.$implicit;
    const column_r14 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵclassMapInterpolate1"]("", column_r14.split(".").join("-"), "-cell");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate1"]("", element_r15[column_r14], " ");
  }
}
function HistoryNoteComponent_For_32_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerStart"](0, 27);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](1, HistoryNoteComponent_For_32_th_1_Template, 2, 4, "th", 57)(2, HistoryNoteComponent_For_32_td_2_Template, 2, 4, "td", 58);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerEnd"]();
  }
  if (rf & 2) {
    const column_r14 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matColumnDef", column_r14);
  }
}
function HistoryNoteComponent_tr_33_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "tr", 60);
  }
}
function HistoryNoteComponent_tr_34_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "tr", 61);
  }
}
function HistoryNoteComponent_Conditional_35_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "tr", 30);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, "No existen registros.");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function HistoryNoteComponent_For_50_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const periodo_r16 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", periodo_r16);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](periodo_r16);
  }
}
function HistoryNoteComponent_For_59_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const nivel_r17 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", nivel_r17);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](nivel_r17);
  }
}
function HistoryNoteComponent_For_68_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const departamento_r18 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", departamento_r18);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](departamento_r18);
  }
}
function HistoryNoteComponent_For_77_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const materia_r19 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", materia_r19);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](materia_r19);
  }
}
function HistoryNoteComponent_For_86_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const docente_r20 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", docente_r20);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](docente_r20);
  }
}
function HistoryNoteComponent_For_95_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const estado_r21 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", estado_r21);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](estado_r21);
  }
}
function HistoryNoteComponent_For_104_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const malla_r22 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", malla_r22);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](malla_r22);
  }
}
function HistoryNoteComponent_For_113_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "option", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const genero_r23 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("value", genero_r23);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](genero_r23);
  }
}
// import * as XLSX from 'xlsx';
class HistoryNoteComponent {
  constructor(dataService, sidebarService, alertService, excelService) {
    this.dataService = dataService;
    this.sidebarService = sidebarService;
    this.alertService = alertService;
    this.excelService = excelService;
    // Estado del sidebar
    this.sidebarHidden = false;
    // Dialog de filtros.
    this.visibleFilter = false;
    this.positionFilter = 'center';
    // Gif de carga
    this.charge_gif = false;
    // Estado de lista
    this.filtrosVisibles = false;
    this.displayedColumns = ['APELLIDO', 'NOMBRE', 'ID', 'CEDULA', 'A_CONOCIMIENTO', 'DEPARTAMENTO', 'CURSO', 'MATERIA', 'NRC', 'ESTADO', 'PROMEDIO', 'NOTA1', 'NOTA2', 'NOTA3', 'DOCENTE', 'NIVEL', 'PERIODO', 'GENERO'];
    this.periodos = [];
    this.niveles = [];
    this.departamentos = [];
    this.materias = [];
    this.docentes = [];
    this.estados = [];
    this.mallas = [];
    this.generos = [];
    this.selectedPeriod = '';
    this.selectedNivel = '';
    this.selectedDepartamento = '';
    this.selectedMateria = '';
    this.selectedDocente = '';
    this.selectedEstado = '';
    this.selectedMalla = '';
    this.selectedGenero = '';
    this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTableDataSource([]);
    // Función para seleccionar las columnas del filtro por buscador
    this.filterColumsText = (data, filterValue) => {
      return (data.NOMBRE || '').toLowerCase().includes(filterValue) || (data.APELLIDO || '').toLowerCase().includes(filterValue) || (data.CEDULA || '').toLowerCase().includes(filterValue) || (data.ID || '').toLowerCase().includes(filterValue);
    };
    this.onResize();
  }
  ngOnInit() {
    this.getNotasData();
    this.filterSelect();
    // Estado del sidebar
    this.getStatusSidebar();
  }
  ngOnDestroy() {
    // Desuscribirse del Subject al destruir el componente para evitar posibles fugas de memoria
    this.sidebarSubscription.unsubscribe();
  }
  ngAfterViewInit() {
    this.dataSource.sort = this.sort;
  }
  // =============================================================================
  // Mostrar y ocultar la lista (Telefono)
  // =============================================================================
  onResize(event) {
    this.screenWidth = window.innerWidth;
    if (this.screenWidth > 700) {
      this.filtrosVisibles = true; // Mostrar siempre los filtros si la pantalla es más grande a 700px
    } else {
      this.filtrosVisibles = false;
    }
  }
  switchListFilter() {
    if (this.screenWidth < 700) {
      this.filtrosVisibles = !this.filtrosVisibles;
    }
  }
  // =============================================================================
  // Obtener datos del servidor
  // =============================================================================
  // Obtener las notas
  getNotasData() {
    this.dataService.getNotasData().subscribe(response => {
      // console.log('Notas: ', response);
      this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTableDataSource(response.data);
      this.dataSource.sort = this.sort; // Aplicar sort en la cabezera
      this.dataSource.paginator = this.paginator;
    }, error => {
      console.error('Error al obtener datos de notas: ', error);
    });
  }
  // Lista de periodos
  getPeriodoList(filters) {
    this.dataService.getPeriodoList().subscribe(response => {
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(periodo => {
          // Verificar si el periodo está presente en los datos filtrados de la tabla
          return filters.some(filter => filter === periodo);
        });
      }
      // Asignar los valores al arreglo
      this.periodos = data.map(periodo => periodo.toString());
    }, error => {
      console.log('Error al obtener la lista de periodos: ', error);
    });
  }
  // Lista de niveles
  getNivelList(filters) {
    this.dataService.getNivelList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(nivel => {
          // Verificar si la niveles está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === nivel.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.niveles = data.map(nivel => nivel.toString());
    }, error => {
      console.log('Error al obtener la lista de niveles: ', error);
    });
  }
  // Lista de departamentos
  getDepartamentoList(filters) {
    this.dataService.getDepartamentosList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(departamento => {
          // Verificar si la departamentos está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === departamento.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.departamentos = data.map(departamento => departamento.toString());
    }, error => {
      console.log('Error al obtener la lista de departamentos: ', error);
    });
  }
  // Lista de materias
  getMateriaList(filters) {
    this.dataService.getMateriaList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(materia => {
          // Verificar si la materia está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === materia.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.materias = data.map(materia => materia.toString());
    }, error => {
      console.log('Error al obtener la lista de materias: ', error);
    });
  }
  // Lista de docentes
  getDocenteList(filters) {
    this.dataService.getDocenteList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(docente => {
          // Verificar si la docente está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === docente.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.docentes = data.map(docente => docente.toString());
    }, error => {
      console.log('Error al obtener la lista de docentes: ', error);
    });
  }
  // Lista de estados
  getEstadoList(filters) {
    this.dataService.getEstadoList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(estado => {
          // Verificar si la docente está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === estado.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.estados = data.map(estado => estado.toString());
    }, error => {
      console.log('Error al obtener la lista de estados: ', error);
    });
  }
  // Lista de mallas
  getMallaList(filters) {
    this.dataService.getMallaList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(malla => {
          // Verificar si la docente está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === malla.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.mallas = data.map(malla => malla.toString());
    }, error => {
      console.log('Error al obtener la lista de mallas: ', error);
    });
  }
  // Lista de mallas
  getGeneroList(filters) {
    this.dataService.getGeneroList().subscribe(response => {
      // console.log(response);
      // Extraer los valores de la propiedad data del objeto response
      let data = response.data;
      // Aplicar filtros si están presentes
      if (filters) {
        data = data.filter(genero => {
          // Verificar si la docente está presente en los datos filtrados de la tabla
          return filters.some(filter => filter.toLowerCase() === genero.toLowerCase());
        });
      }
      // Asignar los valores al arreglo
      this.generos = data.map(genero => genero.toString());
    }, error => {
      console.log('Error al obtener la lista de generos: ', error);
    });
  }
  // =============================================================================
  // FILTROS
  // =============================================================================
  filterSelect() {
    this.getPeriodoList();
    this.getNivelList();
    this.getDepartamentoList();
    this.getMateriaList();
    this.getDocenteList();
    this.getEstadoList();
    this.getMallaList();
    this.getGeneroList();
  }
  // Eliminar filtros
  deleteFilters() {
    // Limpia el input de búsqueda
    if (this.input) {
      this.input.nativeElement.value = '';
    }
    // Restablece los valores de los filtros a sus valores por defecto
    this.selectedPeriod = '';
    this.selectedNivel = '';
    this.selectedDepartamento = '';
    this.selectedMateria = '';
    this.selectedDocente = '';
    this.selectedEstado = '';
    this.selectedMalla = '';
    this.selectedGenero = '';
    // Limpia el filtro de la fuente de datos
    this.dataSource.filter = '';
    // Si hay paginador, regresa a la primera página
    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
    // Filtros
    this.filterSelect();
  }
  // Filtro general
  filterTable(seleccion) {
    const filterValue = document.getElementById('filtro_notas').value.trim().toLowerCase();
    // Configurar el filtroPredicate
    this.dataSource.filterPredicate = data => {
      // Periodo
      const dataPeriod = data.PERIODO.toString().toLowerCase();
      const filterPeriod = this.selectedPeriod.toLowerCase();
      // Nivel
      const dataNivel = data.NIVEL.toString().toLowerCase();
      const filterNivel = this.selectedNivel.toLowerCase();
      // Departamento
      const dataDepartamento = data.DEPARTAMENTO.toString().toLowerCase();
      const filterDepartamento = this.selectedDepartamento.toLowerCase();
      // Materia
      const dataMateria = data.MATERIA.toString().toLowerCase();
      const filterMateria = this.selectedMateria.toLowerCase();
      // Docente
      const dataDocente = data.DOCENTE.toString().toLowerCase();
      const filterDocente = this.selectedDocente.toLowerCase();
      // Estado
      const dataEstado = data.ESTADO.toString().toLowerCase();
      const filterEstado = this.selectedEstado.toLowerCase();
      // Malla
      const dataMalla = data.MALLA.toString().toLowerCase();
      const filterMalla = this.selectedMalla.toLowerCase();
      // Genero
      const dataGenero = data.GENERO.toString().toLowerCase();
      const filterGenero = this.selectedGenero.toLowerCase();
      // Verificar coincidencias
      return this.filterColumsText(data, filterValue) && dataPeriod.includes(filterPeriod) && dataNivel.includes(filterNivel) && dataDepartamento.includes(filterDepartamento) && dataMateria.includes(filterMateria) && dataDocente.includes(filterDocente) && dataEstado.includes(filterEstado) && dataMalla.includes(filterMalla) && dataGenero.includes(filterGenero);
    };
    // Aplicar el filtro a la fuente de datos
    this.dataSource.filter = 'filter';
    // Obtener filtros de periodo para pasarlo a getPeriodoList
    if (seleccion != 'periodo' || this.selectedPeriod == '') {
      const filtersPeriodo = this.dataSource.filteredData.map(data => data.PERIODO);
      this.getPeriodoList(filtersPeriodo);
    }
    // Obtener filtros de nivel para pasarlo a getNivelList
    if (seleccion != 'nivel' || this.selectedNivel == '') {
      const filtersNivel = this.dataSource.filteredData.map(data => data.NIVEL);
      this.getNivelList(filtersNivel);
    }
    // Obtener filtros de materia para pasarlo a getDepartamentoList
    if (seleccion != 'departamento' || this.selectedDepartamento == '') {
      const filtersDepartamento = this.dataSource.filteredData.map(data => data.DEPARTAMENTO);
      this.getDepartamentoList(filtersDepartamento);
    }
    // Obtener filtros de materia para pasarlo a getMateriaList
    if (seleccion != 'materia' || this.selectedMateria == '') {
      const filtersMateria = this.dataSource.filteredData.map(data => data.MATERIA);
      this.getMateriaList(filtersMateria);
    }
    // Obtener filtros de doncente para pasarlo a getDocenteList
    if (seleccion != 'docente' || this.selectedDocente == '') {
      const filtersDocente = this.dataSource.filteredData.map(data => data.DOCENTE);
      this.getDocenteList(filtersDocente);
    }
    // Obtener filtros de estado para pasarlo a getEstadoList
    if (seleccion != 'estado' || this.selectedEstado == '') {
      const filtersEstado = this.dataSource.filteredData.map(data => data.ESTADO);
      this.getEstadoList(filtersEstado);
    }
    // Obtener filtros de malla para pasarlo a getMallaList
    if (seleccion != 'malla' || this.selectedMalla == '') {
      const filtersMalla = this.dataSource.filteredData.map(data => data.MALLA);
      this.getMallaList(filtersMalla);
    }
    // Obtener filtros de genero para pasarlo a getGeneroList
    if (seleccion != 'genero' || this.selectedGenero == '') {
      const filtersGenero = this.dataSource.filteredData.map(data => data.GENERO);
      this.getGeneroList(filtersGenero);
    }
    // Opcionalmente, puedes agregar lógica adicional aquí, como paginación
    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }
  // Filtrar por buscador
  applyTextFilter() {
    const seleccion = 'buscador';
    this.filterTable(seleccion);
  }
  // Filtrar por periodo
  applyPeriodFilter() {
    const seleccion = 'periodo';
    this.filterTable(seleccion);
  }
  // Filtrar por nivel
  applyNivelFilter() {
    const seleccion = 'nivel';
    this.filterTable(seleccion);
  }
  // Filtrar por departamento
  applyDepartamentoFilter() {
    const seleccion = 'departamento';
    this.filterTable(seleccion);
  }
  // Filtrar por materia
  applyMateriaFilter() {
    const seleccion = 'materia';
    this.filterTable(seleccion);
  }
  // Filtrar por docente
  applyDocenteFilter() {
    const seleccion = 'docente';
    this.filterTable(seleccion);
  }
  // Filtrar por estado
  applyEstadoFilter() {
    const seleccion = 'estado';
    this.filterTable(seleccion);
  }
  // Filtrar por malla
  applyMallaFilter() {
    const seleccion = 'malla';
    this.filterTable(seleccion);
  }
  // Filtrar por genero
  applyGeneroFilter() {
    const seleccion = 'genero';
    this.filterTable(seleccion);
  }
  // =============================================================================
  // DIALOG
  // =============================================================================
  showDialogFilter(positionFilter) {
    this.positionFilter = positionFilter;
    this.visibleFilter = true;
  }
  //===================================================================
  // Boton copiar en el portapapeles
  //===================================================================
  // Obtiene los valores anidados de la respuesta cuando hay relacion entre tablas
  getValue(element, column) {
    // Divide la cadena basada en puntos para manejar propiedades anidadas
    const keys = column.split('.');
    let value = element;
    // Itera sobre las claves para acceder a la propiedad anidada
    keys.forEach(key => {
      value = value[key];
    });
    return value;
  }
  // Dar formato a los datos copiados
  formatDataForClipboard() {
    const dataString = this.dataSource.filteredData.map(row => {
      return this.displayedColumns.map(column => {
        const value = this.getValue(row, column);
        return typeof value === 'string' ? value : value.toString();
      }).join('\t'); // Separa cada campo con un tabulador
    }).join('\n'); // Separa cada fila con un salto de línea
    return dataString;
  }
  // Copiar los datos
  copyDataToClipboard() {
    const dataForClipboard = this.formatDataForClipboard();
    navigator.clipboard.writeText(dataForClipboard).then(() => {
      const title = 'Datos copiados correctamente!';
      const message = 'Los datos han sido copiados en el portapapeles.';
      this.alertService.toastMessage('success', title, message);
      console.log(message);
    }, err => {
      const title = 'Error al copiar!';
      const message = 'Hubo un error al copiar los datos en el portapapeles.';
      this.alertService.toastMessage('error', title, message);
      console.error(message, err);
    });
  }
  //===================================================================
  // Boton Exportar en excel
  //===================================================================
  // Exportar en excel
  exportExcel() {
    const filterValue = document.getElementById('filtro_notas').value.trim().toLowerCase();
    setTimeout(() => {
      const headerColumns = this.excelService.columnNotasStudents;
      const fileName = filterValue ? `Notas_Estudiantes_${filterValue}` : 'Notas_Estudiantes';
      // Posicion necesaria para los logos personalizado
      const leftITIN = 3;
      const leftLOGO = 13.5;
      this.excelService.exportAsExcelFile(this.dataSource.filteredData, headerColumns, fileName, leftITIN, leftLOGO).then(() => {
        const title = 'Exportación exitosa';
        const message = 'El archivo Excel ha sido creado y descargado con éxito.';
        this.alertService.toastMessage('success', title, message);
        this.charge_gif = false;
      }).catch(error => {
        const title = 'Error de Exportación';
        const message = 'Hubo un problema al crear el archivo Excel. Por favor, inténtelo de nuevo.';
        this.alertService.toastMessage('error', title, message);
        console.log(error);
        this.charge_gif = false;
      });
    }, 0);
  }
  // =============================================================================
  // Otros elementos
  // =============================================================================
  // Obtener el estado del sidebar
  getStatusSidebar() {
    // Suscribirse al Subject para recibir actualizaciones sobre el estado del sidebar
    this.sidebarSubscription = this.sidebarService.getSidebarHidden().subscribe(sidebarHidden => {
      this.sidebarHidden = sidebarHidden; // Actualizamos el valor de sidebarHidden
    });
  }
  static #_ = this.ɵfac = function HistoryNoteComponent_Factory(t) {
    return new (t || HistoryNoteComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](src_app_core_services_sidebar_service__WEBPACK_IMPORTED_MODULE_1__.SidebarService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_2__.AlertService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](src_app_core_services_excel_service__WEBPACK_IMPORTED_MODULE_3__.ExcelService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdefineComponent"]({
    type: HistoryNoteComponent,
    selectors: [["app-history-note"]],
    viewQuery: function HistoryNoteComponent_Query(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵviewQuery"](_angular_material_sort__WEBPACK_IMPORTED_MODULE_6__.MatSort, 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵviewQuery"](_c0, 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵviewQuery"](_angular_material_paginator__WEBPACK_IMPORTED_MODULE_7__.MatPaginator, 5);
      }
      if (rf & 2) {
        let _t;
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵloadQuery"]()) && (ctx.sort = _t.first);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵloadQuery"]()) && (ctx.input = _t.first);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵloadQuery"]()) && (ctx.paginator = _t.first);
      }
    },
    hostBindings: function HistoryNoteComponent_HostBindings(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("resize", function HistoryNoteComponent_resize_HostBindingHandler($event) {
          return ctx.onResize($event);
        }, false, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresolveWindow"]);
      }
    },
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵStandaloneFeature"]],
    decls: 114,
    vars: 27,
    consts: [["input", ""], ["paginator", ""], [1, "mat-elevation-z8", "contenedor_general"], [1, "contenedor_list_filtros"], [1, "contenedor_list", 3, "click"], [1, "text_list"], [1, "icon_list"], [1, "fa-solid", "fa-filter-list"], [1, "contenedor_filtros"], [1, "contenedor_acciones_tabla", 3, "ngClass"], [1, "contenedor_botones"], ["pTooltip", "Excel", "tooltipPosition", "top", 1, "button3", "efects_button", "btn_excel", 3, "click"], [1, "icon-charge"], ["pTooltip", "Copiar", "tooltipPosition", "top", 1, "button3", "efects_button", "btn_copy", 3, "click"], [1, "fa-solid", "fa-copy"], ["pTooltip", "Filtros", "tooltipPosition", "top", 1, "button3", "efects_button", "btn_filtro", 3, "click"], ["pTooltip", "Eliminar filtros", "tooltipPosition", "top", 1, "button3", "efects_button", "btn_delete_filter", 3, "click"], [1, "fa-sharp", "fa-solid", "fa-filter-circle-xmark"], [1, "contenedor_buscador"], ["id", "filtro_notas", "matInput", "", "placeholder", "Buscar por nombres, id y ced\u00FAla...", 1, "input", 3, "keyup"], [1, "bx", "bx-search-alt"], [1, "contenedor_tabla"], [1, "table-container", "mat-elevation-z8"], ["mat-table", "", "matSort", "", 3, "dataSource"], ["matColumnDef", "num"], ["mat-header-cell", "", 4, "matHeaderCellDef"], ["mat-cell", "", 4, "matCellDef"], [3, "matColumnDef"], ["mat-header-row", "", 4, "matHeaderRowDef"], ["mat-row", "", 4, "matRowDef", "matRowDefColumns"], [1, "noExisteRegistro"], [1, "paginator-container"], ["showFirstLastButtons", "", 3, "pageSizeOptions"], ["header", "Filtros", 3, "visibleChange", "visible", "position", "resizable"], [1, "contenedor_filtro"], ["for", "selectPeriodo"], ["matNativeControl", "", "id", "selectPeriodo", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["value", ""], [3, "value"], ["for", "selectNivel"], ["matNativeControl", "", "id", "selectNivel", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectDepartamento"], ["matNativeControl", "", "id", "selectDepartamento", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectMateria"], ["matNativeControl", "", "id", "selectMateria", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectDocente"], ["matNativeControl", "", "id", "selectDocente", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectEstado"], ["matNativeControl", "", "id", "selectEstado", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectMalla"], ["matNativeControl", "", "id", "selectMalla", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["for", "selectGenero"], ["matNativeControl", "", "id", "selectGenero", 1, "input", "input_select", 3, "ngModelChange", "change", "ngModel"], ["src", "assets/gif/load2.gif"], [1, "fa-solid", "fa-file-excel"], ["mat-header-cell", ""], ["mat-cell", ""], ["mat-header-cell", "", "mat-sort-header", "", 3, "class", 4, "matHeaderCellDef"], ["mat-cell", "", 3, "class", 4, "matCellDef"], ["mat-header-cell", "", "mat-sort-header", ""], ["mat-header-row", ""], ["mat-row", ""]],
    template: function HistoryNoteComponent_Template(rf, ctx) {
      if (rf & 1) {
        const _r1 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 2)(1, "div", 3)(2, "div", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function HistoryNoteComponent_Template_div_click_2_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.switchListFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](3, "div", 5)(4, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](5, "Filtros de tabla");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](6, "div", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](7, "i", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](8, HistoryNoteComponent_Conditional_8_Template, 73, 8, "div", 8);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](9, "div", 9)(10, "div", 10)(11, "button", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function HistoryNoteComponent_Template_button_click_11_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          ctx.charge_gif = true;
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.exportExcel());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](12, HistoryNoteComponent_Conditional_12_Template, 2, 0, "div", 12)(13, HistoryNoteComponent_Conditional_13_Template, 1, 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](14, "button", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function HistoryNoteComponent_Template_button_click_14_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.copyDataToClipboard());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](15, "i", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](16, "button", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function HistoryNoteComponent_Template_button_click_16_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.showDialogFilter("left"));
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](17, "i", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](18, "button", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function HistoryNoteComponent_Template_button_click_18_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.deleteFilters());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](19, "i", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](20, "div", 18)(21, "div")(22, "input", 19, 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("keyup", function HistoryNoteComponent_Template_input_keyup_22_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyTextFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](24, "i", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](25, "div", 21)(26, "div", 22)(27, "table", 23);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerStart"](28, 24);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](29, HistoryNoteComponent_th_29_Template, 2, 0, "th", 25)(30, HistoryNoteComponent_td_30_Template, 2, 1, "td", 26);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](31, HistoryNoteComponent_For_32_Template, 3, 1, "ng-container", 27, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](33, HistoryNoteComponent_tr_33_Template, 1, 0, "tr", 28)(34, HistoryNoteComponent_tr_34_Template, 1, 0, "tr", 29);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](35, HistoryNoteComponent_Conditional_35_Template, 2, 0, "tr", 30);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](36, "div", 31);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](37, "mat-paginator", 32, 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](39, "section")(40, "p-dialog", 33);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("visibleChange", function HistoryNoteComponent_Template_p_dialog_visibleChange_40_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.visibleFilter, $event) || (ctx.visibleFilter = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](41, "div", 34)(42, "div")(43, "label", 35);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](44, "Periodo");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](45, "div")(46, "select", 36);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_46_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedPeriod, $event) || (ctx.selectedPeriod = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_46_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyPeriodFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](47, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](48, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](49, HistoryNoteComponent_For_50_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](51, "div")(52, "label", 39);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](53, "Nivel");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](54, "div")(55, "select", 40);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_55_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedNivel, $event) || (ctx.selectedNivel = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_55_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyNivelFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](56, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](57, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](58, HistoryNoteComponent_For_59_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](60, "div")(61, "label", 41);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](62, "Departamento");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](63, "div")(64, "select", 42);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_64_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedDepartamento, $event) || (ctx.selectedDepartamento = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_64_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyDepartamentoFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](65, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](66, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](67, HistoryNoteComponent_For_68_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](69, "div")(70, "label", 43);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](71, "Materia");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](72, "div")(73, "select", 44);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_73_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedMateria, $event) || (ctx.selectedMateria = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_73_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyMateriaFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](74, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](75, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](76, HistoryNoteComponent_For_77_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](78, "div")(79, "label", 45);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](80, "Docente");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](81, "div")(82, "select", 46);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_82_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedDocente, $event) || (ctx.selectedDocente = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_82_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyDocenteFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](83, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](84, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](85, HistoryNoteComponent_For_86_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](87, "div")(88, "label", 47);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](89, "Estado matricula");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](90, "div")(91, "select", 48);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_91_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedEstado, $event) || (ctx.selectedEstado = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_91_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyEstadoFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](92, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](93, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](94, HistoryNoteComponent_For_95_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](96, "div")(97, "label", 49);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](98, "Malla");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](99, "div")(100, "select", 50);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_100_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedMalla, $event) || (ctx.selectedMalla = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_100_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyMallaFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](101, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](102, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](103, HistoryNoteComponent_For_104_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](105, "div")(106, "label", 51);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](107, "Genero");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](108, "div")(109, "select", 52);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayListener"]("ngModelChange", function HistoryNoteComponent_Template_select_ngModelChange_109_listener($event) {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayBindingSet"](ctx.selectedGenero, $event) || (ctx.selectedGenero = $event);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"]($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function HistoryNoteComponent_Template_select_change_109_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.applyGeneroFilter());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](110, "option", 37);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](111, "Todos");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](112, HistoryNoteComponent_For_113_Template, 2, 2, "option", 38, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()()()()()();
      }
      if (rf & 2) {
        const paginator_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵreference"](38);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](8);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](8, ctx.filtrosVisibles ? 8 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](21, _c1, !ctx.sidebarHidden));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](12, ctx.charge_gif ? 12 : 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](15);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("dataSource", ctx.dataSource);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.displayedColumns);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matHeaderRowDef", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](23, _c2).concat(ctx.displayedColumns));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matRowDefColumns", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](24, _c2).concat(ctx.displayedColumns));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](35, paginator_r13 && paginator_r13.length === 0 ? 35 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("pageSizeOptions", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](25, _c3));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵstyleMap"](_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](26, _c4));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("visible", ctx.visibleFilter);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("position", ctx.positionFilter)("resizable", false);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedPeriod);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.periodos);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedNivel);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.niveles);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedDepartamento);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.departamentos);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedMateria);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.materias);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedDocente);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.docentes);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedEstado);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.estados);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedMalla);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.mallas);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtwoWayProperty"]("ngModel", ctx.selectedGenero);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.generos);
      }
    },
    dependencies: [_angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_8__.MatProgressSpinnerModule, _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__.MatSort, _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__.MatSortModule, _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__.MatSortHeader, _angular_forms__WEBPACK_IMPORTED_MODULE_9__.FormsModule, _angular_forms__WEBPACK_IMPORTED_MODULE_9__.NgSelectOption, _angular_forms__WEBPACK_IMPORTED_MODULE_9__["ɵNgSelectMultipleOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_9__.SelectControlValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_9__.NgControlStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_9__.NgModel, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTable, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatColumnDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderCellDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderCell, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatCellDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatCell, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderRowDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderRow, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatRowDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatRow, _angular_material_paginator__WEBPACK_IMPORTED_MODULE_7__.MatPaginator, _angular_material_form_field__WEBPACK_IMPORTED_MODULE_10__.MatFormFieldModule, _angular_material_select__WEBPACK_IMPORTED_MODULE_11__.MatSelectModule, _angular_material_input__WEBPACK_IMPORTED_MODULE_12__.MatInputModule, _angular_material_input__WEBPACK_IMPORTED_MODULE_12__.MatInput, primeng_dialog__WEBPACK_IMPORTED_MODULE_13__.DialogModule, primeng_dialog__WEBPACK_IMPORTED_MODULE_13__.Dialog, primeng_selectbutton__WEBPACK_IMPORTED_MODULE_14__.SelectButtonModule, primeng_tooltip__WEBPACK_IMPORTED_MODULE_15__.TooltipModule, primeng_tooltip__WEBPACK_IMPORTED_MODULE_15__.Tooltip, _angular_common__WEBPACK_IMPORTED_MODULE_16__.NgClass],
    styles: [".mat-ripple[_ngcontent-%COMP%]{overflow:hidden;position:relative}.mat-ripple[_ngcontent-%COMP%]:not(:empty){transform:translateZ(0)}.mat-ripple.mat-ripple-unbounded[_ngcontent-%COMP%]{overflow:visible}.mat-ripple-element[_ngcontent-%COMP%]{position:absolute;border-radius:50%;pointer-events:none;transition:opacity,transform 0ms cubic-bezier(0, 0, 0.2, 1);transform:scale3d(0, 0, 0);background-color:var(--mat-ripple-color, rgba(0, 0, 0, 0.1))}.cdk-high-contrast-active[_ngcontent-%COMP%]   .mat-ripple-element[_ngcontent-%COMP%]{display:none}.cdk-visually-hidden[_ngcontent-%COMP%]{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;white-space:nowrap;outline:0;-webkit-appearance:none;-moz-appearance:none;left:0}[dir=rtl][_ngcontent-%COMP%]   .cdk-visually-hidden[_ngcontent-%COMP%]{left:auto;right:0}.cdk-overlay-container[_ngcontent-%COMP%], .cdk-global-overlay-wrapper[_ngcontent-%COMP%]{pointer-events:none;top:0;left:0;height:100%;width:100%}.cdk-overlay-container[_ngcontent-%COMP%]{position:fixed;z-index:1000}.cdk-overlay-container[_ngcontent-%COMP%]:empty{display:none}.cdk-global-overlay-wrapper[_ngcontent-%COMP%]{display:flex;position:absolute;z-index:1000}.cdk-overlay-pane[_ngcontent-%COMP%]{position:absolute;pointer-events:auto;box-sizing:border-box;z-index:1000;display:flex;max-width:100%;max-height:100%}.cdk-overlay-backdrop[_ngcontent-%COMP%]{position:absolute;top:0;bottom:0;left:0;right:0;z-index:1000;pointer-events:auto;-webkit-tap-highlight-color:rgba(0,0,0,0);transition:opacity 400ms cubic-bezier(0.25, 0.8, 0.25, 1);opacity:0}.cdk-overlay-backdrop.cdk-overlay-backdrop-showing[_ngcontent-%COMP%]{opacity:1}.cdk-high-contrast-active[_ngcontent-%COMP%]   .cdk-overlay-backdrop.cdk-overlay-backdrop-showing[_ngcontent-%COMP%]{opacity:.6}.cdk-overlay-dark-backdrop[_ngcontent-%COMP%]{background:rgba(0,0,0,.32)}.cdk-overlay-transparent-backdrop[_ngcontent-%COMP%]{transition:visibility 1ms linear,opacity 1ms linear;visibility:hidden;opacity:1}.cdk-overlay-transparent-backdrop.cdk-overlay-backdrop-showing[_ngcontent-%COMP%]{opacity:0;visibility:visible}.cdk-overlay-backdrop-noop-animation[_ngcontent-%COMP%]{transition:none}.cdk-overlay-connected-position-bounding-box[_ngcontent-%COMP%]{position:absolute;z-index:1000;display:flex;flex-direction:column;min-width:1px;min-height:1px}.cdk-global-scrollblock[_ngcontent-%COMP%]{position:fixed;width:100%;overflow-y:scroll}textarea.cdk-textarea-autosize[_ngcontent-%COMP%]{resize:none}textarea.cdk-textarea-autosize-measuring[_ngcontent-%COMP%]{padding:2px 0 !important;box-sizing:content-box !important;height:auto !important;overflow:hidden !important}textarea.cdk-textarea-autosize-measuring-firefox[_ngcontent-%COMP%]{padding:2px 0 !important;box-sizing:content-box !important;height:0 !important}@keyframes _ngcontent-%COMP%_cdk-text-field-autofill-start{\n}@keyframes _ngcontent-%COMP%_cdk-text-field-autofill-end{\n}.cdk-text-field-autofill-monitored[_ngcontent-%COMP%]:-webkit-autofill{animation:_ngcontent-%COMP%_cdk-text-field-autofill-start 0s 1ms}.cdk-text-field-autofill-monitored[_ngcontent-%COMP%]:not(:-webkit-autofill){animation:_ngcontent-%COMP%_cdk-text-field-autofill-end 0s 1ms}.mat-focus-indicator[_ngcontent-%COMP%]{position:relative}.mat-focus-indicator[_ngcontent-%COMP%]::before{top:0;left:0;right:0;bottom:0;position:absolute;box-sizing:border-box;pointer-events:none;display:var(--mat-focus-indicator-display, none);border:var(--mat-focus-indicator-border-width, 3px) var(--mat-focus-indicator-border-style, solid) var(--mat-focus-indicator-border-color, transparent);border-radius:var(--mat-focus-indicator-border-radius, 4px)}.mat-focus-indicator[_ngcontent-%COMP%]:focus::before{content:\"\"}.cdk-high-contrast-active[_ngcontent-%COMP%]{--mat-focus-indicator-display: block}.mat-mdc-focus-indicator[_ngcontent-%COMP%]{position:relative}.mat-mdc-focus-indicator[_ngcontent-%COMP%]::before{top:0;left:0;right:0;bottom:0;position:absolute;box-sizing:border-box;pointer-events:none;display:var(--mat-mdc-focus-indicator-display, none);border:var(--mat-mdc-focus-indicator-border-width, 3px) var(--mat-mdc-focus-indicator-border-style, solid) var(--mat-mdc-focus-indicator-border-color, transparent);border-radius:var(--mat-mdc-focus-indicator-border-radius, 4px)}.mat-mdc-focus-indicator[_ngcontent-%COMP%]:focus::before{content:\"\"}.cdk-high-contrast-active[_ngcontent-%COMP%]{--mat-mdc-focus-indicator-display: block}.mat-app-background[_ngcontent-%COMP%]{background-color:var(--mat-app-background-color, transparent);color:var(--mat-app-text-color, inherit)}html[_ngcontent-%COMP%]{--mat-ripple-color:rgba(0, 0, 0, 0.1)}html[_ngcontent-%COMP%]{--mat-option-selected-state-label-text-color:#3f51b5;--mat-option-label-text-color:rgba(0, 0, 0, 0.87);--mat-option-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-selected-state-layer-color:rgba(0, 0, 0, 0.04)}.mat-accent[_ngcontent-%COMP%]{--mat-option-selected-state-label-text-color:#ff4081;--mat-option-label-text-color:rgba(0, 0, 0, 0.87);--mat-option-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-selected-state-layer-color:rgba(0, 0, 0, 0.04)}.mat-warn[_ngcontent-%COMP%]{--mat-option-selected-state-label-text-color:#f44336;--mat-option-label-text-color:rgba(0, 0, 0, 0.87);--mat-option-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-option-selected-state-layer-color:rgba(0, 0, 0, 0.04)}html[_ngcontent-%COMP%]{--mat-optgroup-label-text-color:rgba(0, 0, 0, 0.87)}.mat-primary[_ngcontent-%COMP%]{--mat-full-pseudo-checkbox-selected-icon-color:#3f51b5;--mat-full-pseudo-checkbox-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mat-full-pseudo-checkbox-disabled-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-disabled-unselected-icon-color:#b0b0b0;--mat-full-pseudo-checkbox-disabled-selected-icon-color:#b0b0b0;--mat-minimal-pseudo-checkbox-selected-checkmark-color:#3f51b5;--mat-minimal-pseudo-checkbox-disabled-selected-checkmark-color:#b0b0b0}html[_ngcontent-%COMP%]{--mat-full-pseudo-checkbox-selected-icon-color:#ff4081;--mat-full-pseudo-checkbox-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mat-full-pseudo-checkbox-disabled-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-disabled-unselected-icon-color:#b0b0b0;--mat-full-pseudo-checkbox-disabled-selected-icon-color:#b0b0b0;--mat-minimal-pseudo-checkbox-selected-checkmark-color:#ff4081;--mat-minimal-pseudo-checkbox-disabled-selected-checkmark-color:#b0b0b0}.mat-accent[_ngcontent-%COMP%]{--mat-full-pseudo-checkbox-selected-icon-color:#ff4081;--mat-full-pseudo-checkbox-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mat-full-pseudo-checkbox-disabled-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-disabled-unselected-icon-color:#b0b0b0;--mat-full-pseudo-checkbox-disabled-selected-icon-color:#b0b0b0;--mat-minimal-pseudo-checkbox-selected-checkmark-color:#ff4081;--mat-minimal-pseudo-checkbox-disabled-selected-checkmark-color:#b0b0b0}.mat-warn[_ngcontent-%COMP%]{--mat-full-pseudo-checkbox-selected-icon-color:#f44336;--mat-full-pseudo-checkbox-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mat-full-pseudo-checkbox-disabled-selected-checkmark-color:#fafafa;--mat-full-pseudo-checkbox-disabled-unselected-icon-color:#b0b0b0;--mat-full-pseudo-checkbox-disabled-selected-icon-color:#b0b0b0;--mat-minimal-pseudo-checkbox-selected-checkmark-color:#f44336;--mat-minimal-pseudo-checkbox-disabled-selected-checkmark-color:#b0b0b0}html[_ngcontent-%COMP%]{--mat-app-background-color:#fafafa;--mat-app-text-color:rgba(0, 0, 0, 0.87)}.mat-elevation-z0[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z0[_ngcontent-%COMP%]{box-shadow:0px 0px 0px 0px rgba(0, 0, 0, 0.2), 0px 0px 0px 0px rgba(0, 0, 0, 0.14), 0px 0px 0px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z1[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z1[_ngcontent-%COMP%]{box-shadow:0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z2[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z2[_ngcontent-%COMP%]{box-shadow:0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z3[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z3[_ngcontent-%COMP%]{box-shadow:0px 3px 3px -2px rgba(0, 0, 0, 0.2), 0px 3px 4px 0px rgba(0, 0, 0, 0.14), 0px 1px 8px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z4[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z4[_ngcontent-%COMP%]{box-shadow:0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z5[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z5[_ngcontent-%COMP%]{box-shadow:0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 5px 8px 0px rgba(0, 0, 0, 0.14), 0px 1px 14px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z6[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z6[_ngcontent-%COMP%]{box-shadow:0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12)}.mat-elevation-z7[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z7[_ngcontent-%COMP%]{box-shadow:0px 4px 5px -2px rgba(0, 0, 0, 0.2), 0px 7px 10px 1px rgba(0, 0, 0, 0.14), 0px 2px 16px 1px rgba(0, 0, 0, 0.12)}.mat-elevation-z8[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z8[_ngcontent-%COMP%]{box-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12)}.mat-elevation-z9[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z9[_ngcontent-%COMP%]{box-shadow:0px 5px 6px -3px rgba(0, 0, 0, 0.2), 0px 9px 12px 1px rgba(0, 0, 0, 0.14), 0px 3px 16px 2px rgba(0, 0, 0, 0.12)}.mat-elevation-z10[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z10[_ngcontent-%COMP%]{box-shadow:0px 6px 6px -3px rgba(0, 0, 0, 0.2), 0px 10px 14px 1px rgba(0, 0, 0, 0.14), 0px 4px 18px 3px rgba(0, 0, 0, 0.12)}.mat-elevation-z11[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z11[_ngcontent-%COMP%]{box-shadow:0px 6px 7px -4px rgba(0, 0, 0, 0.2), 0px 11px 15px 1px rgba(0, 0, 0, 0.14), 0px 4px 20px 3px rgba(0, 0, 0, 0.12)}.mat-elevation-z12[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z12[_ngcontent-%COMP%]{box-shadow:0px 7px 8px -4px rgba(0, 0, 0, 0.2), 0px 12px 17px 2px rgba(0, 0, 0, 0.14), 0px 5px 22px 4px rgba(0, 0, 0, 0.12)}.mat-elevation-z13[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z13[_ngcontent-%COMP%]{box-shadow:0px 7px 8px -4px rgba(0, 0, 0, 0.2), 0px 13px 19px 2px rgba(0, 0, 0, 0.14), 0px 5px 24px 4px rgba(0, 0, 0, 0.12)}.mat-elevation-z14[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z14[_ngcontent-%COMP%]{box-shadow:0px 7px 9px -4px rgba(0, 0, 0, 0.2), 0px 14px 21px 2px rgba(0, 0, 0, 0.14), 0px 5px 26px 4px rgba(0, 0, 0, 0.12)}.mat-elevation-z15[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z15[_ngcontent-%COMP%]{box-shadow:0px 8px 9px -5px rgba(0, 0, 0, 0.2), 0px 15px 22px 2px rgba(0, 0, 0, 0.14), 0px 6px 28px 5px rgba(0, 0, 0, 0.12)}.mat-elevation-z16[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z16[_ngcontent-%COMP%]{box-shadow:0px 8px 10px -5px rgba(0, 0, 0, 0.2), 0px 16px 24px 2px rgba(0, 0, 0, 0.14), 0px 6px 30px 5px rgba(0, 0, 0, 0.12)}.mat-elevation-z17[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z17[_ngcontent-%COMP%]{box-shadow:0px 8px 11px -5px rgba(0, 0, 0, 0.2), 0px 17px 26px 2px rgba(0, 0, 0, 0.14), 0px 6px 32px 5px rgba(0, 0, 0, 0.12)}.mat-elevation-z18[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z18[_ngcontent-%COMP%]{box-shadow:0px 9px 11px -5px rgba(0, 0, 0, 0.2), 0px 18px 28px 2px rgba(0, 0, 0, 0.14), 0px 7px 34px 6px rgba(0, 0, 0, 0.12)}.mat-elevation-z19[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z19[_ngcontent-%COMP%]{box-shadow:0px 9px 12px -6px rgba(0, 0, 0, 0.2), 0px 19px 29px 2px rgba(0, 0, 0, 0.14), 0px 7px 36px 6px rgba(0, 0, 0, 0.12)}.mat-elevation-z20[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z20[_ngcontent-%COMP%]{box-shadow:0px 10px 13px -6px rgba(0, 0, 0, 0.2), 0px 20px 31px 3px rgba(0, 0, 0, 0.14), 0px 8px 38px 7px rgba(0, 0, 0, 0.12)}.mat-elevation-z21[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z21[_ngcontent-%COMP%]{box-shadow:0px 10px 13px -6px rgba(0, 0, 0, 0.2), 0px 21px 33px 3px rgba(0, 0, 0, 0.14), 0px 8px 40px 7px rgba(0, 0, 0, 0.12)}.mat-elevation-z22[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z22[_ngcontent-%COMP%]{box-shadow:0px 10px 14px -6px rgba(0, 0, 0, 0.2), 0px 22px 35px 3px rgba(0, 0, 0, 0.14), 0px 8px 42px 7px rgba(0, 0, 0, 0.12)}.mat-elevation-z23[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z23[_ngcontent-%COMP%]{box-shadow:0px 11px 14px -7px rgba(0, 0, 0, 0.2), 0px 23px 36px 3px rgba(0, 0, 0, 0.14), 0px 9px 44px 8px rgba(0, 0, 0, 0.12)}.mat-elevation-z24[_ngcontent-%COMP%], .mat-mdc-elevation-specific.mat-elevation-z24[_ngcontent-%COMP%]{box-shadow:0px 11px 15px -7px rgba(0, 0, 0, 0.2), 0px 24px 38px 3px rgba(0, 0, 0, 0.14), 0px 9px 46px 8px rgba(0, 0, 0, 0.12)}.mat-theme-loaded-marker[_ngcontent-%COMP%]{display:none}html[_ngcontent-%COMP%]{--mat-option-label-text-font:Roboto, sans-serif;--mat-option-label-text-line-height:24px;--mat-option-label-text-size:16px;--mat-option-label-text-tracking:0.03125em;--mat-option-label-text-weight:400}html[_ngcontent-%COMP%]{--mat-optgroup-label-text-font:Roboto, sans-serif;--mat-optgroup-label-text-line-height:24px;--mat-optgroup-label-text-size:16px;--mat-optgroup-label-text-tracking:0.03125em;--mat-optgroup-label-text-weight:400}html[_ngcontent-%COMP%]{--mdc-elevated-card-container-shape:4px;--mdc-outlined-card-container-shape:4px;--mdc-outlined-card-outline-width:1px}html[_ngcontent-%COMP%]{--mdc-elevated-card-container-color:white;--mdc-elevated-card-container-elevation:0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);--mdc-outlined-card-container-color:white;--mdc-outlined-card-outline-color:rgba(0, 0, 0, 0.12);--mdc-outlined-card-container-elevation:0px 0px 0px 0px rgba(0, 0, 0, 0.2), 0px 0px 0px 0px rgba(0, 0, 0, 0.14), 0px 0px 0px 0px rgba(0, 0, 0, 0.12);--mat-card-subtitle-text-color:rgba(0, 0, 0, 0.54)}html[_ngcontent-%COMP%]{--mat-card-title-text-font:Roboto, sans-serif;--mat-card-title-text-line-height:32px;--mat-card-title-text-size:20px;--mat-card-title-text-tracking:0.0125em;--mat-card-title-text-weight:500;--mat-card-subtitle-text-font:Roboto, sans-serif;--mat-card-subtitle-text-line-height:22px;--mat-card-subtitle-text-size:14px;--mat-card-subtitle-text-tracking:0.0071428571em;--mat-card-subtitle-text-weight:500}html[_ngcontent-%COMP%]{--mdc-linear-progress-active-indicator-height:4px;--mdc-linear-progress-track-height:4px;--mdc-linear-progress-track-shape:0}.mat-mdc-progress-bar[_ngcontent-%COMP%]{--mdc-linear-progress-active-indicator-color:#3f51b5;--mdc-linear-progress-track-color:rgba(63, 81, 181, 0.25)}.mat-mdc-progress-bar.mat-accent[_ngcontent-%COMP%]{--mdc-linear-progress-active-indicator-color:#ff4081;--mdc-linear-progress-track-color:rgba(255, 64, 129, 0.25)}.mat-mdc-progress-bar.mat-warn[_ngcontent-%COMP%]{--mdc-linear-progress-active-indicator-color:#f44336;--mdc-linear-progress-track-color:rgba(244, 67, 54, 0.25)}html[_ngcontent-%COMP%]{--mdc-plain-tooltip-container-shape:4px;--mdc-plain-tooltip-supporting-text-line-height:16px}html[_ngcontent-%COMP%]{--mdc-plain-tooltip-container-color:#616161;--mdc-plain-tooltip-supporting-text-color:#fff}html[_ngcontent-%COMP%]{--mdc-plain-tooltip-supporting-text-font:Roboto, sans-serif;--mdc-plain-tooltip-supporting-text-size:12px;--mdc-plain-tooltip-supporting-text-weight:400;--mdc-plain-tooltip-supporting-text-tracking:0.0333333333em}html[_ngcontent-%COMP%]{--mdc-filled-text-field-active-indicator-height:1px;--mdc-filled-text-field-focus-active-indicator-height:2px;--mdc-filled-text-field-container-shape:4px;--mdc-outlined-text-field-outline-width:1px;--mdc-outlined-text-field-focus-outline-width:2px;--mdc-outlined-text-field-container-shape:4px}html[_ngcontent-%COMP%]{--mdc-filled-text-field-caret-color:#3f51b5;--mdc-filled-text-field-focus-active-indicator-color:#3f51b5;--mdc-filled-text-field-focus-label-text-color:rgba(63, 81, 181, 0.87);--mdc-filled-text-field-container-color:whitesmoke;--mdc-filled-text-field-disabled-container-color:#fafafa;--mdc-filled-text-field-label-text-color:rgba(0, 0, 0, 0.6);--mdc-filled-text-field-hover-label-text-color:rgba(0, 0, 0, 0.6);--mdc-filled-text-field-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mdc-filled-text-field-input-text-color:rgba(0, 0, 0, 0.87);--mdc-filled-text-field-disabled-input-text-color:rgba(0, 0, 0, 0.38);--mdc-filled-text-field-input-text-placeholder-color:rgba(0, 0, 0, 0.6);--mdc-filled-text-field-error-hover-label-text-color:#f44336;--mdc-filled-text-field-error-focus-label-text-color:#f44336;--mdc-filled-text-field-error-label-text-color:#f44336;--mdc-filled-text-field-error-caret-color:#f44336;--mdc-filled-text-field-active-indicator-color:rgba(0, 0, 0, 0.42);--mdc-filled-text-field-disabled-active-indicator-color:rgba(0, 0, 0, 0.06);--mdc-filled-text-field-hover-active-indicator-color:rgba(0, 0, 0, 0.87);--mdc-filled-text-field-error-active-indicator-color:#f44336;--mdc-filled-text-field-error-focus-active-indicator-color:#f44336;--mdc-filled-text-field-error-hover-active-indicator-color:#f44336;--mdc-outlined-text-field-caret-color:#3f51b5;--mdc-outlined-text-field-focus-outline-color:#3f51b5;--mdc-outlined-text-field-focus-label-text-color:rgba(63, 81, 181, 0.87);--mdc-outlined-text-field-label-text-color:rgba(0, 0, 0, 0.6);--mdc-outlined-text-field-hover-label-text-color:rgba(0, 0, 0, 0.6);--mdc-outlined-text-field-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mdc-outlined-text-field-input-text-color:rgba(0, 0, 0, 0.87);--mdc-outlined-text-field-disabled-input-text-color:rgba(0, 0, 0, 0.38);--mdc-outlined-text-field-input-text-placeholder-color:rgba(0, 0, 0, 0.6);--mdc-outlined-text-field-error-caret-color:#f44336;--mdc-outlined-text-field-error-focus-label-text-color:#f44336;--mdc-outlined-text-field-error-label-text-color:#f44336;--mdc-outlined-text-field-error-hover-label-text-color:#f44336;--mdc-outlined-text-field-outline-color:rgba(0, 0, 0, 0.38);--mdc-outlined-text-field-disabled-outline-color:rgba(0, 0, 0, 0.06);--mdc-outlined-text-field-hover-outline-color:rgba(0, 0, 0, 0.87);--mdc-outlined-text-field-error-focus-outline-color:#f44336;--mdc-outlined-text-field-error-hover-outline-color:#f44336;--mdc-outlined-text-field-error-outline-color:#f44336;--mat-form-field-focus-select-arrow-color:rgba(63, 81, 181, 0.87);--mat-form-field-disabled-input-text-placeholder-color:rgba(0, 0, 0, 0.38);--mat-form-field-state-layer-color:rgba(0, 0, 0, 0.87);--mat-form-field-error-text-color:#f44336;--mat-form-field-select-option-text-color:inherit;--mat-form-field-select-disabled-option-text-color:GrayText;--mat-form-field-leading-icon-color:unset;--mat-form-field-disabled-leading-icon-color:unset;--mat-form-field-trailing-icon-color:unset;--mat-form-field-disabled-trailing-icon-color:unset;--mat-form-field-error-focus-trailing-icon-color:unset;--mat-form-field-error-hover-trailing-icon-color:unset;--mat-form-field-error-trailing-icon-color:unset;--mat-form-field-enabled-select-arrow-color:rgba(0, 0, 0, 0.54);--mat-form-field-disabled-select-arrow-color:rgba(0, 0, 0, 0.38);--mat-form-field-hover-state-layer-opacity:0.04;--mat-form-field-focus-state-layer-opacity:0.08}.mat-mdc-form-field.mat-accent[_ngcontent-%COMP%]{--mdc-filled-text-field-caret-color:#ff4081;--mdc-filled-text-field-focus-active-indicator-color:#ff4081;--mdc-filled-text-field-focus-label-text-color:rgba(255, 64, 129, 0.87);--mdc-outlined-text-field-caret-color:#ff4081;--mdc-outlined-text-field-focus-outline-color:#ff4081;--mdc-outlined-text-field-focus-label-text-color:rgba(255, 64, 129, 0.87);--mat-form-field-focus-select-arrow-color:rgba(255, 64, 129, 0.87)}.mat-mdc-form-field.mat-warn[_ngcontent-%COMP%]{--mdc-filled-text-field-caret-color:#f44336;--mdc-filled-text-field-focus-active-indicator-color:#f44336;--mdc-filled-text-field-focus-label-text-color:rgba(244, 67, 54, 0.87);--mdc-outlined-text-field-caret-color:#f44336;--mdc-outlined-text-field-focus-outline-color:#f44336;--mdc-outlined-text-field-focus-label-text-color:rgba(244, 67, 54, 0.87);--mat-form-field-focus-select-arrow-color:rgba(244, 67, 54, 0.87)}html[_ngcontent-%COMP%]{--mat-form-field-container-height:56px;--mat-form-field-filled-label-display:block;--mat-form-field-container-vertical-padding:16px;--mat-form-field-filled-with-label-container-padding-top:24px;--mat-form-field-filled-with-label-container-padding-bottom:8px}html[_ngcontent-%COMP%]{--mdc-filled-text-field-label-text-font:Roboto, sans-serif;--mdc-filled-text-field-label-text-size:16px;--mdc-filled-text-field-label-text-tracking:0.03125em;--mdc-filled-text-field-label-text-weight:400;--mdc-outlined-text-field-label-text-font:Roboto, sans-serif;--mdc-outlined-text-field-label-text-size:16px;--mdc-outlined-text-field-label-text-tracking:0.03125em;--mdc-outlined-text-field-label-text-weight:400;--mat-form-field-container-text-font:Roboto, sans-serif;--mat-form-field-container-text-line-height:24px;--mat-form-field-container-text-size:16px;--mat-form-field-container-text-tracking:0.03125em;--mat-form-field-container-text-weight:400;--mat-form-field-outlined-label-text-populated-size:16px;--mat-form-field-subscript-text-font:Roboto, sans-serif;--mat-form-field-subscript-text-line-height:20px;--mat-form-field-subscript-text-size:12px;--mat-form-field-subscript-text-tracking:0.0333333333em;--mat-form-field-subscript-text-weight:400}html[_ngcontent-%COMP%]{--mat-select-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-select-panel-background-color:white;--mat-select-enabled-trigger-text-color:rgba(0, 0, 0, 0.87);--mat-select-disabled-trigger-text-color:rgba(0, 0, 0, 0.38);--mat-select-placeholder-text-color:rgba(0, 0, 0, 0.6);--mat-select-enabled-arrow-color:rgba(0, 0, 0, 0.54);--mat-select-disabled-arrow-color:rgba(0, 0, 0, 0.38);--mat-select-focused-arrow-color:rgba(63, 81, 181, 0.87);--mat-select-invalid-arrow-color:rgba(244, 67, 54, 0.87)}html[_ngcontent-%COMP%]   .mat-mdc-form-field.mat-accent[_ngcontent-%COMP%]{--mat-select-panel-background-color:white;--mat-select-enabled-trigger-text-color:rgba(0, 0, 0, 0.87);--mat-select-disabled-trigger-text-color:rgba(0, 0, 0, 0.38);--mat-select-placeholder-text-color:rgba(0, 0, 0, 0.6);--mat-select-enabled-arrow-color:rgba(0, 0, 0, 0.54);--mat-select-disabled-arrow-color:rgba(0, 0, 0, 0.38);--mat-select-focused-arrow-color:rgba(255, 64, 129, 0.87);--mat-select-invalid-arrow-color:rgba(244, 67, 54, 0.87)}html[_ngcontent-%COMP%]   .mat-mdc-form-field.mat-warn[_ngcontent-%COMP%]{--mat-select-panel-background-color:white;--mat-select-enabled-trigger-text-color:rgba(0, 0, 0, 0.87);--mat-select-disabled-trigger-text-color:rgba(0, 0, 0, 0.38);--mat-select-placeholder-text-color:rgba(0, 0, 0, 0.6);--mat-select-enabled-arrow-color:rgba(0, 0, 0, 0.54);--mat-select-disabled-arrow-color:rgba(0, 0, 0, 0.38);--mat-select-focused-arrow-color:rgba(244, 67, 54, 0.87);--mat-select-invalid-arrow-color:rgba(244, 67, 54, 0.87)}html[_ngcontent-%COMP%]{--mat-select-arrow-transform:translateY(-8px)}html[_ngcontent-%COMP%]{--mat-select-trigger-text-font:Roboto, sans-serif;--mat-select-trigger-text-line-height:24px;--mat-select-trigger-text-size:16px;--mat-select-trigger-text-tracking:0.03125em;--mat-select-trigger-text-weight:400}html[_ngcontent-%COMP%]{--mat-autocomplete-container-shape:4px;--mat-autocomplete-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-autocomplete-background-color:white}html[_ngcontent-%COMP%]{--mdc-dialog-container-elevation-shadow:0px 11px 15px -7px rgba(0, 0, 0, 0.2), 0px 24px 38px 3px rgba(0, 0, 0, 0.14), 0px 9px 46px 8px rgba(0, 0, 0, 0.12);--mdc-dialog-container-shadow-color:#000;--mdc-dialog-container-shape:4px;--mat-dialog-container-max-width:80vw;--mat-dialog-container-small-max-width:80vw;--mat-dialog-container-min-width:0;--mat-dialog-actions-alignment:start;--mat-dialog-actions-padding:8px;--mat-dialog-content-padding:20px 24px;--mat-dialog-with-actions-content-padding:20px 24px;--mat-dialog-headline-padding:0 24px 9px}html[_ngcontent-%COMP%]{--mdc-dialog-container-color:white;--mdc-dialog-subhead-color:rgba(0, 0, 0, 0.87);--mdc-dialog-supporting-text-color:rgba(0, 0, 0, 0.6)}html[_ngcontent-%COMP%]{--mdc-dialog-subhead-font:Roboto, sans-serif;--mdc-dialog-subhead-line-height:32px;--mdc-dialog-subhead-size:20px;--mdc-dialog-subhead-weight:500;--mdc-dialog-subhead-tracking:0.0125em;--mdc-dialog-supporting-text-font:Roboto, sans-serif;--mdc-dialog-supporting-text-line-height:24px;--mdc-dialog-supporting-text-size:16px;--mdc-dialog-supporting-text-weight:400;--mdc-dialog-supporting-text-tracking:0.03125em}.mat-mdc-standard-chip[_ngcontent-%COMP%]{--mdc-chip-container-shape-family:rounded;--mdc-chip-container-shape-radius:16px 16px 16px 16px;--mdc-chip-with-avatar-avatar-shape-family:rounded;--mdc-chip-with-avatar-avatar-shape-radius:14px 14px 14px 14px;--mdc-chip-with-avatar-avatar-size:28px;--mdc-chip-with-icon-icon-size:18px;--mdc-chip-outline-width:0;--mdc-chip-outline-color:transparent;--mdc-chip-disabled-outline-color:transparent;--mdc-chip-focus-outline-color:transparent;--mdc-chip-hover-state-layer-opacity:0.04;--mdc-chip-with-avatar-disabled-avatar-opacity:1;--mdc-chip-flat-selected-outline-width:0;--mdc-chip-selected-hover-state-layer-opacity:0.04;--mdc-chip-with-trailing-icon-disabled-trailing-icon-opacity:1;--mdc-chip-with-icon-disabled-icon-opacity:1;--mat-chip-disabled-container-opacity:0.4;--mat-chip-trailing-action-opacity:0.54;--mat-chip-trailing-action-focus-opacity:1;--mat-chip-trailing-action-state-layer-color:transparent;--mat-chip-selected-trailing-action-state-layer-color:transparent;--mat-chip-trailing-action-hover-state-layer-opacity:0;--mat-chip-trailing-action-focus-state-layer-opacity:0}.mat-mdc-standard-chip[_ngcontent-%COMP%]{--mdc-chip-disabled-label-text-color:#212121;--mdc-chip-elevated-container-color:#e0e0e0;--mdc-chip-elevated-selected-container-color:#e0e0e0;--mdc-chip-elevated-disabled-container-color:#e0e0e0;--mdc-chip-flat-disabled-selected-container-color:#e0e0e0;--mdc-chip-focus-state-layer-color:black;--mdc-chip-hover-state-layer-color:black;--mdc-chip-selected-hover-state-layer-color:black;--mdc-chip-focus-state-layer-opacity:0.12;--mdc-chip-selected-focus-state-layer-color:black;--mdc-chip-selected-focus-state-layer-opacity:0.12;--mdc-chip-label-text-color:#212121;--mdc-chip-selected-label-text-color:#212121;--mdc-chip-with-icon-icon-color:#212121;--mdc-chip-with-icon-disabled-icon-color:#212121;--mdc-chip-with-icon-selected-icon-color:#212121;--mdc-chip-with-trailing-icon-disabled-trailing-icon-color:#212121;--mdc-chip-with-trailing-icon-trailing-icon-color:#212121;--mat-chip-selected-disabled-trailing-icon-color:#212121;--mat-chip-selected-trailing-icon-color:#212121}.mat-mdc-standard-chip.mat-mdc-chip-selected.mat-primary[_ngcontent-%COMP%], .mat-mdc-standard-chip.mat-mdc-chip-highlighted.mat-primary[_ngcontent-%COMP%]{--mdc-chip-disabled-label-text-color:white;--mdc-chip-elevated-container-color:#3f51b5;--mdc-chip-elevated-selected-container-color:#3f51b5;--mdc-chip-elevated-disabled-container-color:#3f51b5;--mdc-chip-flat-disabled-selected-container-color:#3f51b5;--mdc-chip-focus-state-layer-color:black;--mdc-chip-hover-state-layer-color:black;--mdc-chip-selected-hover-state-layer-color:black;--mdc-chip-focus-state-layer-opacity:0.12;--mdc-chip-selected-focus-state-layer-color:black;--mdc-chip-selected-focus-state-layer-opacity:0.12;--mdc-chip-label-text-color:white;--mdc-chip-selected-label-text-color:white;--mdc-chip-with-icon-icon-color:white;--mdc-chip-with-icon-disabled-icon-color:white;--mdc-chip-with-icon-selected-icon-color:white;--mdc-chip-with-trailing-icon-disabled-trailing-icon-color:white;--mdc-chip-with-trailing-icon-trailing-icon-color:white;--mat-chip-selected-disabled-trailing-icon-color:white;--mat-chip-selected-trailing-icon-color:white}.mat-mdc-standard-chip.mat-mdc-chip-selected.mat-accent[_ngcontent-%COMP%], .mat-mdc-standard-chip.mat-mdc-chip-highlighted.mat-accent[_ngcontent-%COMP%]{--mdc-chip-disabled-label-text-color:white;--mdc-chip-elevated-container-color:#ff4081;--mdc-chip-elevated-selected-container-color:#ff4081;--mdc-chip-elevated-disabled-container-color:#ff4081;--mdc-chip-flat-disabled-selected-container-color:#ff4081;--mdc-chip-focus-state-layer-color:black;--mdc-chip-hover-state-layer-color:black;--mdc-chip-selected-hover-state-layer-color:black;--mdc-chip-focus-state-layer-opacity:0.12;--mdc-chip-selected-focus-state-layer-color:black;--mdc-chip-selected-focus-state-layer-opacity:0.12;--mdc-chip-label-text-color:white;--mdc-chip-selected-label-text-color:white;--mdc-chip-with-icon-icon-color:white;--mdc-chip-with-icon-disabled-icon-color:white;--mdc-chip-with-icon-selected-icon-color:white;--mdc-chip-with-trailing-icon-disabled-trailing-icon-color:white;--mdc-chip-with-trailing-icon-trailing-icon-color:white;--mat-chip-selected-disabled-trailing-icon-color:white;--mat-chip-selected-trailing-icon-color:white}.mat-mdc-standard-chip.mat-mdc-chip-selected.mat-warn[_ngcontent-%COMP%], .mat-mdc-standard-chip.mat-mdc-chip-highlighted.mat-warn[_ngcontent-%COMP%]{--mdc-chip-disabled-label-text-color:white;--mdc-chip-elevated-container-color:#f44336;--mdc-chip-elevated-selected-container-color:#f44336;--mdc-chip-elevated-disabled-container-color:#f44336;--mdc-chip-flat-disabled-selected-container-color:#f44336;--mdc-chip-focus-state-layer-color:black;--mdc-chip-hover-state-layer-color:black;--mdc-chip-selected-hover-state-layer-color:black;--mdc-chip-focus-state-layer-opacity:0.12;--mdc-chip-selected-focus-state-layer-color:black;--mdc-chip-selected-focus-state-layer-opacity:0.12;--mdc-chip-label-text-color:white;--mdc-chip-selected-label-text-color:white;--mdc-chip-with-icon-icon-color:white;--mdc-chip-with-icon-disabled-icon-color:white;--mdc-chip-with-icon-selected-icon-color:white;--mdc-chip-with-trailing-icon-disabled-trailing-icon-color:white;--mdc-chip-with-trailing-icon-trailing-icon-color:white;--mat-chip-selected-disabled-trailing-icon-color:white;--mat-chip-selected-trailing-icon-color:white}.mat-mdc-chip.mat-mdc-standard-chip[_ngcontent-%COMP%]{--mdc-chip-container-height:32px}.mat-mdc-standard-chip[_ngcontent-%COMP%]{--mdc-chip-label-text-font:Roboto, sans-serif;--mdc-chip-label-text-line-height:20px;--mdc-chip-label-text-size:14px;--mdc-chip-label-text-tracking:0.0178571429em;--mdc-chip-label-text-weight:400}html[_ngcontent-%COMP%]{--mdc-switch-disabled-selected-icon-opacity:0.38;--mdc-switch-disabled-track-opacity:0.12;--mdc-switch-disabled-unselected-icon-opacity:0.38;--mdc-switch-handle-height:20px;--mdc-switch-handle-shape:10px;--mdc-switch-handle-width:20px;--mdc-switch-selected-icon-size:18px;--mdc-switch-track-height:14px;--mdc-switch-track-shape:7px;--mdc-switch-track-width:36px;--mdc-switch-unselected-icon-size:18px;--mdc-switch-selected-focus-state-layer-opacity:0.12;--mdc-switch-selected-hover-state-layer-opacity:0.04;--mdc-switch-selected-pressed-state-layer-opacity:0.1;--mdc-switch-unselected-focus-state-layer-opacity:0.12;--mdc-switch-unselected-hover-state-layer-opacity:0.04;--mdc-switch-unselected-pressed-state-layer-opacity:0.1;--mat-switch-disabled-selected-handle-opacity:0.38;--mat-switch-disabled-unselected-handle-opacity:0.38;--mat-switch-unselected-handle-size:20px;--mat-switch-selected-handle-size:20px;--mat-switch-pressed-handle-size:20px;--mat-switch-with-icon-handle-size:20px;--mat-switch-selected-handle-horizontal-margin:0;--mat-switch-selected-with-icon-handle-horizontal-margin:0;--mat-switch-selected-pressed-handle-horizontal-margin:0;--mat-switch-unselected-handle-horizontal-margin:0;--mat-switch-unselected-with-icon-handle-horizontal-margin:0;--mat-switch-unselected-pressed-handle-horizontal-margin:0;--mat-switch-visible-track-opacity:1;--mat-switch-hidden-track-opacity:1;--mat-switch-visible-track-transition:transform 75ms 0ms cubic-bezier(0, 0, 0.2, 1);--mat-switch-hidden-track-transition:transform 75ms 0ms cubic-bezier(0.4, 0, 0.6, 1);--mat-switch-track-outline-width:1px;--mat-switch-track-outline-color:transparent;--mat-switch-selected-track-outline-width:1px;--mat-switch-disabled-unselected-track-outline-width:1px;--mat-switch-disabled-unselected-track-outline-color:transparent}html[_ngcontent-%COMP%]{--mdc-switch-selected-focus-state-layer-color:#3949ab;--mdc-switch-selected-handle-color:#3949ab;--mdc-switch-selected-hover-state-layer-color:#3949ab;--mdc-switch-selected-pressed-state-layer-color:#3949ab;--mdc-switch-selected-focus-handle-color:#1a237e;--mdc-switch-selected-hover-handle-color:#1a237e;--mdc-switch-selected-pressed-handle-color:#1a237e;--mdc-switch-selected-focus-track-color:#7986cb;--mdc-switch-selected-hover-track-color:#7986cb;--mdc-switch-selected-pressed-track-color:#7986cb;--mdc-switch-selected-track-color:#7986cb;--mdc-switch-disabled-selected-handle-color:#424242;--mdc-switch-disabled-selected-icon-color:#fff;--mdc-switch-disabled-selected-track-color:#424242;--mdc-switch-disabled-unselected-handle-color:#424242;--mdc-switch-disabled-unselected-icon-color:#fff;--mdc-switch-disabled-unselected-track-color:#424242;--mdc-switch-handle-surface-color:var(--mdc-theme-surface, #fff);--mdc-switch-handle-elevation-shadow:0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);--mdc-switch-handle-shadow-color:black;--mdc-switch-disabled-handle-elevation-shadow:0px 0px 0px 0px rgba(0, 0, 0, 0.2), 0px 0px 0px 0px rgba(0, 0, 0, 0.14), 0px 0px 0px 0px rgba(0, 0, 0, 0.12);--mdc-switch-selected-icon-color:#fff;--mdc-switch-unselected-focus-handle-color:#212121;--mdc-switch-unselected-focus-state-layer-color:#424242;--mdc-switch-unselected-focus-track-color:#e0e0e0;--mdc-switch-unselected-handle-color:#616161;--mdc-switch-unselected-hover-handle-color:#212121;--mdc-switch-unselected-hover-state-layer-color:#424242;--mdc-switch-unselected-hover-track-color:#e0e0e0;--mdc-switch-unselected-icon-color:#fff;--mdc-switch-unselected-pressed-handle-color:#212121;--mdc-switch-unselected-pressed-state-layer-color:#424242;--mdc-switch-unselected-pressed-track-color:#e0e0e0;--mdc-switch-unselected-track-color:#e0e0e0;--mdc-switch-disabled-label-text-color: rgba(0, 0, 0, 0.38)}html[_ngcontent-%COMP%]   .mat-mdc-slide-toggle[_ngcontent-%COMP%]{--mdc-form-field-label-text-color:rgba(0, 0, 0, 0.87)}html[_ngcontent-%COMP%]   .mat-mdc-slide-toggle.mat-accent[_ngcontent-%COMP%]{--mdc-switch-selected-focus-state-layer-color:#d81b60;--mdc-switch-selected-handle-color:#d81b60;--mdc-switch-selected-hover-state-layer-color:#d81b60;--mdc-switch-selected-pressed-state-layer-color:#d81b60;--mdc-switch-selected-focus-handle-color:#880e4f;--mdc-switch-selected-hover-handle-color:#880e4f;--mdc-switch-selected-pressed-handle-color:#880e4f;--mdc-switch-selected-focus-track-color:#f06292;--mdc-switch-selected-hover-track-color:#f06292;--mdc-switch-selected-pressed-track-color:#f06292;--mdc-switch-selected-track-color:#f06292}html[_ngcontent-%COMP%]   .mat-mdc-slide-toggle.mat-warn[_ngcontent-%COMP%]{--mdc-switch-selected-focus-state-layer-color:#e53935;--mdc-switch-selected-handle-color:#e53935;--mdc-switch-selected-hover-state-layer-color:#e53935;--mdc-switch-selected-pressed-state-layer-color:#e53935;--mdc-switch-selected-focus-handle-color:#b71c1c;--mdc-switch-selected-hover-handle-color:#b71c1c;--mdc-switch-selected-pressed-handle-color:#b71c1c;--mdc-switch-selected-focus-track-color:#e57373;--mdc-switch-selected-hover-track-color:#e57373;--mdc-switch-selected-pressed-track-color:#e57373;--mdc-switch-selected-track-color:#e57373}html[_ngcontent-%COMP%]{--mdc-switch-state-layer-size:40px}html[_ngcontent-%COMP%]   .mat-mdc-slide-toggle[_ngcontent-%COMP%]{--mdc-form-field-label-text-font:Roboto, sans-serif;--mdc-form-field-label-text-line-height:20px;--mdc-form-field-label-text-size:14px;--mdc-form-field-label-text-tracking:0.0178571429em;--mdc-form-field-label-text-weight:400}html[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-opacity:0.38;--mdc-radio-disabled-unselected-icon-opacity:0.38;--mdc-radio-state-layer-size:40px}.mat-mdc-radio-button[_ngcontent-%COMP%]{--mdc-form-field-label-text-color:rgba(0, 0, 0, 0.87)}.mat-mdc-radio-button.mat-primary[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#3f51b5;--mdc-radio-selected-hover-icon-color:#3f51b5;--mdc-radio-selected-icon-color:#3f51b5;--mdc-radio-selected-pressed-icon-color:#3f51b5;--mat-radio-ripple-color:black;--mat-radio-checked-ripple-color:#3f51b5;--mat-radio-disabled-label-color:rgba(0, 0, 0, 0.38)}.mat-mdc-radio-button.mat-accent[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#ff4081;--mdc-radio-selected-hover-icon-color:#ff4081;--mdc-radio-selected-icon-color:#ff4081;--mdc-radio-selected-pressed-icon-color:#ff4081;--mat-radio-ripple-color:black;--mat-radio-checked-ripple-color:#ff4081;--mat-radio-disabled-label-color:rgba(0, 0, 0, 0.38)}.mat-mdc-radio-button.mat-warn[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#f44336;--mdc-radio-selected-hover-icon-color:#f44336;--mdc-radio-selected-icon-color:#f44336;--mdc-radio-selected-pressed-icon-color:#f44336;--mat-radio-ripple-color:black;--mat-radio-checked-ripple-color:#f44336;--mat-radio-disabled-label-color:rgba(0, 0, 0, 0.38)}html[_ngcontent-%COMP%]{--mdc-radio-state-layer-size:40px;--mat-radio-touch-target-display:block}.mat-mdc-radio-button[_ngcontent-%COMP%]{--mdc-form-field-label-text-font:Roboto, sans-serif;--mdc-form-field-label-text-line-height:20px;--mdc-form-field-label-text-size:14px;--mdc-form-field-label-text-tracking:0.0178571429em;--mdc-form-field-label-text-weight:400}html[_ngcontent-%COMP%]{--mat-slider-value-indicator-width:auto;--mat-slider-value-indicator-height:32px;--mat-slider-value-indicator-caret-display:block;--mat-slider-value-indicator-border-radius:4px;--mat-slider-value-indicator-padding:0 12px;--mat-slider-value-indicator-text-transform:none;--mat-slider-value-indicator-container-transform:translateX(-50%);--mdc-slider-active-track-height:6px;--mdc-slider-active-track-shape:9999px;--mdc-slider-handle-height:20px;--mdc-slider-handle-shape:50%;--mdc-slider-handle-width:20px;--mdc-slider-inactive-track-height:4px;--mdc-slider-inactive-track-shape:9999px;--mdc-slider-with-overlap-handle-outline-width:1px;--mdc-slider-with-tick-marks-active-container-opacity:0.6;--mdc-slider-with-tick-marks-container-shape:50%;--mdc-slider-with-tick-marks-container-size:2px;--mdc-slider-with-tick-marks-inactive-container-opacity:0.6}html[_ngcontent-%COMP%]{--mdc-slider-handle-color:#3f51b5;--mdc-slider-focus-handle-color:#3f51b5;--mdc-slider-hover-handle-color:#3f51b5;--mdc-slider-active-track-color:#3f51b5;--mdc-slider-inactive-track-color:#3f51b5;--mdc-slider-with-tick-marks-inactive-container-color:#3f51b5;--mdc-slider-with-tick-marks-active-container-color:white;--mdc-slider-disabled-active-track-color:#000;--mdc-slider-disabled-handle-color:#000;--mdc-slider-disabled-inactive-track-color:#000;--mdc-slider-label-container-color:#000;--mdc-slider-label-label-text-color:#fff;--mdc-slider-with-overlap-handle-outline-color:#fff;--mdc-slider-with-tick-marks-disabled-container-color:#000;--mdc-slider-handle-elevation:0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);--mat-slider-ripple-color:#3f51b5;--mat-slider-hover-state-layer-color:rgba(63, 81, 181, 0.05);--mat-slider-focus-state-layer-color:rgba(63, 81, 181, 0.2);--mat-slider-value-indicator-opacity:0.6}html[_ngcontent-%COMP%]   .mat-accent[_ngcontent-%COMP%]{--mat-slider-ripple-color:#ff4081;--mat-slider-hover-state-layer-color:rgba(255, 64, 129, 0.05);--mat-slider-focus-state-layer-color:rgba(255, 64, 129, 0.2);--mdc-slider-handle-color:#ff4081;--mdc-slider-focus-handle-color:#ff4081;--mdc-slider-hover-handle-color:#ff4081;--mdc-slider-active-track-color:#ff4081;--mdc-slider-inactive-track-color:#ff4081;--mdc-slider-with-tick-marks-inactive-container-color:#ff4081;--mdc-slider-with-tick-marks-active-container-color:white}html[_ngcontent-%COMP%]   .mat-warn[_ngcontent-%COMP%]{--mat-slider-ripple-color:#f44336;--mat-slider-hover-state-layer-color:rgba(244, 67, 54, 0.05);--mat-slider-focus-state-layer-color:rgba(244, 67, 54, 0.2);--mdc-slider-handle-color:#f44336;--mdc-slider-focus-handle-color:#f44336;--mdc-slider-hover-handle-color:#f44336;--mdc-slider-active-track-color:#f44336;--mdc-slider-inactive-track-color:#f44336;--mdc-slider-with-tick-marks-inactive-container-color:#f44336;--mdc-slider-with-tick-marks-active-container-color:white}html[_ngcontent-%COMP%]{--mdc-slider-label-label-text-font:Roboto, sans-serif;--mdc-slider-label-label-text-size:14px;--mdc-slider-label-label-text-line-height:22px;--mdc-slider-label-label-text-tracking:0.0071428571em;--mdc-slider-label-label-text-weight:500}html[_ngcontent-%COMP%]{--mat-menu-container-shape:4px;--mat-menu-divider-bottom-spacing:0;--mat-menu-divider-top-spacing:0;--mat-menu-item-spacing:16px;--mat-menu-item-icon-size:24px;--mat-menu-item-leading-spacing:16px;--mat-menu-item-trailing-spacing:16px;--mat-menu-item-with-icon-leading-spacing:16px;--mat-menu-item-with-icon-trailing-spacing:16px}html[_ngcontent-%COMP%]{--mat-menu-item-label-text-color:rgba(0, 0, 0, 0.87);--mat-menu-item-icon-color:rgba(0, 0, 0, 0.87);--mat-menu-item-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-menu-item-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-menu-container-color:white;--mat-menu-divider-color:rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-menu-item-label-text-font:Roboto, sans-serif;--mat-menu-item-label-text-size:16px;--mat-menu-item-label-text-tracking:0.03125em;--mat-menu-item-label-text-line-height:24px;--mat-menu-item-label-text-weight:400}html[_ngcontent-%COMP%]{--mdc-list-list-item-container-shape:0;--mdc-list-list-item-leading-avatar-shape:50%;--mdc-list-list-item-container-color:transparent;--mdc-list-list-item-selected-container-color:transparent;--mdc-list-list-item-leading-avatar-color:transparent;--mdc-list-list-item-leading-icon-size:24px;--mdc-list-list-item-leading-avatar-size:40px;--mdc-list-list-item-trailing-icon-size:24px;--mdc-list-list-item-disabled-state-layer-color:transparent;--mdc-list-list-item-disabled-state-layer-opacity:0;--mdc-list-list-item-disabled-label-text-opacity:0.38;--mdc-list-list-item-disabled-leading-icon-opacity:0.38;--mdc-list-list-item-disabled-trailing-icon-opacity:0.38;--mat-list-active-indicator-color:transparent;--mat-list-active-indicator-shape:0}html[_ngcontent-%COMP%]{--mdc-list-list-item-label-text-color:rgba(0, 0, 0, 0.87);--mdc-list-list-item-supporting-text-color:rgba(0, 0, 0, 0.54);--mdc-list-list-item-leading-icon-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-trailing-supporting-text-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-trailing-icon-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-selected-trailing-icon-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-disabled-label-text-color:black;--mdc-list-list-item-disabled-leading-icon-color:black;--mdc-list-list-item-disabled-trailing-icon-color:black;--mdc-list-list-item-hover-label-text-color:rgba(0, 0, 0, 0.87);--mdc-list-list-item-hover-leading-icon-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-hover-trailing-icon-color:rgba(0, 0, 0, 0.38);--mdc-list-list-item-focus-label-text-color:rgba(0, 0, 0, 0.87);--mdc-list-list-item-hover-state-layer-color:black;--mdc-list-list-item-hover-state-layer-opacity:0.04;--mdc-list-list-item-focus-state-layer-color:black;--mdc-list-list-item-focus-state-layer-opacity:0.12}.mdc-list-item__start[_ngcontent-%COMP%], .mdc-list-item__end[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#3f51b5;--mdc-radio-selected-hover-icon-color:#3f51b5;--mdc-radio-selected-icon-color:#3f51b5;--mdc-radio-selected-pressed-icon-color:#3f51b5}.mat-accent[_ngcontent-%COMP%]   .mdc-list-item__start[_ngcontent-%COMP%], .mat-accent[_ngcontent-%COMP%]   .mdc-list-item__end[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#ff4081;--mdc-radio-selected-hover-icon-color:#ff4081;--mdc-radio-selected-icon-color:#ff4081;--mdc-radio-selected-pressed-icon-color:#ff4081}.mat-warn[_ngcontent-%COMP%]   .mdc-list-item__start[_ngcontent-%COMP%], .mat-warn[_ngcontent-%COMP%]   .mdc-list-item__end[_ngcontent-%COMP%]{--mdc-radio-disabled-selected-icon-color:black;--mdc-radio-disabled-unselected-icon-color:black;--mdc-radio-unselected-hover-icon-color:#212121;--mdc-radio-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-radio-selected-focus-icon-color:#f44336;--mdc-radio-selected-hover-icon-color:#f44336;--mdc-radio-selected-icon-color:#f44336;--mdc-radio-selected-pressed-icon-color:#f44336}.mat-mdc-list-option[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#3f51b5;--mdc-checkbox-selected-hover-icon-color:#3f51b5;--mdc-checkbox-selected-icon-color:#3f51b5;--mdc-checkbox-selected-pressed-icon-color:#3f51b5;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#3f51b5;--mdc-checkbox-selected-hover-state-layer-color:#3f51b5;--mdc-checkbox-selected-pressed-state-layer-color:#3f51b5;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black}.mat-mdc-list-option.mat-accent[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#ff4081;--mdc-checkbox-selected-hover-icon-color:#ff4081;--mdc-checkbox-selected-icon-color:#ff4081;--mdc-checkbox-selected-pressed-icon-color:#ff4081;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#ff4081;--mdc-checkbox-selected-hover-state-layer-color:#ff4081;--mdc-checkbox-selected-pressed-state-layer-color:#ff4081;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black}.mat-mdc-list-option.mat-warn[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#f44336;--mdc-checkbox-selected-hover-icon-color:#f44336;--mdc-checkbox-selected-icon-color:#f44336;--mdc-checkbox-selected-pressed-icon-color:#f44336;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#f44336;--mdc-checkbox-selected-hover-state-layer-color:#f44336;--mdc-checkbox-selected-pressed-state-layer-color:#f44336;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black}.mat-mdc-list-base.mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--selected[_ngcontent-%COMP%]   .mdc-list-item__primary-text[_ngcontent-%COMP%], .mat-mdc-list-base.mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--activated[_ngcontent-%COMP%]   .mdc-list-item__primary-text[_ngcontent-%COMP%]{color:#3f51b5}.mat-mdc-list-base.mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--selected.mdc-list-item--with-leading-icon[_ngcontent-%COMP%]   .mdc-list-item__start[_ngcontent-%COMP%], .mat-mdc-list-base.mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--activated.mdc-list-item--with-leading-icon[_ngcontent-%COMP%]   .mdc-list-item__start[_ngcontent-%COMP%]{color:#3f51b5}.mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--disabled[_ngcontent-%COMP%]   .mdc-list-item__start[_ngcontent-%COMP%], .mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--disabled[_ngcontent-%COMP%]   .mdc-list-item__content[_ngcontent-%COMP%], .mat-mdc-list-base[_ngcontent-%COMP%]   .mdc-list-item--disabled[_ngcontent-%COMP%]   .mdc-list-item__end[_ngcontent-%COMP%]{opacity:1}html[_ngcontent-%COMP%]{--mdc-list-list-item-one-line-container-height:48px;--mdc-list-list-item-two-line-container-height:64px;--mdc-list-list-item-three-line-container-height:88px;--mat-list-list-item-leading-icon-start-space:16px;--mat-list-list-item-leading-icon-end-space:32px}.mdc-list-item__start[_ngcontent-%COMP%], .mdc-list-item__end[_ngcontent-%COMP%]{--mdc-radio-state-layer-size:40px}.mat-mdc-list-item.mdc-list-item--with-leading-avatar.mdc-list-item--with-one-line[_ngcontent-%COMP%], .mat-mdc-list-item.mdc-list-item--with-leading-checkbox.mdc-list-item--with-one-line[_ngcontent-%COMP%], .mat-mdc-list-item.mdc-list-item--with-leading-icon.mdc-list-item--with-one-line[_ngcontent-%COMP%]{height:56px}.mat-mdc-list-item.mdc-list-item--with-leading-avatar.mdc-list-item--with-two-lines[_ngcontent-%COMP%], .mat-mdc-list-item.mdc-list-item--with-leading-checkbox.mdc-list-item--with-two-lines[_ngcontent-%COMP%], .mat-mdc-list-item.mdc-list-item--with-leading-icon.mdc-list-item--with-two-lines[_ngcontent-%COMP%]{height:72px}html[_ngcontent-%COMP%]{--mdc-list-list-item-label-text-font:Roboto, sans-serif;--mdc-list-list-item-label-text-line-height:24px;--mdc-list-list-item-label-text-size:16px;--mdc-list-list-item-label-text-tracking:0.03125em;--mdc-list-list-item-label-text-weight:400;--mdc-list-list-item-supporting-text-font:Roboto, sans-serif;--mdc-list-list-item-supporting-text-line-height:20px;--mdc-list-list-item-supporting-text-size:14px;--mdc-list-list-item-supporting-text-tracking:0.0178571429em;--mdc-list-list-item-supporting-text-weight:400;--mdc-list-list-item-trailing-supporting-text-font:Roboto, sans-serif;--mdc-list-list-item-trailing-supporting-text-line-height:20px;--mdc-list-list-item-trailing-supporting-text-size:12px;--mdc-list-list-item-trailing-supporting-text-tracking:0.0333333333em;--mdc-list-list-item-trailing-supporting-text-weight:400}.mdc-list-group__subheader[_ngcontent-%COMP%]{font:400 16px/28px Roboto, sans-serif;letter-spacing:.009375em}html[_ngcontent-%COMP%]{--mat-paginator-container-text-color:rgba(0, 0, 0, 0.87);--mat-paginator-container-background-color:white;--mat-paginator-enabled-icon-color:rgba(0, 0, 0, 0.54);--mat-paginator-disabled-icon-color:rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-paginator-container-size:56px;--mat-paginator-form-field-container-height:40px;--mat-paginator-form-field-container-vertical-padding:8px}html[_ngcontent-%COMP%]{--mat-paginator-container-text-font:Roboto, sans-serif;--mat-paginator-container-text-line-height:20px;--mat-paginator-container-text-size:12px;--mat-paginator-container-text-tracking:0.0333333333em;--mat-paginator-container-text-weight:400;--mat-paginator-select-trigger-text-size:12px}html[_ngcontent-%COMP%]{--mdc-tab-indicator-active-indicator-height:2px;--mdc-tab-indicator-active-indicator-shape:0;--mdc-secondary-navigation-tab-container-height:48px;--mat-tab-header-divider-color:transparent;--mat-tab-header-divider-height:0}.mat-mdc-tab-group[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar[_ngcontent-%COMP%]{--mdc-tab-indicator-active-indicator-color:#3f51b5;--mat-tab-header-disabled-ripple-color:rgba(0, 0, 0, 0.38);--mat-tab-header-pagination-icon-color:black;--mat-tab-header-inactive-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-label-text-color:#3f51b5;--mat-tab-header-active-ripple-color:#3f51b5;--mat-tab-header-inactive-ripple-color:#3f51b5;--mat-tab-header-inactive-focus-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-inactive-hover-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-focus-label-text-color:#3f51b5;--mat-tab-header-active-hover-label-text-color:#3f51b5;--mat-tab-header-active-focus-indicator-color:#3f51b5;--mat-tab-header-active-hover-indicator-color:#3f51b5}.mat-mdc-tab-group.mat-accent[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar.mat-accent[_ngcontent-%COMP%]{--mdc-tab-indicator-active-indicator-color:#ff4081;--mat-tab-header-disabled-ripple-color:rgba(0, 0, 0, 0.38);--mat-tab-header-pagination-icon-color:black;--mat-tab-header-inactive-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-label-text-color:#ff4081;--mat-tab-header-active-ripple-color:#ff4081;--mat-tab-header-inactive-ripple-color:#ff4081;--mat-tab-header-inactive-focus-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-inactive-hover-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-focus-label-text-color:#ff4081;--mat-tab-header-active-hover-label-text-color:#ff4081;--mat-tab-header-active-focus-indicator-color:#ff4081;--mat-tab-header-active-hover-indicator-color:#ff4081}.mat-mdc-tab-group.mat-warn[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar.mat-warn[_ngcontent-%COMP%]{--mdc-tab-indicator-active-indicator-color:#f44336;--mat-tab-header-disabled-ripple-color:rgba(0, 0, 0, 0.38);--mat-tab-header-pagination-icon-color:black;--mat-tab-header-inactive-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-label-text-color:#f44336;--mat-tab-header-active-ripple-color:#f44336;--mat-tab-header-inactive-ripple-color:#f44336;--mat-tab-header-inactive-focus-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-inactive-hover-label-text-color:rgba(0, 0, 0, 0.6);--mat-tab-header-active-focus-label-text-color:#f44336;--mat-tab-header-active-hover-label-text-color:#f44336;--mat-tab-header-active-focus-indicator-color:#f44336;--mat-tab-header-active-hover-indicator-color:#f44336}.mat-mdc-tab-group.mat-background-primary[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar.mat-background-primary[_ngcontent-%COMP%]{--mat-tab-header-with-background-background-color:#3f51b5;--mat-tab-header-with-background-foreground-color:white}.mat-mdc-tab-group.mat-background-accent[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar.mat-background-accent[_ngcontent-%COMP%]{--mat-tab-header-with-background-background-color:#ff4081;--mat-tab-header-with-background-foreground-color:white}.mat-mdc-tab-group.mat-background-warn[_ngcontent-%COMP%], .mat-mdc-tab-nav-bar.mat-background-warn[_ngcontent-%COMP%]{--mat-tab-header-with-background-background-color:#f44336;--mat-tab-header-with-background-foreground-color:white}.mat-mdc-tab-header[_ngcontent-%COMP%]{--mdc-secondary-navigation-tab-container-height:48px}.mat-mdc-tab-header[_ngcontent-%COMP%]{--mat-tab-header-label-text-font:Roboto, sans-serif;--mat-tab-header-label-text-size:14px;--mat-tab-header-label-text-tracking:0.0892857143em;--mat-tab-header-label-text-line-height:36px;--mat-tab-header-label-text-weight:500}html[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-checkmark-color:#fff;--mdc-checkbox-selected-focus-state-layer-opacity:0.16;--mdc-checkbox-selected-hover-state-layer-opacity:0.04;--mdc-checkbox-selected-pressed-state-layer-opacity:0.16;--mdc-checkbox-unselected-focus-state-layer-opacity:0.16;--mdc-checkbox-unselected-hover-state-layer-opacity:0.04;--mdc-checkbox-unselected-pressed-state-layer-opacity:0.16}html[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#ff4081;--mdc-checkbox-selected-hover-icon-color:#ff4081;--mdc-checkbox-selected-icon-color:#ff4081;--mdc-checkbox-selected-pressed-icon-color:#ff4081;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#ff4081;--mdc-checkbox-selected-hover-state-layer-color:#ff4081;--mdc-checkbox-selected-pressed-state-layer-color:#ff4081;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black;--mat-checkbox-disabled-label-color:rgba(0, 0, 0, 0.38)}.mat-mdc-checkbox[_ngcontent-%COMP%]{--mdc-form-field-label-text-color:rgba(0, 0, 0, 0.87)}.mat-mdc-checkbox.mat-primary[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#3f51b5;--mdc-checkbox-selected-hover-icon-color:#3f51b5;--mdc-checkbox-selected-icon-color:#3f51b5;--mdc-checkbox-selected-pressed-icon-color:#3f51b5;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#3f51b5;--mdc-checkbox-selected-hover-state-layer-color:#3f51b5;--mdc-checkbox-selected-pressed-state-layer-color:#3f51b5;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black}.mat-mdc-checkbox.mat-warn[_ngcontent-%COMP%]{--mdc-checkbox-disabled-selected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-disabled-unselected-icon-color:rgba(0, 0, 0, 0.38);--mdc-checkbox-selected-checkmark-color:white;--mdc-checkbox-selected-focus-icon-color:#f44336;--mdc-checkbox-selected-hover-icon-color:#f44336;--mdc-checkbox-selected-icon-color:#f44336;--mdc-checkbox-selected-pressed-icon-color:#f44336;--mdc-checkbox-unselected-focus-icon-color:#212121;--mdc-checkbox-unselected-hover-icon-color:#212121;--mdc-checkbox-unselected-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-unselected-pressed-icon-color:rgba(0, 0, 0, 0.54);--mdc-checkbox-selected-focus-state-layer-color:#f44336;--mdc-checkbox-selected-hover-state-layer-color:#f44336;--mdc-checkbox-selected-pressed-state-layer-color:#f44336;--mdc-checkbox-unselected-focus-state-layer-color:black;--mdc-checkbox-unselected-hover-state-layer-color:black;--mdc-checkbox-unselected-pressed-state-layer-color:black}html[_ngcontent-%COMP%]{--mdc-checkbox-state-layer-size:40px;--mat-checkbox-touch-target-display:block}.mat-mdc-checkbox[_ngcontent-%COMP%]{--mdc-form-field-label-text-font:Roboto, sans-serif;--mdc-form-field-label-text-line-height:20px;--mdc-form-field-label-text-size:14px;--mdc-form-field-label-text-tracking:0.0178571429em;--mdc-form-field-label-text-weight:400}html[_ngcontent-%COMP%]{--mdc-text-button-container-shape:4px;--mdc-text-button-keep-touch-target:false;--mdc-filled-button-container-shape:4px;--mdc-filled-button-keep-touch-target:false;--mdc-protected-button-container-shape:4px;--mdc-protected-button-keep-touch-target:false;--mdc-outlined-button-keep-touch-target:false;--mdc-outlined-button-outline-width:1px;--mdc-outlined-button-container-shape:4px;--mat-text-button-horizontal-padding:8px;--mat-text-button-with-icon-horizontal-padding:8px;--mat-text-button-icon-spacing:8px;--mat-text-button-icon-offset:0;--mat-filled-button-horizontal-padding:16px;--mat-filled-button-icon-spacing:8px;--mat-filled-button-icon-offset:-4px;--mat-protected-button-horizontal-padding:16px;--mat-protected-button-icon-spacing:8px;--mat-protected-button-icon-offset:-4px;--mat-outlined-button-horizontal-padding:15px;--mat-outlined-button-icon-spacing:8px;--mat-outlined-button-icon-offset:-4px}html[_ngcontent-%COMP%]{--mdc-text-button-label-text-color:black;--mdc-text-button-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mat-text-button-state-layer-color:black;--mat-text-button-disabled-state-layer-color:black;--mat-text-button-ripple-color:rgba(0, 0, 0, 0.1);--mat-text-button-hover-state-layer-opacity:0.04;--mat-text-button-focus-state-layer-opacity:0.12;--mat-text-button-pressed-state-layer-opacity:0.12;--mdc-filled-button-container-color:white;--mdc-filled-button-label-text-color:black;--mdc-filled-button-disabled-container-color:rgba(0, 0, 0, 0.12);--mdc-filled-button-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mat-filled-button-state-layer-color:black;--mat-filled-button-disabled-state-layer-color:black;--mat-filled-button-ripple-color:rgba(0, 0, 0, 0.1);--mat-filled-button-hover-state-layer-opacity:0.04;--mat-filled-button-focus-state-layer-opacity:0.12;--mat-filled-button-pressed-state-layer-opacity:0.12;--mdc-protected-button-container-color:white;--mdc-protected-button-label-text-color:black;--mdc-protected-button-disabled-container-color:rgba(0, 0, 0, 0.12);--mdc-protected-button-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mdc-protected-button-container-elevation-shadow:0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);--mdc-protected-button-disabled-container-elevation-shadow:0px 0px 0px 0px rgba(0, 0, 0, 0.2), 0px 0px 0px 0px rgba(0, 0, 0, 0.14), 0px 0px 0px 0px rgba(0, 0, 0, 0.12);--mdc-protected-button-focus-container-elevation-shadow:0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);--mdc-protected-button-hover-container-elevation-shadow:0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);--mdc-protected-button-pressed-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-protected-button-container-shadow-color:#000;--mat-protected-button-state-layer-color:black;--mat-protected-button-disabled-state-layer-color:black;--mat-protected-button-ripple-color:rgba(0, 0, 0, 0.1);--mat-protected-button-hover-state-layer-opacity:0.04;--mat-protected-button-focus-state-layer-opacity:0.12;--mat-protected-button-pressed-state-layer-opacity:0.12;--mdc-outlined-button-disabled-outline-color:rgba(0, 0, 0, 0.12);--mdc-outlined-button-disabled-label-text-color:rgba(0, 0, 0, 0.38);--mdc-outlined-button-label-text-color:black;--mdc-outlined-button-outline-color:rgba(0, 0, 0, 0.12);--mat-outlined-button-state-layer-color:black;--mat-outlined-button-disabled-state-layer-color:black;--mat-outlined-button-ripple-color:rgba(0, 0, 0, 0.1);--mat-outlined-button-hover-state-layer-opacity:0.04;--mat-outlined-button-focus-state-layer-opacity:0.12;--mat-outlined-button-pressed-state-layer-opacity:0.12}.mat-mdc-button.mat-primary[_ngcontent-%COMP%]{--mdc-text-button-label-text-color:#3f51b5;--mat-text-button-state-layer-color:#3f51b5;--mat-text-button-ripple-color:rgba(63, 81, 181, 0.1)}.mat-mdc-button.mat-accent[_ngcontent-%COMP%]{--mdc-text-button-label-text-color:#ff4081;--mat-text-button-state-layer-color:#ff4081;--mat-text-button-ripple-color:rgba(255, 64, 129, 0.1)}.mat-mdc-button.mat-warn[_ngcontent-%COMP%]{--mdc-text-button-label-text-color:#f44336;--mat-text-button-state-layer-color:#f44336;--mat-text-button-ripple-color:rgba(244, 67, 54, 0.1)}.mat-mdc-unelevated-button.mat-primary[_ngcontent-%COMP%]{--mdc-filled-button-container-color:#3f51b5;--mdc-filled-button-label-text-color:white;--mat-filled-button-state-layer-color:white;--mat-filled-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-unelevated-button.mat-accent[_ngcontent-%COMP%]{--mdc-filled-button-container-color:#ff4081;--mdc-filled-button-label-text-color:white;--mat-filled-button-state-layer-color:white;--mat-filled-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-unelevated-button.mat-warn[_ngcontent-%COMP%]{--mdc-filled-button-container-color:#f44336;--mdc-filled-button-label-text-color:white;--mat-filled-button-state-layer-color:white;--mat-filled-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-raised-button.mat-primary[_ngcontent-%COMP%]{--mdc-protected-button-container-color:#3f51b5;--mdc-protected-button-label-text-color:white;--mat-protected-button-state-layer-color:white;--mat-protected-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-raised-button.mat-accent[_ngcontent-%COMP%]{--mdc-protected-button-container-color:#ff4081;--mdc-protected-button-label-text-color:white;--mat-protected-button-state-layer-color:white;--mat-protected-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-raised-button.mat-warn[_ngcontent-%COMP%]{--mdc-protected-button-container-color:#f44336;--mdc-protected-button-label-text-color:white;--mat-protected-button-state-layer-color:white;--mat-protected-button-ripple-color:rgba(255, 255, 255, 0.1)}.mat-mdc-outlined-button.mat-primary[_ngcontent-%COMP%]{--mdc-outlined-button-label-text-color:#3f51b5;--mdc-outlined-button-outline-color:rgba(0, 0, 0, 0.12);--mat-outlined-button-state-layer-color:#3f51b5;--mat-outlined-button-ripple-color:rgba(63, 81, 181, 0.1)}.mat-mdc-outlined-button.mat-accent[_ngcontent-%COMP%]{--mdc-outlined-button-label-text-color:#ff4081;--mdc-outlined-button-outline-color:rgba(0, 0, 0, 0.12);--mat-outlined-button-state-layer-color:#ff4081;--mat-outlined-button-ripple-color:rgba(255, 64, 129, 0.1)}.mat-mdc-outlined-button.mat-warn[_ngcontent-%COMP%]{--mdc-outlined-button-label-text-color:#f44336;--mdc-outlined-button-outline-color:rgba(0, 0, 0, 0.12);--mat-outlined-button-state-layer-color:#f44336;--mat-outlined-button-ripple-color:rgba(244, 67, 54, 0.1)}html[_ngcontent-%COMP%]{--mdc-text-button-container-height:36px;--mdc-filled-button-container-height:36px;--mdc-outlined-button-container-height:36px;--mdc-protected-button-container-height:36px;--mat-text-button-touch-target-display:block;--mat-filled-button-touch-target-display:block;--mat-protected-button-touch-target-display:block;--mat-outlined-button-touch-target-display:block}html[_ngcontent-%COMP%]{--mdc-text-button-label-text-font:Roboto, sans-serif;--mdc-text-button-label-text-size:14px;--mdc-text-button-label-text-tracking:0.0892857143em;--mdc-text-button-label-text-weight:500;--mdc-text-button-label-text-transform:none;--mdc-filled-button-label-text-font:Roboto, sans-serif;--mdc-filled-button-label-text-size:14px;--mdc-filled-button-label-text-tracking:0.0892857143em;--mdc-filled-button-label-text-weight:500;--mdc-filled-button-label-text-transform:none;--mdc-outlined-button-label-text-font:Roboto, sans-serif;--mdc-outlined-button-label-text-size:14px;--mdc-outlined-button-label-text-tracking:0.0892857143em;--mdc-outlined-button-label-text-weight:500;--mdc-outlined-button-label-text-transform:none;--mdc-protected-button-label-text-font:Roboto, sans-serif;--mdc-protected-button-label-text-size:14px;--mdc-protected-button-label-text-tracking:0.0892857143em;--mdc-protected-button-label-text-weight:500;--mdc-protected-button-label-text-transform:none}html[_ngcontent-%COMP%]{--mdc-icon-button-icon-size:24px}html[_ngcontent-%COMP%]{--mdc-icon-button-icon-color:inherit;--mdc-icon-button-disabled-icon-color:rgba(0, 0, 0, 0.38);--mat-icon-button-state-layer-color:black;--mat-icon-button-disabled-state-layer-color:black;--mat-icon-button-ripple-color:rgba(0, 0, 0, 0.1);--mat-icon-button-hover-state-layer-opacity:0.04;--mat-icon-button-focus-state-layer-opacity:0.12;--mat-icon-button-pressed-state-layer-opacity:0.12}html[_ngcontent-%COMP%]   .mat-mdc-icon-button.mat-primary[_ngcontent-%COMP%]{--mdc-icon-button-icon-color:#3f51b5;--mat-icon-button-state-layer-color:#3f51b5;--mat-icon-button-ripple-color:rgba(63, 81, 181, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-icon-button.mat-accent[_ngcontent-%COMP%]{--mdc-icon-button-icon-color:#ff4081;--mat-icon-button-state-layer-color:#ff4081;--mat-icon-button-ripple-color:rgba(255, 64, 129, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-icon-button.mat-warn[_ngcontent-%COMP%]{--mdc-icon-button-icon-color:#f44336;--mat-icon-button-state-layer-color:#f44336;--mat-icon-button-ripple-color:rgba(244, 67, 54, 0.1)}html[_ngcontent-%COMP%]{--mat-icon-button-touch-target-display:block}.mat-mdc-icon-button.mat-mdc-button-base[_ngcontent-%COMP%]{--mdc-icon-button-state-layer-size:48px;width:var(--mdc-icon-button-state-layer-size);height:var(--mdc-icon-button-state-layer-size);padding:12px}html[_ngcontent-%COMP%]{--mdc-fab-container-shape:50%;--mdc-fab-icon-size:24px;--mdc-fab-small-container-shape:50%;--mdc-fab-small-icon-size:24px;--mdc-extended-fab-container-height:48px;--mdc-extended-fab-container-shape:24px}html[_ngcontent-%COMP%]{--mdc-fab-container-color:white;--mdc-fab-container-elevation-shadow:0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12);--mdc-fab-focus-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-fab-hover-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-fab-pressed-container-elevation-shadow:0px 7px 8px -4px rgba(0, 0, 0, 0.2), 0px 12px 17px 2px rgba(0, 0, 0, 0.14), 0px 5px 22px 4px rgba(0, 0, 0, 0.12);--mdc-fab-container-shadow-color:#000;--mat-fab-foreground-color:black;--mat-fab-state-layer-color:black;--mat-fab-disabled-state-layer-color:black;--mat-fab-ripple-color:rgba(0, 0, 0, 0.1);--mat-fab-hover-state-layer-opacity:0.04;--mat-fab-focus-state-layer-opacity:0.12;--mat-fab-pressed-state-layer-opacity:0.12;--mat-fab-disabled-state-container-color:rgba(0, 0, 0, 0.12);--mat-fab-disabled-state-foreground-color:rgba(0, 0, 0, 0.38);--mdc-fab-small-container-color:white;--mdc-fab-small-container-elevation-shadow:0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12);--mdc-fab-small-focus-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-fab-small-hover-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-fab-small-pressed-container-elevation-shadow:0px 7px 8px -4px rgba(0, 0, 0, 0.2), 0px 12px 17px 2px rgba(0, 0, 0, 0.14), 0px 5px 22px 4px rgba(0, 0, 0, 0.12);--mdc-fab-small-container-shadow-color:#000;--mat-fab-small-foreground-color:black;--mat-fab-small-state-layer-color:black;--mat-fab-small-disabled-state-layer-color:black;--mat-fab-small-ripple-color:rgba(0, 0, 0, 0.1);--mat-fab-small-hover-state-layer-opacity:0.04;--mat-fab-small-focus-state-layer-opacity:0.12;--mat-fab-small-pressed-state-layer-opacity:0.12;--mat-fab-small-disabled-state-container-color:rgba(0, 0, 0, 0.12);--mat-fab-small-disabled-state-foreground-color:rgba(0, 0, 0, 0.38);--mdc-extended-fab-container-elevation-shadow:0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12);--mdc-extended-fab-focus-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-extended-fab-hover-container-elevation-shadow:0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);--mdc-extended-fab-pressed-container-elevation-shadow:0px 7px 8px -4px rgba(0, 0, 0, 0.2), 0px 12px 17px 2px rgba(0, 0, 0, 0.14), 0px 5px 22px 4px rgba(0, 0, 0, 0.12);--mdc-extended-fab-container-shadow-color:#000}html[_ngcontent-%COMP%]   .mat-mdc-fab.mat-primary[_ngcontent-%COMP%]{--mdc-fab-container-color:#3f51b5;--mat-fab-foreground-color:white;--mat-fab-state-layer-color:white;--mat-fab-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-fab.mat-accent[_ngcontent-%COMP%]{--mdc-fab-container-color:#ff4081;--mat-fab-foreground-color:white;--mat-fab-state-layer-color:white;--mat-fab-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-fab.mat-warn[_ngcontent-%COMP%]{--mdc-fab-container-color:#f44336;--mat-fab-foreground-color:white;--mat-fab-state-layer-color:white;--mat-fab-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-mini-fab.mat-primary[_ngcontent-%COMP%]{--mdc-fab-small-container-color:#3f51b5;--mat-fab-small-foreground-color:white;--mat-fab-small-state-layer-color:white;--mat-fab-small-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-mini-fab.mat-accent[_ngcontent-%COMP%]{--mdc-fab-small-container-color:#ff4081;--mat-fab-small-foreground-color:white;--mat-fab-small-state-layer-color:white;--mat-fab-small-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]   .mat-mdc-mini-fab.mat-warn[_ngcontent-%COMP%]{--mdc-fab-small-container-color:#f44336;--mat-fab-small-foreground-color:white;--mat-fab-small-state-layer-color:white;--mat-fab-small-ripple-color:rgba(255, 255, 255, 0.1)}html[_ngcontent-%COMP%]{--mat-fab-touch-target-display:block;--mat-fab-small-touch-target-display:block}html[_ngcontent-%COMP%]{--mdc-extended-fab-label-text-font:Roboto, sans-serif;--mdc-extended-fab-label-text-size:14px;--mdc-extended-fab-label-text-tracking:0.0892857143em;--mdc-extended-fab-label-text-weight:500}html[_ngcontent-%COMP%]{--mdc-snackbar-container-shape:4px}html[_ngcontent-%COMP%]{--mdc-snackbar-container-color:#333333;--mdc-snackbar-supporting-text-color:rgba(255, 255, 255, 0.87);--mat-snack-bar-button-color:#ff4081}html[_ngcontent-%COMP%]{--mdc-snackbar-supporting-text-font:Roboto, sans-serif;--mdc-snackbar-supporting-text-line-height:20px;--mdc-snackbar-supporting-text-size:14px;--mdc-snackbar-supporting-text-weight:400}html[_ngcontent-%COMP%]{--mat-table-row-item-outline-width:1px}html[_ngcontent-%COMP%]{--mat-table-background-color:white;--mat-table-header-headline-color:rgba(0, 0, 0, 0.87);--mat-table-row-item-label-text-color:rgba(0, 0, 0, 0.87);--mat-table-row-item-outline-color:rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-table-header-container-height:56px;--mat-table-footer-container-height:52px;--mat-table-row-item-container-height:52px}html[_ngcontent-%COMP%]{--mat-table-header-headline-font:Roboto, sans-serif;--mat-table-header-headline-line-height:22px;--mat-table-header-headline-size:14px;--mat-table-header-headline-weight:500;--mat-table-header-headline-tracking:0.0071428571em;--mat-table-row-item-label-text-font:Roboto, sans-serif;--mat-table-row-item-label-text-line-height:20px;--mat-table-row-item-label-text-size:14px;--mat-table-row-item-label-text-weight:400;--mat-table-row-item-label-text-tracking:0.0178571429em;--mat-table-footer-supporting-text-font:Roboto, sans-serif;--mat-table-footer-supporting-text-line-height:20px;--mat-table-footer-supporting-text-size:14px;--mat-table-footer-supporting-text-weight:400;--mat-table-footer-supporting-text-tracking:0.0178571429em}html[_ngcontent-%COMP%]{--mdc-circular-progress-active-indicator-width:4px;--mdc-circular-progress-size:48px}html[_ngcontent-%COMP%]{--mdc-circular-progress-active-indicator-color:#3f51b5}html[_ngcontent-%COMP%]   .mat-accent[_ngcontent-%COMP%]{--mdc-circular-progress-active-indicator-color:#ff4081}html[_ngcontent-%COMP%]   .mat-warn[_ngcontent-%COMP%]{--mdc-circular-progress-active-indicator-color:#f44336}html[_ngcontent-%COMP%]{--mat-badge-container-shape:50%;--mat-badge-container-size:unset;--mat-badge-small-size-container-size:unset;--mat-badge-large-size-container-size:unset;--mat-badge-legacy-container-size:22px;--mat-badge-legacy-small-size-container-size:16px;--mat-badge-legacy-large-size-container-size:28px;--mat-badge-container-offset:-11px 0;--mat-badge-small-size-container-offset:-8px 0;--mat-badge-large-size-container-offset:-14px 0;--mat-badge-container-overlap-offset:-11px;--mat-badge-small-size-container-overlap-offset:-8px;--mat-badge-large-size-container-overlap-offset:-14px;--mat-badge-container-padding:0;--mat-badge-small-size-container-padding:0;--mat-badge-large-size-container-padding:0}html[_ngcontent-%COMP%]{--mat-badge-background-color:#3f51b5;--mat-badge-text-color:white;--mat-badge-disabled-state-background-color:#b9b9b9;--mat-badge-disabled-state-text-color:rgba(0, 0, 0, 0.38)}.mat-badge-accent[_ngcontent-%COMP%]{--mat-badge-background-color:#ff4081;--mat-badge-text-color:white}.mat-badge-warn[_ngcontent-%COMP%]{--mat-badge-background-color:#f44336;--mat-badge-text-color:white}html[_ngcontent-%COMP%]{--mat-badge-text-font:Roboto, sans-serif;--mat-badge-text-size:12px;--mat-badge-text-weight:600;--mat-badge-small-size-text-size:9px;--mat-badge-large-size-text-size:24px}html[_ngcontent-%COMP%]{--mat-bottom-sheet-container-shape:4px}html[_ngcontent-%COMP%]{--mat-bottom-sheet-container-text-color:rgba(0, 0, 0, 0.87);--mat-bottom-sheet-container-background-color:white}html[_ngcontent-%COMP%]{--mat-bottom-sheet-container-text-font:Roboto, sans-serif;--mat-bottom-sheet-container-text-line-height:20px;--mat-bottom-sheet-container-text-size:14px;--mat-bottom-sheet-container-text-tracking:0.0178571429em;--mat-bottom-sheet-container-text-weight:400}html[_ngcontent-%COMP%]{--mat-legacy-button-toggle-height:36px;--mat-legacy-button-toggle-shape:2px;--mat-legacy-button-toggle-focus-state-layer-opacity:1;--mat-standard-button-toggle-shape:4px;--mat-standard-button-toggle-hover-state-layer-opacity:0.04;--mat-standard-button-toggle-focus-state-layer-opacity:0.12}html[_ngcontent-%COMP%]{--mat-legacy-button-toggle-text-color:rgba(0, 0, 0, 0.38);--mat-legacy-button-toggle-state-layer-color:rgba(0, 0, 0, 0.12);--mat-legacy-button-toggle-selected-state-text-color:rgba(0, 0, 0, 0.54);--mat-legacy-button-toggle-selected-state-background-color:#e0e0e0;--mat-legacy-button-toggle-disabled-state-text-color:rgba(0, 0, 0, 0.26);--mat-legacy-button-toggle-disabled-state-background-color:#eeeeee;--mat-legacy-button-toggle-disabled-selected-state-background-color:#bdbdbd;--mat-standard-button-toggle-text-color:rgba(0, 0, 0, 0.87);--mat-standard-button-toggle-background-color:white;--mat-standard-button-toggle-state-layer-color:black;--mat-standard-button-toggle-selected-state-background-color:#e0e0e0;--mat-standard-button-toggle-selected-state-text-color:rgba(0, 0, 0, 0.87);--mat-standard-button-toggle-disabled-state-text-color:rgba(0, 0, 0, 0.26);--mat-standard-button-toggle-disabled-state-background-color:white;--mat-standard-button-toggle-disabled-selected-state-text-color:rgba(0, 0, 0, 0.87);--mat-standard-button-toggle-disabled-selected-state-background-color:#bdbdbd;--mat-standard-button-toggle-divider-color:#e0e0e0}html[_ngcontent-%COMP%]{--mat-standard-button-toggle-height:48px}html[_ngcontent-%COMP%]{--mat-legacy-button-toggle-label-text-font:Roboto, sans-serif;--mat-legacy-button-toggle-label-text-line-height:24px;--mat-legacy-button-toggle-label-text-size:16px;--mat-legacy-button-toggle-label-text-tracking:0.03125em;--mat-legacy-button-toggle-label-text-weight:400;--mat-standard-button-toggle-label-text-font:Roboto, sans-serif;--mat-standard-button-toggle-label-text-line-height:24px;--mat-standard-button-toggle-label-text-size:16px;--mat-standard-button-toggle-label-text-tracking:0.03125em;--mat-standard-button-toggle-label-text-weight:400}html[_ngcontent-%COMP%]{--mat-datepicker-calendar-container-shape:4px;--mat-datepicker-calendar-container-touch-shape:4px;--mat-datepicker-calendar-container-elevation-shadow:0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);--mat-datepicker-calendar-container-touch-elevation-shadow:0px 11px 15px -7px rgba(0, 0, 0, 0.2), 0px 24px 38px 3px rgba(0, 0, 0, 0.14), 0px 9px 46px 8px rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-datepicker-calendar-date-selected-state-text-color:white;--mat-datepicker-calendar-date-selected-state-background-color:#3f51b5;--mat-datepicker-calendar-date-selected-disabled-state-background-color:rgba(63, 81, 181, 0.4);--mat-datepicker-calendar-date-today-selected-state-outline-color:white;--mat-datepicker-calendar-date-focus-state-background-color:rgba(63, 81, 181, 0.3);--mat-datepicker-calendar-date-hover-state-background-color:rgba(63, 81, 181, 0.3);--mat-datepicker-toggle-active-state-icon-color:#3f51b5;--mat-datepicker-calendar-date-in-range-state-background-color:rgba(63, 81, 181, 0.2);--mat-datepicker-calendar-date-in-comparison-range-state-background-color:rgba(249, 171, 0, 0.2);--mat-datepicker-calendar-date-in-overlap-range-state-background-color:#a8dab5;--mat-datepicker-calendar-date-in-overlap-range-selected-state-background-color:#46a35e;--mat-datepicker-toggle-icon-color:rgba(0, 0, 0, 0.54);--mat-datepicker-calendar-body-label-text-color:rgba(0, 0, 0, 0.54);--mat-datepicker-calendar-period-button-text-color:black;--mat-datepicker-calendar-period-button-icon-color:rgba(0, 0, 0, 0.54);--mat-datepicker-calendar-navigation-button-icon-color:rgba(0, 0, 0, 0.54);--mat-datepicker-calendar-header-divider-color:rgba(0, 0, 0, 0.12);--mat-datepicker-calendar-header-text-color:rgba(0, 0, 0, 0.54);--mat-datepicker-calendar-date-today-outline-color:rgba(0, 0, 0, 0.38);--mat-datepicker-calendar-date-today-disabled-state-outline-color:rgba(0, 0, 0, 0.18);--mat-datepicker-calendar-date-text-color:rgba(0, 0, 0, 0.87);--mat-datepicker-calendar-date-outline-color:transparent;--mat-datepicker-calendar-date-disabled-state-text-color:rgba(0, 0, 0, 0.38);--mat-datepicker-calendar-date-preview-state-outline-color:rgba(0, 0, 0, 0.24);--mat-datepicker-range-input-separator-color:rgba(0, 0, 0, 0.87);--mat-datepicker-range-input-disabled-state-separator-color:rgba(0, 0, 0, 0.38);--mat-datepicker-range-input-disabled-state-text-color:rgba(0, 0, 0, 0.38);--mat-datepicker-calendar-container-background-color:white;--mat-datepicker-calendar-container-text-color:rgba(0, 0, 0, 0.87)}.mat-datepicker-content.mat-accent[_ngcontent-%COMP%]{--mat-datepicker-calendar-date-selected-state-text-color:white;--mat-datepicker-calendar-date-selected-state-background-color:#ff4081;--mat-datepicker-calendar-date-selected-disabled-state-background-color:rgba(255, 64, 129, 0.4);--mat-datepicker-calendar-date-today-selected-state-outline-color:white;--mat-datepicker-calendar-date-focus-state-background-color:rgba(255, 64, 129, 0.3);--mat-datepicker-calendar-date-hover-state-background-color:rgba(255, 64, 129, 0.3);--mat-datepicker-calendar-date-in-range-state-background-color:rgba(255, 64, 129, 0.2);--mat-datepicker-calendar-date-in-comparison-range-state-background-color:rgba(249, 171, 0, 0.2);--mat-datepicker-calendar-date-in-overlap-range-state-background-color:#a8dab5;--mat-datepicker-calendar-date-in-overlap-range-selected-state-background-color:#46a35e}.mat-datepicker-content.mat-warn[_ngcontent-%COMP%]{--mat-datepicker-calendar-date-selected-state-text-color:white;--mat-datepicker-calendar-date-selected-state-background-color:#f44336;--mat-datepicker-calendar-date-selected-disabled-state-background-color:rgba(244, 67, 54, 0.4);--mat-datepicker-calendar-date-today-selected-state-outline-color:white;--mat-datepicker-calendar-date-focus-state-background-color:rgba(244, 67, 54, 0.3);--mat-datepicker-calendar-date-hover-state-background-color:rgba(244, 67, 54, 0.3);--mat-datepicker-calendar-date-in-range-state-background-color:rgba(244, 67, 54, 0.2);--mat-datepicker-calendar-date-in-comparison-range-state-background-color:rgba(249, 171, 0, 0.2);--mat-datepicker-calendar-date-in-overlap-range-state-background-color:#a8dab5;--mat-datepicker-calendar-date-in-overlap-range-selected-state-background-color:#46a35e}.mat-datepicker-toggle-active.mat-accent[_ngcontent-%COMP%]{--mat-datepicker-toggle-active-state-icon-color:#ff4081}.mat-datepicker-toggle-active.mat-warn[_ngcontent-%COMP%]{--mat-datepicker-toggle-active-state-icon-color:#f44336}.mat-calendar-controls[_ngcontent-%COMP%]{--mat-icon-button-touch-target-display:none}.mat-calendar-controls[_ngcontent-%COMP%]   .mat-mdc-icon-button.mat-mdc-button-base[_ngcontent-%COMP%]{--mdc-icon-button-state-layer-size:40px;width:var(--mdc-icon-button-state-layer-size);height:var(--mdc-icon-button-state-layer-size);padding:8px}html[_ngcontent-%COMP%]{--mat-datepicker-calendar-text-font:Roboto, sans-serif;--mat-datepicker-calendar-text-size:13px;--mat-datepicker-calendar-body-label-text-size:14px;--mat-datepicker-calendar-body-label-text-weight:500;--mat-datepicker-calendar-period-button-text-size:14px;--mat-datepicker-calendar-period-button-text-weight:500;--mat-datepicker-calendar-header-text-size:11px;--mat-datepicker-calendar-header-text-weight:400}html[_ngcontent-%COMP%]{--mat-divider-width:1px}html[_ngcontent-%COMP%]{--mat-divider-color:rgba(0, 0, 0, 0.12)}html[_ngcontent-%COMP%]{--mat-expansion-container-shape:4px;--mat-expansion-legacy-header-indicator-display:inline-block;--mat-expansion-header-indicator-display:none}html[_ngcontent-%COMP%]{--mat-expansion-container-background-color:white;--mat-expansion-container-text-color:rgba(0, 0, 0, 0.87);--mat-expansion-actions-divider-color:rgba(0, 0, 0, 0.12);--mat-expansion-header-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-expansion-header-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-expansion-header-disabled-state-text-color:rgba(0, 0, 0, 0.26);--mat-expansion-header-text-color:rgba(0, 0, 0, 0.87);--mat-expansion-header-description-color:rgba(0, 0, 0, 0.54);--mat-expansion-header-indicator-color:rgba(0, 0, 0, 0.54)}html[_ngcontent-%COMP%]{--mat-expansion-header-collapsed-state-height:48px;--mat-expansion-header-expanded-state-height:64px}html[_ngcontent-%COMP%]{--mat-expansion-header-text-font:Roboto, sans-serif;--mat-expansion-header-text-size:14px;--mat-expansion-header-text-weight:500;--mat-expansion-header-text-line-height:inherit;--mat-expansion-header-text-tracking:inherit;--mat-expansion-container-text-font:Roboto, sans-serif;--mat-expansion-container-text-line-height:20px;--mat-expansion-container-text-size:14px;--mat-expansion-container-text-tracking:0.0178571429em;--mat-expansion-container-text-weight:400}html[_ngcontent-%COMP%]{--mat-grid-list-tile-header-primary-text-size:14px;--mat-grid-list-tile-header-secondary-text-size:12px;--mat-grid-list-tile-footer-primary-text-size:14px;--mat-grid-list-tile-footer-secondary-text-size:12px}html[_ngcontent-%COMP%]{--mat-icon-color:inherit}.mat-icon.mat-primary[_ngcontent-%COMP%]{--mat-icon-color:#3f51b5}.mat-icon.mat-accent[_ngcontent-%COMP%]{--mat-icon-color:#ff4081}.mat-icon.mat-warn[_ngcontent-%COMP%]{--mat-icon-color:#f44336}html[_ngcontent-%COMP%]{--mat-sidenav-container-shape:0;--mat-sidenav-container-elevation-shadow:0px 8px 10px -5px rgba(0, 0, 0, 0.2), 0px 16px 24px 2px rgba(0, 0, 0, 0.14), 0px 6px 30px 5px rgba(0, 0, 0, 0.12);--mat-sidenav-container-width:auto}html[_ngcontent-%COMP%]{--mat-sidenav-container-divider-color:rgba(0, 0, 0, 0.12);--mat-sidenav-container-background-color:white;--mat-sidenav-container-text-color:rgba(0, 0, 0, 0.87);--mat-sidenav-content-background-color:#fafafa;--mat-sidenav-content-text-color:rgba(0, 0, 0, 0.87);--mat-sidenav-scrim-color:rgba(0, 0, 0, 0.6)}html[_ngcontent-%COMP%]{--mat-stepper-header-icon-foreground-color:white;--mat-stepper-header-selected-state-icon-background-color:#3f51b5;--mat-stepper-header-selected-state-icon-foreground-color:white;--mat-stepper-header-done-state-icon-background-color:#3f51b5;--mat-stepper-header-done-state-icon-foreground-color:white;--mat-stepper-header-edit-state-icon-background-color:#3f51b5;--mat-stepper-header-edit-state-icon-foreground-color:white;--mat-stepper-container-color:white;--mat-stepper-line-color:rgba(0, 0, 0, 0.12);--mat-stepper-header-hover-state-layer-color:rgba(0, 0, 0, 0.04);--mat-stepper-header-focus-state-layer-color:rgba(0, 0, 0, 0.04);--mat-stepper-header-label-text-color:rgba(0, 0, 0, 0.54);--mat-stepper-header-optional-label-text-color:rgba(0, 0, 0, 0.54);--mat-stepper-header-selected-state-label-text-color:rgba(0, 0, 0, 0.87);--mat-stepper-header-error-state-label-text-color:#f44336;--mat-stepper-header-icon-background-color:rgba(0, 0, 0, 0.54);--mat-stepper-header-error-state-icon-foreground-color:#f44336;--mat-stepper-header-error-state-icon-background-color:transparent}html[_ngcontent-%COMP%]   .mat-step-header.mat-accent[_ngcontent-%COMP%]{--mat-stepper-header-icon-foreground-color:white;--mat-stepper-header-selected-state-icon-background-color:#ff4081;--mat-stepper-header-selected-state-icon-foreground-color:white;--mat-stepper-header-done-state-icon-background-color:#ff4081;--mat-stepper-header-done-state-icon-foreground-color:white;--mat-stepper-header-edit-state-icon-background-color:#ff4081;--mat-stepper-header-edit-state-icon-foreground-color:white}html[_ngcontent-%COMP%]   .mat-step-header.mat-warn[_ngcontent-%COMP%]{--mat-stepper-header-icon-foreground-color:white;--mat-stepper-header-selected-state-icon-background-color:#f44336;--mat-stepper-header-selected-state-icon-foreground-color:white;--mat-stepper-header-done-state-icon-background-color:#f44336;--mat-stepper-header-done-state-icon-foreground-color:white;--mat-stepper-header-edit-state-icon-background-color:#f44336;--mat-stepper-header-edit-state-icon-foreground-color:white}html[_ngcontent-%COMP%]{--mat-stepper-header-height:72px}html[_ngcontent-%COMP%]{--mat-stepper-container-text-font:Roboto, sans-serif;--mat-stepper-header-label-text-font:Roboto, sans-serif;--mat-stepper-header-label-text-size:14px;--mat-stepper-header-label-text-weight:400;--mat-stepper-header-error-state-label-text-size:16px;--mat-stepper-header-selected-state-label-text-size:16px;--mat-stepper-header-selected-state-label-text-weight:400}html[_ngcontent-%COMP%]{--mat-sort-arrow-color:#757575}html[_ngcontent-%COMP%]{--mat-toolbar-container-background-color:whitesmoke;--mat-toolbar-container-text-color:rgba(0, 0, 0, 0.87)}.mat-toolbar.mat-primary[_ngcontent-%COMP%]{--mat-toolbar-container-background-color:#3f51b5;--mat-toolbar-container-text-color:white}.mat-toolbar.mat-accent[_ngcontent-%COMP%]{--mat-toolbar-container-background-color:#ff4081;--mat-toolbar-container-text-color:white}.mat-toolbar.mat-warn[_ngcontent-%COMP%]{--mat-toolbar-container-background-color:#f44336;--mat-toolbar-container-text-color:white}html[_ngcontent-%COMP%]{--mat-toolbar-standard-height:64px;--mat-toolbar-mobile-height:56px}html[_ngcontent-%COMP%]{--mat-toolbar-title-text-font:Roboto, sans-serif;--mat-toolbar-title-text-line-height:32px;--mat-toolbar-title-text-size:20px;--mat-toolbar-title-text-tracking:0.0125em;--mat-toolbar-title-text-weight:500}html[_ngcontent-%COMP%]{--mat-tree-container-background-color:white;--mat-tree-node-text-color:rgba(0, 0, 0, 0.87)}html[_ngcontent-%COMP%]{--mat-tree-node-min-height:48px}html[_ngcontent-%COMP%]{--mat-tree-node-text-font:Roboto, sans-serif;--mat-tree-node-text-size:14px;--mat-tree-node-text-weight:400}.mat-h1[_ngcontent-%COMP%], .mat-headline-5[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-5[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%]{font:400 24px/32px Roboto, sans-serif;letter-spacing:normal;margin:0 0 16px}.mat-h2[_ngcontent-%COMP%], .mat-headline-6[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h2[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-6[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h2[_ngcontent-%COMP%]{font:500 20px/32px Roboto, sans-serif;letter-spacing:.0125em;margin:0 0 16px}.mat-h3[_ngcontent-%COMP%], .mat-subtitle-1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h3[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-subtitle-1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h3[_ngcontent-%COMP%]{font:400 16px/28px Roboto, sans-serif;letter-spacing:.009375em;margin:0 0 16px}.mat-h4[_ngcontent-%COMP%], .mat-body-1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h4[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body-1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h4[_ngcontent-%COMP%]{font:400 16px/24px Roboto, sans-serif;letter-spacing:.03125em;margin:0 0 16px}.mat-h5[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h5[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h5[_ngcontent-%COMP%]{font:400 calc(14px*.83)/20px Roboto, sans-serif;margin:0 0 12px}.mat-h6[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-h6[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   h6[_ngcontent-%COMP%]{font:400 calc(14px*.67)/20px Roboto, sans-serif;margin:0 0 12px}.mat-body-strong[_ngcontent-%COMP%], .mat-subtitle-2[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body-strong[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-subtitle-2[_ngcontent-%COMP%]{font:500 14px/22px Roboto, sans-serif;letter-spacing:.0071428571em}.mat-body[_ngcontent-%COMP%], .mat-body-2[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body-2[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]{font:400 14px/20px Roboto, sans-serif;letter-spacing:.0178571429em}.mat-body[_ngcontent-%COMP%]   p[_ngcontent-%COMP%], .mat-body-2[_ngcontent-%COMP%]   p[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body[_ngcontent-%COMP%]   p[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-body-2[_ngcontent-%COMP%]   p[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   p[_ngcontent-%COMP%]{margin:0 0 12px}.mat-small[_ngcontent-%COMP%], .mat-caption[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-small[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-caption[_ngcontent-%COMP%]{font:400 12px/20px Roboto, sans-serif;letter-spacing:.0333333333em}.mat-headline-1[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-1[_ngcontent-%COMP%]{font:300 96px/96px Roboto, sans-serif;letter-spacing:-0.015625em;margin:0 0 56px}.mat-headline-2[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-2[_ngcontent-%COMP%]{font:300 60px/60px Roboto, sans-serif;letter-spacing:-.0083333333em;margin:0 0 64px}.mat-headline-3[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-3[_ngcontent-%COMP%]{font:400 48px/50px Roboto, sans-serif;letter-spacing:normal;margin:0 0 64px}.mat-headline-4[_ngcontent-%COMP%], .mat-typography[_ngcontent-%COMP%]   .mat-headline-4[_ngcontent-%COMP%]{font:400 34px/40px Roboto, sans-serif;letter-spacing:.0073529412em;margin:0 0 64px}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL25vZGVfbW9kdWxlcy9AYW5ndWxhci9tYXRlcmlhbC9wcmVidWlsdC10aGVtZXMvaW5kaWdvLXBpbmsuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLFlBQVksZUFBZSxDQUFDLGlCQUFpQixDQUFDLHdCQUF3Qix1QkFBdUIsQ0FBQyxpQ0FBaUMsZ0JBQWdCLENBQUMsb0JBQW9CLGlCQUFpQixDQUFDLGlCQUFpQixDQUFDLG1CQUFtQixDQUFDLDJEQUEyRCxDQUFDLDBCQUEwQixDQUFDLDREQUE0RCxDQUFDLDhDQUE4QyxZQUFZLENBQUMscUJBQXFCLFFBQVEsQ0FBQyxrQkFBa0IsQ0FBQyxVQUFVLENBQUMsV0FBVyxDQUFDLGVBQWUsQ0FBQyxTQUFTLENBQUMsaUJBQWlCLENBQUMsU0FBUyxDQUFDLGtCQUFrQixDQUFDLFNBQVMsQ0FBQyx1QkFBdUIsQ0FBQyxvQkFBb0IsQ0FBQyxNQUFNLENBQUMsK0JBQStCLFNBQVMsQ0FBQyxPQUFPLENBQUMsbURBQW1ELG1CQUFtQixDQUFDLEtBQUssQ0FBQyxNQUFNLENBQUMsV0FBVyxDQUFDLFVBQVUsQ0FBQyx1QkFBdUIsY0FBYyxDQUFDLFlBQVksQ0FBQyw2QkFBNkIsWUFBWSxDQUFDLDRCQUE0QixZQUFZLENBQUMsaUJBQWlCLENBQUMsWUFBWSxDQUFDLGtCQUFrQixpQkFBaUIsQ0FBQyxtQkFBbUIsQ0FBQyxxQkFBcUIsQ0FBQyxZQUFZLENBQUMsWUFBWSxDQUFDLGNBQWMsQ0FBQyxlQUFlLENBQUMsc0JBQXNCLGlCQUFpQixDQUFDLEtBQUssQ0FBQyxRQUFRLENBQUMsTUFBTSxDQUFDLE9BQU8sQ0FBQyxZQUFZLENBQUMsbUJBQW1CLENBQUMseUNBQXlDLENBQUMseURBQXlELENBQUMsU0FBUyxDQUFDLG1EQUFtRCxTQUFTLENBQUMsNkVBQTZFLFVBQVUsQ0FBQywyQkFBMkIsMEJBQTBCLENBQUMsa0NBQWtDLG1EQUFtRCxDQUFDLGlCQUFpQixDQUFDLFNBQVMsQ0FBQywr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MkMsQ0FBQyw4Q0FBOEMsQ0FBQyxLQUFLLCtCQUErQixDQUFDLEtBQUssNENBQTRDLENBQUMsOEJBQThCLENBQUMsK0JBQStCLENBQUMsbUdBQW1HLHFDQUFxQyxDQUFDLHFCQUFxQixDQUFDLGVBQWUsQ0FBQyxtR0FBbUcscUNBQXFDLENBQUMsc0JBQXNCLENBQUMsZUFBZSxDQUFDLG1HQUFtRyxxQ0FBcUMsQ0FBQyx3QkFBd0IsQ0FBQyxlQUFlLENBQUMsMkZBQTJGLHFDQUFxQyxDQUFDLHVCQUF1QixDQUFDLGVBQWUsQ0FBQyxtREFBbUQsK0NBQStDLENBQUMsZUFBZSxDQUFDLG1EQUFtRCwrQ0FBK0MsQ0FBQyxlQUFlLENBQUMsa0dBQWtHLHFDQUFxQyxDQUFDLDRCQUE0QixDQUFDLDRGQUE0RixxQ0FBcUMsQ0FBQyw0QkFBNEIsQ0FBQyxzR0FBc0csZUFBZSxDQUFDLGdGQUFnRixxQ0FBcUMsQ0FBQyw0QkFBNEIsQ0FBQyxnREFBZ0QscUNBQXFDLENBQUMsMEJBQTBCLENBQUMsZUFBZSxDQUFDLGdEQUFnRCxxQ0FBcUMsQ0FBQyw2QkFBNkIsQ0FBQyxlQUFlLENBQUMsZ0RBQWdELHFDQUFxQyxDQUFDLHFCQUFxQixDQUFDLGVBQWUsQ0FBQyxnREFBZ0QscUNBQXFDLENBQUMsNEJBQTRCLENBQUMsZUFBZSIsInNvdXJjZXNDb250ZW50IjpbIi5tYXQtcmlwcGxle292ZXJmbG93OmhpZGRlbjtwb3NpdGlvbjpyZWxhdGl2ZX0ubWF0LXJpcHBsZTpub3QoOmVtcHR5KXt0cmFuc2Zvcm06dHJhbnNsYXRlWigwKX0ubWF0LXJpcHBsZS5tYXQtcmlwcGxlLXVuYm91bmRlZHtvdmVyZmxvdzp2aXNpYmxlfS5tYXQtcmlwcGxlLWVsZW1lbnR7cG9zaXRpb246YWJzb2x1dGU7Ym9yZGVyLXJhZGl1czo1MCU7cG9pbnRlci1ldmVudHM6bm9uZTt0cmFuc2l0aW9uOm9wYWNpdHksdHJhbnNmb3JtIDBtcyBjdWJpYy1iZXppZXIoMCwgMCwgMC4yLCAxKTt0cmFuc2Zvcm06c2NhbGUzZCgwLCAwLCAwKTtiYWNrZ3JvdW5kLWNvbG9yOnZhcigtLW1hdC1yaXBwbGUtY29sb3IsIHJnYmEoMCwgMCwgMCwgMC4xKSl9LmNkay1oaWdoLWNvbnRyYXN0LWFjdGl2ZSAubWF0LXJpcHBsZS1lbGVtZW50e2Rpc3BsYXk6bm9uZX0uY2RrLXZpc3VhbGx5LWhpZGRlbntib3JkZXI6MDtjbGlwOnJlY3QoMCAwIDAgMCk7aGVpZ2h0OjFweDttYXJnaW46LTFweDtvdmVyZmxvdzpoaWRkZW47cGFkZGluZzowO3Bvc2l0aW9uOmFic29sdXRlO3dpZHRoOjFweDt3aGl0ZS1zcGFjZTpub3dyYXA7b3V0bGluZTowOy13ZWJraXQtYXBwZWFyYW5jZTpub25lOy1tb3otYXBwZWFyYW5jZTpub25lO2xlZnQ6MH1bZGlyPXJ0bF0gLmNkay12aXN1YWxseS1oaWRkZW57bGVmdDphdXRvO3JpZ2h0OjB9LmNkay1vdmVybGF5LWNvbnRhaW5lciwuY2RrLWdsb2JhbC1vdmVybGF5LXdyYXBwZXJ7cG9pbnRlci1ldmVudHM6bm9uZTt0b3A6MDtsZWZ0OjA7aGVpZ2h0OjEwMCU7d2lkdGg6MTAwJX0uY2RrLW92ZXJsYXktY29udGFpbmVye3Bvc2l0aW9uOmZpeGVkO3otaW5kZXg6MTAwMH0uY2RrLW92ZXJsYXktY29udGFpbmVyOmVtcHR5e2Rpc3BsYXk6bm9uZX0uY2RrLWdsb2JhbC1vdmVybGF5LXdyYXBwZXJ7ZGlzcGxheTpmbGV4O3Bvc2l0aW9uOmFic29sdXRlO3otaW5kZXg6MTAwMH0uY2RrLW92ZXJsYXktcGFuZXtwb3NpdGlvbjphYnNvbHV0ZTtwb2ludGVyLWV2ZW50czphdXRvO2JveC1zaXppbmc6Ym9yZGVyLWJveDt6LWluZGV4OjEwMDA7ZGlzcGxheTpmbGV4O21heC13aWR0aDoxMDAlO21heC1oZWlnaHQ6MTAwJX0uY2RrLW92ZXJsYXktYmFja2Ryb3B7cG9zaXRpb246YWJzb2x1dGU7dG9wOjA7Ym90dG9tOjA7bGVmdDowO3JpZ2h0OjA7ei1pbmRleDoxMDAwO3BvaW50ZXItZXZlbnRzOmF1dG87LXdlYmtpdC10YXAtaGlnaGxpZ2h0LWNvbG9yOnJnYmEoMCwwLDAsMCk7dHJhbnNpdGlvbjpvcGFjaXR5IDQwMG1zIGN1YmljLWJlemllcigwLjI1LCAwLjgsIDAuMjUsIDEpO29wYWNpdHk6MH0uY2RrLW92ZXJsYXktYmFja2Ryb3AuY2RrLW92ZXJsYXktYmFja2Ryb3Atc2hvd2luZ3tvcGFjaXR5OjF9LmNkay1oaWdoLWNvbnRyYXN0LWFjdGl2ZSAuY2RrLW92ZXJsYXktYmFja2Ryb3AuY2RrLW92ZXJsYXktYmFja2Ryb3Atc2hvd2luZ3tvcGFjaXR5Oi42fS5jZGstb3ZlcmxheS1kYXJrLWJhY2tkcm9we2JhY2tncm91bmQ6cmdiYSgwLDAsMCwuMzIpfS5jZGstb3ZlcmxheS10cmFuc3BhcmVudC1iYWNrZHJvcHt0cmFuc2l0aW9uOnZpc2liaWxpdHkgMW1zIGxpbmVhcixvcGFjaXR5IDFtcyBsaW5lYXI7dmlzaWJpbGl0eTpoaWRkZW47b3BhY2l0eToxfS5jZGstb3ZlcmxheS10cmFuc3BhcmVudC1iYWNrZHJvcC5jZGstb3ZlcmxheS1iYWNrZHJvcC1zaG93aW5ne29wYWNpdHk6MDt2aXNpYmlsaXR5OnZpc2libGV9LmNkay1vdmVybGF5LWJhY2tkcm9wLW5vb3AtYW5pbWF0aW9ue3RyYW5zaXRpb246bm9uZX0uY2RrLW92ZXJsYXktY29ubmVjdGVkLXBvc2l0aW9uLWJvdW5kaW5nLWJveHtwb3NpdGlvbjphYnNvbHV0ZTt6LWluZGV4OjEwMDA7ZGlzcGxheTpmbGV4O2ZsZXgtZGlyZWN0aW9uOmNvbHVtbjttaW4td2lkdGg6MXB4O21pbi1oZWlnaHQ6MXB4fS5jZGstZ2xvYmFsLXNjcm9sbGJsb2Nre3Bvc2l0aW9uOmZpeGVkO3dpZHRoOjEwMCU7b3ZlcmZsb3cteTpzY3JvbGx9dGV4dGFyZWEuY2RrLXRleHRhcmVhLWF1dG9zaXple3Jlc2l6ZTpub25lfXRleHRhcmVhLmNkay10ZXh0YXJlYS1hdXRvc2l6ZS1tZWFzdXJpbmd7cGFkZGluZzoycHggMCAhaW1wb3J0YW50O2JveC1zaXppbmc6Y29udGVudC1ib3ggIWltcG9ydGFudDtoZWlnaHQ6YXV0byAhaW1wb3J0YW50O292ZXJmbG93OmhpZGRlbiAhaW1wb3J0YW50fXRleHRhcmVhLmNkay10ZXh0YXJlYS1hdXRvc2l6ZS1tZWFzdXJpbmctZmlyZWZveHtwYWRkaW5nOjJweCAwICFpbXBvcnRhbnQ7Ym94LXNpemluZzpjb250ZW50LWJveCAhaW1wb3J0YW50O2hlaWdodDowICFpbXBvcnRhbnR9QGtleWZyYW1lcyBjZGstdGV4dC1maWVsZC1hdXRvZmlsbC1zdGFydHsvKiEqL31Aa2V5ZnJhbWVzIGNkay10ZXh0LWZpZWxkLWF1dG9maWxsLWVuZHsvKiEqL30uY2RrLXRleHQtZmllbGQtYXV0b2ZpbGwtbW9uaXRvcmVkOi13ZWJraXQtYXV0b2ZpbGx7YW5pbWF0aW9uOmNkay10ZXh0LWZpZWxkLWF1dG9maWxsLXN0YXJ0IDBzIDFtc30uY2RrLXRleHQtZmllbGQtYXV0b2ZpbGwtbW9uaXRvcmVkOm5vdCg6LXdlYmtpdC1hdXRvZmlsbCl7YW5pbWF0aW9uOmNkay10ZXh0LWZpZWxkLWF1dG9maWxsLWVuZCAwcyAxbXN9Lm1hdC1mb2N1cy1pbmRpY2F0b3J7cG9zaXRpb246cmVsYXRpdmV9Lm1hdC1mb2N1cy1pbmRpY2F0b3I6OmJlZm9yZXt0b3A6MDtsZWZ0OjA7cmlnaHQ6MDtib3R0b206MDtwb3NpdGlvbjphYnNvbHV0ZTtib3gtc2l6aW5nOmJvcmRlci1ib3g7cG9pbnRlci1ldmVudHM6bm9uZTtkaXNwbGF5OnZhcigtLW1hdC1mb2N1cy1pbmRpY2F0b3ItZGlzcGxheSwgbm9uZSk7Ym9yZGVyOnZhcigtLW1hdC1mb2N1cy1pbmRpY2F0b3ItYm9yZGVyLXdpZHRoLCAzcHgpIHZhcigtLW1hdC1mb2N1cy1pbmRpY2F0b3ItYm9yZGVyLXN0eWxlLCBzb2xpZCkgdmFyKC0tbWF0LWZvY3VzLWluZGljYXRvci1ib3JkZXItY29sb3IsIHRyYW5zcGFyZW50KTtib3JkZXItcmFkaXVzOnZhcigtLW1hdC1mb2N1cy1pbmRpY2F0b3ItYm9yZGVyLXJhZGl1cywgNHB4KX0ubWF0LWZvY3VzLWluZGljYXRvcjpmb2N1czo6YmVmb3Jle2NvbnRlbnQ6XCJcIn0uY2RrLWhpZ2gtY29udHJhc3QtYWN0aXZley0tbWF0LWZvY3VzLWluZGljYXRvci1kaXNwbGF5OiBibG9ja30ubWF0LW1kYy1mb2N1cy1pbmRpY2F0b3J7cG9zaXRpb246cmVsYXRpdmV9Lm1hdC1tZGMtZm9jdXMtaW5kaWNhdG9yOjpiZWZvcmV7dG9wOjA7bGVmdDowO3JpZ2h0OjA7Ym90dG9tOjA7cG9zaXRpb246YWJzb2x1dGU7Ym94LXNpemluZzpib3JkZXItYm94O3BvaW50ZXItZXZlbnRzOm5vbmU7ZGlzcGxheTp2YXIoLS1tYXQtbWRjLWZvY3VzLWluZGljYXRvci1kaXNwbGF5LCBub25lKTtib3JkZXI6dmFyKC0tbWF0LW1kYy1mb2N1cy1pbmRpY2F0b3ItYm9yZGVyLXdpZHRoLCAzcHgpIHZhcigtLW1hdC1tZGMtZm9jdXMtaW5kaWNhdG9yLWJvcmRlci1zdHlsZSwgc29saWQpIHZhcigtLW1hdC1tZGMtZm9jdXMtaW5kaWNhdG9yLWJvcmRlci1jb2xvciwgdHJhbnNwYXJlbnQpO2JvcmRlci1yYWRpdXM6dmFyKC0tbWF0LW1kYy1mb2N1cy1pbmRpY2F0b3ItYm9yZGVyLXJhZGl1cywgNHB4KX0ubWF0LW1kYy1mb2N1cy1pbmRpY2F0b3I6Zm9jdXM6OmJlZm9yZXtjb250ZW50OlwiXCJ9LmNkay1oaWdoLWNvbnRyYXN0LWFjdGl2ZXstLW1hdC1tZGMtZm9jdXMtaW5kaWNhdG9yLWRpc3BsYXk6IGJsb2NrfS5tYXQtYXBwLWJhY2tncm91bmR7YmFja2dyb3VuZC1jb2xvcjp2YXIoLS1tYXQtYXBwLWJhY2tncm91bmQtY29sb3IsIHRyYW5zcGFyZW50KTtjb2xvcjp2YXIoLS1tYXQtYXBwLXRleHQtY29sb3IsIGluaGVyaXQpfWh0bWx7LS1tYXQtcmlwcGxlLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKX1odG1sey0tbWF0LW9wdGlvbi1zZWxlY3RlZC1zdGF0ZS1sYWJlbC10ZXh0LWNvbG9yOiMzZjUxYjU7LS1tYXQtb3B0aW9uLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1vcHRpb24taG92ZXItc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KTstLW1hdC1vcHRpb24tZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KTstLW1hdC1vcHRpb24tc2VsZWN0ZWQtc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KX0ubWF0LWFjY2VudHstLW1hdC1vcHRpb24tc2VsZWN0ZWQtc3RhdGUtbGFiZWwtdGV4dC1jb2xvcjojZmY0MDgxOy0tbWF0LW9wdGlvbi1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtb3B0aW9uLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNCk7LS1tYXQtb3B0aW9uLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNCk7LS1tYXQtb3B0aW9uLXNlbGVjdGVkLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNCl9Lm1hdC13YXJuey0tbWF0LW9wdGlvbi1zZWxlY3RlZC1zdGF0ZS1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tYXQtb3B0aW9uLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1vcHRpb24taG92ZXItc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KTstLW1hdC1vcHRpb24tZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KTstLW1hdC1vcHRpb24tc2VsZWN0ZWQtc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KX1odG1sey0tbWF0LW9wdGdyb3VwLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX0ubWF0LXByaW1hcnl7LS1tYXQtZnVsbC1wc2V1ZG8tY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjojYjBiMGIwOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6I2IwYjBiMDstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6IzNmNTFiNTstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2IwYjBiMH1odG1sey0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXNlbGVjdGVkLWljb24tY29sb3I6I2ZmNDA4MTstLW1hdC1mdWxsLXBzZXVkby1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2ZhZmFmYTstLW1hdC1mdWxsLXBzZXVkby1jaGVja2JveC11bnNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1hdC1mdWxsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2ZhZmFmYTstLW1hdC1mdWxsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6I2IwYjBiMDstLW1hdC1mdWxsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1pY29uLWNvbG9yOiNiMGIwYjA7LS1tYXQtbWluaW1hbC1wc2V1ZG8tY2hlY2tib3gtc2VsZWN0ZWQtY2hlY2ttYXJrLWNvbG9yOiNmZjQwODE7LS1tYXQtbWluaW1hbC1wc2V1ZG8tY2hlY2tib3gtZGlzYWJsZWQtc2VsZWN0ZWQtY2hlY2ttYXJrLWNvbG9yOiNiMGIwYjB9Lm1hdC1hY2NlbnR7LS1tYXQtZnVsbC1wc2V1ZG8tY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojZmY0MDgxOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjojYjBiMGIwOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6I2IwYjBiMDstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2ZmNDA4MTstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2IwYjBiMH0ubWF0LXdhcm57LS1tYXQtZnVsbC1wc2V1ZG8tY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmFmYWZhOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjojYjBiMGIwOy0tbWF0LWZ1bGwtcHNldWRvLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6I2IwYjBiMDstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2Y0NDMzNjstLW1hdC1taW5pbWFsLXBzZXVkby1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6I2IwYjBiMH1odG1sey0tbWF0LWFwcC1iYWNrZ3JvdW5kLWNvbG9yOiNmYWZhZmE7LS1tYXQtYXBwLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX0ubWF0LWVsZXZhdGlvbi16MCwubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16MHtib3gtc2hhZG93OjBweCAwcHggMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAwcHggMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMHB4IDBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKX0ubWF0LWVsZXZhdGlvbi16MSwubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16MXtib3gtc2hhZG93OjBweCAycHggMXB4IC0xcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMXB4IDFweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCAzcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejIsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejJ7Ym94LXNoYWRvdzowcHggM3B4IDFweCAtMnB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDJweCAycHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAxcHggNXB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpfS5tYXQtZWxldmF0aW9uLXozLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoze2JveC1zaGFkb3c6MHB4IDNweCAzcHggLTJweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAzcHggNHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDhweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKX0ubWF0LWVsZXZhdGlvbi16NCwubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16NHtib3gtc2hhZG93OjBweCAycHggNHB4IC0xcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggNHB4IDVweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCAxMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpfS5tYXQtZWxldmF0aW9uLXo1LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXo1e2JveC1zaGFkb3c6MHB4IDNweCA1cHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCA1cHggOHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDE0cHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejYsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejZ7Ym94LXNoYWRvdzowcHggM3B4IDVweCAtMXB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDZweCAxMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDE4cHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejcsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejd7Ym94LXNoYWRvdzowcHggNHB4IDVweCAtMnB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDdweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMnB4IDE2cHggMXB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejgsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejh7Ym94LXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejksLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejl7Ym94LXNoYWRvdzowcHggNXB4IDZweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDlweCAxMnB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE2cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejEwLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxMHtib3gtc2hhZG93OjBweCA2cHggNnB4IC0zcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTBweCAxNHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNHB4IDE4cHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejExLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxMXtib3gtc2hhZG93OjBweCA2cHggN3B4IC00cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTFweCAxNXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNHB4IDIwcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejEyLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxMntib3gtc2hhZG93OjBweCA3cHggOHB4IC00cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTJweCAxN3B4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNXB4IDIycHggNHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejEzLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxM3tib3gtc2hhZG93OjBweCA3cHggOHB4IC00cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTNweCAxOXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNXB4IDI0cHggNHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejE0LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxNHtib3gtc2hhZG93OjBweCA3cHggOXB4IC00cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTRweCAyMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNXB4IDI2cHggNHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejE1LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxNXtib3gtc2hhZG93OjBweCA4cHggOXB4IC01cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTVweCAyMnB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNnB4IDI4cHggNXB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejE2LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxNntib3gtc2hhZG93OjBweCA4cHggMTBweCAtNXB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDE2cHggMjRweCAycHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDZweCAzMHB4IDVweCByZ2JhKDAsIDAsIDAsIDAuMTIpfS5tYXQtZWxldmF0aW9uLXoxNywubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16MTd7Ym94LXNoYWRvdzowcHggOHB4IDExcHggLTVweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAxN3B4IDI2cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCA2cHggMzJweCA1cHggcmdiYSgwLCAwLCAwLCAwLjEyKX0ubWF0LWVsZXZhdGlvbi16MTgsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejE4e2JveC1zaGFkb3c6MHB4IDlweCAxMXB4IC01cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMThweCAyOHB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggN3B4IDM0cHggNnB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejE5LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoxOXtib3gtc2hhZG93OjBweCA5cHggMTJweCAtNnB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDE5cHggMjlweCAycHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDdweCAzNnB4IDZweCByZ2JhKDAsIDAsIDAsIDAuMTIpfS5tYXQtZWxldmF0aW9uLXoyMCwubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16MjB7Ym94LXNoYWRvdzowcHggMTBweCAxM3B4IC02cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMjBweCAzMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggOHB4IDM4cHggN3B4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejIxLC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoyMXtib3gtc2hhZG93OjBweCAxMHB4IDEzcHggLTZweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAyMXB4IDMzcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCA4cHggNDBweCA3cHggcmdiYSgwLCAwLCAwLCAwLjEyKX0ubWF0LWVsZXZhdGlvbi16MjIsLm1hdC1tZGMtZWxldmF0aW9uLXNwZWNpZmljLm1hdC1lbGV2YXRpb24tejIye2JveC1zaGFkb3c6MHB4IDEwcHggMTRweCAtNnB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDIycHggMzVweCAzcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDhweCA0MnB4IDdweCByZ2JhKDAsIDAsIDAsIDAuMTIpfS5tYXQtZWxldmF0aW9uLXoyMywubWF0LW1kYy1lbGV2YXRpb24tc3BlY2lmaWMubWF0LWVsZXZhdGlvbi16MjN7Ym94LXNoYWRvdzowcHggMTFweCAxNHB4IC03cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMjNweCAzNnB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggOXB4IDQ0cHggOHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9Lm1hdC1lbGV2YXRpb24tejI0LC5tYXQtbWRjLWVsZXZhdGlvbi1zcGVjaWZpYy5tYXQtZWxldmF0aW9uLXoyNHtib3gtc2hhZG93OjBweCAxMXB4IDE1cHggLTdweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAyNHB4IDM4cHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCA5cHggNDZweCA4cHggcmdiYSgwLCAwLCAwLCAwLjEyKX0ubWF0LXRoZW1lLWxvYWRlZC1tYXJrZXJ7ZGlzcGxheTpub25lfWh0bWx7LS1tYXQtb3B0aW9uLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtb3B0aW9uLWxhYmVsLXRleHQtbGluZS1oZWlnaHQ6MjRweDstLW1hdC1vcHRpb24tbGFiZWwtdGV4dC1zaXplOjE2cHg7LS1tYXQtb3B0aW9uLWxhYmVsLXRleHQtdHJhY2tpbmc6MC4wMzEyNWVtOy0tbWF0LW9wdGlvbi1sYWJlbC10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1hdC1vcHRncm91cC1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LW9wdGdyb3VwLWxhYmVsLXRleHQtbGluZS1oZWlnaHQ6MjRweDstLW1hdC1vcHRncm91cC1sYWJlbC10ZXh0LXNpemU6MTZweDstLW1hdC1vcHRncm91cC1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDMxMjVlbTstLW1hdC1vcHRncm91cC1sYWJlbC10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1kYy1lbGV2YXRlZC1jYXJkLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tZGMtb3V0bGluZWQtY2FyZC1jb250YWluZXItc2hhcGU6NHB4Oy0tbWRjLW91dGxpbmVkLWNhcmQtb3V0bGluZS13aWR0aDoxcHh9aHRtbHstLW1kYy1lbGV2YXRlZC1jYXJkLWNvbnRhaW5lci1jb2xvcjp3aGl0ZTstLW1kYy1lbGV2YXRlZC1jYXJkLWNvbnRhaW5lci1lbGV2YXRpb246MHB4IDJweCAxcHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAxcHggMXB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDNweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1vdXRsaW5lZC1jYXJkLWNvbnRhaW5lci1jb2xvcjp3aGl0ZTstLW1kYy1vdXRsaW5lZC1jYXJkLW91dGxpbmUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1vdXRsaW5lZC1jYXJkLWNvbnRhaW5lci1lbGV2YXRpb246MHB4IDBweCAwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDBweCAwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAwcHggMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWF0LWNhcmQtc3VidGl0bGUtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpfWh0bWx7LS1tYXQtY2FyZC10aXRsZS10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LWNhcmQtdGl0bGUtdGV4dC1saW5lLWhlaWdodDozMnB4Oy0tbWF0LWNhcmQtdGl0bGUtdGV4dC1zaXplOjIwcHg7LS1tYXQtY2FyZC10aXRsZS10ZXh0LXRyYWNraW5nOjAuMDEyNWVtOy0tbWF0LWNhcmQtdGl0bGUtdGV4dC13ZWlnaHQ6NTAwOy0tbWF0LWNhcmQtc3VidGl0bGUtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC1jYXJkLXN1YnRpdGxlLXRleHQtbGluZS1oZWlnaHQ6MjJweDstLW1hdC1jYXJkLXN1YnRpdGxlLXRleHQtc2l6ZToxNHB4Oy0tbWF0LWNhcmQtc3VidGl0bGUtdGV4dC10cmFja2luZzowLjAwNzE0Mjg1NzFlbTstLW1hdC1jYXJkLXN1YnRpdGxlLXRleHQtd2VpZ2h0OjUwMH1odG1sey0tbWRjLWxpbmVhci1wcm9ncmVzcy1hY3RpdmUtaW5kaWNhdG9yLWhlaWdodDo0cHg7LS1tZGMtbGluZWFyLXByb2dyZXNzLXRyYWNrLWhlaWdodDo0cHg7LS1tZGMtbGluZWFyLXByb2dyZXNzLXRyYWNrLXNoYXBlOjB9Lm1hdC1tZGMtcHJvZ3Jlc3MtYmFyey0tbWRjLWxpbmVhci1wcm9ncmVzcy1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiMzZjUxYjU7LS1tZGMtbGluZWFyLXByb2dyZXNzLXRyYWNrLWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuMjUpfS5tYXQtbWRjLXByb2dyZXNzLWJhci5tYXQtYWNjZW50ey0tbWRjLWxpbmVhci1wcm9ncmVzcy1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiNmZjQwODE7LS1tZGMtbGluZWFyLXByb2dyZXNzLXRyYWNrLWNvbG9yOnJnYmEoMjU1LCA2NCwgMTI5LCAwLjI1KX0ubWF0LW1kYy1wcm9ncmVzcy1iYXIubWF0LXdhcm57LS1tZGMtbGluZWFyLXByb2dyZXNzLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6I2Y0NDMzNjstLW1kYy1saW5lYXItcHJvZ3Jlc3MtdHJhY2stY29sb3I6cmdiYSgyNDQsIDY3LCA1NCwgMC4yNSl9aHRtbHstLW1kYy1wbGFpbi10b29sdGlwLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tZGMtcGxhaW4tdG9vbHRpcC1zdXBwb3J0aW5nLXRleHQtbGluZS1oZWlnaHQ6MTZweH1odG1sey0tbWRjLXBsYWluLXRvb2x0aXAtY29udGFpbmVyLWNvbG9yOiM2MTYxNjE7LS1tZGMtcGxhaW4tdG9vbHRpcC1zdXBwb3J0aW5nLXRleHQtY29sb3I6I2ZmZn1odG1sey0tbWRjLXBsYWluLXRvb2x0aXAtc3VwcG9ydGluZy10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLXBsYWluLXRvb2x0aXAtc3VwcG9ydGluZy10ZXh0LXNpemU6MTJweDstLW1kYy1wbGFpbi10b29sdGlwLXN1cHBvcnRpbmctdGV4dC13ZWlnaHQ6NDAwOy0tbWRjLXBsYWluLXRvb2x0aXAtc3VwcG9ydGluZy10ZXh0LXRyYWNraW5nOjAuMDMzMzMzMzMzM2VtfWh0bWx7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtYWN0aXZlLWluZGljYXRvci1oZWlnaHQ6MXB4Oy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWZvY3VzLWFjdGl2ZS1pbmRpY2F0b3ItaGVpZ2h0OjJweDstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1jb250YWluZXItc2hhcGU6NHB4Oy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtb3V0bGluZS13aWR0aDoxcHg7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1mb2N1cy1vdXRsaW5lLXdpZHRoOjJweDstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWNvbnRhaW5lci1zaGFwZTo0cHh9aHRtbHstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1jYXJldC1jb2xvcjojM2Y1MWI1Oy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWZvY3VzLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6IzNmNTFiNTstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuODcpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWNvbnRhaW5lci1jb2xvcjp3aGl0ZXNtb2tlOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWRpc2FibGVkLWNvbnRhaW5lci1jb2xvcjojZmFmYWZhOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWhvdmVyLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWRpc2FibGVkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1pbnB1dC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtZGlzYWJsZWQtaW5wdXQtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWlucHV0LXRleHQtcGxhY2Vob2xkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWVycm9yLWhvdmVyLWxhYmVsLXRleHQtY29sb3I6I2Y0NDMzNjstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1lcnJvci1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtZXJyb3ItbGFiZWwtdGV4dC1jb2xvcjojZjQ0MzM2Oy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWVycm9yLWNhcmV0LWNvbG9yOiNmNDQzMzY7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtYWN0aXZlLWluZGljYXRvci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNDIpOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWRpc2FibGVkLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA2KTstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1ob3Zlci1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtZXJyb3ItYWN0aXZlLWluZGljYXRvci1jb2xvcjojZjQ0MzM2Oy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWVycm9yLWZvY3VzLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6I2Y0NDMzNjstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1lcnJvci1ob3Zlci1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1jYXJldC1jb2xvcjojM2Y1MWI1Oy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtZm9jdXMtb3V0bGluZS1jb2xvcjojM2Y1MWI1Oy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDYzLCA4MSwgMTgxLCAwLjg3KTstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtaG92ZXItbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNik7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1kaXNhYmxlZC1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1pbnB1dC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1kaXNhYmxlZC1pbnB1dC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1pbnB1dC10ZXh0LXBsYWNlaG9sZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWVycm9yLWNhcmV0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1ob3Zlci1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1kaXNhYmxlZC1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNik7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1ob3Zlci1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1mb2N1cy1vdXRsaW5lLWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1ob3Zlci1vdXRsaW5lLWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1lcnJvci1vdXRsaW5lLWNvbG9yOiNmNDQzMzY7LS1tYXQtZm9ybS1maWVsZC1mb2N1cy1zZWxlY3QtYXJyb3ctY29sb3I6cmdiYSg2MywgODEsIDE4MSwgMC44Nyk7LS1tYXQtZm9ybS1maWVsZC1kaXNhYmxlZC1pbnB1dC10ZXh0LXBsYWNlaG9sZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tYXQtZm9ybS1maWVsZC1zdGF0ZS1sYXllci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuODcpOy0tbWF0LWZvcm0tZmllbGQtZXJyb3ItdGV4dC1jb2xvcjojZjQ0MzM2Oy0tbWF0LWZvcm0tZmllbGQtc2VsZWN0LW9wdGlvbi10ZXh0LWNvbG9yOmluaGVyaXQ7LS1tYXQtZm9ybS1maWVsZC1zZWxlY3QtZGlzYWJsZWQtb3B0aW9uLXRleHQtY29sb3I6R3JheVRleHQ7LS1tYXQtZm9ybS1maWVsZC1sZWFkaW5nLWljb24tY29sb3I6dW5zZXQ7LS1tYXQtZm9ybS1maWVsZC1kaXNhYmxlZC1sZWFkaW5nLWljb24tY29sb3I6dW5zZXQ7LS1tYXQtZm9ybS1maWVsZC10cmFpbGluZy1pY29uLWNvbG9yOnVuc2V0Oy0tbWF0LWZvcm0tZmllbGQtZGlzYWJsZWQtdHJhaWxpbmctaWNvbi1jb2xvcjp1bnNldDstLW1hdC1mb3JtLWZpZWxkLWVycm9yLWZvY3VzLXRyYWlsaW5nLWljb24tY29sb3I6dW5zZXQ7LS1tYXQtZm9ybS1maWVsZC1lcnJvci1ob3Zlci10cmFpbGluZy1pY29uLWNvbG9yOnVuc2V0Oy0tbWF0LWZvcm0tZmllbGQtZXJyb3ItdHJhaWxpbmctaWNvbi1jb2xvcjp1bnNldDstLW1hdC1mb3JtLWZpZWxkLWVuYWJsZWQtc2VsZWN0LWFycm93LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tYXQtZm9ybS1maWVsZC1kaXNhYmxlZC1zZWxlY3QtYXJyb3ctY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC1mb3JtLWZpZWxkLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1hdC1mb3JtLWZpZWxkLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wOH0ubWF0LW1kYy1mb3JtLWZpZWxkLm1hdC1hY2NlbnR7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtY2FyZXQtY29sb3I6I2ZmNDA4MTstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1mb2N1cy1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiNmZjQwODE7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC44Nyk7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1jYXJldC1jb2xvcjojZmY0MDgxOy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtZm9jdXMtb3V0bGluZS1jb2xvcjojZmY0MDgxOy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC44Nyk7LS1tYXQtZm9ybS1maWVsZC1mb2N1cy1zZWxlY3QtYXJyb3ctY29sb3I6cmdiYSgyNTUsIDY0LCAxMjksIDAuODcpfS5tYXQtbWRjLWZvcm0tZmllbGQubWF0LXdhcm57LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtY2FyZXQtY29sb3I6I2Y0NDMzNjstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1mb2N1cy1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiNmNDQzMzY7LS1tZGMtZmlsbGVkLXRleHQtZmllbGQtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDI0NCwgNjcsIDU0LCAwLjg3KTstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWNhcmV0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1mb2N1cy1vdXRsaW5lLWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuODcpOy0tbWF0LWZvcm0tZmllbGQtZm9jdXMtc2VsZWN0LWFycm93LWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuODcpfWh0bWx7LS1tYXQtZm9ybS1maWVsZC1jb250YWluZXItaGVpZ2h0OjU2cHg7LS1tYXQtZm9ybS1maWVsZC1maWxsZWQtbGFiZWwtZGlzcGxheTpibG9jazstLW1hdC1mb3JtLWZpZWxkLWNvbnRhaW5lci12ZXJ0aWNhbC1wYWRkaW5nOjE2cHg7LS1tYXQtZm9ybS1maWVsZC1maWxsZWQtd2l0aC1sYWJlbC1jb250YWluZXItcGFkZGluZy10b3A6MjRweDstLW1hdC1mb3JtLWZpZWxkLWZpbGxlZC13aXRoLWxhYmVsLWNvbnRhaW5lci1wYWRkaW5nLWJvdHRvbTo4cHh9aHRtbHstLW1kYy1maWxsZWQtdGV4dC1maWVsZC1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtc2l6ZToxNnB4Oy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtdHJhY2tpbmc6MC4wMzEyNWVtOy0tbWRjLWZpbGxlZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtd2VpZ2h0OjQwMDstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tZGMtb3V0bGluZWQtdGV4dC1maWVsZC1sYWJlbC10ZXh0LXNpemU6MTZweDstLW1kYy1vdXRsaW5lZC10ZXh0LWZpZWxkLWxhYmVsLXRleHQtdHJhY2tpbmc6MC4wMzEyNWVtOy0tbWRjLW91dGxpbmVkLXRleHQtZmllbGQtbGFiZWwtdGV4dC13ZWlnaHQ6NDAwOy0tbWF0LWZvcm0tZmllbGQtY29udGFpbmVyLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtZm9ybS1maWVsZC1jb250YWluZXItdGV4dC1saW5lLWhlaWdodDoyNHB4Oy0tbWF0LWZvcm0tZmllbGQtY29udGFpbmVyLXRleHQtc2l6ZToxNnB4Oy0tbWF0LWZvcm0tZmllbGQtY29udGFpbmVyLXRleHQtdHJhY2tpbmc6MC4wMzEyNWVtOy0tbWF0LWZvcm0tZmllbGQtY29udGFpbmVyLXRleHQtd2VpZ2h0OjQwMDstLW1hdC1mb3JtLWZpZWxkLW91dGxpbmVkLWxhYmVsLXRleHQtcG9wdWxhdGVkLXNpemU6MTZweDstLW1hdC1mb3JtLWZpZWxkLXN1YnNjcmlwdC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LWZvcm0tZmllbGQtc3Vic2NyaXB0LXRleHQtbGluZS1oZWlnaHQ6MjBweDstLW1hdC1mb3JtLWZpZWxkLXN1YnNjcmlwdC10ZXh0LXNpemU6MTJweDstLW1hdC1mb3JtLWZpZWxkLXN1YnNjcmlwdC10ZXh0LXRyYWNraW5nOjAuMDMzMzMzMzMzM2VtOy0tbWF0LWZvcm0tZmllbGQtc3Vic2NyaXB0LXRleHQtd2VpZ2h0OjQwMH1odG1sey0tbWF0LXNlbGVjdC1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMil9aHRtbHstLW1hdC1zZWxlY3QtcGFuZWwtYmFja2dyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1zZWxlY3QtZW5hYmxlZC10cmlnZ2VyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1zZWxlY3QtZGlzYWJsZWQtdHJpZ2dlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tYXQtc2VsZWN0LXBsYWNlaG9sZGVyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWF0LXNlbGVjdC1lbmFibGVkLWFycm93LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tYXQtc2VsZWN0LWRpc2FibGVkLWFycm93LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tYXQtc2VsZWN0LWZvY3VzZWQtYXJyb3ctY29sb3I6cmdiYSg2MywgODEsIDE4MSwgMC44Nyk7LS1tYXQtc2VsZWN0LWludmFsaWQtYXJyb3ctY29sb3I6cmdiYSgyNDQsIDY3LCA1NCwgMC44Nyl9aHRtbCAubWF0LW1kYy1mb3JtLWZpZWxkLm1hdC1hY2NlbnR7LS1tYXQtc2VsZWN0LXBhbmVsLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc2VsZWN0LWVuYWJsZWQtdHJpZ2dlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtc2VsZWN0LWRpc2FibGVkLXRyaWdnZXItdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LXNlbGVjdC1wbGFjZWhvbGRlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1hdC1zZWxlY3QtZW5hYmxlZC1hcnJvdy1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LXNlbGVjdC1kaXNhYmxlZC1hcnJvdy1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LXNlbGVjdC1mb2N1c2VkLWFycm93LWNvbG9yOnJnYmEoMjU1LCA2NCwgMTI5LCAwLjg3KTstLW1hdC1zZWxlY3QtaW52YWxpZC1hcnJvdy1jb2xvcjpyZ2JhKDI0NCwgNjcsIDU0LCAwLjg3KX1odG1sIC5tYXQtbWRjLWZvcm0tZmllbGQubWF0LXdhcm57LS1tYXQtc2VsZWN0LXBhbmVsLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc2VsZWN0LWVuYWJsZWQtdHJpZ2dlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtc2VsZWN0LWRpc2FibGVkLXRyaWdnZXItdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LXNlbGVjdC1wbGFjZWhvbGRlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1hdC1zZWxlY3QtZW5hYmxlZC1hcnJvdy1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LXNlbGVjdC1kaXNhYmxlZC1hcnJvdy1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LXNlbGVjdC1mb2N1c2VkLWFycm93LWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuODcpOy0tbWF0LXNlbGVjdC1pbnZhbGlkLWFycm93LWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuODcpfWh0bWx7LS1tYXQtc2VsZWN0LWFycm93LXRyYW5zZm9ybTp0cmFuc2xhdGVZKC04cHgpfWh0bWx7LS1tYXQtc2VsZWN0LXRyaWdnZXItdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC1zZWxlY3QtdHJpZ2dlci10ZXh0LWxpbmUtaGVpZ2h0OjI0cHg7LS1tYXQtc2VsZWN0LXRyaWdnZXItdGV4dC1zaXplOjE2cHg7LS1tYXQtc2VsZWN0LXRyaWdnZXItdGV4dC10cmFja2luZzowLjAzMTI1ZW07LS1tYXQtc2VsZWN0LXRyaWdnZXItdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tYXQtYXV0b2NvbXBsZXRlLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tYXQtYXV0b2NvbXBsZXRlLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCA1cHggNXB4IC0zcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggOHB4IDEwcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAzcHggMTRweCAycHggcmdiYSgwLCAwLCAwLCAwLjEyKX1odG1sey0tbWF0LWF1dG9jb21wbGV0ZS1iYWNrZ3JvdW5kLWNvbG9yOndoaXRlfWh0bWx7LS1tZGMtZGlhbG9nLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCAxMXB4IDE1cHggLTdweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAyNHB4IDM4cHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCA5cHggNDZweCA4cHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1kaWFsb2ctY29udGFpbmVyLXNoYWRvdy1jb2xvcjojMDAwOy0tbWRjLWRpYWxvZy1jb250YWluZXItc2hhcGU6NHB4Oy0tbWF0LWRpYWxvZy1jb250YWluZXItbWF4LXdpZHRoOjgwdnc7LS1tYXQtZGlhbG9nLWNvbnRhaW5lci1zbWFsbC1tYXgtd2lkdGg6ODB2dzstLW1hdC1kaWFsb2ctY29udGFpbmVyLW1pbi13aWR0aDowOy0tbWF0LWRpYWxvZy1hY3Rpb25zLWFsaWdubWVudDpzdGFydDstLW1hdC1kaWFsb2ctYWN0aW9ucy1wYWRkaW5nOjhweDstLW1hdC1kaWFsb2ctY29udGVudC1wYWRkaW5nOjIwcHggMjRweDstLW1hdC1kaWFsb2ctd2l0aC1hY3Rpb25zLWNvbnRlbnQtcGFkZGluZzoyMHB4IDI0cHg7LS1tYXQtZGlhbG9nLWhlYWRsaW5lLXBhZGRpbmc6MCAyNHB4IDlweH1odG1sey0tbWRjLWRpYWxvZy1jb250YWluZXItY29sb3I6d2hpdGU7LS1tZGMtZGlhbG9nLXN1YmhlYWQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1kYy1kaWFsb2ctc3VwcG9ydGluZy10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KX1odG1sey0tbWRjLWRpYWxvZy1zdWJoZWFkLWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLWRpYWxvZy1zdWJoZWFkLWxpbmUtaGVpZ2h0OjMycHg7LS1tZGMtZGlhbG9nLXN1YmhlYWQtc2l6ZToyMHB4Oy0tbWRjLWRpYWxvZy1zdWJoZWFkLXdlaWdodDo1MDA7LS1tZGMtZGlhbG9nLXN1YmhlYWQtdHJhY2tpbmc6MC4wMTI1ZW07LS1tZGMtZGlhbG9nLXN1cHBvcnRpbmctdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1kaWFsb2ctc3VwcG9ydGluZy10ZXh0LWxpbmUtaGVpZ2h0OjI0cHg7LS1tZGMtZGlhbG9nLXN1cHBvcnRpbmctdGV4dC1zaXplOjE2cHg7LS1tZGMtZGlhbG9nLXN1cHBvcnRpbmctdGV4dC13ZWlnaHQ6NDAwOy0tbWRjLWRpYWxvZy1zdXBwb3J0aW5nLXRleHQtdHJhY2tpbmc6MC4wMzEyNWVtfS5tYXQtbWRjLXN0YW5kYXJkLWNoaXB7LS1tZGMtY2hpcC1jb250YWluZXItc2hhcGUtZmFtaWx5OnJvdW5kZWQ7LS1tZGMtY2hpcC1jb250YWluZXItc2hhcGUtcmFkaXVzOjE2cHggMTZweCAxNnB4IDE2cHg7LS1tZGMtY2hpcC13aXRoLWF2YXRhci1hdmF0YXItc2hhcGUtZmFtaWx5OnJvdW5kZWQ7LS1tZGMtY2hpcC13aXRoLWF2YXRhci1hdmF0YXItc2hhcGUtcmFkaXVzOjE0cHggMTRweCAxNHB4IDE0cHg7LS1tZGMtY2hpcC13aXRoLWF2YXRhci1hdmF0YXItc2l6ZToyOHB4Oy0tbWRjLWNoaXAtd2l0aC1pY29uLWljb24tc2l6ZToxOHB4Oy0tbWRjLWNoaXAtb3V0bGluZS13aWR0aDowOy0tbWRjLWNoaXAtb3V0bGluZS1jb2xvcjp0cmFuc3BhcmVudDstLW1kYy1jaGlwLWRpc2FibGVkLW91dGxpbmUtY29sb3I6dHJhbnNwYXJlbnQ7LS1tZGMtY2hpcC1mb2N1cy1vdXRsaW5lLWNvbG9yOnRyYW5zcGFyZW50Oy0tbWRjLWNoaXAtaG92ZXItc3RhdGUtbGF5ZXItb3BhY2l0eTowLjA0Oy0tbWRjLWNoaXAtd2l0aC1hdmF0YXItZGlzYWJsZWQtYXZhdGFyLW9wYWNpdHk6MTstLW1kYy1jaGlwLWZsYXQtc2VsZWN0ZWQtb3V0bGluZS13aWR0aDowOy0tbWRjLWNoaXAtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItb3BhY2l0eTowLjA0Oy0tbWRjLWNoaXAtd2l0aC10cmFpbGluZy1pY29uLWRpc2FibGVkLXRyYWlsaW5nLWljb24tb3BhY2l0eToxOy0tbWRjLWNoaXAtd2l0aC1pY29uLWRpc2FibGVkLWljb24tb3BhY2l0eToxOy0tbWF0LWNoaXAtZGlzYWJsZWQtY29udGFpbmVyLW9wYWNpdHk6MC40Oy0tbWF0LWNoaXAtdHJhaWxpbmctYWN0aW9uLW9wYWNpdHk6MC41NDstLW1hdC1jaGlwLXRyYWlsaW5nLWFjdGlvbi1mb2N1cy1vcGFjaXR5OjE7LS1tYXQtY2hpcC10cmFpbGluZy1hY3Rpb24tc3RhdGUtbGF5ZXItY29sb3I6dHJhbnNwYXJlbnQ7LS1tYXQtY2hpcC1zZWxlY3RlZC10cmFpbGluZy1hY3Rpb24tc3RhdGUtbGF5ZXItY29sb3I6dHJhbnNwYXJlbnQ7LS1tYXQtY2hpcC10cmFpbGluZy1hY3Rpb24taG92ZXItc3RhdGUtbGF5ZXItb3BhY2l0eTowOy0tbWF0LWNoaXAtdHJhaWxpbmctYWN0aW9uLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MH0ubWF0LW1kYy1zdGFuZGFyZC1jaGlwey0tbWRjLWNoaXAtZGlzYWJsZWQtbGFiZWwtdGV4dC1jb2xvcjojMjEyMTIxOy0tbWRjLWNoaXAtZWxldmF0ZWQtY29udGFpbmVyLWNvbG9yOiNlMGUwZTA7LS1tZGMtY2hpcC1lbGV2YXRlZC1zZWxlY3RlZC1jb250YWluZXItY29sb3I6I2UwZTBlMDstLW1kYy1jaGlwLWVsZXZhdGVkLWRpc2FibGVkLWNvbnRhaW5lci1jb2xvcjojZTBlMGUwOy0tbWRjLWNoaXAtZmxhdC1kaXNhYmxlZC1zZWxlY3RlZC1jb250YWluZXItY29sb3I6I2UwZTBlMDstLW1kYy1jaGlwLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hpcC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1kYy1jaGlwLXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLWNoaXAtbGFiZWwtdGV4dC1jb2xvcjojMjEyMTIxOy0tbWRjLWNoaXAtc2VsZWN0ZWQtbGFiZWwtdGV4dC1jb2xvcjojMjEyMTIxOy0tbWRjLWNoaXAtd2l0aC1pY29uLWljb24tY29sb3I6IzIxMjEyMTstLW1kYy1jaGlwLXdpdGgtaWNvbi1kaXNhYmxlZC1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtY2hpcC13aXRoLWljb24tc2VsZWN0ZWQtaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoaXAtd2l0aC10cmFpbGluZy1pY29uLWRpc2FibGVkLXRyYWlsaW5nLWljb24tY29sb3I6IzIxMjEyMTstLW1kYy1jaGlwLXdpdGgtdHJhaWxpbmctaWNvbi10cmFpbGluZy1pY29uLWNvbG9yOiMyMTIxMjE7LS1tYXQtY2hpcC1zZWxlY3RlZC1kaXNhYmxlZC10cmFpbGluZy1pY29uLWNvbG9yOiMyMTIxMjE7LS1tYXQtY2hpcC1zZWxlY3RlZC10cmFpbGluZy1pY29uLWNvbG9yOiMyMTIxMjF9Lm1hdC1tZGMtc3RhbmRhcmQtY2hpcC5tYXQtbWRjLWNoaXAtc2VsZWN0ZWQubWF0LXByaW1hcnksLm1hdC1tZGMtc3RhbmRhcmQtY2hpcC5tYXQtbWRjLWNoaXAtaGlnaGxpZ2h0ZWQubWF0LXByaW1hcnl7LS1tZGMtY2hpcC1kaXNhYmxlZC1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtZWxldmF0ZWQtY29udGFpbmVyLWNvbG9yOiMzZjUxYjU7LS1tZGMtY2hpcC1lbGV2YXRlZC1zZWxlY3RlZC1jb250YWluZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGlwLWVsZXZhdGVkLWRpc2FibGVkLWNvbnRhaW5lci1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoaXAtZmxhdC1kaXNhYmxlZC1zZWxlY3RlZC1jb250YWluZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGlwLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hpcC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1kYy1jaGlwLXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLWNoaXAtbGFiZWwtdGV4dC1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLXNlbGVjdGVkLWxhYmVsLXRleHQtY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLWljb24taWNvbi1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLXdpdGgtaWNvbi1kaXNhYmxlZC1pY29uLWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtd2l0aC1pY29uLXNlbGVjdGVkLWljb24tY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLXRyYWlsaW5nLWljb24tZGlzYWJsZWQtdHJhaWxpbmctaWNvbi1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLXdpdGgtdHJhaWxpbmctaWNvbi10cmFpbGluZy1pY29uLWNvbG9yOndoaXRlOy0tbWF0LWNoaXAtc2VsZWN0ZWQtZGlzYWJsZWQtdHJhaWxpbmctaWNvbi1jb2xvcjp3aGl0ZTstLW1hdC1jaGlwLXNlbGVjdGVkLXRyYWlsaW5nLWljb24tY29sb3I6d2hpdGV9Lm1hdC1tZGMtc3RhbmRhcmQtY2hpcC5tYXQtbWRjLWNoaXAtc2VsZWN0ZWQubWF0LWFjY2VudCwubWF0LW1kYy1zdGFuZGFyZC1jaGlwLm1hdC1tZGMtY2hpcC1oaWdobGlnaHRlZC5tYXQtYWNjZW50ey0tbWRjLWNoaXAtZGlzYWJsZWQtbGFiZWwtdGV4dC1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLWVsZXZhdGVkLWNvbnRhaW5lci1jb2xvcjojZmY0MDgxOy0tbWRjLWNoaXAtZWxldmF0ZWQtc2VsZWN0ZWQtY29udGFpbmVyLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hpcC1lbGV2YXRlZC1kaXNhYmxlZC1jb250YWluZXItY29sb3I6I2ZmNDA4MTstLW1kYy1jaGlwLWZsYXQtZGlzYWJsZWQtc2VsZWN0ZWQtY29udGFpbmVyLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hpcC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hpcC1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTI7LS1tZGMtY2hpcC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1kYy1jaGlwLWxhYmVsLXRleHQtY29sb3I6d2hpdGU7LS1tZGMtY2hpcC1zZWxlY3RlZC1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtd2l0aC1pY29uLWljb24tY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLWljb24tZGlzYWJsZWQtaWNvbi1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLXdpdGgtaWNvbi1zZWxlY3RlZC1pY29uLWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtd2l0aC10cmFpbGluZy1pY29uLWRpc2FibGVkLXRyYWlsaW5nLWljb24tY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLXRyYWlsaW5nLWljb24tdHJhaWxpbmctaWNvbi1jb2xvcjp3aGl0ZTstLW1hdC1jaGlwLXNlbGVjdGVkLWRpc2FibGVkLXRyYWlsaW5nLWljb24tY29sb3I6d2hpdGU7LS1tYXQtY2hpcC1zZWxlY3RlZC10cmFpbGluZy1pY29uLWNvbG9yOndoaXRlfS5tYXQtbWRjLXN0YW5kYXJkLWNoaXAubWF0LW1kYy1jaGlwLXNlbGVjdGVkLm1hdC13YXJuLC5tYXQtbWRjLXN0YW5kYXJkLWNoaXAubWF0LW1kYy1jaGlwLWhpZ2hsaWdodGVkLm1hdC13YXJuey0tbWRjLWNoaXAtZGlzYWJsZWQtbGFiZWwtdGV4dC1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLWVsZXZhdGVkLWNvbnRhaW5lci1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoaXAtZWxldmF0ZWQtc2VsZWN0ZWQtY29udGFpbmVyLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hpcC1lbGV2YXRlZC1kaXNhYmxlZC1jb250YWluZXItY29sb3I6I2Y0NDMzNjstLW1kYy1jaGlwLWZsYXQtZGlzYWJsZWQtc2VsZWN0ZWQtY29udGFpbmVyLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hpcC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoaXAtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hpcC1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTI7LS1tZGMtY2hpcC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGlwLXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1kYy1jaGlwLWxhYmVsLXRleHQtY29sb3I6d2hpdGU7LS1tZGMtY2hpcC1zZWxlY3RlZC1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtd2l0aC1pY29uLWljb24tY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLWljb24tZGlzYWJsZWQtaWNvbi1jb2xvcjp3aGl0ZTstLW1kYy1jaGlwLXdpdGgtaWNvbi1zZWxlY3RlZC1pY29uLWNvbG9yOndoaXRlOy0tbWRjLWNoaXAtd2l0aC10cmFpbGluZy1pY29uLWRpc2FibGVkLXRyYWlsaW5nLWljb24tY29sb3I6d2hpdGU7LS1tZGMtY2hpcC13aXRoLXRyYWlsaW5nLWljb24tdHJhaWxpbmctaWNvbi1jb2xvcjp3aGl0ZTstLW1hdC1jaGlwLXNlbGVjdGVkLWRpc2FibGVkLXRyYWlsaW5nLWljb24tY29sb3I6d2hpdGU7LS1tYXQtY2hpcC1zZWxlY3RlZC10cmFpbGluZy1pY29uLWNvbG9yOndoaXRlfS5tYXQtbWRjLWNoaXAubWF0LW1kYy1zdGFuZGFyZC1jaGlwey0tbWRjLWNoaXAtY29udGFpbmVyLWhlaWdodDozMnB4fS5tYXQtbWRjLXN0YW5kYXJkLWNoaXB7LS1tZGMtY2hpcC1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLWNoaXAtbGFiZWwtdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWRjLWNoaXAtbGFiZWwtdGV4dC1zaXplOjE0cHg7LS1tZGMtY2hpcC1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDE3ODU3MTQyOWVtOy0tbWRjLWNoaXAtbGFiZWwtdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tZGMtc3dpdGNoLWRpc2FibGVkLXNlbGVjdGVkLWljb24tb3BhY2l0eTowLjM4Oy0tbWRjLXN3aXRjaC1kaXNhYmxlZC10cmFjay1vcGFjaXR5OjAuMTI7LS1tZGMtc3dpdGNoLWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1vcGFjaXR5OjAuMzg7LS1tZGMtc3dpdGNoLWhhbmRsZS1oZWlnaHQ6MjBweDstLW1kYy1zd2l0Y2gtaGFuZGxlLXNoYXBlOjEwcHg7LS1tZGMtc3dpdGNoLWhhbmRsZS13aWR0aDoyMHB4Oy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1pY29uLXNpemU6MThweDstLW1kYy1zd2l0Y2gtdHJhY2staGVpZ2h0OjE0cHg7LS1tZGMtc3dpdGNoLXRyYWNrLXNoYXBlOjdweDstLW1kYy1zd2l0Y2gtdHJhY2std2lkdGg6MzZweDstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1pY29uLXNpemU6MThweDstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMDQ7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjE7LS1tZGMtc3dpdGNoLXVuc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLXN3aXRjaC11bnNlbGVjdGVkLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xOy0tbWF0LXN3aXRjaC1kaXNhYmxlZC1zZWxlY3RlZC1oYW5kbGUtb3BhY2l0eTowLjM4Oy0tbWF0LXN3aXRjaC1kaXNhYmxlZC11bnNlbGVjdGVkLWhhbmRsZS1vcGFjaXR5OjAuMzg7LS1tYXQtc3dpdGNoLXVuc2VsZWN0ZWQtaGFuZGxlLXNpemU6MjBweDstLW1hdC1zd2l0Y2gtc2VsZWN0ZWQtaGFuZGxlLXNpemU6MjBweDstLW1hdC1zd2l0Y2gtcHJlc3NlZC1oYW5kbGUtc2l6ZToyMHB4Oy0tbWF0LXN3aXRjaC13aXRoLWljb24taGFuZGxlLXNpemU6MjBweDstLW1hdC1zd2l0Y2gtc2VsZWN0ZWQtaGFuZGxlLWhvcml6b250YWwtbWFyZ2luOjA7LS1tYXQtc3dpdGNoLXNlbGVjdGVkLXdpdGgtaWNvbi1oYW5kbGUtaG9yaXpvbnRhbC1tYXJnaW46MDstLW1hdC1zd2l0Y2gtc2VsZWN0ZWQtcHJlc3NlZC1oYW5kbGUtaG9yaXpvbnRhbC1tYXJnaW46MDstLW1hdC1zd2l0Y2gtdW5zZWxlY3RlZC1oYW5kbGUtaG9yaXpvbnRhbC1tYXJnaW46MDstLW1hdC1zd2l0Y2gtdW5zZWxlY3RlZC13aXRoLWljb24taGFuZGxlLWhvcml6b250YWwtbWFyZ2luOjA7LS1tYXQtc3dpdGNoLXVuc2VsZWN0ZWQtcHJlc3NlZC1oYW5kbGUtaG9yaXpvbnRhbC1tYXJnaW46MDstLW1hdC1zd2l0Y2gtdmlzaWJsZS10cmFjay1vcGFjaXR5OjE7LS1tYXQtc3dpdGNoLWhpZGRlbi10cmFjay1vcGFjaXR5OjE7LS1tYXQtc3dpdGNoLXZpc2libGUtdHJhY2stdHJhbnNpdGlvbjp0cmFuc2Zvcm0gNzVtcyAwbXMgY3ViaWMtYmV6aWVyKDAsIDAsIDAuMiwgMSk7LS1tYXQtc3dpdGNoLWhpZGRlbi10cmFjay10cmFuc2l0aW9uOnRyYW5zZm9ybSA3NW1zIDBtcyBjdWJpYy1iZXppZXIoMC40LCAwLCAwLjYsIDEpOy0tbWF0LXN3aXRjaC10cmFjay1vdXRsaW5lLXdpZHRoOjFweDstLW1hdC1zd2l0Y2gtdHJhY2stb3V0bGluZS1jb2xvcjp0cmFuc3BhcmVudDstLW1hdC1zd2l0Y2gtc2VsZWN0ZWQtdHJhY2stb3V0bGluZS13aWR0aDoxcHg7LS1tYXQtc3dpdGNoLWRpc2FibGVkLXVuc2VsZWN0ZWQtdHJhY2stb3V0bGluZS13aWR0aDoxcHg7LS1tYXQtc3dpdGNoLWRpc2FibGVkLXVuc2VsZWN0ZWQtdHJhY2stb3V0bGluZS1jb2xvcjp0cmFuc3BhcmVudH1odG1sey0tbWRjLXN3aXRjaC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjojMzk0OWFiOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1oYW5kbGUtY29sb3I6IzM5NDlhYjstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6IzM5NDlhYjstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1jb2xvcjojMzk0OWFiOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1mb2N1cy1oYW5kbGUtY29sb3I6IzFhMjM3ZTstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtaG92ZXItaGFuZGxlLWNvbG9yOiMxYTIzN2U7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtaGFuZGxlLWNvbG9yOiMxYTIzN2U7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWZvY3VzLXRyYWNrLWNvbG9yOiM3OTg2Y2I7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWhvdmVyLXRyYWNrLWNvbG9yOiM3OTg2Y2I7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtdHJhY2stY29sb3I6Izc5ODZjYjstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtdHJhY2stY29sb3I6Izc5ODZjYjstLW1kYy1zd2l0Y2gtZGlzYWJsZWQtc2VsZWN0ZWQtaGFuZGxlLWNvbG9yOiM0MjQyNDI7LS1tZGMtc3dpdGNoLWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6I2ZmZjstLW1kYy1zd2l0Y2gtZGlzYWJsZWQtc2VsZWN0ZWQtdHJhY2stY29sb3I6IzQyNDI0MjstLW1kYy1zd2l0Y2gtZGlzYWJsZWQtdW5zZWxlY3RlZC1oYW5kbGUtY29sb3I6IzQyNDI0MjstLW1kYy1zd2l0Y2gtZGlzYWJsZWQtdW5zZWxlY3RlZC1pY29uLWNvbG9yOiNmZmY7LS1tZGMtc3dpdGNoLWRpc2FibGVkLXVuc2VsZWN0ZWQtdHJhY2stY29sb3I6IzQyNDI0MjstLW1kYy1zd2l0Y2gtaGFuZGxlLXN1cmZhY2UtY29sb3I6dmFyKC0tbWRjLXRoZW1lLXN1cmZhY2UsICNmZmYpOy0tbWRjLXN3aXRjaC1oYW5kbGUtZWxldmF0aW9uLXNoYWRvdzowcHggMnB4IDFweCAtMXB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDFweCAxcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAxcHggM3B4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLXN3aXRjaC1oYW5kbGUtc2hhZG93LWNvbG9yOmJsYWNrOy0tbWRjLXN3aXRjaC1kaXNhYmxlZC1oYW5kbGUtZWxldmF0aW9uLXNoYWRvdzowcHggMHB4IDBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMHB4IDBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDBweCAwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWljb24tY29sb3I6I2ZmZjstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1mb2N1cy1oYW5kbGUtY29sb3I6IzIxMjEyMTstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjojNDI0MjQyOy0tbWRjLXN3aXRjaC11bnNlbGVjdGVkLWZvY3VzLXRyYWNrLWNvbG9yOiNlMGUwZTA7LS1tZGMtc3dpdGNoLXVuc2VsZWN0ZWQtaGFuZGxlLWNvbG9yOiM2MTYxNjE7LS1tZGMtc3dpdGNoLXVuc2VsZWN0ZWQtaG92ZXItaGFuZGxlLWNvbG9yOiMyMTIxMjE7LS1tZGMtc3dpdGNoLXVuc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6IzQyNDI0MjstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1ob3Zlci10cmFjay1jb2xvcjojZTBlMGUwOy0tbWRjLXN3aXRjaC11bnNlbGVjdGVkLWljb24tY29sb3I6I2ZmZjstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1wcmVzc2VkLWhhbmRsZS1jb2xvcjojMjEyMTIxOy0tbWRjLXN3aXRjaC11bnNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6IzQyNDI0MjstLW1kYy1zd2l0Y2gtdW5zZWxlY3RlZC1wcmVzc2VkLXRyYWNrLWNvbG9yOiNlMGUwZTA7LS1tZGMtc3dpdGNoLXVuc2VsZWN0ZWQtdHJhY2stY29sb3I6I2UwZTBlMDstLW1kYy1zd2l0Y2gtZGlzYWJsZWQtbGFiZWwtdGV4dC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjM4KX1odG1sIC5tYXQtbWRjLXNsaWRlLXRvZ2dsZXstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX1odG1sIC5tYXQtbWRjLXNsaWRlLXRvZ2dsZS5tYXQtYWNjZW50ey0tbWRjLXN3aXRjaC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjojZDgxYjYwOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1oYW5kbGUtY29sb3I6I2Q4MWI2MDstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6I2Q4MWI2MDstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1jb2xvcjojZDgxYjYwOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1mb2N1cy1oYW5kbGUtY29sb3I6Izg4MGU0ZjstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtaG92ZXItaGFuZGxlLWNvbG9yOiM4ODBlNGY7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtaGFuZGxlLWNvbG9yOiM4ODBlNGY7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWZvY3VzLXRyYWNrLWNvbG9yOiNmMDYyOTI7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWhvdmVyLXRyYWNrLWNvbG9yOiNmMDYyOTI7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtdHJhY2stY29sb3I6I2YwNjI5MjstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtdHJhY2stY29sb3I6I2YwNjI5Mn1odG1sIC5tYXQtbWRjLXNsaWRlLXRvZ2dsZS5tYXQtd2FybnstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6I2U1MzkzNTstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtaGFuZGxlLWNvbG9yOiNlNTM5MzU7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOiNlNTM5MzU7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6I2U1MzkzNTstLW1kYy1zd2l0Y2gtc2VsZWN0ZWQtZm9jdXMtaGFuZGxlLWNvbG9yOiNiNzFjMWM7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLWhvdmVyLWhhbmRsZS1jb2xvcjojYjcxYzFjOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1wcmVzc2VkLWhhbmRsZS1jb2xvcjojYjcxYzFjOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1mb2N1cy10cmFjay1jb2xvcjojZTU3MzczOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1ob3Zlci10cmFjay1jb2xvcjojZTU3MzczOy0tbWRjLXN3aXRjaC1zZWxlY3RlZC1wcmVzc2VkLXRyYWNrLWNvbG9yOiNlNTczNzM7LS1tZGMtc3dpdGNoLXNlbGVjdGVkLXRyYWNrLWNvbG9yOiNlNTczNzN9aHRtbHstLW1kYy1zd2l0Y2gtc3RhdGUtbGF5ZXItc2l6ZTo0MHB4fWh0bWwgLm1hdC1tZGMtc2xpZGUtdG9nZ2xley0tbWRjLWZvcm0tZmllbGQtbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtbGluZS1oZWlnaHQ6MjBweDstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWRjLWZvcm0tZmllbGQtbGFiZWwtdGV4dC10cmFja2luZzowLjAxNzg1NzE0MjllbTstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtd2VpZ2h0OjQwMH1odG1sey0tbWRjLXJhZGlvLWRpc2FibGVkLXNlbGVjdGVkLWljb24tb3BhY2l0eTowLjM4Oy0tbWRjLXJhZGlvLWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1vcGFjaXR5OjAuMzg7LS1tZGMtcmFkaW8tc3RhdGUtbGF5ZXItc2l6ZTo0MHB4fS5tYXQtbWRjLXJhZGlvLWJ1dHRvbnstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX0ubWF0LW1kYy1yYWRpby1idXR0b24ubWF0LXByaW1hcnl7LS1tZGMtcmFkaW8tZGlzYWJsZWQtc2VsZWN0ZWQtaWNvbi1jb2xvcjpibGFjazstLW1kYy1yYWRpby1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6YmxhY2s7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1yYWRpby1zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiMzZjUxYjU7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLXJhZGlvLXNlbGVjdGVkLWljb24tY29sb3I6IzNmNTFiNTstLW1kYy1yYWRpby1zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6IzNmNTFiNTstLW1hdC1yYWRpby1yaXBwbGUtY29sb3I6YmxhY2s7LS1tYXQtcmFkaW8tY2hlY2tlZC1yaXBwbGUtY29sb3I6IzNmNTFiNTstLW1hdC1yYWRpby1kaXNhYmxlZC1sYWJlbC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpfS5tYXQtbWRjLXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50ey0tbWRjLXJhZGlvLWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6YmxhY2s7LS1tZGMtcmFkaW8tZGlzYWJsZWQtdW5zZWxlY3RlZC1pY29uLWNvbG9yOmJsYWNrOy0tbWRjLXJhZGlvLXVuc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLXJhZGlvLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLXJhZGlvLXVuc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojZmY0MDgxOy0tbWRjLXJhZGlvLXNlbGVjdGVkLWhvdmVyLWljb24tY29sb3I6I2ZmNDA4MTstLW1kYy1yYWRpby1zZWxlY3RlZC1pY29uLWNvbG9yOiNmZjQwODE7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOiNmZjQwODE7LS1tYXQtcmFkaW8tcmlwcGxlLWNvbG9yOmJsYWNrOy0tbWF0LXJhZGlvLWNoZWNrZWQtcmlwcGxlLWNvbG9yOiNmZjQwODE7LS1tYXQtcmFkaW8tZGlzYWJsZWQtbGFiZWwtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KX0ubWF0LW1kYy1yYWRpby1idXR0b24ubWF0LXdhcm57LS1tZGMtcmFkaW8tZGlzYWJsZWQtc2VsZWN0ZWQtaWNvbi1jb2xvcjpibGFjazstLW1kYy1yYWRpby1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6YmxhY2s7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1yYWRpby1zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiNmNDQzMzY7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWRjLXJhZGlvLXNlbGVjdGVkLWljb24tY29sb3I6I2Y0NDMzNjstLW1kYy1yYWRpby1zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6I2Y0NDMzNjstLW1hdC1yYWRpby1yaXBwbGUtY29sb3I6YmxhY2s7LS1tYXQtcmFkaW8tY2hlY2tlZC1yaXBwbGUtY29sb3I6I2Y0NDMzNjstLW1hdC1yYWRpby1kaXNhYmxlZC1sYWJlbC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpfWh0bWx7LS1tZGMtcmFkaW8tc3RhdGUtbGF5ZXItc2l6ZTo0MHB4Oy0tbWF0LXJhZGlvLXRvdWNoLXRhcmdldC1kaXNwbGF5OmJsb2NrfS5tYXQtbWRjLXJhZGlvLWJ1dHRvbnstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tZGMtZm9ybS1maWVsZC1sYWJlbC10ZXh0LWxpbmUtaGVpZ2h0OjIwcHg7LS1tZGMtZm9ybS1maWVsZC1sYWJlbC10ZXh0LXNpemU6MTRweDstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtdHJhY2tpbmc6MC4wMTc4NTcxNDI5ZW07LS1tZGMtZm9ybS1maWVsZC1sYWJlbC10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1hdC1zbGlkZXItdmFsdWUtaW5kaWNhdG9yLXdpZHRoOmF1dG87LS1tYXQtc2xpZGVyLXZhbHVlLWluZGljYXRvci1oZWlnaHQ6MzJweDstLW1hdC1zbGlkZXItdmFsdWUtaW5kaWNhdG9yLWNhcmV0LWRpc3BsYXk6YmxvY2s7LS1tYXQtc2xpZGVyLXZhbHVlLWluZGljYXRvci1ib3JkZXItcmFkaXVzOjRweDstLW1hdC1zbGlkZXItdmFsdWUtaW5kaWNhdG9yLXBhZGRpbmc6MCAxMnB4Oy0tbWF0LXNsaWRlci12YWx1ZS1pbmRpY2F0b3ItdGV4dC10cmFuc2Zvcm06bm9uZTstLW1hdC1zbGlkZXItdmFsdWUtaW5kaWNhdG9yLWNvbnRhaW5lci10cmFuc2Zvcm06dHJhbnNsYXRlWCgtNTAlKTstLW1kYy1zbGlkZXItYWN0aXZlLXRyYWNrLWhlaWdodDo2cHg7LS1tZGMtc2xpZGVyLWFjdGl2ZS10cmFjay1zaGFwZTo5OTk5cHg7LS1tZGMtc2xpZGVyLWhhbmRsZS1oZWlnaHQ6MjBweDstLW1kYy1zbGlkZXItaGFuZGxlLXNoYXBlOjUwJTstLW1kYy1zbGlkZXItaGFuZGxlLXdpZHRoOjIwcHg7LS1tZGMtc2xpZGVyLWluYWN0aXZlLXRyYWNrLWhlaWdodDo0cHg7LS1tZGMtc2xpZGVyLWluYWN0aXZlLXRyYWNrLXNoYXBlOjk5OTlweDstLW1kYy1zbGlkZXItd2l0aC1vdmVybGFwLWhhbmRsZS1vdXRsaW5lLXdpZHRoOjFweDstLW1kYy1zbGlkZXItd2l0aC10aWNrLW1hcmtzLWFjdGl2ZS1jb250YWluZXItb3BhY2l0eTowLjY7LS1tZGMtc2xpZGVyLXdpdGgtdGljay1tYXJrcy1jb250YWluZXItc2hhcGU6NTAlOy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtY29udGFpbmVyLXNpemU6MnB4Oy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtaW5hY3RpdmUtY29udGFpbmVyLW9wYWNpdHk6MC42fWh0bWx7LS1tZGMtc2xpZGVyLWhhbmRsZS1jb2xvcjojM2Y1MWI1Oy0tbWRjLXNsaWRlci1mb2N1cy1oYW5kbGUtY29sb3I6IzNmNTFiNTstLW1kYy1zbGlkZXItaG92ZXItaGFuZGxlLWNvbG9yOiMzZjUxYjU7LS1tZGMtc2xpZGVyLWFjdGl2ZS10cmFjay1jb2xvcjojM2Y1MWI1Oy0tbWRjLXNsaWRlci1pbmFjdGl2ZS10cmFjay1jb2xvcjojM2Y1MWI1Oy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtaW5hY3RpdmUtY29udGFpbmVyLWNvbG9yOiMzZjUxYjU7LS1tZGMtc2xpZGVyLXdpdGgtdGljay1tYXJrcy1hY3RpdmUtY29udGFpbmVyLWNvbG9yOndoaXRlOy0tbWRjLXNsaWRlci1kaXNhYmxlZC1hY3RpdmUtdHJhY2stY29sb3I6IzAwMDstLW1kYy1zbGlkZXItZGlzYWJsZWQtaGFuZGxlLWNvbG9yOiMwMDA7LS1tZGMtc2xpZGVyLWRpc2FibGVkLWluYWN0aXZlLXRyYWNrLWNvbG9yOiMwMDA7LS1tZGMtc2xpZGVyLWxhYmVsLWNvbnRhaW5lci1jb2xvcjojMDAwOy0tbWRjLXNsaWRlci1sYWJlbC1sYWJlbC10ZXh0LWNvbG9yOiNmZmY7LS1tZGMtc2xpZGVyLXdpdGgtb3ZlcmxhcC1oYW5kbGUtb3V0bGluZS1jb2xvcjojZmZmOy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtZGlzYWJsZWQtY29udGFpbmVyLWNvbG9yOiMwMDA7LS1tZGMtc2xpZGVyLWhhbmRsZS1lbGV2YXRpb246MHB4IDJweCAxcHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAxcHggMXB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDNweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1zbGlkZXItcmlwcGxlLWNvbG9yOiMzZjUxYjU7LS1tYXQtc2xpZGVyLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuMDUpOy0tbWF0LXNsaWRlci1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpyZ2JhKDYzLCA4MSwgMTgxLCAwLjIpOy0tbWF0LXNsaWRlci12YWx1ZS1pbmRpY2F0b3Itb3BhY2l0eTowLjZ9aHRtbCAubWF0LWFjY2VudHstLW1hdC1zbGlkZXItcmlwcGxlLWNvbG9yOiNmZjQwODE7LS1tYXQtc2xpZGVyLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMjU1LCA2NCwgMTI5LCAwLjA1KTstLW1hdC1zbGlkZXItZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgyNTUsIDY0LCAxMjksIDAuMik7LS1tZGMtc2xpZGVyLWhhbmRsZS1jb2xvcjojZmY0MDgxOy0tbWRjLXNsaWRlci1mb2N1cy1oYW5kbGUtY29sb3I6I2ZmNDA4MTstLW1kYy1zbGlkZXItaG92ZXItaGFuZGxlLWNvbG9yOiNmZjQwODE7LS1tZGMtc2xpZGVyLWFjdGl2ZS10cmFjay1jb2xvcjojZmY0MDgxOy0tbWRjLXNsaWRlci1pbmFjdGl2ZS10cmFjay1jb2xvcjojZmY0MDgxOy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtaW5hY3RpdmUtY29udGFpbmVyLWNvbG9yOiNmZjQwODE7LS1tZGMtc2xpZGVyLXdpdGgtdGljay1tYXJrcy1hY3RpdmUtY29udGFpbmVyLWNvbG9yOndoaXRlfWh0bWwgLm1hdC13YXJuey0tbWF0LXNsaWRlci1yaXBwbGUtY29sb3I6I2Y0NDMzNjstLW1hdC1zbGlkZXItaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgyNDQsIDY3LCA1NCwgMC4wNSk7LS1tYXQtc2xpZGVyLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuMik7LS1tZGMtc2xpZGVyLWhhbmRsZS1jb2xvcjojZjQ0MzM2Oy0tbWRjLXNsaWRlci1mb2N1cy1oYW5kbGUtY29sb3I6I2Y0NDMzNjstLW1kYy1zbGlkZXItaG92ZXItaGFuZGxlLWNvbG9yOiNmNDQzMzY7LS1tZGMtc2xpZGVyLWFjdGl2ZS10cmFjay1jb2xvcjojZjQ0MzM2Oy0tbWRjLXNsaWRlci1pbmFjdGl2ZS10cmFjay1jb2xvcjojZjQ0MzM2Oy0tbWRjLXNsaWRlci13aXRoLXRpY2stbWFya3MtaW5hY3RpdmUtY29udGFpbmVyLWNvbG9yOiNmNDQzMzY7LS1tZGMtc2xpZGVyLXdpdGgtdGljay1tYXJrcy1hY3RpdmUtY29udGFpbmVyLWNvbG9yOndoaXRlfWh0bWx7LS1tZGMtc2xpZGVyLWxhYmVsLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tZGMtc2xpZGVyLWxhYmVsLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWRjLXNsaWRlci1sYWJlbC1sYWJlbC10ZXh0LWxpbmUtaGVpZ2h0OjIycHg7LS1tZGMtc2xpZGVyLWxhYmVsLWxhYmVsLXRleHQtdHJhY2tpbmc6MC4wMDcxNDI4NTcxZW07LS1tZGMtc2xpZGVyLWxhYmVsLWxhYmVsLXRleHQtd2VpZ2h0OjUwMH1odG1sey0tbWF0LW1lbnUtY29udGFpbmVyLXNoYXBlOjRweDstLW1hdC1tZW51LWRpdmlkZXItYm90dG9tLXNwYWNpbmc6MDstLW1hdC1tZW51LWRpdmlkZXItdG9wLXNwYWNpbmc6MDstLW1hdC1tZW51LWl0ZW0tc3BhY2luZzoxNnB4Oy0tbWF0LW1lbnUtaXRlbS1pY29uLXNpemU6MjRweDstLW1hdC1tZW51LWl0ZW0tbGVhZGluZy1zcGFjaW5nOjE2cHg7LS1tYXQtbWVudS1pdGVtLXRyYWlsaW5nLXNwYWNpbmc6MTZweDstLW1hdC1tZW51LWl0ZW0td2l0aC1pY29uLWxlYWRpbmctc3BhY2luZzoxNnB4Oy0tbWF0LW1lbnUtaXRlbS13aXRoLWljb24tdHJhaWxpbmctc3BhY2luZzoxNnB4fWh0bWx7LS1tYXQtbWVudS1pdGVtLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1tZW51LWl0ZW0taWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuODcpOy0tbWF0LW1lbnUtaXRlbS1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMDQpOy0tbWF0LW1lbnUtaXRlbS1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMDQpOy0tbWF0LW1lbnUtY29udGFpbmVyLWNvbG9yOndoaXRlOy0tbWF0LW1lbnUtZGl2aWRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTIpfWh0bWx7LS1tYXQtbWVudS1pdGVtLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtbWVudS1pdGVtLWxhYmVsLXRleHQtc2l6ZToxNnB4Oy0tbWF0LW1lbnUtaXRlbS1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDMxMjVlbTstLW1hdC1tZW51LWl0ZW0tbGFiZWwtdGV4dC1saW5lLWhlaWdodDoyNHB4Oy0tbWF0LW1lbnUtaXRlbS1sYWJlbC10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1kYy1saXN0LWxpc3QtaXRlbS1jb250YWluZXItc2hhcGU6MDstLW1kYy1saXN0LWxpc3QtaXRlbS1sZWFkaW5nLWF2YXRhci1zaGFwZTo1MCU7LS1tZGMtbGlzdC1saXN0LWl0ZW0tY29udGFpbmVyLWNvbG9yOnRyYW5zcGFyZW50Oy0tbWRjLWxpc3QtbGlzdC1pdGVtLXNlbGVjdGVkLWNvbnRhaW5lci1jb2xvcjp0cmFuc3BhcmVudDstLW1kYy1saXN0LWxpc3QtaXRlbS1sZWFkaW5nLWF2YXRhci1jb2xvcjp0cmFuc3BhcmVudDstLW1kYy1saXN0LWxpc3QtaXRlbS1sZWFkaW5nLWljb24tc2l6ZToyNHB4Oy0tbWRjLWxpc3QtbGlzdC1pdGVtLWxlYWRpbmctYXZhdGFyLXNpemU6NDBweDstLW1kYy1saXN0LWxpc3QtaXRlbS10cmFpbGluZy1pY29uLXNpemU6MjRweDstLW1kYy1saXN0LWxpc3QtaXRlbS1kaXNhYmxlZC1zdGF0ZS1sYXllci1jb2xvcjp0cmFuc3BhcmVudDstLW1kYy1saXN0LWxpc3QtaXRlbS1kaXNhYmxlZC1zdGF0ZS1sYXllci1vcGFjaXR5OjA7LS1tZGMtbGlzdC1saXN0LWl0ZW0tZGlzYWJsZWQtbGFiZWwtdGV4dC1vcGFjaXR5OjAuMzg7LS1tZGMtbGlzdC1saXN0LWl0ZW0tZGlzYWJsZWQtbGVhZGluZy1pY29uLW9wYWNpdHk6MC4zODstLW1kYy1saXN0LWxpc3QtaXRlbS1kaXNhYmxlZC10cmFpbGluZy1pY29uLW9wYWNpdHk6MC4zODstLW1hdC1saXN0LWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6dHJhbnNwYXJlbnQ7LS1tYXQtbGlzdC1hY3RpdmUtaW5kaWNhdG9yLXNoYXBlOjB9aHRtbHstLW1kYy1saXN0LWxpc3QtaXRlbS1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tZGMtbGlzdC1saXN0LWl0ZW0tc3VwcG9ydGluZy10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtbGlzdC1saXN0LWl0ZW0tbGVhZGluZy1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtbGlzdC1saXN0LWl0ZW0tdHJhaWxpbmctc3VwcG9ydGluZy10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtbGlzdC1saXN0LWl0ZW0tdHJhaWxpbmctaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWRjLWxpc3QtbGlzdC1pdGVtLXNlbGVjdGVkLXRyYWlsaW5nLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1saXN0LWxpc3QtaXRlbS1kaXNhYmxlZC1sYWJlbC10ZXh0LWNvbG9yOmJsYWNrOy0tbWRjLWxpc3QtbGlzdC1pdGVtLWRpc2FibGVkLWxlYWRpbmctaWNvbi1jb2xvcjpibGFjazstLW1kYy1saXN0LWxpc3QtaXRlbS1kaXNhYmxlZC10cmFpbGluZy1pY29uLWNvbG9yOmJsYWNrOy0tbWRjLWxpc3QtbGlzdC1pdGVtLWhvdmVyLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1kYy1saXN0LWxpc3QtaXRlbS1ob3Zlci1sZWFkaW5nLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1saXN0LWxpc3QtaXRlbS1ob3Zlci10cmFpbGluZy1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtbGlzdC1saXN0LWl0ZW0tZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuODcpOy0tbWRjLWxpc3QtbGlzdC1pdGVtLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWxpc3QtbGlzdC1pdGVtLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1kYy1saXN0LWxpc3QtaXRlbS1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1saXN0LWxpc3QtaXRlbS1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTJ9Lm1kYy1saXN0LWl0ZW1fX3N0YXJ0LC5tZGMtbGlzdC1pdGVtX19lbmR7LS1tZGMtcmFkaW8tZGlzYWJsZWQtc2VsZWN0ZWQtaWNvbi1jb2xvcjpibGFjazstLW1kYy1yYWRpby1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6YmxhY2s7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1yYWRpby1zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiMzZjUxYjU7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLXJhZGlvLXNlbGVjdGVkLWljb24tY29sb3I6IzNmNTFiNTstLW1kYy1yYWRpby1zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6IzNmNTFiNX0ubWF0LWFjY2VudCAubWRjLWxpc3QtaXRlbV9fc3RhcnQsLm1hdC1hY2NlbnQgLm1kYy1saXN0LWl0ZW1fX2VuZHstLW1kYy1yYWRpby1kaXNhYmxlZC1zZWxlY3RlZC1pY29uLWNvbG9yOmJsYWNrOy0tbWRjLXJhZGlvLWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpibGFjazstLW1kYy1yYWRpby11bnNlbGVjdGVkLWhvdmVyLWljb24tY29sb3I6IzIxMjEyMTstLW1kYy1yYWRpby11bnNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1yYWRpby11bnNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLXJhZGlvLXNlbGVjdGVkLWZvY3VzLWljb24tY29sb3I6I2ZmNDA4MTstLW1kYy1yYWRpby1zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiNmZjQwODE7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtaWNvbi1jb2xvcjojZmY0MDgxOy0tbWRjLXJhZGlvLXNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjojZmY0MDgxfS5tYXQtd2FybiAubWRjLWxpc3QtaXRlbV9fc3RhcnQsLm1hdC13YXJuIC5tZGMtbGlzdC1pdGVtX19lbmR7LS1tZGMtcmFkaW8tZGlzYWJsZWQtc2VsZWN0ZWQtaWNvbi1jb2xvcjpibGFjazstLW1kYy1yYWRpby1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6YmxhY2s7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtcmFkaW8tdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1yYWRpby1zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiNmNDQzMzY7LS1tZGMtcmFkaW8tc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWRjLXJhZGlvLXNlbGVjdGVkLWljb24tY29sb3I6I2Y0NDMzNjstLW1kYy1yYWRpby1zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6I2Y0NDMzNn0ubWF0LW1kYy1saXN0LW9wdGlvbnstLW1kYy1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtZGlzYWJsZWQtdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtY2hlY2ttYXJrLWNvbG9yOndoaXRlOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWZvY3VzLWljb24tY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMzZjUxYjU7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrfS5tYXQtbWRjLWxpc3Qtb3B0aW9uLm1hdC1hY2NlbnR7LS1tZGMtY2hlY2tib3gtZGlzYWJsZWQtc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWRjLWNoZWNrYm94LWRpc2FibGVkLXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjp3aGl0ZTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojZmY0MDgxOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWljb24tY29sb3I6I2ZmNDA4MTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6I2ZmNDA4MTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWZvY3VzLWljb24tY29sb3I6IzIxMjEyMTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWhvdmVyLWljb24tY29sb3I6IzIxMjEyMTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6I2ZmNDA4MTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1jb2xvcjpibGFja30ubWF0LW1kYy1saXN0LW9wdGlvbi5tYXQtd2FybnstLW1kYy1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtZGlzYWJsZWQtdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtY2hlY2ttYXJrLWNvbG9yOndoaXRlOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWZvY3VzLWljb24tY29sb3I6I2Y0NDMzNjstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6I2Y0NDMzNjstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6I2Y0NDMzNjstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrfS5tYXQtbWRjLWxpc3QtYmFzZS5tYXQtbWRjLWxpc3QtYmFzZSAubWRjLWxpc3QtaXRlbS0tc2VsZWN0ZWQgLm1kYy1saXN0LWl0ZW1fX3ByaW1hcnktdGV4dCwubWF0LW1kYy1saXN0LWJhc2UubWF0LW1kYy1saXN0LWJhc2UgLm1kYy1saXN0LWl0ZW0tLWFjdGl2YXRlZCAubWRjLWxpc3QtaXRlbV9fcHJpbWFyeS10ZXh0e2NvbG9yOiMzZjUxYjV9Lm1hdC1tZGMtbGlzdC1iYXNlLm1hdC1tZGMtbGlzdC1iYXNlIC5tZGMtbGlzdC1pdGVtLS1zZWxlY3RlZC5tZGMtbGlzdC1pdGVtLS13aXRoLWxlYWRpbmctaWNvbiAubWRjLWxpc3QtaXRlbV9fc3RhcnQsLm1hdC1tZGMtbGlzdC1iYXNlLm1hdC1tZGMtbGlzdC1iYXNlIC5tZGMtbGlzdC1pdGVtLS1hY3RpdmF0ZWQubWRjLWxpc3QtaXRlbS0td2l0aC1sZWFkaW5nLWljb24gLm1kYy1saXN0LWl0ZW1fX3N0YXJ0e2NvbG9yOiMzZjUxYjV9Lm1hdC1tZGMtbGlzdC1iYXNlIC5tZGMtbGlzdC1pdGVtLS1kaXNhYmxlZCAubWRjLWxpc3QtaXRlbV9fc3RhcnQsLm1hdC1tZGMtbGlzdC1iYXNlIC5tZGMtbGlzdC1pdGVtLS1kaXNhYmxlZCAubWRjLWxpc3QtaXRlbV9fY29udGVudCwubWF0LW1kYy1saXN0LWJhc2UgLm1kYy1saXN0LWl0ZW0tLWRpc2FibGVkIC5tZGMtbGlzdC1pdGVtX19lbmR7b3BhY2l0eToxfWh0bWx7LS1tZGMtbGlzdC1saXN0LWl0ZW0tb25lLWxpbmUtY29udGFpbmVyLWhlaWdodDo0OHB4Oy0tbWRjLWxpc3QtbGlzdC1pdGVtLXR3by1saW5lLWNvbnRhaW5lci1oZWlnaHQ6NjRweDstLW1kYy1saXN0LWxpc3QtaXRlbS10aHJlZS1saW5lLWNvbnRhaW5lci1oZWlnaHQ6ODhweDstLW1hdC1saXN0LWxpc3QtaXRlbS1sZWFkaW5nLWljb24tc3RhcnQtc3BhY2U6MTZweDstLW1hdC1saXN0LWxpc3QtaXRlbS1sZWFkaW5nLWljb24tZW5kLXNwYWNlOjMycHh9Lm1kYy1saXN0LWl0ZW1fX3N0YXJ0LC5tZGMtbGlzdC1pdGVtX19lbmR7LS1tZGMtcmFkaW8tc3RhdGUtbGF5ZXItc2l6ZTo0MHB4fS5tYXQtbWRjLWxpc3QtaXRlbS5tZGMtbGlzdC1pdGVtLS13aXRoLWxlYWRpbmctYXZhdGFyLm1kYy1saXN0LWl0ZW0tLXdpdGgtb25lLWxpbmUsLm1hdC1tZGMtbGlzdC1pdGVtLm1kYy1saXN0LWl0ZW0tLXdpdGgtbGVhZGluZy1jaGVja2JveC5tZGMtbGlzdC1pdGVtLS13aXRoLW9uZS1saW5lLC5tYXQtbWRjLWxpc3QtaXRlbS5tZGMtbGlzdC1pdGVtLS13aXRoLWxlYWRpbmctaWNvbi5tZGMtbGlzdC1pdGVtLS13aXRoLW9uZS1saW5le2hlaWdodDo1NnB4fS5tYXQtbWRjLWxpc3QtaXRlbS5tZGMtbGlzdC1pdGVtLS13aXRoLWxlYWRpbmctYXZhdGFyLm1kYy1saXN0LWl0ZW0tLXdpdGgtdHdvLWxpbmVzLC5tYXQtbWRjLWxpc3QtaXRlbS5tZGMtbGlzdC1pdGVtLS13aXRoLWxlYWRpbmctY2hlY2tib3gubWRjLWxpc3QtaXRlbS0td2l0aC10d28tbGluZXMsLm1hdC1tZGMtbGlzdC1pdGVtLm1kYy1saXN0LWl0ZW0tLXdpdGgtbGVhZGluZy1pY29uLm1kYy1saXN0LWl0ZW0tLXdpdGgtdHdvLWxpbmVze2hlaWdodDo3MnB4fWh0bWx7LS1tZGMtbGlzdC1saXN0LWl0ZW0tbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1saXN0LWxpc3QtaXRlbS1sYWJlbC10ZXh0LWxpbmUtaGVpZ2h0OjI0cHg7LS1tZGMtbGlzdC1saXN0LWl0ZW0tbGFiZWwtdGV4dC1zaXplOjE2cHg7LS1tZGMtbGlzdC1saXN0LWl0ZW0tbGFiZWwtdGV4dC10cmFja2luZzowLjAzMTI1ZW07LS1tZGMtbGlzdC1saXN0LWl0ZW0tbGFiZWwtdGV4dC13ZWlnaHQ6NDAwOy0tbWRjLWxpc3QtbGlzdC1pdGVtLXN1cHBvcnRpbmctdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1saXN0LWxpc3QtaXRlbS1zdXBwb3J0aW5nLXRleHQtbGluZS1oZWlnaHQ6MjBweDstLW1kYy1saXN0LWxpc3QtaXRlbS1zdXBwb3J0aW5nLXRleHQtc2l6ZToxNHB4Oy0tbWRjLWxpc3QtbGlzdC1pdGVtLXN1cHBvcnRpbmctdGV4dC10cmFja2luZzowLjAxNzg1NzE0MjllbTstLW1kYy1saXN0LWxpc3QtaXRlbS1zdXBwb3J0aW5nLXRleHQtd2VpZ2h0OjQwMDstLW1kYy1saXN0LWxpc3QtaXRlbS10cmFpbGluZy1zdXBwb3J0aW5nLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tZGMtbGlzdC1saXN0LWl0ZW0tdHJhaWxpbmctc3VwcG9ydGluZy10ZXh0LWxpbmUtaGVpZ2h0OjIwcHg7LS1tZGMtbGlzdC1saXN0LWl0ZW0tdHJhaWxpbmctc3VwcG9ydGluZy10ZXh0LXNpemU6MTJweDstLW1kYy1saXN0LWxpc3QtaXRlbS10cmFpbGluZy1zdXBwb3J0aW5nLXRleHQtdHJhY2tpbmc6MC4wMzMzMzMzMzMzZW07LS1tZGMtbGlzdC1saXN0LWl0ZW0tdHJhaWxpbmctc3VwcG9ydGluZy10ZXh0LXdlaWdodDo0MDB9Lm1kYy1saXN0LWdyb3VwX19zdWJoZWFkZXJ7Zm9udDo0MDAgMTZweC8yOHB4IFJvYm90bywgc2Fucy1zZXJpZjtsZXR0ZXItc3BhY2luZzouMDA5Mzc1ZW19aHRtbHstLW1hdC1wYWdpbmF0b3ItY29udGFpbmVyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1wYWdpbmF0b3ItY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtcGFnaW5hdG9yLWVuYWJsZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LXBhZ2luYXRvci1kaXNhYmxlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xMil9aHRtbHstLW1hdC1wYWdpbmF0b3ItY29udGFpbmVyLXNpemU6NTZweDstLW1hdC1wYWdpbmF0b3ItZm9ybS1maWVsZC1jb250YWluZXItaGVpZ2h0OjQwcHg7LS1tYXQtcGFnaW5hdG9yLWZvcm0tZmllbGQtY29udGFpbmVyLXZlcnRpY2FsLXBhZGRpbmc6OHB4fWh0bWx7LS1tYXQtcGFnaW5hdG9yLWNvbnRhaW5lci10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LXBhZ2luYXRvci1jb250YWluZXItdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWF0LXBhZ2luYXRvci1jb250YWluZXItdGV4dC1zaXplOjEycHg7LS1tYXQtcGFnaW5hdG9yLWNvbnRhaW5lci10ZXh0LXRyYWNraW5nOjAuMDMzMzMzMzMzM2VtOy0tbWF0LXBhZ2luYXRvci1jb250YWluZXItdGV4dC13ZWlnaHQ6NDAwOy0tbWF0LXBhZ2luYXRvci1zZWxlY3QtdHJpZ2dlci10ZXh0LXNpemU6MTJweH1odG1sey0tbWRjLXRhYi1pbmRpY2F0b3ItYWN0aXZlLWluZGljYXRvci1oZWlnaHQ6MnB4Oy0tbWRjLXRhYi1pbmRpY2F0b3ItYWN0aXZlLWluZGljYXRvci1zaGFwZTowOy0tbWRjLXNlY29uZGFyeS1uYXZpZ2F0aW9uLXRhYi1jb250YWluZXItaGVpZ2h0OjQ4cHg7LS1tYXQtdGFiLWhlYWRlci1kaXZpZGVyLWNvbG9yOnRyYW5zcGFyZW50Oy0tbWF0LXRhYi1oZWFkZXItZGl2aWRlci1oZWlnaHQ6MH0ubWF0LW1kYy10YWItZ3JvdXAsLm1hdC1tZGMtdGFiLW5hdi1iYXJ7LS1tZGMtdGFiLWluZGljYXRvci1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiMzZjUxYjU7LS1tYXQtdGFiLWhlYWRlci1kaXNhYmxlZC1yaXBwbGUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC10YWItaGVhZGVyLXBhZ2luYXRpb24taWNvbi1jb2xvcjpibGFjazstLW1hdC10YWItaGVhZGVyLWluYWN0aXZlLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWxhYmVsLXRleHQtY29sb3I6IzNmNTFiNTstLW1hdC10YWItaGVhZGVyLWFjdGl2ZS1yaXBwbGUtY29sb3I6IzNmNTFiNTstLW1hdC10YWItaGVhZGVyLWluYWN0aXZlLXJpcHBsZS1jb2xvcjojM2Y1MWI1Oy0tbWF0LXRhYi1oZWFkZXItaW5hY3RpdmUtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNik7LS1tYXQtdGFiLWhlYWRlci1pbmFjdGl2ZS1ob3Zlci1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1hdC10YWItaGVhZGVyLWFjdGl2ZS1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOiMzZjUxYjU7LS1tYXQtdGFiLWhlYWRlci1hY3RpdmUtaG92ZXItbGFiZWwtdGV4dC1jb2xvcjojM2Y1MWI1Oy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWZvY3VzLWluZGljYXRvci1jb2xvcjojM2Y1MWI1Oy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWhvdmVyLWluZGljYXRvci1jb2xvcjojM2Y1MWI1fS5tYXQtbWRjLXRhYi1ncm91cC5tYXQtYWNjZW50LC5tYXQtbWRjLXRhYi1uYXYtYmFyLm1hdC1hY2NlbnR7LS1tZGMtdGFiLWluZGljYXRvci1hY3RpdmUtaW5kaWNhdG9yLWNvbG9yOiNmZjQwODE7LS1tYXQtdGFiLWhlYWRlci1kaXNhYmxlZC1yaXBwbGUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC10YWItaGVhZGVyLXBhZ2luYXRpb24taWNvbi1jb2xvcjpibGFjazstLW1hdC10YWItaGVhZGVyLWluYWN0aXZlLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWxhYmVsLXRleHQtY29sb3I6I2ZmNDA4MTstLW1hdC10YWItaGVhZGVyLWFjdGl2ZS1yaXBwbGUtY29sb3I6I2ZmNDA4MTstLW1hdC10YWItaGVhZGVyLWluYWN0aXZlLXJpcHBsZS1jb2xvcjojZmY0MDgxOy0tbWF0LXRhYi1oZWFkZXItaW5hY3RpdmUtZm9jdXMtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNik7LS1tYXQtdGFiLWhlYWRlci1pbmFjdGl2ZS1ob3Zlci1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1hdC10YWItaGVhZGVyLWFjdGl2ZS1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOiNmZjQwODE7LS1tYXQtdGFiLWhlYWRlci1hY3RpdmUtaG92ZXItbGFiZWwtdGV4dC1jb2xvcjojZmY0MDgxOy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWZvY3VzLWluZGljYXRvci1jb2xvcjojZmY0MDgxOy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWhvdmVyLWluZGljYXRvci1jb2xvcjojZmY0MDgxfS5tYXQtbWRjLXRhYi1ncm91cC5tYXQtd2FybiwubWF0LW1kYy10YWItbmF2LWJhci5tYXQtd2FybnstLW1kYy10YWItaW5kaWNhdG9yLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6I2Y0NDMzNjstLW1hdC10YWItaGVhZGVyLWRpc2FibGVkLXJpcHBsZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LXRhYi1oZWFkZXItcGFnaW5hdGlvbi1pY29uLWNvbG9yOmJsYWNrOy0tbWF0LXRhYi1oZWFkZXItaW5hY3RpdmUtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNik7LS1tYXQtdGFiLWhlYWRlci1hY3RpdmUtbGFiZWwtdGV4dC1jb2xvcjojZjQ0MzM2Oy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLXJpcHBsZS1jb2xvcjojZjQ0MzM2Oy0tbWF0LXRhYi1oZWFkZXItaW5hY3RpdmUtcmlwcGxlLWNvbG9yOiNmNDQzMzY7LS1tYXQtdGFiLWhlYWRlci1pbmFjdGl2ZS1mb2N1cy1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC42KTstLW1hdC10YWItaGVhZGVyLWluYWN0aXZlLWhvdmVyLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjYpOy0tbWF0LXRhYi1oZWFkZXItYWN0aXZlLWZvY3VzLWxhYmVsLXRleHQtY29sb3I6I2Y0NDMzNjstLW1hdC10YWItaGVhZGVyLWFjdGl2ZS1ob3Zlci1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tYXQtdGFiLWhlYWRlci1hY3RpdmUtZm9jdXMtaW5kaWNhdG9yLWNvbG9yOiNmNDQzMzY7LS1tYXQtdGFiLWhlYWRlci1hY3RpdmUtaG92ZXItaW5kaWNhdG9yLWNvbG9yOiNmNDQzMzZ9Lm1hdC1tZGMtdGFiLWdyb3VwLm1hdC1iYWNrZ3JvdW5kLXByaW1hcnksLm1hdC1tZGMtdGFiLW5hdi1iYXIubWF0LWJhY2tncm91bmQtcHJpbWFyeXstLW1hdC10YWItaGVhZGVyLXdpdGgtYmFja2dyb3VuZC1iYWNrZ3JvdW5kLWNvbG9yOiMzZjUxYjU7LS1tYXQtdGFiLWhlYWRlci13aXRoLWJhY2tncm91bmQtZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZX0ubWF0LW1kYy10YWItZ3JvdXAubWF0LWJhY2tncm91bmQtYWNjZW50LC5tYXQtbWRjLXRhYi1uYXYtYmFyLm1hdC1iYWNrZ3JvdW5kLWFjY2VudHstLW1hdC10YWItaGVhZGVyLXdpdGgtYmFja2dyb3VuZC1iYWNrZ3JvdW5kLWNvbG9yOiNmZjQwODE7LS1tYXQtdGFiLWhlYWRlci13aXRoLWJhY2tncm91bmQtZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZX0ubWF0LW1kYy10YWItZ3JvdXAubWF0LWJhY2tncm91bmQtd2FybiwubWF0LW1kYy10YWItbmF2LWJhci5tYXQtYmFja2dyb3VuZC13YXJuey0tbWF0LXRhYi1oZWFkZXItd2l0aC1iYWNrZ3JvdW5kLWJhY2tncm91bmQtY29sb3I6I2Y0NDMzNjstLW1hdC10YWItaGVhZGVyLXdpdGgtYmFja2dyb3VuZC1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlfS5tYXQtbWRjLXRhYi1oZWFkZXJ7LS1tZGMtc2Vjb25kYXJ5LW5hdmlnYXRpb24tdGFiLWNvbnRhaW5lci1oZWlnaHQ6NDhweH0ubWF0LW1kYy10YWItaGVhZGVyey0tbWF0LXRhYi1oZWFkZXItbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC10YWItaGVhZGVyLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWF0LXRhYi1oZWFkZXItbGFiZWwtdGV4dC10cmFja2luZzowLjA4OTI4NTcxNDNlbTstLW1hdC10YWItaGVhZGVyLWxhYmVsLXRleHQtbGluZS1oZWlnaHQ6MzZweDstLW1hdC10YWItaGVhZGVyLWxhYmVsLXRleHQtd2VpZ2h0OjUwMH1odG1sey0tbWRjLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWNoZWNrbWFyay1jb2xvcjojZmZmOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xNjstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMDQ7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTY7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTY7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMDQ7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xNn1odG1sey0tbWRjLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1jaGVja2JveC1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6d2hpdGU7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojZmY0MDgxOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWhvdmVyLWljb24tY29sb3I6I2ZmNDA4MTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1pY29uLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjojZmY0MDgxOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOiNmZjQwODE7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1jb2xvcjojZmY0MDgxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtY2hlY2tib3gtZGlzYWJsZWQtbGFiZWwtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KX0ubWF0LW1kYy1jaGVja2JveHstLW1kYy1mb3JtLWZpZWxkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX0ubWF0LW1kYy1jaGVja2JveC5tYXQtcHJpbWFyeXstLW1kYy1jaGVja2JveC1kaXNhYmxlZC1zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtZGlzYWJsZWQtdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtY2hlY2ttYXJrLWNvbG9yOndoaXRlOy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWZvY3VzLWljb24tY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMzZjUxYjU7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtaWNvbi1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItaWNvbi1jb2xvcjojMjEyMTIxOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjojM2Y1MWI1Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrfS5tYXQtbWRjLWNoZWNrYm94Lm1hdC13YXJuey0tbWRjLWNoZWNrYm94LWRpc2FibGVkLXNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1jaGVja2JveC1kaXNhYmxlZC11bnNlbGVjdGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1jaGVja21hcmstY29sb3I6d2hpdGU7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtZm9jdXMtaWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWhvdmVyLWljb24tY29sb3I6I2Y0NDMzNjstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1pY29uLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtcHJlc3NlZC1pY29uLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1mb2N1cy1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1ob3Zlci1pY29uLWNvbG9yOiMyMTIxMjE7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1wcmVzc2VkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1kYy1jaGVja2JveC1zZWxlY3RlZC1mb2N1cy1zdGF0ZS1sYXllci1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXNlbGVjdGVkLWhvdmVyLXN0YXRlLWxheWVyLWNvbG9yOiNmNDQzMzY7LS1tZGMtY2hlY2tib3gtc2VsZWN0ZWQtcHJlc3NlZC1zdGF0ZS1sYXllci1jb2xvcjojZjQ0MzM2Oy0tbWRjLWNoZWNrYm94LXVuc2VsZWN0ZWQtZm9jdXMtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tZGMtY2hlY2tib3gtdW5zZWxlY3RlZC1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1kYy1jaGVja2JveC11bnNlbGVjdGVkLXByZXNzZWQtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2t9aHRtbHstLW1kYy1jaGVja2JveC1zdGF0ZS1sYXllci1zaXplOjQwcHg7LS1tYXQtY2hlY2tib3gtdG91Y2gtdGFyZ2V0LWRpc3BsYXk6YmxvY2t9Lm1hdC1tZGMtY2hlY2tib3h7LS1tZGMtZm9ybS1maWVsZC1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLWZvcm0tZmllbGQtbGFiZWwtdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWRjLWZvcm0tZmllbGQtbGFiZWwtdGV4dC1zaXplOjE0cHg7LS1tZGMtZm9ybS1maWVsZC1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDE3ODU3MTQyOWVtOy0tbWRjLWZvcm0tZmllbGQtbGFiZWwtdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tZGMtdGV4dC1idXR0b24tY29udGFpbmVyLXNoYXBlOjRweDstLW1kYy10ZXh0LWJ1dHRvbi1rZWVwLXRvdWNoLXRhcmdldDpmYWxzZTstLW1kYy1maWxsZWQtYnV0dG9uLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tZGMtZmlsbGVkLWJ1dHRvbi1rZWVwLXRvdWNoLXRhcmdldDpmYWxzZTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1rZWVwLXRvdWNoLXRhcmdldDpmYWxzZTstLW1kYy1vdXRsaW5lZC1idXR0b24ta2VlcC10b3VjaC10YXJnZXQ6ZmFsc2U7LS1tZGMtb3V0bGluZWQtYnV0dG9uLW91dGxpbmUtd2lkdGg6MXB4Oy0tbWRjLW91dGxpbmVkLWJ1dHRvbi1jb250YWluZXItc2hhcGU6NHB4Oy0tbWF0LXRleHQtYnV0dG9uLWhvcml6b250YWwtcGFkZGluZzo4cHg7LS1tYXQtdGV4dC1idXR0b24td2l0aC1pY29uLWhvcml6b250YWwtcGFkZGluZzo4cHg7LS1tYXQtdGV4dC1idXR0b24taWNvbi1zcGFjaW5nOjhweDstLW1hdC10ZXh0LWJ1dHRvbi1pY29uLW9mZnNldDowOy0tbWF0LWZpbGxlZC1idXR0b24taG9yaXpvbnRhbC1wYWRkaW5nOjE2cHg7LS1tYXQtZmlsbGVkLWJ1dHRvbi1pY29uLXNwYWNpbmc6OHB4Oy0tbWF0LWZpbGxlZC1idXR0b24taWNvbi1vZmZzZXQ6LTRweDstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLWhvcml6b250YWwtcGFkZGluZzoxNnB4Oy0tbWF0LXByb3RlY3RlZC1idXR0b24taWNvbi1zcGFjaW5nOjhweDstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLWljb24tb2Zmc2V0Oi00cHg7LS1tYXQtb3V0bGluZWQtYnV0dG9uLWhvcml6b250YWwtcGFkZGluZzoxNXB4Oy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1pY29uLXNwYWNpbmc6OHB4Oy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1pY29uLW9mZnNldDotNHB4fWh0bWx7LS1tZGMtdGV4dC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjpibGFjazstLW1kYy10ZXh0LWJ1dHRvbi1kaXNhYmxlZC1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4zOCk7LS1tYXQtdGV4dC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtdGV4dC1idXR0b24tZGlzYWJsZWQtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtdGV4dC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKTstLW1hdC10ZXh0LWJ1dHRvbi1ob3Zlci1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMDQ7LS1tYXQtdGV4dC1idXR0b24tZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWF0LXRleHQtYnV0dG9uLXByZXNzZWQtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLWZpbGxlZC1idXR0b24tY29udGFpbmVyLWNvbG9yOndoaXRlOy0tbWRjLWZpbGxlZC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjpibGFjazstLW1kYy1maWxsZWQtYnV0dG9uLWRpc2FibGVkLWNvbnRhaW5lci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWZpbGxlZC1idXR0b24tZGlzYWJsZWQtbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LWZpbGxlZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtZmlsbGVkLWJ1dHRvbi1kaXNhYmxlZC1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1maWxsZWQtYnV0dG9uLXJpcHBsZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSk7LS1tYXQtZmlsbGVkLWJ1dHRvbi1ob3Zlci1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMDQ7LS1tYXQtZmlsbGVkLWJ1dHRvbi1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTI7LS1tYXQtZmlsbGVkLWJ1dHRvbi1wcmVzc2VkLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWNvbnRhaW5lci1jb2xvcjp3aGl0ZTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWxhYmVsLXRleHQtY29sb3I6YmxhY2s7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1kaXNhYmxlZC1jb250YWluZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWRpc2FibGVkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCAzcHggMXB4IC0ycHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMnB4IDJweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCA1cHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1kaXNhYmxlZC1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggMHB4IDBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMHB4IDBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDBweCAwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1mb2N1cy1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggMnB4IDRweCAtMXB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDRweCA1cHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAxcHggMTBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWhvdmVyLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCAycHggNHB4IC0xcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggNHB4IDVweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCAxMHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLXByb3RlY3RlZC1idXR0b24tcHJlc3NlZC1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1jb250YWluZXItc2hhZG93LWNvbG9yOiMwMDA7LS1tYXQtcHJvdGVjdGVkLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLWRpc2FibGVkLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWF0LXByb3RlY3RlZC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKTstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLWZvY3VzLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLXByZXNzZWQtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWRjLW91dGxpbmVkLWJ1dHRvbi1kaXNhYmxlZC1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWRpc2FibGVkLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1vdXRsaW5lZC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjpibGFjazstLW1kYy1vdXRsaW5lZC1idXR0b24tb3V0bGluZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1vdXRsaW5lZC1idXR0b24tZGlzYWJsZWQtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtb3V0bGluZWQtYnV0dG9uLXJpcHBsZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSk7LS1tYXQtb3V0bGluZWQtYnV0dG9uLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1hdC1vdXRsaW5lZC1idXR0b24tZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1wcmVzc2VkLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMn0ubWF0LW1kYy1idXR0b24ubWF0LXByaW1hcnl7LS1tZGMtdGV4dC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjojM2Y1MWI1Oy0tbWF0LXRleHQtYnV0dG9uLXN0YXRlLWxheWVyLWNvbG9yOiMzZjUxYjU7LS1tYXQtdGV4dC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuMSl9Lm1hdC1tZGMtYnV0dG9uLm1hdC1hY2NlbnR7LS1tZGMtdGV4dC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjojZmY0MDgxOy0tbWF0LXRleHQtYnV0dG9uLXN0YXRlLWxheWVyLWNvbG9yOiNmZjQwODE7LS1tYXQtdGV4dC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMjU1LCA2NCwgMTI5LCAwLjEpfS5tYXQtbWRjLWJ1dHRvbi5tYXQtd2FybnstLW1kYy10ZXh0LWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tYXQtdGV4dC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6I2Y0NDMzNjstLW1hdC10ZXh0LWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgyNDQsIDY3LCA1NCwgMC4xKX0ubWF0LW1kYy11bmVsZXZhdGVkLWJ1dHRvbi5tYXQtcHJpbWFyeXstLW1kYy1maWxsZWQtYnV0dG9uLWNvbnRhaW5lci1jb2xvcjojM2Y1MWI1Oy0tbWRjLWZpbGxlZC1idXR0b24tbGFiZWwtdGV4dC1jb2xvcjp3aGl0ZTstLW1hdC1maWxsZWQtYnV0dG9uLXN0YXRlLWxheWVyLWNvbG9yOndoaXRlOy0tbWF0LWZpbGxlZC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKX0ubWF0LW1kYy11bmVsZXZhdGVkLWJ1dHRvbi5tYXQtYWNjZW50ey0tbWRjLWZpbGxlZC1idXR0b24tY29udGFpbmVyLWNvbG9yOiNmZjQwODE7LS1tZGMtZmlsbGVkLWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWF0LWZpbGxlZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtZmlsbGVkLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpfS5tYXQtbWRjLXVuZWxldmF0ZWQtYnV0dG9uLm1hdC13YXJuey0tbWRjLWZpbGxlZC1idXR0b24tY29udGFpbmVyLWNvbG9yOiNmNDQzMzY7LS1tZGMtZmlsbGVkLWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWF0LWZpbGxlZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtZmlsbGVkLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpfS5tYXQtbWRjLXJhaXNlZC1idXR0b24ubWF0LXByaW1hcnl7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1jb250YWluZXItY29sb3I6IzNmNTFiNTstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWxhYmVsLXRleHQtY29sb3I6d2hpdGU7LS1tYXQtcHJvdGVjdGVkLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjp3aGl0ZTstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLXJpcHBsZS1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSl9Lm1hdC1tZGMtcmFpc2VkLWJ1dHRvbi5tYXQtYWNjZW50ey0tbWRjLXByb3RlY3RlZC1idXR0b24tY29udGFpbmVyLWNvbG9yOiNmZjQwODE7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOndoaXRlOy0tbWF0LXByb3RlY3RlZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtcHJvdGVjdGVkLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpfS5tYXQtbWRjLXJhaXNlZC1idXR0b24ubWF0LXdhcm57LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1jb250YWluZXItY29sb3I6I2Y0NDMzNjstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWxhYmVsLXRleHQtY29sb3I6d2hpdGU7LS1tYXQtcHJvdGVjdGVkLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjp3aGl0ZTstLW1hdC1wcm90ZWN0ZWQtYnV0dG9uLXJpcHBsZS1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSl9Lm1hdC1tZGMtb3V0bGluZWQtYnV0dG9uLm1hdC1wcmltYXJ5ey0tbWRjLW91dGxpbmVkLWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOiMzZjUxYjU7LS1tZGMtb3V0bGluZWQtYnV0dG9uLW91dGxpbmUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1vdXRsaW5lZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1hdC1vdXRsaW5lZC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuMSl9Lm1hdC1tZGMtb3V0bGluZWQtYnV0dG9uLm1hdC1hY2NlbnR7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWxhYmVsLXRleHQtY29sb3I6I2ZmNDA4MTstLW1kYy1vdXRsaW5lZC1idXR0b24tb3V0bGluZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjojZmY0MDgxOy0tbWF0LW91dGxpbmVkLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgyNTUsIDY0LCAxMjksIDAuMSl9Lm1hdC1tZGMtb3V0bGluZWQtYnV0dG9uLm1hdC13YXJuey0tbWRjLW91dGxpbmVkLWJ1dHRvbi1sYWJlbC10ZXh0LWNvbG9yOiNmNDQzMzY7LS1tZGMtb3V0bGluZWQtYnV0dG9uLW91dGxpbmUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1vdXRsaW5lZC1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6I2Y0NDMzNjstLW1hdC1vdXRsaW5lZC1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuMSl9aHRtbHstLW1kYy10ZXh0LWJ1dHRvbi1jb250YWluZXItaGVpZ2h0OjM2cHg7LS1tZGMtZmlsbGVkLWJ1dHRvbi1jb250YWluZXItaGVpZ2h0OjM2cHg7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWNvbnRhaW5lci1oZWlnaHQ6MzZweDstLW1kYy1wcm90ZWN0ZWQtYnV0dG9uLWNvbnRhaW5lci1oZWlnaHQ6MzZweDstLW1hdC10ZXh0LWJ1dHRvbi10b3VjaC10YXJnZXQtZGlzcGxheTpibG9jazstLW1hdC1maWxsZWQtYnV0dG9uLXRvdWNoLXRhcmdldC1kaXNwbGF5OmJsb2NrOy0tbWF0LXByb3RlY3RlZC1idXR0b24tdG91Y2gtdGFyZ2V0LWRpc3BsYXk6YmxvY2s7LS1tYXQtb3V0bGluZWQtYnV0dG9uLXRvdWNoLXRhcmdldC1kaXNwbGF5OmJsb2NrfWh0bWx7LS1tZGMtdGV4dC1idXR0b24tbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy10ZXh0LWJ1dHRvbi1sYWJlbC10ZXh0LXNpemU6MTRweDstLW1kYy10ZXh0LWJ1dHRvbi1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDg5Mjg1NzE0M2VtOy0tbWRjLXRleHQtYnV0dG9uLWxhYmVsLXRleHQtd2VpZ2h0OjUwMDstLW1kYy10ZXh0LWJ1dHRvbi1sYWJlbC10ZXh0LXRyYW5zZm9ybTpub25lOy0tbWRjLWZpbGxlZC1idXR0b24tbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1maWxsZWQtYnV0dG9uLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWRjLWZpbGxlZC1idXR0b24tbGFiZWwtdGV4dC10cmFja2luZzowLjA4OTI4NTcxNDNlbTstLW1kYy1maWxsZWQtYnV0dG9uLWxhYmVsLXRleHQtd2VpZ2h0OjUwMDstLW1kYy1maWxsZWQtYnV0dG9uLWxhYmVsLXRleHQtdHJhbnNmb3JtOm5vbmU7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWRjLW91dGxpbmVkLWJ1dHRvbi1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDg5Mjg1NzE0M2VtOy0tbWRjLW91dGxpbmVkLWJ1dHRvbi1sYWJlbC10ZXh0LXdlaWdodDo1MDA7LS1tZGMtb3V0bGluZWQtYnV0dG9uLWxhYmVsLXRleHQtdHJhbnNmb3JtOm5vbmU7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLXByb3RlY3RlZC1idXR0b24tbGFiZWwtdGV4dC1zaXplOjE0cHg7LS1tZGMtcHJvdGVjdGVkLWJ1dHRvbi1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDg5Mjg1NzE0M2VtOy0tbWRjLXByb3RlY3RlZC1idXR0b24tbGFiZWwtdGV4dC13ZWlnaHQ6NTAwOy0tbWRjLXByb3RlY3RlZC1idXR0b24tbGFiZWwtdGV4dC10cmFuc2Zvcm06bm9uZX1odG1sey0tbWRjLWljb24tYnV0dG9uLWljb24tc2l6ZToyNHB4fWh0bWx7LS1tZGMtaWNvbi1idXR0b24taWNvbi1jb2xvcjppbmhlcml0Oy0tbWRjLWljb24tYnV0dG9uLWRpc2FibGVkLWljb24tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC1pY29uLWJ1dHRvbi1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1pY29uLWJ1dHRvbi1kaXNhYmxlZC1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1pY29uLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpOy0tbWF0LWljb24tYnV0dG9uLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1hdC1pY29uLWJ1dHRvbi1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTI7LS1tYXQtaWNvbi1idXR0b24tcHJlc3NlZC1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTJ9aHRtbCAubWF0LW1kYy1pY29uLWJ1dHRvbi5tYXQtcHJpbWFyeXstLW1kYy1pY29uLWJ1dHRvbi1pY29uLWNvbG9yOiMzZjUxYjU7LS1tYXQtaWNvbi1idXR0b24tc3RhdGUtbGF5ZXItY29sb3I6IzNmNTFiNTstLW1hdC1pY29uLWJ1dHRvbi1yaXBwbGUtY29sb3I6cmdiYSg2MywgODEsIDE4MSwgMC4xKX1odG1sIC5tYXQtbWRjLWljb24tYnV0dG9uLm1hdC1hY2NlbnR7LS1tZGMtaWNvbi1idXR0b24taWNvbi1jb2xvcjojZmY0MDgxOy0tbWF0LWljb24tYnV0dG9uLXN0YXRlLWxheWVyLWNvbG9yOiNmZjQwODE7LS1tYXQtaWNvbi1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMjU1LCA2NCwgMTI5LCAwLjEpfWh0bWwgLm1hdC1tZGMtaWNvbi1idXR0b24ubWF0LXdhcm57LS1tZGMtaWNvbi1idXR0b24taWNvbi1jb2xvcjojZjQ0MzM2Oy0tbWF0LWljb24tYnV0dG9uLXN0YXRlLWxheWVyLWNvbG9yOiNmNDQzMzY7LS1tYXQtaWNvbi1idXR0b24tcmlwcGxlLWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuMSl9aHRtbHstLW1hdC1pY29uLWJ1dHRvbi10b3VjaC10YXJnZXQtZGlzcGxheTpibG9ja30ubWF0LW1kYy1pY29uLWJ1dHRvbi5tYXQtbWRjLWJ1dHRvbi1iYXNley0tbWRjLWljb24tYnV0dG9uLXN0YXRlLWxheWVyLXNpemU6NDhweDt3aWR0aDp2YXIoLS1tZGMtaWNvbi1idXR0b24tc3RhdGUtbGF5ZXItc2l6ZSk7aGVpZ2h0OnZhcigtLW1kYy1pY29uLWJ1dHRvbi1zdGF0ZS1sYXllci1zaXplKTtwYWRkaW5nOjEycHh9aHRtbHstLW1kYy1mYWItY29udGFpbmVyLXNoYXBlOjUwJTstLW1kYy1mYWItaWNvbi1zaXplOjI0cHg7LS1tZGMtZmFiLXNtYWxsLWNvbnRhaW5lci1zaGFwZTo1MCU7LS1tZGMtZmFiLXNtYWxsLWljb24tc2l6ZToyNHB4Oy0tbWRjLWV4dGVuZGVkLWZhYi1jb250YWluZXItaGVpZ2h0OjQ4cHg7LS1tZGMtZXh0ZW5kZWQtZmFiLWNvbnRhaW5lci1zaGFwZToyNHB4fWh0bWx7LS1tZGMtZmFiLWNvbnRhaW5lci1jb2xvcjp3aGl0ZTstLW1kYy1mYWItY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDNweCA1cHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCA2cHggMTBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCAxOHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWZhYi1mb2N1cy1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtZmFiLWhvdmVyLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCA1cHggNXB4IC0zcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggOHB4IDEwcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAzcHggMTRweCAycHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1mYWItcHJlc3NlZC1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggN3B4IDhweCAtNHB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDEycHggMTdweCAycHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDVweCAyMnB4IDRweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWZhYi1jb250YWluZXItc2hhZG93LWNvbG9yOiMwMDA7LS1tYXQtZmFiLWZvcmVncm91bmQtY29sb3I6YmxhY2s7LS1tYXQtZmFiLXN0YXRlLWxheWVyLWNvbG9yOmJsYWNrOy0tbWF0LWZhYi1kaXNhYmxlZC1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1mYWItcmlwcGxlLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKTstLW1hdC1mYWItaG92ZXItc3RhdGUtbGF5ZXItb3BhY2l0eTowLjA0Oy0tbWF0LWZhYi1mb2N1cy1zdGF0ZS1sYXllci1vcGFjaXR5OjAuMTI7LS1tYXQtZmFiLXByZXNzZWQtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWF0LWZhYi1kaXNhYmxlZC1zdGF0ZS1jb250YWluZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1mYWItZGlzYWJsZWQtc3RhdGUtZm9yZWdyb3VuZC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWRjLWZhYi1zbWFsbC1jb250YWluZXItY29sb3I6d2hpdGU7LS1tZGMtZmFiLXNtYWxsLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCAzcHggNXB4IC0xcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggNnB4IDEwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAxcHggMThweCAwcHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1mYWItc21hbGwtZm9jdXMtY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDVweCA1cHggLTNweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCA4cHggMTBweCAxcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDNweCAxNHB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWZhYi1zbWFsbC1ob3Zlci1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtZmFiLXNtYWxsLXByZXNzZWQtY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDdweCA4cHggLTRweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCAxMnB4IDE3cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCA1cHggMjJweCA0cHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1mYWItc21hbGwtY29udGFpbmVyLXNoYWRvdy1jb2xvcjojMDAwOy0tbWF0LWZhYi1zbWFsbC1mb3JlZ3JvdW5kLWNvbG9yOmJsYWNrOy0tbWF0LWZhYi1zbWFsbC1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1mYWItc21hbGwtZGlzYWJsZWQtc3RhdGUtbGF5ZXItY29sb3I6YmxhY2s7LS1tYXQtZmFiLXNtYWxsLXJpcHBsZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSk7LS1tYXQtZmFiLXNtYWxsLWhvdmVyLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4wNDstLW1hdC1mYWItc21hbGwtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyOy0tbWF0LWZhYi1zbWFsbC1wcmVzc2VkLXN0YXRlLWxheWVyLW9wYWNpdHk6MC4xMjstLW1hdC1mYWItc21hbGwtZGlzYWJsZWQtc3RhdGUtY29udGFpbmVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xMik7LS1tYXQtZmFiLXNtYWxsLWRpc2FibGVkLXN0YXRlLWZvcmVncm91bmQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1kYy1leHRlbmRlZC1mYWItY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDNweCA1cHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCA2cHggMTBweCAwcHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDFweCAxOHB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWV4dGVuZGVkLWZhYi1mb2N1cy1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggNXB4IDVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDhweCAxMHB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggM3B4IDE0cHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tZGMtZXh0ZW5kZWQtZmFiLWhvdmVyLWNvbnRhaW5lci1lbGV2YXRpb24tc2hhZG93OjBweCA1cHggNXB4IC0zcHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggOHB4IDEwcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4xNCksIDBweCAzcHggMTRweCAycHggcmdiYSgwLCAwLCAwLCAwLjEyKTstLW1kYy1leHRlbmRlZC1mYWItcHJlc3NlZC1jb250YWluZXItZWxldmF0aW9uLXNoYWRvdzowcHggN3B4IDhweCAtNHB4IHJnYmEoMCwgMCwgMCwgMC4yKSwgMHB4IDEycHggMTdweCAycHggcmdiYSgwLCAwLCAwLCAwLjE0KSwgMHB4IDVweCAyMnB4IDRweCByZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWRjLWV4dGVuZGVkLWZhYi1jb250YWluZXItc2hhZG93LWNvbG9yOiMwMDB9aHRtbCAubWF0LW1kYy1mYWIubWF0LXByaW1hcnl7LS1tZGMtZmFiLWNvbnRhaW5lci1jb2xvcjojM2Y1MWI1Oy0tbWF0LWZhYi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LWZhYi1zdGF0ZS1sYXllci1jb2xvcjp3aGl0ZTstLW1hdC1mYWItcmlwcGxlLWNvbG9yOnJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKX1odG1sIC5tYXQtbWRjLWZhYi5tYXQtYWNjZW50ey0tbWRjLWZhYi1jb250YWluZXItY29sb3I6I2ZmNDA4MTstLW1hdC1mYWItZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1mYWItc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtZmFiLXJpcHBsZS1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSl9aHRtbCAubWF0LW1kYy1mYWIubWF0LXdhcm57LS1tZGMtZmFiLWNvbnRhaW5lci1jb2xvcjojZjQ0MzM2Oy0tbWF0LWZhYi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LWZhYi1zdGF0ZS1sYXllci1jb2xvcjp3aGl0ZTstLW1hdC1mYWItcmlwcGxlLWNvbG9yOnJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKX1odG1sIC5tYXQtbWRjLW1pbmktZmFiLm1hdC1wcmltYXJ5ey0tbWRjLWZhYi1zbWFsbC1jb250YWluZXItY29sb3I6IzNmNTFiNTstLW1hdC1mYWItc21hbGwtZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1mYWItc21hbGwtc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtZmFiLXNtYWxsLXJpcHBsZS1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSl9aHRtbCAubWF0LW1kYy1taW5pLWZhYi5tYXQtYWNjZW50ey0tbWRjLWZhYi1zbWFsbC1jb250YWluZXItY29sb3I6I2ZmNDA4MTstLW1hdC1mYWItc21hbGwtZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1mYWItc21hbGwtc3RhdGUtbGF5ZXItY29sb3I6d2hpdGU7LS1tYXQtZmFiLXNtYWxsLXJpcHBsZS1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSl9aHRtbCAubWF0LW1kYy1taW5pLWZhYi5tYXQtd2FybnstLW1kYy1mYWItc21hbGwtY29udGFpbmVyLWNvbG9yOiNmNDQzMzY7LS1tYXQtZmFiLXNtYWxsLWZvcmVncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtZmFiLXNtYWxsLXN0YXRlLWxheWVyLWNvbG9yOndoaXRlOy0tbWF0LWZhYi1zbWFsbC1yaXBwbGUtY29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpfWh0bWx7LS1tYXQtZmFiLXRvdWNoLXRhcmdldC1kaXNwbGF5OmJsb2NrOy0tbWF0LWZhYi1zbWFsbC10b3VjaC10YXJnZXQtZGlzcGxheTpibG9ja31odG1sey0tbWRjLWV4dGVuZGVkLWZhYi1sYWJlbC10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWRjLWV4dGVuZGVkLWZhYi1sYWJlbC10ZXh0LXNpemU6MTRweDstLW1kYy1leHRlbmRlZC1mYWItbGFiZWwtdGV4dC10cmFja2luZzowLjA4OTI4NTcxNDNlbTstLW1kYy1leHRlbmRlZC1mYWItbGFiZWwtdGV4dC13ZWlnaHQ6NTAwfWh0bWx7LS1tZGMtc25hY2tiYXItY29udGFpbmVyLXNoYXBlOjRweH1odG1sey0tbWRjLXNuYWNrYmFyLWNvbnRhaW5lci1jb2xvcjojMzMzMzMzOy0tbWRjLXNuYWNrYmFyLXN1cHBvcnRpbmctdGV4dC1jb2xvcjpyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuODcpOy0tbWF0LXNuYWNrLWJhci1idXR0b24tY29sb3I6I2ZmNDA4MX1odG1sey0tbWRjLXNuYWNrYmFyLXN1cHBvcnRpbmctdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1kYy1zbmFja2Jhci1zdXBwb3J0aW5nLXRleHQtbGluZS1oZWlnaHQ6MjBweDstLW1kYy1zbmFja2Jhci1zdXBwb3J0aW5nLXRleHQtc2l6ZToxNHB4Oy0tbWRjLXNuYWNrYmFyLXN1cHBvcnRpbmctdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tYXQtdGFibGUtcm93LWl0ZW0tb3V0bGluZS13aWR0aDoxcHh9aHRtbHstLW1hdC10YWJsZS1iYWNrZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXRhYmxlLWhlYWRlci1oZWFkbGluZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuODcpOy0tbWF0LXRhYmxlLXJvdy1pdGVtLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC10YWJsZS1yb3ctaXRlbS1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xMil9aHRtbHstLW1hdC10YWJsZS1oZWFkZXItY29udGFpbmVyLWhlaWdodDo1NnB4Oy0tbWF0LXRhYmxlLWZvb3Rlci1jb250YWluZXItaGVpZ2h0OjUycHg7LS1tYXQtdGFibGUtcm93LWl0ZW0tY29udGFpbmVyLWhlaWdodDo1MnB4fWh0bWx7LS1tYXQtdGFibGUtaGVhZGVyLWhlYWRsaW5lLWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LXRhYmxlLWhlYWRlci1oZWFkbGluZS1saW5lLWhlaWdodDoyMnB4Oy0tbWF0LXRhYmxlLWhlYWRlci1oZWFkbGluZS1zaXplOjE0cHg7LS1tYXQtdGFibGUtaGVhZGVyLWhlYWRsaW5lLXdlaWdodDo1MDA7LS1tYXQtdGFibGUtaGVhZGVyLWhlYWRsaW5lLXRyYWNraW5nOjAuMDA3MTQyODU3MWVtOy0tbWF0LXRhYmxlLXJvdy1pdGVtLWxhYmVsLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtdGFibGUtcm93LWl0ZW0tbGFiZWwtdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWF0LXRhYmxlLXJvdy1pdGVtLWxhYmVsLXRleHQtc2l6ZToxNHB4Oy0tbWF0LXRhYmxlLXJvdy1pdGVtLWxhYmVsLXRleHQtd2VpZ2h0OjQwMDstLW1hdC10YWJsZS1yb3ctaXRlbS1sYWJlbC10ZXh0LXRyYWNraW5nOjAuMDE3ODU3MTQyOWVtOy0tbWF0LXRhYmxlLWZvb3Rlci1zdXBwb3J0aW5nLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtdGFibGUtZm9vdGVyLXN1cHBvcnRpbmctdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWF0LXRhYmxlLWZvb3Rlci1zdXBwb3J0aW5nLXRleHQtc2l6ZToxNHB4Oy0tbWF0LXRhYmxlLWZvb3Rlci1zdXBwb3J0aW5nLXRleHQtd2VpZ2h0OjQwMDstLW1hdC10YWJsZS1mb290ZXItc3VwcG9ydGluZy10ZXh0LXRyYWNraW5nOjAuMDE3ODU3MTQyOWVtfWh0bWx7LS1tZGMtY2lyY3VsYXItcHJvZ3Jlc3MtYWN0aXZlLWluZGljYXRvci13aWR0aDo0cHg7LS1tZGMtY2lyY3VsYXItcHJvZ3Jlc3Mtc2l6ZTo0OHB4fWh0bWx7LS1tZGMtY2lyY3VsYXItcHJvZ3Jlc3MtYWN0aXZlLWluZGljYXRvci1jb2xvcjojM2Y1MWI1fWh0bWwgLm1hdC1hY2NlbnR7LS1tZGMtY2lyY3VsYXItcHJvZ3Jlc3MtYWN0aXZlLWluZGljYXRvci1jb2xvcjojZmY0MDgxfWh0bWwgLm1hdC13YXJuey0tbWRjLWNpcmN1bGFyLXByb2dyZXNzLWFjdGl2ZS1pbmRpY2F0b3ItY29sb3I6I2Y0NDMzNn1odG1sey0tbWF0LWJhZGdlLWNvbnRhaW5lci1zaGFwZTo1MCU7LS1tYXQtYmFkZ2UtY29udGFpbmVyLXNpemU6dW5zZXQ7LS1tYXQtYmFkZ2Utc21hbGwtc2l6ZS1jb250YWluZXItc2l6ZTp1bnNldDstLW1hdC1iYWRnZS1sYXJnZS1zaXplLWNvbnRhaW5lci1zaXplOnVuc2V0Oy0tbWF0LWJhZGdlLWxlZ2FjeS1jb250YWluZXItc2l6ZToyMnB4Oy0tbWF0LWJhZGdlLWxlZ2FjeS1zbWFsbC1zaXplLWNvbnRhaW5lci1zaXplOjE2cHg7LS1tYXQtYmFkZ2UtbGVnYWN5LWxhcmdlLXNpemUtY29udGFpbmVyLXNpemU6MjhweDstLW1hdC1iYWRnZS1jb250YWluZXItb2Zmc2V0Oi0xMXB4IDA7LS1tYXQtYmFkZ2Utc21hbGwtc2l6ZS1jb250YWluZXItb2Zmc2V0Oi04cHggMDstLW1hdC1iYWRnZS1sYXJnZS1zaXplLWNvbnRhaW5lci1vZmZzZXQ6LTE0cHggMDstLW1hdC1iYWRnZS1jb250YWluZXItb3ZlcmxhcC1vZmZzZXQ6LTExcHg7LS1tYXQtYmFkZ2Utc21hbGwtc2l6ZS1jb250YWluZXItb3ZlcmxhcC1vZmZzZXQ6LThweDstLW1hdC1iYWRnZS1sYXJnZS1zaXplLWNvbnRhaW5lci1vdmVybGFwLW9mZnNldDotMTRweDstLW1hdC1iYWRnZS1jb250YWluZXItcGFkZGluZzowOy0tbWF0LWJhZGdlLXNtYWxsLXNpemUtY29udGFpbmVyLXBhZGRpbmc6MDstLW1hdC1iYWRnZS1sYXJnZS1zaXplLWNvbnRhaW5lci1wYWRkaW5nOjB9aHRtbHstLW1hdC1iYWRnZS1iYWNrZ3JvdW5kLWNvbG9yOiMzZjUxYjU7LS1tYXQtYmFkZ2UtdGV4dC1jb2xvcjp3aGl0ZTstLW1hdC1iYWRnZS1kaXNhYmxlZC1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOiNiOWI5Yjk7LS1tYXQtYmFkZ2UtZGlzYWJsZWQtc3RhdGUtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpfS5tYXQtYmFkZ2UtYWNjZW50ey0tbWF0LWJhZGdlLWJhY2tncm91bmQtY29sb3I6I2ZmNDA4MTstLW1hdC1iYWRnZS10ZXh0LWNvbG9yOndoaXRlfS5tYXQtYmFkZ2Utd2FybnstLW1hdC1iYWRnZS1iYWNrZ3JvdW5kLWNvbG9yOiNmNDQzMzY7LS1tYXQtYmFkZ2UtdGV4dC1jb2xvcjp3aGl0ZX1odG1sey0tbWF0LWJhZGdlLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtYmFkZ2UtdGV4dC1zaXplOjEycHg7LS1tYXQtYmFkZ2UtdGV4dC13ZWlnaHQ6NjAwOy0tbWF0LWJhZGdlLXNtYWxsLXNpemUtdGV4dC1zaXplOjlweDstLW1hdC1iYWRnZS1sYXJnZS1zaXplLXRleHQtc2l6ZToyNHB4fWh0bWx7LS1tYXQtYm90dG9tLXNoZWV0LWNvbnRhaW5lci1zaGFwZTo0cHh9aHRtbHstLW1hdC1ib3R0b20tc2hlZXQtY29udGFpbmVyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1ib3R0b20tc2hlZXQtY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6d2hpdGV9aHRtbHstLW1hdC1ib3R0b20tc2hlZXQtY29udGFpbmVyLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtYm90dG9tLXNoZWV0LWNvbnRhaW5lci10ZXh0LWxpbmUtaGVpZ2h0OjIwcHg7LS1tYXQtYm90dG9tLXNoZWV0LWNvbnRhaW5lci10ZXh0LXNpemU6MTRweDstLW1hdC1ib3R0b20tc2hlZXQtY29udGFpbmVyLXRleHQtdHJhY2tpbmc6MC4wMTc4NTcxNDI5ZW07LS1tYXQtYm90dG9tLXNoZWV0LWNvbnRhaW5lci10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1hdC1sZWdhY3ktYnV0dG9uLXRvZ2dsZS1oZWlnaHQ6MzZweDstLW1hdC1sZWdhY3ktYnV0dG9uLXRvZ2dsZS1zaGFwZToycHg7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eToxOy0tbWF0LXN0YW5kYXJkLWJ1dHRvbi10b2dnbGUtc2hhcGU6NHB4Oy0tbWF0LXN0YW5kYXJkLWJ1dHRvbi10b2dnbGUtaG92ZXItc3RhdGUtbGF5ZXItb3BhY2l0eTowLjA0Oy0tbWF0LXN0YW5kYXJkLWJ1dHRvbi10b2dnbGUtZm9jdXMtc3RhdGUtbGF5ZXItb3BhY2l0eTowLjEyfWh0bWx7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LWxlZ2FjeS1idXR0b24tdG9nZ2xlLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xMik7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtc2VsZWN0ZWQtc3RhdGUtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWxlZ2FjeS1idXR0b24tdG9nZ2xlLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6I2UwZTBlMDstLW1hdC1sZWdhY3ktYnV0dG9uLXRvZ2dsZS1kaXNhYmxlZC1zdGF0ZS10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yNik7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtZGlzYWJsZWQtc3RhdGUtYmFja2dyb3VuZC1jb2xvcjojZWVlZWVlOy0tbWF0LWxlZ2FjeS1idXR0b24tdG9nZ2xlLWRpc2FibGVkLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6I2JkYmRiZDstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RhbmRhcmQtYnV0dG9uLXRvZ2dsZS1zdGF0ZS1sYXllci1jb2xvcjpibGFjazstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6I2UwZTBlMDstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLXNlbGVjdGVkLXN0YXRlLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWRpc2FibGVkLXN0YXRlLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjI2KTstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWRpc2FibGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RhbmRhcmQtYnV0dG9uLXRvZ2dsZS1kaXNhYmxlZC1zZWxlY3RlZC1zdGF0ZS10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtc3RhbmRhcmQtYnV0dG9uLXRvZ2dsZS1kaXNhYmxlZC1zZWxlY3RlZC1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOiNiZGJkYmQ7LS1tYXQtc3RhbmRhcmQtYnV0dG9uLXRvZ2dsZS1kaXZpZGVyLWNvbG9yOiNlMGUwZTB9aHRtbHstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWhlaWdodDo0OHB4fWh0bWx7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC1sZWdhY3ktYnV0dG9uLXRvZ2dsZS1sYWJlbC10ZXh0LWxpbmUtaGVpZ2h0OjI0cHg7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC1zaXplOjE2cHg7LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC10cmFja2luZzowLjAzMTI1ZW07LS1tYXQtbGVnYWN5LWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC13ZWlnaHQ6NDAwOy0tbWF0LXN0YW5kYXJkLWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWxhYmVsLXRleHQtbGluZS1oZWlnaHQ6MjRweDstLW1hdC1zdGFuZGFyZC1idXR0b24tdG9nZ2xlLWxhYmVsLXRleHQtc2l6ZToxNnB4Oy0tbWF0LXN0YW5kYXJkLWJ1dHRvbi10b2dnbGUtbGFiZWwtdGV4dC10cmFja2luZzowLjAzMTI1ZW07LS1tYXQtc3RhbmRhcmQtYnV0dG9uLXRvZ2dsZS1sYWJlbC10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWNvbnRhaW5lci1zaGFwZTo0cHg7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1jb250YWluZXItdG91Y2gtc2hhcGU6NHB4Oy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDJweCA0cHggLTFweCByZ2JhKDAsIDAsIDAsIDAuMiksIDBweCA0cHggNXB4IDBweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggMXB4IDEwcHggMHB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1jb250YWluZXItdG91Y2gtZWxldmF0aW9uLXNoYWRvdzowcHggMTFweCAxNXB4IC03cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMjRweCAzOHB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggOXB4IDQ2cHggOHB4IHJnYmEoMCwgMCwgMCwgMC4xMil9aHRtbHstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtc2VsZWN0ZWQtc3RhdGUtdGV4dC1jb2xvcjp3aGl0ZTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtc2VsZWN0ZWQtc3RhdGUtYmFja2dyb3VuZC1jb2xvcjojM2Y1MWI1Oy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1zZWxlY3RlZC1kaXNhYmxlZC1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOnJnYmEoNjMsIDgxLCAxODEsIDAuNCk7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLXRvZGF5LXNlbGVjdGVkLXN0YXRlLW91dGxpbmUtY29sb3I6d2hpdGU7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWZvY3VzLXN0YXRlLWJhY2tncm91bmQtY29sb3I6cmdiYSg2MywgODEsIDE4MSwgMC4zKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaG92ZXItc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDYzLCA4MSwgMTgxLCAwLjMpOy0tbWF0LWRhdGVwaWNrZXItdG9nZ2xlLWFjdGl2ZS1zdGF0ZS1pY29uLWNvbG9yOiMzZjUxYjU7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWluLXJhbmdlLXN0YXRlLWJhY2tncm91bmQtY29sb3I6cmdiYSg2MywgODEsIDE4MSwgMC4yKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaW4tY29tcGFyaXNvbi1yYW5nZS1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOnJnYmEoMjQ5LCAxNzEsIDAsIDAuMik7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWluLW92ZXJsYXAtcmFuZ2Utc3RhdGUtYmFja2dyb3VuZC1jb2xvcjojYThkYWI1Oy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1pbi1vdmVybGFwLXJhbmdlLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6IzQ2YTM1ZTstLW1hdC1kYXRlcGlja2VyLXRvZ2dsZS1pY29uLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1ib2R5LWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLXBlcmlvZC1idXR0b24tdGV4dC1jb2xvcjpibGFjazstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLXBlcmlvZC1idXR0b24taWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItbmF2aWdhdGlvbi1idXR0b24taWNvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItaGVhZGVyLWRpdmlkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWhlYWRlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCk7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLXRvZGF5LW91dGxpbmUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtdG9kYXktZGlzYWJsZWQtc3RhdGUtb3V0bGluZS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTgpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLW91dGxpbmUtY29sb3I6dHJhbnNwYXJlbnQ7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWRpc2FibGVkLXN0YXRlLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjM4KTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtcHJldmlldy1zdGF0ZS1vdXRsaW5lLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yNCk7LS1tYXQtZGF0ZXBpY2tlci1yYW5nZS1pbnB1dC1zZXBhcmF0b3ItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1kYXRlcGlja2VyLXJhbmdlLWlucHV0LWRpc2FibGVkLXN0YXRlLXNlcGFyYXRvci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LWRhdGVwaWNrZXItcmFuZ2UtaW5wdXQtZGlzYWJsZWQtc3RhdGUtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMzgpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1jb250YWluZXItdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuODcpfS5tYXQtZGF0ZXBpY2tlci1jb250ZW50Lm1hdC1hY2NlbnR7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLXNlbGVjdGVkLXN0YXRlLXRleHQtY29sb3I6d2hpdGU7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6I2ZmNDA4MTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtc2VsZWN0ZWQtZGlzYWJsZWQtc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC40KTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtdG9kYXktc2VsZWN0ZWQtc3RhdGUtb3V0bGluZS1jb2xvcjp3aGl0ZTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtZm9jdXMtc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC4zKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaG92ZXItc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC4zKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaW4tcmFuZ2Utc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI1NSwgNjQsIDEyOSwgMC4yKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaW4tY29tcGFyaXNvbi1yYW5nZS1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOnJnYmEoMjQ5LCAxNzEsIDAsIDAuMik7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWluLW92ZXJsYXAtcmFuZ2Utc3RhdGUtYmFja2dyb3VuZC1jb2xvcjojYThkYWI1Oy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1pbi1vdmVybGFwLXJhbmdlLXNlbGVjdGVkLXN0YXRlLWJhY2tncm91bmQtY29sb3I6IzQ2YTM1ZX0ubWF0LWRhdGVwaWNrZXItY29udGVudC5tYXQtd2FybnstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtc2VsZWN0ZWQtc3RhdGUtdGV4dC1jb2xvcjp3aGl0ZTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtc2VsZWN0ZWQtc3RhdGUtYmFja2dyb3VuZC1jb2xvcjojZjQ0MzM2Oy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1zZWxlY3RlZC1kaXNhYmxlZC1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuNCk7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLXRvZGF5LXNlbGVjdGVkLXN0YXRlLW91dGxpbmUtY29sb3I6d2hpdGU7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWZvY3VzLXN0YXRlLWJhY2tncm91bmQtY29sb3I6cmdiYSgyNDQsIDY3LCA1NCwgMC4zKTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaG92ZXItc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI0NCwgNjcsIDU0LCAwLjMpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1pbi1yYW5nZS1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOnJnYmEoMjQ0LCA2NywgNTQsIDAuMik7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1kYXRlLWluLWNvbXBhcmlzb24tcmFuZ2Utc3RhdGUtYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDI0OSwgMTcxLCAwLCAwLjIpOy0tbWF0LWRhdGVwaWNrZXItY2FsZW5kYXItZGF0ZS1pbi1vdmVybGFwLXJhbmdlLXN0YXRlLWJhY2tncm91bmQtY29sb3I6I2E4ZGFiNTstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWRhdGUtaW4tb3ZlcmxhcC1yYW5nZS1zZWxlY3RlZC1zdGF0ZS1iYWNrZ3JvdW5kLWNvbG9yOiM0NmEzNWV9Lm1hdC1kYXRlcGlja2VyLXRvZ2dsZS1hY3RpdmUubWF0LWFjY2VudHstLW1hdC1kYXRlcGlja2VyLXRvZ2dsZS1hY3RpdmUtc3RhdGUtaWNvbi1jb2xvcjojZmY0MDgxfS5tYXQtZGF0ZXBpY2tlci10b2dnbGUtYWN0aXZlLm1hdC13YXJuey0tbWF0LWRhdGVwaWNrZXItdG9nZ2xlLWFjdGl2ZS1zdGF0ZS1pY29uLWNvbG9yOiNmNDQzMzZ9Lm1hdC1jYWxlbmRhci1jb250cm9sc3stLW1hdC1pY29uLWJ1dHRvbi10b3VjaC10YXJnZXQtZGlzcGxheTpub25lfS5tYXQtY2FsZW5kYXItY29udHJvbHMgLm1hdC1tZGMtaWNvbi1idXR0b24ubWF0LW1kYy1idXR0b24tYmFzZXstLW1kYy1pY29uLWJ1dHRvbi1zdGF0ZS1sYXllci1zaXplOjQwcHg7d2lkdGg6dmFyKC0tbWRjLWljb24tYnV0dG9uLXN0YXRlLWxheWVyLXNpemUpO2hlaWdodDp2YXIoLS1tZGMtaWNvbi1idXR0b24tc3RhdGUtbGF5ZXItc2l6ZSk7cGFkZGluZzo4cHh9aHRtbHstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci10ZXh0LXNpemU6MTNweDstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWJvZHktbGFiZWwtdGV4dC1zaXplOjE0cHg7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1ib2R5LWxhYmVsLXRleHQtd2VpZ2h0OjUwMDstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLXBlcmlvZC1idXR0b24tdGV4dC1zaXplOjE0cHg7LS1tYXQtZGF0ZXBpY2tlci1jYWxlbmRhci1wZXJpb2QtYnV0dG9uLXRleHQtd2VpZ2h0OjUwMDstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWhlYWRlci10ZXh0LXNpemU6MTFweDstLW1hdC1kYXRlcGlja2VyLWNhbGVuZGFyLWhlYWRlci10ZXh0LXdlaWdodDo0MDB9aHRtbHstLW1hdC1kaXZpZGVyLXdpZHRoOjFweH1odG1sey0tbWF0LWRpdmlkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKX1odG1sey0tbWF0LWV4cGFuc2lvbi1jb250YWluZXItc2hhcGU6NHB4Oy0tbWF0LWV4cGFuc2lvbi1sZWdhY3ktaGVhZGVyLWluZGljYXRvci1kaXNwbGF5OmlubGluZS1ibG9jazstLW1hdC1leHBhbnNpb24taGVhZGVyLWluZGljYXRvci1kaXNwbGF5Om5vbmV9aHRtbHstLW1hdC1leHBhbnNpb24tY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtZXhwYW5zaW9uLWNvbnRhaW5lci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtZXhwYW5zaW9uLWFjdGlvbnMtZGl2aWRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTIpOy0tbWF0LWV4cGFuc2lvbi1oZWFkZXItaG92ZXItc3RhdGUtbGF5ZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjA0KTstLW1hdC1leHBhbnNpb24taGVhZGVyLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNCk7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci1kaXNhYmxlZC1zdGF0ZS10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yNik7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci1kZXNjcmlwdGlvbi1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LWV4cGFuc2lvbi1oZWFkZXItaW5kaWNhdG9yLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC41NCl9aHRtbHstLW1hdC1leHBhbnNpb24taGVhZGVyLWNvbGxhcHNlZC1zdGF0ZS1oZWlnaHQ6NDhweDstLW1hdC1leHBhbnNpb24taGVhZGVyLWV4cGFuZGVkLXN0YXRlLWhlaWdodDo2NHB4fWh0bWx7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LWV4cGFuc2lvbi1oZWFkZXItdGV4dC1zaXplOjE0cHg7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci10ZXh0LXdlaWdodDo1MDA7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci10ZXh0LWxpbmUtaGVpZ2h0OmluaGVyaXQ7LS1tYXQtZXhwYW5zaW9uLWhlYWRlci10ZXh0LXRyYWNraW5nOmluaGVyaXQ7LS1tYXQtZXhwYW5zaW9uLWNvbnRhaW5lci10ZXh0LWZvbnQ6Um9ib3RvLCBzYW5zLXNlcmlmOy0tbWF0LWV4cGFuc2lvbi1jb250YWluZXItdGV4dC1saW5lLWhlaWdodDoyMHB4Oy0tbWF0LWV4cGFuc2lvbi1jb250YWluZXItdGV4dC1zaXplOjE0cHg7LS1tYXQtZXhwYW5zaW9uLWNvbnRhaW5lci10ZXh0LXRyYWNraW5nOjAuMDE3ODU3MTQyOWVtOy0tbWF0LWV4cGFuc2lvbi1jb250YWluZXItdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tYXQtZ3JpZC1saXN0LXRpbGUtaGVhZGVyLXByaW1hcnktdGV4dC1zaXplOjE0cHg7LS1tYXQtZ3JpZC1saXN0LXRpbGUtaGVhZGVyLXNlY29uZGFyeS10ZXh0LXNpemU6MTJweDstLW1hdC1ncmlkLWxpc3QtdGlsZS1mb290ZXItcHJpbWFyeS10ZXh0LXNpemU6MTRweDstLW1hdC1ncmlkLWxpc3QtdGlsZS1mb290ZXItc2Vjb25kYXJ5LXRleHQtc2l6ZToxMnB4fWh0bWx7LS1tYXQtaWNvbi1jb2xvcjppbmhlcml0fS5tYXQtaWNvbi5tYXQtcHJpbWFyeXstLW1hdC1pY29uLWNvbG9yOiMzZjUxYjV9Lm1hdC1pY29uLm1hdC1hY2NlbnR7LS1tYXQtaWNvbi1jb2xvcjojZmY0MDgxfS5tYXQtaWNvbi5tYXQtd2FybnstLW1hdC1pY29uLWNvbG9yOiNmNDQzMzZ9aHRtbHstLW1hdC1zaWRlbmF2LWNvbnRhaW5lci1zaGFwZTowOy0tbWF0LXNpZGVuYXYtY29udGFpbmVyLWVsZXZhdGlvbi1zaGFkb3c6MHB4IDhweCAxMHB4IC01cHggcmdiYSgwLCAwLCAwLCAwLjIpLCAwcHggMTZweCAyNHB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMTQpLCAwcHggNnB4IDMwcHggNXB4IHJnYmEoMCwgMCwgMCwgMC4xMik7LS1tYXQtc2lkZW5hdi1jb250YWluZXItd2lkdGg6YXV0b31odG1sey0tbWF0LXNpZGVuYXYtY29udGFpbmVyLWRpdmlkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1zaWRlbmF2LWNvbnRhaW5lci1iYWNrZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXNpZGVuYXYtY29udGFpbmVyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KTstLW1hdC1zaWRlbmF2LWNvbnRlbnQtYmFja2dyb3VuZC1jb2xvcjojZmFmYWZhOy0tbWF0LXNpZGVuYXYtY29udGVudC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtc2lkZW5hdi1zY3JpbS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNil9aHRtbHstLW1hdC1zdGVwcGVyLWhlYWRlci1pY29uLWZvcmVncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtaWNvbi1iYWNrZ3JvdW5kLWNvbG9yOiMzZjUxYjU7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtaWNvbi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXN0ZXBwZXItaGVhZGVyLWRvbmUtc3RhdGUtaWNvbi1iYWNrZ3JvdW5kLWNvbG9yOiMzZjUxYjU7LS1tYXQtc3RlcHBlci1oZWFkZXItZG9uZS1zdGF0ZS1pY29uLWZvcmVncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RlcHBlci1oZWFkZXItZWRpdC1zdGF0ZS1pY29uLWJhY2tncm91bmQtY29sb3I6IzNmNTFiNTstLW1hdC1zdGVwcGVyLWhlYWRlci1lZGl0LXN0YXRlLWljb24tZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1zdGVwcGVyLWNvbnRhaW5lci1jb2xvcjp3aGl0ZTstLW1hdC1zdGVwcGVyLWxpbmUtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEyKTstLW1hdC1zdGVwcGVyLWhlYWRlci1ob3Zlci1zdGF0ZS1sYXllci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMDQpOy0tbWF0LXN0ZXBwZXItaGVhZGVyLWZvY3VzLXN0YXRlLWxheWVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4wNCk7LS1tYXQtc3RlcHBlci1oZWFkZXItbGFiZWwtdGV4dC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LXN0ZXBwZXItaGVhZGVyLW9wdGlvbmFsLWxhYmVsLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjU0KTstLW1hdC1zdGVwcGVyLWhlYWRlci1zZWxlY3RlZC1zdGF0ZS1sYWJlbC10ZXh0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC44Nyk7LS1tYXQtc3RlcHBlci1oZWFkZXItZXJyb3Itc3RhdGUtbGFiZWwtdGV4dC1jb2xvcjojZjQ0MzM2Oy0tbWF0LXN0ZXBwZXItaGVhZGVyLWljb24tYmFja2dyb3VuZC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNTQpOy0tbWF0LXN0ZXBwZXItaGVhZGVyLWVycm9yLXN0YXRlLWljb24tZm9yZWdyb3VuZC1jb2xvcjojZjQ0MzM2Oy0tbWF0LXN0ZXBwZXItaGVhZGVyLWVycm9yLXN0YXRlLWljb24tYmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudH1odG1sIC5tYXQtc3RlcC1oZWFkZXIubWF0LWFjY2VudHstLW1hdC1zdGVwcGVyLWhlYWRlci1pY29uLWZvcmVncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtaWNvbi1iYWNrZ3JvdW5kLWNvbG9yOiNmZjQwODE7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtaWNvbi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXN0ZXBwZXItaGVhZGVyLWRvbmUtc3RhdGUtaWNvbi1iYWNrZ3JvdW5kLWNvbG9yOiNmZjQwODE7LS1tYXQtc3RlcHBlci1oZWFkZXItZG9uZS1zdGF0ZS1pY29uLWZvcmVncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtc3RlcHBlci1oZWFkZXItZWRpdC1zdGF0ZS1pY29uLWJhY2tncm91bmQtY29sb3I6I2ZmNDA4MTstLW1hdC1zdGVwcGVyLWhlYWRlci1lZGl0LXN0YXRlLWljb24tZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZX1odG1sIC5tYXQtc3RlcC1oZWFkZXIubWF0LXdhcm57LS1tYXQtc3RlcHBlci1oZWFkZXItaWNvbi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXN0ZXBwZXItaGVhZGVyLXNlbGVjdGVkLXN0YXRlLWljb24tYmFja2dyb3VuZC1jb2xvcjojZjQ0MzM2Oy0tbWF0LXN0ZXBwZXItaGVhZGVyLXNlbGVjdGVkLXN0YXRlLWljb24tZm9yZWdyb3VuZC1jb2xvcjp3aGl0ZTstLW1hdC1zdGVwcGVyLWhlYWRlci1kb25lLXN0YXRlLWljb24tYmFja2dyb3VuZC1jb2xvcjojZjQ0MzM2Oy0tbWF0LXN0ZXBwZXItaGVhZGVyLWRvbmUtc3RhdGUtaWNvbi1mb3JlZ3JvdW5kLWNvbG9yOndoaXRlOy0tbWF0LXN0ZXBwZXItaGVhZGVyLWVkaXQtc3RhdGUtaWNvbi1iYWNrZ3JvdW5kLWNvbG9yOiNmNDQzMzY7LS1tYXQtc3RlcHBlci1oZWFkZXItZWRpdC1zdGF0ZS1pY29uLWZvcmVncm91bmQtY29sb3I6d2hpdGV9aHRtbHstLW1hdC1zdGVwcGVyLWhlYWRlci1oZWlnaHQ6NzJweH1odG1sey0tbWF0LXN0ZXBwZXItY29udGFpbmVyLXRleHQtZm9udDpSb2JvdG8sIHNhbnMtc2VyaWY7LS1tYXQtc3RlcHBlci1oZWFkZXItbGFiZWwtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC1zdGVwcGVyLWhlYWRlci1sYWJlbC10ZXh0LXNpemU6MTRweDstLW1hdC1zdGVwcGVyLWhlYWRlci1sYWJlbC10ZXh0LXdlaWdodDo0MDA7LS1tYXQtc3RlcHBlci1oZWFkZXItZXJyb3Itc3RhdGUtbGFiZWwtdGV4dC1zaXplOjE2cHg7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtbGFiZWwtdGV4dC1zaXplOjE2cHg7LS1tYXQtc3RlcHBlci1oZWFkZXItc2VsZWN0ZWQtc3RhdGUtbGFiZWwtdGV4dC13ZWlnaHQ6NDAwfWh0bWx7LS1tYXQtc29ydC1hcnJvdy1jb2xvcjojNzU3NTc1fWh0bWx7LS1tYXQtdG9vbGJhci1jb250YWluZXItYmFja2dyb3VuZC1jb2xvcjp3aGl0ZXNtb2tlOy0tbWF0LXRvb2xiYXItY29udGFpbmVyLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX0ubWF0LXRvb2xiYXIubWF0LXByaW1hcnl7LS1tYXQtdG9vbGJhci1jb250YWluZXItYmFja2dyb3VuZC1jb2xvcjojM2Y1MWI1Oy0tbWF0LXRvb2xiYXItY29udGFpbmVyLXRleHQtY29sb3I6d2hpdGV9Lm1hdC10b29sYmFyLm1hdC1hY2NlbnR7LS1tYXQtdG9vbGJhci1jb250YWluZXItYmFja2dyb3VuZC1jb2xvcjojZmY0MDgxOy0tbWF0LXRvb2xiYXItY29udGFpbmVyLXRleHQtY29sb3I6d2hpdGV9Lm1hdC10b29sYmFyLm1hdC13YXJuey0tbWF0LXRvb2xiYXItY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6I2Y0NDMzNjstLW1hdC10b29sYmFyLWNvbnRhaW5lci10ZXh0LWNvbG9yOndoaXRlfWh0bWx7LS1tYXQtdG9vbGJhci1zdGFuZGFyZC1oZWlnaHQ6NjRweDstLW1hdC10b29sYmFyLW1vYmlsZS1oZWlnaHQ6NTZweH1odG1sey0tbWF0LXRvb2xiYXItdGl0bGUtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC10b29sYmFyLXRpdGxlLXRleHQtbGluZS1oZWlnaHQ6MzJweDstLW1hdC10b29sYmFyLXRpdGxlLXRleHQtc2l6ZToyMHB4Oy0tbWF0LXRvb2xiYXItdGl0bGUtdGV4dC10cmFja2luZzowLjAxMjVlbTstLW1hdC10b29sYmFyLXRpdGxlLXRleHQtd2VpZ2h0OjUwMH1odG1sey0tbWF0LXRyZWUtY29udGFpbmVyLWJhY2tncm91bmQtY29sb3I6d2hpdGU7LS1tYXQtdHJlZS1ub2RlLXRleHQtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjg3KX1odG1sey0tbWF0LXRyZWUtbm9kZS1taW4taGVpZ2h0OjQ4cHh9aHRtbHstLW1hdC10cmVlLW5vZGUtdGV4dC1mb250OlJvYm90bywgc2Fucy1zZXJpZjstLW1hdC10cmVlLW5vZGUtdGV4dC1zaXplOjE0cHg7LS1tYXQtdHJlZS1ub2RlLXRleHQtd2VpZ2h0OjQwMH0ubWF0LWgxLC5tYXQtaGVhZGxpbmUtNSwubWF0LXR5cG9ncmFwaHkgLm1hdC1oMSwubWF0LXR5cG9ncmFwaHkgLm1hdC1oZWFkbGluZS01LC5tYXQtdHlwb2dyYXBoeSBoMXtmb250OjQwMCAyNHB4LzMycHggUm9ib3RvLCBzYW5zLXNlcmlmO2xldHRlci1zcGFjaW5nOm5vcm1hbDttYXJnaW46MCAwIDE2cHh9Lm1hdC1oMiwubWF0LWhlYWRsaW5lLTYsLm1hdC10eXBvZ3JhcGh5IC5tYXQtaDIsLm1hdC10eXBvZ3JhcGh5IC5tYXQtaGVhZGxpbmUtNiwubWF0LXR5cG9ncmFwaHkgaDJ7Zm9udDo1MDAgMjBweC8zMnB4IFJvYm90bywgc2Fucy1zZXJpZjtsZXR0ZXItc3BhY2luZzouMDEyNWVtO21hcmdpbjowIDAgMTZweH0ubWF0LWgzLC5tYXQtc3VidGl0bGUtMSwubWF0LXR5cG9ncmFwaHkgLm1hdC1oMywubWF0LXR5cG9ncmFwaHkgLm1hdC1zdWJ0aXRsZS0xLC5tYXQtdHlwb2dyYXBoeSBoM3tmb250OjQwMCAxNnB4LzI4cHggUm9ib3RvLCBzYW5zLXNlcmlmO2xldHRlci1zcGFjaW5nOi4wMDkzNzVlbTttYXJnaW46MCAwIDE2cHh9Lm1hdC1oNCwubWF0LWJvZHktMSwubWF0LXR5cG9ncmFwaHkgLm1hdC1oNCwubWF0LXR5cG9ncmFwaHkgLm1hdC1ib2R5LTEsLm1hdC10eXBvZ3JhcGh5IGg0e2ZvbnQ6NDAwIDE2cHgvMjRweCBSb2JvdG8sIHNhbnMtc2VyaWY7bGV0dGVyLXNwYWNpbmc6LjAzMTI1ZW07bWFyZ2luOjAgMCAxNnB4fS5tYXQtaDUsLm1hdC10eXBvZ3JhcGh5IC5tYXQtaDUsLm1hdC10eXBvZ3JhcGh5IGg1e2ZvbnQ6NDAwIGNhbGMoMTRweCouODMpLzIwcHggUm9ib3RvLCBzYW5zLXNlcmlmO21hcmdpbjowIDAgMTJweH0ubWF0LWg2LC5tYXQtdHlwb2dyYXBoeSAubWF0LWg2LC5tYXQtdHlwb2dyYXBoeSBoNntmb250OjQwMCBjYWxjKDE0cHgqLjY3KS8yMHB4IFJvYm90bywgc2Fucy1zZXJpZjttYXJnaW46MCAwIDEycHh9Lm1hdC1ib2R5LXN0cm9uZywubWF0LXN1YnRpdGxlLTIsLm1hdC10eXBvZ3JhcGh5IC5tYXQtYm9keS1zdHJvbmcsLm1hdC10eXBvZ3JhcGh5IC5tYXQtc3VidGl0bGUtMntmb250OjUwMCAxNHB4LzIycHggUm9ib3RvLCBzYW5zLXNlcmlmO2xldHRlci1zcGFjaW5nOi4wMDcxNDI4NTcxZW19Lm1hdC1ib2R5LC5tYXQtYm9keS0yLC5tYXQtdHlwb2dyYXBoeSAubWF0LWJvZHksLm1hdC10eXBvZ3JhcGh5IC5tYXQtYm9keS0yLC5tYXQtdHlwb2dyYXBoeXtmb250OjQwMCAxNHB4LzIwcHggUm9ib3RvLCBzYW5zLXNlcmlmO2xldHRlci1zcGFjaW5nOi4wMTc4NTcxNDI5ZW19Lm1hdC1ib2R5IHAsLm1hdC1ib2R5LTIgcCwubWF0LXR5cG9ncmFwaHkgLm1hdC1ib2R5IHAsLm1hdC10eXBvZ3JhcGh5IC5tYXQtYm9keS0yIHAsLm1hdC10eXBvZ3JhcGh5IHB7bWFyZ2luOjAgMCAxMnB4fS5tYXQtc21hbGwsLm1hdC1jYXB0aW9uLC5tYXQtdHlwb2dyYXBoeSAubWF0LXNtYWxsLC5tYXQtdHlwb2dyYXBoeSAubWF0LWNhcHRpb257Zm9udDo0MDAgMTJweC8yMHB4IFJvYm90bywgc2Fucy1zZXJpZjtsZXR0ZXItc3BhY2luZzouMDMzMzMzMzMzM2VtfS5tYXQtaGVhZGxpbmUtMSwubWF0LXR5cG9ncmFwaHkgLm1hdC1oZWFkbGluZS0xe2ZvbnQ6MzAwIDk2cHgvOTZweCBSb2JvdG8sIHNhbnMtc2VyaWY7bGV0dGVyLXNwYWNpbmc6LTAuMDE1NjI1ZW07bWFyZ2luOjAgMCA1NnB4fS5tYXQtaGVhZGxpbmUtMiwubWF0LXR5cG9ncmFwaHkgLm1hdC1oZWFkbGluZS0ye2ZvbnQ6MzAwIDYwcHgvNjBweCBSb2JvdG8sIHNhbnMtc2VyaWY7bGV0dGVyLXNwYWNpbmc6LS4wMDgzMzMzMzMzZW07bWFyZ2luOjAgMCA2NHB4fS5tYXQtaGVhZGxpbmUtMywubWF0LXR5cG9ncmFwaHkgLm1hdC1oZWFkbGluZS0ze2ZvbnQ6NDAwIDQ4cHgvNTBweCBSb2JvdG8sIHNhbnMtc2VyaWY7bGV0dGVyLXNwYWNpbmc6bm9ybWFsO21hcmdpbjowIDAgNjRweH0ubWF0LWhlYWRsaW5lLTQsLm1hdC10eXBvZ3JhcGh5IC5tYXQtaGVhZGxpbmUtNHtmb250OjQwMCAzNHB4LzQwcHggUm9ib3RvLCBzYW5zLXNlcmlmO2xldHRlci1zcGFjaW5nOi4wMDczNTI5NDEyZW07bWFyZ2luOjAgMCA2NHB4fSJdLCJzb3VyY2VSb290IjoiIn0= */[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n.contenedor_tabla[_ngcontent-%COMP%] {\n  display: grid;\n  border-radius: 5px;\n  border: 1px solid rgba(128, 128, 128, 0.3);\n  overflow-x: auto;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%] {\n  overflow-x: auto;\n  box-shadow: none !important;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%] {\n  width: 100%;\n  box-shadow: none !important;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   td[_ngcontent-%COMP%], .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%] {\n  width: 200px;\n  min-width: 150px;\n  font-size: 0.8em;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%] {\n  position: sticky;\n  font-size: 1em;\n  font-weight: bold;\n  top: 0;\n  background: linear-gradient(to bottom, #fff, #fff), linear-gradient(to bottom, rgba(64, 69, 108, 0.3), rgba(64, 69, 108, 0.2));\n  background-blend-mode: multiply;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-header-row[_ngcontent-%COMP%] {\n  height: 40px;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%] {\n  transition: all 0.1s;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%]:hover {\n  background-color: rgba(64, 69, 108, 0.05);\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%] {\n  display: grid;\n  align-items: end;\n  height: 56px;\n}\n@media (max-width: 620px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container {\n    align-items: center;\n    justify-content: center;\n    justify-items: center;\n  }\n}\n@media (max-width: 455px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container {\n    margin-top: -25px;\n  }\n}\n@media (max-width: 620px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container .mat-mdc-paginator-range-actions {\n    display: grid;\n    grid-template-columns: repeat(4, 1fr);\n    justify-items: center;\n  }\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container .mat-mdc-paginator-range-actions div {\n    grid-column: 1/-1;\n  }\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-page-size-label {\n  display: none;\n}\n\n  .noExisteRegistro {\n  display: grid;\n  height: 40%;\n  font-size: 1.2em;\n  text-align: center;\n  align-content: end;\n  color: #808080;\n}\n\n.contenedor_general[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 5px;\n  box-shadow: none;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%] {\n  display: grid;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%] {\n  display: none;\n}\n@media (max-width: 700px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%] {\n    display: grid;\n    grid-template-columns: repeat(2, 1fr);\n    padding: 0 20px;\n    border-radius: 10px;\n    background-color: rgba(128, 128, 128, 0.2);\n    cursor: pointer;\n  }\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%]   .text_list[_ngcontent-%COMP%] {\n    font-weight: bold;\n    color: rgba(0, 0, 0, 0.7);\n  }\n}\n@media (max-width: 700px) and (max-width: 500px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%]   .text_list[_ngcontent-%COMP%] {\n    font-size: 1.2em;\n  }\n}\n@media (max-width: 700px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%]   .icon_list[_ngcontent-%COMP%] {\n    display: grid;\n    align-items: center;\n    text-align: right;\n    color: rgba(0, 0, 0, 0.7);\n  }\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_list[_ngcontent-%COMP%]   .icon_list[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n    font-size: 1.2em;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%] {\n  display: none;\n  grid-template-columns: repeat(4, 1fr);\n  gap: 10px;\n}\n@media (max-width: 1200px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%] {\n    grid-template-columns: repeat(3, 1fr);\n    row-gap: 0px;\n  }\n}\n@media (max-width: 700px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%] {\n    display: grid;\n    grid-template-columns: repeat(2, 1fr);\n  }\n}\n@media (max-width: 500px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%]   .mat-form-field.mat-focused[_ngcontent-%COMP%] {\n  display: grid;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_list_filtros[_ngcontent-%COMP%]   .contenedor_filtros[_ngcontent-%COMP%]   .input[_ngcontent-%COMP%] {\n  width: 95%;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%] {\n  display: grid;\n  align-items: center;\n  grid-template-columns: 1fr 1fr;\n  gap: 10px;\n}\n@media (max-width: 700px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr;\n    padding-top: 10px;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%] {\n  display: flex;\n  gap: 10px;\n}\n@media (max-width: 700px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%] {\n    justify-content: center;\n  }\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .btn_filtro[_ngcontent-%COMP%] {\n    display: none;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .icon-charge[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n  width: 30px;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_buscador[_ngcontent-%COMP%] {\n  display: grid;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_buscador[_ngcontent-%COMP%]   div[_ngcontent-%COMP%] {\n  position: relative;\n  display: grid;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_buscador[_ngcontent-%COMP%]   div[_ngcontent-%COMP%]   .input[_ngcontent-%COMP%] {\n  padding-right: 40px;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_acciones_tabla[_ngcontent-%COMP%]   .contenedor_buscador[_ngcontent-%COMP%]   div[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  position: absolute;\n  display: grid;\n  right: 10px;\n  font-size: 25px;\n  color: rgba(0, 0, 0, 0.4);\n  transform: translate(0%, 50%);\n}\n@media (max-width: 860px) {\n  .contenedor_general[_ngcontent-%COMP%]   .sidebar_active_content_acciones_tabla[_ngcontent-%COMP%] {\n    grid-template-columns: 1fr;\n  }\n  .contenedor_general[_ngcontent-%COMP%]   .sidebar_active_content_acciones_tabla[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%] {\n    justify-content: center;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%] {\n  max-height: 535px;\n  min-height: 535px;\n}\n@media (max-width: 620px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%] {\n    max-height: 635px;\n    min-height: 635px;\n  }\n}\n@media (max-width: 460px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%] {\n    max-height: 635px;\n    min-height: 635px;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%] {\n  height: 460px;\n}\n@media (max-width: 620px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%] {\n    height: 535px;\n  }\n}\n@media (max-width: 450px) {\n  .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%] {\n    height: 485px;\n  }\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%] {\n  height: 35px;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-num[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-num[_ngcontent-%COMP%] {\n  min-width: 30px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .APELLIDO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .APELLIDO_user-cell[_ngcontent-%COMP%] {\n  min-width: 130px !important;\n  -webkit-user-select: text !important;\n          user-select: text !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOMBRE-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOMBRE-cell[_ngcontent-%COMP%] {\n  min-width: 130px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ID-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ID-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 100px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .CEDULA-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .CEDULA-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 100px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .A_CONOCIMIENTO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .A_CONOCIMIENTO-cell[_ngcontent-%COMP%] {\n  min-width: 180px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .DEPARTAMENTO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .DEPARTAMENTO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 100px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .CURSO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .CURSO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NRC-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NRC-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ESTADO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ESTADO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .PROMEDIO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .PROMEDIO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA1-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA1-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA2-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA2-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA3-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NOTA3-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .DOCENTE-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .DOCENTE-cell[_ngcontent-%COMP%] {\n  min-width: 200px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NIVEL-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .NIVEL-cell[_ngcontent-%COMP%] {\n  min-width: 120px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .PERIODO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .PERIODO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .GENERO-header[_ngcontent-%COMP%], .contenedor_general[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .GENERO-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 80px !important;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog {\n  margin: 0 !important;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-header {\n  margin: 0 !important;\n  height: 25px;\n  padding: 5px 10px;\n  padding-left: 20px;\n  border-radius: 5px 5px 0px 0px;\n  color: #fff;\n  background-color: #40456c;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-header .p-dialog-title {\n  font-size: 0.8em;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-header .p-dialog-header-icon {\n  color: #fff;\n  transform: scale(0.7);\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-header .p-dialog-header-icon:hover {\n  color: #40456c;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-content {\n  padding: 10px;\n  border: 3px solid #40456c;\n}\n.contenedor_general[_ngcontent-%COMP%]     .p-dialog-draggable .p-dialog-content .contenedor_filtro .input {\n  width: 95%;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvdmlld3MvRGlyZWN0b3IvaGlzdG9yeS1ub3RlL2hpc3Rvcnktbm90ZS5jb21wb25lbnQuc2NzcyIsIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy9jb21wb25lbnRzL190YWJsZS5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2ZvbnRzLnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fY29sb3JzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNQRjs7QUM5QkE7RUFDRSxhQUFBO0VBQ0Esa0JBQUE7RUFDQSwwQ0FBQTtFQUNBLGdCQUFBO0FEaUNGO0FDL0JFO0VBQ0UsZ0JBQUE7RUFDQSwyQkFBQTtBRGlDSjtBQy9CSTtFQUNFLFdBQUE7RUFDQSwyQkFBQTtBRGlDTjtBQy9CTTs7RUFFRSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkNxQ0s7QUZKYjtBQzlCTTtFQUNFLGdCQUFBO0VB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O0FBc0ZSO0FBbkZNOztFQUVFLGtCQUFBO0VBQ0EsMkJBQUE7QUFxRlI7QUFsRk07O0VBRUUsa0JBQUE7RUFDQSwwQkFBQTtBQW9GUjtBQWpGTTs7RUFFRSxrQkFBQTtFQUNBLDBCQUFBO0FBbUZSO0FBaEZNOztFQUVFLGtCQUFBO0VBQ0EsMEJBQUE7QUFrRlI7QUEvRU07O0VBRUUsa0JBQUE7RUFDQSwwQkFBQTtBQWlGUjtBQTlFTTs7RUFFRSxrQkFBQTtFQUNBLDBCQUFBO0FBZ0ZSO0FBN0VNOztFQUVFLGtCQUFBO0VBQ0EsMEJBQUE7QUErRVI7QUE1RU07O0VBRUUsa0JBQUE7RUFDQSwwQkFBQTtBQThFUjtBQTNFTTs7RUFFRSwyQkFBQTtBQTZFUjtBQTFFTTs7RUFFRSwyQkFBQTtBQTRFUjtBQXpFTTs7RUFFRSxrQkFBQTtFQUNBLDBCQUFBO0FBMkVSO0FBeEVNOztFQUVFLGtCQUFBO0VBQ0EsMEJBQUE7QUEwRVI7QUFwRUU7RUFDRSxvQkFBQTtBQXNFSjtBQWxFSTtFQUNFLG9CQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSw4QkFBQTtFQUNBLFdHNVJFO0VINlJGLHlCR3BTSTtBSHdXVjtBQWxFTTtFQUNFLGdCRXpPYztBRjZTdEI7QUFqRU07RUFDRSxXR3BTQTtFSHFTQSxxQkFBQTtBQW1FUjtBQWpFUTtFQUNFLGNHL1NBO0FIa1hWO0FBOURJO0VBQ0UsYUFBQTtFQUNBLHlCQUFBO0FBZ0VOO0FBN0RRO0VBQ0UsVUFBQTtBQStEViIsInNvdXJjZXNDb250ZW50IjpbIi8vIENvbG9yZXMgcm9vdFxyXG46cm9vdCB7XHJcblxyXG4gIC8vIHNvbGlkXHJcbiAgLS1qZXQ6IGhzbCgwLCAwJSwgMjIlKTtcclxuICAtLW9ueXg6IGhzbCgyNDAsIDElLCAxNyUpO1xyXG5cclxuICAtLWJsYWNrOiBoc2woMCwgMCUsIDAlKTtcclxuICAtLWJsYWNrLTkwOiBoc2xhKDAsIDAlLCAwJSwgMC45KTtcclxuICAtLWJsYWNrLTgwOiBoc2xhKDAsIDAlLCAwJSwgMC44KTtcclxuICAtLWJsYWNrLTcwOiBoc2xhKDAsIDAlLCAwJSwgMC43KTtcclxuICAtLWJsYWNrLTYwOiBoc2xhKDAsIDAlLCAwJSwgMC42KTtcclxuICAtLWJsYWNrLTUwOiBoc2xhKDAsIDAlLCAwJSwgMC41KTtcclxuICAtLWJsYWNrLTQwOiBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuICAtLWJsYWNrLTMwOiBoc2xhKDAsIDAlLCAwJSwgMC4zKTtcclxuICAtLWJsYWNrLTIwOiBoc2xhKDAsIDAlLCAwJSwgMC4yKTtcclxuICAtLWJsYWNrLTEwOiBoc2xhKDAsIDAlLCAwJSwgMC4xKTtcclxuXHJcbiAgLS13aGl0ZTogaHNsKDAsIDAlLCAxMDAlKTtcclxuICAtLXdoaXRlLTkwOiBoc2woMCwgMCUsIDEwMCUsIDAuOSk7XHJcbiAgLS13aGl0ZS04MDogaHNsKDAsIDAlLCAxMDAlLCAwLjgpO1xyXG4gIC0td2hpdGUtNzA6IGhzbCgwLCAwJSwgMTAwJSwgMC43KTtcclxuICAtLXdoaXRlLTYwOiBoc2woMCwgMCUsIDEwMCUsIDAuNik7XHJcbiAgLS13aGl0ZS01MDogaHNsKDAsIDAlLCAxMDAlLCAwLjUpO1xyXG4gIC0td2hpdGUtNDA6IGhzbCgwLCAwJSwgMTAwJSwgMC40KTtcclxuICAtLXdoaXRlLTMwOiBoc2woMCwgMCUsIDEwMCUsIDAuMyk7XHJcbiAgLS13aGl0ZS0yMDogaHNsKDAsIDAlLCAxMDAlLCAwLjIpO1xyXG4gIC0td2hpdGUtMTA6IGhzbCgwLCAwJSwgMTAwJSwgMC4xKTtcclxuXHJcbiAgLy8gc2hhZG93XHJcbiAgLS1zaGFkb3ctMTogLTRweCA4cHggMjRweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMjogNXB4IDVweCAxMHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0zOiAwIDE2cHggNDBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNDogMCAyNXB4IDUwcHggaHNsYSgwLCAwJSwgMCUsIDAuMTUpO1xyXG4gIC0tc2hhZG93LTU6IDAgMjRweCA4MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy02OiAwIDE2cHggM3B4IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG5cclxuICAvLyBDb2xvcnNcclxuICAtLXJlZDogaHNsKDAsIDEwMCUsIDUwJSk7XHJcbiAgLS15ZWxsb3c6IGhzbCg2MCwgMTAwJSwgNTAlKTtcclxuICAtLWdyZWVuOiBoc2woMTIwLCAxMDAlLCAyNSUpO1xyXG4gIC0tYmx1ZTogaHNsKDI0MCwgMTAwJSwgNTAlKTtcclxuICAtLXB1cnBsZTogaHNsKDMwMCwgMTAwJSwgMjUlKTtcclxufVxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgXCIuLi8uLi8uLi8uLi8uLi8uLi9hc3NldHMvc2Nzcy92YXJzL2NvbG9yc1wiIGFzIGNvbG9ycztcclxuQHVzZSBcIi4uLy4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvZm9udHNcIiBhcyBmb250cztcclxuQHVzZSBcIi4uLy4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL2NvbXBvbmVudHMvdGFibGVcIjtcclxuXHJcbkBpbXBvcnQgXCJ+QGFuZ3VsYXIvbWF0ZXJpYWwvcHJlYnVpbHQtdGhlbWVzL2luZGlnby1waW5rLmNzc1wiO1xyXG5cclxuLmNvbnRlbmVkb3JfZ2VuZXJhbCB7XHJcbiAgZGlzcGxheTogZ3JpZDtcclxuICBnYXA6IDVweDtcclxuICBib3gtc2hhZG93OiBub25lO1xyXG5cclxuICAvLyBFc3RpbG9zIHBhcmEgZWwgY29udGVuZWRvciBkZSBmaWx0cm9zXHJcbiAgLmNvbnRlbmVkb3JfbGlzdF9maWx0cm9zIHtcclxuICAgIGRpc3BsYXk6IGdyaWQ7XHJcblxyXG4gICAgLmNvbnRlbmVkb3JfbGlzdCB7XHJcbiAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICB9XHJcblxyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDcwMHB4KSB7XHJcbiAgICAgIC5jb250ZW5lZG9yX2xpc3Qge1xyXG4gICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgZ3JpZC10ZW1wbGF0ZS1jb2x1bW5zOiByZXBlYXQoMiwgMWZyKTtcclxuICAgICAgICBwYWRkaW5nOiAwIDIwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKGNvbG9ycy4kZ3JheSwgMC4yKTtcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcblxyXG4gICAgICAgIC50ZXh0X2xpc3Qge1xyXG4gICAgICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgICAgICBjb2xvcjogcmdiYShjb2xvcnMuJGJsYWNrLCAwLjcpO1xyXG5cclxuICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA1MDBweCkge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IGZvbnRzLiRpY29uLXNpemU7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuaWNvbl9saXN0IHtcclxuICAgICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgdGV4dC1hbGlnbjogcmlnaHQ7XHJcbiAgICAgICAgICBjb2xvcjogcmdiYShjb2xvcnMuJGJsYWNrLCAwLjcpO1xyXG5cclxuICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IGZvbnRzLiRpY29uLXNpemU7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbnRlbmVkb3JfZmlsdHJvcyB7XHJcbiAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgIGdyaWQtdGVtcGxhdGUtY29sdW1uczogcmVwZWF0KDQsIDFmcik7XHJcbiAgICAgIGdhcDogMTBweDtcclxuXHJcbiAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiAxMjAwcHgpIHtcclxuICAgICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IHJlcGVhdCgzLCAxZnIpO1xyXG4gICAgICAgIHJvdy1nYXA6IDBweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDcwMHB4KSB7XHJcbiAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IHJlcGVhdCgyLCAxZnIpO1xyXG4gICAgICB9XHJcblxyXG4gICAgICBAbWVkaWEgKG1heC13aWR0aDogNTAwcHgpIHtcclxuICAgICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmcjtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm1hdC1mb3JtLWZpZWxkLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuaW5wdXQge1xyXG4gICAgICAgIHdpZHRoOiA5NSU7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcblxyXG4gIC5jb250ZW5lZG9yX2FjY2lvbmVzX3RhYmxhIHtcclxuICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgZ3JpZC10ZW1wbGF0ZS1jb2x1bW5zOiAxZnIgMWZyO1xyXG4gICAgZ2FwOiAxMHB4O1xyXG5cclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOiA3MDBweCkge1xyXG4gICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmcjtcclxuICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbnRlbmVkb3JfYm90b25lcyB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGdhcDogMTBweDtcclxuXHJcbiAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA3MDBweCkge1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG5cclxuICAgICAgICAuYnRuX2ZpbHRybyB7XHJcbiAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG5cclxuICAgICAgLmljb24tY2hhcmdlIHtcclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgd2lkdGg6IDMwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbnRlbmVkb3JfYnVzY2Fkb3Ige1xyXG4gICAgICBkaXNwbGF5OiBncmlkO1xyXG5cclxuICAgICAgZGl2IHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuXHJcbiAgICAgICAgLmlucHV0IHtcclxuICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDQwcHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBpIHtcclxuICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgICByaWdodDogMTBweDtcclxuICAgICAgICAgIGZvbnQtc2l6ZTogMjVweDtcclxuICAgICAgICAgIGNvbG9yOiByZ2JhKGNvbG9ycy4kYmxhY2ssIDAuNCk7XHJcbiAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgwJSwgNTAlKTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLy8gVE9ETzogRXN0YWRvIGFjdGl2b1xyXG4gIC5zaWRlYmFyX2FjdGl2ZV9jb250ZW50X2FjY2lvbmVzX3RhYmxhIHtcclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOiA4NjBweCkge1xyXG4gICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmcjtcclxuXHJcbiAgICAgIC5jb250ZW5lZG9yX2JvdG9uZXMge1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG5cclxuICAvLyBFc3RpbG9zIHBhcmEgZWwgY29udGVuZWRvciBkZSBsYSB0YWJsYVxyXG4gICR0YW1hw4PCsW9UYWJsYTogNTM1cHg7XHJcbiAgJHRhbWHDg8Kxb1RhYmxhNjIwOiAkdGFtYcODwrFvVGFibGEgKyAxMDBweDtcclxuICAuY29udGVuZWRvcl90YWJsYSB7XHJcbiAgICBtYXgtaGVpZ2h0OiAkdGFtYcODwrFvVGFibGE7XHJcbiAgICBtaW4taGVpZ2h0OiAkdGFtYcODwrFvVGFibGE7XHJcblxyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6IDYyMHB4KSB7XHJcbiAgICAgIG1heC1oZWlnaHQ6ICR0YW1hw4PCsW9UYWJsYTYyMDtcclxuICAgICAgbWluLWhlaWdodDogJHRhbWHDg8Kxb1RhYmxhNjIwO1xyXG4gICAgfVxyXG5cclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOiA0NjBweCkge1xyXG4gICAgICBtYXgtaGVpZ2h0OiAkdGFtYcODwrFvVGFibGE2MjA7XHJcbiAgICAgIG1pbi1oZWlnaHQ6ICR0YW1hw4PCsW9UYWJsYTYyMDtcclxuICAgIH1cclxuXHJcbiAgICAudGFibGUtY29udGFpbmVyIHtcclxuICAgICAgaGVpZ2h0OiAkdGFtYcODwrFvVGFibGEgLSA3NXB4O1xyXG5cclxuICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDYyMHB4KSB7XHJcbiAgICAgICAgaGVpZ2h0OiAkdGFtYcODwrFvVGFibGE2MjAgLSAoNTBweCAqIDIpO1xyXG4gICAgICB9XHJcblxyXG4gICAgICBAbWVkaWEgKG1heC13aWR0aDogNDUwcHgpIHtcclxuICAgICAgICBoZWlnaHQ6ICR0YW1hw4PCsW9UYWJsYTYyMCAtICg1MHB4ICogMyk7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIHRhYmxlIHtcclxuICAgICAgICAubWF0LW1kYy1yb3cge1xyXG4gICAgICAgICAgaGVpZ2h0OiAzNXB4O1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG5cclxuICAgICAgLy8gVGFtYcODwrFvIGRlIGNlbGRhcyBlbiB0YWJsYVxyXG4gICAgICAubWF0LWNvbHVtbi1udW0sXHJcbiAgICAgIC5tYXQtY29sdW1uLW51bSB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAzMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5BUEVMTElETy1oZWFkZXIsXHJcbiAgICAgIC5BUEVMTElET191c2VyLWNlbGwge1xyXG4gICAgICAgIG1pbi13aWR0aDogMTMwcHggIWltcG9ydGFudDtcclxuICAgICAgICB1c2VyLXNlbGVjdDogdGV4dCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuTk9NQlJFLWhlYWRlcixcclxuICAgICAgLk5PTUJSRS1jZWxsIHtcclxuICAgICAgICBtaW4td2lkdGg6IDEzMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5JRC1oZWFkZXIsXHJcbiAgICAgIC5JRC1jZWxsIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMDBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuQ0VEVUxBLWhlYWRlcixcclxuICAgICAgLkNFRFVMQS1jZWxsIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMDBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuQV9DT05PQ0lNSUVOVE8taGVhZGVyLFxyXG4gICAgICAuQV9DT05PQ0lNSUVOVE8tY2VsbCB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxODBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuREVQQVJUQU1FTlRPLWhlYWRlcixcclxuICAgICAgLkRFUEFSVEFNRU5UTy1jZWxsIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMDBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuQ1VSU08taGVhZGVyLFxyXG4gICAgICAuQ1VSU08tY2VsbCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIG1pbi13aWR0aDogODBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuTlJDLWhlYWRlcixcclxuICAgICAgLk5SQy1jZWxsIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWluLXdpZHRoOiA4MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5FU1RBRE8taGVhZGVyLFxyXG4gICAgICAuRVNUQURPLWNlbGwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHggIWltcG9ydGFudDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLlBST01FRElPLWhlYWRlcixcclxuICAgICAgLlBST01FRElPLWNlbGwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHggIWltcG9ydGFudDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLk5PVEExLWhlYWRlcixcclxuICAgICAgLk5PVEExLWNlbGwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHggIWltcG9ydGFudDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLk5PVEEyLWhlYWRlcixcclxuICAgICAgLk5PVEEyLWNlbGwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHggIWltcG9ydGFudDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLk5PVEEzLWhlYWRlcixcclxuICAgICAgLk5PVEEzLWNlbGwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHggIWltcG9ydGFudDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLkRPQ0VOVEUtaGVhZGVyLFxyXG4gICAgICAuRE9DRU5URS1jZWxsIHtcclxuICAgICAgICBtaW4td2lkdGg6IDIwMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5OSVZFTC1oZWFkZXIsXHJcbiAgICAgIC5OSVZFTC1jZWxsIHtcclxuICAgICAgICBtaW4td2lkdGg6IDEyMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5QRVJJT0RPLWhlYWRlcixcclxuICAgICAgLlBFUklPRE8tY2VsbCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIG1pbi13aWR0aDogODBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAuR0VORVJPLWhlYWRlcixcclxuICAgICAgLkdFTkVSTy1jZWxsIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWluLXdpZHRoOiA4MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcblxyXG4gIC8vIEVsaW1pbmFyIG1hcmdpbiBkZWwgZGlhbG9nXHJcbiAgOjpuZy1kZWVwIC5wLWRpYWxvZyB7XHJcbiAgICBtYXJnaW46IDAgIWltcG9ydGFudDtcclxuICB9XHJcblxyXG4gIDo6bmctZGVlcCAucC1kaWFsb2ctZHJhZ2dhYmxlIHtcclxuICAgIC5wLWRpYWxvZy1oZWFkZXIge1xyXG4gICAgICBtYXJnaW46IDAgIWltcG9ydGFudDtcclxuICAgICAgaGVpZ2h0OiAyNXB4O1xyXG4gICAgICBwYWRkaW5nOiA1cHggMTBweDtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAyMHB4O1xyXG4gICAgICBib3JkZXItcmFkaXVzOiA1cHggNXB4IDBweCAwcHg7XHJcbiAgICAgIGNvbG9yOiBjb2xvcnMuJHdoaXRlO1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiBjb2xvcnMuJHByaW1hcnk7XHJcblxyXG4gICAgICAucC1kaWFsb2ctdGl0bGUge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJGRpYWxvZy1oZWFkZXItdGl0bGU7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5wLWRpYWxvZy1oZWFkZXItaWNvbiB7XHJcbiAgICAgICAgY29sb3I6IGNvbG9ycy4kd2hpdGU7XHJcbiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgwLjcpO1xyXG5cclxuICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgIGNvbG9yOiBjb2xvcnMuJHByaW1hcnk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnAtZGlhbG9nLWNvbnRlbnQge1xyXG4gICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgICBib3JkZXI6IDNweCBzb2xpZCBjb2xvcnMuJHByaW1hcnk7XHJcblxyXG4gICAgICAuY29udGVuZWRvcl9maWx0cm8ge1xyXG4gICAgICAgIC5pbnB1dCB7XHJcbiAgICAgICAgICB3aWR0aDogOTUlO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxufVxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgXCIuLi92YXJzL2NvbG9yc1wiIGFzIGNvbG9ycztcclxuQHVzZSBcIi4uL3ZhcnMvZm9udHNcIiBhcyBmb250cztcclxuXHJcbi8vIEVzdGlsb3MgcGFyYSBlbCBjb250ZW5lZG9yIGRlIGxhIHRhYmxhXHJcbi5jb250ZW5lZG9yX3RhYmxhIHtcclxuICBkaXNwbGF5OiBncmlkO1xyXG4gIGJvcmRlci1yYWRpdXM6IDVweDtcclxuICBib3JkZXI6IDFweCBzb2xpZCByZ2JhKGNvbG9ycy4kZ3JheSwgMC4zKTtcclxuICBvdmVyZmxvdy14OiBhdXRvO1xyXG5cclxuICAudGFibGUtY29udGFpbmVyIHtcclxuICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgdGFibGUge1xyXG4gICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgdGQsXHJcbiAgICAgIHRoIHtcclxuICAgICAgICB3aWR0aDogMjAwcHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxNTBweDtcclxuICAgICAgICBmb250LXNpemU6IGZvbnRzLiRmb3JtLWlucHV0O1xyXG4gICAgICB9XHJcblxyXG4gICAgICB0aCB7XHJcbiAgICAgICAgcG9zaXRpb246IHN0aWNreTtcclxuICAgICAgICBmb250LXNpemU6IGZvbnRzLiR0ZXh0LXA7XHJcbiAgICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgICAgdG9wOiAwO1xyXG4gICAgICAgIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIGNvbG9ycy4kd2hpdGUsIGNvbG9ycy4kd2hpdGUpLFxyXG4gICAgICAgIGxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjMpLCByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKSk7XHJcbiAgICAgICAgYmFja2dyb3VuZC1ibGVuZC1tb2RlOiBtdWx0aXBseTtcclxuICAgICAgfVxyXG5cclxuICAgICAgLy8gSGVhZFxyXG4gICAgICAubWF0LW1kYy1oZWFkZXItcm93IHtcclxuICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC8vIEJvZHlcclxuICAgICAgLm1hdC1tZGMtcm93IHtcclxuICAgICAgICB0cmFuc2l0aW9uOiBhbGwgMC4xcztcclxuICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6IHJnYmEoY29sb3JzLiRwcmltYXJ5LCAuMDUpO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgLnBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgZGlzcGxheTogZ3JpZDtcclxuICAgIGFsaWduLWl0ZW1zOiBlbmQ7XHJcbiAgICBoZWlnaHQ6IDU2cHg7XHJcblxyXG4gICAgOjpuZy1kZWVwIC5tYXQtbWRjLXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICBAbWVkaWEgKG1heC13aWR0aDogNjIwcHgpIHtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktaXRlbXM6IGNlbnRlcjtcclxuICAgICAgfVxyXG5cclxuICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDQ1NXB4KSB7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTI1cHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5tYXQtbWRjLXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogNjIwcHgpIHtcclxuICAgICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IHJlcGVhdCg0LCAxZnIpO1xyXG4gICAgICAgICAganVzdGlmeS1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgIGRpdiB7XHJcbiAgICAgICAgICAgIGdyaWQtY29sdW1uOiAxIC8gLTE7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLy8gRWxpbWluYXIgdGV4dG8gZGUgbnVtZXJvIGRlIGZpbHRybyBlbiB0YWJsYVxyXG4gICAgOjpuZy1kZWVwIC5tYXQtbWRjLXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgfVxyXG4gIH1cclxufVxyXG5cclxuOjpuZy1kZWVwIC5ub0V4aXN0ZVJlZ2lzdHJvIHtcclxuICBkaXNwbGF5OiBncmlkO1xyXG4gIGhlaWdodDogNDAlO1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtZXJyb3I7XHJcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gIGFsaWduLWNvbnRlbnQ6IGVuZDtcclxuICBjb2xvcjogY29sb3JzLiRncmF5O1xyXG59XHJcbiIsIi8vIEZ1ZW50ZSBwcmluY2lwYWxcclxuJGZvbnQtcHJpbWFyeTogJ0FyaWFsJywgc2Fucy1zZXJpZjtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBUYW1hw4PCsW9zIFZhcmlhYmxlc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbi8vIE5hdmJhclxyXG4kdGV4dC1uYXY6IDEuMTVlbTsgICAgICAvLyAxOHB4XHJcblxyXG4vLyBTaWRlYmFyXHJcbiR0aXRsZS1zaWRlYmFyOiAxLjJlbTsgIC8vIDIwcHhcclxuJGl0ZW0tdGV4dDogMC43NWVtOyAgICAgLy8gMTJweFxyXG4kaXRlbS1kaXZpZGVyOiAwLjZlbTsgICAvLyAxMHB4XHJcbiRpdGVtLWF1dG9yczogMC41NWVtOyAgIC8vIDlweFxyXG5cclxuLy8gQ29udGVudFxyXG4kdGl0bGUtY29udGVudDogMS4yZW07XHJcblxyXG4vLyBFcnJvciA0MDRcclxuJHRpdGxlLWVycm9yOiA5LjVlbTsgICAgICAvLyAxNTBweFxyXG4kc3VidGl0bGUtZXJyb3I6IDMuMWVtOyAgIC8vIDUwcHhcclxuJHRleHQtZXJyb3I6IDEuMmVtO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIEVzdGFuZGFyXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kdGl0bGUtdGV4dC1oMTogMmVtO1xyXG4kdGl0bGUtdGV4dC1oMjogMS41ZW07XHJcbiR0aXRsZS10ZXh0LWgzOiAxLjE3ZW07XHJcbiR0aXRsZS10ZXh0LWg0OiAxZW07XHJcbiR0aXRsZS10ZXh0LWg1OiAwLjgzZW07XHJcbiR0aXRsZS10ZXh0LWg2OiAwLjY3ZW07XHJcbiR0ZXh0LXA6IDFlbTtcclxuXHJcbiRpY29uLXNpemU6IDEuMmVtO1xyXG4kdGV4dC1idXR0b24tc2l6ZTogMC43NWVtO1xyXG5cclxuLy8gVGFibGV0XHJcbiR0aXRsZS10ZXh0LWgxLXRhYmxldDogMS44ZW07XHJcbiR0aXRsZS10ZXh0LWgyLXRhYmxldDogMS4zNWVtO1xyXG4kdGl0bGUtdGV4dC1oMy10YWJsZXQ6IDEuMDVlbTtcclxuJHRpdGxlLXRleHQtaDQtdGFibGV0OiAwLjllbTtcclxuJHRpdGxlLXRleHQtaDUtdGFibGV0OiAwLjc1ZW07XHJcbiR0aXRsZS10ZXh0LWg2LXRhYmxldDogMC42ZW07XHJcbiR0ZXh0LXAtdGFibGV0OiAwLjllbTtcclxuXHJcbi8vIE1vdmlsXHJcbiR0aXRsZS10ZXh0LWgxLXBob25lOiAxLjZlbTtcclxuJHRpdGxlLXRleHQtaDItcGhvbmU6IDEuMmVtO1xyXG4kdGl0bGUtdGV4dC1oMy1waG9uZTogMWVtO1xyXG4kdGl0bGUtdGV4dC1oNC1waG9uZTogMC44ZW07XHJcbiR0aXRsZS10ZXh0LWg1LXBob25lOiAwLjdlbTtcclxuJHRpdGxlLXRleHQtaDYtcGhvbmU6IDAuNWVtO1xyXG4kdGV4dC1wLXBob25lOiAwLjg1ZW07XHJcblxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgZGUgbGV0cmEgcGFyYSBmb3JtdWxhcmlvc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuJGZvcm0taW5wdXQ6IDAuOGVtO1xyXG4kZm9ybS1sYWJlbDogMC43NWVtO1xyXG4kZm9ybS1yZXF1aWVyZWQ6IDAuNTVlbTtcclxuXHJcblxyXG5cclxuJGRpYWxvZy1oZWFkZXItdGl0bGU6IDAuOGVtO1xyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgJ3Jvb3RfY29sb3JzJztcclxuXHJcbi8vIFZhcmlhYmxlcyBkZSBjb2xvcmVzXHJcbiRwcmltYXJ5OiAjNDA0NTZjO1xyXG4kZm9jdXMtaW5wdXQ6IGxpZ2h0ZW4oJHByaW1hcnksIDMwJSk7XHJcblxyXG4kYmc6ICNmMWYwZjY7XHJcbiRiZy1lbGVtZW50czogI2VjZjBmMztcclxuJHNoYTE6ICNmOWY5Zjk7XHJcbiRzaGEyOiAjZDFkOWU2O1xyXG4kd2hpdGU6ICNmZmY7XHJcblxyXG4kYmxhY2s6ICMwMDAwMDA7XHJcbiRibGFjay1zaGE6ICMxODE4MWM7XHJcblxyXG4kZ3JheTogIzgwODA4MDtcclxuJGdyYXktdGV4dDogIzQ5NDk0OTtcclxuXHJcbiRvcm86ICM3MTZiNDE7XHJcbiRzaGFkb3ctb3JvOiAjMTcxODFjO1xyXG5cclxuXHJcbi8vIENvbG9yIGRlIGJvdG9uZXNcclxuJGJ0bnM6ICMzYzY4ZTM7XHJcbiRidG4tY29sb3ItMTogJGJ0bnM7XHJcbiRidG4tY29sb3ItMjogZGFya2VuKCRidG5zLCAxMCk7XHJcbiRidG4tY29sb3ItMzogZGFya2VuKCRidG5zLCAyMCk7XHJcbiRidG4tY29sb3ItNDogZGFya2VuKCRidG5zLCAzMCk7XHJcbiRidG4tY29sb3ItNTogZGFya2VuKCRidG5zLCA0MCk7XHJcbiRidG4tY29sb3ItNjogZGFya2VuKCRidG5zLCA1MCk7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1idXNjYXI6ICMyOTgwYjk7XHJcbiRidG4tY29sb3ItaW5ncmVzYXI6ICMxYTc1MDA7XHJcbiRidG4tY29sb3ItbmF2ZWdhY2lvbjogIzAwOWM4YztcclxuXHJcblxyXG4kYnRuLWNvbG9yLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItYnVzY2FyLCAxMCk7XHJcbiRidG4tY29sb3ItZGVsZXRlLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItZmlsdHJvLCAxMCk7XHJcbiRidG4tY29sb3ItY29weTogIzAwNmQ3NztcclxuJGJ0bi1jb2xvci1leGNlbDogIzBlNzUzYztcclxuJGJ0bi1jb2xvci1jc3Y6ICNmZjk4MDA7XHJcbiRidG4tY29sb3ItcHJpbnQ6ICMxN2EyYjg7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1lbnZpYXI6ICMyN2FlNjA7XHJcbiRidG4tY29sb3ItbnVldm86ICMzNDk4ZGI7XHJcbiRidG4tY29sb3ItZWRpdGFyOiAjZjM5YzEyO1xyXG4kYnRuLWNvbG9yLWFjdHVhbGl6YXI6ICMyZWNjNzE7XHJcbiRidG4tY29sb3ItZWxpbWluYXI6ICNlNzRjM2M7XHJcbiRidG4tY29sb3ItY2FuY2VsYXI6ICM5NWE1YTY7XHJcblxyXG4iXSwic291cmNlUm9vdCI6IiJ9 */"]
  });
}

/***/ }),

/***/ 1132:
/*!************************************************************************************!*\
  !*** ./src/app/views/Module/views/Director/load-periods/load-periods.component.ts ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   LoadPeriodsComponent: () => (/* binding */ LoadPeriodsComponent)
/* harmony export */ });
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/forms */ 4456);
/* harmony import */ var primeng_tooltip__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! primeng/tooltip */ 405);
/* harmony import */ var primeng_table__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! primeng/table */ 6676);
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/table */ 7697);
/* harmony import */ var _angular_material_form_field__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/material/form-field */ 4950);
/* harmony import */ var _angular_material_input__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/material/input */ 5541);
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material/sort */ 2047);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! src/app/core/services/alerts.service */ 983);
/* harmony import */ var _services_upload_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../services/upload-data.service */ 1756);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../services/data.service */ 1112);
/* harmony import */ var _services_file_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../services/file.service */ 9562);
















const _c0 = ["fileInput"];
const _c1 = a0 => ({
  "name_periods_active": a0
});
const _c2 = () => ["num"];
const _c3 = a0 => ({
  "complete_genre": a0
});
const _c4 = a0 => ({
  "show": a0
});
const _c5 = a0 => ({
  "elements_clic": a0
});
function LoadPeriodsComponent_Conditional_2_ng_template_18_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div")(1, "span", 44);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](2, " Para el nombre de per\u00EDodo se recomienda a\u00F1adir la sintaxis establecida Ex: ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](3, "b");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](4, "202350");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
  }
}
function LoadPeriodsComponent_Conditional_2_Conditional_21_Conditional_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, " Nombre de per\u00EDodo es requerido. ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_Conditional_2_Conditional_21_Conditional_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, " Este per\u00EDodo no se puede actualizar. ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_Conditional_2_Conditional_21_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 35);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](1, LoadPeriodsComponent_Conditional_2_Conditional_21_Conditional_1_Template, 2, 0, "div")(2, LoadPeriodsComponent_Conditional_2_Conditional_21_Conditional_2_Template, 2, 0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](1, ctx_r2.nombrePeriodoControl.errors["required"] ? 1 : -1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](2, ctx_r2.nombrePeriodoControl.errors["forbiddenText"] ? 2 : -1);
  }
}
function LoadPeriodsComponent_Conditional_2_Conditional_35_Conditional_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, " El archivo del per\u00EDodo es requerido. ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_Conditional_2_Conditional_35_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 35);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](1, LoadPeriodsComponent_Conditional_2_Conditional_35_Conditional_1_Template, 2, 0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](1, ctx_r2.filePeriodoControl.errors["required"] ? 1 : -1);
  }
}
function LoadPeriodsComponent_Conditional_2_Template(rf, ctx) {
  if (rf & 1) {
    const _r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 5)(1, "span", 30)(2, "b");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](3, "Nota:");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](4, " Al subir un per\u00EDodo se recomienda que no se realize ning\u00FAna modificaci\u00F3n internamente ya que el formado de archivo permitido es tal cual como se baja del sistema academico de notas por per\u00EDodo.");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](5, "div", 31)(6, "div")(7, "span")(8, "b");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](9, "Subir o actualizar per\u00EDodos");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](10, "hr");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](11, "div")(12, "label", 32);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](13, " Nombre del per\u00EDodo ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](14, "span", 33);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](15, "*");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](16, "div", 12);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](17, "i", 13);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](18, LoadPeriodsComponent_Conditional_2_ng_template_18_Template, 5, 0, "ng-template", null, 1, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplateRefExtractor"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](20, "input", 34);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](21, LoadPeriodsComponent_Conditional_2_Conditional_21_Template, 3, 2, "div", 35);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](22, "div")(23, "label", 36);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](24, "Archivo del per\u00EDodo ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](25, "span", 33);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](26, "*");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](27, "div", 37)(28, "span", 38);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](29, "i", 39);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](30);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](31, "span", 40);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function LoadPeriodsComponent_Conditional_2_Template_span_click_31_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.limpiarArchivo($event));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](32, "\u2716");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](33, "input", 41, 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function LoadPeriodsComponent_Conditional_2_Template_input_change_33_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.onFileChange($event));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](35, LoadPeriodsComponent_Conditional_2_Conditional_35_Template, 2, 1, "div", 35);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](36, "div", 42)(37, "button", 43);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function LoadPeriodsComponent_Conditional_2_Template_button_click_37_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r2);
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.uploadFile());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](38, "Subir Archivo");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()()();
  }
  if (rf & 2) {
    const tooltipContentNameForm_r4 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵreference"](19);
    const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](5);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("formGroup", ctx_r2.formulario);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](11);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("pTooltip", tooltipContentNameForm_r4)("autoHide", false);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](5);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](21, ctx_r2.nombrePeriodoControl && ctx_r2.nombrePeriodoControl.errors && ctx_r2.nombrePeriodoControl.touched ? 21 : -1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](9);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate1"](" ", ctx_r2.fileText, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](7, _c4, ctx_r2.showRemoveIcon));
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](4);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](35, ctx_r2.filePeriodoControl && ctx_r2.filePeriodoControl.errors && ctx_r2.filePeriodoControl.touched ? 35 : -1);
  }
}
function LoadPeriodsComponent_For_11_Conditional_4_Template(rf, ctx) {
  if (rf & 1) {
    const _r7 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 48);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function LoadPeriodsComponent_For_11_Conditional_4_Template_div_click_0_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r7);
      const fileName_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]().$implicit;
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.removeFile(fileName_r6, $event));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](1, "i", 49);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_For_11_Template(rf, ctx) {
  if (rf & 1) {
    const _r5 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div", 45);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function LoadPeriodsComponent_For_11_Template_div_click_0_listener() {
      const fileName_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r5).$implicit;
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](fileName_r6 !== "202350.xlsx" && ctx_r2.getGenerosData(fileName_r6));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](1, "div", 46)(2, "span");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](4, LoadPeriodsComponent_For_11_Conditional_4_Template, 2, 0, "div", 47);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const fileName_r6 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](3, _c5, fileName_r6 !== "202350.xlsx"));
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](fileName_r6);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](4, fileName_r6 != "202350.xlsx" ? 4 : -1);
  }
}
function LoadPeriodsComponent_ng_template_21_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "div")(1, "span", 44);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](2, "Cada que se agrega un nuevo per\u00EDodo se deben actualizar los generos de los estudiantes de nuevo ingreso.");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](3, "br");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](4, "span", 44);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](5, "Ex: ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](6, "b");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](7, "H: Hombre M: Mujer");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
  }
}
function LoadPeriodsComponent_th_29_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "th", 50);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, " N\u00B0 ");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_td_30_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "td", 51);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const i_r8 = ctx.index;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](i_r8 + 1);
  }
}
function LoadPeriodsComponent_For_32_th_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "th", 54);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const column_r9 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵclassMapInterpolate1"]("", column_r9.split(".").join("-"), "-header");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](column_r9);
  }
}
function LoadPeriodsComponent_For_32_td_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "td", 51);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const element_r10 = ctx.$implicit;
    const column_r9 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵclassMapInterpolate1"]("", column_r9.split(".").join("-"), "-cell");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate1"]("", element_r10[column_r9], " ");
  }
}
function LoadPeriodsComponent_For_32_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerStart"](0, 20);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](1, LoadPeriodsComponent_For_32_th_1_Template, 2, 4, "th", 52)(2, LoadPeriodsComponent_For_32_td_2_Template, 2, 4, "td", 53);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerEnd"]();
  }
  if (rf & 2) {
    const column_r9 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matColumnDef", column_r9);
  }
}
function LoadPeriodsComponent_th_34_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "th", 50);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, "GENERO");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
function LoadPeriodsComponent_td_35_Template(rf, ctx) {
  if (rf & 1) {
    const _r11 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "td", 55)(1, "div", 56)(2, "input", 57);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function LoadPeriodsComponent_td_35_Template_input_change_2_listener() {
      const element_r12 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r11).$implicit;
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.updateGender(element_r12.ID, "H"));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](3, "label", 58);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](4, "H");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](5, "div", 56)(6, "input", 59);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("change", function LoadPeriodsComponent_td_35_Template_input_change_6_listener() {
      const element_r12 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r11).$implicit;
      const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx_r2.updateGender(element_r12.ID, "M"));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](7, "label", 58);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](8, "M");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
  }
  if (rf & 2) {
    const element_r12 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("id", "H-", element_r12.ID, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("name", "gender-", element_r12.ID, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("checked", element_r12.GENERO === "H");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("for", "H-", element_r12.ID, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("id", "M-", element_r12.ID, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("name", "gender-", element_r12.ID, "");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("checked", element_r12.GENERO === "M");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpropertyInterpolate1"]("for", "M-", element_r12.ID, "");
  }
}
function LoadPeriodsComponent_tr_36_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "tr", 60);
  }
}
function LoadPeriodsComponent_tr_37_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "tr", 61);
  }
}
function LoadPeriodsComponent_Conditional_38_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "tr", 25);
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](1, "No existen registros.");
    _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
  }
}
class LoadPeriodsComponent {
  constructor(formBuilder, alertService, uploadDataService, dataService, fileService, cd) {
    this.formBuilder = formBuilder;
    this.alertService = alertService;
    this.uploadDataService = uploadDataService;
    this.dataService = dataService;
    this.fileService = fileService;
    this.cd = cd;
    // vars input file
    this.placeholderInputFile = 'Haz clic aquí para subir un nuevo periodo';
    this.fileText = this.placeholderInputFile;
    this.showRemoveIcon = false;
    this.nombrePeriodoControl = null;
    this.filePeriodoControl = null;
    this.nombrePeriodo = '';
    // var nombre de archivo
    this.fileNames = [];
    // var tabla
    this.displayedColumns = ['ID', 'ESTUDIANTE'];
    this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTableDataSource([]);
    this.nameFileWithGenero = '';
    // Cambios de genero
    this.originalGenderSelections = {};
    this.genderSelections = {};
    this.currentFileName = '';
    this.namePeriodSelect = '';
    this.unselectedGendersCount = 0;
    this.endPeriod = '';
    this.endCountPeriod = 0;
    this.isLastPeriodLoaded = true;
    // Validaciones de formulacio
    this.validateForm();
  }
  ngOnInit() {
    // Mensajes de validacion en html
    this.validateFormMessages();
    // Chips de archivos
    this.getArchivosData();
    // Obtener generos
    this.getGenerosData('');
    // inicializa genderSelections con los valores actuales
    this.initGenre();
  }
  ngAfterViewInit() {
    this.dataSource.sort = this.sort;
  }
  // =========================================================================
  // Formulario
  // =========================================================================
  // Input file
  onFileChange(event) {
    this.selectedFile = event.target.files[0];
    if (this.selectedFile?.name == undefined) {
      this.fileText = this.placeholderInputFile;
    } else {
      this.fileText = this.selectedFile?.name;
    }
    this.showRemoveIcon = true;
  }
  // Validaciones de formulacio
  validateForm() {
    this.formulario = this.formBuilder.group({
      nombrePeriodo: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_6__.Validators.required, this.forbiddenTextValidator('202350')]],
      filePeriodo: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.Validators.required]
    });
  }
  // Mensajes de html
  validateFormMessages() {
    this.nombrePeriodoControl = this.formulario.get('nombrePeriodo');
    this.filePeriodoControl = this.formulario.get('filePeriodo');
  }
  // Cargar archivo en el servidor
  uploadFile() {
    // Activar los mensajes de validacion del formulario
    this.formulario.markAllAsTouched();
    if (this.formulario.valid && this.selectedFile) {
      const nombrePeriodoValue = this.formulario.get('nombrePeriodo')?.value;
      const filename = nombrePeriodoValue.trim() + '.xlsx';
      if (this.endCountPeriod === 0 || this.endPeriod === filename) {
        const formData = new FormData();
        formData.append('upload_file', this.selectedFile, filename);
        formData.append('nombrePeriodo', nombrePeriodoValue);
        const message = 'Si el archivo existe se actualizara, \n¿Está seguro que desea subir el archivo?';
        const confirmar = this.alertService.alert_confirmation(message);
        confirmar.then(confirmado => {
          if (confirmado) {
            // Mensaje carga
            console.log('Enviando archivo:', filename);
            this.alertService.alert_carga();
            // Enviar contenido al servidor
            this.uploadDataService.uploadFile(formData).subscribe(response => {
              // Cambia el estado para obtener nuevamente el ultimo periodo
              this.isLastPeriodLoaded = true;
              // Respuesta de servidor
              console.log('Archivo subido exitosamente:', response);
              this.alertService.alert_response_server(response.data.json_data);
              // Limpiar formulario
              this.formulario.reset();
              this.limpiarArchivo(new MouseEvent('click'));
              // Actualizar chips
              this.getArchivosData();
              // Actualizar tabla generos
              this.getGenerosData('');
            }, error => {
              // Limpiar formulario
              this.formulario.reset();
              this.limpiarArchivo(new MouseEvent('click'));
              var data = {
                "type": "error",
                "title": "Archivo incorrecto",
                "message": "No se pudo cargar el archivo."
              };
              this.alertService.alert_response_server(data);
              console.log(error);
            });
          } else {
            console.log('Se ha hecho clic en Cancelar');
          }
        });
      } else {
        const title = 'Actualizacion de géneros requerida';
        const message = 'Solo se puede actualizar el período existente.';
        this.alertService.toastMessage('info', title, message);
      }
    }
  }
  // Limpiar input file
  limpiarArchivo(event) {
    event.stopPropagation(); // Evita la propagación del evento
    // Limpiar el campo de tipo archivo
    const input = this.fileInput.nativeElement;
    input.value = ''; // Limpiar el valor del campo de tipo file
    this.selectedFile = undefined; // Limpiar la referencia al archivo seleccionado
    this.fileText = this.placeholderInputFile; // Asignar texto del placeholder
    // Eliminar la clase show
    this.showRemoveIcon = false;
    // Actualizar chips
    this.getArchivosData();
  }
  // =========================================================================
  // Chips de archivos cargados
  // =========================================================================
  // Obtener los nombres de los archivos de notas de la base de datos
  getArchivosData() {
    this.fileService.getFilesNotas().subscribe(response => {
      this.fileNames = response.data;
      this.endPeriod = this.fileNames[0]; // Ultimo periodo
      this.currentFileName = this.fileNames[0]; // Obtener el nombre del archivo inicial
      this.namePeriodSelect = this.fileNames[0].replace(/\.[^/.]+$/, ""); //Obteener periodo sin extencion de archivo
    }, error => {
      console.error('Error fetching files', error);
    });
  }
  // Eliminar el archivo de notas de la base de datos
  removeFile(fileName, event) {
    event.stopPropagation();
    const message = '¿Está seguro que desea eliminar el archivo?';
    const confirmar = this.alertService.alert_confirmation(message);
    confirmar.then(confirmado => {
      if (confirmado) {
        this.fileService.deleteFileNotas(fileName).subscribe(response => {
          if (response.ok) {
            // Cambia el estado para obtener nuevamente el ultimo periodo
            this.isLastPeriodLoaded = true;
            this.fileNames = this.fileNames.filter(name => name !== fileName);
            const title = `Archivo ${fileName}`;
            const message = 'Se elimino correctamente.';
            this.alertService.toastMessage('success', title, message);
          }
          // Actualizar chips
          this.getArchivosData();
          // Actualizar tabla generos
          this.getGenerosData('');
        }, error => {
          // Actualizar chips
          this.getArchivosData();
          // Actualizar tabla generos
          this.getGenerosData('');
          console.log(error);
        });
      } else {
        console.log('Se ha hecho clic en Cancelar');
      }
    });
  }
  // =========================================================================
  // Validaciones unicas de formulario
  // =========================================================================
  // Valida por coincidencia escrita en un campo
  forbiddenNameValidator(nameRe) {
    return control => {
      const forbidden = nameRe.test(control.value);
      return forbidden ? {
        'forbiddenText': {
          value: control.value
        }
      } : null;
    };
  }
  // Valida por coincidencia exacta => /texto/
  forbiddenTextValidator(forbiddenText) {
    return control => {
      const forbidden = control.value === forbiddenText;
      return forbidden ? {
        'forbiddenText': {
          value: control.value
        }
      } : null;
    };
  }
  // =========================================================================
  // Obtener generos en tabla
  // =========================================================================
  // Obtener los generos
  getGenerosData(fileName) {
    this.currentFileName = fileName;
    this.namePeriodSelect = this.currentFileName.replace(/\.[^/.]+$/, ""); //Obteener periodo sin extencion de archivo
    this.dataService.getGenerosData(fileName).subscribe(response => {
      this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTableDataSource(response.data);
      this.dataSource.sort = this.sort; // Aplicar sort en la cabezera
      this.updateUnselectedGendersCount(); // Actualiza el conteo después de inicializar los géneros
    });
  }
  // Inicializa los generos
  initGenre() {
    this.genderSelections = {};
    this.originalGenderSelections = {};
    // inicializa genderSelections con los valores actuales del dataSource
    this.dataSource.data.forEach(item => {
      this.genderSelections[item.ID] = item.GENERO;
      this.originalGenderSelections[item.ID] = item.GENERO; // Guarda los valores originales
    });
  }
  // Actualizar generos
  updateGender(id, gender) {
    if (['H', 'M'].includes(gender)) {
      this.genderSelections[id] = gender;
      const index = this.dataSource.data.findIndex(item => item.ID === id);
      if (index !== -1) {
        // Cambia el estado para obtener nuevamente el ultimo periodo
        this.dataSource.data[index].GENERO = gender;
        this.updateUnselectedGendersCount();
        this.cd.detectChanges(); // Forzar la detección de cambios
      }
    }
  }
  // Verifica si hay cambios para permitir la actualización
  hasChanges() {
    return Object.entries(this.genderSelections).some(([id, gender]) => this.originalGenderSelections[id] !== gender);
  }
  // actualiza los generos en el servidor
  submitUpdate() {
    // Verificacion de campos
    if (this.unselectedGendersCount === 0) {
      if (this.currentFileName !== '202350.xlsx') {
        if (this.hasChanges()) {
          const updateData = Object.entries(this.genderSelections).map(([ID, GENERO]) => ({
            ID,
            GENERO
          }));
          this.dataService.uploadGeneros(this.currentFileName, {
            data: updateData
          }).subscribe(response => {
            console.log(response);
            // Cambia el estado para obtener nuevamente el ultimo periodo y ejecuta la actualizacion del contador para el ultimo periodo
            this.isLastPeriodLoaded = true;
            this.updateUnselectedGendersCount();
            // Actualizar los valores originales después de una actualización exitosa
            this.initGenre();
            const title = 'Actualización Completa';
            const message = 'Los géneros han sido actualizados.';
            this.alertService.toastMessage('success', title, message);
          });
        } else {
          const title = 'Sin Cambios';
          const message = 'No hay cambios para actualizar.';
          this.alertService.toastMessage('info', title, message);
        }
      }
    } else {
      const title = 'Campos vacíos!';
      const message = 'Por favor, asegúrese de que todos los géneros están seleccionados y asignados a "H" o "M".';
      this.alertService.toastMessage('info', title, message);
    }
  }
  // Actualizar contador de generos seleccionados
  updateUnselectedGendersCount() {
    this.unselectedGendersCount = this.dataSource.data.filter(item => item.GENERO === '0').length;
    // Manejar la variable de control de contador en el ultimo periodo siempre
    if (this.isLastPeriodLoaded) {
      this.endCountPeriod = this.unselectedGendersCount;
      this.isLastPeriodLoaded = false;
    }
    // console.log("Unselected Genders Count: ", this.unselectedGendersCount);
  }
  static #_ = this.ɵfac = function LoadPeriodsComponent_Factory(t) {
    return new (t || LoadPeriodsComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_angular_forms__WEBPACK_IMPORTED_MODULE_6__.FormBuilder), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_0__.AlertService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_upload_data_service__WEBPACK_IMPORTED_MODULE_1__.UploadDataService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_2__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_file_service__WEBPACK_IMPORTED_MODULE_3__.FileService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_angular_core__WEBPACK_IMPORTED_MODULE_4__.ChangeDetectorRef));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdefineComponent"]({
    type: LoadPeriodsComponent,
    selectors: [["app-load-periods"]],
    viewQuery: function LoadPeriodsComponent_Query(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵviewQuery"](_angular_material_sort__WEBPACK_IMPORTED_MODULE_7__.MatSort, 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵviewQuery"](_c0, 5);
      }
      if (rf & 2) {
        let _t;
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵloadQuery"]()) && (ctx.sort = _t.first);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵloadQuery"]()) && (ctx.fileInput = _t.first);
      }
    },
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵStandaloneFeature"]],
    decls: 50,
    vars: 18,
    consts: [["tooltipContentTableGenero", ""], ["tooltipContentNameForm", ""], ["fileInput", ""], [1, "contenedor_agregar_periodo"], [1, "contenedor_archivos_notas"], [1, "contenedor_formulario"], [1, "contenedor_archivos_chips"], [1, "archivos_cargados"], [1, "elements", 3, "ngClass"], [1, "contenedor_registro_genero"], [1, "title_icon_info"], [3, "ngClass"], [1, "info-icon", 3, "pTooltip", "autoHide"], [1, "fa-regular", "fa-circle-info"], [1, "contenedor_tabla"], [1, "table-container", "mat-elevation-z8"], ["mat-table", "", "matSort", "", 3, "dataSource"], ["matColumnDef", "num"], ["mat-header-cell", "", 4, "matHeaderCellDef"], ["mat-cell", "", 4, "matCellDef"], [3, "matColumnDef"], ["matColumnDef", "GENERO"], ["class", "contenedor_radios_tabla", "mat-cell", "", 4, "matCellDef"], ["mat-header-row", "", 4, "matHeaderRowDef"], ["mat-row", "", 4, "matRowDef", "matRowDefColumns"], [1, "noExisteRegistro"], [1, "contenedor_botones"], [1, "info_content", "left", 3, "ngClass"], [1, "button2", "efects_button", 3, "click"], [1, "info_content", "right"], [1, "nota"], [1, "formulario", 3, "formGroup"], ["for", "nombrePeriodo"], [1, "requerido"], ["type", "text", "formControlName", "nombrePeriodo", "id", "nombrePeriodo", "placeholder", "Ingrese el nombre de periodo", 1, "input"], [1, "contenedor_campo_requerido"], ["for", "input_file"], ["onclick", "document.getElementById('input_file').click()", 1, "input", "input_file"], ["id", "fileText"], [1, "fa-solid", "fa-arrow-up-from-bracket"], ["title", "Eliminar archivo", 1, "remove-icon", 3, "click", "ngClass"], ["formControlName", "filePeriodo", "id", "input_file", "type", "file", "accept", ".xlsx", 2, "display", "none", 3, "change"], [1, "content_button"], [1, "button", "efects_button", 3, "click"], [1, "info_content"], [1, "elements", 3, "click", "ngClass"], [1, "element-text"], ["pTooltip", "Eliminar", "tooltipPosition", "top", 1, "element-icon"], ["pTooltip", "Eliminar", "tooltipPosition", "top", 1, "element-icon", 3, "click"], [1, "fa-sharp", "fa-regular", "fa-circle-xmark"], ["mat-header-cell", ""], ["mat-cell", ""], ["mat-header-cell", "", "mat-sort-header", "", 3, "class", 4, "matHeaderCellDef"], ["mat-cell", "", 3, "class", 4, "matCellDef"], ["mat-header-cell", "", "mat-sort-header", ""], ["mat-cell", "", 1, "contenedor_radios_tabla"], [1, "radio-option"], ["type", "radio", "value", "H", 3, "change", "id", "name", "checked"], [3, "for"], ["type", "radio", "value", "M", 3, "change", "id", "name", "checked"], ["mat-header-row", ""], ["mat-row", ""]],
    template: function LoadPeriodsComponent_Template(rf, ctx) {
      if (rf & 1) {
        const _r1 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵgetCurrentView"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](0, "section", 3)(1, "div", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](2, LoadPeriodsComponent_Conditional_2_Template, 39, 9, "div", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](3, "div", 6)(4, "div")(5, "span")(6, "b");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](7, "Periodos almacenados");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](8, "hr");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](9, "div", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](10, LoadPeriodsComponent_For_11_Template, 5, 5, "div", 8, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](12, "div", 9)(13, "div")(14, "span", 10)(15, "b");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](16, "Actualizar g\u00E9neros de ");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](17, "span", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](18);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](19, "div", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](20, "i", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](21, LoadPeriodsComponent_ng_template_21_Template, 8, 0, "ng-template", null, 0, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplateRefExtractor"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](23, "hr");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](24, "div")(25, "div", 14)(26, "div", 15)(27, "table", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerStart"](28, 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](29, LoadPeriodsComponent_th_29_Template, 2, 0, "th", 18)(30, LoadPeriodsComponent_td_30_Template, 2, 1, "td", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterCreate"](31, LoadPeriodsComponent_For_32_Template, 3, 1, "ng-container", 20, _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeaterTrackByIdentity"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerStart"](33, 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](34, LoadPeriodsComponent_th_34_Template, 2, 0, "th", 18)(35, LoadPeriodsComponent_td_35_Template, 9, 14, "td", 22);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementContainerEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](36, LoadPeriodsComponent_tr_36_Template, 1, 0, "tr", 23)(37, LoadPeriodsComponent_tr_37_Template, 1, 0, "tr", 24);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtemplate"](38, LoadPeriodsComponent_Conditional_38_Template, 2, 0, "tr", 25);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](39, "div", 26)(40, "span", 27);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](41, "Completar: ");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](42, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](43);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](44, "button", 28);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function LoadPeriodsComponent_Template_button_click_44_listener() {
          _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrestoreView"](_r1);
          return _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵresetView"](ctx.submitUpdate());
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](45, "Actualizar");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](46, "span", 29);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](47, "Total: ");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](48, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtext"](49);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()()()()();
      }
      if (rf & 2) {
        const tooltipContentTableGenero_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵreference"](22);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](2, ctx.formulario ? 2 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](8);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.fileNames);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](7);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](12, _c1, ctx.namePeriodSelect !== "202350"));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](ctx.namePeriodSelect === "202350" ? "estudiantes" : ctx.namePeriodSelect);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("pTooltip", tooltipContentTableGenero_r13)("autoHide", false);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](8);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("dataSource", ctx.dataSource);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵrepeater"](ctx.displayedColumns);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matHeaderRowDef", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](14, _c2).concat(ctx.displayedColumns).concat("GENERO"));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("matRowDefColumns", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction0"](15, _c2).concat(ctx.displayedColumns).concat("GENERO"));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵconditional"](38, ctx.dataSource.data.length === 0 ? 38 : -1);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("ngClass", _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵpureFunction1"](16, _c3, ctx.unselectedGendersCount === 0));
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](ctx.unselectedGendersCount);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵtextInterpolate"](ctx.dataSource.data.length);
      }
    },
    dependencies: [_angular_material_sort__WEBPACK_IMPORTED_MODULE_7__.MatSortModule, _angular_material_sort__WEBPACK_IMPORTED_MODULE_7__.MatSort, _angular_material_sort__WEBPACK_IMPORTED_MODULE_7__.MatSortHeader, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.FormsModule, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.DefaultValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.NgControlStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.NgControlStatusGroup, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatTable, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatColumnDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderCellDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderCell, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatCellDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatCell, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderRowDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatHeaderRow, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatRowDef, _angular_material_table__WEBPACK_IMPORTED_MODULE_5__.MatRow, _angular_material_input__WEBPACK_IMPORTED_MODULE_8__.MatInputModule, _angular_material_form_field__WEBPACK_IMPORTED_MODULE_9__.MatFormFieldModule, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.ReactiveFormsModule, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.FormGroupDirective, _angular_forms__WEBPACK_IMPORTED_MODULE_6__.FormControlName, _angular_common__WEBPACK_IMPORTED_MODULE_10__.NgClass, primeng_tooltip__WEBPACK_IMPORTED_MODULE_11__.TooltipModule, primeng_tooltip__WEBPACK_IMPORTED_MODULE_11__.Tooltip, primeng_table__WEBPACK_IMPORTED_MODULE_12__.TableModule],
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n.contenedor_tabla[_ngcontent-%COMP%] {\n  display: grid;\n  border-radius: 5px;\n  border: 1px solid rgba(128, 128, 128, 0.3);\n  overflow-x: auto;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%] {\n  overflow-x: auto;\n  box-shadow: none !important;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%] {\n  width: 100%;\n  box-shadow: none !important;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   td[_ngcontent-%COMP%], .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%] {\n  width: 200px;\n  min-width: 150px;\n  font-size: 0.8em;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   th[_ngcontent-%COMP%] {\n  position: sticky;\n  font-size: 1em;\n  font-weight: bold;\n  top: 0;\n  background: linear-gradient(to bottom, #fff, #fff), linear-gradient(to bottom, rgba(64, 69, 108, 0.3), rgba(64, 69, 108, 0.2));\n  background-blend-mode: multiply;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-header-row[_ngcontent-%COMP%] {\n  height: 40px;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%] {\n  transition: all 0.1s;\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%]:hover {\n  background-color: rgba(64, 69, 108, 0.05);\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%] {\n  display: grid;\n  align-items: end;\n  height: 56px;\n}\n@media (max-width: 620px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container {\n    align-items: center;\n    justify-content: center;\n    justify-items: center;\n  }\n}\n@media (max-width: 455px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container {\n    margin-top: -25px;\n  }\n}\n@media (max-width: 620px) {\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container .mat-mdc-paginator-range-actions {\n    display: grid;\n    grid-template-columns: repeat(4, 1fr);\n    justify-items: center;\n  }\n  .contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-container .mat-mdc-paginator-range-actions div {\n    grid-column: 1/-1;\n  }\n}\n.contenedor_tabla[_ngcontent-%COMP%]   .paginator-container[_ngcontent-%COMP%]     .mat-mdc-paginator-page-size-label {\n  display: none;\n}\n\n  .noExisteRegistro {\n  display: grid;\n  height: 40%;\n  font-size: 1.2em;\n  text-align: center;\n  align-content: end;\n  color: #808080;\n}\n\n.contenedor_agregar_periodo[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr 1fr;\n  gap: 20px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 20px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_formulario[_ngcontent-%COMP%] {\n  display: grid;\n  gap: 20px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_formulario[_ngcontent-%COMP%]   .nota[_ngcontent-%COMP%] {\n  margin-top: 20px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_formulario[_ngcontent-%COMP%]   .formulario[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: 1fr;\n  gap: 10px;\n  padding: 10px;\n  border-radius: 10px;\n  border: 1px solid rgba(64, 69, 108, 0.2);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_formulario[_ngcontent-%COMP%]   .formulario[_ngcontent-%COMP%]   div[_ngcontent-%COMP%] {\n  display: grid;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_formulario[_ngcontent-%COMP%]   .formulario[_ngcontent-%COMP%]   .content_button[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: center;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%] {\n  display: block;\n  height: 205px;\n  max-height: 205px;\n  padding: 10px;\n  border-radius: 10px;\n  border: 1px solid rgba(64, 69, 108, 0.2);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%] {\n  display: grid;\n  grid-template-columns: repeat(3, 1fr);\n  grid-template-rows: repeat(4, 1fr);\n  gap: 5px;\n  height: 170px;\n  width: 100%;\n  overflow-y: auto;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements[_ngcontent-%COMP%] {\n  position: relative;\n  display: grid;\n  grid-template-columns: 15fr 1fr;\n  align-items: center;\n  justify-content: center;\n  max-height: 30px;\n  padding: 10px;\n  border-radius: 50px;\n  background-color: rgba(64, 69, 108, 0.1);\n  transition: all 0.3s;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements[_ngcontent-%COMP%]:hover {\n  background-color: rgba(64, 69, 108, 0.2);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements[_ngcontent-%COMP%]   .element-text[_ngcontent-%COMP%] {\n  font-size: 1em;\n  text-align: center;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements[_ngcontent-%COMP%]   .element-icon[_ngcontent-%COMP%] {\n  cursor: pointer;\n  transition: all 0.3s;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements[_ngcontent-%COMP%]   .element-icon[_ngcontent-%COMP%]:hover {\n  color: var(--red);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_archivos_notas[_ngcontent-%COMP%]   .contenedor_archivos_chips[_ngcontent-%COMP%]   .archivos_cargados[_ngcontent-%COMP%]   .elements_clic[_ngcontent-%COMP%] {\n  cursor: pointer;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%] {\n  padding: 10px;\n  border-radius: 10px;\n  border: 1px solid rgba(64, 69, 108, 0.2);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .title_icon_info[_ngcontent-%COMP%] {\n  display: flex;\n  align-items: center;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .title_icon_info[_ngcontent-%COMP%]   .name_periods_active[_ngcontent-%COMP%] {\n  color: #40456c;\n  font-weight: 800;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%] {\n  height: 490px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .mat-mdc-row[_ngcontent-%COMP%] {\n  height: 30px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .contenedor_radios_tabla[_ngcontent-%COMP%] {\n  display: flex;\n  height: 30px;\n  width: 95px;\n  gap: 10px;\n  align-items: center;\n  align-content: center;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .contenedor_radios_tabla[_ngcontent-%COMP%]   .radio-option[_ngcontent-%COMP%] {\n  display: flex;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   table[_ngcontent-%COMP%]   .contenedor_radios_tabla[_ngcontent-%COMP%]   .radio-option[_ngcontent-%COMP%]   label[_ngcontent-%COMP%] {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-size: 1em;\n  font-weight: 500;\n  cursor: pointer;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-num[_ngcontent-%COMP%], .contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-num[_ngcontent-%COMP%] {\n  min-width: 40px !important;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ID-header[_ngcontent-%COMP%], .contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ID-cell[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 40px !important;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ESTUDIANTE-header[_ngcontent-%COMP%], .contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .ESTUDIANTE-cell[_ngcontent-%COMP%] {\n  min-width: 280px !important;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-GENERO[_ngcontent-%COMP%], .contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_tabla[_ngcontent-%COMP%]   .table-container[_ngcontent-%COMP%]   .mat-column-GENERO[_ngcontent-%COMP%] {\n  text-align: center;\n  min-width: 110px !important;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%] {\n  position: relative;\n  display: grid;\n  justify-content: center;\n  padding: 10px 0;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   button[_ngcontent-%COMP%] {\n  padding: 0 30px;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .left[_ngcontent-%COMP%] {\n  position: absolute;\n  display: flex;\n  align-items: center;\n  padding-left: 15px;\n  color: var(--red);\n  transform: translate(0%, 50%);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .left[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n  padding-left: 5px;\n  font-weight: bold;\n  font-size: 1.2em;\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .right[_ngcontent-%COMP%] {\n  position: absolute;\n  display: flex;\n  align-items: center;\n  padding-right: 15px;\n  color: #000000;\n  right: 0;\n  transform: translate(0%, 50%);\n}\n.contenedor_agregar_periodo[_ngcontent-%COMP%]   .contenedor_registro_genero[_ngcontent-%COMP%]   .contenedor_botones[_ngcontent-%COMP%]   .right[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n  padding-left: 5px;\n  font-weight: bold;\n  font-size: 1.2em;\n}\n\n.complete_genre[_ngcontent-%COMP%] {\n  color: var(--green) !important;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9Nb2R1bGUvdmlld3MvRGlyZWN0b3IvbG9hZC1wZXJpb2RzL2xvYWQtcGVyaW9kcy5jb21wb25lbnQuc2NzcyIsIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy9jb21wb25lbnRzL190YWJsZS5zY3NzIiwid2VicGFjazovLy4vc3JjL2Fzc2V0cy9zY3NzL3ZhcnMvX2ZvbnRzLnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fY29sb3JzLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0E7RUFHRSxzQkFBQTtFQUNBLHlCQUFBO0VBRUEsdUJBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFFQSx5QkFBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUdBLCtDQUFBO0VBQ0EsOENBQUE7RUFDQSw2Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSwyQ0FBQTtFQUdBLHdCQUFBO0VBQ0EsNEJBQUE7RUFDQSw0QkFBQTtFQUNBLDJCQUFBO0VBQ0EsNkJBQUE7QUNSRjs7QUM3QkE7RUFDRSxhQUFBO0VBQ0Esa0JBQUE7RUFDQSwwQ0FBQTtFQUNBLGdCQUFBO0FEZ0NGO0FDOUJFO0VBQ0UsZ0JBQUE7RUFDQSwyQkFBQTtBRGdDSjtBQzlCSTtFQUNFLFdBQUE7RUFDQSwyQkFBQTtBRGdDTjtBQzlCTTs7RUFFRSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkNxQ0s7QUZMYjtBQzdCTTtFQUNFLGdCQUFBO0VB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QkFBQTtFQUNBLGNHekxBO0VIMExBLFFBQUE7RUFDQSw2QkFBQTtBQTRFUjtBQTFFUTtFQUNFLGlCQUFBO0VBQ0EsaUJBQUE7RUFDQSxnQkFBQTtBQTRFVjs7QUF0RUE7RUFDRSw4QkFBQTtBQXlFRiIsInNvdXJjZXNDb250ZW50IjpbIi8vIENvbG9yZXMgcm9vdFxyXG46cm9vdCB7XHJcblxyXG4gIC8vIHNvbGlkXHJcbiAgLS1qZXQ6IGhzbCgwLCAwJSwgMjIlKTtcclxuICAtLW9ueXg6IGhzbCgyNDAsIDElLCAxNyUpO1xyXG5cclxuICAtLWJsYWNrOiBoc2woMCwgMCUsIDAlKTtcclxuICAtLWJsYWNrLTkwOiBoc2xhKDAsIDAlLCAwJSwgMC45KTtcclxuICAtLWJsYWNrLTgwOiBoc2xhKDAsIDAlLCAwJSwgMC44KTtcclxuICAtLWJsYWNrLTcwOiBoc2xhKDAsIDAlLCAwJSwgMC43KTtcclxuICAtLWJsYWNrLTYwOiBoc2xhKDAsIDAlLCAwJSwgMC42KTtcclxuICAtLWJsYWNrLTUwOiBoc2xhKDAsIDAlLCAwJSwgMC41KTtcclxuICAtLWJsYWNrLTQwOiBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuICAtLWJsYWNrLTMwOiBoc2xhKDAsIDAlLCAwJSwgMC4zKTtcclxuICAtLWJsYWNrLTIwOiBoc2xhKDAsIDAlLCAwJSwgMC4yKTtcclxuICAtLWJsYWNrLTEwOiBoc2xhKDAsIDAlLCAwJSwgMC4xKTtcclxuXHJcbiAgLS13aGl0ZTogaHNsKDAsIDAlLCAxMDAlKTtcclxuICAtLXdoaXRlLTkwOiBoc2woMCwgMCUsIDEwMCUsIDAuOSk7XHJcbiAgLS13aGl0ZS04MDogaHNsKDAsIDAlLCAxMDAlLCAwLjgpO1xyXG4gIC0td2hpdGUtNzA6IGhzbCgwLCAwJSwgMTAwJSwgMC43KTtcclxuICAtLXdoaXRlLTYwOiBoc2woMCwgMCUsIDEwMCUsIDAuNik7XHJcbiAgLS13aGl0ZS01MDogaHNsKDAsIDAlLCAxMDAlLCAwLjUpO1xyXG4gIC0td2hpdGUtNDA6IGhzbCgwLCAwJSwgMTAwJSwgMC40KTtcclxuICAtLXdoaXRlLTMwOiBoc2woMCwgMCUsIDEwMCUsIDAuMyk7XHJcbiAgLS13aGl0ZS0yMDogaHNsKDAsIDAlLCAxMDAlLCAwLjIpO1xyXG4gIC0td2hpdGUtMTA6IGhzbCgwLCAwJSwgMTAwJSwgMC4xKTtcclxuXHJcbiAgLy8gc2hhZG93XHJcbiAgLS1zaGFkb3ctMTogLTRweCA4cHggMjRweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMjogNXB4IDVweCAxMHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0zOiAwIDE2cHggNDBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNDogMCAyNXB4IDUwcHggaHNsYSgwLCAwJSwgMCUsIDAuMTUpO1xyXG4gIC0tc2hhZG93LTU6IDAgMjRweCA4MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy02OiAwIDE2cHggM3B4IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG5cclxuICAvLyBDb2xvcnNcclxuICAtLXJlZDogaHNsKDAsIDEwMCUsIDUwJSk7XHJcbiAgLS15ZWxsb3c6IGhzbCg2MCwgMTAwJSwgNTAlKTtcclxuICAtLWdyZWVuOiBoc2woMTIwLCAxMDAlLCAyNSUpO1xyXG4gIC0tYmx1ZTogaHNsKDI0MCwgMTAwJSwgNTAlKTtcclxuICAtLXB1cnBsZTogaHNsKDMwMCwgMTAwJSwgMjUlKTtcclxufVxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgXCIuLi8uLi8uLi8uLi8uLi8uLi9hc3NldHMvc2Nzcy92YXJzL2NvbG9yc1wiIGFzIGNvbG9ycztcclxuQHVzZSBcIi4uLy4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvZm9udHNcIiBhcyBmb250cztcclxuQHVzZSBcIi4uLy4uLy4uLy4uLy4uLy4uL2Fzc2V0cy9zY3NzL2NvbXBvbmVudHMvdGFibGVcIjtcclxuXHJcbi5jb250ZW5lZG9yX2FncmVnYXJfcGVyaW9kbyB7XHJcbiAgZGlzcGxheTogZ3JpZDtcclxuICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IDFmciAxZnI7XHJcbiAgZ2FwOiAyMHB4O1xyXG5cclxuICAuY29udGVuZWRvcl9hcmNoaXZvc19ub3RhcyB7XHJcbiAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgZ2FwOiAyMHB4O1xyXG5cclxuICAgIC5jb250ZW5lZG9yX2Zvcm11bGFyaW8ge1xyXG4gICAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgICBnYXA6IDIwcHg7XHJcblxyXG4gICAgICAubm90YSB7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMjBweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLmZvcm11bGFyaW8ge1xyXG4gICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgZ3JpZC10ZW1wbGF0ZS1jb2x1bW5zOiAxZnI7XHJcbiAgICAgICAgZ2FwOiAxMHB4O1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKTtcclxuXHJcbiAgICAgICAgZGl2IHtcclxuICAgICAgICAgIGRpc3BsYXk6IGdyaWQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuY29udGVudF9idXR0b24ge1xyXG4gICAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5jb250ZW5lZG9yX2FyY2hpdm9zX2NoaXBzIHtcclxuICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgIGhlaWdodDogMjA1cHg7XHJcbiAgICAgIG1heC1oZWlnaHQ6IDIwNXB4O1xyXG4gICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgICBib3JkZXI6IDFweCBzb2xpZCByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKTtcclxuXHJcbiAgICAgIC5hcmNoaXZvc19jYXJnYWRvcyB7XHJcbiAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICBncmlkLXRlbXBsYXRlLWNvbHVtbnM6IHJlcGVhdCgzLCAxZnIpO1xyXG4gICAgICAgIGdyaWQtdGVtcGxhdGUtcm93czogcmVwZWF0KDQsIDFmcik7XHJcbiAgICAgICAgZ2FwOiA1cHg7XHJcbiAgICAgICAgaGVpZ2h0OiAxNzBweDtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBvdmVyZmxvdy15OiBhdXRvO1xyXG5cclxuICAgICAgICAuZWxlbWVudHMge1xyXG4gICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICAgIGdyaWQtdGVtcGxhdGUtY29sdW1uczogMTVmciAxZnI7XHJcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICBtYXgtaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgcGFkZGluZzogMTBweDtcclxuICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDUwcHg7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4xKTtcclxuICAgICAgICAgIHRyYW5zaXRpb246IGFsbCAwLjNzO1xyXG5cclxuICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC4yKTtcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAuZWxlbWVudC10ZXh0IHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiBmb250cy4kdGV4dC1wO1xyXG4gICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgLmVsZW1lbnQtaWNvbiB7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgdHJhbnNpdGlvbjogYWxsIDAuM3M7XHJcblxyXG4gICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICBjb2xvcjogdmFyKC0tcmVkKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAvLyBjdWFuZG8gbm8gZXMgMjAyMzUwXHJcbiAgICAgICAgLmVsZW1lbnRzX2NsaWMge1xyXG4gICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgLmNvbnRlbmVkb3JfcmVnaXN0cm9fZ2VuZXJvIHtcclxuICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgcmdiYShjb2xvcnMuJHByaW1hcnksIDAuMik7XHJcblxyXG4gICAgLnRpdGxlX2ljb25faW5mbyB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAubmFtZV9wZXJpb2RzX2FjdGl2ZSB7XHJcbiAgICAgICAgY29sb3I6IGNvbG9ycy4kcHJpbWFyeTtcclxuICAgICAgICBmb250LXdlaWdodDogODAwO1xyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbnRlbmVkb3JfdGFibGEge1xyXG4gICAgICBoZWlnaHQ6IDQ5MHB4O1xyXG5cclxuICAgICAgLnRhYmxlLWNvbnRhaW5lciB7XHJcbiAgICAgICAgdGFibGUge1xyXG4gICAgICAgICAgLm1hdC1tZGMtcm93IHtcclxuICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICAgIC5jb250ZW5lZG9yX3JhZGlvc190YWJsYSB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgd2lkdGg6IDk1cHg7XHJcbiAgICAgICAgICAgIGdhcDogMTBweDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgYWxpZ24tY29udGVudDogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgLnJhZGlvLW9wdGlvbiB7XHJcbiAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICAgICAgICAgICAgbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtcDtcclxuICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiA1MDA7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAvLyBUYW1hw4PCsW8gZGUgY2VsZGFzIGVuIHRhYmxhXHJcbiAgICAgICAgLm1hdC1jb2x1bW4tbnVtLFxyXG4gICAgICAgIC5tYXQtY29sdW1uLW51bSB7XHJcbiAgICAgICAgICBtaW4td2lkdGg6IDQwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5JRC1oZWFkZXIsXHJcbiAgICAgICAgLklELWNlbGwge1xyXG4gICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgbWluLXdpZHRoOiA0MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuRVNUVURJQU5URS1oZWFkZXIsXHJcbiAgICAgICAgLkVTVFVESUFOVEUtY2VsbCB7XHJcbiAgICAgICAgICBtaW4td2lkdGg6IDI4MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWNvbHVtbi1HRU5FUk8sXHJcbiAgICAgICAgLm1hdC1jb2x1bW4tR0VORVJPIHtcclxuICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgIG1pbi13aWR0aDogMTEwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuY29udGVuZWRvcl9ib3RvbmVzIHtcclxuICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgcGFkZGluZzogMTBweCAwO1xyXG5cclxuICAgICAgYnV0dG9uIHtcclxuICAgICAgICBwYWRkaW5nOiAwIDMwcHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5sZWZ0IHtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTVweDtcclxuICAgICAgICBjb2xvcjogdmFyKC0tcmVkKTtcclxuICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgwJSwgNTAlKTtcclxuXHJcbiAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDVweDtcclxuICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgZm9udC1zaXplOiBmb250cy4kdGV4dC1wICsgMC4yZW07XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcblxyXG4gICAgICAucmlnaHQge1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICBjb2xvcjogY29sb3JzLiRibGFjaztcclxuICAgICAgICByaWdodDogMDtcclxuICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgwJSwgNTAlKTtcclxuXHJcbiAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDVweDtcclxuICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgZm9udC1zaXplOiBmb250cy4kdGV4dC1wICsgMC4yZW07XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcbi5jb21wbGV0ZV9nZW5yZSB7XHJcbiAgY29sb3I6IHZhcigtLWdyZWVuKSAhaW1wb3J0YW50O1xyXG59XHJcbiIsIi8vIEltcG9ydHNcclxuQHVzZSBcIi4uL3ZhcnMvY29sb3JzXCIgYXMgY29sb3JzO1xyXG5AdXNlIFwiLi4vdmFycy9mb250c1wiIGFzIGZvbnRzO1xyXG5cclxuLy8gRXN0aWxvcyBwYXJhIGVsIGNvbnRlbmVkb3IgZGUgbGEgdGFibGFcclxuLmNvbnRlbmVkb3JfdGFibGEge1xyXG4gIGRpc3BsYXk6IGdyaWQ7XHJcbiAgYm9yZGVyLXJhZGl1czogNXB4O1xyXG4gIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoY29sb3JzLiRncmF5LCAwLjMpO1xyXG4gIG92ZXJmbG93LXg6IGF1dG87XHJcblxyXG4gIC50YWJsZS1jb250YWluZXIge1xyXG4gICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuXHJcbiAgICB0YWJsZSB7XHJcbiAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICB0ZCxcclxuICAgICAgdGgge1xyXG4gICAgICAgIHdpZHRoOiAyMDBweDtcclxuICAgICAgICBtaW4td2lkdGg6IDE1MHB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJGZvcm0taW5wdXQ7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIHRoIHtcclxuICAgICAgICBwb3NpdGlvbjogc3RpY2t5O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtcDtcclxuICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICB0b3A6IDA7XHJcbiAgICAgICAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgY29sb3JzLiR3aGl0ZSwgY29sb3JzLiR3aGl0ZSksXHJcbiAgICAgICAgbGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgcmdiYShjb2xvcnMuJHByaW1hcnksIDAuMyksIHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjIpKTtcclxuICAgICAgICBiYWNrZ3JvdW5kLWJsZW5kLW1vZGU6IG11bHRpcGx5O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAvLyBIZWFkXHJcbiAgICAgIC5tYXQtbWRjLWhlYWRlci1yb3cge1xyXG4gICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLy8gQm9keVxyXG4gICAgICAubWF0LW1kYy1yb3cge1xyXG4gICAgICAgIHRyYW5zaXRpb246IGFsbCAwLjFzO1xyXG4gICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYShjb2xvcnMuJHByaW1hcnksIC4wNSk7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG5cclxuICAucGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICBkaXNwbGF5OiBncmlkO1xyXG4gICAgYWxpZ24taXRlbXM6IGVuZDtcclxuICAgIGhlaWdodDogNTZweDtcclxuXHJcbiAgICA6Om5nLWRlZXAgLm1hdC1tZGMtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA2MjBweCkge1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1pdGVtczogY2VudGVyO1xyXG4gICAgICB9XHJcblxyXG4gICAgICBAbWVkaWEgKG1heC13aWR0aDogNDU1cHgpIHtcclxuICAgICAgICBtYXJnaW4tdG9wOiAtMjVweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm1hdC1tZGMtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA2MjBweCkge1xyXG4gICAgICAgICAgZGlzcGxheTogZ3JpZDtcclxuICAgICAgICAgIGdyaWQtdGVtcGxhdGUtY29sdW1uczogcmVwZWF0KDQsIDFmcik7XHJcbiAgICAgICAgICBqdXN0aWZ5LWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgZGl2IHtcclxuICAgICAgICAgICAgZ3JpZC1jb2x1bW46IDEgLyAtMTtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAvLyBFbGltaW5hciB0ZXh0byBkZSBudW1lcm8gZGUgZmlsdHJvIGVuIHRhYmxhXHJcbiAgICA6Om5nLWRlZXAgLm1hdC1tZGMtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcblxyXG46Om5nLWRlZXAgLm5vRXhpc3RlUmVnaXN0cm8ge1xyXG4gIGRpc3BsYXk6IGdyaWQ7XHJcbiAgaGVpZ2h0OiA0MCU7XHJcbiAgZm9udC1zaXplOiBmb250cy4kdGV4dC1lcnJvcjtcclxuICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgYWxpZ24tY29udGVudDogZW5kO1xyXG4gIGNvbG9yOiBjb2xvcnMuJGdyYXk7XHJcbn1cclxuIiwiLy8gRnVlbnRlIHByaW5jaXBhbFxyXG4kZm9udC1wcmltYXJ5OiAnQXJpYWwnLCBzYW5zLXNlcmlmO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgVmFyaWFibGVzXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuLy8gTmF2YmFyXHJcbiR0ZXh0LW5hdjogMS4xNWVtOyAgICAgIC8vIDE4cHhcclxuXHJcbi8vIFNpZGViYXJcclxuJHRpdGxlLXNpZGViYXI6IDEuMmVtOyAgLy8gMjBweFxyXG4kaXRlbS10ZXh0OiAwLjc1ZW07ICAgICAvLyAxMnB4XHJcbiRpdGVtLWRpdmlkZXI6IDAuNmVtOyAgIC8vIDEwcHhcclxuJGl0ZW0tYXV0b3JzOiAwLjU1ZW07ICAgLy8gOXB4XHJcblxyXG4vLyBDb250ZW50XHJcbiR0aXRsZS1jb250ZW50OiAxLjJlbTtcclxuXHJcbi8vIEVycm9yIDQwNFxyXG4kdGl0bGUtZXJyb3I6IDkuNWVtOyAgICAgIC8vIDE1MHB4XHJcbiRzdWJ0aXRsZS1lcnJvcjogMy4xZW07ICAgLy8gNTBweFxyXG4kdGV4dC1lcnJvcjogMS4yZW07XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gRXN0YW5kYXJcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbiR0aXRsZS10ZXh0LWgxOiAyZW07XHJcbiR0aXRsZS10ZXh0LWgyOiAxLjVlbTtcclxuJHRpdGxlLXRleHQtaDM6IDEuMTdlbTtcclxuJHRpdGxlLXRleHQtaDQ6IDFlbTtcclxuJHRpdGxlLXRleHQtaDU6IDAuODNlbTtcclxuJHRpdGxlLXRleHQtaDY6IDAuNjdlbTtcclxuJHRleHQtcDogMWVtO1xyXG5cclxuJGljb24tc2l6ZTogMS4yZW07XHJcbiR0ZXh0LWJ1dHRvbi1zaXplOiAwLjc1ZW07XHJcblxyXG4vLyBUYWJsZXRcclxuJHRpdGxlLXRleHQtaDEtdGFibGV0OiAxLjhlbTtcclxuJHRpdGxlLXRleHQtaDItdGFibGV0OiAxLjM1ZW07XHJcbiR0aXRsZS10ZXh0LWgzLXRhYmxldDogMS4wNWVtO1xyXG4kdGl0bGUtdGV4dC1oNC10YWJsZXQ6IDAuOWVtO1xyXG4kdGl0bGUtdGV4dC1oNS10YWJsZXQ6IDAuNzVlbTtcclxuJHRpdGxlLXRleHQtaDYtdGFibGV0OiAwLjZlbTtcclxuJHRleHQtcC10YWJsZXQ6IDAuOWVtO1xyXG5cclxuLy8gTW92aWxcclxuJHRpdGxlLXRleHQtaDEtcGhvbmU6IDEuNmVtO1xyXG4kdGl0bGUtdGV4dC1oMi1waG9uZTogMS4yZW07XHJcbiR0aXRsZS10ZXh0LWgzLXBob25lOiAxZW07XHJcbiR0aXRsZS10ZXh0LWg0LXBob25lOiAwLjhlbTtcclxuJHRpdGxlLXRleHQtaDUtcGhvbmU6IDAuN2VtO1xyXG4kdGl0bGUtdGV4dC1oNi1waG9uZTogMC41ZW07XHJcbiR0ZXh0LXAtcGhvbmU6IDAuODVlbTtcclxuXHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gVGFtYcODwrFvcyBkZSBsZXRyYSBwYXJhIGZvcm11bGFyaW9zXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kZm9ybS1pbnB1dDogMC44ZW07XHJcbiRmb3JtLWxhYmVsOiAwLjc1ZW07XHJcbiRmb3JtLXJlcXVpZXJlZDogMC41NWVtO1xyXG5cclxuXHJcblxyXG4kZGlhbG9nLWhlYWRlci10aXRsZTogMC44ZW07XHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcbiIsIi8vIEltcG9ydHNcclxuQHVzZSAncm9vdF9jb2xvcnMnO1xyXG5cclxuLy8gVmFyaWFibGVzIGRlIGNvbG9yZXNcclxuJHByaW1hcnk6ICM0MDQ1NmM7XHJcbiRmb2N1cy1pbnB1dDogbGlnaHRlbigkcHJpbWFyeSwgMzAlKTtcclxuXHJcbiRiZzogI2YxZjBmNjtcclxuJGJnLWVsZW1lbnRzOiAjZWNmMGYzO1xyXG4kc2hhMTogI2Y5ZjlmOTtcclxuJHNoYTI6ICNkMWQ5ZTY7XHJcbiR3aGl0ZTogI2ZmZjtcclxuXHJcbiRibGFjazogIzAwMDAwMDtcclxuJGJsYWNrLXNoYTogIzE4MTgxYztcclxuXHJcbiRncmF5OiAjODA4MDgwO1xyXG4kZ3JheS10ZXh0OiAjNDk0OTQ5O1xyXG5cclxuJG9ybzogIzcxNmI0MTtcclxuJHNoYWRvdy1vcm86ICMxNzE4MWM7XHJcblxyXG5cclxuLy8gQ29sb3IgZGUgYm90b25lc1xyXG4kYnRuczogIzNjNjhlMztcclxuJGJ0bi1jb2xvci0xOiAkYnRucztcclxuJGJ0bi1jb2xvci0yOiBkYXJrZW4oJGJ0bnMsIDEwKTtcclxuJGJ0bi1jb2xvci0zOiBkYXJrZW4oJGJ0bnMsIDIwKTtcclxuJGJ0bi1jb2xvci00OiBkYXJrZW4oJGJ0bnMsIDMwKTtcclxuJGJ0bi1jb2xvci01OiBkYXJrZW4oJGJ0bnMsIDQwKTtcclxuJGJ0bi1jb2xvci02OiBkYXJrZW4oJGJ0bnMsIDUwKTtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWJ1c2NhcjogIzI5ODBiOTtcclxuJGJ0bi1jb2xvci1pbmdyZXNhcjogIzFhNzUwMDtcclxuJGJ0bi1jb2xvci1uYXZlZ2FjaW9uOiAjMDA5YzhjO1xyXG5cclxuXHJcbiRidG4tY29sb3ItZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1idXNjYXIsIDEwKTtcclxuJGJ0bi1jb2xvci1kZWxldGUtZmlsdHJvOiBkYXJrZW4oJGJ0bi1jb2xvci1maWx0cm8sIDEwKTtcclxuJGJ0bi1jb2xvci1jb3B5OiAjMDA2ZDc3O1xyXG4kYnRuLWNvbG9yLWV4Y2VsOiAjMGU3NTNjO1xyXG4kYnRuLWNvbG9yLWNzdjogI2ZmOTgwMDtcclxuJGJ0bi1jb2xvci1wcmludDogIzE3YTJiODtcclxuXHJcblxyXG4kYnRuLWNvbG9yLWVudmlhcjogIzI3YWU2MDtcclxuJGJ0bi1jb2xvci1udWV2bzogIzM0OThkYjtcclxuJGJ0bi1jb2xvci1lZGl0YXI6ICNmMzljMTI7XHJcbiRidG4tY29sb3ItYWN0dWFsaXphcjogIzJlY2M3MTtcclxuJGJ0bi1jb2xvci1lbGltaW5hcjogI2U3NGMzYztcclxuJGJ0bi1jb2xvci1jYW5jZWxhcjogIzk1YTVhNjtcclxuXHJcbiJdLCJzb3VyY2VSb290IjoiIn0= */"]
  });
}

/***/ }),

/***/ 7471:
/*!***********************************************************!*\
  !*** ./src/app/views/Module/views/home/home.component.ts ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   HomeComponent: () => (/* binding */ HomeComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 7580);
/* harmony import */ var src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! src/app/core/services/alerts.service */ 983);


class HomeComponent {
  constructor(alertService) {
    this.alertService = alertService;
  }
  ngOnInit() {}
  static #_ = this.ɵfac = function HomeComponent_Factory(t) {
    return new (t || HomeComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](src_app_core_services_alerts_service__WEBPACK_IMPORTED_MODULE_0__.AlertService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineComponent"]({
    type: HomeComponent,
    selectors: [["app-home"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵStandaloneFeature"]],
    decls: 0,
    vars: 0,
    template: function HomeComponent_Template(rf, ctx) {},
    styles: ["/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 1957:
/*!************************************************!*\
  !*** ./src/app/views/error/error.component.ts ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ErrorComponent: () => (/* binding */ ErrorComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 7580);

class ErrorComponent {
  static #_ = this.ɵfac = function ErrorComponent_Factory(t) {
    return new (t || ErrorComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: ErrorComponent,
    selectors: [["app-error"]],
    standalone: true,
    features: [_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵStandaloneFeature"]],
    decls: 13,
    vars: 0,
    consts: [[1, "global_contenedor"], [1, "title"], [1, "subtitle"], [1, "text"], ["href", "https://armandovelasquez.com", "target", "_blank", 1, "enlace_admin"], [1, "content_button"], ["href", "", 1, "button", "efects_button"]],
    template: function ErrorComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "section", 0)(1, "span", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](2, "404");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "span", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](4, "P\u00E1gina no encontrada");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "p", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](6, "Por favor verificar o comunicarse con el ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "a", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](8, "administrador");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](9, ".");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](10, "div", 5)(11, "a", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](12, "Ir a Inicio");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
      }
    },
    styles: ["[_ngcontent-%COMP%]:root {\n  --jet: hsl(0, 0%, 22%);\n  --onyx: hsl(240, 1%, 17%);\n  --black: hsl(0, 0%, 0%);\n  --black-90: hsla(0, 0%, 0%, 0.9);\n  --black-80: hsla(0, 0%, 0%, 0.8);\n  --black-70: hsla(0, 0%, 0%, 0.7);\n  --black-60: hsla(0, 0%, 0%, 0.6);\n  --black-50: hsla(0, 0%, 0%, 0.5);\n  --black-40: hsla(0, 0%, 0%, 0.4);\n  --black-30: hsla(0, 0%, 0%, 0.3);\n  --black-20: hsla(0, 0%, 0%, 0.2);\n  --black-10: hsla(0, 0%, 0%, 0.1);\n  --white: hsl(0, 0%, 100%);\n  --white-90: hsl(0, 0%, 100%, 0.9);\n  --white-80: hsl(0, 0%, 100%, 0.8);\n  --white-70: hsl(0, 0%, 100%, 0.7);\n  --white-60: hsl(0, 0%, 100%, 0.6);\n  --white-50: hsl(0, 0%, 100%, 0.5);\n  --white-40: hsl(0, 0%, 100%, 0.4);\n  --white-30: hsl(0, 0%, 100%, 0.3);\n  --white-20: hsl(0, 0%, 100%, 0.2);\n  --white-10: hsl(0, 0%, 100%, 0.1);\n  --shadow-1: -4px 8px 24px hsla(0, 0%, 0%, 0.25);\n  --shadow-2: 5px 5px 10px hsla(0, 0%, 0%, 0.25);\n  --shadow-3: 0 16px 40px hsla(0, 0%, 0%, 0.25);\n  --shadow-4: 0 25px 50px hsla(0, 0%, 0%, 0.15);\n  --shadow-5: 0 24px 80px hsla(0, 0%, 0%, 0.25);\n  --shadow-6: 0 16px 3px hsla(0, 0%, 0%, 0.4);\n  --red: hsl(0, 100%, 50%);\n  --yellow: hsl(60, 100%, 50%);\n  --green: hsl(120, 100%, 25%);\n  --blue: hsl(240, 100%, 50%);\n  --purple: hsl(300, 100%, 25%);\n}\n\n.button[_ngcontent-%COMP%] {\n  height: 20px;\n  padding: 5px;\n  letter-spacing: 1.15px;\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  width: 150px;\n  border-radius: 25px;\n}\n.button[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n\n.button1[_ngcontent-%COMP%] {\n  height: 20px;\n  padding: 5px;\n  letter-spacing: 1.15px;\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  width: 150px;\n  border-radius: 5px;\n}\n.button1[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n\n.button2[_ngcontent-%COMP%] {\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  min-width: 40px;\n  width: auto;\n  height: 20px;\n  border-radius: 5px;\n  font-size: 0.7em;\n}\n.button2[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n.button2[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n  font-size: 17px;\n}\n\n.button3[_ngcontent-%COMP%] {\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  display: grid;\n  width: 20px;\n  height: 30px;\n  justify-content: center;\n  align-items: center;\n  border-radius: 5px;\n  font-size: 1.2em;\n}\n.button3[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n\n.button4[_ngcontent-%COMP%] {\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  display: grid;\n  width: 20px;\n  height: 30px;\n  justify-content: center;\n  align-items: center;\n  border-radius: 100%;\n  font-size: 1.2em;\n}\n.button4[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n\n.button_forma[_ngcontent-%COMP%] {\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: #40456c;\n  border: none;\n  outline: none;\n  box-shadow: 2px 2px 5px #d1d9e6, -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n  position: relative;\n  width: 150px;\n  height: 30px;\n  background-color: transparent;\n  border-radius: 0px;\n  overflow: hidden;\n  clip-path: polygon(20% 0%, 80% 0%, 100% 100%, 0% 100%);\n  filter: drop-shadow(3px 3px 1.5px var(--black-10));\n}\n.button_forma[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n.button_forma[_ngcontent-%COMP%]:hover {\n  filter: drop-shadow(3px 3px 5px var(--black-10));\n}\n.button_forma[_ngcontent-%COMP%]:hover::after {\n  background-color: rgba(64, 69, 108, 0.9);\n}\n.button_forma[_ngcontent-%COMP%]::after {\n  content: \"\";\n  position: absolute;\n  pointer-events: none;\n  border-radius: 0px;\n  -webkit-backdrop-filter: blur(3px);\n          backdrop-filter: blur(3px);\n  border: 1px solid #40456c;\n  z-index: -1;\n}\n\n.button_container_register[_ngcontent-%COMP%], .button_container_login[_ngcontent-%COMP%] {\n  z-index: 100;\n  display: grid;\n}\n.button_container_register[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%], .button_container_login[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%] {\n  width: 180px;\n  height: 40px;\n  border-radius: 0px 5px 0px 0px;\n  font-weight: 700;\n  font-size: 0.75em;\n  color: var(--white);\n  background-color: transparent;\n  border: none;\n  outline: none;\n  cursor: pointer;\n}\n.button_container_register[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%]:hover::after, .button_container_login[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%]:hover::after {\n  background-color: rgba(64, 69, 108, 0.7);\n}\n@media ((max-width: 350px) and (min-width: 0px)) {\n  .button_container_register[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%], .button_container_login[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%] {\n    font-size: 0.55em;\n    height: 30px;\n    width: 150px;\n    transform: scale(0.9);\n  }\n}\n.button_container_register[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%]::after, .button_container_login[_ngcontent-%COMP%]   .button1[_ngcontent-%COMP%]::after {\n  content: \"\";\n  position: absolute;\n  cursor: pointer;\n  -webkit-backdrop-filter: blur(3px);\n          backdrop-filter: blur(3px);\n  background-color: rgba(64, 69, 108, 0.6);\n  border-radius: 0px 5px 0px 0px;\n  z-index: -1;\n}\n\n.efects_button[_ngcontent-%COMP%] {\n  cursor: pointer;\n}\n.efects_button[_ngcontent-%COMP%]:hover {\n  transform: scale(0.98);\n  transition: 0.25s;\n}\n.efects_button[_ngcontent-%COMP%]:active, .efects_button[_ngcontent-%COMP%]:focus {\n  transform: scale(0.97);\n  transition: 0.25s;\n}\n\n.btn_primary[_ngcontent-%COMP%] {\n  background-color: #40456c;\n  border: 1px solid transparent;\n}\n.btn_primary[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n\n.btn_1[_ngcontent-%COMP%] {\n  background-color: #3c68e3;\n  border: 1px solid transparent;\n}\n.btn_1[_ngcontent-%COMP%]:hover {\n  background-color: #1e4cce;\n}\n\n.btn_2[_ngcontent-%COMP%] {\n  background-color: #1e4cce;\n  border: 1px solid transparent;\n}\n.btn_2[_ngcontent-%COMP%]:hover {\n  background-color: #173ca2;\n}\n\n.btn_3[_ngcontent-%COMP%] {\n  background-color: #173ca2;\n  border: 1px solid transparent;\n}\n.btn_3[_ngcontent-%COMP%]:hover {\n  background-color: #112b75;\n}\n\n.btn_4[_ngcontent-%COMP%] {\n  background-color: #112b75;\n  border: 1px solid transparent;\n}\n.btn_4[_ngcontent-%COMP%]:hover {\n  background-color: #0a1b49;\n}\n\n.btn_5[_ngcontent-%COMP%] {\n  background-color: #0a1b49;\n  border: 1px solid transparent;\n}\n.btn_5[_ngcontent-%COMP%]:hover {\n  background-color: #040a1c;\n}\n\n.btn_6[_ngcontent-%COMP%] {\n  background-color: #040a1c;\n  border: 1px solid transparent;\n}\n.btn_6[_ngcontent-%COMP%]:hover {\n  background-color: black;\n}\n\n.btn_enviar[_ngcontent-%COMP%] {\n  background-color: #27ae60;\n  border: 1px solid transparent;\n}\n.btn_enviar[_ngcontent-%COMP%]:hover {\n  background-color: #1e8449;\n}\n\n.btn_nuevo[_ngcontent-%COMP%] {\n  background-color: #3498db;\n  border: 1px solid transparent;\n}\n.btn_nuevo[_ngcontent-%COMP%]:hover {\n  background-color: #217dbb;\n}\n\n.btn_editar[_ngcontent-%COMP%] {\n  background-color: #f39c12;\n  border: 1px solid transparent;\n}\n.btn_editar[_ngcontent-%COMP%]:hover {\n  background-color: #c87f0a;\n}\n\n.btn_actualizar[_ngcontent-%COMP%] {\n  background-color: #2ecc71;\n  border: 1px solid transparent;\n}\n.btn_actualizar[_ngcontent-%COMP%]:hover {\n  background-color: #25a25a;\n}\n\n.btn_eliminar[_ngcontent-%COMP%] {\n  background-color: #e74c3c;\n  border: 1px solid transparent;\n}\n.btn_eliminar[_ngcontent-%COMP%]:hover {\n  background-color: #d62c1a;\n}\n\n.btn_cancelar[_ngcontent-%COMP%] {\n  background-color: #95a5a6;\n  border: 1px solid transparent;\n}\n.btn_cancelar[_ngcontent-%COMP%]:hover {\n  background-color: #798d8f;\n}\n\n.btn_filtro[_ngcontent-%COMP%] {\n  background-color: #20638f;\n  border: 1px solid transparent;\n}\n.btn_filtro[_ngcontent-%COMP%]:hover {\n  background-color: #164666;\n}\n\n.btn_delete_filter[_ngcontent-%COMP%] {\n  background-color: #164666;\n  border: 1px solid transparent;\n}\n.btn_delete_filter[_ngcontent-%COMP%]:hover {\n  background-color: #0d293c;\n}\n\n.btn_copy[_ngcontent-%COMP%] {\n  background-color: #006d77;\n  border: 1px solid transparent;\n}\n.btn_copy[_ngcontent-%COMP%]:hover {\n  background-color: #003e44;\n}\n\n.btn_excel[_ngcontent-%COMP%] {\n  background-color: #0e753c;\n  border: 1px solid transparent;\n}\n.btn_excel[_ngcontent-%COMP%]:hover {\n  background-color: #094725;\n}\n\n.btn_svg[_ngcontent-%COMP%] {\n  background-color: #ff9800;\n  border: 1px solid transparent;\n}\n.btn_svg[_ngcontent-%COMP%]:hover {\n  background-color: #cc7a00;\n}\n\n.btn_print[_ngcontent-%COMP%] {\n  background-color: #17a2b8;\n  border: 1px solid transparent;\n}\n.btn_print[_ngcontent-%COMP%]:hover {\n  background-color: #117a8b;\n}\n\n.btn_primary_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #40456c;\n  background-color: transparent;\n}\n.btn_primary_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(64, 69, 108, 0.1);\n}\n\n.btn_1_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #27ae60;\n  background-color: transparent;\n}\n.btn_1_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(39, 174, 96, 0.1);\n}\n\n.btn_2_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #3498db;\n  background-color: transparent;\n}\n.btn_2_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(52, 152, 219, 0.1);\n}\n\n.btn_3_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #f39c12;\n  background-color: transparent;\n}\n.btn_3_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(243, 156, 18, 0.1);\n}\n\n.btn_4_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #2ecc71;\n  background-color: transparent;\n}\n.btn_4_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(46, 204, 113, 0.1);\n}\n\n.btn_5_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #e74c3c;\n  background-color: transparent;\n}\n.btn_5_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(231, 76, 60, 0.1);\n}\n\n.btn_6_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #95a5a6;\n  background-color: transparent;\n}\n.btn_6_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(149, 165, 166, 0.1);\n}\n\n.btn_enviar_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #27ae60;\n  background-color: transparent;\n}\n.btn_enviar_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(39, 174, 96, 0.1);\n}\n\n.btn_nuevo_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #3498db;\n  background-color: transparent;\n}\n.btn_nuevo_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(52, 152, 219, 0.1);\n}\n\n.btn_editar_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #f39c12;\n  background-color: transparent;\n}\n.btn_editar_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(243, 156, 18, 0.1);\n}\n\n.btn_actualizar_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #2ecc71;\n  background-color: transparent;\n}\n.btn_actualizar_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(46, 204, 113, 0.1);\n}\n\n.btn_eliminar_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #e74c3c;\n  background-color: transparent;\n}\n.btn_eliminar_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(231, 76, 60, 0.1);\n}\n\n.btn_cancelar_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #95a5a6;\n  background-color: transparent;\n}\n.btn_cancelar_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(149, 165, 166, 0.1);\n}\n\n.btn_filtro_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #20638f;\n  background-color: transparent;\n}\n.btn_filtro_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(32, 99, 143, 0.1);\n}\n\n.btn_delete_filter_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #164666;\n  background-color: transparent;\n}\n.btn_delete_filter_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(22, 70, 102, 0.1);\n}\n\n.btn_copy_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #006d77;\n  background-color: transparent;\n}\n.btn_copy_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(0, 109, 119, 0.1);\n}\n\n.btn_excel_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #0e753c;\n  background-color: transparent;\n}\n.btn_excel_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(14, 117, 60, 0.1);\n}\n\n.btn_svg_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #ff9800;\n  background-color: transparent;\n}\n.btn_svg_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(255, 152, 0, 0.1);\n}\n\n.btn_print_2[_ngcontent-%COMP%] {\n  border: 1px solid transparent;\n  box-shadow: none;\n  cursor: pointer;\n  color: #17a2b8;\n  background-color: transparent;\n}\n.btn_print_2[_ngcontent-%COMP%]:hover {\n  border: 1px solid transparent;\n  background-color: rgba(23, 162, 184, 0.1);\n}\n\n.btn_primary_3[_ngcontent-%COMP%] {\n  border: 1px solid #40456c;\n  color: #40456c;\n  background-color: transparent;\n}\n.btn_primary_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #1a1c2c;\n  color: #fff;\n  background-color: #40456c;\n}\n\n.btn_1_3[_ngcontent-%COMP%] {\n  border: 1px solid #27ae60;\n  color: #27ae60;\n  background-color: transparent;\n}\n.btn_1_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #145b32;\n  color: #fff;\n  background-color: #27ae60;\n}\n\n.btn_2_3[_ngcontent-%COMP%] {\n  border: 1px solid #3498db;\n  color: #3498db;\n  background-color: transparent;\n}\n.btn_2_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #196090;\n  color: #fff;\n  background-color: #3498db;\n}\n\n.btn_3_3[_ngcontent-%COMP%] {\n  border: 1px solid #f39c12;\n  color: #f39c12;\n  background-color: transparent;\n}\n.btn_3_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #976008;\n  color: #fff;\n  background-color: #f39c12;\n}\n\n.btn_4_3[_ngcontent-%COMP%] {\n  border: 1px solid #2ecc71;\n  color: #2ecc71;\n  background-color: transparent;\n}\n.btn_4_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #1b7943;\n  color: #fff;\n  background-color: #2ecc71;\n}\n\n.btn_5_3[_ngcontent-%COMP%] {\n  border: 1px solid #e74c3c;\n  color: #e74c3c;\n  background-color: transparent;\n}\n.btn_5_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #a82315;\n  color: #fff;\n  background-color: #e74c3c;\n}\n\n.btn_6_3[_ngcontent-%COMP%] {\n  border: 1px solid #95a5a6;\n  color: #95a5a6;\n  background-color: transparent;\n}\n.btn_6_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #617374;\n  color: #fff;\n  background-color: #95a5a6;\n}\n\n.btn_enviar_3[_ngcontent-%COMP%] {\n  border: 1px solid #27ae60;\n  color: #27ae60;\n  background-color: transparent;\n}\n.btn_enviar_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #145b32;\n  color: #fff;\n  background-color: #27ae60;\n}\n\n.btn_nuevo_3[_ngcontent-%COMP%] {\n  border: 1px solid #3498db;\n  color: #3498db;\n  background-color: transparent;\n}\n.btn_nuevo_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #196090;\n  color: #fff;\n  background-color: #3498db;\n}\n\n.btn_editar_3[_ngcontent-%COMP%] {\n  border: 1px solid #f39c12;\n  color: #f39c12;\n  background-color: transparent;\n}\n.btn_editar_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #976008;\n  color: #fff;\n  background-color: #f39c12;\n}\n\n.btn_actualizar_3[_ngcontent-%COMP%] {\n  border: 1px solid #2ecc71;\n  color: #2ecc71;\n  background-color: transparent;\n}\n.btn_actualizar_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #1b7943;\n  color: #fff;\n  background-color: #2ecc71;\n}\n\n.btn_eliminar_3[_ngcontent-%COMP%] {\n  border: 1px solid #e74c3c;\n  color: #e74c3c;\n  background-color: transparent;\n}\n.btn_eliminar_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #a82315;\n  color: #fff;\n  background-color: #e74c3c;\n}\n\n.btn_cancelar_3[_ngcontent-%COMP%] {\n  border: 1px solid #95a5a6;\n  color: #95a5a6;\n  background-color: transparent;\n}\n.btn_cancelar_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #617374;\n  color: #fff;\n  background-color: #95a5a6;\n}\n\n.btn_filtro_3[_ngcontent-%COMP%] {\n  border: 1px solid #20638f;\n  color: #20638f;\n  background-color: transparent;\n}\n.btn_filtro_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #0d293c;\n  color: #fff;\n  background-color: #20638f;\n}\n\n.btn_delete_filter_3[_ngcontent-%COMP%] {\n  border: 1px solid #164666;\n  color: #164666;\n  background-color: transparent;\n}\n.btn_delete_filter_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #040c12;\n  color: #fff;\n  background-color: #164666;\n}\n\n.btn_copy_3[_ngcontent-%COMP%] {\n  border: 1px solid #006d77;\n  color: #006d77;\n  background-color: transparent;\n}\n.btn_copy_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #001011;\n  color: #fff;\n  background-color: #006d77;\n}\n\n.btn_excel_3[_ngcontent-%COMP%] {\n  border: 1px solid #0e753c;\n  color: #0e753c;\n  background-color: transparent;\n}\n.btn_excel_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #031a0d;\n  color: #fff;\n  background-color: #0e753c;\n}\n\n.btn_svg_3[_ngcontent-%COMP%] {\n  border: 1px solid #ff9800;\n  color: #ff9800;\n  background-color: transparent;\n}\n.btn_svg_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #995b00;\n  color: #fff;\n  background-color: #ff9800;\n}\n\n.btn_print_3[_ngcontent-%COMP%] {\n  border: 1px solid #17a2b8;\n  color: #17a2b8;\n  background-color: transparent;\n}\n.btn_print_3[_ngcontent-%COMP%]:hover {\n  border: 1px solid #0c525d;\n  color: #fff;\n  background-color: #17a2b8;\n}\n\n.btn_primary_4[_ngcontent-%COMP%] {\n  color: #40456c;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_primary_4[_ngcontent-%COMP%]:hover {\n  color: #2d314c;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_1_4[_ngcontent-%COMP%] {\n  color: #27ae60;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_1_4[_ngcontent-%COMP%]:hover {\n  color: #1e8449;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_2_4[_ngcontent-%COMP%] {\n  color: #3498db;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_2_4[_ngcontent-%COMP%]:hover {\n  color: #217dbb;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_3_4[_ngcontent-%COMP%] {\n  color: #f39c12;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_3_4[_ngcontent-%COMP%]:hover {\n  color: #c87f0a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_4_4[_ngcontent-%COMP%] {\n  color: #2ecc71;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_4_4[_ngcontent-%COMP%]:hover {\n  color: #25a25a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_5_4[_ngcontent-%COMP%] {\n  color: #e74c3c;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_5_4[_ngcontent-%COMP%]:hover {\n  color: #d62c1a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_6_4[_ngcontent-%COMP%] {\n  color: #95a5a6;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_6_4[_ngcontent-%COMP%]:hover {\n  color: #798d8f;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_enviar_4[_ngcontent-%COMP%] {\n  color: #27ae60;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_enviar_4[_ngcontent-%COMP%]:hover {\n  color: #1e8449;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_nuevo_4[_ngcontent-%COMP%] {\n  color: #3498db;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_nuevo_4[_ngcontent-%COMP%]:hover {\n  color: #217dbb;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_editar_4[_ngcontent-%COMP%] {\n  color: #f39c12;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_editar_4[_ngcontent-%COMP%]:hover {\n  color: #c87f0a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_actualizar_4[_ngcontent-%COMP%] {\n  color: #2ecc71;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_actualizar_4[_ngcontent-%COMP%]:hover {\n  color: #25a25a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_eliminar_4[_ngcontent-%COMP%] {\n  color: #e74c3c;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_eliminar_4[_ngcontent-%COMP%]:hover {\n  color: #d62c1a;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_cancelar_4[_ngcontent-%COMP%] {\n  color: #95a5a6;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_cancelar_4[_ngcontent-%COMP%]:hover {\n  color: #798d8f;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_filtro_4[_ngcontent-%COMP%] {\n  color: #20638f;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_filtro_4[_ngcontent-%COMP%]:hover {\n  color: #164666;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_delete_filter_4[_ngcontent-%COMP%] {\n  color: #164666;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_delete_filter_4[_ngcontent-%COMP%]:hover {\n  color: #0d293c;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_copy_4[_ngcontent-%COMP%] {\n  color: #006d77;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_copy_4[_ngcontent-%COMP%]:hover {\n  color: #003e44;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_excel_4[_ngcontent-%COMP%] {\n  color: #0e753c;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_excel_4[_ngcontent-%COMP%]:hover {\n  color: #094725;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_svg_4[_ngcontent-%COMP%] {\n  color: #ff9800;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_svg_4[_ngcontent-%COMP%]:hover {\n  color: #cc7a00;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_print_4[_ngcontent-%COMP%] {\n  color: #17a2b8;\n  background-color: transparent;\n  border: 1px solid transparent;\n  transition: all 0.3s ease-in;\n}\n.btn_print_4[_ngcontent-%COMP%]:hover {\n  color: #117a8b;\n  background-color: transparent;\n  box-shadow: inset 2px 2px 5px #d1d9e6, inset -2px -2px 5px #f9f9f9;\n  transition: all 0.3s ease-in;\n}\n\n.btn_navegacion[_ngcontent-%COMP%] {\n  background-color: #009c8c;\n  box-shadow: inset 0.2rem 0.2rem 0.5rem #00695e, inset -0.2rem -0.2rem 0.5rem rgba(255, 255, 255, 0.5);\n}\n\n.btn_navegacion[_ngcontent-%COMP%]:hover {\n  background-color: #008375;\n  box-shadow: inset 0.2rem 0.2rem 0.5rem #005047, inset -0.2rem -0.2rem 0.5rem rgba(255, 255, 255, 0.5);\n}\n\n.btn_navegacion[_ngcontent-%COMP%]:disabled {\n  cursor: default;\n  background-color: #005047;\n  transform: none;\n  box-shadow: none;\n  opacity: 0.6;\n  box-shadow: inset 0.2rem 0.2rem 0.5rem #005047, inset -0.2rem -0.2rem 0.5rem rgba(255, 255, 255, 0.5);\n}\n\n\n\n\n\n.icon_move_element[_ngcontent-%COMP%] {\n  color: rgba(64, 69, 108, 0.2);\n}\n\n#btn_top[_ngcontent-%COMP%] {\n  position: fixed;\n  bottom: 20px;\n  right: 20px;\n  width: 40px;\n  height: 50px;\n  z-index: 9999;\n  justify-content: center;\n  align-items: center;\n  text-align: center;\n  border: none;\n  outline: none;\n  background-color: #40456c;\n  color: var(--white);\n  cursor: pointer;\n  border-radius: 10px;\n  font-size: 1.4em;\n  transition: opacity 0.5s ease;\n  opacity: 0;\n}\n#btn_top.visible[_ngcontent-%COMP%] {\n  opacity: 1;\n}\n#btn_top[_ngcontent-%COMP%]:hover {\n  background-color: #2d314c;\n}\n@media ((max-width: 335px) and (min-width: 0px)) {\n  #btn_top[_ngcontent-%COMP%] {\n    bottom: 5px;\n    right: 5px;\n    width: 35px;\n    height: 35px;\n    font-size: 15px;\n  }\n}\n\n.title[_ngcontent-%COMP%], .subtitle[_ngcontent-%COMP%], .text[_ngcontent-%COMP%] {\n  margin: 0;\n  text-align: center;\n}\n\n.title[_ngcontent-%COMP%] {\n  font-size: 9.5em;\n  font-weight: bold;\n}\n@media (max-width: 580px) {\n  .title[_ngcontent-%COMP%] {\n    font-size: 8em;\n  }\n}\n@media (max-width: 450px) {\n  .title[_ngcontent-%COMP%] {\n    font-size: 7.5em;\n  }\n}\n@media ((max-width: 335px) and (min-width: 0px)) {\n  .title[_ngcontent-%COMP%] {\n    font-size: 100px;\n    font-size: 6.5em;\n  }\n}\n\n.subtitle[_ngcontent-%COMP%] {\n  font-size: 3.1em;\n  font-weight: bold;\n  padding-bottom: 20px;\n  color: #494949;\n}\n@media (max-width: 580px) {\n  .subtitle[_ngcontent-%COMP%] {\n    font-size: 2.3em;\n  }\n}\n@media (max-width: 450px) {\n  .subtitle[_ngcontent-%COMP%] {\n    font-size: 1.9em;\n  }\n}\n@media ((max-width: 335px) and (min-width: 0px)) {\n  .subtitle[_ngcontent-%COMP%] {\n    font-size: 1.3em;\n  }\n}\n\n.text[_ngcontent-%COMP%] {\n  font-size: 1.2em;\n  padding-bottom: 40px;\n}\n@media (max-width: 450px) {\n  .text[_ngcontent-%COMP%] {\n    font-size: -0.3em;\n  }\n}\n@media ((max-width: 335px) and (min-width: 0px)) {\n  .text[_ngcontent-%COMP%] {\n    font-size: 0.7em;\n  }\n}\n\n.switch[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: center;\n  align-items: center;\n}\n\n.enlace_admin[_ngcontent-%COMP%] {\n  color: #40456c;\n  text-decoration: none;\n}\n\n.content_button[_ngcontent-%COMP%] {\n  display: grid;\n  justify-content: center;\n}\n.content_button[_ngcontent-%COMP%]   .button[_ngcontent-%COMP%] {\n  display: flex;\n  width: 180px;\n  height: 50px;\n  letter-spacing: 1.15px;\n  justify-content: center;\n  align-items: center;\n  text-decoration: none;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19yb290X2NvbG9ycy5zY3NzIiwid2VicGFjazovLy4vc3JjL2FwcC92aWV3cy9lcnJvci9lcnJvci5jb21wb25lbnQuc2NzcyIsIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy9jb21wb25lbnRzL19idXR0b25zLnNjc3MiLCJ3ZWJwYWNrOi8vLi9zcmMvYXNzZXRzL3Njc3MvdmFycy9fZm9udHMuc2NzcyIsIndlYnBhY2s6Ly8uL3NyYy9hc3NldHMvc2Nzcy92YXJzL19jb2xvcnMuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDQTtFQUdFLHNCQUFBO0VBQ0EseUJBQUE7RUFFQSx1QkFBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxnQ0FBQTtFQUVBLHlCQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsaUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGlDQUFBO0VBR0EsK0NBQUE7RUFDQSw4Q0FBQTtFQUNBLDZDQUFBO0VBQ0EsNkNBQUE7RUFDQSw2Q0FBQTtFQUNBLDJDQUFBO0VBR0Esd0JBQUE7RUFDQSw0QkFBQTtFQUNBLDRCQUFBO0VBQ0EsMkJBQUE7RUFDQSw2QkFBQTtBQ1JGOztBQ0ZBO0VBMUJFLFlBQUE7RUFDQSxZQUFBO0VBQ0Esc0JBQUE7RUFJQSxnQkFBQTtFQUNBLGlCQ3VCaUI7RUR0QmpCLG1CQUFBO0VBQ0EseUJFWFE7RUZZUixZQUFBO0VBQ0EsYUFBQTtFQUNBLHNEQUNFO0VBRUYsNEJBQUE7RUFjQSxZQUFBO0VBQ0EsbUJBQUE7QURjRjtBQzNCRTtFQUNFLHlCQUFBO0FENkJKOztBQ1ZBO0VBckNFLFlBQUE7RUFDQSxZQUFBO0VBQ0Esc0JBQUE7RUFJQSxn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S1osNkJBQUE7QURpRUY7QUMvREU7RUFDRSx5QkFBQTtBRGlFSjs7QUN6Q0E7RUE1QkUseUJFektZO0VGMEtaLDZCQUFBO0FEeUVGO0FDdkVFO0VBQ0UseUJBQUE7QUR5RUo7O0FDN0NBO0VBaENFLHlCRXhLWTtFRnlLWiw2QkFBQTtBRGlGRjtBQy9FRTtFQUNFLHVCQUFBO0FEaUZKOztBQ2hEQTtFQXJDRSx5QkV4SmlCO0VGeUpqQiw2QkFBQTtBRHlGRjtBQ3ZGRTtFQUNFLHlCQUFBO0FEeUZKOztBQ3BEQTtFQXpDRSx5QkV2SmdCO0VGd0poQiw2QkFBQTtBRGlHRjtBQy9GRTtFQUNFLHlCQUFBO0FEaUdKOztBQ3hEQTtFQTdDRSx5QkV0SmlCO0VGdUpqQiw2QkFBQTtBRHlHRjtBQ3ZHRTtFQUNFLHlCQUFBO0FEeUdKOztBQzVEQTtFQWpERSx5QkVySnFCO0VGc0pyQiw2QkFBQTtBRGlIRjtBQy9HRTtFQUNFLHlCQUFBO0FEaUhKOztBQ2hFQTtFQXJERSx5QkVwSm1CO0VGcUpuQiw2QkFBQTtBRHlIRjtBQ3ZIRTtFQUNFLHlCQUFBO0FEeUhKOztBQ3BFQTtFQXpERSx5QkVuSm1CO0VGb0puQiw2QkFBQTtBRGlJRjtBQy9IRTtFQUNFLHlCQUFBO0FEaUlKOztBQ3hFQTtFQTdERSx5QkVoS2lCO0VGaUtqQiw2QkFBQTtBRHlJRjtBQ3ZJRTtFQUNFLHlCQUFBO0FEeUlKOztBQzVFQTtFQWpFRSx5QkUvSndCO0VGZ0t4Qiw2QkFBQTtBRGlKRjtBQy9JRTtFQUNFLHlCQUFBO0FEaUpKOztBQ2hGQTtFQXJFRSx5QkU5SmU7RUYrSmYsNkJBQUE7QUR5SkY7QUN2SkU7RUFDRSx5QkFBQTtBRHlKSjs7QUNwRkE7RUF6RUUseUJFN0pnQjtFRjhKaEIsNkJBQUE7QURpS0Y7QUMvSkU7RUFDRSx5QkFBQTtBRGlLSjs7QUN4RkE7RUE3RUUseUJFNUpjO0VGNkpkLDZCQUFBO0FEeUtGO0FDdktFO0VBQ0UseUJBQUE7QUR5S0o7O0FDNUZBO0VBakZFLHlCRTNKZ0I7RUY0SmhCLDZCQUFBO0FEaUxGO0FDL0tFO0VBQ0Us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QWpGRSw2QkFBQTtFQUNBLGdCQUFBO0VBQ0EsZUFBQTtFQUNBLGNFeFBjO0VGeVBkLDZCQUFBO0FENFNGO0FDMVNFO0VBQ0UsNkJBQUE7RUFDQSx3Q0FBQTtBRDRTSjs7QUMvTkE7RUFyRkUsNkJBQUE7RUFDQSxnQkFBQTtFQUNBLGVBQUE7RUFDQSxjRXZQZ0I7RUZ3UGhCLDZCQUFBO0FEd1RGO0FDdFRFO0VBQ0UsNkJBQUE7RUFDQSx5Q0FBQTtBRHdUSjs7QUN2TkE7RUFYRSx5QkFBQTtFQUNBLGNFMVhRO0VGMlhSLDZCQUFBO0FEc09GO0FDcE9FO0VBQ0UseUJBQUE7RUFDQSxXRXhYSTtFRnlYSix5QkVoWU07QUhzbUJWOztBQzlOQTtFQWZFLHlCQUFBO0VBQ0EsY0VoVmlCO0VGaVZqQiw2QkFBQTtBRGlQRjtBQy9PRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFdFZlO0FIdWtCbkI7O0FDck9BO0VBbkJFLHlCQUFBO0VBQ0EsY0UvVWdCO0VGZ1ZoQiw2QkFBQTtBRDRQRjtBQzFQRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFclZjO0FIaWxCbEI7O0FDNU9BO0VBdkJFLHlCQUFBO0VBQ0EsY0U5VWlCO0VGK1VqQiw2QkFBQTtBRHVRRjtBQ3JRRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFcFZlO0FIMmxCbkI7O0FDblBBO0VBM0JFLHlCQUFBO0VBQ0EsY0U3VXFCO0VGOFVyQiw2QkFBQTtBRGtSRjtBQ2hSRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFblZtQjtBSHFtQnZCOztBQzFQQTtFQS9CRSx5QkFBQTtFQUNBLGNFNVVtQjtFRjZVbkIsNkJBQUE7QUQ2UkY7QUMzUkU7RUFDRSx5QkFBQTtFQUNBLFdFeFhJO0VGeVhKLHlCRWxWaUI7QUgrbUJyQjs7QUNqUUE7RUFuQ0UseUJBQUE7RUFDQSxjRTNVbUI7RUY0VW5CLDZCQUFBO0FEd1NGO0FDdFNFO0VBQ0UseUJBQUE7RUFDQSxXRXhYSTtFRnlYSix5QkVqVmlCO0FIeW5CckI7O0FDdlFBO0VBeENFLHlCQUFBO0VBQ0EsY0VoVmlCO0VGaVZqQiw2QkFBQTtBRG1URjtBQ2pURTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFdFZlO0FIeW9CbkI7O0FDOVFBO0VBNUNFLHlCQUFBO0VBQ0EsY0UvVWdCO0VGZ1ZoQiw2QkFBQTtBRDhURjtBQzVURTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFclZjO0FIbXBCbEI7O0FDclJBO0VBaERFLHlCQUFBO0VBQ0EsY0U5VWlCO0VGK1VqQiw2QkFBQTtBRHlVRjtBQ3ZVRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFcFZlO0FINnBCbkI7O0FDNVJBO0VBcERFLHlCQUFBO0VBQ0EsY0U3VXFCO0VGOFVyQiw2QkFBQTtBRG9WRjtBQ2xWRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFblZtQjtBSHVxQnZCOztBQ25TQTtFQXhERSx5QkFBQTtFQUNBLGNFNVVtQjtFRjZVbkIsNkJBQUE7QUQrVkY7QUM3VkU7RUFDRSx5QkFBQTtFQUNBLFdFeFhJO0VGeVhKLHlCRWxWaUI7QUhpckJyQjs7QUMxU0E7RUE1REUseUJBQUE7RUFDQSxjRTNVbUI7RUY0VW5CLDZCQUFBO0FEMFdGO0FDeFdFO0VBQ0UseUJBQUE7RUFDQSxXRXhYSTtFRnlYSix5QkVqVmlCO0FIMnJCckI7O0FDalRBO0VBaEVFLHlCQUFBO0VBQ0EsY0V4VmlCO0VGeVZqQiw2QkFBQTtBRHFYRjtBQ25YRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFOVZlO0FIbXRCbkI7O0FDeFRBO0VBcEVFLHlCQUFBO0VBQ0EsY0V2VndCO0VGd1Z4Qiw2QkFBQTtBRGdZRjtBQzlYRTtFQUNFLHlCQUFBO0VBQ0EsV0V4WEk7RUZ5WEoseUJFN1ZzQjtBSDZ0QjFCOztBQy9UQTtFQXhFRSx5QkFBQTtFQUNBLGNFdFZlO0VGdVZmLDZCQUFBO0FEMllGO0FDellFO0VBQ0UseUJBQUE7RUFDQSxXRXhYSTtFRnlYSix5QkU1VmE7QUh1dUJqQjs7QUN0VUE7RUE1RUUseUJB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LGFBQUE7RUFDQSxZQUFBO0VBQ0EsWUFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7RUFDQSxtQkFBQTtFQUNBLHFCQUFBO0FBMm1DSiIsInNvdXJjZXNDb250ZW50IjpbIi8vIENvbG9yZXMgcm9vdFxyXG46cm9vdCB7XHJcblxyXG4gIC8vIHNvbGlkXHJcbiAgLS1qZXQ6IGhzbCgwLCAwJSwgMjIlKTtcclxuICAtLW9ueXg6IGhzbCgyNDAsIDElLCAxNyUpO1xyXG5cclxuICAtLWJsYWNrOiBoc2woMCwgMCUsIDAlKTtcclxuICAtLWJsYWNrLTkwOiBoc2xhKDAsIDAlLCAwJSwgMC45KTtcclxuICAtLWJsYWNrLTgwOiBoc2xhKDAsIDAlLCAwJSwgMC44KTtcclxuICAtLWJsYWNrLTcwOiBoc2xhKDAsIDAlLCAwJSwgMC43KTtcclxuICAtLWJsYWNrLTYwOiBoc2xhKDAsIDAlLCAwJSwgMC42KTtcclxuICAtLWJsYWNrLTUwOiBoc2xhKDAsIDAlLCAwJSwgMC41KTtcclxuICAtLWJsYWNrLTQwOiBoc2xhKDAsIDAlLCAwJSwgMC40KTtcclxuICAtLWJsYWNrLTMwOiBoc2xhKDAsIDAlLCAwJSwgMC4zKTtcclxuICAtLWJsYWNrLTIwOiBoc2xhKDAsIDAlLCAwJSwgMC4yKTtcclxuICAtLWJsYWNrLTEwOiBoc2xhKDAsIDAlLCAwJSwgMC4xKTtcclxuXHJcbiAgLS13aGl0ZTogaHNsKDAsIDAlLCAxMDAlKTtcclxuICAtLXdoaXRlLTkwOiBoc2woMCwgMCUsIDEwMCUsIDAuOSk7XHJcbiAgLS13aGl0ZS04MDogaHNsKDAsIDAlLCAxMDAlLCAwLjgpO1xyXG4gIC0td2hpdGUtNzA6IGhzbCgwLCAwJSwgMTAwJSwgMC43KTtcclxuICAtLXdoaXRlLTYwOiBoc2woMCwgMCUsIDEwMCUsIDAuNik7XHJcbiAgLS13aGl0ZS01MDogaHNsKDAsIDAlLCAxMDAlLCAwLjUpO1xyXG4gIC0td2hpdGUtNDA6IGhzbCgwLCAwJSwgMTAwJSwgMC40KTtcclxuICAtLXdoaXRlLTMwOiBoc2woMCwgMCUsIDEwMCUsIDAuMyk7XHJcbiAgLS13aGl0ZS0yMDogaHNsKDAsIDAlLCAxMDAlLCAwLjIpO1xyXG4gIC0td2hpdGUtMTA6IGhzbCgwLCAwJSwgMTAwJSwgMC4xKTtcclxuXHJcbiAgLy8gc2hhZG93XHJcbiAgLS1zaGFkb3ctMTogLTRweCA4cHggMjRweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctMjogNXB4IDVweCAxMHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy0zOiAwIDE2cHggNDBweCBoc2xhKDAsIDAlLCAwJSwgMC4yNSk7XHJcbiAgLS1zaGFkb3ctNDogMCAyNXB4IDUwcHggaHNsYSgwLCAwJSwgMCUsIDAuMTUpO1xyXG4gIC0tc2hhZG93LTU6IDAgMjRweCA4MHB4IGhzbGEoMCwgMCUsIDAlLCAwLjI1KTtcclxuICAtLXNoYWRvdy02OiAwIDE2cHggM3B4IGhzbGEoMCwgMCUsIDAlLCAwLjQpO1xyXG5cclxuICAvLyBDb2xvcnNcclxuICAtLXJlZDogaHNsKDAsIDEwMCUsIDUwJSk7XHJcbiAgLS15ZWxsb3c6IGhzbCg2MCwgMTAwJSwgNTAlKTtcclxuICAtLWdyZWVuOiBoc2woMTIwLCAxMDAlLCAyNSUpO1xyXG4gIC0tYmx1ZTogaHNsKDI0MCwgMTAwJSwgNTAlKTtcclxuICAtLXB1cnBsZTogaHNsKDMwMCwgMTAwJSwgMjUlKTtcclxufVxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgJy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvY29sb3JzJyBhcyBjb2xvcnM7XHJcbkB1c2UgJy4uLy4uLy4uL2Fzc2V0cy9zY3NzL3ZhcnMvZm9udHMnIGFzIGZvbnRzO1xyXG5AdXNlICcuLi8uLi8uLi9hc3NldHMvc2Nzcy9jb21wb25lbnRzL2J1dHRvbnMnO1xyXG5cclxuLnRpdGxlLFxyXG4uc3VidGl0bGUsXHJcbi50ZXh0IHtcclxuICBtYXJnaW46IDA7XHJcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG59XHJcblxyXG4udGl0bGUge1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJHRpdGxlLWVycm9yO1xyXG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG5cclxuICBAbWVkaWEgKG1heC13aWR0aDogNTgwcHgpIHtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJHRpdGxlLWVycm9yIC0gMS41ZW07XHJcbiAgfVxyXG5cclxuICBAbWVkaWEgKG1heC13aWR0aDogNDUwcHgpIHtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJHRpdGxlLWVycm9yIC0gMmVtO1xyXG4gIH1cclxuXHJcbiAgQG1lZGlhICgobWF4LXdpZHRoOiAzMzVweCkgYW5kIChtaW4td2lkdGg6IDBweCkpIHtcclxuICAgIGZvbnQtc2l6ZTogMTAwcHg7XHJcbiAgICBmb250LXNpemU6IGZvbnRzLiR0aXRsZS1lcnJvciAtIDNlbTtcclxuICB9XHJcbn1cclxuXHJcbi5zdWJ0aXRsZSB7XHJcbiAgZm9udC1zaXplOiBmb250cy4kc3VidGl0bGUtZXJyb3I7XHJcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XHJcbiAgY29sb3I6IGNvbG9ycy4kZ3JheS10ZXh0O1xyXG5cclxuICBAbWVkaWEgKG1heC13aWR0aDogNTgwcHgpIHtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJHN1YnRpdGxlLWVycm9yIC0gLjhlbTtcclxuICB9XHJcblxyXG4gIEBtZWRpYSAobWF4LXdpZHRoOiA0NTBweCkge1xyXG4gICAgZm9udC1zaXplOiBmb250cy4kc3VidGl0bGUtZXJyb3IgLSAxLjJlbTtcclxuICB9XHJcblxyXG4gIEBtZWRpYSAoKG1heC13aWR0aDogMzM1cHgpIGFuZCAobWluLXdpZHRoOiAwcHgpKSB7XHJcbiAgICBmb250LXNpemU6IGZvbnRzLiRzdWJ0aXRsZS1lcnJvciAtIDEuOGVtO1xyXG4gIH1cclxufVxyXG5cclxuLnRleHQge1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtZXJyb3I7XHJcbiAgcGFkZGluZy1ib3R0b206IDQwcHg7XHJcblxyXG4gIEBtZWRpYSAobWF4LXdpZHRoOiA0NTBweCkge1xyXG4gICAgZm9udC1zaXplOiBmb250cy4kdGV4dC1lcnJvciAtIDEuNWVtO1xyXG4gIH1cclxuXHJcbiAgQG1lZGlhICgobWF4LXdpZHRoOiAzMzVweCkgYW5kIChtaW4td2lkdGg6IDBweCkpIHtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtZXJyb3IgLSAuNWVtO1xyXG4gIH1cclxufVxyXG5cclxuLnN3aXRjaCB7XHJcbiAgZGlzcGxheTogZ3JpZDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG59XHJcblxyXG4uZW5sYWNlX2FkbWluIHtcclxuICBjb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gIHRleHQtZGVjb3JhdGlvbjogbm9uZTtcclxufVxyXG5cclxuLmNvbnRlbnRfYnV0dG9uIHtcclxuICBkaXNwbGF5OiBncmlkO1xyXG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG5cclxuICAuYnV0dG9uIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB3aWR0aDogMTgwcHg7XHJcbiAgICBoZWlnaHQ6IDUwcHg7XHJcbiAgICBsZXR0ZXItc3BhY2luZzogMS4xNXB4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gIH1cclxufVxyXG4iLCIvLyBFc3RpbG9zIGdlbmVyYWxlc1xyXG5AdXNlIFwiLi4vdmFycy9jb2xvcnNcIiBhcyBjb2xvcnM7XHJcbkB1c2UgXCIuLi92YXJzL2ZvbnRzXCIgYXMgZm9udHM7XHJcblxyXG4vLyBHZW5lcmFsIGRlIGJvdG9uZXNcclxuQG1peGluIGJ1dHRvbnMtc3R5bGUge1xyXG4gIGhlaWdodDogMjBweDtcclxuICBwYWRkaW5nOiA1cHg7XHJcbiAgbGV0dGVyLXNwYWNpbmc6IDEuMTVweDtcclxufVxyXG5cclxuQG1peGluIGJ1dHRvbnMtc3R5bGUyIHtcclxuICBmb250LXdlaWdodDogNzAwO1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtYnV0dG9uLXNpemU7XHJcbiAgY29sb3I6IHZhcigtLXdoaXRlKTtcclxuICBiYWNrZ3JvdW5kLWNvbG9yOiBjb2xvcnMuJHByaW1hcnk7XHJcbiAgYm9yZGVyOiBub25lO1xyXG4gIG91dGxpbmU6IG5vbmU7XHJcbiAgYm94LXNoYWRvdzpcclxuICAgIDJweCAycHggNXB4IGNvbG9ycy4kc2hhMixcclxuICAgIC0ycHggLTJweCA1cHggY29sb3JzLiRzaGExO1xyXG4gIHRyYW5zaXRpb246IGFsbCAwLjNzIGVhc2UtaW47XHJcblxyXG4gICY6aG92ZXIge1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogZGFya2VuKGNvbG9ycy4kcHJpbWFyeSwgMTApO1xyXG4gIH1cclxufVxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gQm90b24gZ2VuZXJhbCAoc2VtaSBjaXJjdWxvKVxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5cclxuLmJ1dHRvbiB7XHJcbiAgQGluY2x1ZGUgYnV0dG9ucy1zdHlsZTtcclxuICBAaW5jbHVkZSBidXR0b25zLXN0eWxlMjtcclxuICB3aWR0aDogMTUwcHg7XHJcbiAgYm9yZGVyLXJhZGl1czogMjVweDtcclxufVxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gQm90b24gZ2VuZXJhbCAoc2VtaSBjdWFkcmFkbylcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbi5idXR0b24xIHtcclxuICBAaW5jbHVkZSBidXR0b25zLXN0eWxlO1xyXG4gIEBpbmNsdWRlIGJ1dHRvbnMtc3R5bGUyO1xyXG4gIHdpZHRoOiAxNTBweDtcclxuICBib3JkZXItcmFkaXVzOiA1cHg7XHJcbn1cclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIEJvdG9uIHBhcmEgaWNvbm8geSB0ZXh0byAocGVxdWXDg8KxbylcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLmJ1dHRvbjIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbnMtc3R5bGUyO1xyXG4gIG1pbi13aWR0aDogNDBweDtcclxuICB3aWR0aDogYXV0bztcclxuICBoZWlnaHQ6IDIwcHg7XHJcbiAgYm9yZGVyLXJhZGl1czogNXB4O1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJGljb24tc2l6ZSAtIDAuNWVtO1xyXG5cclxuICBpIHtcclxuICAgIGZvbnQtc2l6ZTogMTdweDtcclxuICB9XHJcbn1cclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIEJvdG9uIGljb24gY3VhZHJhZG9cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLmJ1dHRvbjMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbnMtc3R5bGUyO1xyXG4gIGRpc3BsYXk6IGdyaWQ7XHJcbiAgd2lkdGg6IDIwcHg7XHJcbiAgaGVpZ2h0OiAzMHB4O1xyXG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgYm9yZGVyLXJhZGl1czogNXB4O1xyXG4gIGZvbnQtc2l6ZTogZm9udHMuJGljb24tc2l6ZTtcclxufVxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gQm90b24gaWNvbiBjaXJjdWxvXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi5idXR0b240IHtcclxuICBAaW5jbHVkZSBidXR0b25zLXN0eWxlMjtcclxuICBkaXNwbGF5OiBncmlkO1xyXG4gIHdpZHRoOiAyMHB4O1xyXG4gIGhlaWdodDogMzBweDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIGJvcmRlci1yYWRpdXM6IDEwMCU7XHJcbiAgZm9udC1zaXplOiBmb250cy4kaWNvbi1zaXplO1xyXG59XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBCb3RvbiBwYXJhIGFzaWduYXIgcG9saWdvbm8gY2xpcC1wYXRoIChzZSBkZWJlIGFzaWduYXIgY2xhc2UgZGUgY29sb3IpXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi5idXR0b25fZm9ybWEge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbnMtc3R5bGUyO1xyXG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICB3aWR0aDogMTUwcHg7XHJcbiAgaGVpZ2h0OiAzMHB4O1xyXG4gIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICBvdmVyZmxvdzogaGlkZGVuO1xyXG5cclxuICBjbGlwLXBhdGg6IHBvbHlnb24oMjAlIDAlLCA4MCUgMCUsIDEwMCUgMTAwJSwgMCUgMTAwJSk7XHJcblxyXG4gIGZpbHRlcjogZHJvcC1zaGFkb3coM3B4IDNweCAxLjVweCB2YXIoLS1ibGFjay0xMCkpO1xyXG5cclxuICAmOmhvdmVyIHtcclxuICAgIGZpbHRlcjogZHJvcC1zaGFkb3coM3B4IDNweCA1cHggdmFyKC0tYmxhY2stMTApKTtcclxuICB9XHJcblxyXG4gICY6aG92ZXIge1xyXG4gICAgJjo6YWZ0ZXIge1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKGNvbG9ycy4kcHJpbWFyeSwgMC45KTtcclxuICAgIH1cclxuICB9XHJcblxyXG4gICY6OmFmdGVyIHtcclxuICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICBwb2ludGVyLWV2ZW50czogbm9uZTtcclxuICAgIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICAgIGJhY2tkcm9wLWZpbHRlcjogYmx1cigzcHgpO1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgY29sb3JzLiRwcmltYXJ5O1xyXG4gICAgei1pbmRleDogLTE7XHJcbiAgfVxyXG59XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBCb3RvbiBwYXJhIGNhbWJpYXIgZW50cmUgbGFzIHZlbnRhbmFzIGRlIGxvZ2luIHkgcmVnaXN0cm9cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLmJ1dHRvbl9jb250YWluZXJfcmVnaXN0ZXIsXHJcbi5idXR0b25fY29udGFpbmVyX2xvZ2luIHtcclxuICB6LWluZGV4OiAxMDA7XHJcbiAgZGlzcGxheTogZ3JpZDtcclxuXHJcbiAgLmJ1dHRvbjEge1xyXG4gICAgd2lkdGg6IDE4MHB4O1xyXG4gICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMHB4IDVweCAwcHggMHB4O1xyXG4gICAgZm9udC13ZWlnaHQ6IDcwMDtcclxuICAgIGZvbnQtc2l6ZTogZm9udHMuJHRleHQtYnV0dG9uLXNpemU7XHJcbiAgICBjb2xvcjogdmFyKC0td2hpdGUpO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICBib3JkZXI6IG5vbmU7XHJcbiAgICBvdXRsaW5lOiBub25lO1xyXG4gICAgY3Vyc29yOiBwb2ludGVyO1xyXG5cclxuICAgICY6aG92ZXIge1xyXG4gICAgICAmOjphZnRlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYShjb2xvcnMuJHByaW1hcnksIDAuNyk7XHJcbiAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBAbWVkaWEgKChtYXgtd2lkdGg6IDM1MHB4KSBhbmQgKG1pbi13aWR0aDogMHB4KSkge1xyXG4gICAgICBmb250LXNpemU6IGZvbnRzLiR0ZXh0LWJ1dHRvbi1zaXplIC0gMC4yZW07XHJcbiAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgd2lkdGg6IDE1MHB4O1xyXG4gICAgICB0cmFuc2Zvcm06IHNjYWxlKDAuOSk7XHJcbiAgICB9XHJcblxyXG4gICAgJjo6YWZ0ZXIge1xyXG4gICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgYmFja2Ryb3AtZmlsdGVyOiBibHVyKDNweCk7XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6IHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjYpO1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAwcHggNXB4IDBweCAwcHg7XHJcbiAgICAgIHotaW5kZXg6IC0xO1xyXG4gICAgfVxyXG4gIH1cclxufVxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gRWZlY3RvXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi5lZmVjdHNfYnV0dG9uIHtcclxuICBjdXJzb3I6IHBvaW50ZXI7XHJcblxyXG4gICY6aG92ZXIge1xyXG4gICAgdHJhbnNmb3JtOiBzY2FsZSgwLjk4KTtcclxuICAgIHRyYW5zaXRpb246IDAuMjVzO1xyXG4gIH1cclxuXHJcbiAgJjphY3RpdmUsXHJcbiAgJjpmb2N1cyB7XHJcbiAgICB0cmFuc2Zvcm06IHNjYWxlKDAuOTcpO1xyXG4gICAgdHJhbnNpdGlvbjogMC4yNXM7XHJcbiAgfVxyXG59XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBDb2xvciBkZSBib3RvbmVzIChyZWxsZW5vKVxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG5AbWl4aW4gYnV0dG9uLXN0eWxlKCRjb2xvcikge1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICRjb2xvcjtcclxuICBib3JkZXI6IDFweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuXHJcbiAgJjpob3ZlciB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiBkYXJrZW4oJGNvbG9yLCAxMCUpO1xyXG4gIH1cclxufVxyXG5cclxuLmJ0bl9wcmltYXJ5IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRwcmltYXJ5KTtcclxufVxyXG5cclxuLmJ0bl8xIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItMSk7XHJcbn1cclxuXHJcbi5idG5fMiB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlKGNvbG9ycy4kYnRuLWNvbG9yLTIpO1xyXG59XHJcblxyXG4uYnRuXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci0zKTtcclxufVxyXG5cclxuLmJ0bl80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItNCk7XHJcbn1cclxuXHJcbi5idG5fNSB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlKGNvbG9ycy4kYnRuLWNvbG9yLTUpO1xyXG59XHJcblxyXG4uYnRuXzYge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci02KTtcclxufVxyXG5cclxuLy8gQ29sb3Jlc1xyXG4uYnRuX2VudmlhciB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlKGNvbG9ycy4kYnRuLWNvbG9yLWVudmlhcik7XHJcbn1cclxuXHJcbi5idG5fbnVldm8ge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci1udWV2byk7XHJcbn1cclxuXHJcbi5idG5fZWRpdGFyIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItZWRpdGFyKTtcclxufVxyXG5cclxuLmJ0bl9hY3R1YWxpemFyIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItYWN0dWFsaXphcik7XHJcbn1cclxuXHJcbi5idG5fZWxpbWluYXIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci1lbGltaW5hcik7XHJcbn1cclxuXHJcbi5idG5fY2FuY2VsYXIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci1jYW5jZWxhcik7XHJcbn1cclxuXHJcbi5idG5fZmlsdHJvIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItZmlsdHJvKTtcclxufVxyXG5cclxuLmJ0bl9kZWxldGVfZmlsdGVyIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItZGVsZXRlLWZpbHRybyk7XHJcbn1cclxuXHJcbi5idG5fY29weSB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlKGNvbG9ycy4kYnRuLWNvbG9yLWNvcHkpO1xyXG59XHJcblxyXG4uYnRuX2V4Y2VsIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUoY29sb3JzLiRidG4tY29sb3ItZXhjZWwpO1xyXG59XHJcblxyXG4uYnRuX3N2ZyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlKGNvbG9ycy4kYnRuLWNvbG9yLWNzdik7XHJcbn1cclxuXHJcbi5idG5fcHJpbnQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZShjb2xvcnMuJGJ0bi1jb2xvci1wcmludCk7XHJcbn1cclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIENvbG9yIGRlIGJvdG9uZXMgKGh1ZWNvIC0gY29udG9ybm8pXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbkBtaXhpbiBidXR0b24tc3R5bGUyKCRjb2xvcikge1xyXG4gIGJvcmRlcjogMXB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgY3Vyc29yOiBwb2ludGVyO1xyXG4gIGNvbG9yOiAkY29sb3I7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcblxyXG4gICY6aG92ZXIge1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKCRjb2xvciwgMC4xKTtcclxuICB9XHJcbn1cclxuXHJcbi5idG5fcHJpbWFyeV8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kcHJpbWFyeSk7XHJcbn1cclxuXHJcbi5idG5fMV8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWVudmlhcik7XHJcbn1cclxuXHJcbi5idG5fMl8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLW51ZXZvKTtcclxufVxyXG5cclxuLmJ0bl8zXzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItZWRpdGFyKTtcclxufVxyXG5cclxuLmJ0bl80XzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItYWN0dWFsaXphcik7XHJcbn1cclxuXHJcbi5idG5fNV8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWVsaW1pbmFyKTtcclxufVxyXG5cclxuLmJ0bl82XzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItY2FuY2VsYXIpO1xyXG59XHJcblxyXG4vLyBDb2xvcmVzIDJcclxuLmJ0bl9lbnZpYXJfMiB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMihjb2xvcnMuJGJ0bi1jb2xvci1lbnZpYXIpO1xyXG59XHJcblxyXG4uYnRuX251ZXZvXzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItbnVldm8pO1xyXG59XHJcblxyXG4uYnRuX2VkaXRhcl8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWVkaXRhcik7XHJcbn1cclxuXHJcbi5idG5fYWN0dWFsaXphcl8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWFjdHVhbGl6YXIpO1xyXG59XHJcblxyXG4uYnRuX2VsaW1pbmFyXzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItZWxpbWluYXIpO1xyXG59XHJcblxyXG4uYnRuX2NhbmNlbGFyXzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItY2FuY2VsYXIpO1xyXG59XHJcblxyXG4uYnRuX2ZpbHRyb18yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWZpbHRybyk7XHJcbn1cclxuXHJcbi5idG5fZGVsZXRlX2ZpbHRlcl8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWRlbGV0ZS1maWx0cm8pO1xyXG59XHJcblxyXG4uYnRuX2NvcHlfMiB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMihjb2xvcnMuJGJ0bi1jb2xvci1jb3B5KTtcclxufVxyXG5cclxuLmJ0bl9leGNlbF8yIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUyKGNvbG9ycy4kYnRuLWNvbG9yLWV4Y2VsKTtcclxufVxyXG5cclxuLmJ0bl9zdmdfMiB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMihjb2xvcnMuJGJ0bi1jb2xvci1jc3YpO1xyXG59XHJcblxyXG4uYnRuX3ByaW50XzIge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTIoY29sb3JzLiRidG4tY29sb3ItcHJpbnQpO1xyXG59XHJcblxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuLy8gQ29sb3IgZGUgYm90b25lcyAoaHVlY28gLSBjb250b3JubyAtIHJlbGxlbm8pXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbkBtaXhpbiBidXR0b24tc3R5bGUzKCRjb2xvcikge1xyXG4gIGJvcmRlcjogMXB4IHNvbGlkICRjb2xvcjtcclxuICBjb2xvcjogJGNvbG9yO1xyXG4gIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50O1xyXG5cclxuICAmOmhvdmVyIHtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkIGRhcmtlbigkY29sb3IsIDIwKTtcclxuICAgIGNvbG9yOiBjb2xvcnMuJHdoaXRlO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogJGNvbG9yO1xyXG4gIH1cclxufVxyXG5cclxuLmJ0bl9wcmltYXJ5XzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRwcmltYXJ5KTtcclxufVxyXG5cclxuLmJ0bl8xXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZW52aWFyKTtcclxufVxyXG5cclxuLmJ0bl8yXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItbnVldm8pO1xyXG59XHJcblxyXG4uYnRuXzNfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1lZGl0YXIpO1xyXG59XHJcblxyXG4uYnRuXzRfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1hY3R1YWxpemFyKTtcclxufVxyXG5cclxuLmJ0bl81XzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZWxpbWluYXIpO1xyXG59XHJcblxyXG4uYnRuXzZfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1jYW5jZWxhcik7XHJcbn1cclxuXHJcbi8vIENvbG9yZXMgM1xyXG4uYnRuX2Vudmlhcl8zIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUzKGNvbG9ycy4kYnRuLWNvbG9yLWVudmlhcik7XHJcbn1cclxuXHJcbi5idG5fbnVldm9fMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1udWV2byk7XHJcbn1cclxuXHJcbi5idG5fZWRpdGFyXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZWRpdGFyKTtcclxufVxyXG5cclxuLmJ0bl9hY3R1YWxpemFyXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItYWN0dWFsaXphcik7XHJcbn1cclxuXHJcbi5idG5fZWxpbWluYXJfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1lbGltaW5hcik7XHJcbn1cclxuXHJcbi5idG5fY2FuY2VsYXJfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1jYW5jZWxhcik7XHJcbn1cclxuXHJcbi5idG5fZmlsdHJvXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZmlsdHJvKTtcclxufVxyXG5cclxuLmJ0bl9kZWxldGVfZmlsdGVyXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZGVsZXRlLWZpbHRybyk7XHJcbn1cclxuXHJcbi5idG5fY29weV8zIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUzKGNvbG9ycy4kYnRuLWNvbG9yLWNvcHkpO1xyXG59XHJcblxyXG4uYnRuX2V4Y2VsXzMge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTMoY29sb3JzLiRidG4tY29sb3ItZXhjZWwpO1xyXG59XHJcblxyXG4uYnRuX3N2Z18zIHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGUzKGNvbG9ycy4kYnRuLWNvbG9yLWNzdik7XHJcbn1cclxuXHJcbi5idG5fcHJpbnRfMyB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlMyhjb2xvcnMuJGJ0bi1jb2xvci1wcmludCk7XHJcbn1cclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIENvbG9yIGRlIGJvdG9uZXMgKHNvbG8gdGV4dG8gLSBzb21icmEpXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbkBtaXhpbiBidXR0b24tc3R5bGU0KCRjb2xvcikge1xyXG4gIGNvbG9yOiAkY29sb3I7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgYm9yZGVyOiAxcHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgdHJhbnNpdGlvbjogYWxsIDAuM3MgZWFzZS1pbjtcclxuXHJcbiAgJjpob3ZlciB7XHJcbiAgICBjb2xvcjogZGFya2VuKCRjb2xvciwgMTApO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICBib3gtc2hhZG93OlxyXG4gICAgICBpbnNldCAycHggMnB4IDVweCBjb2xvcnMuJHNoYTIsXHJcbiAgICAgIGluc2V0IC0ycHggLTJweCA1cHggY29sb3JzLiRzaGExO1xyXG4gICAgdHJhbnNpdGlvbjogYWxsIDAuM3MgZWFzZS1pbjtcclxuICB9XHJcbn1cclxuXHJcbi5idG5fcHJpbWFyeV80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kcHJpbWFyeSk7XHJcbn1cclxuXHJcbi5idG5fMV80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWVudmlhcik7XHJcbn1cclxuXHJcbi5idG5fMl80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLW51ZXZvKTtcclxufVxyXG5cclxuLmJ0bl8zXzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItZWRpdGFyKTtcclxufVxyXG5cclxuLmJ0bl80XzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItYWN0dWFsaXphcik7XHJcbn1cclxuXHJcbi5idG5fNV80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWVsaW1pbmFyKTtcclxufVxyXG5cclxuLmJ0bl82XzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItY2FuY2VsYXIpO1xyXG59XHJcblxyXG4vLyBDb2xvcmVzIDRcclxuLmJ0bl9lbnZpYXJfNCB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlNChjb2xvcnMuJGJ0bi1jb2xvci1lbnZpYXIpO1xyXG59XHJcblxyXG4uYnRuX251ZXZvXzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItbnVldm8pO1xyXG59XHJcblxyXG4uYnRuX2VkaXRhcl80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWVkaXRhcik7XHJcbn1cclxuXHJcbi5idG5fYWN0dWFsaXphcl80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWFjdHVhbGl6YXIpO1xyXG59XHJcblxyXG4uYnRuX2VsaW1pbmFyXzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItZWxpbWluYXIpO1xyXG59XHJcblxyXG4uYnRuX2NhbmNlbGFyXzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItY2FuY2VsYXIpO1xyXG59XHJcblxyXG4uYnRuX2ZpbHRyb180IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWZpbHRybyk7XHJcbn1cclxuXHJcbi5idG5fZGVsZXRlX2ZpbHRlcl80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWRlbGV0ZS1maWx0cm8pO1xyXG59XHJcblxyXG4uYnRuX2NvcHlfNCB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlNChjb2xvcnMuJGJ0bi1jb2xvci1jb3B5KTtcclxufVxyXG5cclxuLmJ0bl9leGNlbF80IHtcclxuICBAaW5jbHVkZSBidXR0b24tc3R5bGU0KGNvbG9ycy4kYnRuLWNvbG9yLWV4Y2VsKTtcclxufVxyXG5cclxuLmJ0bl9zdmdfNCB7XHJcbiAgQGluY2x1ZGUgYnV0dG9uLXN0eWxlNChjb2xvcnMuJGJ0bi1jb2xvci1jc3YpO1xyXG59XHJcblxyXG4uYnRuX3ByaW50XzQge1xyXG4gIEBpbmNsdWRlIGJ1dHRvbi1zdHlsZTQoY29sb3JzLiRidG4tY29sb3ItcHJpbnQpO1xyXG59XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBDb2xvciBkZSBib3RvbmVzIHBhcmEgcGFnaW5hY2lvblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4uYnRuX25hdmVnYWNpb24ge1xyXG4gIGJhY2tncm91bmQtY29sb3I6IGNvbG9ycy4kYnRuLWNvbG9yLW5hdmVnYWNpb247XHJcbiAgYm94LXNoYWRvdzpcclxuICAgIGluc2V0IDAuMnJlbSAwLjJyZW0gMC41cmVtIGRhcmtlbihjb2xvcnMuJGJ0bi1jb2xvci1uYXZlZ2FjaW9uLCAxMCksXHJcbiAgICBpbnNldCAtMC4ycmVtIC0wLjJyZW0gMC41cmVtIHJnYmEoY29sb3JzLiR3aGl0ZSwgMC41KTtcclxufVxyXG5cclxuLmJ0bl9uYXZlZ2FjaW9uOmhvdmVyIHtcclxuICBiYWNrZ3JvdW5kLWNvbG9yOiBkYXJrZW4oY29sb3JzLiRidG4tY29sb3ItbmF2ZWdhY2lvbiwgNSUpO1xyXG4gIGJveC1zaGFkb3c6XHJcbiAgICBpbnNldCAwLjJyZW0gMC4ycmVtIDAuNXJlbSBkYXJrZW4oY29sb3JzLiRidG4tY29sb3ItbmF2ZWdhY2lvbiwgMTUpLFxyXG4gICAgaW5zZXQgLTAuMnJlbSAtMC4ycmVtIDAuNXJlbSByZ2JhKGNvbG9ycy4kd2hpdGUsIDAuNSk7XHJcbn1cclxuXHJcbi5idG5fbmF2ZWdhY2lvbjpkaXNhYmxlZCB7XHJcbiAgY3Vyc29yOiBkZWZhdWx0O1xyXG4gIGJhY2tncm91bmQtY29sb3I6IGRhcmtlbihjb2xvcnMuJGJ0bi1jb2xvci1uYXZlZ2FjaW9uLCAxNSUpO1xyXG4gIHRyYW5zZm9ybTogbm9uZTtcclxuICBib3gtc2hhZG93OiBub25lO1xyXG4gIG9wYWNpdHk6IDAuNjtcclxuICBib3gtc2hhZG93OlxyXG4gICAgaW5zZXQgMC4ycmVtIDAuMnJlbSAwLjVyZW0gZGFya2VuKGNvbG9ycy4kYnRuLWNvbG9yLW5hdmVnYWNpb24sIDE1KSxcclxuICAgIGluc2V0IC0wLjJyZW0gLTAuMnJlbSAwLjVyZW0gcmdiYShjb2xvcnMuJHdoaXRlLCAwLjUpO1xyXG59XHJcblxyXG4vKipcclxuKiBCb3RvbiBwYXJhIG1vdmVyIGVsZW1lbnRvXHJcbiovXHJcbi5pY29uX21vdmVfZWxlbWVudCB7XHJcbiAgY29sb3I6IHJnYmEoY29sb3JzLiRwcmltYXJ5LCAwLjIpO1xyXG59XHJcblxyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBCb3RvbiB0b3BcclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuI2J0bl90b3Age1xyXG4gIHBvc2l0aW9uOiBmaXhlZDtcclxuICBib3R0b206IDIwcHg7XHJcbiAgcmlnaHQ6IDIwcHg7XHJcbiAgd2lkdGg6IDQwcHg7XHJcbiAgaGVpZ2h0OiA1MHB4O1xyXG4gIHotaW5kZXg6IDk5OTk7XHJcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgYm9yZGVyOiBub25lO1xyXG4gIG91dGxpbmU6IG5vbmU7XHJcbiAgYmFja2dyb3VuZC1jb2xvcjogY29sb3JzLiRwcmltYXJ5O1xyXG4gIGNvbG9yOiB2YXIoLS13aGl0ZSk7XHJcbiAgY3Vyc29yOiBwb2ludGVyO1xyXG4gIGJvcmRlci1yYWRpdXM6IDEwcHg7XHJcbiAgZm9udC1zaXplOiBmb250cy4kaWNvbi1zaXplICsgMC4yZW07XHJcbiAgdHJhbnNpdGlvbjogb3BhY2l0eSAwLjVzIGVhc2U7XHJcbiAgb3BhY2l0eTogMDtcclxuXHJcbiAgJi52aXNpYmxlIHtcclxuICAgIG9wYWNpdHk6IDE7XHJcbiAgfVxyXG5cclxuICAmOmhvdmVyIHtcclxuICAgIGJhY2tncm91bmQtY29sb3I6IGRhcmtlbihjb2xvcnMuJHByaW1hcnksIDEwJSk7XHJcbiAgfVxyXG5cclxuICBAbWVkaWEgKChtYXgtd2lkdGg6IDMzNXB4KSBhbmQgKG1pbi13aWR0aDogMHB4KSkge1xyXG4gICAgYm90dG9tOiA1cHg7XHJcbiAgICByaWdodDogNXB4O1xyXG4gICAgd2lkdGg6IDM1cHg7XHJcbiAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgfVxyXG59XHJcbiIsIi8vIEZ1ZW50ZSBwcmluY2lwYWxcclxuJGZvbnQtcHJpbWFyeTogJ0FyaWFsJywgc2Fucy1zZXJpZjtcclxuXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4vLyBUYW1hw4PCsW9zIFZhcmlhYmxlc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuXHJcbi8vIE5hdmJhclxyXG4kdGV4dC1uYXY6IDEuMTVlbTsgICAgICAvLyAxOHB4XHJcblxyXG4vLyBTaWRlYmFyXHJcbiR0aXRsZS1zaWRlYmFyOiAxLjJlbTsgIC8vIDIwcHhcclxuJGl0ZW0tdGV4dDogMC43NWVtOyAgICAgLy8gMTJweFxyXG4kaXRlbS1kaXZpZGVyOiAwLjZlbTsgICAvLyAxMHB4XHJcbiRpdGVtLWF1dG9yczogMC41NWVtOyAgIC8vIDlweFxyXG5cclxuLy8gQ29udGVudFxyXG4kdGl0bGUtY29udGVudDogMS4yZW07XHJcblxyXG4vLyBFcnJvciA0MDRcclxuJHRpdGxlLWVycm9yOiA5LjVlbTsgICAgICAvLyAxNTBweFxyXG4kc3VidGl0bGUtZXJyb3I6IDMuMWVtOyAgIC8vIDUwcHhcclxuJHRleHQtZXJyb3I6IDEuMmVtO1xyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIEVzdGFuZGFyXHJcbi8vID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxyXG4kdGl0bGUtdGV4dC1oMTogMmVtO1xyXG4kdGl0bGUtdGV4dC1oMjogMS41ZW07XHJcbiR0aXRsZS10ZXh0LWgzOiAxLjE3ZW07XHJcbiR0aXRsZS10ZXh0LWg0OiAxZW07XHJcbiR0aXRsZS10ZXh0LWg1OiAwLjgzZW07XHJcbiR0aXRsZS10ZXh0LWg2OiAwLjY3ZW07XHJcbiR0ZXh0LXA6IDFlbTtcclxuXHJcbiRpY29uLXNpemU6IDEuMmVtO1xyXG4kdGV4dC1idXR0b24tc2l6ZTogMC43NWVtO1xyXG5cclxuLy8gVGFibGV0XHJcbiR0aXRsZS10ZXh0LWgxLXRhYmxldDogMS44ZW07XHJcbiR0aXRsZS10ZXh0LWgyLXRhYmxldDogMS4zNWVtO1xyXG4kdGl0bGUtdGV4dC1oMy10YWJsZXQ6IDEuMDVlbTtcclxuJHRpdGxlLXRleHQtaDQtdGFibGV0OiAwLjllbTtcclxuJHRpdGxlLXRleHQtaDUtdGFibGV0OiAwLjc1ZW07XHJcbiR0aXRsZS10ZXh0LWg2LXRhYmxldDogMC42ZW07XHJcbiR0ZXh0LXAtdGFibGV0OiAwLjllbTtcclxuXHJcbi8vIE1vdmlsXHJcbiR0aXRsZS10ZXh0LWgxLXBob25lOiAxLjZlbTtcclxuJHRpdGxlLXRleHQtaDItcGhvbmU6IDEuMmVtO1xyXG4kdGl0bGUtdGV4dC1oMy1waG9uZTogMWVtO1xyXG4kdGl0bGUtdGV4dC1oNC1waG9uZTogMC44ZW07XHJcbiR0aXRsZS10ZXh0LWg1LXBob25lOiAwLjdlbTtcclxuJHRpdGxlLXRleHQtaDYtcGhvbmU6IDAuNWVtO1xyXG4kdGV4dC1wLXBob25lOiAwLjg1ZW07XHJcblxyXG5cclxuLy8gPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XHJcbi8vIFRhbWHDg8Kxb3MgZGUgbGV0cmEgcGFyYSBmb3JtdWxhcmlvc1xyXG4vLyA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cclxuJGZvcm0taW5wdXQ6IDAuOGVtO1xyXG4kZm9ybS1sYWJlbDogMC43NWVtO1xyXG4kZm9ybS1yZXF1aWVyZWQ6IDAuNTVlbTtcclxuXHJcblxyXG5cclxuJGRpYWxvZy1oZWFkZXItdGl0bGU6IDAuOGVtO1xyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iLCIvLyBJbXBvcnRzXHJcbkB1c2UgJ3Jvb3RfY29sb3JzJztcclxuXHJcbi8vIFZhcmlhYmxlcyBkZSBjb2xvcmVzXHJcbiRwcmltYXJ5OiAjNDA0NTZjO1xyXG4kZm9jdXMtaW5wdXQ6IGxpZ2h0ZW4oJHByaW1hcnksIDMwJSk7XHJcblxyXG4kYmc6ICNmMWYwZjY7XHJcbiRiZy1lbGVtZW50czogI2VjZjBmMztcclxuJHNoYTE6ICNmOWY5Zjk7XHJcbiRzaGEyOiAjZDFkOWU2O1xyXG4kd2hpdGU6ICNmZmY7XHJcblxyXG4kYmxhY2s6ICMwMDAwMDA7XHJcbiRibGFjay1zaGE6ICMxODE4MWM7XHJcblxyXG4kZ3JheTogIzgwODA4MDtcclxuJGdyYXktdGV4dDogIzQ5NDk0OTtcclxuXHJcbiRvcm86ICM3MTZiNDE7XHJcbiRzaGFkb3ctb3JvOiAjMTcxODFjO1xyXG5cclxuXHJcbi8vIENvbG9yIGRlIGJvdG9uZXNcclxuJGJ0bnM6ICMzYzY4ZTM7XHJcbiRidG4tY29sb3ItMTogJGJ0bnM7XHJcbiRidG4tY29sb3ItMjogZGFya2VuKCRidG5zLCAxMCk7XHJcbiRidG4tY29sb3ItMzogZGFya2VuKCRidG5zLCAyMCk7XHJcbiRidG4tY29sb3ItNDogZGFya2VuKCRidG5zLCAzMCk7XHJcbiRidG4tY29sb3ItNTogZGFya2VuKCRidG5zLCA0MCk7XHJcbiRidG4tY29sb3ItNjogZGFya2VuKCRidG5zLCA1MCk7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1idXNjYXI6ICMyOTgwYjk7XHJcbiRidG4tY29sb3ItaW5ncmVzYXI6ICMxYTc1MDA7XHJcbiRidG4tY29sb3ItbmF2ZWdhY2lvbjogIzAwOWM4YztcclxuXHJcblxyXG4kYnRuLWNvbG9yLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItYnVzY2FyLCAxMCk7XHJcbiRidG4tY29sb3ItZGVsZXRlLWZpbHRybzogZGFya2VuKCRidG4tY29sb3ItZmlsdHJvLCAxMCk7XHJcbiRidG4tY29sb3ItY29weTogIzAwNmQ3NztcclxuJGJ0bi1jb2xvci1leGNlbDogIzBlNzUzYztcclxuJGJ0bi1jb2xvci1jc3Y6ICNmZjk4MDA7XHJcbiRidG4tY29sb3ItcHJpbnQ6ICMxN2EyYjg7XHJcblxyXG5cclxuJGJ0bi1jb2xvci1lbnZpYXI6ICMyN2FlNjA7XHJcbiRidG4tY29sb3ItbnVldm86ICMzNDk4ZGI7XHJcbiRidG4tY29sb3ItZWRpdGFyOiAjZjM5YzEyO1xyXG4kYnRuLWNvbG9yLWFjdHVhbGl6YXI6ICMyZWNjNzE7XHJcbiRidG4tY29sb3ItZWxpbWluYXI6ICNlNzRjM2M7XHJcbiRidG4tY29sb3ItY2FuY2VsYXI6ICM5NWE1YTY7XHJcblxyXG4iXSwic291cmNlUm9vdCI6IiJ9 */"]
  });
}

/***/ }),

/***/ 3587:
/*!*****************************************************!*\
  !*** ./src/environments/environment.development.ts ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   environment: () => (/* binding */ environment)
/* harmony export */ });
const environment = {
  urlBase: 'http://localhost:3000/api/v1',
  urlUpload: '/convert',
  urlData: '/data',
  urlFile: '/file'
};

/***/ }),

/***/ 4429:
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _app_app_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app/app.component */ 92);
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/platform-browser */ 436);
/* harmony import */ var _angular_common_locales_es_CO__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/locales/es-CO */ 3964);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ 316);
/* harmony import */ var _app_app_config__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./app/app.config */ 289);


// Importa la configuración regional de Colombia



// Registra la zona horaria de Bogotá
(0,_angular_common__WEBPACK_IMPORTED_MODULE_2__.registerLocaleData)(_angular_common_locales_es_CO__WEBPACK_IMPORTED_MODULE_3__["default"]);
(0,_angular_platform_browser__WEBPACK_IMPORTED_MODULE_4__.bootstrapApplication)(_app_app_component__WEBPACK_IMPORTED_MODULE_0__.AppComponent, _app_app_config__WEBPACK_IMPORTED_MODULE_1__.appConfig).catch(err => console.error(err));

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendor"], () => (__webpack_exec__(886), __webpack_exec__(4429)));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=main.js.map