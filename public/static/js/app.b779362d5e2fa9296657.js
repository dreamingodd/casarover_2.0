webpackJsonp([1,0],[function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}var n=s(29),a=o(n),i=s(13),r=o(i),u=s(96),p=o(u),c=s(95),d=o(c),l=s(92),f=o(l),v=s(91),h=o(v),x=s(83),m=o(x),y=s(93),g=o(y),b=s(94),_=o(b),M=s(14),O=o(M);(0,a["default"])(O["default"]).forEach(function(t){return r["default"].filter(t,O["default"][t])}),r["default"].use(p["default"]),r["default"].use(d["default"]);var w=new p["default"]({linkActiveClass:"active"});w.map({"/":{component:f["default"]},"/list":{component:h["default"]},"/casa/:id":{name:"casa",component:m["default"]},"/order":{name:"order",component:g["default"]},"/verify":{name:"verify",component:_["default"]}});var k=r["default"].extend({});w.start(k,"#app")},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(13),a=o(n),i=s(97),r=o(i);a["default"].use(r["default"]);var u={type:0,goods:[],user:{},otherpay:[]},p={USERINFO:function(t,e){t.user=e},CHANGETYPE:function(t,e){t.type=e},ADDGOODS:function(t,e){var s=-1;for(var o in t.goods)e.id===t.goods[o].id&&(s=o);s>-1?(e.number=parseInt(t.goods[s].number)+1,t.goods.$set(s,e)):(a["default"].set(e,"number",1),t.goods.push(e))},GETFROMLOCAL:function(t,e){var s=-1;for(var o in t.goods)e.id===t.goods[o].id&&(s=o);s>-1&&(e.number=parseInt(t.goods[s].number),t.goods.$set(s,e))},REMOVEGOODS:function(t,e){t.orders.goods.$set(e,e.number=14)},ADDOTHERPAY:function(t,e){var s=t.otherpay.indexOf(e);s<0?(console.log(e),t.otherpay.push(e)):window.alert("请勿重复添加")},CLEAROTHERPAY:function(t){t.otherpay=[]}};e["default"]=new r["default"].Store({state:u,mutations:p})},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.getCasas=function(t,e){var s=t.dispatch;t.state;s("GETCASAS",e)},e.addGoods=function(t,e){var s=t.dispatch;t.state;s("ADDGOODS",e)},e.getFromlocal=function(t,e){var s=t.dispatch;t.state;s("GETFROMLOCAL",e)},e.changeType=function(t,e){var s=t.dispatch;t.state;s("CHANGETYPE",e)},e.userinfo=function(t,e){var s=t.dispatch;t.state;s("USERINFO",e)},e.addOtherPay=function(t,e){var s=t.dispatch;t.state;s("ADDOTHERPAY",e)},e.clearOtherPay=function(t){var e=t.dispatch;t.state;e("CLEAROTHERPAY")}},function(t,e,s){var o,n;s(59),o=s(19),n=s(73),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},,,,,,,,,function(t,e,s){var o,n;s(56),o=s(16),n=s(70),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},,function(t,e){"use strict";e.roundDisplay=function(t){return t.toFixed(2)}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={data:function(){return{casa:[],type:0}},route:{data:function(t){this.type=t.to.query.type,this.getinfo(t.to.params.id)}},methods:{getinfo:function(t){var e=this;this.$http.get("/wx/api/cardCasa/"+t+"?type="+this.type).then(function(t){e.$set("casa",t.json())})}},components:{"nav-head":s(3),content:s(85),product:s(89),submit:s(12)}}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n),i=s(2);e["default"]={data:function(){return{card:1}},vuex:{getters:{list:function(t){var e=[];for(var s in t.goods)t.goods[s].number>0&&e.push(t.goods[s]);return e},otherpay:function(t){return t.otherpay},user:function(t){return t.user}},actions:{clearOtherPay:i.clearOtherPay}},computed:{totalPrice:function r(){var r=0;for(var t in this.list)r+=this.list[t].price*this.list[t].number;var e=0;for(var s in this.otherpay)e+=this.otherpay[s].price;e>r&&(console.log("充值卡金额大于订单金额"),this.clearOtherPay);var o=r-e;return o}},methods:{pay:function(){this.$http.post("/wx/api/cardCasaBuy",{casas:this.list,user:this.user}).then(function(t){var e=t.json();e.orderId?window.location.href="/wx/pay/wxorder/"+e.orderId:window.alert(e.msg)})},checkNumber:function(){var t=0;for(var e in this.list)t+=this.list[e].number;if(t<3)return null}},store:a["default"],props:["last"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["casa","type"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["contents"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={props:["title","back"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n);e["default"]={vuex:{getters:{list:function(t){return t.goods}}},methods:{plus:function(t){this.list[t].number++},minus:function(t){this.list[t].number>1&&this.list[t].number--},del:function(t){this.list[t].number=0}},components:{goods:s(87)},store:a["default"]}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={methods:{plus:function(){console.log("plus")},minus:function(){console.log("minus")}},props:["products"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n);e["default"]={vuex:{getters:{paycards:function(t){return t.otherpay}}},store:a["default"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n),i=s(2);e["default"]={watch:{products:function(t,e){for(var s in this.products)this.getFromlocal(this.products[s])}},vuex:{actions:{addGoods:i.addGoods,getFromlocal:i.getFromlocal}},methods:{plus:function(t){this.addGoods(this.products[t])},minus:function(t){this.products[t].number&&this.products[t].number--}},store:a["default"],props:["products"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n),i=s(2);e["default"]={vuex:{getters:{user:function(t){return t.user}},actions:{userinfo:i.userinfo}},created:function(){this.getUserInfo()},computed:{userMessage:{get:function(){return this.user},set:function(t){console.log(t),this.userinfo(t)}}},methods:{getUserInfo:function(){var t=this;this.$http.get("/wx/api/user").then(function(e){t.userinfo(e.json().result)})}},store:a["default"]}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n),i=s(2);e["default"]={vuex:{getters:{type:function(t){return t.type}},actions:{changeType:i.changeType}},watch:{type:function(t,e){this.getinfo(this.type)}},data:function(){return{casas:null}},created:function(){this.getinfo(this.type)},methods:{getinfo:function(t){var e=this;this.$http.get("/wx/api/cardCasaList?type="+this.type).then(function(t){e.$set("casas",t.json())})}},components:{"nav-head":s(3),card:s(84)},store:a["default"]}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={components:{"nav-head":s(3)}}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={data:function(){return{}},components:{"nav-head":s(3),casa:s(86),submit:s(12),user:s(90),"other-pay":s(88)}}},function(t,e,s){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=s(1),a=o(n),i=s(2);e["default"]={data:function(){return{number:null,password:null}},vuex:{actions:{addOtherPay:i.addOtherPay}},methods:{check:function(){if(!this.number)return window.alert("卡号不能为空"),null;this.password||window.alert("密码不能为空");var t={id:3,name:"充值卡",price:123,isuse:!0},e=1;e?(this.addOtherPay(t),window.history.go(-1)):window.alert("error message")}},components:{"nav-head":s(3)},store:a["default"]}},,,,,,,,,,,,,,,,,,,,,,,,,,,,function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){t.exports=" <nav-head back=1 :title=casa.name></nav-head> <h2>房型选择</h2> <product :products=casa.products></product> <hr> <h2>民宿介绍</h2> <content :contents=casa.contents></content> <submit></submit> "},function(t,e){t.exports=' <div class=cover> <div class="bottom-submit ui-box"> <div class=price> <span v-if=card class="show fa fa-credit-card" transition=bounce></span> <span v-else class="show fa fa-credit-card" transition=bounce></span> <span>{{ totalPrice | roundDisplay }}元</span> </div> <div class="btn btn-disable"> <a v-link="{ path:\'/list\',exact: true}"> <span>继续选</span> </a> </div> <div class="btn btn-submit"> <a v-if="last == 1" @click=pay> <span>立刻支付</span> </a> <a v-else v-link="{ name:\'order\' }"> <span>去结算</span> </a> </div> </div> </div> '},function(t,e){t.exports=' <div class=card> <a v-link="{ name:\'casa\',params:{ id:casa.id },query:{type:type}}"> <div class=pic style=background> <img :src=casa.headImg alt=""> </div> <div class=info> <h3>{{ casa.name }}</h3> </div> </a> </div> '},function(t,e){t.exports=' <article> <template v-for="content in contents"> <p v-if=content.text>{{{ content.text }}}</p> <template v-for="img in content.imgs"> <img :src="\'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/\'+img.filepath" alt="" width=100%> </template> </template> </article> '},function(t,e){t.exports=' <nav> <div class=nav-left> <a v-if=back onclick=history.go(-1)> <img src=/static/header/back.png height=100% alt=""/> </a> <a v-else href=/wx> <img src=/static/header/home.png height=100% alt=""/> </a> </div> <div class=logo> <h2 v-if=title>{{ title }}</h2> <img v-else src=/static/header/logow.png height=100% /> </div> <div class=nav-right> <a href=/wx/user> <img src=/static/header/user.png height=100% alt=""/> </a> </div> </nav> '},function(t,e){t.exports=' <div class=order v-for="item in list"> <template v-if="item.number > 0"> <div class=casa-info> <div class=casa-img> <img :src=item.headImg alt=""> </div> <div class=good-info> <h3>{{ item.name }}</h3> <p>￥{{ item.price }}</p> <div class=quantity> <span class="fa fa-minus" @click=minus($index)></span> <input type=text v-model=item.number> <span class="fa fa-plus" @click=plus($index)></span> </div> <span @click=del($index) class="delete fa fa-trash-o"></span> </div> </div> </template> </div> '},function(t,e){t.exports=' <div class=good v-for="product in products"> <div class=handle-good> <div class=tip> <p>{{ product.name }}</p> <p>￥{{ product.price }}</p> </div> <div class=quantity> <span class="fa fa-minus" @click=minus></span> <input type=text value=1> <span class="fa fa-plus" @click=plus></span> </div> </div> </div> '},function(t,e){t.exports=' <div class=use> <template v-if="paycards.length > 0"> <button v-link="{ name:\'verify\'}">继续使用</button><i class="fa fa-angle-right"></i> </template> <template v-else> <button v-link="{ name:\'verify\'}">使用充值卡</button><i class="fa fa-angle-right"></i> </template> </div> <div class=chit v-for="item in paycards"> <div class=check> <input type=checkbox v-model=item.isuse> </div> <div class=chit-info> <span>使用{{ item.name }}-{{ item.price }}</span> </div> </div> '},function(t,e){t.exports=' <div class=product v-for="product in products"> <div class=product-info> <div class=name> <h3>{{ product.name }}</h3> </div> <div class=price> <p>￥{{ product.price }}</p> </div> </div> <div class=handle> <div class=tip> <span>数量</span> </div> <div class=quantity> <span class="fa fa-minus" @click=minus($index)></span> <input type=text v-model=product.number placeholder=0> <span class="fa fa-plus" @click=plus($index)></span> </div> </div> </div> '},function(t,e){t.exports=' <div class=userinfo> <div class="name input-default"> <span>联系人</span> <input type=text v-model=userMessage.realname placeholder=请填写真实姓名> </div> <div class="phone input-default"> <span>电话</span> <input type=number v-model=userMessage.cellphone pattern=[0-9]* placeholder=请填写有效的手机号> </div> <div class=address> <p>地址<span>(购买达一定金额会有精美礼品赠送)</span></p> <textarea name="" id="" cols=30 rows=5 placeholder=请填写真实地址，用于邮寄礼品 v-model=userMessage.address></textarea> </div> </div> '},function(t,e){t.exports=' <nav-head back=1 title=选择民宿></nav-head> <div class=tab> <ul> <li v-bind:class="{\'active\': type == 0}" @click=changeType(0)>单选</li> <li v-bind:class="{\'active\': type == 1}" @click=changeType(1)>包幢</li> </ul> </div> <template v-for="casa in casas"> <card :casa=casa :type=type></card> </template> '},function(t,e){t.exports=" <nav-head></nav-head> <div class=page> <h2>探庐度假卡</h2> <h3>规则介绍</h3> <li>1</li> <li>2</li> <li>3</li> <li>4</li> <div class=go-button> <a class=go v-link=\"{ path: '/list' }\">立刻抢购</a> </div> </div> "},function(t,e){t.exports=" <nav-head back=1 title=付款></nav-head> <casa></casa> <user></user> <other-pay></other-pay> <submit last=1></submit> "},function(t,e){t.exports=" <nav-head back=1 title=使用充值卡></nav-head> <div class=verify> <div class=card-no> <span>卡号</span> <input type=number pattern=[0-9]* v-model=number placeholder=请输入卡号> </div> <div class=pwd> <span>密码</span> <input type=password v-model=password placeholder=请输入密码> </div> </div> <div class=submit @click=check> <button>立即使用</button> </div> "},function(t,e,s){var o,n;s(68),o=s(15),n=s(69),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(57),o=s(17),n=s(71),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(58),o=s(18),n=s(72),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(60),o=s(20),n=s(74),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(61),o=s(21),n=s(75),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(62),o=s(22),n=s(76),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(63),o=s(23),n=s(77),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(64),o=s(24),n=s(78),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(65),o=s(25),n=s(79),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(66),o=s(26),n=s(80),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;o=s(27),n=s(81),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)},function(t,e,s){var o,n;s(67),o=s(28),n=s(82),t.exports=o||{},t.exports.__esModule&&(t.exports=t.exports["default"]),n&&(("function"==typeof t.exports?t.exports.options||(t.exports.options={}):t.exports).template=n)}]);
//# sourceMappingURL=app.b779362d5e2fa9296657.js.map