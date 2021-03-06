<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="style/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="style/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="style/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="style/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="style/css/style.css" />
{literal}
  <style type="text/css">
   
     .isclick a{
        color: #ffffff;
     }
     .page_bgcolor .status{border: 1px solid #ddd;border-right: 0;}
     .page_bgcolor .status:last-child{border-right: 1px solid #ddd;}
     .page_bgcolor div{
         font-size: 16px;
     }
     .status{
     	width: 80px;
     	height: 34px;
     	line-height: 34px;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    background-color: #fff;
	    margin-left: 0px;
     }
     .status a:hover{
     	text-decoration: none;
     	color: #fff;
     }
     .status:hover{
     	background-color: #2481e5;
     }
     .status:hover a{
     	color: #fFF;
     }
     .isclick{
     	width:80px;
     	height:34px;
     	background: #2890FF;
     	display: flex;
     	flex-direction: row;
     	align-items: center;
     	justify-content: center;
     	border: 1px solid #2890FF!important;
     }
     td a{
            width: 44%;
            margin: 2%!important;
        }
     
      td button {
          margin:4px;
          float: left;
          background: white;
          color:  #DCDCDC;
          border: 1px #DCDCDC solid;
          width:56px;
          height:22px;
      }
     .tc-box{
         width: 100%;
         height: 100vh;
         position: relative;
         position: fixed;
         background: rgba(0,0,0,0.3);
         display: none;
         top: 0;
     }
     .tc-box > div{
         height: 500px;
         width: 70%;
         position: absolute;
         left: 15%;
         top: 10px;
         background: #fff;
     }
     .tc-box-close{
         position: absolute;
         width: 20px;
         height: 20px;
         text-align: center;
         line-height: 20px;
         right: 10px;
         background: #8e8e8e;
         top: 10px;
         color: #fff;
         border-radius: 100%;
         cursor:hand;
     }
      .confirm{
          width: 100%;
          height: 100%;
          z-index: 999;
          position: fixed;
          top: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          background: rgba(0,0,0,.5);
      }
     .confirm > div{
         background: #fff;
         width: 460px;
         height: 223px;
     }
      .confirm_tips{
          text-align: center;
          height: 150px;
          line-height: 150px;
          font-size:16px;
          font-family:MicrosoftYaHei;
          font-weight:400;
          color:rgba(65,70,88,1);
      }
      .confirm_btn > button{
          width:112px;
          height:36px;
          line-height: 36px;
          border:1px solid #2890FF;
          border-radius:2px;
          color: #2890FF;
      }
      .confirm_btn{
          display: flex;
          justify-content: space-around;
          width: 60%;
          margin-left: 20%;
          text-align: center;
      }

      .hide{
          display: none;
      }

      .qh{
          width: 112px !important;
          height: 42px !important;
      }
      .table-border th, .table-border td {
     border-bottom: 0; 
    }
  </style>
{/literal}
<title>??????????????????</title>
</head>
<body>
<nav class="breadcrumb" style="font-size: 16px;"><span class="c-gray en"></span><i class="Hui-iconfont">&#xe67f;</i> ????????????
  <span class="c-gray en">&gt;</span>??????

  <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="??????" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container pd-20 page_absolute">
  <div style="display: flex;flex-direction: row;font-size: 16px;" class="page_bgcolor">
    <div class="status qh {if $status==0}isclick{/if}"  style="border-radius: 2px 0px 0px 2px !important;"><a href="index.php?module=go_group&action=index&status=0" onclick="statusclick(0)">????????????</a></div>
    <div class="status qh {if $status==4}isclick{/if}"><a href="index.php?module=go_group&action=index&status=4" onclick="statusclick(4)">????????????</a></div>
    <div class="status qh {if $status==5}isclick{/if}"><a href="index.php?module=go_group&action=index&status=5" onclick="statusclick(5)">????????????</a></div>
    <div class="status qh {if $status==6}isclick{/if}"  style="border-radius: 0px 2px 2px 0px !important;"><a href="index.php?module=go_group&action=config" onclick="statusclick(5)">????????????</a></div>
  </div>
	<div class="page_h16"></div>
	<div class="text-c" >
        {if  $status==4 || $status==5}
                <form name="form1" action="index.php" method="get" style="display: flex;">
                <input type="hidden" name="module" value="go_group"/>
                 <input type="hidden" name="action" value="index"/>
                <input type="text" name="proname" size='8' value="{$proname}" id="" placeholder="?????????????????????" style="width:200px" class="input-text">
                <input type="text" name="username" size='8' value="{$username}" id="" placeholder="?????????????????????" style="width:200px" class="input-text">

                {if  $status==4}
                    <select style="width: 200px;margin-right: 5px;" name="group_status" id='group_status'>
                        <option value="">?????????????????????</option>
                        <option value="1" {if $group_status=='1'}selected{/if}>?????????</option>
                        <option value="2" {if $group_status=='2'}selected{/if}>????????????</option>
                        <option value="3" {if $group_status=='3'}selected{/if}>????????????</option>
                    </select>
                    <input type="hidden" name="status" value="4"/>
                {else}
                    <input type="hidden" name="status" value="5"/>
                {/if}
                <input type="button" value="??????" id="btn8" style="border: 1px solid #D5DBE8; color: #6a7076; height: 31px;" class="reset" onclick="empty()" />

                <input name="" id="" class="btn btn-success buttom_hover" type="submit" value="??????">
            </form>
        {else}
            <form name="form1" action="index.php" method="get"  style="display: flex;align-items: center;">
                <input type="hidden" name="module" value="go_group" />
                 <input type="hidden" name="action" value="index"/>
                <input type="hidden" name="pagesize" value="{$pagesize}" id="pagesize" />
                <input type="text" name="proname" size='8' value="{$proname}" id="" placeholder="?????????????????????" style="width:200px" class="input-text" autocomplete="off">
                <select style="background: #fff;width:200px;" name="group_status"  id='group_status'>
                    <option value="">?????????????????????</option>
                        <option value="1" {if $group_status=='1'}selected{/if}>?????????</option>
                        <option value="2" {if $group_status=='2'}selected{/if}>?????????</option>
                        <option value="3" {if $group_status=='3'}selected{/if}>?????????</option>
                </select>
                 <input type="button" value="??????" id="btn8" style="border: 1px solid #D5DBE8; color: #6a7076; height: 31px;" class="reset" onclick="empty()" />

                <input name="" id="" class="btn btn-success" type="submit" value="??????">
            </form>
        {/if}
    </div>
    <div class="page_h16"></div>
    <div class="page_bgcolor page_t">
        {if $type == 'record' || $type == 'canrecord'}

        {else}
        <div class="page_h16"></div>
            <a class="btn newBtn radius" href="index.php?module=go_group&action=addproduct">
                <div style="height: 100%;display: flex;align-items: center;">
                    <img src="images/icon1/add.png"/>&nbsp;????????????
                </div>
            </a>
        {/if}
    </div>
    <div class="page_h16"></div>
	<div class="mt-20">
		<table class="table-border tab_content">
			{if  $status==4}
                <thead>
                <tr class="text-c tab_tr">
                    <th>
                    ??????
                    </th>
                    <th style="width:170px;">????????????</th>
                    <th style="width:200px;">????????????</th>
                    <th style="width:5%;">????????????</th>
                    <th>?????????</th>
                    <th>????????????</th>
                    <th>????????????</th>
                    <th>??????????????????</th>
                    <th style="width: 80px;">?????????</th>
                    <th style="width: 80px;">????????????</th>
                    <th style="width: 80px;">??????????????????</th>
                    <th style="width: 150px;">??????</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$list item=item}
                        <tr class="text-c tab_td">
                        <td>
                            {$item->id}
                        </td>
                        <td>
                            <div title=" {$item->group_title}" style="height: 60px; overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width:160px;line-height: 60px;">
                                {$item->group_title}
                            </div>
                        </td>
                        <td style="display: flex;align-items: center;">
                            <div style="width: 60px;height: 60px;">
                                {if $item->imgurl != ''}
                                    <img onclick="pimg(this)" style="width: 60px;height: 60px;" src="{$item->imgurl}">
                                {else}
                                    <span>????????????</span>
                                {/if}
                            </div>
                            <div title="{$item->p_name}" style="height: 60px; overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width:160px;line-height: 60px;  text-align: left; margin-left: 10px;">
                                {$item->p_name}
                            </div>
                        </td>
                            <td>
                                {$item->groupman}??????
                            </td>
                            <td>{$item->price} ???</td>
                            <td>???{$item->openmoney} </td>
                            <td>???{$item->canmoney} </td>
                            <td>
                                ???????????????{$item->start_time}
                                <br/>
                                ???????????????{$item->end_time}
                            </td>

                            <td>{$item->user_name}</td>
                            <td>
                           <div>
                              {if $item->ptstatus==3}
                                   <span style="color: orange;">????????????</span>
                               {elseif $item->ptstatus==2}
                                   <span style="color: red;">????????????</span>
                               {elseif $item->ptstatus==1}
                                   <span style="color: green">?????????</span>
                               {/if}
                           </div>
                        </td>
                            <td style="text-align: center;">
                                {$item->addtime}
                            </td>
                        <td class="tab_editor">
                                <a href="#" onclick="canprecord('{$item->ptcode}')" style="width: 80%;">??????????????????</a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            {elseif $status==5}
                <thead>
                <tr class="text-c tab_tr">
                    <th>
                    ??????
                    </th>
                    <th style="width:15%;">??????????????????</th>
                    <th style="width:15%;">????????????</th>
                    <th style="width:15%;">????????????</th>
                    <th>?????????</th>
                    <th>????????????</th>
                    <th style="width:8%;">????????????</th>
                    <th style="width:8%;">????????????</th>
                    <th>??????????????????</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$list item=item}
                    <tr class="text-c tab_td">
                        <td>
                            {$item->id}

                        </td>
                        <td>
                           <div style="text-align: left; margin-left: 10px;">
                                {$item->group_title}
                            </div>
                        </td>
                        <td style="display: flex;align-items: center;">
                            <div style="width: 60px;height: 60px;">
                                {if $item->imgurl != ''}
                                    <img onclick="pimg(this)" style="width: 60px;height: 60px;" src="{$item->imgurl}">
                                {else}
                                    <span>????????????</span>
                                {/if}
                            </div>
                            <div title="{$item->product_title}" style="height: 60px; overflow: hidden;text-align:left;padding-left: 10px;white-space: nowrap;text-overflow: ellipsis;width: 200px;line-height: 60px;text-align: left; margin-left: 10px;">
                                {$item->product_title}
                            </div>
                        </td>
                        <td> {$item->groupman}??????</td>
                        <td>???{$item->price} </td>
                        <td>???{$item->canmoney}</td>
                        <td>{$item->user_name}</td>
                        <td>
                            <!-- <div>
                                {if $item->group_status==0}
                                    <span style="color: orange;">?????????</span>
                                {elseif $item->group_status==2}
                                    <span style="color: red;">????????????</span>
                                {elseif $item->group_status==1}
                                    <span style="color: green">?????????</span>
                                {/if}
                            </div> -->
                               <div>
                              {if $item->ptstatus==3}
                                   <span style="color: orange;">????????????</span>
                               {elseif $item->ptstatus==2}
                                   <span style="color: red;">????????????</span>
                               {elseif $item->ptstatus==1}
                                   <span style="color: green">?????????</span>
                               {/if}
                           </div>
                        </td>
                        
                        <td>
                            ???????????????{$item->start_time}
                            <br/>
                            ???????????????{$item->end_time}
                        </td>
                    </tr>
                {/foreach}
                </tbody>
                {else}
                <thead>
                <tr class="text-c tab_tr">
                    <th style="width: 30px"></th>
                    <th style="width:20%;">??????????????????</th>
                    <th style="width:20%;">????????????</th>
                    <th style="">?????????</th>
                    <th style="">????????????</th>
                    <th style="width: 80px;">??????</th>
                    <th style="width:15%;">????????????</th>
                    <th style="width: 30px;">????????????</th>
                    <th style="width: 80px;">??????</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$list item=item}
                    <tr class="text-c tab_td">
                        <td>
                            <input type="checkbox" class="inputC input_agreement_protocol" id="{$item->product_id}" name="id[]" value="{$item->product_id}" data-g_status="{$item->g_status}" style="position: absolute;" onclick="onshelves()"><label for="{$item->product_id}"></label>
                        </td>
                        <td>
                            <div style="text-align: left; margin-left: 10px;">
                                {$item->group_title}
                            </div>
                            <div>
                                {if $item->g_status==1}
                                    <span style="color: orange;">?????????</span>
                                {elseif $item->g_status==2}
                                    <span style="color: green;">?????????</span>
                                {else}
                                    <span style="color: red;">?????????</span>
                                {/if}
                            </div>
                        </td>

                        <td style="display: flex;align-items: center;">
                            <div style="width: 60px;height: 60px;">
                                {if $item->imgurl != ''}
                                    <img onclick="pimg(this)" style="width: 60px;height: 60px;" src="{$item->imgurl}">
                                {else}
                                    <span>????????????</span>
                                {/if}
                            </div>
                            <div title="{$item->product_title}" style="height: 60px; overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 200px;line-height: 60px;text-align: left; margin-left: 10px;">
                                {$item->product_title}
                            </div>
                        </td>
                        <td>
                            {$item->price}???
                        </td>
                        <td>
                            <p style="margin: 0 !important;">{$item->min_man}??????</p>
                            <p style="margin: 0 !important;">{$item->min_price}???</p>
                        </td>
                        <td>{$item->num}</td>
                        <td>{$item->actime}</td>

                        <td style="text-align: center;">
                            {if $item->is_show==0}
                                <span>???</span>
                            {else}
                                <span>???</span>
                            {/if}
                        </td>

                        <td class="tab_editor">
                            <div class="tab_block">
                                <div>
                                    <a href="index.php?module=go_group&action=modify&id={$item->group_id}" title="??????">

                                        <img src="images/icon1/ck.png"/>&nbsp;{if $item->g_status==2&&$item->is_show==1}??????{else}??????{/if}

                                    </a>

                                    {if $item->is_show==0}
                                        <a onclick="aj({$item->group_id},'1')"
                                           href="javascript:void(0);" title="??????">

                                            <img src="images/icon1/xj.png"/>&nbsp;??????

                                        </a>
                                    {else}
                                        <a  onclick="aj({$item->group_id},'0')"
                                            href="javascript:void(0);" title="??????">

                                            <img src="images/icon1/sj_g.png"/>&nbsp;??????

                                        </a>
                                    {/if}
                                </div>
                                <div>
                                    {if $item->g_status==1||$item->g_status==3}
                                        <a onclick="aj1({$item->group_id},'2','{$item->starttime}','{$item->endtime}','{$item->status}')" href="javascript:void(0);" title="??????">

                                            <img src="images/icon1/xj.png"/>&nbsp;??????

                                        </a>
                                    {else}
                                        <a onclick="aj1({$item->group_id},'3','{$item->starttime}','{$item->endtime}','{$item->status}')" href="javascript:void(0);" title="??????">

                                            <img src="images/icon1/sj_g.png"/>&nbsp;??????

                                        </a>
                                    {/if}
                                    {if $item->g_status!=2}
                                        <a title="??????" href="javascript:;" onclick="delgrouppro1(this,{$item->group_id},'index.php?module=go_group&action=member&m=delpro&id=')" class="ml-5" data-g_status="{$item->g_status}">

                                            <img src="images/icon1/del.png"/>&nbsp;??????

                                        </a>
                                    {else}
                                        <button type="button" disabled="true">
                                            <div style="align-items: center;font-size: 12px;display: flex;justify-content: center;">
                                                <img src="images/icon1/del.png"/>&nbsp;??????
                                            </div>
                                        </button>
                                    {/if}
                                </div>
                            </div>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            {/if}
		</table>

	</div>
	<div style="text-align: center;display: flex;justify-content: center;">{$pages_show}</div>
	<div class="page_h20"></div>
</div>
<div class="confirm hide">
    <div>
        <div class="confirm_tips">????????????????????????</div>
        <div class="confirm_btn">
            <button class="confirm_cancel" style="background: #fff;">??????</button>
            <button class="confirm_confirm" style="background: #2890FF;color: #fff;">??????</button>
        </div>
    </div>
</div>
<div class="tc-box">
    <div id="ifm-box">
        <div class="tc-box-close">x</div>
        <iframe id="ifm" scrolling="yes" src="" height="100%" width="100%"></iframe>
    </div>
</div>
<!--_footer ??????????????????????????????-->
<script type="text/javascript" src="style/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="style/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="style/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="style/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer ??????????????????????????????-->
<script type="text/javascript" src="style/js/H-ui.js"></script>
<!--?????????????????????????????????????????????-->
<script type="text/javascript" src="style/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="style/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="style/lib/laypage/1.2/laypage.js"></script>
{literal}
<script type="text/javascript">

var aa=$(".pd-20").height()-32-$(".page_bgcolor").height()-$(".page_t").height();
var bb=$(".table-border").height();

if(aa<bb){
	$(".page_h20").css("display","block")
}else{
	$(".page_h20").css("display","none")
}
function excel(pageto) {
    var pagesize = $("#pagesize").val();
    location.href=location.href+'&pageto='+pageto+'&pagesize='+pagesize;
}

function delgrouppro1(ev,id,url){

    var g_status = $(ev).attr('data-g_status');
    if(g_status == '2'){
        layer.msg('????????????????????????????????????!');
        return false;
    }

    console.log('url=================');
    console.log(url);
    confirm('?????????????????????',id,url,'??????');
}

function empty() {
    $("input[name='username']").val('');
    $("input[name='proname']").val('');
    $("#group_status").val('');
}

  function statusclick(d){
  	$('.status').each(function(i){
      if(d == i){
  		 $(this).addClass('isclick');
  	  }else{
  	  	 $(this).removeClass('isclick');
  	  }
  	})
      
  }


/*????????????*/
function datadel(url,content){
    var checkbox=$("input[name='id[]']:checked");//???????????????????????????
    var Id = '';
    for(var i=0;i<checkbox.length;i++){
      var g_status = checkbox.eq(i).attr('data-g_status');
      if(g_status == '2'){
        layer.msg('????????????????????????????????????!');
        return false;
      }
        Id+=checkbox.eq(i).val()+",";
    }
    if(Id==""){
        layer.msg("??????????????????");
        return false;
    }
    confirm('?????????????????????',Id,url,content)
    
}

function action(ev,id,url) {

}





function aj(id,type){
var text = '';
var type_ = '';
if(type == 1){
    text = '?????????????????????????????????'
    type_ = '??????';
}else{
    text = '?????????????????????????????????'
    type_ = '??????';
}
console.log('type=========');
console.log(type);
    var url = 'index.php?module=go_group&action=member&m=contpro&type='+type+'&id=';
    console.log(url);
    confirm_aj(text,id,url,type_);
return false;
       $.post("index.php?module=go_group&action=member&m=contpro",{'id':id,'type':type},function(res){
           $(".maskNew").remove();

           if(res.status==1){
               layer.msg("???????????????");
               location.replace(location.href);
           }
           else{
               layer.msg("???????????????");
           }

       },"json");

}


//??????????????????????????????
function confirm_aj (content,id,url,content1){
    console.log('url=======1')
    console.log(url)
    $("body").append(`
        <div class="maskNew">
            <div class="maskNewContent" style="padding-top:0px;height: 223px !important;">
                <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                <div class="maskTitle">??????</div>
                <div style="font-size: 16px;text-align: center;padding:60px 0;">
                    ${content}
                </div>
                <div style="text-align:center;">
                    <button class="closeMask" style="margin-right:20px" onclick=closeMask('${id}','${url}','${content1}')>??????</button>
                    <button class="closeMask" onclick=closeMask1() >??????</button>
                </div>
            </div>
        </div>
    `)
}
function confirm (content,id,url,content1){
    $("body").append(`
        <div class="maskNew">
            <div class="maskNewContent" style="padding-top:0px;height: 223px !important;">
                <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                <div class="maskTitle">??????</div>
                <div style="font-size: 16px;text-align: center;padding:60px 0;">
                    ${content}
                </div>
                <div style="text-align:center;">
                    <button class="closeMask" style="margin-right:20px" onclick=closeMask('${id}','${url}','${content1}')>??????</button>
                    <button class="closeMask" onclick=closeMask1() >??????</button>
                </div>
            </div>
        </div>
    `)
}



function aj1(id,type,start,end,status){
	if(type == '2'){
		var startdate = new Date(start).getTime();
        var enddate = new Date(end).getTime();
        var now = new Date().getTime();   
        if(now < startdate || now > enddate){
           layer.msg("??????????????????????????????");
           return false;
        }
        if(status == '1'){
            layer.msg("???????????????????????????!");
            return false;
        }
	}
	var text = '';
	var type_ = '';
    if(type == '2'){
        //??????
        text = '?????????????????????????????????';
        type_ = '??????';
    }else if (type == '3'){
        //??????
        text = '?????????????????????????????????';
        type_ = '??????';
    }
    var url = 'index.php?module=go_group&action=member&m=is_market&type='+type+'&id=';

    confirm_aj(text,id,url,type_);
}


     function closeMaskba(id,url,nums){
        
    $.ajax({
        type:"post",
        url:url+id+'&type='+nums,
        async:true,
        success:function(res){
            $(".maskNew").remove();
            
            res = JSON.parse(res);
            if(res.status=="1"){
                layer.msg("???????????????");
                location.replace(location.href);
            }else{
                layer.msg("???????????????");
            }
        },
    });
}
function closeMask(id, url, content) {
        $.ajax({
            type: "post",
            url: url + id,
            dataType: "json",
            data: {},
            async: true,
            success: function (res) {
                $(".maskNew").remove();
                if (res.status == "1") {
                    layer.msg(content + "??????!");
                    window.location.reload();
                    // let ifs = $(".show_iframe").eq(0).find("iframe")[0].contentWindow.document;
                    // ifs.location.reload();
                      // location.replace(location.href);
                   
                }
                else if (res.status == "2") {
                    layer.msg(res.info);
                      location.replace(location.href);
                }
                else {
                    layer.msg(content + "??????!");
                      location.replace(location.href);
                }
            },
            error: function (err) {
                $(".maskNew").remove();
                layer.msg(err + "??????????????????????????????");
            }

        });
    }
function closeMask1() {
            $(".maskNew").remove();
        }
function onshelves(){
            var checkbox=$("input[name='id[]']:checked");//???????????????????????????
            var check_text=checkbox.parents(".tab_label").siblings(".tan_status");
            if(checkbox.length==0){
                $(".btn_up span").text("????????????")
            }else{
                for(var j=0;j<check_text.length;j++){
                    var ts=check_text.eq(j).text();
                    ts = ts.trim();
                    if(ts=="??????"){
                        $(".btn_up span").text("????????????")
                    }else{
                        $(".btn_up span").text("????????????")
                    }
                    
                }
            }

        }
</script>
    <script>
        $(".btn_sty").click(function () {
            // alert(1);
            $(".btn_sty").removeClass('sel_btn');
            $(this).addClass('sel_btn');
        })

        function canprecord(ptcode) {
            $("#ifm").attr("src","index.php?module=go_group&action=canrecord&ptcode="+ptcode);
            $(".tc-box").show();
        }
        $(".tc-box").click(function () {
            $(".tc-box").hide();
        })
    </script>
{/literal}
</body>
</html>