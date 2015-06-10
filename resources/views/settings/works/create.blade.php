@extends('settings/_master')

@section('settingsBreadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/settings">設定</a></li>
        <li><a href="/settings/works">工作項目管理</a></li>
        <li class="active">新增工項</li>
    </ol>
@stop

@section('settingsBody')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">新增工項 - 基本資料</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/settings/works" id="vue-form-works-create">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="belongs" value="資料庫">
                <div class="form-group">
                    <label for="">工程類別</label>
                    <select class="form-control" name="type" v-model="typeOption" options="typeOptions"></select>
                </div>
                <div class="form-group">
                    <label for="">流程順序</label>
                    <select class="form-control" name="order" v-model="orderOption" options="orderOptions[typeOption-1]"></select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">工項名稱</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="">單位</label>
                    <select class="form-control" name="unit" v-model="unitOption" options="unitOptions"></select>
                </div>
                <div class="form-group">
                    <p><label>工料分析表</label></p>

                    {{-- Preview quantity items --}}
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>項目名稱</th>
                            <th>單位</th>
                            <th>{{-- Actions --}}</th>
                        </tr>
                        <tr v-repeat="item: items">
                            <td>@{{ $index + 1 }}</td>
                            <td>
                                @{{ item.name }}
                                <input type="hidden" name="item_name[]" value="@{{ item.name }}">
                            </td>
                            <td>
                                @{{ item.unit }}
                                <input type="hidden" name="item_unit[]" value="@{{ item.unit }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" v-on="click: removeItem($index)">刪除</button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="new_item_index" v-model="newItemIndex" v-on="keypress: addNewItem($event) | key enter"></td>
                            <td><input type="text" class="form-control" name="new_item_name" v-model="newItemName" v-on="keypress: addNewItem($event) | key enter"></td>
                            <td><input type="text" class="form-control" name="new_item_unit" v-model="newItemUnit" v-on="keypress: addNewItem($event) | key enter"></td>
                            <td><button type="button" class="btn btn-default" v-on="click: addNewItem($event)">新增</button></td>
                        </tr>
                    </table>



                </div>
                <div class="form-group">
                    <p>
                        <label for="">自主檢查表</label>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-self-check-create" data-backdrop="static">
                            新增
                        </button>
                    </p>

                    <select class="form-control" name="self_check" v-model="selfCheckOption" options="selfCheckOptions"></select>
                </div>
                <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}" role="button">取消</a>
                <button type="submit" class="btn btn-primary">新增</button>
            </form>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modal-self-check-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">新增自主檢查表</h4></div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="input-name-self-check-create">檢查表名稱</label>
                            <input type="text" class="form-control" id="input-name-self-check-create" name="name" v-model="name">
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
                                    <input type="hidden" name="name[]" value="@{{ item.name }}">
                                </td>
                                <td>
                                    @{{ item.details }}
                                    <input type="hidden" name="details[]" value="@{{ item.details }}">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" v-on="click: cancel($event)">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" v-on="click: save($event)">Save</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.9.3/lodash.js"></script>
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/store.js/1.3.14/store.min.js"></script>--}}
    <script type="text/javascript">
        window.worksCreate = new Vue({
            el: '#vue-form-works-create',
            data: {
                typeOption: 1,
                orderOption: 1,
                unitOption: 1,
                selfCheckOption: 1,
                items: [],
                newItemIndex: 1,
                newItemName: '',
                newItemUnit: '',
                selfCheckOptions: [
                    {text: '請選擇或新增自主檢查表', value: '1'}
                ],
                typeOptions: [],
                orderOptions: [],
                unitOptions: []
            },
            methods: {
                addNewItem: function (e) {
                    e.preventDefault()

                    this.$data.items.splice(this.$data.newItemIndex - 1, 0, {
                        name: this.$data.newItemName,
                        unit: this.$data.newItemUnit
                    });

                    this.$data.newItemIndex = this.$data.items.length + 1;
                    this.$data.newItemName = '';
                    this.$data.newItemUnit = '';
                },
                removeItem: function ($index) {
                    this.$data.items.$remove($index);

                    this.$data.newItemIndex = this.$data.items.length + 1;
                },
                addSelfCheckOption: function (text, value) {
                    this.selfCheckOptions.push({
                        text: text,
                        value: value
                    });

                    this.selfCheckOption = value;
                }
            },
            ready: function () {
                var that = this;

                // Get types
                window.jQuery.get('/settings/works/types').then(function (response) {
                    window._.forEach(response.types, function (type, typeIndex) {
                        that.typeOptions.push({
                            text: type,
                            value: typeIndex + 1
                        });
                    });
                });

                // Get orders
                window.jQuery.get('/settings/works/orders').then(function (response) {
                    window._.forEach(response.orders, function (orderSet, orderSetIndex) {
                        var newOrderSet = [];

                        window._.forEach(orderSet, function (order, orderIndex) {
                            newOrderSet.push({
                                text: order,
                                value: orderIndex + 1
                            });
                        });

                        that.orderOptions.push(newOrderSet);
                    });
                });

                // Get units
                window.jQuery.get('/settings/works/units').then(function (response) {
                    window._.forEach(response.units, function (unit, unitIndex) {
                        that.unitOptions.push({
                            text: unit,
                            value: unitIndex + 1
                        });
                    });
                });

                // Get self-check
                window.jQuery.get('/self-check').then(function (response) {
                    window._.forEach(response.selfChecks, function (selfCheck, selfCheckId) {
                        that.selfCheckOptions.push({
                            text: selfCheck['name'],
                            value: selfCheckId
                        });
                    });
                });
            }
        });

        window.selfCheckCreate = new Vue({
            el: '#modal-self-check-create',
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
