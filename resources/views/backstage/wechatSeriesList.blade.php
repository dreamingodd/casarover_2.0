@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
    <div class="options vertical5">
        <a href="/back/wechatSeriesEdit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>父标题</th>
            <th>操作</th>
        </tr>
            <tr>
            <td>1</td>
            <td>探庐·临安</td>
            <td>
                探庐系列                                            </td>
            <td>
                <a href='wechat_series_del_action.php?id=1'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
            <tr>
            <td>2</td>
            <td>探庐·莫干山</td>
            <td>
                探庐系列                                            </td>
            <td>
                <a href='wechat_series_del_action.php?id=2'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
            <tr>
            <td>3</td>
            <td>探庐·桐庐</td>
            <td>
                探庐系列                                            </td>
            <td>
                <a href='wechat_series_del_action.php?id=3'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
            <tr>
            <td>4</td>
            <td>探庐·丽水</td>
            <td>
                探庐系列                                            </td>
            <td>
                <a href='wechat_series_del_action.php?id=6'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
            <tr>
            <td>5</td>
            <td>探庐·苏州</td>
            <td>
                探庐系列                                            </td>
            <td>
                <a href='wechat_series_del_action.php?id=8'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
        </table>

@stop
