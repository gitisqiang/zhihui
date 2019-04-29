define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'shops/shop/index',
                    add_url: 'shops/shop/add',
                    edit_url: 'shops/shop/edit',
                    del_url: 'shops/shop/del',
                    multi_url: 'shops/shop/multi',
                    table: 'shop',
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
                        {field: 'shop_name', title: __('Shop_name')},
                        {field: 'shop_img', title: __('Shop_img'),formatter: Table.api.formatter.image},
                        {field: 'shop_logo', title: __('Shop_logo'),formatter: Table.api.formatter.image},
                        {field: 'city', title: __('City')},
                        {field: 'address', title: __('Address')},
                        {field: 'location_name', title: __('Location_name')},
                        {field: 'do_start_time', title: __('Do_start_time')},
                        {field: 'do_end_time', title: __('Do_end_time')},
                        {field: 'is_receiving', title: __('Is_receiving'), searchList: {"0":__('Is_receiving 0'),"1":__('Is_receiving 1')}, formatter: Table.api.formatter.normal},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        {field: 'showdata', title: __('Showdata'), searchList: {"0":__('Showdata 0'),"1":__('Showdata 1')}, formatter: Table.api.formatter.normal},
                        {field: 'is_bestdata', title: __('Is_bestdata'), searchList: {"0":__('Is_bestdata 0'),"1":__('Is_bestdata 1')}, formatter: Table.api.formatter.normal},
                        {field: 'integral_num', title: __('Integral_num')},
                        {field: 'fee_price', title: __('Fee_price'), operate:'BETWEEN'},
                        {field: 'send_price', title: __('Send_price'), operate:'BETWEEN'},
                        {field: 'shop_classify.name', title: __('Classify_id')},
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
$("[data-toggle='addresspicker']").data("callback", function(res){
    var loca = res.lng+","+res.lat;
    $("#map").val(loca);
});