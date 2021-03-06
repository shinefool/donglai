<?php
/**
 * [Laike System] Copyright (c) 2018 laiketui.com
 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.
 */
require_once(MO_LIB_DIR . '/DBAction.class.php');

class modifyAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();

        // 接收信息
        $id = intval($request->getParameter("id")); // 产品id

        $sql = "select * from lkt_config where id = '1'";
        $r = $db->select($sql);
        $uploadImg = $r[0]->uploadImg; // 图片上传位置
        // 根据产品id，查询产品产品信息
        $sql = "select * from lkt_product_list where id = '$id'";
        $r = $db->select($sql);
         $status=0;
        if($r){
            $product_title = $r[0]->product_title; // 产品标题
            $subtitle = $r[0]->subtitle; // 副标题
            $product_class = $r[0]->product_class ; // 产品类别
            $brand_class = $r[0]->brand_id ; // 产品品牌
            $weight = $r[0]->weight ; // 重量
            $content = $r[0]->content; // 产品内容
            $num = $r[0]->num; //数量
            $imgurl = $r[0]->imgurl; //图片
            $s_type = $r[0]->s_type;
            $volume = $r[0]->volume;//volume拟定销量
            $freight_id = $r[0]->freight;
            $status = $r[0]->status; // 上下架状态
             $initial = $r[0]->initial;//初始值
        }

        $arr = explode(',',$s_type);

        if (!empty($brand_class)) {
            $sql01 = "select brand_id ,brand_name from lkt_brand_class where brand_id = $brand_class";
            $r01 = $db->select($sql01);
            $brand_name = $r01[0]->brand_name ; // 产品品牌
        }

        //运费

        $sql = "select id,name from lkt_freight order by id ";
            $r_freight = $db->select($sql);
            $freight_list = '';
        if($r_freight){
            foreach ($r_freight as $key => $value) {
                $freight_id1 = $value->id ; // 运费规则id
                $freight_name = $value->name ; // 运费规则
               if($freight_id1 ==$freight_id){
                $freight_list .= "<option selected='selected' value='{$freight_id1}'>{$freight_name}</option>";
               }else{
                 $freight_list .= "<option value='{$freight_id1}'>{$freight_name}</option>";
               }
            }
        }

        //绑定产品分类
        $sql = "select cid,pname from lkt_product_class where sid = 0 and recycle = 0";
        $r = $db->select($sql);
        $res = '';
        foreach ($r as $key => $value) {
            $c = '-'.$value->cid.'-';
            //判断所属类别 添加默认标签
            if ($product_class == $c) {
                $res .= '<option selected="selected" value="'.$c.'">'.$value->pname.'</option>';
            }else{
                $res .= '<option  value="'.$c.'">'.$value->pname.'</option>';
            }
            //循环第一层
            $sql_e = "select cid,pname from lkt_product_class where sid = $value->cid and recycle = 0";
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

        // 品牌
        $sql01 = "select brand_id ,brand_name from lkt_brand_class where status = 0 and recycle = 0 ";
        $r01 = $db->select($sql01);
        $brand = '';
        $brand_num = 0;
        if($r01){
            if($brand_class){
                foreach ($r01 as $k01 =>$v01){
                    if($v01->brand_id ==$brand_class ){
                         $brand .= '<option selected value="'.$v01->brand_id.'">'.$v01->brand_name.'</option>';
                     }else{
                         $brand .= '<option  value="'.$v01->brand_id.'">'.$v01->brand_name.'</option>';
                     }               
                }                
            }else{
                foreach ($r01 as $k2 =>$v2){
                    $brand .= '<option  value="'.$v2->brand_id.'">'.$v2->brand_name.'</option>';
                
                }
            }
        }

        

        $imgs_sql = "select * from lkt_product_img where product_id = '$id'";
        $imgurls = $db->select($imgs_sql);

        //查询规格数据
        $size = "select * from lkt_configure where pid = '$id'";
        $res_size = $db->select($size);
  		if ($res_size) {
            $attr_group_list = [];
            $checked_attr_list = [];
            $arrar_t = unserialize($res_size[0]->attribute);
            foreach ($arrar_t as $key => $value) {
                $attr_group_list[] = array('attr_group_name' => $key, 'attr_list' => [], 'attr_all' => []);
            }
            foreach ($res_size as $k => $v) {
                $attribute = unserialize($v->attribute); // 属性
                $attr_lists = [];
                //列出属性名 
                foreach ($attribute as $key => $value) {
                    foreach ($attr_group_list as $keya => $valuea) {
                        if ($key == $valuea['attr_group_name']) {
                            
                            if (!in_array($value, $attr_group_list[$keya]['attr_all'])) {
                                
                                    $attr_list = array('attr_name' => $value,'status' => true);
                                
                                array_push($attr_group_list[$keya]['attr_list'], $attr_list);
                                array_push($attr_group_list[$keya]['attr_all'], $value);
                            }
                        }
                    }
                    $attr_lists[] = array('attr_id' => '', 'attr_group_name' => $key, 'attr_name' => $value);
                }
                $checked_attr_list[] = array('attr_list' => $attr_lists, 'costprice' => $v->costprice, 'yprice' => $v->yprice, 'price' => $v->price, 'num' => $v->num, 'unit' => $v->unit, 'img' => $uploadImg.'/'.$v->img, 'cid' => $v->id);
            }
            foreach ($attr_group_list as $key => $value) {
                $attr_group_list[$key] = $this->array_key_remove($attr_group_list[$key], 'attr_all');
            }
        }
        if($initial != ''){
            $initial = unserialize($initial);
        }else{
            $initial = array();
        }
        $initial = (object)$initial;

        $attr_group_list = json_encode($attr_group_list);
        $checked_attr_list = json_encode($checked_attr_list);
        $request->setAttribute("volume",$volume);
        $request->setAttribute("status", $status);
        $request->setAttribute("uploadImg",$uploadImg);
        $request->setAttribute("checked_attr_list",$checked_attr_list);
        $request->setAttribute("attr_group_list",$attr_group_list);
         $request->setAttribute('initial', isset($initial) ? $initial : '');
        $request->setAttribute('s_type', $arr);  
        $request->setAttribute("ctypes",$res);
        $request->setAttribute('id', $id);
        $request->setAttribute('r02', $brand);//所有品牌
        $request->setAttribute('product_title', isset($product_title) ? $product_title : '');
        $request->setAttribute('subtitle', isset($subtitle) ? $subtitle : '');
        $request->setAttribute('weight', isset($weight) ? $weight : '');
        $request->setAttribute('content', isset($content) ? $content : '');
        $request->setAttribute('num', isset($num) ? $num : '');
        $request->setAttribute('imgurl', isset($imgurl) ? $imgurl : '');
        $request->setAttribute('imgurls', isset($imgurls) ? $imgurls : '');
        $request->setAttribute('freight_list', $freight_list);// 运费
        return View :: INPUT;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        // print_r($request);die;
        $id = intval($request->getParameter("id")); // 产品id
        $uploadImg = $request->getParameter('uploadImg'); // 图片上传位置
        $attr = $request->getParameter('attr'); // 属性
        $product_title = addslashes(trim($request->getParameter('product_title'))); // 产品标题
        $product_class = addslashes(trim($request->getParameter('product_class'))); // 产品类别
        $subtitle = addslashes(trim($request->getParameter('subtitle'))); // 产品副标题
        $brand_id = addslashes(trim($request->getParameter('brand_class'))); // 品牌
        $weight = addslashes(trim($request->getParameter('weight'))); // 关键词
        $s_type = $request->getParameter('s_type'); // 显示类型
        $content = addslashes(trim($request->getParameter('content'))); // 产品内容
        $image = addslashes(trim($request->getParameter('image'))); // 产品图片
        $img_oldpic = addslashes(trim($request->getParameter('img_oldpic'))); // 产品图片
        $initial = $request->getParameter('initial'); // 初始值
        $volume = trim($request->getParameter('volume')); //拟定销量
        $freight = $request->getParameter('freight'); // 运费

        if($product_title == ''){
			header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('产品名称不能为空！');" .
                "location.href='index.php?module=product&action=add';</script>";
            return $this->getDefaultView();
        }else{
            $sql = "select product_title from lkt_product_list where id != '$id' and product_title = '$product_title' and recycle =0";
            $r = $db->select($sql);
            if($r){
				header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('{$product_title} 已经存在，请选用其他标题进行修改！');" .
                    "location.href='index.php?module=product&action=modify';</script>";
                return $this->getDefaultView();
            }
        }

        if($product_class == ''){
			header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('产品类别不能为空！');" .
                "</script>";
            return $this->getDefaultView();
        }
        if($brand_id == ''||$brand_id == 0){
			header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('请选择品牌！');" .
                "</script>";
            return $this->getDefaultView();
        }

        if($weight == ''){
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('请填写商品重量！');" .
                "</script>";
            return $this->getDefaultView();
        }else{
            if(is_numeric($weight)){
                if($weight < 0){
                    header("Content-type:text/html;charset=utf-8");
                    echo "<script type='text/javascript'>" .
                        "alert('重量不能为负数！');" .
                        "</script>";
                    return $this->getDefaultView();
                }
            }else{
                header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('请填写正确的商品重量值！');" .
                    "</script>";
                return $this->getDefaultView();
            }
        }

            if($initial){
            foreach ($initial as $k => $v){
                if($k == 'cbj' && $v == ''){
                     header("Content-type:text/html;charset=utf-8");
                     echo "<script type='text/javascript'>" .
                    "alert('成本价初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
                }else if($k == 'yj' && $v == ''){
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('原价初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
                }else if($k == 'sj' && $v == ''){
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('售价初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
                 
                }else if($k == 'unit' && $v == '0'){
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('单位初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
                  
                }else if($k == 'kucun' && $v == ''){
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('库存初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
               
                }
            }
            $initial = serialize($initial);
        }else{
             header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('初始值不能为空！');" .
                    "</script>";
                return $this->getDefaultView();
        }
        $z_num = 0;
        $attributes = [];
        //处理属性
        if (count($attr ? $attr : []) == 0 || empty($attr)) {
             header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('请填写属性！');" . 
                    "</script>";
                return $this->getDefaultView();
        } else {
            foreach ($attr as $key => $value) {
                $attr_list = $value['attr_list'];
                $attr_list_arr = [];
                $attr_list_srt = '';
                foreach ($attr_list as $k => $v) {
                    $attr_list_arr[$v['attr_group_name']] = $v['attr_name'];
                    $attr_list_srt .= $v['attr_group_name'] . '-' . $v['attr_name'];
                }
                $cid = $value['cid'];
                $z_num += $value['num'];
                if ($value['img'] == '') {
                header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('$attr_list_srt 的属性图片未上传！');" .
                    "</script>";
                return $this->getDefaultView();
                 }
                //价格判断
                foreach ($value as $cvkey => $cvvalue) {
                    if (!is_array($cvvalue)) {
                        if (empty($cvvalue) &&  $cvvalue != 0 && $cvkey != 'cid' && $cvkey != 'num') {
                             header("Content-type:text/html;charset=utf-8");
                            echo "<script type='text/javascript'>" .
                                "alert('请完善属性！');" .
                                "</script>";
                            return $this->getDefaultView();
                    
                        }
                    }
                }

                $costprice = $value['costprice'];
                $price = $value['price'];
                if ($costprice > $price) {
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('成本价不能大于售价！');" .
                    "</script>";
                return $this->getDefaultView();
                }

                $value['img'] = preg_replace('/.*\//', '', $value['img']);
                $value['attribute'] = serialize($attr_list_arr);
                $value = $this->array_key_remove($value, 'attr_list');
                $attributes[] = $value;
           }
        }
        $db->begin();
        if(count($s_type) == 0){
            $type = 0;
        }else{
            $type = implode(",", $s_type);
        }
        if($image){
            $image = preg_replace('/.*\//','',$image);
            if($image != $img_oldpic){
                @unlink ($uploadImg.$img_oldpic);
            }
        }else{
            $image = $img_oldpic;
        }

        //五张轮播图
        $files=($_FILES['imgurls']['tmp_name']);

        if($files[0]){
            $ql_img = "delete from lkt_product_img  where product_id = '$id'";
            $r = $db->delete($ql_img);
            foreach($files as $key => $file){
                // 移动到框架应用对应目录下
                //重命名
                $img_type = $_FILES['imgurls']["type"][$key];
                if($img_type == "image/png"){
                    $img_type = ".png";
                }elseif ($img_type == "image/jpeg") {
                    $img_type = ".jpg";
                }else{
                    $img_type = ".gif";
                }
                $imgsURL_name = time().mt_rand(1,100).$img_type;
                //重命名结束
                $info = move_uploaded_file($file,"../LKT/images/$imgsURL_name");
                if($info){
                    //循环遍历插入
                    $sql_img = "insert into lkt_product_img(product_url,product_id,add_date) " . "values('$imgsURL_name','$id',CURRENT_TIMESTAMP)";
                    $r = $db->insert($sql_img);
                }
            }
        }
        // 根据产品id，查询原来的数据
        $sql = "select * from lkt_product_list where id = '$id'";
        $r_arr = $db->select($sql);
        // 根据产品id,修改产品信息
        $sql_1 = "update lkt_product_list set product_title='$product_title',product_class='$product_class',brand_id ='$brand_id',weight='$weight',s_type='$type',num='$z_num',content='$content',imgurl='$image',subtitle='$subtitle',volume='$volume',freight='$freight',initial='$initial' where id = '$id'";
        $r_update = $db->update($sql_1);

        if($r_update == -1 ){
            $rew1 = 0; // 修改失败
        }else{
            $rew1 = 1; // 修改成功
        }

        $cids = [];
        if ($attributes) {
            $sql = "select id from lkt_configure where pid = '$id'";
            $rcs = $db->select($sql);
            if ($rcs) {
                foreach ($rcs as $keyc => $valuec) {
                    $cids[$valuec->id] = $valuec->id;
                }
            }
        }

        foreach ($attributes as $ke => $va) {
            $num = $va['num'];
            $cid = $va['cid'];
           
            // $va['total_num'] =0;
            // $va['ctime'] = date('Y-m-d H:m:s',time());
            $va = $this->array_key_remove($va, 'cid');

            if ($cid) {
                if (array_key_exists($cid, $cids)) {
                    unset($cids[$cid]);
                }
                // 查询剩余数量
                $ccc = $db->select("select num,total_num from lkt_configure where id = '$cid' ");
                $cnums = $ccc ? $ccc[0]->num : 0;
                $va['total_num'] = $ccc ? $ccc[0]->total_num : 0;
                $z_num1 =0;
                if($num > $cnums){
                        $z_num1 = $num - $cnums; // 传过来的剩余数量 - 数据库里的剩余数量
                        // 在库存记录表里，添加一条入库信息
                    $sql = "insert into lkt_stock(product_id,attribute_id,flowing_num,type,add_date) values('$id','$cid','$z_num1',0,CURRENT_TIMESTAMP)";
                    $db->insert($sql);
                    $va['total_num'] = $va['total_num']+$z_num1;
                }else if($num < $cnums){
                    $z_num1 =$cnums- $num ;
                      // 在库存记录表里，添加一条入库信息
                    $sql = "insert into lkt_stock(product_id,attribute_id,flowing_num,type,add_date) values('$id','$cid','$z_num1',1,CURRENT_TIMESTAMP)";
                    $db->insert($sql);
                    $va['total_num'] = $va['total_num'];
                }else{
                    $va['total_num'] = $va['total_num'];
                }
// print_r($va);
                
                $r_attribute = $db->modify($va, 'lkt_configure', " `id` = '$cid' and recycle = 0 ");
                $attribute_id = $cid;


                if ($r_attribute < 0) {
                    $r_attribute = $db->modify($va, 'lkt_configure', " `id` = '$cid'", 1);
                    $db->rollback();
                    header("Content-type:text/html;charset=utf-8");
                    echo "<script type='text/javascript'>" .
                    "alert('属性数据修改失败，请稍后再试！');" .
                    "</script>";
                return $this->getDefaultView();
                }
            } else {
                $va['pid'] = $id;
                $va['total_num'] = $num;
                $r_attribute = $db->insert_array($va, 'lkt_configure', '', 1);

                $attribute_id = $r_attribute;
                if ($r_attribute < 0) {
                    $db->rollback();
                     header("Content-type:text/html;charset=utf-8");
                echo "<script type='text/javascript'>" .
                    "alert('属性数据添加失败，请稍后再试！');" .
                    "</script>";
                return $this->getDefaultView();
                   
                }else{
                    $db->commit();
                    $sql = "insert into lkt_stock(product_id,attribute_id,flowing_num,type,add_date) values('$id','$r_attribute','$num',0,CURRENT_TIMESTAMP)";
                    $db->insert($sql);
                }
            }
            
        }
        //删除属性
        if (!empty($cids)) {
            foreach ($cids as $keyds => $valueds) {
                $db->delete("DELETE FROM `lkt_configure` WHERE (`id`='$valueds')");
            }
        }

       

        if($rew1 == 1){
            $db->commit();
            if($z_num < 1){
                $sql_1 = "update lkt_product_list set status='1' where id = '$id'";
            }else{
                $rr=$db->select("select status  from lkt_product_list where id = '$id'");
                $status =$rr[0]->status?$rr[0]->status:0;
                if($status == 2){
                     $sql_1 = "update lkt_product_list set status='2' where id = '$id'";
                }else{
                     $sql_1 = "update lkt_product_list set status='0' where id = '$id'";
                }
               
            }
            $r_update = $db->update($sql_1);
            header("Content-type:text/html;charset=utf-8");
            echo "<script type='text/javascript'>" .
                "alert('产品修改成功！');" .
                "location.href='index.php?module=product';</script>";
        }else{
            $db->rollback();
            foreach ($r_arr[0] as $k_arr => $v_arr){
                $sql = "update lkt_product_list set product_title='$v_arr->product_title',product_class='$v_arr->product_class',brand_id ='$v_arr->brand_id',s_type='$v_arr->s_type',num='$v_arr->z_num',sort='$v_arr->sort',content='$v_arr->content',imgurl='$v_arr->image',initial='$v_arr->initial' where id = '$id'";
            }
            $r_y = $db->update($sql);
            echo "<script type='text/javascript'>" .
                "alert('未知原因，产品修改失败！');" .
                "location.href='index.php?module=product';</script>";
            return $this->getDefaultView();
        }
        return;
    }
    public static function array_key_remove($arr, $key)
    {
        if (!array_key_exists($key, $arr)) {
            return $arr;
        }
        $keys = array_keys($arr);
        $index = array_search($key, $keys);
        if ($index !== FALSE) {
            array_splice($arr, $index, 1);
        }
        return $arr;
    }
    public function getRequestMethods(){
        return Request :: POST;
    }
}
?>
