@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">{{ trans('projects.project_management') }}</a></li>
        <li class="active">{{ trans('projects.project_search') }}</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('projects.project_search') }}</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/projects/search">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('projects.search_target') }}</label>
                    <input type="text" name="target" value="{{ $target or '' }}" class="form-control" id="exampleInputEmail1">
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('projects.submit_search') }}</button>
            </form>
        </div>
    </div>

    @if (isset($projects))
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('projects.search_result') }}</h3>
        </div>
        <div class="panel-body">
            @if (!empty($projects))
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>{{ trans('projects.project_name') }}</th>
                    <th>{{ trans('projects.ending_date') }}</th>
                    <th>{{ trans('projects.boss_name') }}</th>
                    <th><!-- Actions --></th>
                </tr>
                @foreach ($projects as $idx => $project)
                    <tr>
                        <td>{{ $idx }}</td>
                        <td>{{ $project['project_name'] }}</td>
                        <td>{{ $project['ending_date'] }}</td>
                        <td>{{ $project['boss_name'] }}</td>
                        <td>
                            <form class="form-inline" action="/projects/{{ $idx }}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a class="btn btn-primary" href="/projects/{{ $idx }}" role="button">{{ trans('projects.enter_project') }}</a>
                                <button type="submit" class="btn btn-danger">{{ trans('projects.delete_project') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <p class="text-center text-muted">
                    {{ trans('projects.search_result_empty') }}
                </p>
            @endif
        </div>
    </div>
    @endif
@stop
