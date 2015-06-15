@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/subcontractors">協力廠商列表</a></li>
        <li class="active">協力廠商：{{ $subcontractor['name'] }}</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                基本資料
                <a class="pull-right" href="/settings/subcontractors/{{ $subcontractor['id'] }}/edit"><span class="glyphicon glyphicon-pencil"></span> 編輯</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>協力廠商名稱：{{ $subcontractor['name'] }}</li>
                <li>負責人名稱：{{ $subcontractor['manager_name'] }}</li>
                <li>負責人電話：{{ $subcontractor['manager_phone'] }}</li>
                <li>公司電話：{{ $subcontractor['phone'] }}</li>
                <li>信箱：{{ $subcontractor['email'] }}</li>
                <li>說明：{{ $subcontractor['comment'] }}</li>
            </ul>
        </div>
    </div>
@stop
