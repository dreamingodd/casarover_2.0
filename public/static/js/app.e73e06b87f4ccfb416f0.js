webpackJsonp([1,0],[function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}var a=s(29),n=o(a),i=s(13),r=o(i),u=s(99),p=o(u),c=s(98),d=o(c),l=s(95),f=o(l),v=s(94),h=o(v),x=s(86),m=o(x),y=s(96),g=o(y),_=s(97),b=o(_),O=s(14),M=o(O);(0,n["default"])(M["default"]).forEach(function(t){return r["default"].filter(t,M["default"][t])}),r["default"].use(p["default"]),r["default"].use(d["default"]);var P=new p["default"]({linkActiveClass:"active"});P.map({"/":{component:f["default"]},"/list":{component:h["default"]},"/casa/:id":{name:"casa",component:m["default"]},"/order":{name:"order",component:g["default"]},"/verify":{name:"verify",component:b["default"]},"/brief":{name:"brief",component:s(85)}});var w=r["default"].extend({});P.start(w,"#app")},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(13),n=o(a),i=s(100),r=o(i);n["default"].use(r["default"]);var u={type:0,goods:[],user:{},otherpay:[],dealer:0,diff:30},p={USERINFO:function(t,e){t.user=e.user,t.diff=e.diff},CHANGETYPE:function(t,e){t.type=e},ADDGOODS:function(t,e){var s=-1;for(var o in t.goods)e.id===t.goods[o].id&&(s=o);s>-1?(e.number=parseInt(t.goods[s].number)+1,t.goods.$set(s,e)):(n["default"].set(e,"number",1),t.goods.push(e))},GETFROMLOCAL:function(t,e){var s=-1;for(var o in t.goods)e.id===t.goods[o].id&&(s=o);s>-1&&(e.number=parseInt(t.goods[s].number),t.goods.$set(s,e))},REMOVEGOODS:function(t,e){t.orders.goods.$set(e,e.number=14)},ADDOTHERPAY:function(t,e){var s=-1;for(var o in t.otherpay)e.id===t.otherpay[o].id&&(s=o);return console.log(s),s>-1?(window.alert("请勿重复添加"),null):void t.otherpay.push(e)},CLEAROTHERPAY:function(t){for(var e in t.otherpay)t.otherpay[e].isuse=!1,t.otherpay.$set(e,t.otherpay[e])},RESETOTHERPAY:function(t){for(var e in t.otherpay)t.otherpay[e].isuse=!0,t.otherpay.$set(e,t.otherpay[e])},DELETEOTHERPAY:function(t,e){t.otherpay.$remove(e);for(var s in t.otherpay)t.otherpay[s].isuse=!0,t.otherpay.$set(s,t.otherpay[s])},ADDDEALER:function(t,e){t.dealer=e}};e["default"]=new r["default"].Store({state:u,mutations:p})},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.getCasas=function(t,e){var s=t.dispatch;t.state;s("GETCASAS",e)},e.addGoods=function(t,e){var s=t.dispatch;t.state;s("ADDGOODS",e)},e.getFromlocal=function(t,e){var s=t.dispatch;t.state;s("GETFROMLOCAL",e)},e.changeType=function(t,e){var s=t.dispatch;t.state;s("CHANGETYPE",e)},e.userinfo=function(t,e){var s=t.dispatch;t.state;s("USERINFO",e)},e.addOtherPay=function(t,e){var s=t.dispatch;t.state;s("ADDOTHERPAY",e)},e.clearOtherPay=function(t){var e=t.dispatch;t.state;e("CLEAROTHERPAY")},e.resetOtherPay=function(t){var e=t.dispatch;t.state;e("RESETOTHERPAY")},e.deleteOtherPay=function(t,e){var s=t.dispatch;t.state;s("DELETEOTHERPAY",e)},e.addDealer=function(t,e){var s=t.dispatch;t.state;s("ADDDEALER",e)}},function(t,e,s){var o,a;s(60),o=s(19),a=s(74),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},,,,,,,,,function(t,e,s){var o,a;s(57),o=s(16),a=s(71),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},,function(t,e){"use strict";e.roundDisplay=function(t){return t<0?0:t.toFixed(2)}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={data:function(){return{casa:[],type:0}},route:{data:function(t){this.type=t.to.query.type,this.getinfo(t.to.params.id)}},methods:{getinfo:function(t){var e=this;this.$http.get("/wx/api/cardCasa/"+t+"?type="+this.type).then(function(t){e.$set("casa",t.json())})}},components:{"nav-head":s(3),content:s(88),product:s(92),submit:s(12)}}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={data:function(){return{card:1}},ready:function(){this.getGoodsFromLocal()},vuex:{getters:{diff:function(t){return t.diff},listPrice:function(t){var e=0;for(var s in t.goods)t.goods[s].number>0&&(e+=t.goods[s].price*t.goods[s].number);return e},list:function(t){var e=[];for(var s in t.goods)t.goods[s].number>0&&e.push(t.goods[s]);return e},otherpay:function(t){return t.otherpay},otherPayPrice:function(t){var e=0;for(var s in t.otherpay)t.otherpay[s].isuse&&(e+=t.otherpay[s].price);return e},user:function(t){return t.user},dealer:function(t){return t.dealer}},actions:{clearOtherPay:i.clearOtherPay,resetOtherPay:i.resetOtherPay,addGoods:i.addGoods}},watch:{totalPrice:function(t,e){this.resetOtherPay()}},computed:{totalPrice:function(){var t=this.listPrice-this.otherPayPrice;return console.log(t),t<0&&Math.abs(t)>this.diff?(this.clearOtherPay(),this.listPrice):t}},methods:{getGoodsFromLocal:function(){},pay:function(){var t=this.checkNumber();t?this.$http.post("/wx/api/cardCasaBuy",{casas:this.list,user:this.user,coupons:this.otherpay,dealer:this.dealer}).then(function(t){var e=t.json();e.orderId?e.total<=0?window.location.href="/wx/order/detail/"+e.orderId:window.location.href="/wx/pay/wxorder/"+e.orderId:window.alert(e.msg)}):window.alert("请至少要选择三间或者是一个包幢哟")},checkNumber:function(){var t=0;for(var e in this.list){if(1===this.list[e].is_whole)return 1;t+=this.list[e].number}return t<3?null:1}},store:n["default"],props:["last"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["casa","type"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["contents"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["title","back"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a);e["default"]={vuex:{getters:{list:function(t){return t.goods}}},methods:{plus:function(t){this.list[t].number++},minus:function(t){this.list[t].number>1&&this.list[t].number--},del:function(t){this.list[t].number=0}},components:{goods:s(90)},store:n["default"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={methods:{plus:function(){console.log("plus")},minus:function(){console.log("minus")}},props:["products"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={vuex:{getters:{paycards:function(t){return t.otherpay}},actions:{deleteOtherPay:i.deleteOtherPay}},methods:{del:function(t){this.deleteOtherPay(this.paycards[t])}},store:n["default"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={watch:{products:function(t,e){for(var s in this.products)this.getFromlocal(this.products[s])}},vuex:{actions:{addGoods:i.addGoods,getFromlocal:i.getFromlocal}},methods:{plus:function(t){this.addGoods(this.products[t])},minus:function(t){this.products[t].number&&this.products[t].number--}},store:n["default"],props:["products"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={vuex:{getters:{user:function(t){return t.user}},actions:{userinfo:i.userinfo}},created:function(){this.getUserInfo()},computed:{userMessage:{get:function(){return this.user},set:function(t){console.log(t),this.userinfo(t)}}},methods:{getUserInfo:function(){var t=this;this.$http.get("/wx/api/user").then(function(e){t.userinfo(e.json().result)})}},store:n["default"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={vuex:{getters:{type:function(t){return t.type}},actions:{changeType:i.changeType}},watch:{type:function(t,e){this.getinfo(this.type)}},data:function(){return{casas:null}},created:function(){this.getinfo(this.type)},methods:{getinfo:function(t){var e=this;this.$http.get("/wx/api/cardCasaList?type="+this.type).then(function(t){e.$set("casas",t.json())})}},components:{"nav-head":s(3),card:s(87)},store:n["default"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={vuex:{actions:{addDealer:i.addDealer}},route:{data:function(t){var e=t.to.query.dealer;this.addDealer(e)}},store:n["default"],components:{"nav-head":s(3)}}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={data:function(){return{}},components:{"nav-head":s(3),casa:s(89),submit:s(12),user:s(93),"other-pay":s(91)}}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var a=s(1),n=o(a),i=s(2);e["default"]={data:function(){return{number:null,password:null}},vuex:{actions:{addOtherPay:i.addOtherPay}},methods:{check:function(){var t=this;return this.number?this.password?void this.$http.post("/wx/api/checkCoupon",{number:this.number,password:this.password}).then(function(e){var s=e.json();0===s.code?(t.addOtherPay(s.result),window.history.go(-1)):(console.log(s),window.alert(s.msg))}):(window.alert("密码不能为空"),null):(window.alert("卡号不能为空"),null)}},components:{"nav-head":s(3)},store:n["default"]}},,,,,,,,,,,,,,,,,,,,,,,,,,,,function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){t.exports=' <nav-head back=1 :title=casa.name></nav-head> <div class=head-img> <img :src=casa.headImg alt=""> </div> <h2>房型选择</h2> <product :products=casa.products></product> <content :contents=casa.contents></content> <submit></submit> '},function(t,e){t.exports=' <div class=cover> <div class="bottom-submit ui-box"> <div class=price> <span v-if=card class="show fa fa-credit-card" transition=bounce></span> <span v-else class="show fa fa-credit-card" transition=bounce></span> <span>{{ totalPrice | roundDisplay }}元</span> </div> <div class="btn btn-disable"> <a v-link="{ path:\'/list\',exact: true}"> <span>继续选</span> </a> </div> <div class="btn btn-submit"> <a v-if="last == 1" @click=pay> <span>立刻支付</span> </a> <a v-else v-link="{ name:\'order\' }"> <span>去结算</span> </a> </div> </div> </div> '},function(t,e){t.exports=' <div class=card> <a v-link="{ name:\'casa\',params:{ id:casa.id },query:{type:type}}"> <div class=pic style=background> <img :src=casa.headImg alt=""> </div> <div class=info> <h3>{{ casa.name }}</h3> </div> </a> </div> '},function(t,e){t.exports=' <div class=casa-page> <div class=main-title> <h2>民宿介绍</h2> </div> <article> <template v-for="content in contents"> <p v-if=content.text>{{{ content.text }}}</p> <template v-for="img in content.imgs"> <img :src="\'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/\'+img.filepath" alt="" width=100%> </template> </template> </article> </div> '},function(t,e){t.exports=' <nav> <div class=nav-home> <a v-if=back onclick=history.go(-1)> <img src=/static/header/back.png height=100% alt=""/> </a> <a v-else v-link="{ path: \'/\'}"> <img src=/static/header/home.png height=100% alt=""/> </a> </div> <div class=logo> <h2 v-if=title>{{ title }}</h2> <img v-else src=/static/header/logow.png height=100% /> </div> <div class=nav-user> <a href=/wx/user> <img src=/static/header/user.png height=100% alt=""/> </a> </div> </nav> '},function(t,e){t.exports=' <div class=order v-for="item in list"> <template v-if="item.number > 0"> <div class=casa-info> <div class=casa-img> <img :src=item.headImg alt=""> </div> <div class=good-info> <h3>{{ item.name }}</h3> <p>￥{{ item.price }}</p> <div class=quantity> <span class="fa fa-minus" @click=minus($index)></span><input type=text v-model=item.number><span class="fa fa-plus" @click=plus($index)></span> </div> <span @click=del($index) class="delete fa fa-trash-o"></span> </div> </div> </template> </div> '},function(t,e){t.exports=' <div class=good v-for="product in products"> <div class=handle-good> <div class=tip> <p>{{ product.name }}</p> <p>￥{{ product.price }}</p> </div> <div class=quantity> <span class="fa fa-minus" @click=minus></span> <input type=text value=1> <span class="fa fa-plus" @click=plus></span> </div> </div> </div> '},function(t,e){t.exports=' <div class=use> <template v-if="paycards.length > 0"> <button v-link="{ name:\'verify\'}">继续使用</button><i class="fa fa-angle-right"></i> </template> <template v-else> <button v-link="{ name:\'verify\'}">使用充值卡</button><i class="fa fa-angle-right"></i> </template> </div> <div class=chit v-for="item in paycards"> <template v-if=item.isuse> <div class=check> <input type=checkbox v-model=item.isuse> </div> <div class=chit-info> <span>使用{{ item.name }}-{{ item.price }}</span> <span @click=del($index) class="delete fa fa-trash-o"></span> </div> </template> <template v-else> <input disabled=disabled type=checkbox> <div class=chit-info> <span>&nbsp;订单金额过少，不能使用充值卡</span><span @click=del($index) class="delete fa fa-trash-o"></span> </div> </template> </div> '},function(t,e){t.exports=' <div class=product v-for="product in products"> <div class=product-info> <div class=name> <h3>{{ product.name }}</h3> </div> <div class=price> <p>￥{{ product.price }}&nbsp;<span>￥{{ product.orig }}</span></p> </div> </div> <div class=handle> <div class=tip> <span>数量</span> </div> <div class=quantity v-if="product.surplus > 0"> <span class="fa fa-minus" @click=minus($index)></span><input type=text v-model=product.number placeholder=0><span class="fa fa-plus" @click=plus($index)></span> </div> <div class=quantity v-else> <span>已售罄</span> </div> </div> </div> '},function(t,e){t.exports=' <div class=userinfo> <div class="name input-default"> <span>联系人</span> <input type=text v-model=userMessage.realname placeholder=请填写真实姓名> </div> <div class="phone input-default"> <span>电话</span> <input type=number v-model=userMessage.cellphone pattern=[0-9]* placeholder=请填写有效的手机号> </div> </div> '},function(t,e){t.exports=' <nav-head title=选择民宿></nav-head> <div class=tab> <ul> <li v-bind:class="{\'active\': type == 0}" @click=changeType(0)>单选</li> <li v-bind:class="{\'active\': type == 1}" @click=changeType(1)>包幢</li> </ul> </div> <template v-for="casa in casas"> <card :casa=casa :type=type></card> </template> '},function(t,e){t.exports=' <div class=back-img> <img src=http://casarover.oss-cn-hangzhou.aliyuncs.com/image/lead2.jpg alt=""> </div> <div class=buy v-link="{ path:\'/list\',exact: true}"></div> <a class=rule href="http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=503275946&idx=1&sn=42f042f6cd8ab7f9f47f859c39d4b951&scene=18#wechat_redirect"></a> <div class=article></div> '},function(t,e){t.exports=" <nav-head back=1 title=付款></nav-head> <casa></casa> <user></user> <other-pay></other-pay> <submit last=1></submit> "},function(t,e){t.exports=" <nav-head back=1 title=使用充值卡></nav-head> <div class=verify> <div class=card-no> <span>卡号</span> <input type=text v-model=number placeholder=请输入卡号> </div> <div class=pwd> <span>密码</span> <input type=password v-model=password placeholder=请输入密码> </div> </div> <div class=submit @click=check> <button>立即使用</button> </div> "},function(t,e){t.exports=' <div class=brief-banner _v-761ea102=""> <img src=xxxHTMLLINKxxx0.34167903396347430.7272761397250209xxx alt="" _v-761ea102=""> <div class=info _v-761ea102=""> <h2 _v-761ea102="">民宿<span _v-761ea102="">出游</span>季</h2> <h3 _v-761ea102="">度假卡&nbsp;•&nbsp;每晚低至6.8折</h3> <p _v-761ea102="">依山傍水&nbsp;风土人情&nbsp;避暑胜地&nbsp;奢华民宿</p> </div> </div> <div class=brief _v-761ea102=""> <h2 _v-761ea102="">民宿度假卡</h2> <p _v-761ea102="">民宿的意义在于它的浓厚的人情味和主人文化，我们希望有更多的人深入了解民宿。为此我们甄选了杭州、莫干山、临安、桐庐地区的15家精品民宿，在倡导分时度假的同时，与你一起分享慢生活的喜悦。我们希望在回馈粉丝的同时，让更多的人体验民宿。你可以自由的选择想要入住的民宿及房间数量，还可以选择包幢，最终生成你的度假卡。使用时可以多人使用一张卡</p> </div> <div class=slogn _v-761ea102=""> <h2 _v-761ea102="">自由选购&nbsp;个性定制</h2> <h4 _v-761ea102="">超低折扣、精品民宿、优质服务、最佳体验</h4> <p _v-761ea102="">杭州•桐庐•临安•莫干山</p> <h4 _v-761ea102="">独家定制，只为让你拥有。</h4> <img src=xxxHTMLLINKxxx0.82263542980431390.7770240521243357xxx alt="" _v-761ea102=""> </div> '},function(t,e,s){var o,a;s(69),a=s(84),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(56),o=s(15),a=s(70),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(58),o=s(17),a=s(72),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(59),o=s(18),a=s(73),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(61),o=s(20),a=s(75),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(62),o=s(21),a=s(76),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(63),o=s(22),a=s(77),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(64),o=s(23),a=s(78),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(65),o=s(24),a=s(79),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(66),o=s(25),a=s(80),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(67),o=s(26),a=s(81),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;o=s(27),a=s(82),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)},function(t,e,s){var o,a;s(68),o=s(28),a=s(83),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),a&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=a)}]);