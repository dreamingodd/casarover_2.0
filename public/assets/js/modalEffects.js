"use strict";var ModalEffects=function(){function e(){var e=document.querySelector(".md-overlay");[].slice.call(document.querySelectorAll(".md-trigger")).forEach(function(t,c){function n(e){classie.remove(s,"md-show"),e&&classie.remove(document.documentElement,"md-perspective")}function o(){n(classie.has(t,"md-setperspective"))}var s=document.querySelector("#"+t.getAttribute("data-modal")),i=s.querySelector(".md-close");t.addEventListener("click",function(c){classie.add(s,"md-show"),e.removeEventListener("click",o),e.addEventListener("click",o),classie.has(t,"md-setperspective")&&setTimeout(function(){classie.add(document.documentElement,"md-perspective")},25)}),i.addEventListener("click",function(e){e.stopPropagation(),o()})})}e()}();