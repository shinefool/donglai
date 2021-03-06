<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/ServerPath.class.php');

class modifyAction extends Action {
    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $id = addslashes(trim($request->getParameter('id'))); // 商品id
        // $store_id = $this->getContext()->getStorage()->read('store_id'); // 商城id
        $product_class = $request->getParameter('cid'); // 分类名称
        $type = addslashes(trim($request->getParameter('type'))); // 用户id
          $img = $this->img($db);

            $sql = "select b.*,c.price,c.num,c.attribute,p.product_title 
                    from lkt_group_product as b 
                    left join lkt_configure as c on b.attr_id=c.id 
                    left join lkt_product_list as p on b.product_id=p.id 
                    where b.group_id=$id group by group_id";
                    // print_r($sql);die;
            $res = $db -> select($sql);
            
        $msg = $res[0];
        $pid = $msg->product_id;
            $group_data = unserialize($msg -> group_data);

            if($group_data->endtime =='changqi'){
                  $dt=$group_data -> starttime;
                    $dt=date('Y-m-d H:i:s',strtotime("$dt+1year"));
                    
                    $group_data -> endtime = $dt;
            }
            // print_r($group_data);die;
            $group_level = unserialize($msg -> group_level);

        $g_status = $msg -> g_status;
            $is_show = $msg -> is_show;
            $firstkey = array_keys($group_level)[0];
            $lastset = reset($group_level);
            $lastset = explode('~',$lastset);
            $lastset[] = $firstkey;
            unset($group_level[$firstkey]);

            $levelstr = '';
            if(count($group_level) > 0){
                foreach ($group_level as $k => $v) {
                    $num = $k;
                    $price = explode('~',$v);
                    if($g_status == 2 && $is_show == 1){
                               $levelstr .= '
<div class="manlevel">
<input type="number" max="50" min="1" class="input-text ct-rs" value="'.$num.'" name="min_man" style="width:60px;" onkeyup="onkeyup1(this)" disabled >&nbsp;&nbsp;人团&nbsp;&nbsp;<span style="margin-left:17px;">折扣价: 参团</span>
<input type="number" class="input-text" value="'.$price[0].'"  name="canprice" style="width:80px;margin-left:5px;" onkeyup="onkeyup1(this)" disabled >&nbsp;%<span style="margin-left: 5px;">开团</span>
<input type="number" class="input-text" value="'.$price[1].'"  name="memberprice" style="width:80px;margin-left:5px;" onkeyup="onkeyup1(this)" disabled >&nbsp;%<input class="btn btn-primary radius" type="button" onclick="removepro(event)" value="删除" style="margin-left:10px;height: 36px!important;" disabled>
</div>';
                    }else{
                               $levelstr .= '
<div class="manlevel">
<input type="number" max="50" min="1" class="input-text ct-rs" value="'.$num.'" name="min_man" style="width:60px;" onkeyup="onkeyup1(this)">&nbsp;&nbsp;人团&nbsp;&nbsp;<span style="margin-left:17px;">折扣价: 参团</span>
<input type="number" class="input-text" value="'.$price[0].'"  name="canprice" style="width:80px;margin-left:5px;" onkeyup="onkeyup1(this)">&nbsp;%<span style="margin-left: 5px;">开团</span>
<input type="number" class="input-text" value="'.$price[1].'"  name="memberprice" style="width:80px;margin-left:5px;" onkeyup="onkeyup1(this)">&nbsp;%<input class="btn btn-primary radius" type="button" onclick="removepro(event)" value="删除" style="margin-left:10px;height: 36px!important;">
</div>';
                    }
             
                }
            }
        $prosql = "select a.num,a.attribute,a.price,a.id as attr_id,b.id,b.product_title,b.imgurl
        from lkt_configure as a 
        left join lkt_product_list as b on a.pid = b.id 
        where b.recycle = 0 and b.num >0 and a.num > 0 and b.id = $pid";
        // print_r($prosql);die;
        $proattr = $db -> select($prosql);
        if(!empty($proattr)){
            foreach ($proattr as $k => $v) {
                $attrtype1 = unserialize($v -> attribute);
                $attrtype1 = array_values($attrtype1);
                // print_r($attrtype1);die;
                $attrtype1 = implode(' ', $attrtype1);

                $proattr[$k] -> attrtype = $attrtype1;
                $proattr[$k]->imgurl = $img.$v->imgurl;
                //查询是否有这个属性
                $sel_hava_attr_sql = "select * from lkt_group_product where  attr_id = $v->attr_id";
                $sel_hava_attr_res = $db->select($sel_hava_attr_sql);
                if($sel_hava_attr_res){
                    $proattr[$k]->select = true;
                }else{
                    $proattr[$k]->select = false;
                }
            }
        }


        $sql01 = "select cid,pname from lkt_product_class where sid = 0 and recycle = 0";
      $rr = $db->select($sql01);
      $res_ = '';
      foreach ($rr as $key => $value) {
        $c = '-'.$value->cid.'-';
        //判断所属类别 添加默认标签
        if ($product_class == $c) {
          $res_ .= '<option selected="selected" value="'.$c.'">'.$value->pname.'</option>';
        }else{
          $res_ .= '<option  value="'.$c.'">'.$value->pname.'</option>';
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
              $res_ .= '<option selected="selected" value="'.$cone.'">'.$hx.$ve->pname.'</option>';
            }else{
              $res_ .= '<option  value="'.$cone.'">'.$hx.$ve->pname.'</option>';
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
                  $res_ .= '<option selected="selected" value="'.$ctow.'">'.$hxe.$v->pname.'</option>';
                }else{
                  $res_ .= '<option  value="'.$ctow.'">'.$hxe.$v->pname.'</option>';
                }
              }
            }
          }
        }
      }
// print_r($proattr);die;
        $brandsql ="select brand_id,brand_name from lkt_brand_class where  recycle = 0";
        $brandres = $db -> select($brandsql);
            $request->setAttribute("brandres", $brandres);
            $request->setAttribute("class", $res_);
            $request->setAttribute("group_data",$group_data);
            $request->setAttribute("g_status",$g_status);
            $request->setAttribute("is_show",$is_show);
            $request->setAttribute("list",$res);
            $request->setAttribute("proattr",$proattr);
            $request->setAttribute("lastset",$lastset);
            $request->setAttribute("levelstr",$levelstr);
            $request->setAttribute("goods_id",$id);
            return View :: INPUT;

    }

    public function execute() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        // 接收信息
        // $store_id = $this->getContext()->getStorage()->read('store_id');
        $gdata = json_decode($request->getParameter('gdata'));
        $goods_id = $request->getParameter('goods_id');
        $glevel = $request->getParameter('glevel');
        $old_goods_id = $request->getParameter('old_goods_id');
        $g_status = $request->getParameter('g_status');
        $group_title = $request->getParameter('group_title');
        $tuanZ = json_decode($request->getParameter('tuanZ'));
        if($gdata -> endtime == ''){
            $gdata -> endtime = date('Y-m-d H:i:s',strtotime("+1years"));
        }
        if($group_title == ''){
            $goods_sql = "select product_title from lkt_product_list where id=$goods_id";
            $goods_res = $db->select($goods_sql);
            $group_title = $goods_res[0]->product_title;
        }
        if($g_status == 3) $g_status = 1;
        $gdata = serialize($gdata);
        $glevel = serialize($glevel);

        $time = date('Y-m-d H:i:s');
        $db -> begin();

        $delsql = "delete from lkt_group_product where group_id=$old_goods_id ";
        $delres = $db -> delete($delsql);

        $str = '';
        $code = true;
        $nu = $db->select("select max(group_id) as a from lkt_group_product ");
        if($nu){
            $group_id=$nu[0]->a+1;
        }else{
            $group_id=1;
        }
        if($delres > 0){
            $str = 'insert into lkt_group_product(attr_id,product_id,group_level,group_data,group_title,group_id) values';
            foreach ($tuanZ as $k => $v) {
                $str .= "($k,$goods_id,'$glevel','$gdata','$group_title','$group_id'),";
            }
            // print_r($str);die;
            $str = substr($str, 0,strlen($str)-1);
            $respro = $db->insert($str);

            if($respro < 0){
                $db -> rollback();
                echo json_encode(array('code' => 0));exit;
            }else{
                $db -> commit();
                echo json_encode(array('code' => 1));exit;
            }
        }else{
            $db -> rollback();
            $code = false;
        }

        if($code){
            $db -> commit();
            echo json_encode(array('code' => 1));exit;
        }else{

            echo json_encode(array('code' => 0));exit;
        }
        
        
    }

    public function getRequestMethods(){
        return Request :: POST;
    }
 public function img($db){
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
        return $img ;
    }
}

?>