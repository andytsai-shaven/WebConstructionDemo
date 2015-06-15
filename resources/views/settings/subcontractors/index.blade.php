@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li class="active">協力廠商首頁</li>
    </ol>
@stop

@section('settingsBody')
    <p><a class="btn btn-default" href="/settings/subcontractors/create">新增協力廠商</a></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">協力廠商列表</h3>
        </div>
        <div class="panel-body">
            @if (!empty($subcontractors))
            <table class="table table-striped">
                <tr>
                    <th>協力廠商名稱</th>
                    <th>公司電話</th>
                    <th>說明</th>
                    <th><!-- Actions --></th>
                </tr>
                @foreach ($subcontractors as $idx => $subcontractor)
                    <tr>
                        <td><a href="/settings/subcontractors/{{ $idx }}">{{ $subcontractor['name'] }}</a></td>
                        <td>{{ $subcontractor['phone'] }}</td>
                        <td>{{ $subcontractor['comment'] }}</td>
                        <td>
                            <form class="form-inline" action="/settings/subcontractors/{{ $idx }}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <p class="text-center text-muted">
                    暫時沒有協力廠商
                </p>
            @endif
        </div>
    </div>
@stop
