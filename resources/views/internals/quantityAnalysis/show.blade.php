@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li>
            <a href="/internals/quantity-analysis">工料分析列表</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/search">搜尋工料分析</a>
        </li>
        <li>
            <a href="/internals/quantity-analysis/create">新增工料分析</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">內部作業</a></li>
        <li class="active">工料分析表：{{ $quantityAnalysis['name'] }}</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $quantityAnalysis['name'] }}
                <a class="pull-right" href="/internals/quantity-analysis/{{ $quantityAnalysis['id']}}/edit"><span class="glyphicon glyphicon-pencil"></span> 編輯</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul>
                @foreach (array_except($quantityAnalysis, ['id', 'name']) as $key => $value)
                    <li>{{ $key }}：{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
