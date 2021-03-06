<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link href="style/statics/mch/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/statics/mch/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="style/statics/css/flex.css?version=2.5.8.0" rel="stylesheet">
    <link href="style/statics/css/common.css?version=2.5.8.0" rel="stylesheet">
    <link href="style/statics/mch/css/common.v2.css?version=2.5.8.0" rel="stylesheet">

    <link href="style/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="style/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="style/css/style.css" rel="stylesheet" type="text/css" />
    <link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />

    <script src="style/js/jquery.js"></script>
    <script src="style/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="style/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="style/js/jquery.js"></script>
    <script type="text/javascript" src="style/lib/jquery/1.9.1/jquery.min.js"></script>
    {literal}
        <style type="text/css">

            .center{
                text-align: center !important;
            }
            .ul1,.ul2,.ul3{
                padding: 0px 20px;
            }
            .ul1 li,.ul2 li,.ul3 li{
                float: left;
                height: 49px;
                border-bottom: 1px solid #eee;
                line-height: 49px;
                color: #888f9e;
                font-size: 14px;
            }
            .grText{
                color: #414658;
                font-size: 14px;
            }
            .ulTitle{
                height: 50px;
                line-height: 50px;
                text-align: left;
                padding-left: 20px;
                font-size: 16px;
                color: #414658;
                font-weight: 600;
                font-family: "????????????";
                margin-bottom: 0px;
                margin-top: 20px;
                border-bottom: 2px solid #eee;
            }
            table th{
                border-bottom: none;
                background-color: #edf0f2;
            }
            table{
                width: 95%;
                margin: 20px auto;
                border: 1px solid #eee!important;

            }
        </style>

        <style>
            .order-item {
                border: 1px solid transparent;
                margin-bottom: 1rem;
            }

            .order-item table {
                margin: 0;
            }

            .order-item:hover {
                border: 1px solid #3c8ee5;
            }

            .goods-item {
                margin-bottom: .75rem;
            }

            .goods-item:last-child {
                margin-bottom: 0;
            }



            .goods-name {
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
            }

            .status-item.active {
                color: inherit;
            }

            .badge {
                display: inline-block;
                padding: .25em .4em;
                font-size: 75%;
                font-weight: 700;
                line-height: 1;
                color: #fff;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: .25rem
            }

            .badge:empty {
                display: none
            }

            .btn .badge {
                position: relative;
                top: -1px
            }

            a.badge:focus,
            a.badge:hover {
                color: #fff;
                text-decoration: none;
                cursor: pointer
            }

            .badge-pill {
                padding-right: .6em;
                padding-left: .6em;
                border-radius: 10rem
            }

            .badge-default {
                background-color: #636c72
            }

            .badge-default[href]:focus,
            .badge-default[href]:hover {
                background-color: #4b5257
            }

            .badge-primary {
                background-color: #0275d8
            }

            .badge-primary[href]:focus,
            .badge-primary[href]:hover {
                background-color: #025aa5
            }

            .badge-success {
                background-color: #5cb85c
            }

            .badge-success[href]:focus,
            .badge-success[href]:hover {
                background-color: #449d44
            }

            .badge-info {
                background-color: #5bc0de
            }

            .badge-info[href]:focus,
            .badge-info[href]:hover {
                background-color: #31b0d5
            }

            .badge-warning {
                background-color: #f0ad4e
            }

            .badge-warning[href]:focus,
            .badge-warning[href]:hover {
                background-color: #ec971f
            }

            .badge-danger {
                background-color: #d9534f
            }

            .badge-danger[href]:focus,
            .badge-danger[href]:hover {
                background-color: #c9302c
            }
            .mask{
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;

            }
            a:hover {color: red; text-decoration:none;}
            .table-bordered th, .table-bordered td{
                border: none;
                text-align: center;
                vertical-align: middle;
            }
            .txc th{
                text-align: center;
            }
            .imgTd img{
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }
            table {
                vertical-align: middle;

            }
            td a{
                float: left;
                width: 100%!important;

            }
            .maskLeft{
                width: 30%;
                float: left;
                text-align: right;
                padding-right: 20px;
                height:36px;
                line-height: 36px;
            }
            .maskRight{
                width: 70%;
                float: left;
            }
            .ipt1{
                padding-left: 10px;
                width:300px;
                height: 36px;
                border: 1px solid #eee;
            }
            .wl_maskNew {
                position: fixed;
                z-index: 9999999;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0,0,0,0.6);
                display: block;
            }
            .wl_maskNewContent {
                width: 500px;
                height: 519px;
                margin: 0 auto;
                position: relative;
                top: 200px;
                background: #fff;
                border-radius: 10px;
            }
            .dc {
                position: fixed;
                z-index: 999;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0,0,0,0.6);
                display: block;
            }
            .table td, .table th{
            	vertical-align: middle;
            }
        </style>

        <SCRIPT language=javascript>
            function printpr() //????????????
            {
                document.all("qingkongyema").click();//?????????????????????????????????
                document.all("dayinDiv").style.display="none"; //??????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                document.all("breadcrumb").style.display="none";
                var OLECMDID = 7;
                var PROMPT = 1;
                var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
                document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
                WebBrowser1.ExecWB(OLECMDID, PROMPT);
                WebBrowser1.outerHTML = "";
                document.all("dayinDiv").style.display="";//???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                document.all("breadcrumb").style.display="";
            }

            function printTure() //????????????
            {
                document.all('qingkongyema').click();//??????
                document.all("dayinDiv").style.display="none";//??????
                document.all("breadcrumb").style.display="none";//??????
                window.print();
                document.all("dayinDiv").style.display="";
                document.all("breadcrumb").style.display="";//??????
            }
            function doPage()
            {
                layLoading.style.display = "none";//??????
            }


        </SCRIPT>

<script language="VBScript">
dim hkey_root,hkey_path,hkey_key
hkey_root="HKEY_CURRENT_USER"
hkey_path="\Software\Microsoft\Internet Explorer\PageSetup"
//???????????????????????????????????????
function pagesetup_null()
on error resume next
Set RegWsh = CreateObject("WScript.Shell")
hkey_key="\header"
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,""
hkey_key="\footer"
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,""
end function

//?????????????????????????????????????????????
function pagesetup_default()
on error resume next
Set RegWsh = CreateObject("WScript.Shell")
hkey_key="\header"
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,"&w&b?????????&p/&P"
hkey_key="\footer"
RegWsh.RegWrite hkey_root+hkey_path+hkey_key,"&u&b&d"
end function
</script>

    {/literal}
    <title>????????????</title>
</head>
<body>
<nav class="breadcrumb" name= 'breadcrumb' id= 'breadcrumb'><i class="Hui-iconfont" >&#xe627;</i> ???????????? <span class="c-gray en">&gt;</span> ???????????? <span class="c-gray en">&gt;</span> ???????????? <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="#" onclick="location.href='index.php?module=orderslist';" title="??????" ><i class="Hui-iconfont">&#xe6a6;</i></a></nav>
<div>
    <aside class="mtb" style="margin:10px 0px 20px 10px">
        <a class="newBtn btn radius" style="display: inline-block;border: none;" href="index.php?module=orderslist&action=Modify&sNo={$data.sNo}">
            <div style="height: 100%;display: flex;align-items: center;">
                <img src="images/icon1/xg_w.png"/>&nbsp;????????????
            </div>
        </a>
        <input type="hidden" id="dingdan" value="{$data.sNo}">
        {if $data.otype!='pt'}
            {if $data.status01 == 1}
                <button value="??????" class="newBtn btn radius" onclick="send_btn(this,'{$data.otype}','{$data.sNo}', '{$data.gstatus}','{$data.drawid}')" style="border: none;width: 80px!important;background-color: #ff453d!important;margin: 0px 10px;">
                    <div style="height: 100%;display: flex;align-items: center;">
                        <img src="images/icon1/fh.png"/>&nbsp;??????
                    </div>
                </button>
            {/if}
        {else}
            {if $data.gstatus==1}
                <button class=" newBtn btn radius ptfh " onclick="send_btn(this,'{$data.otype}','{$data.sNo}', '{$data.gstatus}','{$data.drawid}')">
                    <div style="height: 100%;display: flex;align-items: center;">
                        <img src="images/icon1/fh.png"/>&nbsp;??????
                    </div>
                </button>
            {elseif $data.gstatus==10}
                <button class="btn radius newBtn" style="background-color:#ff453d;" onclick="system_category_del(this,{$data.id},{$data.z_price})">
                    <div style="height: 100%;display: flex;align-items: center;">
                        <img src="images/icon1/tk.png"/>&nbsp;??????
                    </div>
                </button>
            {/if}
        {/if}
<!--         <button class="btn radius newbtn b02" style="height: 36px;border: none;" onclick="printTure();">
            <div style="height: 100%;display: flex;align-items: center;">
                <img src="images/icon1/dy.png"/>&nbsp;??????
            </div>
        </button>&nbsp;&nbsp; -->
        <input type="hidden" class="control" name="control" value="{$data.z_price}" >
        <input type="hidden" name="qingkongyema" id="qingkongyema" class="b02" value="????????????" onclick="pagesetup_null()">&nbsp;&nbsp;
        <input type="hidden" class="tab" value="????????????" onclick="pagesetup_default()">
</div>
<section class="rt_wrap " style="margin-left:10px;margin-right:10px;height:100%;position:relative;">
    <div style="border-radius: 10px;margin-bottom: 20px;background-color: #fff;">
        <p class="ulTitle">????????????</p>
        <ul class="ul1" style="height: 190px;">
            <li style="width: 26.66%;">????????????<span class="grText">{$data.sNo}</span></li>
            <li style="width: 26.66%;">???????????????
                {if $data.otype=='pt'}
                    <span class="grText">????????????</span>
                {else}{if $data.drawid > 0}
                    <span class="grText" >????????????</span>
                {else}
                    <span class="grText">????????????</span>
                {/if}{/if}
            </li>
            <li style="width: 26.66%;">???????????????<span class="grText">????????????</span></li>
            <li style="width: 20.00%;">???????????????<span class="grText">{$data.content}</span></li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.add_time}</span></li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.r_status}</span></li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.deliver_time}</span></li>
            <li style="width: 20.00%;">???????????????<span class="grText">{$data.express_name}</span></li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.user_name}</span> </li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.mobile}</span></li>
            <li style="width: 26.66%;">???????????????<span class="grText">{$data.arrive_time}</span></li>
            <li style="width: 20.00%;">???????????????
                {if $data.courier_num ==''}
                    <span class="grText" style="display: inline-block;" >{$data.courier_num}</span>
                {else}
                    <a class="send-btn1 "  href="javascript:" onclick="send_btn1(this,'{$data.sNo}',{$data.courier_num})">
                        <span style="display: inline-block;" class="grText changeNum">{$data.courier_num}</span>
                    </a>
                {/if}
            </li>
        </ul>
    </div>
    <div style="border-radius: 10px;margin-bottom: 20px;background-color: #fff;">
        <p class="ulTitle">???????????????</p>
        <ul class="ul2" style="height: 190px;">
            <li style="width: 100%;padding-left: 20px;">????????????<span class="grText">{$data.name}</span> </li>
            <li style="width:100%;padding-left: 20px;">???????????????<span class="grText">{$data.mobile}</span></li>
            <li style="width: 100%;padding-left: 20px;">???????????????<span class="grText">{$data.address}</span></li>
        </ul>
    </div>
    <div style="border-radius: 10px;margin-bottom: 20px;background-color: #fff;padding:10px;">
        <p class="ulTitle">????????????</p>
        <table class="table">
            <tr>
                <th class="center">????????????</th>
                <th class="center">????????????</th>
                <th class="center">??????id</th>
                <th class="center">????????????</th>
                <th class="center">????????????</th>
                <th class="center">????????????</th>
                <th class="center">??????</th>
                <th class="center">?????????</th>
                <th class="center">??????</th>
                <th class="center">??????</th>
                <th class="center">????????????</th>
                <th class="center">????????????</th>
                <th class="center">??????</th>
            </tr>
            {foreach from=$detail item=item name=f1}
                <tr>
                    <td style="text-align:left;" id="p_name">
                        <img class='pimg' src="{$uploadImg}{$item->pic}" style="margin-right: 20px;" width="50" height="50"/>{$item->p_name}
                    </td>
                    <td class="center"><span class="grText">{$item->size}</span></td>
                    <td class="center"><span class="grText">{$item->p_id}</span></td>
                    <td class="center" rowspan="{$item->index}"><span class="grText">???{$item->p_price}</span></td>
                    <td class="center" rowspan="{$item->index}"><span class="grText">{$item->num}</span></td>
                    <td class="center" rowspan="{$item->index}"><span  class="grText"style="font-weight: bold;">???{$item->p_price*$item->num}</span></td>
                    <td class="center" rowspan="{$item->index}"><span  class="grText" style="">???{$item->z_price+$item->freight}</span></td>
                    <td class="center" rowspan="{$item->index}"><span class="grText" style="font-weight: bold;">???{$item->z_price+$item->freight}</span></td>
                    <td class="center">{$item->unit}</td>
                    <td class="center">{$item->freight}</td>
                    {if $smarty.foreach.f1.first}
                        <td class="center" style="border: 1px solid #eee;" rowspan="{$num}">{$reduce_price}</td>
                        <td class="center" style="border: 1px solid #eee;" rowspan="{$num}">{$coupon_price}</td>
                        <td class="center" style="border: 1px solid #eee;" rowspan="{$num}">{$allow}</td>
                    {/if}
                </tr>
            {/foreach}
        </table>
    </div>
    <input type="hidden" name="ddd" value="{$data.lottery_status}">
    <input type="hidden" name="ddcc" value="{$data.drawid}">

    </aside>

    <div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;"><div id="innerdiv" style="position:absolute;"><img id="bigimg" src="" /></div></div>
<div class="dc" style="display:none;">
    <div class="maskNewContent">
        <div class="maskTitle ">
            ??????????????????
        </div>
        <a href="javascript:void(0);" class="closeA qx" style="display: block;"><img src="images/icon1/gb.png"/></a>
        <form action="" method="post" class="form form-horizontal" id="form-category-add" enctype="multipart/form-data">
            <div id="tab-category" class="HuiTab">
                <div class="" style="margin-top: 35px;">
                    <div class="" >
                        <input type="hidden" name="sNo" value="" class="order_id">
                        <input type="hidden" name="otype" value="{$otype}" class="otype">
                        <input type="hidden" name="trade" value="3">
                        <label class="maskLeft" style="" >???????????????</label>
                        <div class="formControls maskRight" style="width: 60%;float: left;">
                            <form name="hh" action="" method="post" >
                            <span class="search">
                                <input class="ww ipt1" id="makeInput" autocomplete="off" onkeyup="setContent(this,event);" onfocus="setDemo(this,event)" type="text" placeholder="??????????????????????????????">
                                <select name="kuaidi" class="selectName" id="hh" style="display: none; position: absolute;z-index:99;width: 153px;margin-top: 1px;margin-left: 0px;" onkeyup="getfocus(this,event)" onclick="choose(this)" size="10" id ="num1">
                                    {foreach from=$express item = item name=f1}
                                        <option value="{$item->id}" >{$item->kuaidi_name}</option>
                                    {/foreach}
                                </select>
                            </span>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="" >
                        <label class="maskLeft" style="">???????????????</label>
                        <div class="maskRight" style="">
                            <input type="text" class="ipt1" value="" name="danhao" placeholder="??????????????????????????????"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-9 " style="margin-left:40%">
                    <input class="qd closeMask" type="submit" value="??????">
                </div>
            </div>
        </form>
    </div>
</div>

</section>



<script type="text/javascript" src="style/js/jquery.js"></script>
<script type='text/javascript' src='modpub/js/calendar.js'></script>
<script type="text/javascript" src="style/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="style/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="style/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="style/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="style/js/H-ui.js"></script>
<script type="text/javascript" src="style/js/H-ui.admin.js"></script>
<!--_footer ??????????????????????????????-->
<!--?????????????????????????????????????????????-->
<script type="text/javascript" src="style/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="style/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="style/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="style/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script language="javascript"  src="style/ssd1.js"> </script>
{literal}


    <script type="text/javascript">
        let changeNum = $(".changeNum").html();
        $(".changeNum").mouseover(function(){
            $(this).text("????????????");
        });
        $(".changeNum").mouseout(function(){
            $(this).text(changeNum);
        })
        $(function(){
            $(".pimg").click(function(){
                var _this = $(this);//????????????pimg????????????_this????????????
                imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);
            });
        });
        function imgShow(outerdiv, innerdiv, bigimg, _this){
            var src = _this.attr("src");//?????????????????????pimg????????????src??????
            $(bigimg).attr("src", src);//??????#bigimg?????????src??????

            /*?????????????????????????????????????????????????????????????????????*/
            $("<img/>").attr("src", src).load(function(){
                var windowW = $(window).width();//????????????????????????
                var windowH = $(window).height();//????????????????????????
                var realWidth = this.width;//????????????????????????
                var realHeight = this.height;//????????????????????????
                var imgWidth, imgHeight;
                var scale = 0.8;//???????????????????????????????????????????????????????????????????????????????????????

                if(realHeight>windowH*scale) {//??????????????????
                    imgHeight = windowH*scale;//????????????????????????????????????????????????
                    imgWidth = imgHeight/realHeight*realWidth;//?????????????????????
                    if(imgWidth>windowW*scale) {//??????????????????????????????
                        imgWidth = windowW*scale;//????????????????????????
                    }
                } else if(realWidth>windowW*scale) {//??????????????????????????????????????????
                    imgWidth = windowW*scale;//????????????????????????????????????????????????
                    imgHeight = imgWidth/realWidth*realHeight;//?????????????????????
                } else {//???????????????????????????????????????????????????????????????
                    imgWidth = realWidth;
                    imgHeight = realHeight;
                }
                $(bigimg).css("width",imgWidth);//?????????????????????????????????

                var w = (windowW-imgWidth)/2;//??????????????????????????????
                var h = (windowH-imgHeight)/2;//??????????????????????????????
                $(innerdiv).css({"top":h, "left":w});//??????#innerdiv???top???left??????
                $(outerdiv).fadeIn("fast");//????????????#outerdiv???.pimg
            });

            $(outerdiv).click(function(){//?????????????????????????????????
                $(this).fadeOut("fast");
            });
        }
    </script>
{/literal}
{literal}
<script type="text/javascript">


    function check(f) {
        if (Trim(f.product_title.value) == "") {
            alert("???????????????????????????");
            f.product_title.value = '';
            return false;
        }
        if (Trim(f.keyword.value) == "") {
            alert("????????????????????????");
            f.keyword.value = '';
            return false;
        }
        if (Trim(f.sort.value) == "") {
            alert("?????????????????????");
            f.sort.value = '';
            return false;
        }
        f.sort.value = Trim(f.sort.value);
        if (!/^(([1-9][0-9]*)|0)(\.[0-9]{1,2})?$/.test(f.sort.value)) {
            alert("??????????????????????????????????????? ####.## ???");
            f.sort.value = '';
            return false;
        }
        console.log(1);
        return true;
    }

    $(".qd").click(function(){
        var id = $('.order_id').val(); // ?????????
        var express = $('select[name=kuaidi]').val(); // ????????????id
        var express_name = $('select[name=kuaidi]').find("option:selected").text(); // ??????????????????
        var courier_num = $('input[name=danhao]').val(); // ????????????
        // var freight = $('input[name=yunfei]').val();
        var otype = $(".otype").val(); // ??????
        console.log(courier_num,express_name,express,"as4d65");
        console.log(express_name.length,express.length)
        if(express_name.length < 1){
            appendMask_tj('?????????????????????',"ts");
        }else if(courier_num.length < 10){
            appendMask_tj('???????????????????????????',"ts");
        }else{
        $.ajax({
            url:"index.php?module=orderslist&action=addsign",
            type:"post",
            data:{sNo:id,trade:3,express:express,courier_num:courier_num,otype:otype,express_name:express_name},
            dataType:"json",
            success:function (data) {
                console.log(data);
                $(".dc").hide();
                if(data == 1){
                    console.log(1)
                    appendMask1('????????????',"cg");
                }else{
                    appendMask('????????????????????????????????????',"ts");
                }
            },
        });
        }

    });

    function system_category_add(title,url,w,h){
        appendMask(title,url,w,h);
    }

    $(".qx").click(function(){
        $(".dc").hide();
    })
    function send_btn(obj,otype, id, status,drawid) {
        console.log(otype, id, status,drawid);
        var dingdan = id;
        var stu = status;
        $('.order_id').val(id);
        $('.otype').val(otype ? otype:'yb');

        if(stu == 6) {
            appendMask1('??????????????????????????????!',"ts");
        }
        if(stu >= 2 && stu != 6) {
            appendMask1('????????????????????????????????????!',"ts");
        }

        if(stu == 0) {
            appendMask1('??????????????????!',"ts");
        }

        if(stu == 1) {
            console.log(drawid)
            if(drawid == 0){//????????????
                $(".dc").show();
            }else{
                appendMask1('?????????????????????????????????????????????',"ts");
            }
        }

    };

    function send_btn1(obj, id,courier_num) {
        var r_sNo = id;
        $.ajax({
            url:'index.php?module=orderslist&action=kuaidishow&r_sNo='+r_sNo+'&courier_num='+courier_num,
            type:"post",
            data:{},
            success:function (res) {
                var data = JSON.parse(res);
                console.log(data.code);
                if(data.code == 1){
                    closeMask1();
                    console.log(1);
                    var str = '';
                    for (var i = 0; i < data.data.length; i++) {
                        str += '<div class="time" style="margin-left: 30px;">'+data.data[i].time+'</div><div class="step" style="font-size: 0.5rem; padding: 5px 20px;    margin-left: 30px;">'+data.data[i].context+'</div>';
                    }
                    wl_appendMask(str,"cg");
                }else{
                    appendMask('?????????????????????',"ts");
                }
            },
        });
    };
    function confirm1 (content,id,content1){
        $("body").append(`
                <div class="maskNew">
                    <div class="maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">??????</div>
                        <div style="text-align:center;margin-top:30px"><img src="images/icon1/ts.png"></div>
                        <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" style="margin-right:20px" onclick=closeMask2("${id}","${content1}") >??????</button>
                            <button class="closeMask" onclick=closeMask1() >??????</button>
                        </div>
                    </div>
                </div>
            `)
    }
    function closeMask2(id,content){
        $(".maskNew").remove();
        $.ajax({
            type:"post",
            url:"index.php?module=coupon&action=whether&id="+id,
            async:true,
            success:function(res){
                console.log(res);
                if(content=="??????"){
                    if(res==1){
                        appendMask("????????????","cg");
                    }
                    else{
                        appendMask("????????????","ts");
                    }
                }
                else{
                    if(res==1){
                        appendMask("????????????","cg");
                    }
                    else{
                        appendMask("????????????","ts");
                    }
                }
            }
        });
    }
    function wl_appendMask(content,src){
        $("body").append(`
                <div class="wl_maskNew">
                    <div class="wl_maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=close_wl_Mask1() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">????????????</div>
                        <div style="height: 370px;position: relative;top:20px;font-size: 22px;text-align: center;overflow: scroll;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" onclick=close_wl_Mask1() >??????</button>
                        </div>
                    </div>
                </div>
            `)
    }

    function close_wl_Mask1() {
        $(".wl_maskNew").remove();
    }

    function appendMask(content,src){
        $("body").append(`
                <div class="maskNew ">
                    <div class="maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">??????</div>
                        <div style="text-align:center;margin-top:30px"><img src="images/icon1/${src}.png"></div>
                        <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" onclick=closeMask1() >??????</button>
                        </div>
                    </div>
                </div>
            `)
    }

    function appendMask_tj(content,src){
        $(".dc").hide();
        $("body").append(`
                <div class="maskNew ">
                    <div class="maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">??????</div>
                        <div style="text-align:center;margin-top:30px"><img src="images/icon1/${src}.png"></div>
                        <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" onclick=closeMask_tj() >??????</button>
                        </div>
                    </div>
                </div>
            `)
    }

    function closeMask_tj() {
         $(".maskNew").remove();
         $(".dc").show();
    }

    function appendMask1(content,src){
        $("body").append(`
                <div class="maskNew maskNew1">
                    <div class="maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=closeMask4() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">??????</div>
                        <div style="text-align:center;margin-top:30px"><img src="images/icon1/${src}.png"></div>
                        <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" onclick=closeMask4() >??????</button>
                        </div>

                    </div>
                </div>
            `)
    }
    function closeMask(id){
        var sNo = '{/literal}{$data.sNo}{literal}';
        var oid = '{/literal}{$data.id}{literal}';
        var uid = '{/literal}{$data.user_id}{literal}';
        var paytype = '{/literal}{$data.paytype}{literal}';
        var trade_no = '{/literal}{$data.trade_no}{literal}';
        var p_name = $('#p_name').text();
        var control = $('.control').val();
        $.ajax({
            type: 'POST',
            url: 'index.php?module=orderslist&action=Status&otype=pt',
            dataType: 'json',
            data:{id:oid,price:control,sNo:sNo,p_name:p_name,paytype:paytype,trade_no:trade_no,uid:uid},
            success: function(data){
                $(".maskNew").remove();
                if(data.status == 1){
                    // layer.msg('???????????????????????????!',{icon:1,time:800});
                    appendMask1("???????????????????????????","cg");
                }else{
                    appendMask("????????????","ts");
                }
            },
            error:function(data) {

            },
        });


    }
    function closeMask1(){
        $(".maskNew").remove();
    }
    function closeMask4(){
        $(".maskNew1").remove();
        location.replace(location.href);
    }
    function confirm (content,id){
        $("body").append(`
                <div class="maskNew">
                    <div class="maskNewContent">
                        <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                        <div class="maskTitle">??????</div>
                        <div style="text-align:center;margin-top:30px"><img src="images/icon1/ts.png"></div>
                        <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                            ${content}
                        </div>
                        <div style="text-align:center;margin-top:30px">
                            <button class="closeMask" style="margin-right:20px" onclick=closeMask("${id}") >??????</button>
                            <button class="closeMask" onclick=closeMask1() >??????</button>
                        </div>
                    </div>
                </div>
            `)
    }
    function hm(){
        $(".dd").hide();
    }


    // function send_btn1(obj, id,courier_num ) {
    //     var r_sNo = id;
    //     var courier_num = courier_num;
    //     system_category_add('??????????????????','index.php?module=orderslist&action=kuaidishow&r_sNo='+r_sNo+'&courier_num='+courier_num,400,300);
    // };

    $(".fk").click(function(){
        var stu = '{/literal}{$data.status01}{literal}';
        if(stu>=1){
            layer.msg('????????????????????????????????????!',{time:1000});
            $(".dc").hide();
        }else{
            var id = '{/literal}{$data.sNo}{literal}';
            $.ajax({
                url:"index.php?module=orderslist&action=Detail",
                type:"post",
                data:{sNo:id,trade:2},
                dataType:"json",
                success:function(data) {
                    if(data.status == 1){
                        alert(data.msg);
                    }
                    window.location.reload();
                },

            });
        }


    })
    /*??????-??????-??????*/
    function system_category_add(title,url,w,h){
        layer_show(title,url,w,h);
    }

    $(".qx").click(function(){
        $(".dc").hide();
    })

    // $(".dj").click(function(){
    //     var dingdan = $("#dingdan").val();
    //     var stu = '{/literal}{$data.status01}{literal}';
    //     var stu01 = '{/literal}{$data.r_status}{literal}';
    //     if(stu==6){
    //         layer.msg('??????????????????????????????!',{time:1000});
    //         $(".dc").hide();
    //     }
    //     if(stu>=2 && stu !=6){
    //         layer.msg('????????????????????????????????????!',{time:1000});
    //         $(".dc").hide();
    //     }

    //     if(stu == 0){
    //         layer.msg('??????????????????!',{time:1000});
    //         $(".dc").hide();
    //     }

    //     if(stu == 1){
    //         var lottery_status = '{/literal}{$data.lottery_status}{literal}';
    //         var drawid = '{/literal}{$data.drawid}{literal}';

    //         if(lottery_status ==7){//????????????
    //             system_category_add('??????????????????','index.php?module=orderslist&action=addsign&id='+dingdan,400,300);
    //         }else if(lottery_status ==4){//????????????
    //             system_category_add('??????????????????','index.php?module=orderslist&action=addsign&id='+dingdan,400,300);

    //         }else{
    //             layer.msg('??????????????????????????????',{time:1000});
    //             $(".dc").hide();
    //         }

    //     }

    // })

    function system_category_del(obj,id,control){

        confirm('?????????????????????','ts');
    }
</script>

{/literal}
</body>
</html>