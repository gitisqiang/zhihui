define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'goods/shopgoods/index',
                    add_url: 'goods/shopgoods/add',
                    edit_url: 'goods/shopgoods/edit',
                    del_url: 'goods/shopgoods/del',
                    multi_url: 'goods/shopgoods/multi',
                    table: 'shop_goods',
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
                        {field: 'goods_name', title: __('Goods_name')},
                        {field: 'shop_goods_classify.name', title: __('Classify_id')},
                        {field: 'goodsimages', title: __('Goodsimages'), formatter: Table.api.formatter.images},
                        {field: 'goods_price', title: __('Goods_price'), operate:'BETWEEN'},
                        {field: 'original_price', title: __('Original_price'), operate:'BETWEEN'},
                        {field: 'attr_type', title: __('Attr_type'),searchList: {"0":__('单规格'),"1":__('多规格')}, formatter: Table.api.formatter.normal},
                        {field: 'goods_num', title: __('Goods_num')},
                        {field: 'goods_sales', title: __('Goods_sales')},
                        {field: 'show', title: __('Show'), searchList: {"0":__('Show 0'),"1":__('Show 1')}, formatter: Table.api.formatter.status},
                        {field: 'is_new', title: __('Is_new'), searchList: {"0":__('Is_new 0'),"1":__('Is_new 1')}, formatter: Table.api.formatter.status},
                        {field: 'hot', title: __('Hot'), searchList: {"0":__('Hot 0'),"1":__('Hot 1')}, formatter: Table.api.formatter.status},
                        {field: 'integral', title: __('Integral')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            $(document).on("fa.event.appendfieldlist", ".btn-append", function(){
                Form.events.selectpage($("form"));
                Form.events.datetimepicker($("form"));
            });
            Controller.api.bindevent();
        },
        edit: function () {
            $(document).on("fa.event.appendfieldlist", ".btn-append", function(){
                Form.events.selectpage($("form"));
                Form.events.datetimepicker($("form"));
            });
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
$(document).on("change",".selectpicker",function(res){
    if($('.selectpicker option:selected').val() == 1){
        $(".goods_attr").show();
    }else{
        $(".goods_attr").hide();
    }
})
// $(".add_attr").click(function(){
//     $(".add").hide();
//     $(".spec-group-add").show();
// })
// $(".cancel").click(function(){
//     $(".add").show();
//     $(".spec-group-add").hide();
// })
// $(".confirm").click(function(){
//     var attr_key = $(".attr_key").val();
//         attr_name = $(".attr_name").val();
//     $(".spec-group-name").find("span").html(attr_key);
//     $(".spec-item").find("span").html(attr_name);
//     $(".spec-group-add").hide();
//     $(".spec-attr").show();
//     $(".add").show();
// })
