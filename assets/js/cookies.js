function compruebaAceptaCookies(){"true"!=localStorage.aceptaCookies?(cajacookies.style.display="block",$("#scrollUp").css("margin-bottom","100px")):$(".bigCookieContainer").hide()}function aceptarCookies(){localStorage.aceptaCookies="true",cajacookies.style.display="none",$("#scrollUp").css("margin-bottom","0px"),$(".bigCookieContainer").hide()}$(document).ready(function(){compruebaAceptaCookies()});