@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <h3>设置显示在民宿推荐中的民宿</h3>
    @foreach($areas as $area)
        <select name="" id="">{{ $area->value }}</select>
    @endforeach
    <input type="hidden" value="" name="city">
    <button type="submit" class="btn btn-default">保存</button>
@endsection