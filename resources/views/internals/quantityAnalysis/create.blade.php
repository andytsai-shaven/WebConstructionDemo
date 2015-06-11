@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li @if (!str_contains($path, ['quantity-analysis/create', 'quantity-analysis/search'])) class="active" @endif>
            <a href="/internals/quantity-analysis">工料分析列表</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/search')) class="active" @endif>
            <a href="/internals/quantity-analysis/search">搜尋工料分析</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/create')) class="active" @endif>
            <a href="/internals/quantity-analysis/create">新增工料分析</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">內部作業</a></li>
        <li class="active">新增工料分析表</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">新增工料分析表</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="post" action="/internals/quantity-analysis">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>工料分析表名稱</label>
                <input type="text" name="quantity_analysis_name" class="form-control">
                <hr>
                <fieldset>
                    <div class="form-group">
                        <label>項目名稱</label>
                        <input type="text" name="item_name[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>單位</label>
                        <input type="text" name="item_unit_name[]" class="form-control">
                    </div>
                    <hr>
                </fieldset>
                <button type="button" class="btn btn-default" id="button-add-item">新增項目</button>
                <hr>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">
                    取消
                </a>
                <button type="submit" class="btn btn-primary">新增</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var fieldset = $('fieldset').first().html();

            $('#button-add-item').click(function (e) {
                e.preventDefault();

                $('fieldset').last().after(fieldset);
            });
        });
    </script>
@stop
