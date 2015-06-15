@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">專案管理</a></li>
        <li class="active">專案新增</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">專案新增 - 基本資料</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/projects/{{ $project['id'] }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">專案名稱</label>
                    <input type="text" name="project_name" value="{{ $project['project_name'] }}" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">業主名稱</label>
                    <input type="text" name="boss_name" value="{{ $project['boss_name'] }}" class="form-control" id="exampleInputEmail2">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">監造單位</label>
                    <input type="text" name="supervisor" value="{{ $project['supervisor'] }}" class="form-control" id="exampleInputEmail3">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail4">營造廠</label>
                    <input type="text" name="construction_company" value="{{ $project['construction_company'] }}" class="form-control" id="exampleInputEmail4">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail5">工地主任</label>
                    <input type="text" name="site_director" value="{{ $project['site_director'] }}" class="form-control" id="exampleInputEmail5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail5">品管人員</label>
                    <input type="text" name="quality_control_personnel" value="{{ $project['quality_control_personnel'] }}" class="form-control" id="exampleInputEmail5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail6">安衛人員</label>
                    <input type="text" name="safety_personnel" value="{{ $project['safety_personnel'] }}" class="form-control" id="exampleInputEmail6">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail7">開始日期</label>
                    <input type="date" name="beginning_date" value="{{ $project['beginning_date'] }}" class="form-control" id="exampleInputEmail7">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail8">完成日期</label>
                    <input type="date" name="ending_date" value="{{ $project['ending_date'] }}" class="form-control" id="exampleInputEmail8">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail9">工程總價</label>
                    <input type="text" name="construction_costs" value="{{ $project['construction_costs'] }}" class="form-control" id="exampleInputEmail9">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail10">注意事項</label>
                    <input type="text" name="precautions" value="{{ $project['precautions'] }}" class="form-control" id="exampleInputEmail10">
                </div>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">取消</a>
                <button type="submit" class="btn btn-primary">確認</button>
            </form>
        </div>
    </div>
@stop
