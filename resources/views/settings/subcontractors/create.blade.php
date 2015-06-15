@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/subcontractors">協力廠商列表</a></li>
        <li class="active">新增協力廠商</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">新增協力廠商 - 基本資料</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/settings/subcontractors">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="">協力廠商名稱</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">負責人名稱</label>
                    <input type="text" name="manager_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">負責人電話</label>
                    <input type="text" name="manager_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">公司電話</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">信箱</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">說明</label>
                    <input type="text" name="comment" class="form-control">
                </div>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">取消</a>
                <button type="submit" class="btn btn-primary">新增</button>
            </form>
        </div>
    </div>
@stop
