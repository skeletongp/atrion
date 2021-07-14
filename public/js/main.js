/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
window.addEventListener('load', function () {
  var isChecked = true;
  ;
  /* Controles del menú */

  $("#leftside-navigation .sub-menu > a").click(function (e) {
    $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(), e.stopPropagation();
  });
  $("#leftside-navigation .sub-menu2 > a").click(function (e) {
    $('#ul_sub').toggle('', false);
    e.stopPropagation();
  });
  $('#input-menu').on('change', function () {
    $('#lb-open').toggle('', false);
    $('#lb-close').toggle('', false);
    $('#sidebar').toggle('', false);
    isChecked = $('#input-menu').prop('checked');
  });

  if ($(window).width() < 770 && isChecked) {
    $('#lb-close').trigger('click');
  }

  $(window).resize(function () {
    if ($(window).width() < 770 && isChecked) {
      $('#lb-close').trigger('click');
    }

    if ($(window).width() > 770 && !isChecked) {
      $('#lb-open').trigger('click');
    }
  });
  /* Función para cerrar sesión */

  var button = document.getElementById('sub2');

  button.onclick = function () {
    document.getElementById("form2").submit();
  };
  /* Cerrar el menú al hacer click fuera de él */


  $('#main').on('click', function () {
    if (isChecked && $(window).width() < 770) {
      $('#lb-close').trigger('click');
    }
  });
  $('header').on('click', function () {
    if (isChecked && $(window).width() < 770) {
      $('#lb-close').trigger('click');
    }
  });
  /* Efectos visuales de añadir usuario */

  $('#btn-adduser').click(function () {
    $('#div-table').toggle('', false);
    $('#div-links').toggle('', false);
    $('#div-form').toggle('', false);
    $('#div-title').toggle('', false);
    $('#div-botones').toggleClass('w-full');
    $('#div-user').toggle('', false);
    $('#sp-plus').toggleClass('fa-plus fa-times');
  });
  /* Efetos visuales de añadir producto */

  $('#btn-add-product').click(function () {
    $('#div-table-product').toggle('', false);
    $('#div-add-product').toggle('', false);
    $('#sp-plus-product').toggleClass('fa-plus fa-times', 100);
  });
  /* Efectos visuales de añadir sucursal */

  $('#sp-add-place').click(function () {
    $('#div-places').toggle('', false);
    $('#div-add').toggle('', false);
    $('#sp-add-place').toggleClass('fa-plus fa-times', 300);
  });
  /* Desaparecer mensaje de éxito */

  Livewire.on('toggle-add-product', function () {
    try {
      $('.sp_product_added').toggle('', false);
    } catch (error) {
      console.log(error);
    }
  });
  /* Efectos visuales de la Client Card */

  $('#sp-client-invoices').click(function () {
    $('#div-client-invoices').toggle('', false);
    $('#sp-client-invoices').toggleClass('fa-eye fa-eye-slash', 400);
  });
  $('#btn-edit-client').click(function () {
    $('#div-edit').toggle('', false);
    $('#div-profile').toggle('', false);
    $('#sp-edit').toggleClass('fa-pen fa-times');

    if (!$('#div-account').is(':hidden')) {
      $('#div-account').toggle('', false);
    }

    if (!$('#div-invoices').is(':hidden')) {
      $('#div-invoices').toggle('', false);
    }
  });
  /* Submit el formm de buscar al limpiarlo */

  search = document.getElementsByName('search');
  search.forEach(function (input) {
    input.addEventListener('search', function () {
      $('#form-search').trigger('submit');
    });
  });
});
/******/ })()
;