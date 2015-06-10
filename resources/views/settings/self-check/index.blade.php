@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li class="active">自主檢查表管理</li>
    </ol>
@stop

@section('settingsBody')
    <p><a class="btn btn-default" href="/settings/self-check/create">新增自主檢查表</a></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">自訂自主檢查表列表</h3>
        </div>
        <div class="panel-body">
            @if (count($selfChecks))
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>自主檢查表名稱</th>
                        <th><!-- Actions --></th>
                    </tr>
                    @foreach ($selfChecks as $idx => $selfCheck)
                        <tr>
                            <td>{{ $idx }}</td>
                            <td>{{ $selfCheck['name'] }}</td>
                            <td>
                                <form class="form-inline" action="/settings/self-check/{{ $idx }}" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{-- <a class="btn btn-primary" href="/settings/works/{{ $idx }}" role="button">{{ trans('projects.enter_project') }}</a> --}}
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="text-center text-muted">
                    暫時沒有自訂工作項目
                </p>
            @endif
        </div>
    </div>
@stop
