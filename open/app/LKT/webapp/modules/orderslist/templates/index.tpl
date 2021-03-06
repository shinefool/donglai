<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link href="//at.alicdn.com/t/font_353057_iozwthlolt.css" rel="stylesheet">
	<link href="style/statics/mch/css/bootstrap.min.css" rel="stylesheet">
	<link href="style/statics/mch/css/jquery.datetimepicker.min.css" rel="stylesheet">
	<link href="style/statics/css/flex.css?version=2.5.8.0" rel="stylesheet">
	<link href="style/statics/css/common.css?version=2.5.8.0" rel="stylesheet">
	<link href="style/statics/mch/css/common.v2.css?version=2.5.8.0" rel="stylesheet">

	<link href="style/css/H-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="style/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
	<link href="style/css/style.css" rel="stylesheet" type="text/css" />
	<link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
	{literal}
		<style type="text/css">
			#delorderdiv {
				margin-left: 20px;
				display: inline;
				color: red;
			}
			#btn1:hover{
				background-color: #2481e5!important;
			}
			#btn1{
				height: 36px;
				line-height: 36px;
			}
			#btn2:hover{
				background-color: #2481e5!important;
			}
			#btn2{
				height: 36px;
				line-height: 36px;
			}
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
			.paginationDiv {
			    width: 100%;
			    background-color: #fff;
			    padding: 20px 0;
			    height: 30px;
			    line-height: 30px;
			    box-sizing: content-box;
			    border-top: none;
			}
			.changePaginationNum {
			    float: left;
			    margin-left: 20px;
			}
			.showDataNum {
			    float: left;
			    margin-left: 20px;
			    color: #414658;
			}
			.pagination {
			    display: -webkit-box;
			    display: -webkit-flex;
			    display: -ms-flexbox;
			    display: flex;
			    padding-left: 0;
			    list-style: none;
			    border-radius: .25rem;
			    float: right;
			    margin-right: 20px;
			    height: 30px;
			}
		</style>

	{/literal}
	<title>????????????</title>
</head>

<body>
<nav class="breadcrumb" style="height: 50px;"><i class="Hui-iconfont">&#xe627;</i> ???????????? <span class="c-gray en">&gt;</span> ????????????<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="??????"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
		<form name="form1" action="index.php" method="get">
			<input type="hidden" name="module" value="orderslist" />
			<input type="hidden" name="having" value="123" />
			<input type="hidden" name="ordtype" value="{$otype}" />
			<input type="hidden" name="gcode" value="{$status}" />
			<input type="hidden" name="ocode" value="{$ostatus}" />
			<select name="otype" id="otype" class="select" style="width: 120px;height: 31px;vertical-align: middle;">
				{foreach from=$ordtype item="item" key="key"}
					<option value="{$key}" {if $otype==$key}selected{/if}>{$item}</option>
				{/foreach}
			</select>

			<select name="status" id="status" class="select" style="width: 120px;height: 31px;vertical-align: middle;">
				<option value="">????????????</option>
				{$class}
			</select>

			<select name="source" id="source" class="select" style="width: 120px;height: 31px;vertical-align: middle;">
				<option value="">????????????</option>
				{$source}
			</select>

			<select name="brand" id="brand" class="select" style="width: 120px;height: 31px;vertical-align: middle;">
				<option value="">???????????????</option>
				{$brand_str}
			</select>

			<input type="text" name="sNo" size='8' value="{$sNo}" id="" placeholder=" ???????????????????????????/ID/??????..." autocomplete="off" style="width:200px" class="input-text">
			<div style="position: relative;display: inline-block;">

				<input name="startdate" value="{$startdate}" size="8" readonly class="scinput_s iptRl" style="" placeholder="?????????????????????" onclick="new Calendar().show(document.form1.startdate);"/>
				<img src="images/icon1/rl.png" style="cursor:pointer;position: absolute;right: 10px;top: 7px;" onclick="new Calendar().show(document.form1.startdate);" />

			</div>???
			<div style="position: relative;display: inline-block;margin-left: 5px;">

				<input  name="enddate" value="{$enddate}" size="8" readonly class="scinput_s iptRl" style="" placeholder="?????????????????????" onclick="new Calendar().show(document.form1.enddate);"/>
				<img src="images/icon1/rl.png" style="cursor:pointer;position: absolute;right: 10px;top: 7px;" onclick="new Calendar().show(document.form1.enddate);" />

			</div>
			<input class="btn btn-success" id="btn1" type="submit" value="??????">
			<input type="button" value="??????" id="btn8" style="border: 1px solid #D5DBE8; color: #6a7076; height: 31px;" class="reset" onclick="empty()" />
			<input type="button" value="??????" id="btn2" style="margin-right: 0px;float: right;" class="btn btn-success" onclick="excel(location.href)">


		</form>



	</div>
	<div class="mt-20">
		<table class="table table-bordered bg-white">
			<thead>
			<tr class="txc">

				<th style="width: 170px;">?????????</th>
				<th style="width: 70px;">????????????</th>
				<th style="width:250px!important;" width="250px">????????????</th>
				<th style="width: 75px;">????????????</th>
				<th style="width: 75px;">????????????</th>
				<th style="width: 75px;">????????????</th>
				<th style="width: 75px;">????????????</th>
				<th style="width: 75px;">????????????</th>
				<th style="width: 75px;">??????ID</th>
				<th style="width: 75px;">??????</th>
				<th>??????</th>
				<th>????????????</th>
				<th>??????</th>
			</tr>
			</thead>
			<tbody>
			{foreach from=$order item=item name=f1}
				<tr>

					<td>
						<span>{$item->sNo}</span>
					</td>
					<td class="imgTd">
						{foreach from=$item->products item=item2 name=f2}
							<div >
								<img class="goods-pic" src="{$uploadImg}{$item2->imgurl}"/>
							</div>
						{/foreach}
					</td>
					<td class="tbText" style="width:250px!important;text-align: left;" width="250px">
						{foreach from=$item->products item=item2 name=f2}
							<span style="text-align: left;">{$item2->product_title}</span>
						{/foreach}
					</td>
					<td>
						<div>&yen;{$item->z_price}</div>
					</td>
					<td>

						<div>
							<span style="">{$item->status}</span>
						</div>
					</td>
					<td>
						<div>
								<span>
									{if $item->pay == 'wxPay'}????????????
									{elseif $item->pay == 'wallet_Pay'}????????????
									{elseif $item->pay == 'consumer_pay'}???????????????
									{else}????????????{/if}
								</span>
						</div>
					</td>
					<td>
						<div>
							<span >????????????</span>
						</div>
					</td>
					<td>
						<div>
							<span >{if $item->otype == 'pt'}????????????{else}????????????{/if}</span>
						</div>
					</td>
					<td>
						<div  class="goods-name">
							<span >{$item->user_id}</span>
						</div>
					</td>
					<td>
						<div  class="goods-name">
							<span >{$item->user_name}</span>
						</div>
					</td>
					<td>
						<div style="text-align: center;">
							<span >{if $item->source == 1}?????????{else}APP{/if}</span>
						</div>
					</td>
					<td>
						<div style="text-align: center;">
							<span >{$item->add_time}</span>
						</div>
					</td>
					<td  style="text-align: center;width: 80px;">
						{if $item->statu == 1}
							<a class="btn send-btn" href="javascript:void(0);" onclick=send_btn(this,'{$item->otype}','{$item->sNo}',{$item->statu},{$item->drawid})> ??????</a>
						{/if}
						{if $item->statu >= 2 && $item->status_a ==1}
							<a class="btn send-btn1" href="javascript:void(0);" onclick="send_btn1(this,'{$item->sNo}','{$item->products[0]->courier_num}')" >????????????</a>
						{/if}
						<a class="btn" style="margin-top: 5px;" href="index.php?module=orderslist&action=Detail&id={$item->id}">????????????</a>
						<br>
					</td>
				</tr>
			{/foreach}
			</tbody>
		</table>
	</div>
	<div style="text-align: center;display: flex;justify-content: center;">{$pages_show}</div>

</div>
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
<div class="maskNew dd" style="display: none;">
	<div class="maskNewContent">
		<div class="maskTitle ">
			??????????????????
		</div>
		<a href="javascript:void(0);" class="closeA qx"><img src="images/icon1/gb.png"/></a>
		<div class="page-container" style="margin: 0 auto;">
			{if $res ==1 }
				<p style=" text-align: center;height: 100%;">????????????????????????</p>
			{else}
				{foreach from=$res item="item" key="key"}
					<div class='time' style="    margin-left: 30px;">{$item->time}</div>
					<div class='step' style="font-size: 0.5rem; padding: 5px 20px;    margin-left: 30px;">{$item->context}</div>
				{/foreach}
			{/if}

		</div>
		<div style="text-align:center;margin-top:30px">
			<button class="closeMask"  onclick=hm()>??????</button>
		</div>
	</div>
</div>
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
            appenMask1('??????????????????????????????!',"ts");
        }
        if(stu >= 2 && stu != 6) {
            appenMask1('????????????????????????????????????!',"ts");
        }

        if(stu == 0) {
            appenMask1('??????????????????!',"ts");
        }

        if(stu == 1) {
            if(drawid == 0){//????????????
                $(".dc").show();
            }else{
                appenMask1('?????????????????????????????????????????????',"ts");
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


function excel(url) {
    export_popup(url);
}

function export_popup(url) {
        var res = `<div class="pup_div" id="pup_div">
                        <div class="pup_flex">
                            <div class="pup_auto">
                                <div class="pup_head"><span>????????????</span>
                                    <img src="images/icon/cha.png" onclick="export_close('${url}','')">
                                </div>
                                
                                <div class="pup_dc">
                                    <div class="pup_dcv" onclick="export_close('${url}','This_page')">
                                        <div>
                                            <img src="images/iIcon/scby.png" />
                                            <p>????????????</p>
                                        </div>
                                    </div>
                                    <div class="pup_dcv" onclick="export_close('${url}','whole')">
                                        <div>
                                            <img src="images/iIcon/dcqb.png" />
                                            <p>????????????</p>
                                        </div>
                                    </div>
                                    <div class="pup_dcv" onclick="export_close('${url}','inquiry')"> 
                                        <div>
                                            <img src="images/iIcon/dcss.png" />
                                            <p>????????????</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>`;
        $("body").append(res);
}
function export_close(url,type) {
        $("#pup_div").remove();
        location.href=location.href+'&pageto='+type;
}
    var i = 0;
    $('select[name=otype]').change(function() {
        let ss = $(this).children('option:selected').val();
        if(ss == 't2') {
            $('select[name=status]').empty();
            $('select[name=status]').append("<option value=''>????????????</option><option value='g0'>?????????</option><option value='g1'>?????????</option><option value='g2'>????????????</option><option value='g3'>????????????</option>");
        } else {
            $('select[name=status]').empty();
            $('select[name=status]').append("<option value=''>????????????</option><option value='0'>?????????</option><option value='1'>?????????</option><option value='2'>?????????</option><option value='3'>?????????</option><option value='4'>??????</option><option value='5'>?????????</option>");
            $('select[name=ostatus]').remove();
        }
    })

    $('select[name=status]').change(function() {
        let ss = $('select[name=otype]').children('option:selected').val();
        let gg = $(this).children('option:selected').val();
        if(gg == 'g2') {
            $('#fail').remove();
            $('select[name=status]').after("<select name='ostatus' class='select' id='success' style='width: 80px;height: 31px;vertical-align: middle;margin-left: 5px;'><option value='g1' selected>?????????</option><option value='g2'>?????????</option><option value='g3'>?????????</option></select>");
        } else if(gg == 'g3') {
            $('#success').remove();
            $('select[name=status]').after("<select name='ostatus' class='select' id='fail' style='width: 80px;height: 31px;vertical-align: middle;margin-left: 5px;'><option value='g10' selected>?????????</option><option value='g11'>?????????</option></select>");
        } else {
            $('select[name=ostatus]').remove();
        }
    })

    var having = $('input[name=having]').val();
    var otype = $('input[name=ordtype]').val();
    var gstatus = $('input[name=gcode]').val();
    var ostatus = $('input[name=ocode]').val();
    if(having == '123') {
        var tv = $('select[name=otype]').children('option:selected').val();
        if(tv == 't2') {
            $('select[name=status]').empty();
            $('select[name=status]').append("<option value=''>????????????</option>");
            var options = {
                g0: '?????????',
                g1: '?????????',
                g2: '????????????',
                g3: '????????????'
            };
            var str = '';

            $.each(options, function(index, element) {
                str = '<option value="' + index + '"';
                if(gstatus == index) {
                    str += ' selected';
                }
                str += '>' + element + '</option>';
                $('select[name=status]').append(str);
            })


            var gv = $('select[name=status]').children('option:selected').val();
            if(gstatus == 'g2') {
                $('#fail').remove();
                $('select[name=status]').after("<select name='ostatus' class='select' id='success' style='width: 80px;height: 31px;vertical-align: middle;margin-left: 5px;'></select>");
                var options = {
                    g1: '?????????',
                    g2: '?????????',
                    g3: '?????????'
                };
                var str = '';
                $.each(options, function(index, element) {
                    str = '<option value="' + index + '"';
                    if(ostatus == index) {
                        str += ' selected';
                    }
                    str += '>' + element + '</option>';
                    $('select[name=ostatus]').append(str);
                })
            } else if(gstatus == 'g3') {
                $('#success').remove();
                $('select[name=status]').after("<select name='ostatus' class='select' id='fail' style='width: 80px;height: 31px;vertical-align: middle;margin-left: 5px;'><select>");
                var options = {
                    g10: '?????????',
                    g11: '?????????'
                };
                var str = '';
                $.each(options, function(index, element) {
                    str = '<option value="' + index + '"';
                    if(ostatus == index) {
                        str += ' selected';
                    }
                    str += '>' + element + '</option>';
                    $('select[name=ostatus]').append(str);
                })
            } else {
                $('select[name=ostatus]').remove();
            }
        }

    }

    //?????????????????????
    var ids = [];
    $("#allAndNotAll").click(function() {
        if(this.checked) {
            $("input[name=checkid]").each(function(index) {
                $(this).prop("checked", true);
                var val = $(this).val();
                arrModify(ids, val, 1);
            });
        } else {
            $("input[name=checkid]").each(function(index) {
                $(this).prop("checked", false);
                var val = $(this).val();
                arrModify(ids, val, 2);
            });
        }

    });

    Array.prototype.indexOf = function(val) {
        for(var i = 0; i < this.length; i++) {
            if(this[i] == val) return i;
        }
        return -1;
    }
    Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if(index > -1) {
            this.splice(index, 1);
        }
    }

    function arrModify(arr, val, type) { //??????????????????  2???????????????
        if(type == 1) {
            var index = $.inArray(val, arr);
            if(index === -1) arr.push(val);
        } else if(type == 2) {
            arr.remove(val);
        }
        return arr;
    }

    function selectId(i) {
        i = i.toString();
        var index = $.inArray(i, ids); //?????????????????????????????????,????????????????????????,?????????????????????-1
        if($('#checkid' + i).prop('checked') == true) {
            if(index === -1) ids.push(i);
        } else {
            ids.remove(i);
        }
    }
    Array.prototype.distinct = function() { //????????????
        var arr = this,
            result = [],
            i,
            j,
            len = arr.length;
        for(i = 0; i < len; i++) {
            for(j = i + 1; j < len; j++) {
                if(arr[i] === arr[j]) {
                    j = ++i;
                }
            }
            result.push(arr[i]);
        }
        return result;
    }

    $('#getAllSelectedId').click(function() {

        if(ids.length === 0) {
            layer.alert('?????????????????????', {
                icon: 5,
                title: "??????"
            });
        } else {
            layer.confirm('?????????????????????', function(index) {
                ids = ids.distinct();
                var delIds = ids.join(",");
                //console.log(ids);
                $.ajax({
                    url: "index.php?module=orderslist&action=delorder",
                    type: "post",
                    data: {
                        ids: delIds
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.code == 1) {
                            layer.alert(data.msg, {
                                skin: 'layui-layer-lan',
                                closeBtn: 0,
                                anim: 4 //????????????
                            }, function() {
                                location.reload();
                            });

                        }
                    },
                });
            });
        }
    });
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
        $(".maskNew").remove();
        $.ajax({
            type:"post",
            url:"index.php?module=coupon&action=del&id="+id,
            async:true,
            success:function(res){
                console.log(res)
                if(res==1){
                    appendMask("????????????","cg");
                }
                else{
                    appendMask("????????????","ts");
                }
            }
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

	window.onload=function(){
		$(".imgTd").each(function(){
			$(this).find("div").each(function(){
				$(this).hide();
			})
			$(this).find("div").eq(0).show()
		})
		$(".tbText").each(function(){
			$(this).find("span").each(function(){
				$(this).hide();
			})
			$(this).find("span").eq(0).show()
		})
	}
	function empty() {
    $("input[name='sNo']").val('');
    $("input[name='startdate']").val('');
    $("input[name='enddate']").val('');
    $("#otype").val('');
    $("#status").val('');
    $("#source").val('');
    $("#brand").val('');
}

</script>
{/literal}
</body>

</html>