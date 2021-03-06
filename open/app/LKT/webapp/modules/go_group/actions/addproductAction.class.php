<?php

/**
 * [Laike System] Copyright (c) 2018 laiketui.com
 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.
 */

require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ServerPath.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

class addproductAction extends Action
{


    public function getDefaultView()
    {

      $db = DBAction::getInstance();

      $request = $this->getContext()->getRequest();
      $product_class = $request->getParameter('cid'); // 分类名称
      $product_title = $request->getParameter('pro_name'); // 标题
      $brand_id = $request->getParameter('brand'); // 标题
        $m = $request->getParameter('m');
        // print_r($m);die;
        if($m != ''){
            $this->$m();
            exit;
        }
              // 导出
        $pagesize = $request->getParameter('pagesize');
        $pagesize = $pagesize ? $pagesize : 10;
        // 每页显示多少条数据
        $page = $request->getParameter('page');

        // 页码
        if ($page) {
            $start = ($page - 1) * $pagesize;
        } else {
            $start = 0;
        }

      $sql01 = "select cid,pname from lkt_product_class where sid = 0 and recycle = 0";
      $rr = $db->select($sql01);
      $res = '';
      foreach ($rr as $key => $value) {
        $c = '-'.$value->cid.'-';
        //判断所属类别 添加默认标签
        if ($product_class == $c) {
          $res .= '<option selected="selected" value="'.$c.'">'.$value->pname.'</option>';
        }else{
          $res .= '<option  value="'.$c.'">'.$value->pname.'</option>';
        }
        //循环第一层
        $sql_e = "select cid,pname from lkt_product_class where sid = $value->cid and recycle = 0 ";
        $r_e = $db->select($sql_e);
        if($r_e){
          $hx = '-----';
          foreach ($r_e as $ke => $ve){
            $cone = $c . $ve->cid.'-';
            //判断所属类别 添加默认标签
            if ($product_class == $cone) {
              $res .= '<option selected="selected" value="'.$cone.'">'.$hx.$ve->pname.'</option>';
            }else{
              $res .= '<option  value="'.$cone.'">'.$hx.$ve->pname.'</option>';
            }
            //循环第二层
            $sql_t = "select cid,pname from lkt_product_class where sid = $ve->cid and recycle = 0";
            $r_t = $db->select($sql_t);
            if($r_t){
              $hxe = $hx.'-----';
              foreach ($r_t as $k => $v){
                $ctow = $cone . $v->cid.'-';
                //判断所属类别 添加默认标签
                if ($product_class == $ctow) {
                  $res .= '<option selected="selected" value="'.$ctow.'">'.$hxe.$v->pname.'</option>';
                }else{
                  $res .= '<option  value="'.$ctow.'">'.$hxe.$v->pname.'</option>';
                }
              }
            }
          }
        }
      }
      $arr =[];
      $condition = ' 1=1 ';
      if($product_class != ''){   
        $condition .= " and a.product_class like '%$product_class%' ";
      }
      
      if($product_title != ''){
        $condition .= " and a.product_title like '%$product_title%' ";
      }
      $sql = "select  a.id,a.product_title,a.imgurl,product_class,a.num from lkt_product_list as a where $condition and recycle =0 order by status asc,a.add_date desc,a.sort desc limit $start,$pagesize ";
      $r = $db->select($sql);
      // print_r($sql);die;
      $list = [];
      $status_num = 0;
      foreach ($r as $key => $value) {
        $pid =  $value -> id;
        $class =  $value -> product_class;
        // $num =  $value -> num;
        $typestr=trim($class,'-');
        $typeArr=explode('-',$typestr);
        //  取数组最后一个元素 并查询分类名称
        $cid = end($typeArr);
        $sql_p = "select pname from lkt_product_class where cid ='".$cid."' and recycle = 0";
        $r_p = $db->select($sql_p);
        if($r_p){
          $pname = $r_p['0']->pname;
        }else{
          $pname = '顶级';
        }

        foreach ($value as $k => $v) {
          $arr[$k] = $v;
        }
        $arr['pname'] = $pname;

        $list[$key] = (object)$arr;
      }

            // 查询系统参数

        $sql1 = "select * from lkt_config where id = 1";

        $r_1 = $db->select($sql1);

        $uploadImg_domain = $r_1[0]->uploadImg_domain; // 图片上传域名

        $uploadImg = $r_1[0]->uploadImg; // 图片上传位置

        if(strpos($uploadImg,'../') === false){ // 判断字符串是否存在 ../

            $img = $uploadImg_domain . $uploadImg; // 图片路径

        }else{ // 不存在

            $img = $uploadImg_domain . substr($uploadImg,2); // 图片路径

        }
            foreach ($list as $ke => $ve) {
               $list[$ke] -> image = $img.$ve -> imgurl;
            }

        $countsql = "select  a.id,a.product_title,a.imgurl,product_class,a.num from lkt_product_list as a where $condition and recycle =0" . ' order by status asc,a.add_date desc,a.sort desc ';
        $count = $db -> select($countsql);
         if($count){
            $total = count($count);
        }else{
            $total = 0;
        }
        
        $pager = new ShowPager($total, $pagesize, $page);
        $url = "index.php?module=go_group&action=addproduct&cid=" . urlencode($product_class) . "&product_title=" . urlencode($product_title) . "&pagesize=" . urlencode($pagesize);
        $pages_show = $pager->multipage($url, $total, $page, $pagesize, $start, $para = '');
        $brandsql = "select brand_id,brand_name from lkt_brand_class where  recycle = 0";
        $brandres = $db -> select($brandsql);

         $sql01 = "select a.num,a.attribute,a.price,a.id as attr_id,b.id,b.product_title,b.imgurl
                from lkt_configure as a 
                left join lkt_product_list as b on a.pid = b.id 
                where b.recycle = 0 and b.num >0 and a.num > 0 and b.status = 0 group by a.pid ";
        $res01 = $db->select($sql01);
        foreach($res01 as $k =>$vee){

            $vee->imgurl = $img.$vee->imgurl;
            $attr = unserialize($vee->attribute);
            $attr = array_values($attr);
            if($attr){
                if (gettype($attr[0]) != 'string') unset($attr[0]);
            }
            $vee->attr = implode(',',$attr);
        }
          // print_r($res01);die;
        $request->setAttribute("class", $res);
        $request->setAttribute("arr", $list);
        $request->setAttribute("proattr", $res01);
        $request->setAttribute("title", $product_title);
        $request->setAttribute("brand_id", $brand_id);
        $request->setAttribute("pages_show", $pages_show);
        $request->setAttribute("brandres", $brandres);
        return View :: INPUT;

    }

        //查询出拼团商品
        public function pro_query(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        // $store_id = $this->getContext()->getStorage()->read('store_id');
        $my_class = addslashes(trim($request->getParameter('my_class')));
        $my_brand = addslashes(trim($request->getParameter('my_brand')));
        $pro_name = addslashes(trim($request->getParameter('pro_name')));


        $condition = ' and b.recycle = 0 ';
        if($my_class){
            $condition .= " and b.product_class like '%{$my_class}%' ";
        }
        if($my_brand){
            $condition .= " and b.brand_id = '$my_brand' ";
        }
        if($pro_name){
            $condition .= " and b.product_title like '%{$pro_name}%' ";
        }
        $sql = "select a.num,a.attribute,a.price,a.id as attr_id,b.id,b.product_title,b.imgurl
                from lkt_configure as a 
                left join lkt_product_list as b on a.pid = b.id 
                where b.recycle = 0 and b.num >0 and a.num > 0 and b.status = 0 ".$condition."group by a.pid ";
        $res = $db->select($sql);

     // 查询系统参数

        $sql1 = "select * from lkt_config where id = 1";

        $r_1 = $db->select($sql1);

        $uploadImg_domain = $r_1[0]->uploadImg_domain; // 图片上传域名

        $uploadImg = $r_1[0]->uploadImg; // 图片上传位置

        if(strpos($uploadImg,'../') === false){ // 判断字符串是否存在 ../

            $img = $uploadImg_domain . $uploadImg; // 图片路径

        }else{ // 不存在

            $img = $uploadImg_domain . substr($uploadImg,2); // 图片路径

        }
        foreach($res as $k =>$v){
            $v->image = $img.$v->imgurl;
            $attr = unserialize($v->attribute);
            $attr = array_values($attr);
            if($attr){
                if (gettype($attr[0]) != 'string') unset($attr[0]);
            }
            $v->attr = implode(',',$attr);
        }
// print_r($res);die;
        echo json_encode(array('res'=>$res));exit;

    }

    public function execute()
    {

        $db = DBAction::getInstance();

        $request = $this->getContext()->getRequest();
        var_dump($request);exit;
    }


    public function getRequestMethods()
    {

        return Request :: NONE;

    }


}


?>