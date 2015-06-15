@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li @if (!str_contains($path, ['quantity-analysis/create', 'quantity-analysis/search'])) class="active" @endif>
            <a href="/internals/quantity-analysis">工料分析列表</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/search')) class="active" @endif>
            <a href="/internals/quantity-analysis/search">搜尋工料分析</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/create')) class="active" @endif>
            <a href="/internals/quantity-analysis/create">新增工料分析</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">內部作業</a></li>
        <li class="active">工料分析列表</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">工料分析表列表</h3>
        </div>
        <div class="panel-body">
            @if (!empty($quantityAnalysisList))
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>工料分析表名稱</th>
                    <th><!-- Actions --></th>
                </tr>
                @foreach ($quantityAnalysisList as $idx => $quantityAnalysis)
                    <tr>
                        <td>{{ $idx }}</td>
                        <td>{{ $quantityAnalysis['name'] }}</td>
                        <td>
                            <form class="form-inline" action="/internals/quantity-analysis/{{ $idx }}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a class="btn btn-primary" href="/internals/quantity-analysis/{{ $idx }}" role="button">進入</a>
                                <button type="submit" class="btn btn-danger">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <p class="text-center text-muted">
                    目前暫時沒有工料分析表
                </p>
            @endif
        </div>
    </div>
@stop
