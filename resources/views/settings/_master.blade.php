@extends('_master')

@section('body')
    <div class="row">
        <div class="col-md-12">@yield('settingsBreadcrumbs')</div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <ul id="sub-navigations" class="nav nav-pills nav-stacked">
                <li>
                    <a href="#">個人資料管理</a>
                </li>
                <li>
                    <a href="#">權限管理</a>
                </li>
                <li>
                    <a href="#">協力廠商管理</a>
                </li>
                <li
                    @if (str_contains($path, 'settings/works'))
                        class="active"
                    @endif
                >
                    <a href="/settings/works">工作項目管理</a>
                </li>
                <li
                    @if (str_contains($path, 'settings/self-check'))
                        class="active"
                    @endif
                >
                    <a href="/settings/self-check">自主檢查表管理</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            @yield('settingsBody')
        </div>
    </div>
@stop
