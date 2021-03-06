<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
     .status{
     	width: 80px;
     	height: 40px;
     	line-height: 40px;
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
     	background-color: #2890FF;
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
            float: left;
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
  </style>
{/literal}
<title>??????????????????</title>
</head>
<body>
<nav class="breadcrumb"><span class="c-gray en"></span><i class="Hui-iconfont">&#xe67f;</i> ????????????
	<span class="c-gray en">&gt;</span>??????
	
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="??????" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container pd-20 page_absolute">		
	<div style="margin-top:10px;display: flex;flex-direction: row;">
		<div class="status qh {if $status == 0}isclick{/if}"><a href="index.php?module=go_group&action=index&status=0" onclick="statusclick(0)">??????</a></div>
		<div class="status qh {if $status == 1}isclick{/if}"><a href="index.php?module=go_group&action=index&status=1" onclick="statusclick(1)">?????????</a></div>
		<div class="status qh {if $status == 2}isclick{/if}"><a href="index.php?module=go_group&action=index&status=2" onclick="statusclick(2)">?????????</a></div>
		<div class="status qh {if $status == 3}isclick{/if}"><a href="index.php?module=go_group&action=index&status=3" onclick="statusclick(3)">?????????</a></div>
		<div class="status qh {if $status == 4}isclick{/if}"><a href="index.php?module=go_group&action=kaituan&status=4" onclick="statusclick(4)">????????????</a></div>
		<div class="status qh {if $status == 5}isclick{/if}"><a href="index.php?module=go_group&action=cantuan&status=5" onclick="statusclick(5)">????????????</a></div>
	</div>
	<div class="text-c" >
        <form name="form1" action="index.php" method="get">
	        <input type="hidden" name="module" value="go_group" />
	        <input type="hidden" name="action" value="kaituan" />
	        <input type="hidden" name="pagesize" value="{$pagesize}" id="pagesize" />
            <input type="hidden" name="status" value="{$status}" id="status" />
			<input type="text" name="product_title" size='8' value="{$product_title}" id="product_title" placeholder="?????????????????????" autocomplete="off" style="width:200px" class="input-text">
			<input type="text" name="user" size='8' value="{$user}" id="user" placeholder="?????????????????????" autocomplete="off" style="width:200px" class="input-text">
	        <input name="" id="btn9" class="btn btn-success" type="submit" value="??????">
	        <input type="button" value="??? ???" id="btn8" style="border: 1px solid #D5DBE8; color: #6a7076;" class="reset" onclick="resetButton()"  />
		</form>
    </div>
	<div class="mt-20">
		<table class="table-border tab_content">

                <thead>
                <tr class="text-c tab_tr">
                 
                    <th style="width:15%;">????????????</th>
                    <th style="width:8%;">????????????</th>
                    <th>?????????</th>
                    <th>????????????</th>
                    <th>????????????</th>
                    <th>??????????????????</th>
                    <th style="width: 80px;">??????????????????</th>
                    <th style="width: 80px;">????????????</th>
                    <th style="width: 80px;">??????</th>
                    <th style="width: 80px;">??????????????????</th>
                    <th style="width: 150px;">??????</th>
                </tr>
                </thead>
             
                {foreach from=$list item=item}
                        <tr class="text-c tab_td">
                        
                        <td>{$item->product_title}</td>
                        <td>{$item->user_name}</td>
                        <td>{$item->price} ???</td>
                        <td>{$item->member_price} ???</td>
                        <td>{$item->group_price} ???</td>
                        <td>{$item->addtime}</td>
                        <td>
                            {$item->endtime}
                        </td>
                        <td>
                            {$item->ptnumber}
                        </td>
                        <td>
                            {if $item->ptstatus==1}
                                <span style="color: orange;">?????????</span>
                            {elseif $item->ptstatus==3}
                                <span style="color: red;">????????????</span>
                            {elseif $item->ptstatus==2}
                                <span style="color: green">??????</span>
                            {/if}
                        </td>
                        <td style="text-align: center;">
                            {$item->add_time}
                        </td>

                        <td class="tab_editor">
                                <a href="#" onclick="canprecord('{$item->ptcode}')" style="width: 80%;">??????????????????</a>
                        </td>
                    </tr>
                {/foreach}
     
		</table>
	</div>
      <div style="text-align: center;display: flex;justify-content: flex-end;">{$pages_show}</div>
	<div class="page_h20"></div>
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

// $('#btn5')[0].addEventListener('change',function(){
//    if(this.value == 'up'){
//       dataUp('index.php?module=go_group&action=member&m=allpro&type=up&id=','??????');
//    }else if(this.value == 'down'){
//       dataDown('index.php?module=go_group&action=member&m=allpro&type=down&id=','??????');
//    }
// })

function empty() {

    $("input[name='username']").val('');
    $("input[name='proname']").val('');
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
function resetButton(){
    $("#product_title").val("");
    $("#user").val("");
}
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