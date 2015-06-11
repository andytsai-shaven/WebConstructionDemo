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
        <li class="active">搜尋工料分析</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">搜尋工料分析表</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/internals/quantity-analysis/search">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">搜尋工料分析表</label>
                    <input type="text" name="target" value="{{ $target or '' }}" class="form-control" id="exampleInputEmail1">
                </div>
                <button type="submit" class="btn btn-primary">搜尋</button>
            </form>
        </div>
    </div>

    @if (isset($quantityAnalysisList))
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">搜尋結果</h3>
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
                    查無相關工料分析表
                </p>
            @endif
        </div>
    </div>
    @endif
@stop
