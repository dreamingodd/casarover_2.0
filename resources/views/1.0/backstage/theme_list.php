<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet"/>
<script src="../js/integration/jquery.min.js"></script>
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.form.js"></script>
<script src="js/all.js"></script>
<title>探庐者后台-主题列表</title>
</head>
<body>
<?php include '../301.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/check_admin_login_action.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/ThemeDao.php';?>
<div id="container">
    <!-- nav bar start -->
    <?php include 'navigator.php';?>
    <input type="hidden" id="page" value="home"/>
    <!-- nav bar end -->
    <div class="options vertical5">
        <a href="theme_edit.php">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="theme_list.php">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>主题列表
        </a>
        <a href="theme_list.php?deleted=1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>简介</th>
            <th>更新者</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
    <?php
    $themeDao = new ThemeDao();
    $query = $themeDao->getAll($_GET['deleted']);
    $number = 0;
    while ($row = mysql_fetch_array($query)) {
        $number++;
    ?>
        <tr>
            <td><?php echo $number?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['description']?></td>
            <td><?php echo $row['update_by']?></td>
            <td><?php echo $row['update_time']?></td>
            <td>
                <?php
                if ($_GET['deleted']) {
                ?>
                <a id="casa_recover" href='../../application/controllers/theme_action.php?id=<?php echo $row['id']?>&action=recover&deleted=1'>
                    <button type="button" class="btn btn-xs btn-warning">还原</button>
                </a>
                <?php
                } else {
                ?>
                <a href='theme_edit.php?id=<?php echo $row['id']?>'>
                    <button type="button" class="btn btn-xs btn-info">编辑</button>
                </a>
                <a target="_blank" href='../theme.php?id=<?php echo $row['id']?>'>
                    <button type="button" class="btn btn-xs btn-info">查看效果</button>
                </a>
                <a href='../../application/controllers/theme_action.php?id=<?php echo $row['id']?>&action=recycle&deleted=0'>
                    <button type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
                <?php }?>
            </td>
        </tr>
    <?php 
    };
    ?>
    </table>
</div>
</body>
</html>