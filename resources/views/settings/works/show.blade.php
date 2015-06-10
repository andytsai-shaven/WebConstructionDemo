@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/works">工作項目管理</a></li>
        <li class="active">工作項目 - {{ $work['name'] }}</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">基本資料</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>工程類別：{{ $types[$work['type'] - 1] }}</li>
                <li>流程順序：{{ $orders[$work['type'] - 1][$work['order']] }}</li>
                <li>單位：{{ $units[$work['unit'] - 1] }}</li>
                <li>隸屬：{{ $work['belongs'] or '資料庫' }}</li>
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">工料分析表</h3>
        </div>
        <div class="panel-body">
            @include('settings/works/_quantityAnalysisTable')
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">自主檢查表 - {{ $selfCheck['name'] }}</h3>
        </div>
        <div class="panel-body">
            @include('settings/works/_selfCheckTable')
        </div>
    </div>
@stop

@section('scripts')

@stop
