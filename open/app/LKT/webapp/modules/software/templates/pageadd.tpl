

<!DOCTYPE HTML>

<html>

<head>

<meta charset="utf-8">

<meta name="renderer" content="webkit|ie-comp|ie-stand">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />

<meta http-equiv="Cache-Control" content="no-siteapp" />



<link href="style/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />

<link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />

<link href="style/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />



<link href="style/kjfs/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="style/kjfs/css/style.css" rel="stylesheet" type="text/css" />

{literal}

<style type="text/css">

.pd-20 {

    padding: 20px;

}

.form-horizontal .row {

    display: table;

    width: 100%;

}

.form .row {

    margin-top: 15px;

}

.form-horizontal .form-label {

    margin-top: 3px;

    cursor: text;

    text-align: right;

    padding-right: 10px;

}

@media (min-width: 768px)

.col-sm-2 {

    width: 16.66666667%;

}

@media (min-width: 768px)

.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {

    float: left;

}

.col-xs-4 {

    width: 20%;

}

.c-red, .c-red a, a.c-red {

    color: red;

}

.form-horizontal .formControls {

    padding-right: 10px;

}

@media (min-width: 768px)

.col-sm-8 {

    width: 66.66666667%;

}

@media (min-width: 768px)

.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {

    float: left;

}

.col-xs-8 {

    width: 66.66666667%;

}

.form-horizontal .row {

    display: table;

    width: 100%;

}

.form .row {

    margin-top: 15px;

}

.row {

    margin-right: -15px;

    margin-left: -15px;

}

.row {

    box-sizing: border-box;

}

.cl, .clearfix {

    zoom: 1;

    margin-top: 15px;

}

.form-horizontal .row {

    display: table;


    margin-left: 10%;

}

.col-lg-3{

    float: right;

}

</style>

{/literal}

<title>????????????</title>

</head>

<body>

<nav class="breadcrumb" style="    line-height: 3;">
<i class="Hui-iconfont">&#xe646;</i> 
????????????????????? <span class="c-gray en">&gt;</span> ?????? <span class="c-gray en">&gt;</span> ???????????? <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px;float: right;" href="#" onclick="location.href='index.php?module=software&action=pageindex';" title="??????" ><i class="Hui-iconfont">&#xe6a6;</i></a></nav>

<div class="pd-20" style=" margin-top: 100px;">

    <form name="form1" action="" class="form form-horizontal" method="post" enctype="multipart/form-data" >

      <input type="hidden" name="uploadImg" value="{$uploadImg}" >

      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-4"><span class="c-red">*</span>?????????</label>
        <div class="formControls col-xs-8 col-sm-6">
          <input  name="type"  value="??????" disabled>
        </div>
      </div>
      <div class="row cl">
          <label class="form-label col-xs-4 col-sm-4"><span class="c-red">*</span>???????????????</label>
         <select name="product_class" class="select" style="margin-left: 14px;width: 158px;">
                  {foreach from=$list item=item name=f1}
                    <option value="{$item->cid}">{$item->str}{$item->pname}</option>
                   {/foreach}
          </select>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-4">????????????</label>
        <div class="formControls col-xs-8 col-sm-6">
             <input type="text" class="input-text" value="{$sort}" placeholder="" id="" name="sort">
        </div>
      </div>
        <div class="row cl">
          <label class="form-label col-xs-4 col-sm-4"></label>
          <div class="formControls col-xs-8 col-sm-6">
            <button class="btn btn-primary radius" type="submit" name="Submit"><i class="Hui-iconfont">&#xe632;</i> ??? ???</button>
            <button class="btn btn-secondary radius" type="reset" name="reset"><i class="Hui-iconfont">&#xe632;</i> ??? ???</button>
          </div>
        </div>
    </form>
</div>



<div class="row cl">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin: 100px auto; width: 1000px;">
<div class="ibox float-e-margins" style="width: 500px;height:100px; margin:0 auto;">
  <h5>????????????</h5>
 1. ???????????????????????????????????????????????????</br>
 2. ????????????????????????????????????????????????????????????????????????</br>
 3. ??????????????????????????????????????????????????????????????????????????????????????????</br>
 4. ???????????????????????????????????????????????????????????????????????????????????????????????????</br>
 5. ???????????????????????????????????????????????????
</div>
</div>
</div>

<script type="text/javascript" src="modpub/js/check.js" > </script>

<script type="text/javascript" src="style/js/jquery.js"></script>



<!-- ??????????????????????????? -->

<link rel="stylesheet" href="style/kindeditor/themes/default/default.css" />

<script src="style/kindeditor/kindeditor-min.js"></script>

<script src="style/kindeditor/lang/zh_CN.js"></script>

<script src="style/kjfs/js/jquery.min.js"></script>

<script src="style/kjfs/js/bootstrap.min.js"></script>

<script src="style/kjfs/js/index.js"></script>



{literal}

<script>

KindEditor.ready(function(K) {

  var editor = K.editor({

      allowFileManager : true,       

      uploadJson : "index.php?module=system&action=uploadImg", //????????????

      fileManagerJson : 'kindeditor/php/file_manager_json.php', //????????????

    });

  //??????????????????

  K('#image').click(function() {

    editor.loadPlugin('image', function() {

      editor.plugin.imageDialog({

        imageUrl : K('#picurl').val(),

          clickFn : function(url, title, width, height, border, align) {

          K('#picurl').val(url);

          $('#thumb_url').attr("src",url);

          editor.hideDialog();

        }

      });

    });

  });

});

//????????????

$(".select_link").click( function () { 

  $(this).hide(); 

});


</script>

{/literal}

</body>

</html>