@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/self-check">自主檢查表管理</a></li>
        <li class="active">新增自主檢查表</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">新增自主檢查表</h3>
        </div>
        <div class="panel-body">
            <form id="form-self-check-create" action="/settings/self-check" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="input-name-self-check">檢查表名稱</label>
                    <input type="text" class="form-control" id="input-name-self-check" name="name" v-model="name">
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>項次</th>
                        <th>流程檢查項目</th>
                        <th>{{-- Actions --}}</th>
                    </tr>
                    <tr v-repeat="item: newItems">
                        <td>
                            @{{ $index + 1 }}
                        </td>
                        <td>
                            @{{ item.name }}
                            <input type="hidden" name="item_name[]" value="@{{ item.name }}">
                        </td>
                        <td>
                            @{{ item.details }}
                            <input type="hidden" name="item_details[]" value="@{{ item.details }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" v-on="click: removeItem($index)">刪除</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" name="new_item_index" v-model="newItemIndex" v-on="keypress: addNewItem($event) | key enter"></td>
                        <td><textarea class="form-control" name="new_item_name" v-model="newItemName" v-on="keypress: addNewItem($event) | key enter"></textarea></td>
                        <td><textarea class="form-control" name="new_item_unit" v-model="newItemDetails" v-on="keypress: addNewItem($event) | key enter"></textarea></td>
                        <td><button type="button" class="btn btn-default" v-on="click: addNewItem($event)">新增</button></td>
                    </tr>
                </table>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">取消</a>
                <button type="submit" class="btn btn-primary">新增</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.9.3/lodash.js"></script>
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/store.js/1.3.14/store.min.js"></script>--}}
    <script type="text/javascript">
        window.selfCheckCreate = new Vue({
            el: '#form-self-check-create',
            data: {
                name: '',
                newItemIndex: 1,
                newItemName: '',
                newItemDetails: '',
                newItems: []
            },
            methods: {
                addNewItem: function (e) {
                    e.preventDefault()

                    this.newItems.splice(this.newItemIndex - 1, 0, {
                        name: this.newItemName,
                        details: this.newItemDetails
                    });

                    this.resetData('newItemName', 'newItemDetails', 'newItemIndex');
                },
                removeItem: function ($index) {
                    this.newItems.$remove($index);

                    this.resetData('newItemIndex');
                },
                resetData: function () {
                    var args = Array.prototype.slice.call(arguments);

                    // Default keys to reset
                    if (0 === args.length) {
                        args = ['name', 'newItemName', 'newItemDetails', 'newItems'];
                    }

                    args.forEach(function (key) {
                        switch (key) {
                            case 'newItems':
                                this[key] = [];
                                break;
                            default:
                                this[key] = ''
                        }
                    }, this);

                    this.newItemIndex = this.newItems.length + 1;
                },
                cancel: function (e) {
                    e.preventDefault();

                    this.resetData();
                },
                save: function (e) {
                    e.preventDefault();

                    var name = this.name;

                    window.jQuery.post('/self-check', {
                        '_token': '{{ csrf_token() }}',
                        'name': name,
                        'item_name[]': window._.pluck(this.newItems, 'name'),
                        'item_details[]': window._.pluck(this.newItems, 'details')
                    }).then(function (response) {
                        var id = response.id;

                        window.worksCreate.addSelfCheckOption(name, id);
                    });

                    this.resetData();
                }
            }
        });
    </script>
@stop
