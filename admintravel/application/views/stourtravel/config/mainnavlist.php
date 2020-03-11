<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }

</head>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">



            <div></div>
            <div class="w-set-tit bom-arrow">

                <select class="nav_web_sel" onchange="togWeb(this)">
                     <option value="0">主站</option>
                    {loop $weblist $k $v}
                     <option value="{$v['webid']}">{$v['webname']}</option>
                    {/loop}
                </select>
                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>

            </div>
            <div id="line_grid_panel" class="content-nrt" style="margin-top: 0px">


                <div id="attr_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">
                    <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
                    <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
                    <a class="abtn" href="javascript:;" onClick="delattr()">删除</a>
                </div>
        </td>
    </tr>
</table>
<script>

var webid=0;
Ext.onReady(
    function () {
        //store
        $(".isattr").addClass('on');


        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'displayorder',
                    sortType: sortTrans

                },
                {name: 'issystem',
                    sortType: sortTrans

                },
                {name: 'isopen',
                    sortType: sortTrans

                },
                'id',
                'shortname',
                'linktitle',
                'webid',
                'kind',
                'pid',
                'aid',
                'description',
                'jieshao',
                'tagword',
                'url',
                'linktype',
                'isfinishseo'

            ],
            proxy: {
                type: 'ajax',
                extraParams: {typeid: window.display_mode},
                api: {
                    read: SITEURL+'config/mainnav/action/read',  //读取数据的URL
                    update:  SITEURL+'config/mainnav/action/save',
                    destroy:  SITEURL+'config/mainnav/action/delete'
                },
                reader: 'json'
            },
            autoLoad: true,
            listeners: {
                load:function( store, records, successful, eOpts )
                {

                    if(!successful){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }


                }
            }

        });

        //属性树
        window.attr_treepanel = Ext.create('Ext.tree.Panel', {
            store: attr_store,
            rootVisible: false,
            renderTo: 'attr_tree_panel',
            border: 0,
            style: 'margin-left:0px;border:0px;',
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            // selModel:sel_model,
            scroll:'vertical', //只要垂直滚动条

            listeners: {
                itemmousedown: function (node, record, item, index, e, eOpts) {
                    var x = e.xy[0];
                    var column_x = Ext.getCmp('attr_name').getX();
                    var column_width = Ext.getCmp('attr_name').getWidth();

                    if (x < column_x || x > column_x + column_width)
                        return false;

                    window.node_moving = true;

                },
                sortchange: function (ct, column, direction, eOpts) {

                    window.sort_direction = direction;

                    var field = column.dataIndex;
                    if (field == 'kindname')
                        field = 'pinyin';
                    window.attr_store.sort(field, direction);

                },
                celldblclick: function (view, td, cellIndex, record, tr, rowIndex, e, eOpts) {

                    if (record.get('displayorder') == 'add')
                        return false;
                },
                afterlayout: function (panel) {
                    var data_height = panel.getView().getEl().down('.x-grid-table').getHeight();

                    var height = Ext.dom.Element.getViewportHeight();

                    // console.log(data_height+'---'+height);
                    if (data_height > height - 100) {
                        window.has_biged = true;
                        panel.height = height - 100;
                    }
                    else if (data_height < height - 100) {
                        if (window.has_biged) {
                            delete panel.height;
                            window.has_biged = false;
                            window.attr_treepanel.doLayout();
                        }
                    }

                }


            },
            viewConfig: {
                forceFit: true,
                border: 0,
                plugins: {
                    ptype: 'treeviewdragdrop',
                    enableDrag: true,
                    enableDrop: true,
                    displayField: 'attrname'
                },

                listeners: {
                    boxready: function () {

                        var height = Ext.dom.Element.getViewportHeight();

                        this.up('treepanel').maxHeight = height - 100;
                        this.up('treepanel').doLayout();
                    },

                    beforedrop: function (node, data, overModel, dropPosition, dropHandlers) {
                        if (dropPosition != 'append') {
                            dropHandlers.processDrop();
                            return;
                        }

                        if (overModel.isLoaded())
                            dropHandlers.processDrop();
                        else {

                            overModel.expand(false, function () {
                                dropHandlers.processDrop();
                            });
                        }

                        dropHandlers.cancelDrop();


                    },
                    drop: function (node, data, overModel, dropPosition, eOpts) {

                        var params = {};
                        params['moveid'] = data.records[0].get('id');
                        params['overid'] = overModel.get('id');
                        params['position'] = dropPosition;


                        if (dropPosition == 'append') {

                            var btn_node = window.attr_store.getNodeById(params['overid'] + 'add');
                            overModel.insertBefore(data.records[0], btn_node);

                        }

                        //alert(overModel.children);
                        Ext.Ajax.request({
                            url: SITEURL+'config/mainnav/action/drag/typeid/{$typeid}',
                            params: params,
                            method: 'POST',
                            success: function (response) {
                                var text = response.responseText;
                                if (text == 'ok') {

                                } else {

                                }
                                // process server response here
                            }
                        });

                    }
                }

            },
            columns: [
                {
                    text: '选择',
                    width: '6%',
                    dataIndex: 'issel',
                    tdCls: 'attr-al-mid',
                    align: 'center',
                    draggable: false,
                    sortable:false,
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var issystem=record.get('linktype');
                        console.log(issystem,id,record.get('shortname'));
                        if(issystem==1){
                            return '';
                        }
                        if(id.indexOf('add')==-1){
                            return "<input type='checkbox' class='attr_check' value='" + id + "' style='cursor:pointer'/>";
                        }



                    }

                },
                {
                    text: '排序',
                    dataIndex: 'displayorder',
                    width: '9%',
                    align:'center',
                    draggable: false,
                    cls:'sort-col',
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(value=='add')
                            return '';
                        else {
                            var newvalue=value;
                            if(value==9999||value==999999||!value)
                                newvalue='';
                            return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\" onclick='ST.Util.prevPopup(event,this)'/>";
                        }
                    }

                },
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '导航名称',
                    dataIndex: 'shortname',
                    id: 'attr_name',
                    sortable:false,
                    locked: false,
                    menuDisabled:true,
                    width: '18%',
                    editor:{xtype:'textfield',listeners:{
                        focus:function(ele,event)
                        {
                            var inputId=ele.getInputId();
                            var inputEle= $("#"+inputId)
                            var str=ele.getValue();
                            var width=80;
                            if(str)
                            {
                                var len=str.length*20;
                                width=len<width?width:len;
                            }
                            inputEle.css({'margin-left':3,'padding':'0px 10px','width':width});
                        }

                    }},
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')==-1)
                        {
                            return "<span class='row-editable-sp'>"+value+"</span>"+"&nbsp;&nbsp;<font color='orange'>[id:"+id+"]</font>";

                        }
                        return value;
                    }
                },
                {
                    text: '导航title',
                    width: '15%',
                    dataIndex:'linktitle',
                    draggable: false,
                    sortable:false,
                    align:'center',
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')!=-1)
                            return '';
                        value=!value?'':value;
                        var html="<input type='text' value='"+value+"' class='row-edit-txt' style='text-align:left' onblur=\"updateField(this,'"+id+"','linktitle',0,'input')\" onclick='ST.Util.prevPopup(event,this)'/>";
                        return html;
                    }

                },
                {
                    text: '链接',
                    width: '25%',
                    dataIndex:'url',
                    draggable: false,
                    sortable:false,
                    align:'left',
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')!=-1)
                            return '';
                        var issystem=record.get('linktype');
                        if(issystem==1)
                            return value;

                        value=!value?'':value;
                        var html="<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','url',0,'input')\" style='text-align:left' onclick='ST.Util.prevPopup(event,this)'/>";
                        return html;
                    }
                },
                {
                    text: '图标',
                    width: '9%',
                    dataIndex:'kind',
                    draggable: false,
                    sortable:false,
                    align:'center',
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')!=-1)
                            return '';
                        var pid=record.get('pid');
                        if(pid!=0)
                          return '';

                        var kindArr={0:'无',1:'最新',2:'最热'};

                        var html='<select class="row-edit-select" onchange="updateField(this,'+id+',\'kind\',0,\'select\')" onclick="stopDef(event)" >';
                        for(var i in kindArr)
                        {
                            var kindName=kindArr[i];
                            var issel=value==i?'selected="selected"':'';
                            html+='<option value="'+i+'" '+issel+'>'+kindName+'</option>'
                        }
                        html+="</select>";
                       return html;
                    }

                },
                {
                    text: '显示',
                    width: '9%',
                    dataIndex:'isopen',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    cls:'sort-col',
                    menuDisabled:true,
                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function

                                var id = rec.get('id');
                                if (id.indexOf('add') > 0)
                                    return '';
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {

                                togStatus(null, record, 'isopen');


                            }
                        }
                    ]


               },
                {
                    text: '优化',
                    //  tdCls:'attr-al-mid',
                    width: '9%',
                    dataIndex:'isfinishseo',
                    draggable: false,
                    sortable:false,
                    align:'center',
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var shortname=record.get('shortname');
                        if(id.indexOf('add')!=-1)
                            return '';
                        var issystem=record.get('issystem');
                        if(issystem==0)
                           return '';

                        var txt=value==1?'已完成':'<span style="color:red">未完成</span>';
                        var linktype=record.get('linktype');

                        return '<a href="javascript:;" onclick="seoShow('+id+',\''+shortname+'\','+linktype+')">'+txt+'</a>';

                    }

                }
            ],
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1,
                    listeners: {
                        edit: function (editor, e) {

                            e.record.commit();
                            e.record.save({params: {field: e.field}});
                        }
                        ,
                        beforeEdit:function(editor,e){
                            var id=e.record.get('id');
                            if(id.indexOf('add')!=-1)
                                return false;
                        }
                    }
                })
            ]
        });


    }
);




Ext.getBody().on('mouseup', function () {
    window.node_moving = false;
});
Ext.getBody().on('mousemove', function (e, t, eOpts) {

    if (window.node_moving == true) {
        // console.log('mov_'+window.node_moving);

        var tree_view = window.attr_treepanel.down('treeview');
        var view_y = tree_view.getY();
        var view_bottom = view_y + tree_view.getHeight();
        var mouse_y = e.getY();
        if (mouse_y < view_y)
            tree_view.scrollBy(0, -5, false);
        if (mouse_y > view_bottom)
            tree_view.scrollBy(0, 5, false);

    }
});


Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.attr_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 100)
        window.attr_treepanel.height = (height - 100);
    else
        delete window.attr_treepanel.height;
    window.attr_treepanel.doLayout();
})
function togWeb(ele)
{
    webid=$(ele).val();
    attr_store.load({params:{webid:webid}});

}

function togStatus(obj, record, field) {
    var val = record.get(field);
    var id = record.get('id');
    id = id.substr(id.indexOf('_') + 1);
    var newval = val == 1 ? 0 : 1;
    Ext.Ajax.request({
        url: SITEURL+'config/mainnav/action/update',
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: newval, typeid: window.display_mode},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                record.set(field, newval);
                record.commit();
            }
        }});

}

function cascadeattr(attr, index) {
    if (attr.length == 1) {
        var node = window.attr_store.getNodeById(attr[0]);
        var ele = window.attr_treepanel.getView().getNode(node);
        if (ele) {

            var edom = Ext.get(ele);
            edom.addCls('search-attr-tr');
            if (index == 0)
                viewScroll(edom);
        }
    }
    else {
        var node = window.attr_store.getNodeById(attr[0]);
        attr.shift();
        node.expand(false, function () {
            cascadeattr(attr, index);
        });

    }
}
function viewScroll(extdom)   //在treeview里滚动
{
    var tree_view = window.attr_treepanel.getView();
    var view_y = tree_view.getY();
    var dom_y = extdom.getY();


    window.setTimeout(function () {
        window.first_scroll = true;
        extdom.scrollIntoView(tree_view.getEl());
    }, 450);
    //else
    // extdom.scrollIntoView(tree_view.getEl());


}

function chooseAll() {
    var check_cmp = Ext.query('.attr_check');
    for (var i in check_cmp) {
        if (!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].click();
    }

    //  window.sel_model.selectAll();
}
function chooseDiff() {
    var check_cmp = Ext.query('.attr_check');
    for (var i in check_cmp)
        check_cmp[i].click();
    //var records=window.sel_model.getSelection();
    //window.sel_model.selectAll(true);

    //	window.sel_model.deselect(records,true);

    //var
}
function delattr() {
    var check_cmp = Ext.select('.attr_check:checked');
    if(check_cmp.getCount()==0)
    {
        ST.Util.showMsg("请选择至少一条数据",5);
        return;
    }
    ST.Util.confirmBox("提示","确定删除？",function(){

        check_cmp.each(
            function (el, c, index) {
                // alert(el.getValue());
                //  window.attr_store.getNodeById(el.getValue().toString()).destroy();
                // window.attr_store.

                var id=el.getValue();
                var node=window.attr_store.getNodeById(id);
                node.destroy();


            }
        );
    });

}


function getHelp(e) {
    if (e && e.stopPropagation)
    //因此它支持W3C的stopPropagation()方法 
        e.stopPropagation();
    else
    //否则，我们需要使用IE的方式来取消事件冒泡 
        window.event.cancelBubble = true;
}
function sortTrans(val) {
    if (!window.sort_direction)
        return window.parseInt(val);
    else {
        if (val == 'add'){
            if (window.sort_direction == 'ASC')
                return 10000000000000;
            else
                return -10;
        }
        else
            return window.parseInt(val);
    }
    // alert(val);
}

function addSub(pid) {
    var precord = pid == 0 ? window.attr_store.getRootNode() : window.attr_store.getNodeById(pid);
    var addnode = window.attr_store.getNodeById(pid + 'add');

    Ext.Ajax.request({
        method: 'post',
        url: SITEURL+'config/mainnav/action/addsub/typeid/{$typeid}',
        params: {pid: pid,webid:webid},
        success: function (response) {

            var newrecord = Ext.decode(response.responseText);
            if(pid==0)
            {
                newrecord.leaf=false;
            }
            else
            {
                newrecord.leaf=true;
            }
            var view_el = window.attr_treepanel.getView().getEl()
            var scroll_top = view_el.getScrollTop();
            precord.insertBefore(newrecord, addnode);
            //view_el.scroll('t',scroll_top);
        }
    });

}
function updateField(ele,id,field,value,type,callback)
{
    var record=window.attr_store.getNodeById(id.toString());
    if(type=='select' || type=='input')
    {
        value=Ext.get(ele).getValue();
    }


    Ext.Ajax.request({
        url   :  SITEURL+"config/mainnav/action/update/typeid/{$typeid}",
        method  :  "POST",
        datatype  :  "JSON",
        params:{id:id,field:field,val:value},
        success  :  function(response, opts)
        {
            //  alert(value);
            record.set(field,value);
            record.commit();
            if(typeof(callback)=='function')
            {
                callback(record);
            }
        }});

}

function stopDef(e)
{
    if (e && e.stopPropagation)
    //因此它支持W3C的stopPropagation()方法
        e.stopPropagation();
    else
    //否则，我们需要使用IE的方式来取消事件冒泡
        window.event.cancelBubble = true;
}
function seoShow(id,navname,issystem)
{
    if(issystem)
    {
        var url = SITEURL+'config/seoinfo/id/'+id;
        ST.Util.showBox(navname+'-优化设置',url,650,450,null,null,document,{loadWindow:window,loadCallback: seoFinish});
    }

}
function seoFinish(result,bool)
{
   var id=result.id;
   var node=attr_store.getNodeById(id);
   node.set('isfinishseo',result.isfinish);
}
</script>
</body>
</html>
