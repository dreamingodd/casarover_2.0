webpackJsonp([0,1],[,function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e,n){var r=n(24)("wks"),i=n(15),o=n(1).Symbol,s="function"==typeof o,u=t.exports=function(t){return r[t]||(r[t]=s&&o[t]||(s?o:i)("Symbol."+t))};u.store=r},function(t,e){var n=t.exports={version:"2.4.0"};"number"==typeof __e&&(__e=n)},function(t,e,n){t.exports=!n(10)(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a})},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e,n){var r=n(9),i=n(31),o=n(26),s=Object.defineProperty;e.f=n(4)?Object.defineProperty:function(t,e,n){if(r(t),e=o(e,!0),r(n),i)try{return s(t,e,n)}catch(u){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e,n){var r=n(80),i=n(17);t.exports=function(t){return r(i(t))}},function(t,e,n){var r=n(6),i=n(14);t.exports=n(4)?function(t,e,n){return r.f(t,e,i(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e,n){var r=n(11);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e){t.exports=function(t){try{return!!t()}catch(e){return!0}}},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e){t.exports={}},function(t,e,n){var r=n(36),i=n(18);t.exports=Object.keys||function(t){return r(t,i)}},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e,n){var r=n(1),i=n(3),o=n(77),s=n(8),u="prototype",a=function(t,e,n){var c,f,l,d=t&a.F,h=t&a.G,p=t&a.S,v=t&a.P,g=t&a.B,y=t&a.W,m=h?i:i[e]||(i[e]={}),x=m[u],_=h?r:p?r[e]:(r[e]||{})[u];h&&(n=e);for(c in n)f=!d&&_&&void 0!==_[c],f&&c in m||(l=f?_[c]:n[c],m[c]=h&&"function"!=typeof _[c]?n[c]:g&&f?o(l,r):y&&_[c]==l?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e[u]=t[u],e}(l):v&&"function"==typeof l?o(Function.call,l):l,v&&((m.virtual||(m.virtual={}))[c]=l,t&a.R&&x&&!x[c]&&s(x,c,l)))};a.F=1,a.G=2,a.S=4,a.P=8,a.B=16,a.W=32,a.U=64,a.R=128,t.exports=a},function(t,e){t.exports=!0},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){var r=n(6).f,i=n(5),o=n(2)("toStringTag");t.exports=function(t,e,n){t&&!i(t=n?t:t.prototype,o)&&r(t,o,{configurable:!0,value:e})}},function(t,e,n){var r=n(24)("keys"),i=n(15);t.exports=function(t){return r[t]||(r[t]=i(t))}},function(t,e,n){var r=n(1),i="__core-js_shared__",o=r[i]||(r[i]={});t.exports=function(t){return o[t]||(o[t]={})}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e,n){var r=n(11);t.exports=function(t,e){if(!r(t))return t;var n,i;if(e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;if("function"==typeof(n=t.valueOf)&&!r(i=n.call(t)))return i;if(!e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;throw TypeError("Can't convert object to primitive value")}},function(t,e,n){var r=n(1),i=n(3),o=n(20),s=n(28),u=n(6).f;t.exports=function(t){var e=i.Symbol||(i.Symbol=o?{}:r.Symbol||{});"_"==t.charAt(0)||t in e||u(e,t,{value:s.f(t)})}},function(t,e,n){e.f=n(2)},,function(t,e,n){var r=n(11),i=n(1).document,o=r(i)&&r(i.createElement);t.exports=function(t){return o?i.createElement(t):{}}},function(t,e,n){t.exports=!n(4)&&!n(10)(function(){return 7!=Object.defineProperty(n(30)("div"),"a",{get:function(){return 7}}).a})},function(t,e,n){"use strict";var r=n(20),i=n(19),o=n(37),s=n(8),u=n(5),a=n(12),c=n(82),f=n(22),l=n(89),d=n(2)("iterator"),h=!([].keys&&"next"in[].keys()),p="@@iterator",v="keys",g="values",y=function(){return this};t.exports=function(t,e,n,m,x,_,A){c(n,e,m);var b,w,k,O=function(t){if(!h&&t in C)return C[t];switch(t){case v:return function(){return new n(this,t)};case g:return function(){return new n(this,t)}}return function(){return new n(this,t)}},B=e+" Iterator",j=x==g,S=!1,C=t.prototype,E=C[d]||C[p]||x&&C[x],M=E||O(x),T=x?j?O("entries"):M:void 0,P="Array"==e?C.entries||E:E;if(P&&(k=l(P.call(new t)),k!==Object.prototype&&(f(k,B,!0),r||u(k,d)||s(k,d,y))),j&&E&&E.name!==g&&(S=!0,M=function(){return E.call(this)}),r&&!A||!h&&!S&&C[d]||s(C,d,M),a[e]=M,a[B]=y,x)if(b={values:j?M:O(g),keys:_?M:O(v),entries:T},A)for(w in b)w in C||o(C,w,b[w]);else i(i.P+i.F*(h||S),e,b);return b}},function(t,e,n){var r=n(9),i=n(86),o=n(18),s=n(23)("IE_PROTO"),u=function(){},a="prototype",c=function(){var t,e=n(30)("iframe"),r=o.length,i="<",s=">";for(e.style.display="none",n(79).appendChild(e),e.src="javascript:",t=e.contentWindow.document,t.open(),t.write(i+"script"+s+"document.F=Object"+i+"/script"+s),t.close(),c=t.F;r--;)delete c[a][o[r]];return c()};t.exports=Object.create||function(t,e){var n;return null!==t?(u[a]=r(t),n=new u,u[a]=null,n[s]=t):n=c(),void 0===e?n:i(n,e)}},function(t,e,n){var r=n(36),i=n(18).concat("length","prototype");e.f=Object.getOwnPropertyNames||function(t){return r(t,i)}},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e,n){var r=n(5),i=n(7),o=n(75)(!1),s=n(23)("IE_PROTO");t.exports=function(t,e){var n,u=i(t),a=0,c=[];for(n in u)n!=s&&r(u,n)&&c.push(n);for(;e.length>a;)r(u,n=e[a++])&&(~o(c,n)||c.push(n));return c}},function(t,e,n){t.exports=n(8)},function(t,e,n){"use strict";var r=n(90)(!0);n(32)(String,"String",function(t){this._t=String(t),this._i=0},function(){var t,e=this._t,n=this._i;return n>=e.length?{value:void 0,done:!0}:(t=r(e,n),this._i+=t.length,{value:t,done:!1})})},function(t,e,n){n(96);for(var r=n(1),i=n(8),o=n(12),s=n(2)("toStringTag"),u=["NodeList","DOMTokenList","MediaList","StyleSheetList","CSSRuleList"],a=0;a<5;a++){var c=u[a],f=r[c],l=f&&f.prototype;l&&!l[s]&&i(l,s,c),o[c]=o.Array}},,,,function(t,e,n){t.exports="function"==typeof Array.from?Array.from:n(44)},function(t,e){t.exports=function(){var t=function(t){return"function"==typeof t},e=function(t){var e=Number(t);return isNaN(e)?0:0!==e&&isFinite(e)?(e>0?1:-1)*Math.floor(Math.abs(e)):e},n=Math.pow(2,53)-1,r=function(t){var r=e(t);return Math.min(Math.max(r,0),n)},i=function(t){if(null!=t){if(["string","number","boolean","symbol"].indexOf(typeof t)>-1)return Symbol.iterator;if("undefined"!=typeof Symbol&&"iterator"in Symbol&&Symbol.iterator in t)return Symbol.iterator;if("@@iterator"in t)return"@@iterator"}},o=function(e,n){if(null!=e&&null!=n){var r=e[n];if(null==r)return;if(!t(r))throw new TypeError(r+" is not a function");return r}},s=function(t){var e=t.next(),n=Boolean(e.done);return!n&&e};return function(e){"use strict";var n,u=this,a=arguments.length>1?arguments[1]:void 0;if("undefined"!=typeof a){if(!t(a))throw new TypeError("Array.from: when provided, the second argument must be a function");arguments.length>2&&(n=arguments[2])}var c,f,l=o(e,i(e));if(void 0!==l){c=t(u)?Object(new u):[];var d=l.call(e);if(null==d)throw new TypeError("Array.from requires an array-like or iterable object");f=0;for(var h,p;;){if(h=s(d),!h)return c.length=f,c;p=h.value,a?c[f]=a.call(n,p,f):c[f]=p,f++}}else{var v=Object(e);if(null==e)throw new TypeError("Array.from requires an array-like object - not null or undefined");var g=r(v.length);c=t(u)?Object(new u(g)):new Array(g),f=0;for(var y;f<g;)y=v[f],a?c[f]=a.call(n,y,f):c[f]=y,f++;c.length=g}return c}}()},,function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var i=n(60),o=r(i),s=n(65),u=r(s),a=n(66),c=r(a),f=n(43),l=r(f),d=n(118),h=r(d),p=function(){function t(e){if((0,u["default"])(this,t),this._default={container:".vux-swiper",item:".vux-swiper-item",direction:"vertical",activeClass:"active",threshold:50,duration:300,auto:!1,loop:!1,interval:3e3,height:"auto",minMovingDistance:0},this._options=(0,h["default"])(this._default,e),this._options.height=this._options.height.replace("px",""),this._start={},this._move={},this._end={},this._eventHandlers={},this._prev=this._current=this._goto=0,this._width=this._height=this._distance=0,this._offset=[],this.$box=this._options.container,this.$container=this._options.container.querySelector(".vux-swiper"),this.$items=this.$container.querySelectorAll(this._options.item),this.count=this.$items.length,this._position=[],this._firstItemIndex=0,this.count)return this._init(),this._auto(),this._bind(),this._onResize(),this}return(0,c["default"])(t,[{key:"_auto",value:function(){var t=this;t.stop(),t._options.auto&&(t.timer=setTimeout(function(){t.next()},t._options.interval))}},{key:"updateItemWidth",value:function(){this._width=this.$box.offsetWidth,this._distance="horizontal"===this._options.direction?this._width:this._height}},{key:"stop",value:function(){this.timer&&clearTimeout(this.timer)}},{key:"_loop",value:function(){return this._options.loop&&this.count>=3}},{key:"_onResize",value:function(){var t=this;this.resizeHandler=function(){setTimeout(function(){t.updateItemWidth();var e=t._getZeroIndexByPosition();t._initOffset(e),t._setTransfrom()},100)},window.addEventListener("orientationchange",this.resizeHandler,!1)}},{key:"_init",value:function(){this._height="auto"===this._options.height?"auto":this._options.height-0,this.updateItemWidth(),this._initPosition(),this._activate(this._current),this._initOffset(),this._setTransfrom(),this._loop()&&this._loopRender()}},{key:"_initPosition",value:function(){for(var t=0;t<this.count;t++)this._position.push(t)}},{key:"_movePosition",value:function(t){var e=this;if(t>0){var n=e._position.splice(0,1);e._position.push(n[0])}else if(t<0){var r=e._position.pop();e._position.unshift(r)}}},{key:"_initOffset",value:function(t){t=t||0;for(var e=0;e<this.count;e++)this._offset[e]=(e-t)*this._distance}},{key:"_moveOffset",value:function(t){t=t||0;for(var e=0;e<this.count;e++)this._offset[e]=this._offset[e]+t*this._distance}},{key:"_setTransition",value:function(t){t=t||this._options.duration||"none";var e="none"===t?"none":t+"ms";(0,l["default"])(this.$items).forEach(function(t,n){t.style.webkitTransition=e,t.style.transition=e})}},{key:"_setTransfrom",value:function(t){var e=this;t=t||0,(0,l["default"])(e.$items).forEach(function(n,r){var i=e._offset[r]+t,o="translate3d("+i+"px, 0, 0)";"vertical"===e._options.direction&&(o="translate3d(0, "+i+"px, 0)"),n.style.webkitTransform=o,n.style.transform=o})}},{key:"_bind",value:function(){var t=this;t.touchstartHandler=function(e){t.stop(),t._start.x=e.changedTouches[0].pageX,t._start.y=e.changedTouches[0].pageY,t._setTransition("none")},t.touchmoveHandler=function(e){t._move.x=e.changedTouches[0].pageX,t._move.y=e.changedTouches[0].pageY;var n=t._move.x-t._start.x,r=t._move.y-t._start.y,i=r,o=Math.abs(n)>Math.abs(r);"horizontal"===t._options.direction&&o&&(i=n),(t._options.minMovingDistance&&Math.abs(i)>=t._options.minMovingDistance||!t._options.minMovingDistance)&&o&&t._setTransfrom(i),o&&e.preventDefault()},t.touchendHandler=function(e){t._end.x=e.changedTouches[0].pageX,t._end.y=e.changedTouches[0].pageY;var n=t._end.y-t._start.y;"horizontal"===t._options.direction&&(n=t._end.x-t._start.x),n=t.getDistance(n),0!==n&&t._options.minMovingDistance&&Math.abs(n)<t._options.minMovingDistance||(n>t._options.threshold?t.move(-1):n<-t._options.threshold?t.move(1):t.move(0),t._loopRender())},t.transitionEndHandler=function(e){t._activate(t._current);var n=t._eventHandlers.swiped;n&&n.apply(t,[t._prev,t._current]),t._auto(),t._loopRender(),e.preventDefault()},t.$container.addEventListener("touchstart",t.touchstartHandler,!1),t.$container.addEventListener("touchmove",t.touchmoveHandler,!1),t.$container.addEventListener("touchend",t.touchendHandler,!1),t.$items[1]&&t.$items[1].addEventListener("webkitTransitionEnd",t.transitionEndHandler,!1)}},{key:"_loopRender",value:function(){var t=this;if(t._loop())if(0===t._offset[t._offset.length-1]){var e=t.$items[0].cloneNode(!0);t.$container.appendChild(e),t.$container.removeChild(t.$items[0]),t._loopEvent(1)}else if(0===t._offset[0]){var n=t.$items[t.$items.length-1].cloneNode(!0);t.$container.insertBefore(n,t.$container.firstChild),t.$container.removeChild(t.$items[t.$items.length-1]),t._loopEvent(-1)}}},{key:"_loopEvent",value:function(t){var e=this;e._itemDestoy(),e.$items=e.$container.querySelectorAll(e._options.item),e.$items[1]&&e.$items[1].addEventListener("webkitTransitionEnd",e.transitionEndHandler,!1),e._movePosition(t),e._moveOffset(t),e._setTransfrom()}},{key:"getDistance",value:function(t){return this._loop()?t:t>0&&0===this._current?0:t<0&&this._current===this.count-1?0:t}},{key:"_moveIndex",value:function(t){this._prev=this._current,this._current+=t,this._current%=this.count,this._current=this._current<0?this.count+this._current:this._current}},{key:"_activate",value:function(t){var e=this,n=this._options.activeClass;Array.prototype.forEach.call(this.$items,function(r,i){r.classList.remove(n),t===e._position[i]&&r.classList.add(n)})}},{key:"_getZeroIndexByPosition",value:function(){for(var t=0;t<this._position.length;t++){if(0===this._position[t])return t;if(t===this._position.length-1)return-1}}},{key:"_goOffset",value:function(t){t=t||0,t%=this.count;for(var e=this,n=e._getZeroIndexByPosition(),r=0;r<e._offset.length;r++)if(0===e._offset[r])return n-r}},{key:"go",value:function(t){var e=this;if(e.stop(),e._loop()){var n=e._goOffset(t);e._moveOffset(-n),e._moveIndex(n),e._setTransition(),e._setTransfrom()}else{if(t<0||t>e.count-1||t===e._current)return;e._prev=e._current,e._current=t;for(var r=-(t-e._prev)*e._distance,i=0;i<e._offset.length;i++)e._offset[i]=e._offset[i]+r;e._setTransition(),e._setTransfrom()}return e._auto(),this}},{key:"next",value:function(){var t=this;if(t._loop())t.move(1);else{var e=t._current;e=e===t.count-1?0:e+1,t.go(e)}return this}},{key:"move",value:function(t,e){var n=this;return n._moveOffset(-t),n._movePosition(-t),n._moveIndex(t),n._setTransition(e?"none":void 0),n._setTransfrom(),this}},{key:"on",value:function(t,e){return this._eventHandlers[t]&&console.error("[swiper] event "+t+" is already register"),"function"!=typeof e&&console.error("[swiper] parameter callback must be a function"),this._eventHandlers[t]=e,this}},{key:"_itemDestoy",value:function(){var t=!0,e=!1,n=void 0;try{for(var r,i=(0,o["default"])(this.$items);!(t=(r=i.next()).done);t=!0){var s=r.value;s.removeEventListener("webkitTransitionEnd",this.transitionEndHandler,!1)}}catch(u){e=!0,n=u}finally{try{!t&&i["return"]&&i["return"]()}finally{if(e)throw n}}}},{key:"destroy",value:function(){this.stop(),this._current=0,this._setTransfrom(0),window.removeEventListener("orientationchange",this.resizeHandler,!1),this.$container.removeEventListener("touchstart",this.touchstartHandler,!1),this.$container.removeEventListener("touchmove",this.touchmoveHandler,!1),this.$container.removeEventListener("touchend",this.touchendHandler,!1),this._itemDestoy()}}]),t}();e["default"]=p},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function i(t,e){if(!/^javas/.test(t)&&t){var n="object"===("undefined"==typeof t?"undefined":(0,u["default"])(t))||e&&"string"==typeof t&&!/http/.test(t);n?e.go(t):window.location.href=t}}function o(t,e){return!e||e._history||"string"!=typeof t||/http/.test(t)?t&&"object"!==("undefined"==typeof t?"undefined":(0,u["default"])(t))?t:"javascript:void(0);":"#!"+t}Object.defineProperty(e,"__esModule",{value:!0});var s=n(67),u=r(s);e.go=i,e.getUrl=o},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var i=n(61),o=r(i),s=n(46),u=r(s),a=n(47);e["default"]={ready:function(){this.list&&0===this.list.length||this.render(),this.xheight=this.getHeight()},methods:{clickListItem:function(t){(0,a.go)(t.url,this.$router),this.$emit("on-click-list-item",JSON.parse((0,o["default"])(t)))},buildBackgroundUrl:function(t){return"url("+t+")"},render:function(){var t=this;this.swiper=new u["default"]({container:this.$el,direction:this.direction,auto:this.auto,loop:this.loop,interval:this.interval,threshold:this.threshold,duration:this.duration,height:this.height||this._height,minMovingDistance:this.minMovingDistance,imgList:this.imgList}).on("swiped",function(e,n){t.current=n,t.index=n})},rerender:function(){var t=this;this.$el&&this.$nextTick(function(){t.index=0,t.current=0,t.length=t.list.length||t.$children.length,t.destroy(),t.render()})},destroy:function(){this.swiper&&this.swiper.destroy()},getHeight:function(){var t=parseInt(this.height,10);return t?this.height:t?void 0:this.aspectRatio?this.$el.offsetWidth*this.aspectRatio+"px":"180px"}},props:{list:{type:Array,"default":function(){return[]}},direction:{type:String,"default":"horizontal"},showDots:{type:Boolean,"default":!0},dotsPosition:{type:String,"default":"right"},dotsClass:String,auto:{type:Boolean,"default":!1},loop:Boolean,interval:{type:Number,"default":3e3},threshold:{type:Number,"default":50},duration:{type:Number,"default":300},height:{type:String,"default":"auto"},aspectRatio:Number,minMovingDistance:{type:Number,"default":0},index:{type:Number,"default":0}},data:function(){return{current:this.index,xheight:"auto",length:this.list.length}},watch:{list:function(t){this.rerender()},current:function(t){this.$emit("on-index-change",t)},index:function(t){var e=this;t!==this.current&&this.$nextTick(function(){e.swiper.go(t)})}},beforeDestroy:function(){this.destroy()}}},,,,,,,function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var i=n(144),o=r(i);e["default"]={data:function(){return{slide:[],areas:[]}},created:function(){this.getinfo()},methods:{getinfo:function(){var t=this;this.$http.get("/m/home/").then(function(e){0===e.json().code?(t.$set("areas",e.json().result.areas),t.$set("slide",e.json().result.slides)):console.log(e)})}},components:{banner:n(29),swiper:o["default"]}}},,,,,function(t,e,n){t.exports={"default":n(68),__esModule:!0}},function(t,e,n){t.exports={"default":n(69),__esModule:!0}},function(t,e,n){t.exports={"default":n(70),__esModule:!0}},function(t,e,n){t.exports={"default":n(71),__esModule:!0}},function(t,e,n){t.exports={"default":n(72),__esModule:!0}},function(t,e){"use strict";e.__esModule=!0,e["default"]=function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}e.__esModule=!0;var i=n(62),o=r(i);e["default"]=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),(0,o["default"])(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}()},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}e.__esModule=!0;var i=n(64),o=r(i),s=n(63),u=r(s),a="function"==typeof u["default"]&&"symbol"==typeof o["default"]?function(t){return typeof t}:function(t){return t&&"function"==typeof u["default"]&&t.constructor===u["default"]?"symbol":typeof t};e["default"]="function"==typeof u["default"]&&"symbol"===a(o["default"])?function(t){return"undefined"==typeof t?"undefined":a(t)}:function(t){return t&&"function"==typeof u["default"]&&t.constructor===u["default"]?"symbol":"undefined"==typeof t?"undefined":a(t)}},function(t,e,n){n(39),n(38),t.exports=n(95)},function(t,e,n){var r=n(3),i=r.JSON||(r.JSON={stringify:JSON.stringify});t.exports=function(t){return i.stringify.apply(i,arguments)}},function(t,e,n){n(97);var r=n(3).Object;t.exports=function(t,e,n){return r.defineProperty(t,e,n)}},function(t,e,n){n(99),n(98),n(100),n(101),t.exports=n(3).Symbol},function(t,e,n){n(38),n(39),t.exports=n(28).f("iterator")},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e){t.exports=function(){}},function(t,e,n){var r=n(7),i=n(92),o=n(91);t.exports=function(t){return function(e,n,s){var u,a=r(e),c=i(a.length),f=o(s,c);if(t&&n!=n){for(;c>f;)if(u=a[f++],u!=u)return!0}else for(;c>f;f++)if((t||f in a)&&a[f]===n)return t||f||0;return!t&&-1}}},function(t,e,n){var r=n(16),i=n(2)("toStringTag"),o="Arguments"==r(function(){return arguments}()),s=function(t,e){try{return t[e]}catch(n){}};t.exports=function(t){var e,n,u;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(n=s(e=Object(t),i))?n:o?r(e):"Object"==(u=r(e))&&"function"==typeof e.callee?"Arguments":u}},function(t,e,n){var r=n(73);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,i){return t.call(e,n,r,i)}}return function(){return t.apply(e,arguments)}}},function(t,e,n){var r=n(13),i=n(35),o=n(21);t.exports=function(t){var e=r(t),n=i.f;if(n)for(var s,u=n(t),a=o.f,c=0;u.length>c;)a.call(t,s=u[c++])&&e.push(s);return e}},function(t,e,n){t.exports=n(1).document&&document.documentElement},function(t,e,n){var r=n(16);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e,n){var r=n(16);t.exports=Array.isArray||function(t){return"Array"==r(t)}},function(t,e,n){"use strict";var r=n(33),i=n(14),o=n(22),s={};n(8)(s,n(2)("iterator"),function(){return this}),t.exports=function(t,e,n){t.prototype=r(s,{next:i(1,n)}),o(t,e+" Iterator")}},function(t,e){t.exports=function(t,e){return{value:e,done:!!t}}},function(t,e,n){var r=n(13),i=n(7);t.exports=function(t,e){for(var n,o=i(t),s=r(o),u=s.length,a=0;u>a;)if(o[n=s[a++]]===e)return n}},function(t,e,n){var r=n(15)("meta"),i=n(11),o=n(5),s=n(6).f,u=0,a=Object.isExtensible||function(){return!0},c=!n(10)(function(){return a(Object.preventExtensions({}))}),f=function(t){s(t,r,{value:{i:"O"+ ++u,w:{}}})},l=function(t,e){if(!i(t))return"symbol"==typeof t?t:("string"==typeof t?"S":"P")+t;if(!o(t,r)){if(!a(t))return"F";if(!e)return"E";f(t)}return t[r].i},d=function(t,e){if(!o(t,r)){if(!a(t))return!0;if(!e)return!1;f(t)}return t[r].w},h=function(t){return c&&p.NEED&&a(t)&&!o(t,r)&&f(t),t},p=t.exports={KEY:r,NEED:!1,fastKey:l,getWeak:d,onFreeze:h}},function(t,e,n){var r=n(6),i=n(9),o=n(13);t.exports=n(4)?Object.defineProperties:function(t,e){i(t);for(var n,s=o(e),u=s.length,a=0;u>a;)r.f(t,n=s[a++],e[n]);return t}},function(t,e,n){var r=n(21),i=n(14),o=n(7),s=n(26),u=n(5),a=n(31),c=Object.getOwnPropertyDescriptor;e.f=n(4)?c:function(t,e){if(t=o(t),e=s(e,!0),a)try{return c(t,e)}catch(n){}if(u(t,e))return i(!r.f.call(t,e),t[e])}},function(t,e,n){var r=n(7),i=n(34).f,o={}.toString,s="object"==typeof window&&window&&Object.getOwnPropertyNames?Object.getOwnPropertyNames(window):[],u=function(t){try{return i(t)}catch(e){return s.slice()}};t.exports.f=function(t){return s&&"[object Window]"==o.call(t)?u(t):i(r(t))}},function(t,e,n){var r=n(5),i=n(93),o=n(23)("IE_PROTO"),s=Object.prototype;t.exports=Object.getPrototypeOf||function(t){return t=i(t),r(t,o)?t[o]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?s:null}},function(t,e,n){var r=n(25),i=n(17);t.exports=function(t){return function(e,n){var o,s,u=String(i(e)),a=r(n),c=u.length;return a<0||a>=c?t?"":void 0:(o=u.charCodeAt(a),o<55296||o>56319||a+1===c||(s=u.charCodeAt(a+1))<56320||s>57343?t?u.charAt(a):o:t?u.slice(a,a+2):(o-55296<<10)+(s-56320)+65536)}}},function(t,e,n){var r=n(25),i=Math.max,o=Math.min;t.exports=function(t,e){return t=r(t),t<0?i(t+e,0):o(t,e)}},function(t,e,n){var r=n(25),i=Math.min;t.exports=function(t){return t>0?i(r(t),9007199254740991):0}},function(t,e,n){var r=n(17);t.exports=function(t){return Object(r(t))}},function(t,e,n){var r=n(76),i=n(2)("iterator"),o=n(12);t.exports=n(3).getIteratorMethod=function(t){if(void 0!=t)return t[i]||t["@@iterator"]||o[r(t)]}},function(t,e,n){var r=n(9),i=n(94);t.exports=n(3).getIterator=function(t){var e=i(t);if("function"!=typeof e)throw TypeError(t+" is not iterable!");return r(e.call(t))}},function(t,e,n){"use strict";var r=n(74),i=n(83),o=n(12),s=n(7);t.exports=n(32)(Array,"Array",function(t,e){this._t=s(t),this._i=0,this._k=e},function(){var t=this._t,e=this._k,n=this._i++;return!t||n>=t.length?(this._t=void 0,i(1)):"keys"==e?i(0,n):"values"==e?i(0,t[n]):i(0,[n,t[n]])},"values"),o.Arguments=o.Array,r("keys"),r("values"),r("entries")},function(t,e,n){var r=n(19);r(r.S+r.F*!n(4),"Object",{defineProperty:n(6).f})},function(t,e){},function(t,e,n){"use strict";var r=n(1),i=n(5),o=n(4),s=n(19),u=n(37),a=n(85).KEY,c=n(10),f=n(24),l=n(22),d=n(15),h=n(2),p=n(28),v=n(27),g=n(84),y=n(78),m=n(81),x=n(9),_=n(7),A=n(26),b=n(14),w=n(33),k=n(88),O=n(87),B=n(6),j=n(13),S=O.f,C=B.f,E=k.f,M=r.Symbol,T=r.JSON,P=T&&T.stringify,$="prototype",W=h("_hidden"),D=h("toPrimitive"),N={}.propertyIsEnumerable,I=f("symbol-registry"),F=f("symbols"),L=f("op-symbols"),H=Object[$],z="function"==typeof M,R=r.QObject,U=!R||!R[$]||!R[$].findChild,q=o&&c(function(){return 7!=w(C({},"a",{get:function(){return C(this,"a",{value:7}).a}})).a})?function(t,e,n){var r=S(H,e);r&&delete H[e],C(t,e,n),r&&t!==H&&C(H,e,r)}:C,Y=function(t){var e=F[t]=w(M[$]);return e._k=t,e},J=z&&"symbol"==typeof M.iterator?function(t){return"symbol"==typeof t}:function(t){return t instanceof M},X=function(t,e,n){return t===H&&X(L,e,n),x(t),e=A(e,!0),x(n),i(F,e)?(n.enumerable?(i(t,W)&&t[W][e]&&(t[W][e]=!1),n=w(n,{enumerable:b(0,!1)})):(i(t,W)||C(t,W,b(1,{})),t[W][e]=!0),q(t,e,n)):C(t,e,n)},G=function(t,e){x(t);for(var n,r=y(e=_(e)),i=0,o=r.length;o>i;)X(t,n=r[i++],e[n]);return t},K=function(t,e){return void 0===e?w(t):G(w(t),e)},Q=function(t){var e=N.call(this,t=A(t,!0));return!(this===H&&i(F,t)&&!i(L,t))&&(!(e||!i(this,t)||!i(F,t)||i(this,W)&&this[W][t])||e)},Z=function(t,e){if(t=_(t),e=A(e,!0),t!==H||!i(F,e)||i(L,e)){var n=S(t,e);return!n||!i(F,e)||i(t,W)&&t[W][e]||(n.enumerable=!0),n}},V=function(t){for(var e,n=E(_(t)),r=[],o=0;n.length>o;)i(F,e=n[o++])||e==W||e==a||r.push(e);return r},tt=function(t){for(var e,n=t===H,r=E(n?L:_(t)),o=[],s=0;r.length>s;)!i(F,e=r[s++])||n&&!i(H,e)||o.push(F[e]);return o};z||(M=function(){if(this instanceof M)throw TypeError("Symbol is not a constructor!");var t=d(arguments.length>0?arguments[0]:void 0),e=function(n){this===H&&e.call(L,n),i(this,W)&&i(this[W],t)&&(this[W][t]=!1),q(this,t,b(1,n))};return o&&U&&q(H,t,{configurable:!0,set:e}),Y(t)},u(M[$],"toString",function(){return this._k}),O.f=Z,B.f=X,n(34).f=k.f=V,n(21).f=Q,n(35).f=tt,o&&!n(20)&&u(H,"propertyIsEnumerable",Q,!0),p.f=function(t){return Y(h(t))}),s(s.G+s.W+s.F*!z,{Symbol:M});for(var et="hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables".split(","),nt=0;et.length>nt;)h(et[nt++]);for(var et=j(h.store),nt=0;et.length>nt;)v(et[nt++]);s(s.S+s.F*!z,"Symbol",{"for":function(t){return i(I,t+="")?I[t]:I[t]=M(t)},keyFor:function(t){if(J(t))return g(I,t);throw TypeError(t+" is not a symbol!")},useSetter:function(){U=!0},useSimple:function(){U=!1}}),s(s.S+s.F*!z,"Object",{create:K,defineProperty:X,defineProperties:G,getOwnPropertyDescriptor:Z,getOwnPropertyNames:V,getOwnPropertySymbols:tt}),T&&s(s.S+s.F*(!z||c(function(){var t=M();return"[null]"!=P([t])||"{}"!=P({a:t})||"{}"!=P(Object(t))})),"JSON",{stringify:function(t){if(void 0!==t&&!J(t)){for(var e,n,r=[t],i=1;arguments.length>i;)r.push(arguments[i++]);return e=r[1],"function"==typeof e&&(n=e),!n&&m(e)||(e=function(t,e){if(n&&(e=n.call(this,t,e)),!J(e))return e}),r[1]=e,P.apply(T,r)}}}),M[$][D]||n(8)(M[$],D,M[$].valueOf),l(M,"Symbol"),l(Math,"Math",!0),l(r.JSON,"JSON",!0)},function(t,e,n){n(27)("asyncIterator")},function(t,e,n){n(27)("observable")},function(t,e,n){e=t.exports=n(40)(),e.push([t.id,".vux-slider{overflow:hidden;position:relative}.vux-slider .vux-indicator-right,.vux-slider>.vux-indicator{position:absolute;right:15px;bottom:10px}.vux-slider .vux-indicator-right>a,.vux-slider>.vux-indicator>a{float:left;margin-left:6px}.vux-slider .vux-indicator-right>a>.vux-icon-dot,.vux-slider>.vux-indicator>a>.vux-icon-dot{display:inline-block;vertical-align:middle;width:6px;height:6px;border-radius:3px;background-color:#d0cdd1}.vux-slider .vux-indicator-right>a>.vux-icon-dot.active,.vux-slider>.vux-indicator>a>.vux-icon-dot.active{background-color:#04be02}.vux-slider>.vux-indicator-center{right:50%;-webkit-transform:translateX(50%);transform:translateX(50%)}.vux-slider>.vux-indicator-left{left:15px;right:auto}.vux-slider>.vux-swiper{overflow:hidden;position:relative}.vux-slider>.vux-swiper>.vux-swiper-item{position:absolute;top:0;left:0;width:100%;height:100%}.vux-slider>.vux-swiper>.vux-swiper-item>a{display:block;width:100%;height:100%}.vux-slider>.vux-swiper>.vux-swiper-item>a>.vux-img{display:block;width:100%;height:100%;background:50% no-repeat;background-size:cover}.vux-slider>.vux-swiper>.vux-swiper-item>a>.vux-swiper-desc{position:absolute;left:0;right:0;bottom:0;height:1.4em;font-size:16px;padding:20px 50px 12px 13px;margin:0;background-image:-webkit-linear-gradient(top,transparent,rgba(0,0,0,.7));background-image:linear-gradient(180deg,transparent 0,rgba(0,0,0,.7));color:#fff;text-shadow:0 1px 0 rgba(0,0,0,.5);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal}","",{version:3,sources:["/./node_modules/.npminstall/vux/0.1.3-rc9/vux/src/components/swiper/index.vue"],names:[],mappings:"AAAA,YAAY,gBAAgB,iBAAiB,CAAC,4DAA4D,kBAAkB,WAAW,WAAW,CAAC,gEAAgE,WAAW,eAAe,CAAC,4FAA4F,qBAAqB,sBAAsB,UAAU,WAAW,kBAAkB,wBAAwB,CAAC,0GAA0G,wBAAwB,CAAC,kCAAkC,UAAU,kCAAkC,yBAAyB,CAAC,gCAAgC,UAAU,UAAU,CAAC,wBAAwB,gBAAgB,iBAAiB,CAAC,yCAAyC,kBAAkB,MAAM,OAAO,WAAW,WAAW,CAAC,2CAA2C,cAAc,WAAW,WAAW,CAAC,oDAAoD,cAAc,WAAW,YAAY,yBAAmC,qBAAqB,CAAC,4DAA4D,kBAAkB,OAAO,QAAQ,SAAS,aAAa,eAAe,4BAA4B,SAAS,yEAAqF,sEAAmF,WAAW,mCAAoC,gBAAgB,uBAAuB,mBAAmB,gBAAgB,CAAC",file:"index.vue",sourcesContent:[".vux-slider{overflow:hidden;position:relative}.vux-slider>.vux-indicator,.vux-slider .vux-indicator-right{position:absolute;right:15px;bottom:10px}.vux-slider>.vux-indicator>a,.vux-slider .vux-indicator-right>a{float:left;margin-left:6px}.vux-slider>.vux-indicator>a>.vux-icon-dot,.vux-slider .vux-indicator-right>a>.vux-icon-dot{display:inline-block;vertical-align:middle;width:6px;height:6px;border-radius:3px;background-color:#d0cdd1}.vux-slider>.vux-indicator>a>.vux-icon-dot.active,.vux-slider .vux-indicator-right>a>.vux-icon-dot.active{background-color:#04BE02}.vux-slider>.vux-indicator-center{right:50%;-webkit-transform:translateX(50%);transform:translateX(50%)}.vux-slider>.vux-indicator-left{left:15px;right:auto}.vux-slider>.vux-swiper{overflow:hidden;position:relative}.vux-slider>.vux-swiper>.vux-swiper-item{position:absolute;top:0;left:0;width:100%;height:100%}.vux-slider>.vux-swiper>.vux-swiper-item>a{display:block;width:100%;height:100%}.vux-slider>.vux-swiper>.vux-swiper-item>a>.vux-img{display:block;width:100%;height:100%;background:center center no-repeat;background-size:cover}.vux-slider>.vux-swiper>.vux-swiper-item>a>.vux-swiper-desc{position:absolute;left:0;right:0;bottom:0;height:1.4em;font-size:16px;padding:20px 50px 12px 13px;margin:0;background-image:-webkit-linear-gradient(top, rgba(0,0,0,0) 0, rgba(0,0,0,0.7) 100%);background-image:linear-gradient(to bottom, rgba(0,0,0,0) 0, rgba(0,0,0,0.7) 100%);color:#fff;text-shadow:0 1px 0 rgba(0,0,0,0.5);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal}"],sourceRoot:"webpack://"}])},function(t,e,n){
e=t.exports=n(40)(),e.push([t.id,"nav[_v-0c50e06e]{overflow:hidden;margin-bottom:1rem}nav ul[_v-0c50e06e]{text-align:center}nav ul li[_v-0c50e06e]{width:48%;margin:.5rem 1%;height:3rem;line-height:3rem;float:left;list-style:none;font-size:16px;color:#fff;cursor:pointer}h2[_v-0c50e06e]{text-align:center;color:#666}.banner[_v-0c50e06e]{margin:.5rem 0}","",{version:3,sources:["/./src/views/index.vue"],names:[],mappings:"AAAA,iBAAiB,gBAAgB,kBAAkB,CAAC,oBAAoB,iBAAiB,CAAC,uBAAuB,UAAU,gBAAgB,YAAY,iBAAiB,WAAW,gBAAgB,eAAe,WAAW,cAAc,CAAC,gBAAgB,kBAAkB,UAAU,CAAC,qBAAqB,cAAc,CAAC",file:"index.vue",sourcesContent:["nav[_v-0c50e06e]{overflow:hidden;margin-bottom:1rem}nav ul[_v-0c50e06e]{text-align:center}nav ul li[_v-0c50e06e]{width:48%;margin:.5rem 1%;height:3rem;line-height:3rem;float:left;list-style:none;font-size:16px;color:#fff;cursor:pointer}h2[_v-0c50e06e]{text-align:center;color:#666}.banner[_v-0c50e06e]{margin:.5rem 0}"],sourceRoot:"webpack://"}])},function(t,e,n){var r=n(102);"string"==typeof r&&(r=[[t.id,r,""]]);n(42)(r,{});r.locals&&(t.exports=r.locals)},,,function(t,e,n){var r=n(103);"string"==typeof r&&(r=[[t.id,r,""]]);n(42)(r,{});r.locals&&(t.exports=r.locals)},,,,,,,,,,,function(t,e){"use strict";function n(t){if(null===t||void 0===t)throw new TypeError("Object.assign cannot be called with null or undefined");return Object(t)}function r(){try{if(!Object.assign)return!1;var t=new String("abc");if(t[5]="de","5"===Object.getOwnPropertyNames(t)[0])return!1;for(var e={},n=0;n<10;n++)e["_"+String.fromCharCode(n)]=n;var r=Object.getOwnPropertyNames(e).map(function(t){return e[t]});if("0123456789"!==r.join(""))return!1;var i={};return"abcdefghijklmnopqrst".split("").forEach(function(t){i[t]=t}),"abcdefghijklmnopqrst"===Object.keys(Object.assign({},i)).join("")}catch(o){return!1}}var i=Object.prototype.hasOwnProperty,o=Object.prototype.propertyIsEnumerable;t.exports=r()?Object.assign:function(t,e){for(var r,s,u=n(t),a=1;a<arguments.length;a++){r=Object(arguments[a]);for(var c in r)i.call(r,c)&&(u[c]=r[c]);if(Object.getOwnPropertySymbols){s=Object.getOwnPropertySymbols(r);for(var f=0;f<s.length;f++)o.call(r,s[f])&&(u[s[f]]=r[s[f]])}}return u}},function(t,e){t.exports=' <div class=vux-slider> <div class=vux-swiper :style="{height: xheight}"> <slot></slot> <div class=vux-swiper-item v-for="item in list" @click=clickListItem(item)> <a href=javascript:> <div class=vux-img :style="{backgroundImage: buildBackgroundUrl(item.img)}"></div> <p class=vux-swiper-desc>{{item.title}}</p> </a> </div> </div> <div :class="[dotsClass, \'vux-indicator\', \'vux-indicator-\' + dotsPosition]" v-show=showDots> <a href=javascript: v-for="key in length"> <i class=vux-icon-dot :class="{\'active\': key === current}"></i> </a> </div> </div> '},,,function(t,e){t.exports=' <div _v-0c50e06e=""> <swiper :list=slide :auto=true _v-0c50e06e=""></swiper> <nav class=navbar _v-0c50e06e=""> <ul _v-0c50e06e=""> <li v-link="{ name: \'allcasa\' }" style=background:#00CCFF _v-0c50e06e="">民宿大全</li> <li v-link="{ name: \'hotlists\' }" style=background:#C391E2 _v-0c50e06e="">民宿推荐</li> <li v-link="{ name: \'themes\' }" style=background:#87DB83 _v-0c50e06e="">精选主题</li> <li v-link="{ name: \'series\' }" style=background:#6699FF _v-0c50e06e="">探庐系列</li> </ul> </nav> <h2 _v-0c50e06e="">区域推荐</h2> <template v-for="banner in areas"> <banner v-link="{ name:\'area\',params:{id:banner.id}}" :banner=banner _v-0c50e06e=""></banner> </template> </div> '},,,,,,,,,,,,,,,,,function(t,e,n){var r,i;n(107),r=n(55),i=n(122),t.exports=r||{},t.exports.__esModule&&(t.exports=t.exports["default"]),i&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=i)},,,,,function(t,e,n){var r,i;n(104),r=n(48),i=n(119),t.exports=r||{},t.exports.__esModule&&(t.exports=t.exports["default"]),i&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=i)}]);
//# sourceMappingURL=0.b33c025acc5f60bd2bfe.js.map