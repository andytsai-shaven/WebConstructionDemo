@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li class="active">工作項目管理</li>
    </ol>
@stop

@section('settingsBody')
    <p><a class="btn btn-default" href="/settings/works/create">新增工作項目</a></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">自訂工作項目列表</h3>
        </div>
        <div class="panel-body">
            @if (!empty($works))
            <table class="table table-striped">
                <tr>
                    <th>工程類別</th>
                    <th>工程順序</th>
                    <th>工項名稱</th>
                    <th>隸屬專案</th>
                    <th>工程單位</th>
                    <th><!-- Actions --></th>
                </tr>
                @foreach ($works as $idx => $work)
                    <tr>
                        <td>{{ $types[$work['type'] - 1] }}</td>
                        <td>{{ $orders[$work['type'] - 1][$work['order'] - 1] }}</td>
                        <td><a href="/settings/works/{{ $idx }}">{{ $work['name'] }}</a></td>
                        <td>{{ $work['belongs'] or '資料庫' }}</td>
                        <td>{{ $units[$work['unit'] - 1] }}</td>
                        <td>
                            <form class="form-inline" action="/settings/works/{{ $idx }}" method="post">
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
                    暫時沒有自訂工作項目
                </p>
            @endif
        </div>
    </div>
@stop
