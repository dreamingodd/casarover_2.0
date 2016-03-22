@extends('back')

@section('title', '探庐者后台-微信文章列表')

@section('body')
    <input type="hidden" id="page" value="wechat"/>
    <div class="options vertical5">
        <a href="/back/wechatEdit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加微信文章
        </a>
        <a href="/back/wechatList/1">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>探庐系列
        </a>
        <a href="/back/wechatList/2">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>民宿风采
        </a>
        <a href="/back/wechatList/3">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>主题民宿
        </a>
        <a href="/back/wechatList/1/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>标题</th>
            <th>简介</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($wechatArticles as $article)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$article->title}}</td>
                <td class="brief">{{$article->brief}}</td>
                <td>
                    @if ($article->deleted)
                        <a href='wechat_article_recycle_action.php?option=recover&type=&id={{$article->id}}&deleted='>
                            <button type="button" class="btn btn-xs btn-warning">还原</button>
                        </a>
                    @else
                        <a href='wechat_article_edit.php?type=&id={{$article->id}}'>
                            <button type="button" class="btn btn-xs btn-info">编辑</button>
                        </a>
                        <a href='wechat_article_recycle_action.php?option=recycle&type=&id={{$article->id}}'>
                            <button type="button" class="btn btn-xs btn-danger">删除</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@stop
