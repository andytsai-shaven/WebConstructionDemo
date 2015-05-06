@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">{{ trans('projects.project_management') }}</a></li>
        <li class="active">{{ trans('projects.project_create') }}</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('projects.project_create') }} - {{ trans('projects.basic_infos') }}</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/projects">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('projects.project_name') }}</label>
                    <input type="text" name="project_name" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">{{ trans('projects.boss_name') }}</label>
                    <input type="text" name="boss_name" class="form-control" id="exampleInputEmail2">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">{{ trans('projects.supervisor') }}</label>
                    <input type="text" name="supervisor" class="form-control" id="exampleInputEmail3">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail4">{{ trans('projects.construction_company') }}</label>
                    <input type="text" name="construction_company" class="form-control" id="exampleInputEmail4">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail5">{{ trans('projects.site_director') }}</label>
                    <input type="text" name="site_director" class="form-control" id="exampleInputEmail5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail5">{{ trans('projects.quality_control_personnel') }}</label>
                    <input type="text" name="quality_control_personnel" class="form-control" id="exampleInputEmail5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail6">{{ trans('projects.safety_personnel') }}</label>
                    <input type="text" name="safety_personnel" class="form-control" id="exampleInputEmail6">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail7">{{ trans('projects.beginning_date') }}</label>
                    <input type="date" name="beginning_date" class="form-control" id="exampleInputEmail7">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail8">{{ trans('projects.ending_date') }}</label>
                    <input type="date" name="ending_date" class="form-control" id="exampleInputEmail8">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail9">{{ trans('projects.construction_costs') }}</label>
                    <input type="text" name="construction_costs" class="form-control" id="exampleInputEmail9">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail10">{{ trans('projects.precautions') }}</label>
                    <input type="text" name="precautions" class="form-control" id="exampleInputEmail10">
                </div>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">{{ trans('projects.cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ trans('projects.submit') }}</button>
            </form>
        </div>
    </div>
@stop
