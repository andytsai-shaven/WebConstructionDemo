@extends('_master')

@section('body')
    <div class="row">
        <div class="col-md-12">@yield('internalsBreadcrumbs')</div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <ul id="sub-navigations" class="nav nav-pills nav-stacked">
                <li @if (str_contains($path, 'internals/cost-estimate')) class="active" @endif><a href="/internals/cost-estimate">成本估算</a></li>
                <li @if (str_contains($path, 'internals/quantity-analysis')) class="active" @endif><a href="/internals/quantity-analysis">工料分析</a></li>
                <li @if (str_contains($path, 'internals/contract-management')) class="active" @endif><a href="/internals/contract-management">合約管理</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            @yield('internalsBody')
        </div>
    </div>
@stop
