define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'address/index',
                    add_url: 'address/add',
                    edit_url: 'address/edit',
                    del_url: 'address/del',
                    multi_url: 'address/multi',
                    table: 'address',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'region_id',
                sortName: 'region_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'region_id', title: __('Region_id')},
                        {field: 'parent_id', title: __('Parent_id')},
                        {field: 'region_name', title: __('Region_name')},
                        {field: 'region_type', title: __('Region_type')},
                        {field: 'agency_id', title: __('Agency_id')},
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