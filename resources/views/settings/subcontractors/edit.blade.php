@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/subcontractors">協力廠商列表</a></li>
        <li class="active">編輯協力廠商：{{ $subcontractor['name'] }}</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">編輯協力廠商 - 基本資料</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/settings/subcontractors/{{ $subcontractor['id'] }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="">協力廠商名稱</label>
                    <input type="text" name="name" value="{{ $subcontractor['name'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">負責人名稱</label>
                    <input type="text" name="manager_name" value="{{ $subcontractor['manager_name'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">負責人電話</label>
                    <input type="text" name="manager_phone" value="{{ $subcontractor['manager_phone'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">公司電話</label>
                    <input type="text" name="phone" value="{{ $subcontractor['phone'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">信箱</label>
                    <input type="email" name="email" value="{{ $subcontractor['email'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">說明</label>
                    <input type="text" name="comment" value="{{ $subcontractor['comment'] }}" class="form-control">
                </div>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">取消</a>
                <button type="submit" class="btn btn-primary">儲存</button>
            </form>
        </div>
    </div>
@stop
