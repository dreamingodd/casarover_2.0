@extends('wxBase')
@section('title','民宿预订')
@section('head')
    <link href="/assets/css/wxDetails.css" rel="stylesheet"/>
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
@stop
@section('body')
    <nav><a href="/wechatbook" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:12345678901" class="glyphicon glyphicon-earphone"></a>
        <h1>探庐者</h1>
    </nav>
    <div class="flexslider">
        <ul class="slides">
            <li onclick="goto_link1()"
                style="background:url('/assets/images/banner-01.jpg') ; background-size:100% 100%; "></li>
            <li onclick="goto_link2()"
                style="background:url('/assets/images/banner-02.jpg') ; background-size:100% 100%; "></li>
        </ul>
    </div>
    <div class="main">
        <div class="header">
            <h1>山水相依 景景相融</h1>
            <p>『夏季促销3晚泳池别墅』越南昆岛六善酒店</p>
            <span>￥878起</span>
        </div>
        <div class="brief">
            <p>【住】高级客房1晚
                </br>
                【含】自助早餐1份
                </br>
                【享】免费WIFI</p>
        </div>
        <div class="tabtable">
            <ul class="nav nav-tabs">
                <li><a href="#product" data-target="#product" data-toggle="tab" aria-expanded="false">产品详情</a></li>
                <li><a href="#notice" data-target="#notice" data-toggle="tab" aria-expanded="false">预订须知</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="product">
                    <p>XXX民宿</p>
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512251534025364.png" alt="">
                    <p>123</p>
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512251534025364.png" alt="">
                    <p>456</p>
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512251534025364.png" alt="">
                </div>
                <div class="tab-pane" id="notice">
                    <div class="explain">
                        <h2>使用说明</h2>
                        <p>必须至少提前5天预约入住日期；</p>
                        <p>入住有效期：2016年4月9日-9月27日；</p>
                        <p>费用包含税和服务费；</p>
                        <p>每房核定入住2人，超出需另付费；</p>
                        <p>至多可入住2成人1儿童（12周岁以下，不含12周岁）；</p>
                        <p>儿童政策；11周岁（不含11周岁）以下占床含早餐免费（使用沙发床），11周岁-12周岁以下，占床含早餐320元/人/天；</p>
                        <p>接送机：850元/车/往返（至多3人，昆岛机场至酒店往返私人接送机服务，往返各1次）；</p>
                        <p>第三人机场至酒店往返接送服务价格：150元/人（公共交通，往返各1次，非私人用车）；</p>
                        <p>一旦预约入住时间，则不可更改与取消；</p>
                        <p>入住时间：当日15:00之后； 退房时间：次日12:00之前。</p>
                    </div>
                    <div class="rule">
                        <h2>改退规则</h2>
                        <p>一）未预约：  1.免费改：凡未预约成功均可免费更换其他任意产品无须收取手续费（差额多退少补）；</p>
                        <p> 2.免费退：如在规定的时间内预约失败，则均可申请全额退款无须收取手续费；</p>
                        <p> 3.随时退：凡未按规定预约均可随时申请退款(须收取1%的银行手续费)，3-5个工作日退回原账户；</p>
                        <p>（二）已预约： 酒店一旦预约入住时间，不退不改； </p>
                        <p> 有特殊情况，请提供相应证明，最终以酒店确认为准；  </p>
                        <p>  若提供相关证明，按不同时期收取不同比例的手续费用，具体如下： </p>
                        <p> 1.若距离入住前10个工作日做退改（不包含第10个工作日）收取10%手续费；</p>
                        <p> 2.若距离入住前5个工作日做退改（不包含第5个工作日）收取20%手续费；</p>
                        <p> 3.若距离入住前3个工作日做退改（不包含第3个工作日）收取40%手续费；</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="/bookpay" class="btn">立即购买</a>
    <script>
        $('.flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
    </script>
@stop
