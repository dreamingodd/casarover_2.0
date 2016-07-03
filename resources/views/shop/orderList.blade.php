@extends('shop.base')
@section('body')
    <div class="container">
        <div class="title">
            <div class="condition">全部</div>
            <div class="condition">未预约</div>
            <div class="condition">已预约</div>
            <div class="condition">已取消</div>
            <div class="condition">已入住</div>
        </div>

        <form class="form-inline" style="float:right; margin:3px">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="exampleInputAmount" placeholder="搜索卡号，手机号，用户名">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">搜索</button>
        </form>
        <table class="table table-bordered table-striped" style="text-align:center">
            <thead >
                <tr style="text-align:center">
                    <th style="text-align:center">序号</th>
                    <th style="text-align:center">卡号</th>
                    <th style="text-align:center">入住人信息</th>
                    <th style="text-align:center">数量</th>
                    <th style="text-align:center">预订时间</th>
                    <th style="text-align:center">房型</th>
                    <th style="text-align:center">操作</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i < 10; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>12345</td>
                        <td>小明</td>
                        <td>2</td>
                        <td>时间开始-时间结束</td>
                        <td>
                            大床房非周末
                        </td>
                        <td>
                            <button type="button" name="button" class="btn btn-defalut">编辑</button>
                        </td>
                    </tr>

                @endfor
            </tbody>
        </table>
    </div>
@endsection
