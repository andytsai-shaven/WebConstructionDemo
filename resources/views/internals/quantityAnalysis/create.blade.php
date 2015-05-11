@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li @if (!str_contains($path, ['quantity-analysis/create', 'quantity-analysis/search'])) class="active" @endif>
            <a href="/internals/quantity-analysis">{{ trans('subNavigations.quantity_analysis_list') }}</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/search')) class="active" @endif>
            <a href="/internals/quantity-analysis/search">{{ trans('subNavigations.quantity_analysis_search') }}</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/create')) class="active" @endif>
            <a href="/internals/quantity-analysis/create">{{ trans('subNavigations.quantity_analysis_create') }}</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">{{ trans('breadcrumbs.internals')}}</a></li>
        <li class="active">{{ trans('breadcrumbs.quantity_analysis_create')}}</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('quantityAnalysis.quantity_analysis_create') }}</h3>
        </div>
        <div class="panel-body">
            <form class="form-inline" method="post" action="/internals/quantity-analysis">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>{{ trans('quantityAnalysis.name') }}</label>
                <input type="text" name="quantity_analysis_name" class="form-control">
                <hr>
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('quantityAnalysis.item_name') }}</label>
                        <input type="text" name="item_name[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('quantityAnalysis.item_unit_name') }}</label>
                        <input type="text" name="item_unit_name[]" class="form-control">
                    </div>
                    <hr>
                </fieldset>
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
            var fieldset = $('fieldset').first().html();

            $('#button-add-item').click(function (e) {
                e.preventDefault();

                $('fieldset').last().after(fieldset);
            });
        });
    </script>
@stop
