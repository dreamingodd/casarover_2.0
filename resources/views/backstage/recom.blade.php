@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/recom.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div class="col-md-12">
        <div class="col-md-3">
            <h4>设置显示在民宿推荐中的城市</h4>
        </div>
        <div class="col-md-9">
            <a href="/back/casarecom/">
                <h4>去管理城市下属民宿</h4>
            </a>
        </div>
    </div>
    <div id="check">
        @foreach($areas as $area)
            <div class="col-md-6">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="{{ $area->id }}" v-model="checkedNames"
                        @if($area->status == 1)
                            {!! 'checked="checked"' !!}
                                @endif
                        > {{ $area->value }}
                    </label>
                </div>
            </div>
        @endforeach
        <div class="col-md-12">
            <form action="recom/update" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="@{{ checkedNames }}" name="city">
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
@endsection