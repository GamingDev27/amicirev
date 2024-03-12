/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/polling.js ***!
  \*********************************/
function refresh() {
  fetch('/verify-session').then(function (response) {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return response.json();
  }).then(function (data) {
    if (!data.isValidSession) {
      window.location.href = "/logout";
    }

    setTimeout(refresh, 60000);
  })["catch"](function (error) {
    console.error('Error:', error);
  });
}

setTimeout(refresh, 60000);
/******/ })()
;