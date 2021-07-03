/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/menu.js ***!
  \******************************/
window.addEventListener('load', function () {
  var isChecked = true;
  ;
  $("#leftside-navigation .sub-menu > a").click(function (e) {
    $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(), e.stopPropagation();
  });
  $('#input-menu').on('change', function () {
    $('#sp-menu').toggleClass('fa-bars fa-times-circle', 500);
    $('#lb-menu').toggleClass('left-48 left-4', 500);
    $('#sidebar').toggleClass('menu-close');
    isChecked = $('#input-menu').prop('checked');
  });

  if ($(window).width() < 770 && isChecked) {
    $('#lb-menu').trigger('click');
  }

  $(window).resize(function () {
    if ($(window).width() < 770 && isChecked) {
      $('#lb-menu').trigger('click');
    }
  });
  $('#main').on('click', function () {
    if (isChecked && $(window).width() < 770) {
      $('#lb-menu').trigger('click');
    }
  });
  $('header').on('click', function () {
    if (isChecked && $(window).width() < 770) {
      $('#lb-menu').trigger('click');
    }
  });
});
/******/ })()
;