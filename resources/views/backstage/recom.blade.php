@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/recom.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div id="check">
        <h3>设置显示在民宿推荐中的城市</h3>
        @foreach($areas as $area)
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="{{ $area->id }}" v-model="checkedNames"
                    @if($area->status == 1)
                        {!! 'checked="checked"' !!}
                            @endif
                    > {{ $area->value }}
                </label>
            </div>
        @endforeach
        <form action="recom/update" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" value="@{{ checkedNames }}" name="city">
            <button type="submit" class="btn btn-default">保存</button>
        </form>
    </div>
    <a href="">去设置城市下面的民宿</a>
@endsection