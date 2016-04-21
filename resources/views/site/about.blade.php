@extends('site')
@section('title','探庐系列')
@section('head')
    <link rel="stylesheet" href="/assets/css/about.css">
@endsection
@section('body')
    <img src="/assets/images/aboutus.jpg" alt="" class="banner">
    <div class="main">
    <div class="part" id="about-us">
        <h2>--A--</h2>
        <p>关于我们</p>
        <div class="case">
            <img src="/assets/images/horn.png" alt="" class="horn">
            <p>探庐者，英文logo是CaSa Rover ，含义是去探访一个远方的家。也意味着心灵去旅行，去寻找你梦中的那一片纯净之地。探庐者代表着一种探索发现美的意境，代表着一种返璞归真的生活态度。</p>
            <p>“庐”字上的一抹云，又给人无尽的想象空间，仿佛是行云流水的云彩，又或是层峦叠嶂的山脉，既有一种超脱飘然的悠闲自在，也有一种天马行空的无拘无束。</p>
            <p>我们是一群爱生活，爱自由，爱旅行的年轻人，在这样一个互联网创业平台上，去追逐自己的年轻梦想。</p>
            <p>远庐致力于成为最大最全的民宿信息汇聚平台，力求探索最有特色的民宿，带大家发现简约而不简单的生活，体验与众不同却曾梦中追逐过的快乐。</p>
        </div>
    </div>
    {{--<div class="case">--}}
        {{--<h2 id="casarover">探庐者</h2>--}}
        {{--<p>探庐者，英文logo是CaSa Rover ，含义是去探访一个远方的家。也意味着心灵去旅行，去寻找你梦中的那一片纯净之地。探庐者代表着一种探索发现美的意境，代表着一种返璞归真的生活态度。“庐”字上的一抹云，又给人无尽的想象空间，仿佛是行云流水的云彩，又或是层峦叠嶂的山脉，既有一种超脱飘然的悠闲自在，也有一种天马行空的无拘无束。--}}
        {{--</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="brand-culture">品牌文化</h2>--}}
        {{--<dl>--}}
            {{--<dt>自然</dt>--}}
            {{--<dd>一：人与自然的完美融合，人从大自然丛林中走出已经很多年了，但是我们的本性还是亲近自然的，用我们的身体的感知器官和自然再次有了原始的链接。--}}
                {{--二：心性上的自然而然，万事顺势而为，道法自然。讲究的是人的一种心态，与世无争，超然脱俗，顺其自然的意境。</dd>--}}
            {{--<dt>简约</dt>--}}
            {{--<dd>一切都是那么简单明了，因为简单包含的是一种能量的积蓄，无就是有，less is more。对人生的理解，一切从简单出发，才会获得更多的快乐。</dd>--}}
            {{--<dt>美好</dt>--}}
            {{--<dd>对美的一种向往，不管是体验过的或是未体验过的，都会有一种无限的期待，那是一种对美好的追求，也是我们生活中的一种期盼，未来是能够拥有美好的，所谓岁月静好，无改当初。</dd>--}}
            {{--<dt>探索</dt>--}}
            {{--<dd>一种对待生活的态度，要能发现生活中不一样的美，去体验一种特别的生活方式，从而能完美的诠释人生的丰富多彩。</dd>--}}
            {{--<dt>乐享</dt>--}}
            {{--<dd>探索后的获得，应该也只有分享后让更多的人了解，才会更具有获得的价值，每个人活着的意义不在于得到多少，而在于能让人多少得到。分享后的快乐是一种人性的升华，是一种对生活更深刻的理解。</dd>--}}
        {{--</dl>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="charge-standard">合作推广收费标准</h2>--}}
        {{--<p>头条：8000元，阅读量：2万+</p>--}}
        {{--<p>二条：5000元，阅读量：15000</p>--}}
        {{--<p>三条：3500元，阅读量：10000</p>--}}
        {{--<p>不群发推广单篇：2000/篇</p>--}}
        {{--<p>联合外媒同步发，价格等同头条价格。</p>--}}
        {{--<p>如需拍摄视频，价格另议。</p>--}}
        {{--<p>详情请联系微信号：sonoffeng</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2  id="free-promotion">免费推广</h2>--}}
        {{--<h3>一、花千谷</h3>--}}
        {{--<p>在太湖源头有一处地方，小河潺潺、幽谷碧潭、风景秀美，宛若世外桃源般，民宿花千谷就坐落在这个景色如画之地。屋前小河弯弯绕绕而过，背后靠着青翠的山林，整个花千谷就坐落在这个得天独厚的自然环境里。</p>--}}
        {{--<p>乡野小筑，自然美景，配上最地道的山珍野味，在美食、美景和乡野闲趣之中，体会一种别样的乡野自然生活。</p>--}}
        {{--<p>居世外桃源，品人间美味；享乡里土货，感温馨情怀。这就是花千谷，这就是花千谷所要带给来客的感受。</p>--}}
        {{--<p>地    址：杭州临安市太湖源太子庙村66号</p>--}}
        {{--<p>谷主电话：13868006602</p>--}}
        {{--<h3>二、古堡</h3>--}}
        {{--<p>这是一只猫、一个人和一间古堡的故事，相遇是世间最美妙的事，是一切的故事的起源。一个深秋之夜，一只小黑猫的奶叫声，一个归家妹子的回望，然后一切就这么开始了。日夜的陪伴，让彼此的生活完全交融为一个整体，你中有我、我中有你，不可分割。然而幸福的时光总是短暂的，有一天小黑猫离家之后再也没有找到回家的路，迷失了，再也没有找到回家的路。主人找过了所有的地方，问了很多的人，没有找到小黑猫。</p>--}}
        {{--<p>意外的分别带来难忘的思念，小黑猫走失了，再没有找到回家的路。所有点点滴滴的记忆都在，主人一直记着，主人不想忘记。一座古堡在小猫走失之后被建了起来，里面满满的都是小猫的印记，这是一座专属小黑猫和它的主人的古堡，用来盛放记忆和思念。</p>--}}
        {{--<p>那只小黑猫叫cancan，脖子上戴着珍珠项链，如果你看到它，请你告诉它的美女主人，让它回家。</p>--}}
        {{--<p>地    址：杭州市西湖区满觉陇路杨家山6号</p>--}}
        {{--<p>堡主电话：0571—86805860  13372560689</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="personal-customized">私人定制</h2>--}}
        {{--<h3>1、针对顾客</h3>--}}
        {{--<p>我们是专业的民宿信息汇聚平台，您可以在我们的平台上找到各类最具特色的、最合乎您需求的民宿。并且我们可以帮您制定旅游路线，可以根据您的要求，让您体验你一直梦寐以求的生活。</p>--}}
        {{--<h3>2、针对客户</h3>--}}
        {{--<p>我们的不只是提供民宿信息，我们也针对想要拥有属于自己的民宿的小伙伴们提供各项服务，我们提供从民宿设计到推广的所有环节的服务，只要你有想开民宿的想法和实现你的想法的决心，我们就能帮你实现它。</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="business-cooperation">商务合作</h2>--}}
        {{--<p>一、我们的平台上有各类民宿信息，可以根据您的需求提供给您最适合的民宿，并提供民宿详情及旅游路线等相关信息。</p>--}}
        {{--<p>二、我们提供民宿设计到推广的所有环节的服务，只要你有想开民宿的想法和实现你的想法的决心，我们就能帮你实现它。</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="contact-us">联系我们</h2>--}}
        {{--<p>电话：13958056604</p>--}}
        {{--<p>邮箱：service@casarover.com</p>--}}
        {{--<p>公司地址：浙江省杭州市西溪街道文二路188号16号楼</p>--}}
    {{--</div>--}}
    {{--<div class="case">--}}
        {{--<h2 id="media-cooperation">媒体合作</h2>--}}
        {{--<img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/tencent.png" style="width:250px;height: 250px"/>--}}
        {{--<img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/baidu.png" style="width:410px;height: 250px"/>--}}
        {{--<img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/zheda.png" style="width:250px;height: 250px"/>--}}
    {{--</div>--}}
</div>
@endsection
