/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/resources/assets/js/accede-vialer.js":
/*!**************************************************!*\
  !*** ./src/resources/assets/js/accede-vialer.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// var al=function(msg){
// 	console.log(msg);
// }
//var 
$.fn.enableSelect = function () {
  this.prop('disabled', false);
  this.closest('.form-group').removeClass("disabled");
  this.selectpicker('refresh');
  return this;
};

$.fn.disableSelect = function () {
  this.prop('disabled', true);
  this.closest('.form-group').addClass("disabled");
  this.selectpicker('refresh');
  return this;
};

$.fn.initVialerField = function () {
  return this.each(function () {
    al('initVialerField');
    var o = this;
    o.freeAddress = false;
    o.currentPais = $(this).data("current-pais");
    o.currentProvincia = $(this).data("current-provincia");
    o.currentMunicipi = $(this).data("current-municipi"); // al(o.currentPais);

    o.$container = $(o);
    o.$input = $(o).find("[name='vialer-value']");
    o.$paises = $(o).find('select.field_pais');
    o.$provincies = $(o).find('select.field_provincia');
    o.$municipis = $(o).find('select.field_municipi');
    o.$carrer = $(o).find('.field_carrer');
    o.$adreca = $(o).find('.field_adreca');
    o.$numeros = $(o).find('select.field_numero');
    o.$lletres = $(o).find('select.field_lletra');
    o.$escales = $(o).find('select.field_escala');
    o.$blocs = $(o).find('select.field_bloc');
    o.$plantes = $(o).find('select.field_planta');
    o.$portes = $(o).find('select.field_porta');
    o.$codispostals = $(o).find('select.field_codipostal');
    o.$km = $(o).find('input.field_km'); //al(o.$numeros);

    o.save = function () {
      //al(o.$carrer);
      var val = o.toJson(); //al(val);

      o.$input.val(JSON.stringify(val));
    };

    o.toJson = function () {
      var obj = {
        pais: {
          code: o.$paises.val(),
          name: o.$paises.find("option:selected").text()
        },
        provincia: {
          code: o.$provincies.val(),
          name: o.$provincies.find("option:selected").text()
        },
        municipi: {
          code: o.$municipis.val(),
          name: o.$municipis.find("option:selected").text()
        },
        carrer: {
          code: null,
          name: null
        },
        numero: {
          code: null,
          name: null
        },
        lletra: {
          code: null,
          name: null
        },
        escala: {
          code: null,
          name: null
        },
        bloc: {
          code: null,
          name: null
        },
        planta: {
          code: null,
          name: null
        },
        porta: {
          code: null,
          name: null
        },
        codipostal: {
          code: null,
          name: null
        },
        km: null,
        adreca: o.$adreca.val()
      };

      if (!o.freeAddress) {
        obj.carrer = {
          code: o.$carrer.closest('.form-group').find('input[type=hidden]').val(),
          name: o.$carrer.closest('.form-group').find('input[name=content_carrer]').val()
        };
        obj.numero = {
          code: o.$numeros.val(),
          name: o.$numeros.find("option:selected").text()
        };
        obj.lletra = {
          code: o.$lletres.val(),
          name: o.$lletres.find("option:selected").text()
        };
        obj.escala = {
          code: o.$escales.val(),
          name: o.$escales.find("option:selected").text()
        };
        obj.bloc = {
          code: o.$blocs.val(),
          name: o.$blocs.find("option:selected").text()
        };
        obj.planta = {
          code: o.$plantes.val(),
          name: o.$plantes.find("option:selected").text()
        };
        obj.porta = {
          code: o.$portes.val(),
          name: o.$portes.find("option:selected").text()
        };
        obj.codipostal = {
          code: o.$codispostals.val(),
          name: o.$codispostals.find("option:selected").text()
        };
        obj.km = o.$km.val();
        obj.adreca = o.montaAdreca(obj);
      }

      return obj;
    };

    o.montaAdreca = function (values) {
      var ret = [];
      al(values);
      if (values.carrer.name) ret.push(values.carrer.name);
      if (values.numero.name) ret.push("Núm:" + values.numero.name);
      if (values.lletra.name) ret.push(values.lletra.name);
      if (values.escala.name) ret.push("Esc:" + values.escala.name);
      if (values.bloc.name) ret.push("Bloc: " + values.bloc.name);
      if (values.planta.name) ret.push("Planta: " + values.planta.name);
      if (values.porta.name) ret.push("Porta: " + values.porta.name);
      if (values.km) ret.push("Km: " + values.km);
      if (values.codipostal.name) ret.push("CP: " + values.codipostal.name);
      if (values.municipi.name) ret.push(values.municipi.name);
      if (values.provincia.name) ret.push(values.provincia.name);
      if (values.pais.name) ret.push(values.pais.name);
      return ret.join(" ");
    };

    o.refreshPaisos = function () {
      //al("refreshPaisos");
      o.$paises.closest(".form-group").startLoading(); //al(o.$paises);

      var url = laroute.route('accede.paisos'); //al(url);

      $.getJSON(url, function (data) {
        o.$paises.empty();
        $.each(data, function (i) {
          o.$paises.append($('<option value="' + this.codigoPais + '">' + this.nombrePais + '</option>'));
        });
        o.$paises.enableSelect();
        o.$paises.selectpicker('val', o.currentPais);
      }).fail(function () {
        o.$paises.empty().disableSelect();
      }).always(function () {
        o.$paises.closest(".form-group").stopLoading();
        o.save();
      });
    };

    o.refreshProvincies = function () {
      //al("refreshProvincies");
      // al(o.$paises.val());
      // al(o.currentPais);
      if (o.$paises.val() == o.currentPais) {
        //al("SI");
        o.$provincies.closest(".form-group").startLoading();
        var url = laroute.route('accede.provincies');
        $.getJSON(url, function (data) {
          o.$provincies.empty();
          $.each(data, function (i) {
            o.$provincies.append($('<option value="' + this.codigoProvincia + '">' + this.nombreProvincia + '</option>'));
          });
          o.$provincies.enableSelect();
          o.$provincies.selectpicker('val', o.currentProvincia);
          o.refreshMunicipis(o.$provincies.val());
        }).fail(function () {
          o.$provincies.empty().disableSelect();
        }).always(function () {
          o.$provincies.closest(".form-group").stopLoading();
          o.save();
        });
      } else {
        //al("NO");
        o.$provincies.empty().prop('disabled', true);
        o.$provincies.selectpicker('refresh');
        o.$provincies.closest('.form-group').addClass("disabled");
        o.$provincies.closest(".form-group").stopLoading();
        o.$municipis.empty().prop('disabled', true);
        o.$municipis.selectpicker('refresh');
        o.$municipis.closest('.form-group').addClass("disabled");
        o.$municipis.closest(".form-group").stopLoading();
        o.toggleAdreca(false);
      }
    };

    o.refreshMunicipis = function (codigoProvincia) {
      if (codigoProvincia) {
        o.$municipis.closest(".form-group").startLoading();
        var url = laroute.route('accede.municipis', {
          codigoProvincia: codigoProvincia
        }); //al('refreshMunicipis:'+url);

        $.getJSON(url, function (data) {
          o.$municipis.empty();
          $.each(data, function (i) {
            o.$municipis.append($('<option value="' + this.codigoMunicipio + '">' + this.nombreMunicipio + '</option>'));
          });
          o.$municipis.enableSelect();

          if (o.$provincies.val() == o.currentProvincia) {
            o.$municipis.selectpicker('val', o.currentMunicipi);
          }

          o.$municipis.trigger('change');
        }).fail(function () {
          o.$municipis.disableSelect();
        }).always(function () {
          //al("OK");
          //al(o.$municipis);
          o.$municipis.closest(".form-group").stopLoading();
          o.save();
        });
      } else {
        o.$municipis.disableSelect();
        o.$municipis.closest(".form-group").stopLoading();
        o.save();
      }
    };

    o.refreshNumeros = function (codigoIneVia) {
      o.refreshComponent(o.$numeros, 'accede.numeros.combo', codigoIneVia);
    };

    o.refreshEscales = function (codigoIneVia, numero) {
      o.refreshComponent(o.$escales, 'accede.escales.combo', codigoIneVia, numero);
    };

    o.refreshLletres = function (codigoIneVia, numero) {
      o.refreshComponent(o.$lletres, 'accede.lletres.combo', codigoIneVia, numero);
    };

    o.refreshBlocs = function (codigoIneVia) {
      o.refreshComponent(o.$blocs, 'accede.blocs.combo', codigoIneVia);
    };

    o.refreshPlantes = function (codigoIneVia, numero) {
      o.refreshComponent(o.$plantes, 'accede.plantes.combo', codigoIneVia, numero);
    };

    o.refreshPortes = function (codigoIneVia, numero, planta) {
      o.refreshComponent(o.$portes, 'accede.portes.combo', codigoIneVia, numero, planta);
    };

    o.refreshCodispostals = function (codigoIneVia, numero) {
      o.refreshComponent(o.$codispostals, 'accede.codispostals.combo', codigoIneVia, numero);
    };

    o.refreshComponent = function ($component, route, codigoIneVia, numero, planta) {
      if (codigoIneVia) {
        //al(route+"-"+codigoIneVia+"-"+numero+"-"+planta);
        $component.closest(".form-group").startLoading();
        var params = {
          codigoIneVia: codigoIneVia
        };
        if (numero) params.numero = numero;else params.numero = false;
        if (planta) params.nombrePlanta = planta; //al(params);

        var url = laroute.route(route, params); //al('refreshComponent:'+url);

        $.getJSON(url, function (data) {
          $component.empty();

          if (data && data.length > 0) {
            $.each(data, function (key, item) {
              $component.append($('<option value="' + item.value + '">' + item.name + '</option>'));
            });
            $component.enableSelect();
            if (data.length == 1) $component.selectpicker('val', data[0].value);
          } else {
            $component.disableSelect();
          }
        }).fail(function () {
          $component.disableSelect();
        }).always(function () {
          $component.closest(".form-group").stopLoading();
          o.save();
        });
      } else {
        $component.empty();
        $component.disableSelect();
        o.save();
      }
    };

    o.toggleAdreca = function (codigoMunicipio) {
      //al('toggleAdreca');
      if (codigoMunicipio == o.currentMunicipi) {
        o.freeAddress = false;
        $('.adreca_lliure').hide();
        $('.adreca_codificada').show();
      } else {
        o.freeAddress = true;
        $('.adreca_lliure').show();
        $('.adreca_codificada').hide();
      }

      o.save();
    };

    o.refreshAll = function (lletres) {
      var carrerval = o.$carrer.closest('.form-group').find('input[type=hidden]').val();
      var numero = o.$numeros.val();
      if (lletres) o.refreshLletres(carrerval, numero);
      o.refreshEscales(carrerval, numero);
      o.refreshPlantes(carrerval, numero);
      o.refreshCodispostals(carrerval, numero);
      o.refreshPortes(carrerval, numero);
    };

    o.init = function () {
      o.refreshPaisos(); //o.toggleAdreca(false);

      o.$paises.on('change', function () {
        o.refreshProvincies();
      });
      o.$provincies.on('change', function () {
        o.refreshMunicipis($(this).val());
      });
      o.$municipis.on('change', function () {
        o.toggleAdreca($(this).val());
      });
      o.$carrer.bind('typeahead:select', function (ev, suggestion) {
        var carrerval = suggestion.value;
        o.refreshNumeros(carrerval);
        o.refreshBlocs(carrerval);
        o.refreshEscales(carrerval);
        o.refreshLletres(carrerval);
        o.refreshPlantes(carrerval);
        o.refreshPortes(carrerval);
        o.refreshCodispostals(carrerval);
        o.$km.val('');
      });
      o.$numeros.on('change', function () {
        o.refreshAll(true);
      });
      o.$blocs.on('change', function () {
        o.refreshAll(true);
      });
      o.$plantes.on('change', function () {
        var carrerval = o.$carrer.closest('.form-group').find('input[type=hidden]').val(); //al(o.$numero);

        var numero = o.$numeros.val();
        var planta = $(this).val();
        o.refreshPortes(carrerval, numero, planta);
        o.save();
      });
      o.$portes.on('change', function () {
        o.save();
      });
      o.$lletres.on('change', function () {
        o.refreshAll(false);
      });
      o.$escales.on('change', function () {
        o.save();
      });
      o.$codispostals.on('change', function () {
        o.save();
      });
      o.$adreca.on('keyup', function () {
        o.save();
      });
      o.$km.on('keyup', function () {
        o.save();
      });
    };

    o.init();
  });
};

$(window).on('load', function () {
  //alert("VAMOS");
  $(".vialer-container").initVialerField();
});

/***/ }),

/***/ "./src/resources/assets/js/accede.js":
/*!*******************************************!*\
  !*** ./src/resources/assets/js/accede.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./accede-vialer */ "./src/resources/assets/js/accede-vialer.js");

/***/ }),

/***/ "./src/resources/assets/sass/accede.scss":
/*!***********************************************!*\
  !*** ./src/resources/assets/sass/accede.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************************************!*\
  !*** multi ./src/resources/assets/js/accede.js ./src/resources/assets/sass/accede.scss ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\tmedrano\DEVELOP\xampp\htdocs\laravel\packages\ajtarragona\accede-client\src\resources\assets\js\accede.js */"./src/resources/assets/js/accede.js");
module.exports = __webpack_require__(/*! C:\Users\tmedrano\DEVELOP\xampp\htdocs\laravel\packages\ajtarragona\accede-client\src\resources\assets\sass\accede.scss */"./src/resources/assets/sass/accede.scss");


/***/ })

/******/ });