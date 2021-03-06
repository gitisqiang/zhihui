define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wechat/user/index',
                    add_url: 'wechat/user/add',
                    edit_url: 'wechat/user/edit',
                    del_url: 'wechat/user/del',
                    multi_url: 'wechat/user/multi',
                    table: 'wechat_user',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'opneid', title: __('Opneid')},
                        {field: 'nickname', title: __('Nickname')},
                        {field: 'sexdata', title: __('Sexdata'), searchList: {"1":__('Sexdata 1'),"2":__('Sexdata 2')}, formatter: Table.api.formatter.normal},
                        {field: 'city', title: __('City')},
                        {field: 'country', title: __('Country')},
                        {field: 'province', title: __('Province')},
                        {field: 'language', title: __('Language')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'unionid', title: __('Unionid')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});