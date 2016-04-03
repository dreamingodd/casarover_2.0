<?php use \App\Common\CommonTools;?>
<input type="hidden" id="backstage_url" value="{{CommonTools::getUrl()}}"/>
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation" class="dropdown home">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">首页管理<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a  href="/back/slide">轮播图</a></li>
                    <li><a  href="/back/recom" >民宿推荐</a></li>
                </ul>
            </li>
            <li role="presentation" class="area">
                <a href="/back/areas">区域管理</a>
            </li>
            <li role="presentation" class="casa">
                <a href="/back/casaList">民宿管理</a>
            </li>
            <li role="presentation" class="dropdown wechat">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">微信管理<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/back/participateList">游园会活动管理</a></li>
                    <li><a href="/back/wechatSeriesList">探庐系列-子标题</a></li>
                    <li><a href="/back/wechatList/1">探庐系列</a></li>
                    <li><a href="/back/wechatList/2">民宿风采</a></li>
                    <li><a href="/back/wechatList/3">主题民宿</a></li>
                </ul>
            </li>
            <!--
            <li role="presentation" class="reward">
                <a href="reward_list.php">领奖操作</a>
            </li>
             -->
            <li role="presentation" class="system">
                <a href="website/backstage/system.php">系统功能</a>
            </li>
            <li role="presentation" class="logout">
                <a href="application/controllers/logout_action.php?location=backstage">退出</a>
            </li>
        </ul>
    </div>
</div>
