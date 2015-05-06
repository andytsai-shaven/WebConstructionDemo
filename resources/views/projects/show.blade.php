@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">{{ trans('projects.project_management') }}</a></li>
        <li class="active">{{ trans('projects.project_title', ['project_name' => $project['project_name']]) }}</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ trans('projects.project_title', ['project_name' => $project['project_name']]) }} - {{ trans('projects.basic_infos') }}
                <a class="pull-right" href="/projects/{{ $project['id']}}/edit"><span class="glyphicon glyphicon-pencil"></span> {{ trans('projects.edit_project') }}</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul>
                @foreach (array_except($project, ['id']) as $key => $value)
                    <li>{{ trans("projects.$key") }}：{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
