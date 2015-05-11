@extends('internals/_master')

@section('subNavigations')
    <ul id="sub-navigations" class="nav nav-pills nav-stacked">
        <li @if (!str_contains($path, ['quantity-analysis/create', 'quantity-analysis/search'])) class="active" @endif>
            <a href="/internals/quantity-analysis">{{ trans('subNavigations.quantity_analysis_list') }}</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/search')) class="active" @endif>
            <a href="/internals/quantity-analysis/search">{{ trans('subNavigations.quantity_analysis_search') }}</a>
        </li>
        <li @if (str_contains($path, 'quantity-analysis/create')) class="active" @endif>
            <a href="/internals/quantity-analysis/create">{{ trans('subNavigations.quantity_analysis_create') }}</a>
        </li>
    </ul>
@stop

@section('internalsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/internals">{{ trans('breadcrumbs.internals')}}</a></li>
        <li class="active">{{ trans('breadcrumbs.quantity_analysis_search') }}</li>
    </ol>
@stop

@section('internalsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('quantityAnalysis.search') }}</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/internals/quantity-analysis/search">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('quantityAnalysis.search') }}</label>
                    <input type="text" name="target" value="{{ $target or '' }}" class="form-control" id="exampleInputEmail1">
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('quantityAnalysis.submit_search') }}</button>
            </form>
        </div>
    </div>

    @if (isset($quantityAnalysisList))
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('quantityAnalysis.search_result') }}</h3>
        </div>
        <div class="panel-body">
            @if (!empty($quantityAnalysisList))
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>{{ trans('quantityAnalysis.name') }}</th>
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
                                <a class="btn btn-primary" href="/internals/quantity-analysis/{{ $idx }}" role="button">{{ trans('quantityAnalysis.enter')}}</a>
                                <button type="submit" class="btn btn-danger">{{ trans('quantityAnalysis.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <p class="text-center text-muted">
                    {{ trans('quantityAnalysis.search_result_empty') }}
                </p>
            @endif
        </div>
    </div>
    @endif
@stop
