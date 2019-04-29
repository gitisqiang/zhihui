define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/orderlist/index',
                    add_url: 'order/orderlist/add',
                    edit_url: 'order/orderlist/edit',
                    del_url: 'order/orderlist/del',
                    multi_url: 'order/orderlist/multi',
                    table: 'order_info',
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
                        {field: 'order_sn', title: __('Order_sn')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'order_status', title: __('Order_status')},
                        {field: 'shipping_status', title: __('Shipping_status')},
                        {field: 'consignee', title: __('Consignee')},
                        {field: 'country', title: __('Country')},
                        {field: 'province', title: __('Province')},
                        {field: 'city', title: __('City')},
                        {field: 'district', title: __('District')},
                        {field: 'address', title: __('Address')},
                        {field: 'zipcode', title: __('Zipcode')},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'postscript', title: __('Postscript')},
                        {field: 'shipping_id', title: __('Shipping_id')},
                        {field: 'shipping_name', title: __('Shipping_name')},
                        {field: 'pay_id', title: __('Pay_id')},
                        {field: 'pay_name', title: __('Pay_name')},
                        {field: 'goods_amount', title: __('Goods_amount'), operate:'BETWEEN'},
                        {field: 'shipping_fee', title: __('Shipping_fee'), operate:'BETWEEN'},
                        {field: 'money_paid', title: __('Money_paid'), operate:'BETWEEN'},
                        {field: 'integral', title: __('Integral')},
                        {field: 'order_amount', title: __('Order_amount'), operate:'BETWEEN'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'pay_time', title: __('Pay_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'shipping_time', title: __('Shipping_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'extension_id', title: __('Extension_id')},
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