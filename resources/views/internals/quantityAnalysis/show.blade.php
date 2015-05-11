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
        <li class="active">{{ trans('breadcrumbs.quantity_analysis_with_name', ['quantity_analysis_name' => $quantityAnalysis['name']]) }}</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $quantityAnalysis['name'] }}
                <a class="pull-right" href="/internals/quantity-analysis/{{ $quantityAnalysis['id']}}/edit"><span class="glyphicon glyphicon-pencil"></span> {{ trans('quantityAnalysis.edit') }}</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul>
                @foreach (array_except($quantityAnalysis, ['id', 'name']) as $key => $value)
                    <li>{{ $key }}：{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
