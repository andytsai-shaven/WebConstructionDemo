@extends('projects/_master')

@section('projectsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/projects">專案管理</a></li>
        <li class="active">專案列表</li>
    </ol>
@stop

@section('projectsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">專案列表</h3>
        </div>
        <div class="panel-body">
            @if (!empty($projects))
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>專案名稱</th>
                    <th>完成日期</th>
                    <th>業主名稱</th>
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
                                <a class="btn btn-primary" href="/projects/{{ $idx }}" role="button">進入</a>
                                <button type="submit" class="btn btn-danger">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <p class="text-center text-muted">
                    目前暫時沒有專案
                </p>
            @endif
        </div>
    </div>
@stop
