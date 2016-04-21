@extends('back')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="/assets/js/recomCasa.js"></script>
@endsection
@section('body')
    <div class="alert alert-success tip"  role="alert">修改成功</div>
    <div id="main">
        <div class="col-md-3">
            <a href="#" aria-label="Previous" onclick="history.back()">
                <span aria-hidden="true">&laquo;返回</span>
            </a>
            <h4>设置每个城市的推荐民宿</h4>
            <select name="" id="" class="form-control" v-model="selected" v-on:change="getcasa">
                @foreach($areas as $area)
                    <option value={{ $area->id }}>{{ $area->value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <div class="checkbox" v-for="casa in casas">
                <div class="col-md-6">
                    <label>
                        <input type="checkbox" value="@{{ casa.id }}"  v-model="checkedNames">@{{ casa.code }}--@{{ casa.name }}
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" v-on:click="save" class="btn btn-default">保存</button>
        </div>
    </div>
@endsection