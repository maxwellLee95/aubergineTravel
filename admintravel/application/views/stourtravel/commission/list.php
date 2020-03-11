<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>茄子户外运动</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getScript("jquery.buttonbox.js,choose.js"); }
    <style>
        .yqlj-set-tab tr{
            height:30px;
            line-height:30px;
        }

    </style>

</head>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td"  valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">


            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <table class="list-head-tb">
                        <tr>
                            <td class="head-td-lt">

                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="product_grid_panel" class="content-nrt">

            </div>
        </td>
    </tr>
</table>

<script>

    Ext.onReady(
        function()
        {
            Ext.tip.QuickTipManager.init();
            $("#searchkey").focusEffect();
            //添加按钮
            $("#addbtn").click(function(){
                ST.Util.addTab('添加',SITEURL+'commission/add/parentkey/sale/itemid/');
            });

            //产品store
            window.product_store=Ext.create('Ext.data.Store',{
                fields:['id','addtime','status','amount','member','status_name'],
                proxy:{
                    type:'ajax',
                    api: {
                        read: SITEURL+'commission/list/action/read',  //读取数据的URL
                        update:SITEURL+'commission/list/action/save',
                        destroy:SITEURL+'commission/list/action/delete'
                    },
                    reader:{
                        type: 'json',   //获取数据的格式
                        root: 'lists',
                        totalProperty: 'total'
                    }
                },
                remoteSort:true,
                autoLoad:true,
                pageSize:30,
                listeners:{
                    load:function( store, records, successful, eOpts )
                    {
                        if(!successful){
                            ST.Util.showMsg("{__('norightmsg')}",5,1000);
                        }
                        var pageHtml = ST.Util.page(store.pageSize, store.currentPage, store.getTotalCount(), 10);
                        $("#line_page").html(pageHtml);
                        window.product_grid.doLayout();

                        $(".pageContainer .pagePart a").click(function () {
                            var page = $(this).attr('page');
                            product_store.loadPage(page);
                        });

                    }
                }
            });

            //产品列表
            window.product_grid=Ext.create('Ext.grid.Panel',{
                store:product_store,
                renderTo:'product_grid_panel',
                border:0,
                bodyBorder:0,
                bodyStyle:'border-width:0px',
                scroll:'vertical', //只要垂直滚动条
                bbar: Ext.create('Ext.toolbar.Toolbar', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "",
                    items:[
                        {
                            xtype:'panel',
                            id:'listPagePanel',
                            html:'<div id="line_page"></div>'
                        },
                        {
                            xtype:'combo',
                            fieldLabel:'每页显示数量',
                            width:170,
                            labelAlign:'right',
                            forceSelection:true,
                            value:30,
                            store:{fields:['num'],data:[{num:30},{num:60},{num:100}]},
                            displayField:'num',
                            valueField:'num',
                            listeners:{
                                select:changeNum
                            }
                        }

                    ],
                    listeners: {
                        single: true,
                        render: function(bar) {
                            var items = this.items;
                            //bar.down('tbfill').hide();

                            bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));

                            bar.insert(1,Ext.create('Ext.toolbar.Fill'));
                            //items.add(Ext.create('Ext.toolbar.Fill'));
                        }
                    }
                }),
                columns:[
                    {
                        text:'选择',
                        width:'10%',
                        // xtype:'templatecolumn',
                        tdCls:'product-ch',
                        align:'center',
                        dataIndex:'id',
                        menuDisabled:true,
                        border:0,
                        renderer : function(value, metadata,record) {
                            id=record.get('id');
                            if(id.indexOf('suit')==-1)
                                return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";

                        }

                    },
                    {
                        text:'申请人',
                        width:'20%',
                        dataIndex:'member',
                        align:'left',
                        menuDisabled:true,
                        border:0,
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            return value.nickname;
                        }
                    },
                    {
                        text:'微信openid',
                        width:'20%',
                        dataIndex:'member',
                        align:'left',
                        menuDisabled:true,
                        border:0,
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            return value.connectid;
                        }
                    },
                    {
                        text:'申请时间',
                        width:'10%',
                        dataIndex:'addtime',
                        align:'left',
                        menuDisabled:true,
                        border:0,
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            return value;
                        }
                    },
                    {
                        text:'金额',
                        width:'10%',
                        dataIndex:'amount',
                        align:'left',
                        menuDisabled:true,
                        border:0,
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            return value;
                        }
                    },
                    {
                        text:'状态',
                        width:'10%',
                        dataIndex:'status_name',
                        align:'left',
                        menuDisabled:true,
                        border:0,
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            return value;
                        }
                    },
                    {
                        text:'管理',
                        width:'20%',
                        align:'center',
                        border:0,
                        sortable:false,
                        menuDisabled:true,
                        dataIndex:'id',
                        renderer : function(value, metadata,record) {
                            return "<a href='javascript:;' class='row-mod-btn' onclick=\"ST.Util.addTab('修改"+"','"+SITEURL+"commission/edit/parentkey/sale/itemid/101/id/"+value+"')\"></a>";
                            // return getExpandableImage(value, metadata,record);
                        }
                    }
                ],
                plugins: [
                    Ext.create('Ext.grid.plugin.CellEditing', {
                        clicksToEdit:2,
                        listeners:{
                            edit:function(editor, e)
                            {
                                var id=e.record.get('id');
                                updateField(0,id,e.field,e.value,0);
                                return false;

                            },
                            beforeedit:function(editor,e)
                            {

                            }
                        }
                    })
                ],
                viewConfig:{
                    //enableTextSelection:true
                }
            });



        })




    //实现动态窗口大小
    Ext.EventManager.onWindowResize(function(){
        var height=Ext.dom.Element.getViewportHeight();
        var data_height=window.product_grid.getView().getEl().down('.x-grid-table').getHeight();
        if(data_height>height-106)
            window.product_grid.height=(height-106);
        else
            delete window.product_grid.height;
        window.product_grid.doLayout();


    })

    //进行搜索
    function goSearch(ele,val,field)
    {

        if(field=='kindid')
        {
            Ext.select('.kind-search-cs a').removeCls('active');
            Ext.get(ele).addCls('active');
        }
        window.product_store.getProxy().setExtraParam(field,val);
        window.product_store.load();

    }


    function searchDest(ele)
    {
        var keyword=Ext.get(ele).prev().getValue();
        keyword=Ext.String.trim(keyword);
        goSearch(0,keyword,'keyword');
    }

    //切换每页显示数量
    function changeNum(combo,records)
    {

        var pagesize=records[0].get('num');
        window.product_store.pageSize=pagesize;
        window.product_grid.down('pagingtoolbar').moveFirst();

    }
    //选择全部
    function chooseAll()
    {
        var check_cmp=Ext.query('.product_check');
        for(var i in check_cmp)
        {
            if(!Ext.get(check_cmp[i]).getAttribute('checked'))
                check_cmp[i].checked='checked';
        }

        //  window.sel_model.selectAll();
    }
    //反选
    function chooseDiff()
    {
        var check_cmp=Ext.query('.product_check');
        for(var i in check_cmp)
            check_cmp[i].click();

    }
    function delLine()
    {
        //window.product_grid.down('gridcolumn').hide();

        var check_cmp=Ext.select('.product_check:checked');

        if(check_cmp.getCount()==0)
        {
            return;
        }
        ST.Util.confirmBox("提示","确定删除？",function(){
            check_cmp.each(
                function(el,c,index)
                {
                    window.product_store.getById(el.getValue()).destroy();
                }
            );
        })
    }


    //更新某个字段
    function updateField(ele,id,field,value,type)
    {
        var record=window.product_store.getById(id.toString());
        if(type=='select'||type=='input')
        {
            value=Ext.get(ele).getValue();
        }
        var view_el=window.product_grid.getView().getEl();


        Ext.Ajax.request({
            url   :  "list/action/update",
            method  :  "POST",
            datatype  :  "JSON",
            params:{id:id,field:field,val:value,kindid:window.product_kindid},
            success  :  function(response, opts)
            {
                if(response.responseText=='ok')
                {

                    record.set(field,value);
                    record.commit();

                }
                else{
                    ST.Util.showMsg("{__('norightmsg')}",5,1000);
                }
            }});
    }

    //刷新保存后的结果
    function refreshField(id,arr)
    {
        id=id.toString();
        var id_arr=id.split('_');
        //  var view_el=window.product_grid.getView().getEl()
        // var scroll_top=view_el.getScrollTop();
        Ext.Array.each(id_arr,function(num,index)
        {
            if(num)
            {
                var record=window.product_store.getById(num.toString());

                for(var key in arr)
                {
                    record.set(key,arr[key]);
                    record.commit();

                }
            }
        })
    }

    //设置帮助的显示位置
    function setPosition(dom,types,id)
    {
        Ext.create('Ext.window.Window',
            {
                title:'设置显示位置',
                border:1,
                style: {
                    borderStyle: 'solid',
                    borderWidth:'1px'
                },
                bodyStyle:'padding:10px',
                ghost:false,
                autoShow:true,
                listeners:{
                    boxready:function(win)
                    {

                        var html="<div><span style=\"margin-left:10px\"><input onclick=\"choosePos(this,9,0)\" type=\"checkbox\"  value=\"0\" style=\"vertical-align:middle\">全选</span>";
                        var  choosed=types.split(',');
                        Ext.Object.each(typearr, function(key, value, myself)
                        {
                            var tid=key.slice(4);

                            var is_checked='';
                            if(Ext.Array.contains(choosed,tid))
                                is_checked="checked='checked'"

                            html+="<span style='margin-left:10px'><input onclick=\"choosePos(this,"+id+","+tid+")\" type='checkbox' "+is_checked+" value='"+tid+"' style='vertical-align:middle'/>"+value+"</span>"
                        });
                        html+="</div>";
                        win.update(html);
                    }
                }
            });


    }
    //选择位置
    function choosePos(dom,id,typeid)
    {
        var pdom=Ext.get(dom).up('div');

        if(typeid==0)
        {
            if(Ext.get(dom).is(":checked"))
                pdom.select('input').set({checked:'checked'},false);
            else
                pdom.select('input').set({checked:null},false);
        }

        var choosed=pdom.select('input:checked');
        var typelist='';
        choosed.each(function(el){
            var v=el.getValue();
            if(v!=0)
                typelist+=v+',';
        })
        typelist=typelist.slice(0,-1);
        updateField(0,id,'address',typelist);

    }

    //修改
    function goModify(id,title)
    {

    }



</script>

</body>
</html>
