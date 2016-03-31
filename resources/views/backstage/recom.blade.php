@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <h3>设置显示在主页推荐中的区域</h3>
    @foreach($areas as $area)
        <div class="checkbox">
            <label>
                <input type="checkbox"> {{ $area->value }}
            </label>
        </div>
    @endforeach
    <select name="casa" class="form-control" id="sel">
        @foreach($areas as $area)
            <option value="{{ $area->id }}">{{ $area->id }}--{{ $area->value }}</option>
        @endforeach
    </select>
@endsection