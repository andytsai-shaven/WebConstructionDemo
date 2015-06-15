@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">專案管理</a></li>
        <li class="active">專案：{{ $project['project_name'] }}</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                專案：{{ $project['project_name'] }} - 基本資料
                <a class="pull-right" href="/projects/{{ $project['id']}}/edit"><span class="glyphicon glyphicon-pencil"></span> 編輯</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>專案名稱：{{ $project['project_name'] }}</li>
                <li>業主名稱：{{ $project['boss_name'] }}</li>
                <li>監造單位：{{ $project['supervisor'] }}</li>
                <li>營造廠：{{ $project['construction_company'] }}</li>
                <li>工地主任：{{ $project['site_director'] }}</li>
                <li>品管人員：{{ $project['quality_control_personnel'] }}</li>
                <li>安衛人員：{{ $project['safety_personnel'] }}</li>
                <li>開始日期：{{ $project['beginning_date'] }}</li>
                <li>完成日期：{{ $project['ending_date'] }}</li>
                <li>工程總價：{{ $project['construction_costs'] }}</li>
                <li>注意事項：{{ $project['precautions'] }}</li>
            </ul>
        </div>
    </div>
@stop
