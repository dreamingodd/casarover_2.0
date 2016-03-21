@extends('back')

@section('title','区域列表')

@section('body')
    <input type="hidden" id="page" value="area"/>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
            <th></th>
        </tr>
        <?php $number = 1;?>
        @foreach($areas as $area)
            <tr>
                <td>{{ $number ++ }}</td>
                <td>{{ $area->id }}</td>
                <td>{{ $area->value }}</td>
                <td>
                    <a href='{!! URL::route('back.areas.edit',array('areas'=>$area->id)) !!}'>
                        <button type="button" class="btn btn-xs btn-info">编辑</button>
                    </a>
                </td>
                <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                  Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                    {{--<form method="POST" action="{{ route('back.areas.destroy', $area->id) }}">--}}
                        {{--<input type="hidden" name="token" value="{{ csrf_token() }}">--}}
                        {{--<input type="hidden" name="_method" value="DELETE">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit" class="btn btn-danger">--}}
                            {{--<i class="fa fa-times-circle"></i> Yes--}}
                        {{--</button>--}}
                    {{--</form>--}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
