@extends('_master')

@section('body')
    <div class="row">
        <div class="col-md-12">@yield('projectsBreadcrumbs')</div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <ul id="sub-navigations" class="nav nav-pills nav-stacked">
                <li @if (!str_contains($path, ['projects/search', 'projects/create'])) class="active" @endif><a href="/projects">專案列表</a></li>
                <li @if (str_contains($path, 'projects/search')) class="active" @endif><a href="/projects/search">專案查詢</a></li>
                <li @if (str_contains($path, 'projects/create')) class="active" @endif><a href="/projects/create">專案新增</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            @yield('projectsBody')
        </div>
    </div>
@stop
