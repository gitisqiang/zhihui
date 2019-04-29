define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'advertising/adminad/index',
                    add_url: 'advertising/adminad/add',
                    edit_url: 'advertising/adminad/edit',
                    del_url: 'advertising/adminad/del',
                    multi_url: 'advertising/adminad/multi',
                    table: 'admin_ad',
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
                        {field: 'adimage', title: __('Adimage'), formatter: Table.api.formatter.image},
                        {field: 'ad_name', title: __('Ad_name')},
                        {field: 'ad_link', title: __('Ad_link')},
                        {field: 'starttime', title: __('Starttime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'endtime', title: __('Endtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'man', title: __('Man')},
                        // {field: 'shop_id', title: __('Shop_id')},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'num', title: __('Num')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
                        {field: 'ad_position.position_name', title: __('Category_id')},
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