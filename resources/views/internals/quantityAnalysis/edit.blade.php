@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li>
            <a href="/internals/quantity-analysis">{{ trans('subNavigations.quantity_analysis_list') }}</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/search">{{ trans('subNavigations.quantity_analysis_search') }}</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/create">{{ trans('subNavigations.quantity_analysis_create') }}</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">{{ trans('breadcrumbs.internals')}}</a></li>
        <li class="active">{{ trans('breadcrumbs.quantity_analysis_edit')}}</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('quantityAnalysis.quantity_analysis_edit') }}</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="post" action="/internals/quantity-analysis/{{ $quantityAnalysis['id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <label>{{ trans('quantityAnalysis.name') }}</label>
                <input type="text" name="quantity_analysis_name" value="{{ $quantityAnalysis['name'] }}" class="form-control">
                <hr>
                @foreach (array_except($quantityAnalysis, ['name', 'id']) as $itemName => $itemUnitName)
                    <fieldset>
                        <div class="form-group">
                            <label>{{ trans('quantityAnalysis.item_name') }}</label>
                            <input type="text" name="item_name[]" value="{{ $itemName }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('quantityAnalysis.item_unit_name') }}</label>
                            <input type="text" name="item_unit_name[]" value="{{ $itemUnitName }}" class="form-control">
                        </div>
                        <hr>
                    </fieldset>
                @endforeach
                <button type="button" class="btn btn-default" id="button-add-item">{{ trans('quantityAnalysis.add_item') }}</button>
                <hr>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">
                    {{ trans('quantityAnalysis.cancel_creation') }}
                </a>
                <button type="submit" class="btn btn-primary">{{ trans('quantityAnalysis.submit_creation') }}</button>
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
