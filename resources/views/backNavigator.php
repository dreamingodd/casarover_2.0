<?php include_once app_path().'/Common/CommonTools.php';?>
<input type="hidden" id="backstage_url" value="{{CommonTools::getUrl()}}"/>
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation" class="dropdown home">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">首页管理<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="not_complete" href="website/backstage/huge_pics_edit.php">轮播图</a></li>
                    <li><a class="not_complete" href="website/backstage/theme_list.php" >主题推荐</a></li>
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
                    <li><a href="activity/participate_list.php?status=0">游园会活动管理</a></li>
                    <li><a href="website/wechat/wechat_series_list.php">探庐系列-子标题</a></li>
                    <li><a href="website/wechat/wechat_article_list.php?type=1">探庐系列</a></li>
                    <li><a href="website/wechat/wechat_article_list.php?type=2">民宿风采</a></li>
                    <li><a href="website/wechat/wechat_article_list.php?type=3">主题民宿</a></li>
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
