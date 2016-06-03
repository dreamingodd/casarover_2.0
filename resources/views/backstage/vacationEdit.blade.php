@extends('back')

@section('title', '探庐者后台-度假卡编辑')

@section('head')
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js">
    </script>
    <script src="/assets/js/integration/json2.js"></script>
    {{--<script src="/assets/js/wxEdit.js"></script>--}}
    <script src="/assets/js/casaSelectModal.js"></script>
    <style>
        .nav-tabs {
            width: 100%;
            float: left;
        }
        .table thead tr td {
            padding: 2px;
        }
        .search{
            width:257px;
            height:26px;
            float:left;
            border-radius: 10px;
            padding-left:17px;
            margin:7px 0;
            border: 1px solid #d5d5d5;
        }
        .search  #search{
            float:left;
            margin-top:2px;
            border:0;
            height:22px;
            line-height:22px;
            width:178px;
        }
        .search button{
            margin-top:0;
            border:0;
            width:22px;
            height:22px;
            color: #6e6e6e;
            background: #fff;
        }
        .search #reset{
            margin-top:0;
            border:0;
            width:22px;
            height:22px;
            color: #6e6e6e;
            background: #fff;
        }
    </style>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <div class="col-lg-11" style="margin-top: -15px">
        <h3>度假卡编辑</h3>
    </div>
    <div class="btn_div col-lg-11">
        <button class="btn btn-primary submit_btn">提交</button>
        <button type="button" class="btn btn-default goback">返回</button>
    </div>
    <br/>
    <form id="wx_casa_form" action="/back/vacation/edit/{{$id}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{ $card->id or null }}"/>
        <input type="hidden" name="contents" id="contents"/>
        <div class="name col-lg-11">
            <div class="input-group input-group-sm col-lg-3">
                <span class="input-group-addon">名称</span>
                <input name="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                       value="{{$card->name or null}}"/>
            </div>
        </div>
        <div class="brief col-lg-11">
            <div class="input-group input-group-sm col-lg-9">
                <span class="input-group-addon">简介</span>
                <input name="brief" type="text" class="form-control" aria-describedby="sizing-addon3"
                       value="{{$card->brief or null}}" />
            </div>
        </div>
        <div class="col-lg-11">
            <h4>添加民宿</h4>
            <input type="text" id="select-casa" class="form-control disabled" data-toggle="modal"
                   data-target="#casaSelectModal" readonly value="选择民宿">
            <p class="text-danger">ps:如果选择中没有请新建</p>
            <a href="/back/wx/casa">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>新建
            </a>
            <table class="table">
                @if(isset($wxcasas))
                <thead>
                <tr>
                    <th>序号</th>
                    <th>民宿名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="cardcasa">
                @foreach($wxcasas as $keys=>$wxcasa)
                    <tr>
                        <th>
                            {{$keys+1}}
                            <input type="hidden" name="casaId[]" value="{{ $wxcasa->wxCasa->id or null }}"/>
                        </th>
                        <th scope="row">
                            {{$wxcasa->wxCasa->name }}
                        </th>
                        <th>
                            <a href='/back/wx/casa/{{$wxcasa->wxCasa->id}}'>
                                <button type="button" class="btn btn-xs btn-info">编辑</button>
                            </a>
                            <a href='/back/vacation/del'>
                                <button class="btn btn-xs btn-danger" >删除</button>
                            </a>
                        </th>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </form>
    <div class="btn_div col-lg-11">
        <button class="btn btn-primary submit_btn">提交</button>
        <button type="button" class="btn btn-default goback">返回</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="casaSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">搜索</h4>
                </div>
                <div class="modal-body" style="height:500px; overflow:scroll;">
                    <div class="search">
                        <input type="text" value="" id="search" />
                        <button class="glyphicon glyphicon-search" type="button" id="enlarge"></button>
                        <button class="glyphicon glyphicon-repeat" type="button" id="reset"></button>
                    </div>
                    <table class="table table-hover">
                        @foreach($casas as $key=>$casa)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td class="casaname">{{ $casa->name }}</td>
                                <td><button type="button" class="btn btn-info btn-sm addcasa" >添加</button></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.submit_btn').click(function(){
            var form = $('#wx_casa_form');
            form.submit();
        });
        $('.addcasa').click(function () {
        })
    </script>
@stop
