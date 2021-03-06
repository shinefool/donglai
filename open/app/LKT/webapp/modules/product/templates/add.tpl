<!--
 * @Description: In User Settings Edit
 * @Author: your name
 * @Date: 2019-08-28 18:01:58
 * @LastEditTime: 2019-08-28 18:31:16
 * @LastEditors: Please set LastEditors
 -->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport"
content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta http-equiv="Cache-Control" content="no-siteapp"/>

<link href="style/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="style/css/H-ui.admin.css" rel="stylesheet" type="text/css"/>
<link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css"/>
<link href="style/css/style3.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modpub/js/check.js"></script>
{literal}
<style type="text/css">
	form[name=form1] input{
		margin: 0px;
	}
	.inputC+label{
		width: 50px;
		height: 20px;
		line-height: 20px;
		border: none;
	}
	.inputC:checked +label::before{
		display: inline-block;
	}
	   
</style>
<script type="text/javascript">
function check(f) {
    if (Trim(f.product_title.value) == "") {
        alert("产品名称不能为空！");
        f.product_title.value = '';
        return false;
    }
    return true;
}
</script>
{/literal}

{literal}
<style type="text/css">
.input-text, .scinput_s{
    width: 300px;
}
.wrap {
    width:60px;
    height:30px;
    background-color:#ccc;
    border-radius:16px;
    position:relative;
    transition:0.3s;
    margin-left: 10px;
}

.wrap_box{
    display: none;
}
.ra1{
	position: relative;
	width: 70px;
	margin-right: 20px;
	border: 1px solid #eee;
	border-radius: 5px;
	height: 30px;
	line-height: 30px;
	float: left;
}
.ra1 label{
	height: 30px;
	text-align: center;
	line-height: 30px;
	margin: 0 auto;
	width: 90%;
    left: 6px;
    background: none;
}
.ra1 input{
	float: left;
	position: absolute;
	height: 30px;
	line-height: 30px;
}
.inputC:checked +label::before{
	top: 8px;
}
.formListSD {
    color: #414658;
}

.formContentSD {
    padding: 0;
    padding-top: 10px;
    position: relative;
}

.formTextSD {
    margin-right: 8px;
    width: 11%!important;
}

.formInputSD input,
.formInputSD select {
    width: 287px;
}

.formInputSD input[type='number'] {
    padding-left: 10px;
    margin-bottom: 10px;
}

.formInputSD select,
.formInputSD select {
    padding-left: 8px;
    margin-bottom: 10px;
}

.inputC:checked+label::before {
    top: 8px;
}
    #masks {
        width: 100%;
        height: 100vh;
        position: absolute;
        z-index: 10002;
        background-color: #FFF;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    #masks img {
        width: 50px;
    }
</style>
{/literal}

<title>添加产品</title>
</head>
<body style="overflow-y:hidden;">
<div id="masks">
    <img src="images/icon1/loads.gif">
</div>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe616;</i> 产品管理 <span class="c-gray en">&gt;</span> <a href="index.php?module=product" style="text-decoration:none;" onmouseover="this.style.color='#333'">产品列表管理</a> <span class="c-gray en">&gt;</span> 发布产品 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="#" onclick="location.href='index.php?module=product';" title="关闭" ><i class="Hui-iconfont">&#xe6a6;</i></a></nav>

<div class="pd-20" id="page">
    <form name="form1" action="" class="form form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
        <input type="hidden" name="attribute" class="attribute" id="attribute" value='{$attribute}'/>
        <input type="hidden" name="uploadImg" value="{$uploadImg}"/>
        <input type="hidden" name="attribute_num" class="attribute_num" id="attribute_num" value='{$attribute_num}'/>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>产品标题：</label>
            <div class="formControls col-4" style="width: 16.8%;">
                <input type="text" class="input-text" value="{$product_title}" placeholder="" id="product_titleId" name="product_title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red"></span>副标题：</label>
            <div class="formControls" style="display: inline-block;">
                <input type="text" class="input-text" value="{$subtitle}" placeholder="" id="subtitleId" name="subtitle">
                
            </div>
            <text style="line-height:30px;position: relative;">*简洁表达产品，用来显示在首页产品，避免截取时不能表达是什么产品。</text>
        </div>

        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>产品类别：</label>
            <div class="formControls col-2"><!--  <span class="select-box"> -->
                <select name="product_class" id="product_classId" class="select">
                    <option selected="selected" value="0">请选择类别</option>
                    {$ctype}
                </select>
                <!-- </span> -->
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red"></span>产品品牌：</label>
            <div class="formControls col-2">
                <!-- <span class="select-box"> -->
                    <select name="brand_class" id="brand_classId" class="select">
                        <option selected="selected" value="0">请选择品牌</option>
                        {$brand}
                    </select>
               <!--  </span> -->
            </div>
        </div>
<!--         <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>关键词：</label>
            <div class="formControls col-4" style="width: 16.8%;">
                <input type="text" class="input-text" value="{$keyword}" placeholder="" id="keywordId" name="keyword">
            </div>
        </div> -->
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>重量：</label>
            <div class="formControls col-4" style="width: 26.8%;">
                <input type="text" class="input-text" value="{$weight}" placeholder="" id="weightId" name="weight">
            </div>
            <text style="line-height:30px;">克</text>
        </div>
        <div class="formDivSD">
            <div class="formContentSD">
                <div class="formListSD">
                    <div class="formTextSD"><span class="must">*</span><span>成本价：</span></div>
                    <div class="formInputSD"><input required="required" type="number" name="initial[cbj]" onkeypress="return noNumbers(event)" min="0" step="0.01" onblur="set_cbj(this);" value="{$initial->cbj}" placeholder="请设置商品的默认成本价" ></div>
                </div>
                <div class="formListSD">
                    <div class="formTextSD"><span class="must">*</span><span>原价：</span></div>
                    <div class="formInputSD"><input required="required" type="number" name="initial[yj]" onkeypress="return noNumbers(event)" min="0" step="0.01" onblur="set_yj(this);" value="{$initial->yj}" placeholder="请设置商品的默认原价" ></div>
                </div>
                <div class="formListSD">
                    <div class="formTextSD"><span class="must">*</span><span>售价：</span></div>
                    <div class="formInputSD"><input required="required" type="number" name="initial[sj]" onkeypress="return noNumbers(event)" min="0" step="0.01" onblur="set_sj(this);" value="{$initial->sj}" placeholder="请设置商品的默认售价" ></div>
                </div>
                <div class="formListSD">
                    <div class="formTextSD"><span class="must">*</span><span>单位：</span></div>
                    <div class="formInputSD">
                        <select name="initial[unit]" class="select " style="width: 300px;" id="unit">
                           
                          {if $initial->unit != ''}
                                    <option selected="selected" value="{$initial->unit}">{$initial->unit}</option>
                         {else}
                                    <option value="">请选择商品属性</option>
                                    <option value="盒">盒</option>
                                    <option value="篓">篓</option>
                                    <option value="箱">箱</option>
                                    <option value="个">个</option>
                                    <option value="套">套</option>
                                    <option value="包">包</option>
                                    <option value="支">支</option>
                                    <option value="条">条</option>
                                    <option value="根">根</option>
                                    <option value="本">本</option>
                                    <option value="瓶">瓶</option>
                                    <option value="块">块</option>
                                    <option value="片">片</option>
                                    <option value="把">把</option>
                                    <option value="组">组</option>
                                    <option value="双">双</option>
                                    <option value="台">台</option>
                                    <option value="件">件</option>
                          {/if}
             
                                   
                        </select>
                    </div>
                </div>
                <div class="formListSD">
                    <div class="formTextSD"><span class="must">*</span><span>库存：</span></div>
                    <div class="formInputSD"><input type="number" name="initial[kucun]" oninput="value=value.replace(/[^\d]/g,'')" required="required" min="0" step="1" onblur="set_kucun(this);" value="{$initial->kucun}" placeholder="请设置商品的默认库存" ></div>
                </div>
                        {literal}
                        <!-- 有规格 -->
                        <div>
                            <div class="arrt_block">
                                <div class="formTextSD"><span class="must">*</span>属性名称：</div>
                                <div class="formInputSD">
                                    <div class="arrt_flex">
                                        <div class="arrt_froup">
                                            <input type="text" class="add-attr-group-input" placeholder="请输入属性名称">
                                            <a class="add-attr-group-btn arrt_add" href="javascript:" style="display: none;"><span>添加属性</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="arrt_block arrt_two">
                                <div class="arrt_width">
                                    <div v-for="(attr_group,i) in attr_group_list" class="attr-group">
                                        <div class="attr-list">
                                            <div class="attr-input-group">
                                                <div class="attr_input_group">
                                                    <span class="arrt_span">{{attr_group.attr_group_name}}：</span>
                                                    <input type="text" class="add-attr-input add_input" ref="input_value" placeholder="请输入属性值" style="padding-left: 10px;">
                                                    <a v-bind:index="i" class="add-attr-btn adds_ntn" href="javascript:"><span>添加属性值</span></a>
                                                    <a v-bind:index="i" href="javascript:" class="attr-group-delete dels_btn"><span>删除属性</span></a>
                                                </div>
                                                <div class="arrt_bgcolor">
                                                    <div v-for="(attr,j) in attr_group.attr_list" class="attr_input_group arrt_clear arrt_zi">
                                                        <span>属性值：</span>
                                                        <input class="add-attr-input" :value="attr.attr_name" readonly="readonly" style="padding-left: 10px;background-color: #F8F8F8 !important;">
                                                        <a v-bind:group-index="i" v-bind:index="j" class="attr-delete" href="javascript:">
                                                            <img src="images/iIcon/jh.png" class="form_plus_u" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="arrt_bgcolor arrt_fiv">
                                <div v-if="attr_group_list && attr_group_list.length>0">
                                    <table class="attr-table attr_table">
                                        <thead>
                                            <tr>
                                                <th v-for="(attr_group,i) in attr_group_list" v-if="attr_group.attr_list && attr_group.attr_list.length>0">
                                                    {{attr_group.attr_group_name}}
                                                </th>
                                                <th>成本价</th>
                                                <th>原价</th>
                                                <th>售价</th>
                                                <th>库存</th>
                                                <th>单位</th>
                                                <th>上传图片</th>
                                            </tr>
                                        </thead>
                                        <tr v-for="(item,index) in checked_attr_list" class="arrt_tr">
                                            <td v-for="(attr,attr_index) in item.attr_list">
                                                <input type="hidden" v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_id]'" v-bind:value="attr.attr_id">

                                                <input type="hidden" v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_name]'" v-bind:value="attr.attr_name">

                                                <input type="hidden" v-bind:name="'attr['+index+'][attr_list]['+attr_index+'][attr_group_name]'" v-bind:value="attr.attr_group_name">
                                                <span>{{attr.attr_name}}</span>
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" type="number" onkeypress="return noNumbers(event)" min="0" step="0.01" v-bind:name="'attr['+index+'][costprice]'" :value="cbj">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" type="number" onkeypress="return noNumbers(event)" min="0" step="0.01" v-bind:name="'attr['+index+'][yprice]'" :value="yj">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" type="number" onkeypress="return noNumbers(event)" min="0" step="0.01" v-bind:name="'attr['+index+'][price]'" :value="sj">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" oninput="value=value.replace(/[^\d]/g,'')" v-bind:name="'attr['+index+'][num]'" :value="kucun" onkeypress="return noNumbers(event)" min="0" step="1">
                                            </td>
                                            <td>
                                                <input class="unit" v-bind:name="'attr['+index+'][unit]'" :value="unit" style="border: 0px;background-color: transparent;" readOnly="readOnly">
                
                                            </td>
                                            <td>
                                                <div class="upload-group form_group form_flex">
                                                    <div class="form_attr_img ">
                                                        <input type="hidden" :id="'picurl2'+index"  v-bind:name="'attr['+index+'][img]'" datatype="*" nullmsg="请选择图片11"/>
                                                        <img src="images/icon1/add_g_t.png" :id="'pic2'+index" class="upload-preview-img form_att select-file" @click="handleImageClick(item,index)" onclick="setTimeoutClick() ">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {/literal}
                    </div>
                </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>显示类型：</label>
            <div class="formControls col-xs-8 col-sm-8 skin-minimal">
                <div class="ra1">
                    <input name="s_type[]" type="checkbox" id="sex-1" class="inputC" value="1" {if in_array(1,$s_type)}checked="checked"{/if}>
                    <label for="sex-1">新品</label>
                </div>
                <div class="ra1">
                    <input type="checkbox" id="sex-2" name="s_type[]" class="inputC" value="2" {if in_array(2,$s_type)}checked="checked"{/if}>
                    <label for="sex-2">热销</label>
                </div>
                <div class="ra1">
                    <input type="checkbox" id="sex-3" name="s_type[]" class="inputC" value="3" {if in_array(3,$s_type)}checked="checked"{/if}>
                    <label for="sex-3">推荐</label>
                </div>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-2">拟定销量：</label>
            <div class="formControls col-2">
                <input type="number" class="input-text" value="{$volume}" id="volumeId" name="volume">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>产品主图：</label>
            <div class="formControls col-xs-8 col-sm-10">
                {if $image}
                    <img id="thumb_url" src='{$image}' style="height:100px;width:150px">
                    <input type="hidden" name="oldpic" value="{$image}">
                {else}
                    <img id="thumb_url" src='../LKT/images/nopic.jpg' style="height:100px;width:150px">
                    <input type="hidden" name="oldpic" value="">
                {/if}
                <input type="hidden" id="picurl" name="image" datatype="*" nullmsg="请选择图片"/>
                <button class="btn btn-success" id="image" type="button">选择图片</button>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">产品展示图：</label>
            <div class="formControls col-10" style="width: 40%;">
                <div class="uploader-thum-container">
                    <input name="imgurls[]" id="imgurls" multiple='multiple' type="file" style="width:210px;" accept="upload_image/x-png,image/gif,image/jpeg"/>注:最多五张,一定为.jpg格式
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red"></span>运费设置：</label>
            <div class="formControls col-2"> <!-- <span class="select-box"> -->
                <select name="freight" id="freightId" class="select">
                    {foreach from=$freight item=item1 name=f2}
                        <option value="{$item1->id}">{$item1->name}</option>
                    {/foreach}
                </select>
                <!-- </span> -->
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
            <div class="formControls col-xs-8 col-sm-10">
                <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;">{$content}</script>
            </div>
        </div>
		<div style="height: 70px;"></div>
        <div class="row cl page_bort_bottom">
            <div class="col-8 col-offset-4">
                <input type="submit" name="Submit" value="提 交" class="btn btn-primary radius btn-right" onclick="check()">
                <input type="button" name="reset" value="重 写" onclick="check1()" class="btn btn-primary radius btn-left" style='background: transparent!important;'>
            </div>
        </div>
    </form>
</div>
<script type = "text/javascript" src = "style/js/jquery.js" ></script>
<script type="text/javascript" src="style/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="style/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="style/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<!-- 新增编辑器引入文件 -->
<link rel="stylesheet" href="style/kindeditor/themes/default/default.css"/>
<script src="style/kindeditor/kindeditor-min.js"></script>
<script src="style/kindeditor/lang/zh_CN.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
{literal}
<script>
$(function() {
    $("#imgurls").change(function() {
        var files = this.files;
        if (files && files.length > 5) {
            alert("超过5张");
            this.value = "" //删除选择
            // $(this).focus(); //打开选择窗口
        }
    })
})
$(function(){
    var ue = UE.getEditor('editor');
});
KindEditor.ready(function (K) {
    var editor = K.editor({
        allowFileManager: true,
        uploadJson: "index.php?module=system&action=uploadImg", //上传功能
        fileManagerJson: 'kindeditor/php/file_manager_json.php', //网络空间
    });
    //上传背景图片
    K('#image').click(function () {
        editor.loadPlugin('image', function () {
            editor.plugin.imageDialog({
                showRemote : false, //网络图片不开启
                //showLocal : false, //不开启本地图片上传
                imageUrl: K('#picurl').val(),
                clickFn: function (url, title, width, height, border, align) {
                    K('#picurl').val(url);
                    $('#thumb_url').attr("src", url);
                    editor.hideDialog();
                }
            });
        });
    });

  
});

//控制价格显示小数点2位
            function noNumbers(e) {
                var keynum
                var keychar
                var numcheck
                if(window.event) // IE  
                {
                    keynum = e.keyCode
                } else if(e.which) // Netscape/Firefox/Opera  
                {
                    keynum = e.which
                }
                keychar = String.fromCharCode(keynum);
                //判断是数字,且小数点后面只保留两位小数
                if(!isNaN(keychar)) {
                    var index = e.currentTarget.value.indexOf(".");
                    if(index >= 0 && e.currentTarget.value.length - index > 2) {
                        return false;
                    }
                    return true;
                }
                //如果是小数点 但不能出现多个 且第一位不能是小数点
                if("." == keychar) {
                    if(e.currentTarget.value == "") {
                        return false;
                    }
                    if(e.currentTarget.value.indexOf(".") >= 0) {
                        return false;
                    }
                    return true;
                }
                return false;
            }
            //设置成本价等
            function set_cbj(obj) {
                page.cbj = $(obj).val();
            }
            // 设置原价
            function set_yj(obj) {
                page.yj = $(obj).val();
            }
            // 设置现价
            function set_sj(obj) {
                page.sj = $(obj).val();
            }
            // 设置总库存
            function set_kucun(obj) {
                page.kucun = $(obj).val();
            }
            $('#unit').live('click', function() {
                var unit = $("#unit").val();
                console.log(unit)
                page.unit = $("#unit").val();
                $(".unit").val(unit);
                // $("#unit1").prepend(unit);
            });
            var map = new Map();
            var page = new Vue({
                el: "#page",
                data: {
                    sub_cat_list: [],
                    attr_group_list: JSON.parse('[]', true), //可选规格数据
                    attr_group_count: JSON.parse('[]', true).length,
                    checked_attr_list: JSON.parse('[]', true), //已选规格数据
                    old_checked_attr_list: [],
                    goods_card_list: [],
                    card_list: [],
                    goods_cat_list: [{
                        "cat_id": null,
                        "cat_name": null
                    }],
                    select_i: '',
                    cbj: '',
                    yj: '',
                    sj: '',
                    kucun: '',
                    unit: '',
                    imageClickInfo:'',
                    imageClickInfoIndex:0
                },
                created:function(){
                    this.$nextTick(function () {
                        $('#masks').hide()
                        $(document.body).css({
                            "overflow-y": "auto"
                        })
                    })
                },
                methods: {
                    change: function(item, index) {
                        this.checked_attr_list[index] = item;
                    },
                    handleImageClick(data,index){
                        this.imageClickInfo = data;
                        this.imageClickInfoIndex = index
                    }
                }
            });

            // 点击属性框，显示添加属性按钮
            $(".add-attr-group-input").click(function() {
                $(".add-attr-group-btn").css("display", "");
            });
            // 属性框离开事件，延迟500毫秒隐藏隐藏添加属性按钮
            $(".add-attr-group-input").blur(function() {
                setTimeout('$(".add-attr-group-btn").css("display", "none")', 500);
            });
            // 添加属性
            $(".add-attr-group-btn").click(function() {
                // console.log(2)
                // console.log($(this))
                var name = $(".add-attr-group-input").val();
                name = $.trim(name);
                if(name == "") {
                    alert("属性名不能为空！");
                    return;
                }
                for(var i in page.attr_group_list) {
                    if(page.attr_group_list[i].attr_group_name == name) {
                        alert("属性名称重复！");
                        return;
                    }
                }
                page.attr_group_list.push({
                    attr_group_name: name,
                    attr_list: [],
                });
                $(".add-attr-group-input").val("");
                page.checked_attr_list = getAttrList();
            });
            // 添加属性值

            $(".add-attr-btn").live("click", function() {

                var name = $(this).parents(".attr-input-group").find(".add-attr-input").val();
                var index = $(this).attr("index");
                name = $.trim(name);
                if(name == "") {
                    alert("属性值不能为空！");
                    return;
                }



                /**筛选重复*/
                var ck_list = page.checked_attr_list;
                if(ck_list.length > 0) {
                    for(var pi in ck_list) {
                        if(ck_list[pi].attr_list[index]) {
                            if(name == ck_list[pi].attr_list[index].attr_name) {
                                alert("属性值重复！");
                                return;
                            }
                        }
                    }
                }
                /**筛选重复*/
                // 数组中添加新元素：
                page.attr_group_list[index].attr_list.push({
                    attr_name: name,
                });

                // 如果是单规格的，添加新规格时不清空原先的数据
                page.old_checked_attr_list = page.checked_attr_list;
                var attrList = getAttrList();

                if(page.attr_group_list.length === 1) { // 一个属性
                    for(var i in attrList) {
                        if(i > page.old_checked_attr_list.length - 1) {
                            page.old_checked_attr_list.push(attrList[i])
                        }
                    }
                    var newCheckedAttrList = page.old_checked_attr_list;
                } else if(page.attr_group_list.length === page.attr_group_count) {
                    for(var pi in attrList) {
                        var pAttrName = '';
                        for(var pj in attrList[pi].attr_list) {
                            pAttrName += attrList[pi].attr_list[pj].attr_name
                        }
                        for(var ci in page.old_checked_attr_list) {
                            var cAttrName = '';
                            for(var cj in page.old_checked_attr_list[ci].attr_list) {
                                cAttrName += page.old_checked_attr_list[ci].attr_list[cj].attr_name;
                            }
                            if(pAttrName === cAttrName) {
                                attrList[pi] = page.old_checked_attr_list[ci];
                            }
                        }
                    }
                    var newCheckedAttrList = attrList;
                } else {
                    var newCheckedAttrList = attrList;
                }

                $(this).parents(".attr-input-group").find(".add-attr-input").val("");
                page.checked_attr_list = newCheckedAttrList;
            });
            // 删除属性
            $(".attr-group-delete").live("click", function() {
                var index = $(this).attr("index");
                page.attr_group_list.splice(index, 1);
                page.checked_attr_list = getAttrList();
            });
            // 删除属性值
            $(".attr-delete").live("click", function() {
                var index = $(this).attr("index");
                var group_index = $(this).attr("group-index");
                page.attr_group_list[group_index].attr_list.splice(index, 1);
                // 如果是单规格的，删除规格时不清空原先的数据
                page.old_checked_attr_list = page.checked_attr_list;
                var attrList = getAttrList();
                if(page.attr_group_list.length === 1) {
                    var newCheckedAttrList = [];
                    for(var i in page.attr_group_list[0].attr_list) {
                        var attrName = page.attr_group_list[0].attr_list[i].attr_name;
                        for(j in page.old_checked_attr_list) {
                            var oldAttrName = page.old_checked_attr_list[j].attr_list[0].attr_name;
                            if(attrName === oldAttrName) {
                                newCheckedAttrList.push(page.old_checked_attr_list[j]);
                                break;
                            }
                        }
                    }
                } else if(page.attr_group_list.length === page.attr_group_count) {
                    for(var pi in attrList) {
                        var pAttrName = '';
                        for(var pj in attrList[pi].attr_list) {
                            pAttrName += attrList[pi].attr_list[pj].attr_name
                        }
                        for(var ci in page.old_checked_attr_list) {
                            var cAttrName = '';
                            for(var cj in page.old_checked_attr_list[ci].attr_list) {
                                cAttrName += page.old_checked_attr_list[ci].attr_list[cj].attr_name;
                            }
                            if(pAttrName === cAttrName) {
                                attrList[pi] = page.old_checked_attr_list[ci];
                            }
                        }
                    }
                    var newCheckedAttrList = attrList;
                } else {
                    var newCheckedAttrList = attrList;
                }

                page.checked_attr_list = newCheckedAttrList;
            });

            function getAttrList() {
                var array = [];
                for(var i in page.attr_group_list) {
                    for(var j in page.attr_group_list[i].attr_list) {
                        var object = {
                            attr_group_name: page.attr_group_list[i].attr_group_name,
                            attr_id: null,
                            attr_name: page.attr_group_list[i].attr_list[j].attr_name,
                        };
                        if(!array[i])
                            array[i] = [];
                        array[i].push(object);
                    }
                }
                var len = array.length;
                var results = [];
                var indexs = {};

                function specialSort(start) {
                    start++;
                    if(start > len - 1) {
                        return;
                    }
                    if(!indexs[start]) {
                        indexs[start] = 0;
                    }
                    if(!(array[start] instanceof Array)) {
                        array[start] = [array[start]];
                    }
                    for(indexs[start] = 0; indexs[start] < array[start].length; indexs[start]++) {
                        specialSort(start);
                        if(start == len - 1) {
                            var temp = [];
                            for(var i = len - 1; i >= 0; i--) {
                                if(!(array[start - i] instanceof Array)) {
                                    array[start - i] = [array[start - i]];
                                }
                                if(array[start - i][indexs[start - i]]) {
                                    temp.push(array[start - i][indexs[start - i]]);
                                }
                            }
                            var key = [];
                            for(var i in temp) {
                                key.push(temp[i].attr_id);
                            }
                            var oldVal = map.get(key.sort().toString());
                            console.log(oldVal);
                            if(oldVal) {
                                results.push({
                                    num: oldVal.num,
                                    price: oldVal.price,
                                    no: oldVal.no,
                                    pic: oldVal.pic,
                                    attr_list: temp
                                });
                            } else {
                                var img = $(".upload-preview-list").children(":first").children('.upload-preview-img').attr('src');
                                console.log(img);
                                results.push({
                                    num: 0,
                                    price: 0,
                                    no: '',
                                    pic: '',
                                    attr_list: temp,
                                    img: img
                                });
                            }
                        }
                    }
                }
                specialSort(-1);
                return results;
            }
            
function setTimeoutClick(){
    console.log('timeout')
    setTimeout(image_click, 100);
}
// 属性值上传商品图片
function image_click() {
    console.log('image click')
    var id = page.imageClickInfoIndex
    console.log(page.imageClickInfoIndex)

    KindEditor.ready(function (K) {
        var editor = K.editor({
            allowFileManager: true,
            uploadJson: "index.php?module=system&action=uploadImg", //上传功能
            fileManagerJson: 'kindeditor/php/file_manager_json.php', //网络空间
        });
        editor.loadPlugin('image', function () {
            editor.plugin.imageDialog({
                showRemote: false, //网络图片不开启
                //showLocal : false, //不开启本地图片上传
                imageUrl: K("#picurl2"+id).val(),
                clickFn: function (url, title, width, height, border, align) {
                    K('#picurl2'+id).val(url);
                    $('#pic2'+id).attr("src", url);
                    editor.hideDialog();
                }
            });
        });
    });

}

function resetButton(){
    $('#product_numberId').val("");
    $('#product_titleId').val("");
    $('#subtitleId').val("");
    $("#product_classId option[value='0']").attr("selected", "selected");
    $("#brand_classId option[value='0']").attr("selected", "selected");
    $('#weightId').val("");
    $('#sex-1').attr("checked","");
    $('#sex-2').attr("checked","");
    $('#sex-3').attr("checked","");
    $('#volumeId').val("");
    $("#freightId option[value='0']").attr("selected", "selected");
    $('#ueditor_0').contents().find('p').html(""); 
}

var t_check = true;
            function check() {
                // console.log(t_check);
                //   console.log(66666);
                // if(!t_check && t_check ==false){
                //     alert('请勿重复提交！', {
                //         time: 2000
                //     });
                //     return false;
                // }

                // t_check = false;

                $.ajax({
                    cache: true,
                    type: "POST",
                    dataType: "json",
                    url: 'index.php?module=product&action=add',
                    data: $('#form1').serialize(), // 你的formid
                    async: true,
                    success: function(data) {
                        t_check = true;
                        alert(data.status, {
                            time: 2000
                        });
                        if(data.suc) {
                            location.href = "index.php?module=product";
                        }
                    }
                });
            }
            function check1() {
                $.ajax({
                    cache: true,
                    type: "GET",
                    dataType: "json",
                    url: 'index.php?module=product&action=add&m=del',
                    data: $('#form1').serialize(), // 你的formid
                    async: true,
                    success: function(data) {
                        if(data.suc) {
                            location.href = "index.php?module=product";
                        }
                    }
                });
            }
</script>
{/literal}
</body>
</html>