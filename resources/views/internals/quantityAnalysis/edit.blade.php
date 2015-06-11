@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li>
            <a href="/internals/quantity-analysis">工料分析列表</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/search">搜尋工料分析</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/create">新增工料分析</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">內部作業</a></li>
        <li class="active">編輯工料分析表</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">編輯工料分析表</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="post" action="/internals/quantity-analysis/{{ $quantityAnalysis['id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <label>工料分析表名稱</label>
                <input type="text" name="quantity_analysis_name" value="{{ $quantityAnalysis['name'] }}" class="form-control">
                <hr>
                @foreach (array_except($quantityAnalysis, ['name', 'id']) as $itemName => $itemUnitName)
                    <fieldset>
                        <div class="form-group">
                            <label>項目名稱</label>
                            <input type="text" name="item_name[]" value="{{ $itemName }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>單位</label>
                            <input type="text" name="item_unit_name[]" value="{{ $itemUnitName }}" class="form-control">
                        </div>
                        <hr>
                    </fieldset>
                @endforeach
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
            var $fieldset = $('fieldset').first().clone();

            $fieldset.find('input').removeAttr('value');

            var fieldset = $fieldset.html();

            $('#button-add-item').click(function (e) {
                e.preventDefault();

                $('fieldset').last().after(fieldset);
            });
        });
    </script>
@stop
