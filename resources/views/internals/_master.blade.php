@extends('_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li @if (str_contains($path, 'internals/quantity-analysis/create')) class="active" @endif>
            <a href="/internals/cost-estimate">{{ trans('subNavigations.cost_estimate') }}</a>
        </li>
        <li @if (str_contains($path, 'internals/quantity-analysis')) class="active" @endif>
            <a href="/internals/quantity-analysis">{{ trans('subNavigations.quantity_analysis') }}</a>
        </li>
        <li @if (str_contains($path, 'internals/contract-management')) class="active" @endif>
            <a href="/internals/contract-management">{{ trans('subNavigations.contract_management') }}</a>
        </li>
    </ul>
@stop

@section('body')
    <div class="row">
        <div class="col-md-12">@yield('internalsBreadcrumbs')</div>
    </div>
    <div class="row">
        <div class="col-md-2">
            @yield('subNavigations')
        </div>
        <div class="col-md-10">
            @yield('internalsBody')
        </div>
    </div>
@stop
