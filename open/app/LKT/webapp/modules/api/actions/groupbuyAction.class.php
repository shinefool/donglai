<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');
require_once(MO_LIB_DIR . '/Timer.class.php');

class groupbuyAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();

        $request = $this->getContext()->getRequest();

        $sql = 'select m.*,l.product_title as pro_name from (select min(p.attr_id) as attr_id,product_id,p.group_price,p.group_id,c.img,c.price as market_price from lkt_group_product as p left join lkt_configure as c where p.group_id=(select status from lkt_group_buy where is_show=1) group by p.product_id limit 8) as m left join lkt_product_list as l on m.product_id=l.id';
        // print_r($sql);die;
        $res = $db -> select($sql);
        
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
         
         $sqltime = 'select man_num,endtime,status from lkt_group_buy where is_show=1';
         $restime = $db -> select($sqltime);
         if(!empty($restime)){
            $endtime = date('Y-m-d H:i:s',$restime[0] -> endtime);
            $g_man = $restime[0] -> man_num;
            $gid = $restime[0] -> status;
         }

     if(!empty($res)){
        $groupid = $res[0] -> group_id;
        $sqlsum = "select sum(m.num) as sum,m.p_id from (select o.num,d.p_id from lkt_order as o left join lkt_order_details as d on o.sNo=d.r_sNo where o.pid='$groupid' and o.status>0) as m group by m.p_id"; 
        $ressum = $db -> select($sqlsum);
        
        foreach ($res as $k => $v) {
            $v -> sum = 0;
            $res[$k] = $v;
            $res[$k] -> imgurl = $img.$v -> image;
            if(!empty($ressum)){
                foreach ($ressum as $ke => $val) {
                    if($val -> p_id == $v -> product_id){
                       $res[$k] -> sum = $val -> sum;
                    }
                }
            }

        }
        $banner = '';  
        echo json_encode(array('code' => 1,'banner' => $banner,'list' => $res,'endtime' => $endtime,'groupman' => $g_man,'groupid' => $gid));exit;
        }
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $m = addslashes(trim($request->getParameter('m')));
        
        if($m == 'getgoodsdetail'){
          $this -> getgoodsdetail();
        }else if($m == 'payfor'){
          $this -> payfor();
        }else if($m == 'createGroup'){
          $this -> creatgroup();
        }else if($m == 'cangroup'){
          $this -> can_group();
        }else if($m == 'canOrder'){
          $this -> can_order();
        }else if($m == 'Send_open'){
          $this -> Send_open();
        }else if($m == 'Send_can'){
          $this -> Send_can();
        }else if($m == 'getFormid'){
          $this -> getformid();
        }else if($m == 'orderMember'){
          $this -> ordermember();
        }else if($m == 'orderDetail'){
          $this -> orderdetail();
        }else if($m == 'confirmReceipt'){
          $this -> confirmreceipt();
        }else if($m == 'getcomment'){
          $this -> getcomment();
        }else if($m == 'morepro'){
          $this -> morepro();
        }else if($m == 'grouphome'){
          $this -> grouphome();
        }else if($m == 'isgrouppacked'){
          $this -> isgrouppacked();
        }else if($m == 'up_out_trade_no'){
          $this -> up_out_trade_no();
        }else if($m == 'verification'){
          $this -> verification();
        }
        return;
    }

    public function grouphome(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $sort = trim($request->getParameter('sort')); // 排序方式  1 asc 升序   0 desc 降序
        if($sort){
             $sort = SORT_ASC ; 
        }else{
             $sort = SORT_DESC ; 
        }

        $select = trim($request->getParameter('select')); //  选中的方式 0 默认  1 销量   2价格
        if($select == 0){
            $select = 'id'; 
            $sort = SORT_DESC ; 
        }elseif ($select == 1) {
             $select = 'sum'; 
        }else{
             $select = 'group_price'; 
        }
        // 查询系统参数
        $sql = "select * from lkt_config where id = 1";
        $r_1 = $db->select($sql);
        $uploadImg_domain = $r_1[0]->uploadImg_domain; // 图片上传域名
        $uploadImg = $r_1[0]->uploadImg; // 图片上传位置
        if(strpos($uploadImg,'../') === false){ // 判断字符串是否存在 ../
            $img = $uploadImg_domain . $uploadImg; // 图片路径
        }else{ // 不存在
            $img = $uploadImg_domain . substr($uploadImg,2); // 图片路径
        }
        $pagesize =  10;
         // $pagesize = 2 ;
        // 每页显示多少条数据
        $page = $request->getParameter('page');
        if ($page) {
            $start = ($page - 1) * $pagesize;
        } else {
            $start = 0;
        }

        // $rrr = huodongzhuangtai($db);////监测拼团活动有没有过期的，改变其活动状态
        $sqltime =  "select min(g.attr_id) as attr_id,g.*,p.product_title,p.status,p.product_class,p.imgurl,c.price,c.num ,g.group_id
                from lkt_group_product as g 
                left join lkt_product_list as p on g.product_id=p.id 
                left join lkt_configure as c on g.attr_id=c.id 
                where g.is_show=1 and g.g_status =2 and p.num >0 and p.status = 0 and g.recycle = 0
                group by g.group_id 
                order by g.id desc limit  $start,$pagesize";
         $restime = $db -> select($sqltime);
         // print_r($sqltime);die;
         if(!empty($restime)){
                foreach ($restime as $key => $v) {
                    $sumsql = "select count(sNo) as sum from lkt_order where pid =$v->group_id";
                    $sumres = $db -> select($sumsql);
                    $group_data = unserialize($v -> group_data);
                    $group_level = unserialize($v -> group_level);
                    $min_man = 1;
                    $min_bili = 100;

                    foreach ($group_level as $k_ => $v_){
                        $biliArr = explode('~',$v_);
                                $min_man = $k_;   //几人团  

                        $nn= $db -> select("select open_discount from lkt_group_config ");
                        if($nn){
                            $open_discount = $nn[0]->open_discount;//是否开启团长优惠，开启就显示团长价格，未开启就显示拼团价1 是 0 否
                            if($open_discount == 1){//开启
                                   $min_price = $biliArr[1] * $v->price / 100;
                            }else{
                                   $min_price = $biliArr[0] * $v->price / 100;
                            }
                        }else{
                                   $min_price = $biliArr[0] * $v->price / 100;
                            }
                        
                    }
                    $v->min_man = $min_man;
                    $ve['id']=$v ->id;
                    $ve['attr_id']=$v ->attr_id;
                    $ve['product_id']=$v ->product_id;
                    $ve['group_price']=sprintf("%.2f", $min_price);
                    $ve['group_id']=$v->group_id;
                    $ve['image']=$img.$v ->imgurl;
                    $ve['market_price']=$v ->price;
                    $ve['pro_name']=$v ->product_title;
                    $ve['imgurl']=$img.$v->imgurl;
                    $ve['sum']= $sumres[0]->sum;
                    $re[]= $ve;
                    
                   
                }  
                // print_r($re);die;
                array_multisort(array_column($re,$select),$sort,$re);//排序
            echo json_encode(array('code' => 1,'list' => $re));exit;
        }else{
            echo json_encode(array('code' => 0));exit;
        }
    }

    public function morepro() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $page = $request->getParameter('page');
        $groupid = addslashes(trim($request->getParameter('groupid')));
        
        $total = $page*8;
        $sql = "select min(attr_id) as attr_id,product_id,group_price,group_id,pro_name,image,market_price from lkt_group_product where group_id='$groupid' group by product_id limit $total,8";
        $res = $db -> select($sql);
        
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

     if(!empty($res)){
        $groupid = $res[0] -> group_id;
        $sqlsum = "select sum(m.num) as sum,m.p_id from (select o.num,d.p_id from lkt_order as o left join lkt_order_details as d on o.sNo=d.r_sNo where o.pid='$groupid' and o.status>0) as m group by m.p_id"; 
        $ressum = $db -> select($sqlsum);
        
        foreach ($res as $k => $v) {
            $v -> sum = 0;
            $res[$k] = $v;
            $res[$k] -> imgurl = $img.$v -> image;
            if(!empty($ressum)){
                foreach ($ressum as $ke => $val) {
                    if($val -> p_id == $v -> product_id){
                       $res[$k] -> sum = $val -> sum;
                    }
                }
            }  
        }     
        echo json_encode(array('code' => 1,'list' => $res));exit;
     }else{
        echo json_encode(array('code' => 1,'list' => false));exit;
     }
    } 
    
    public function getgoodsdetail(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $gid = addslashes(trim($request->getParameter('gid')));
        $group_id = addslashes(trim($request->getParameter('group_id')));
        $user_id = addslashes(trim($request->getParameter('userid')));
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
         $guigesql = "select a.group_title as pro_name, a.*,b.* from lkt_group_product as a,lkt_product_list as b where a.group_id = $group_id and a.product_id = b.id";

        $guigeres = $db -> select($guigesql);

        list($guigeres) = $guigeres;
        if($guigeres){
            $content = $guigeres -> content;
        }else{

            $content = '';
        }

        $newa = substr($uploadImg_domain,0,strrpos($uploadImg_domain,'/'));
        if($newa == 'http:/' || $newa == 'https:/' ){
            $newa = $uploadImg_domain;
        }
        $guigeres -> content = preg_replace('/(<img.+?src=")(.*?)/',"$1$newa$2", $content);
        // $guigeres -> content ='';
        $imgsql = 'select product_url from lkt_product_img where product_id='.$gid;
        $imgres = $db -> select($imgsql);
        
        $imgarr = [];
        if($guigeres -> imgurl){
            $im = $guigeres -> imgurl;
        }else{
            $im = $guigeres -> imgurl;
        }
        if(!empty($imgres)){
            foreach ($imgres as $k => $v) {
                $imgarr[$k] = $img.$v -> product_url;
            }

            $guigeres -> image = $img.$im; 
            $guigeres -> images = $imgarr;
        }else{

            $guigeres -> image = $img.$im; 
            $imgarr[0] = $img.$im;
            $guigeres -> images = $imgarr;
        }
        // print_r($imgarr);die;
        $contsql = 'select * from lkt_group_product where group_id="'.$group_id.'"';
        $contres = $db -> select($contsql);
        // print_r($contres);die;
        if($contres){
            $cfg = unserialize($contres[0]->group_data);
                    $contres[0]->start_time = $cfg->starttime;
                    
                    if ($cfg -> endtime =='changqi') {
                    $dt=$cfg -> starttime;
                    $dt=date('Y-m-d H:i:s',strtotime("$dt+1year"));
                    $end_time = strtotime($dt);
                 
                }else{
                    $end_time = strtotime($cfg -> endtime);
                    
                }

                   $contres[0]->endtime = $end_time;
        }
        list($contres) = $contres;
        

        $commodityAttr = [];
            $sql_size = "select g.*,p.attribute,p.num,p.price,p.yprice,p.img,p.id from lkt_group_product as g left join lkt_configure as p on g.attr_id=p.id where g.product_id = '$gid' and group_id='$group_id'";
            // print_r($sql_size);die;
            $r_size = $db->select($sql_size);
            $array_price = [];
            $array_yprice = [];
            $skuBeanList = [];
            $attrList = [];
            if ($r_size) {

                $attrList = [];
                $a = 0;
                $attr = [];
                
                foreach ($r_size as $key => $value) {
                    $array_price[$key] = $value->price;
                    $array_yprice[$key] = $value->yprice;
                    $attribute = unserialize($value->attribute);
                    $attnum = 0;
                    $arrayName = [];
                    foreach ($attribute as $k => $v) {
                        if(!in_array($k, $arrayName)){
                            array_push($arrayName, $k);
                            $kkk = $attnum++;
                            $attrList[$kkk] = array('attrName' => $k,'attrType' => '1','id' => md5($k),'attr' => [],'all'=>[]);
                        }
                    }
                    $group_level = unserialize($value->group_level);
                    $min_man = 1;
                    $min_bili = 100;
                    foreach ($group_level as $k_ => $v_){
                        $biliArr = explode('~',$v_);
                            if($biliArr[0] < $min_bili){
                                $min_man = $k_;
                                $min_bili = $biliArr[0];

                            }
                    }
                    $min_man = $min_man;//几人团
                    
                }
                
               

                $guigeres -> man_num = $min_man;
                $guigeres -> market_price = $r_size[0]->price;//原价
                
               
                foreach ($r_size as $key => $value) {
                    $attribute = unserialize($value->attribute);
                    $attributes = [];
                    $name = '';
                    foreach ($attribute as $k => $v) {
                       $attributes[] = array('attributeId' => md5($k), 'attributeValId' => md5($v));
                       $name .= $v;
                    }
                    $cimgurl = $img.$value->img;
                     
                $nn= $db -> select("select open_discount,rule from lkt_group_config where id =1");
                if($nn){
                    $open_discount = $nn[0]->open_discount;//是否开启团长优惠，开启就显示团长价格，未开启就显示拼团价
                    if($open_discount == 1){//开启
                        $openmoney =($biliArr[1]*$r_size[0]->price)/100;//开团 人价格
                        $guigeres -> member_price = sprintf("%.2f", $openmoney);//团长价
                        $min_price = $biliArr[1] * $value->price / 100;//参团价格
                        $openmoney = sprintf("%.2f", $min_price);
                        $canmoney =$biliArr[1]*$r_size[0]->price/100;//参团 人价格
                        $guigeres -> group_price = sprintf("%.2f", $canmoney);;//拼团价
                    }else{
                        $openmoney =($biliArr[0]*$r_size[0]->price)/100;//开团 人价格
                        $guigeres -> member_price = sprintf("%.2f", $openmoney);//团长价
                        $min_price = $biliArr[0] * $value->price / 100;//参团价格
                        $openmoney = sprintf("%.2f", $min_price);
                        $canmoney =$biliArr[0]*$r_size[0]->price/100;//参团 人价格
                        $guigeres -> group_price = sprintf("%.2f", $canmoney);;//拼团价
                    }
                     $guigeres -> rule = $nn[0]->rule;
                }else{
                        $openmoney =($biliArr[0]*$r_size[0]->price)/100;//开团 人价格
                        $guigeres -> member_price = sprintf("%.2f", $openmoney);//团长价
                        $min_price = $biliArr[0] * $value->price / 100;//参团价格
                        $openmoney = sprintf("%.2f", $min_price);
                        $canmoney =$biliArr[0]*$r_size[0]->price/100;//参团 人价格
                        $guigeres -> group_price = sprintf("%.2f", $canmoney);;//拼团价
                         $guigeres -> rule = '';
                }
                    
               
               
                    $skuBeanList[$key] = array('name' => $name,'imgurl' => $cimgurl,'cid' => $value->id,'member_price' => $openmoney,'price' => $value->price,'count' => $value->num,'attributes' => $attributes);
                    for ($i=0; $i < count($attrList); $i++) {
                        $attr = $attrList[$i]['attr'];
                        $all = $attrList[$i]['all'];
                        foreach ($attribute as $k => $v) {
                            if($attrList[$i]['attrName'] == $k){
                                $attr_array = array('attributeId' => md5($k), 'id' =>md5($v), 'attributeValue' => $v, 'enable' => false, 'select' => false);

                                if(empty($attr)){
                                    array_push($attr, $attr_array);
                                    array_push($all, $v);
                                }else{
                                    if(!in_array($v, $all)){
                                        array_push($attr, $attr_array);
                                        array_push($all, $v);
                                    }
                                }

                            }
                        }
                        $attrList[$i]['all'] =$all;
                        $attrList[$i]['attr'] =$attr;
                    }
                    
                }

            }
        
        //查询此商品评价记录
        $sql_c = "select a.id,a.add_time,a.content,a.CommentType,a.size,m.user_name,m.headimgurl from lkt_comments AS a LEFT JOIN lkt_user AS m ON a.uid = m.user_id where a.pid = '$gid' and m.wx_id != '' limit 2";
            $r_c = $db->select($sql_c);
            $arr=[];
        if(!empty($r_c)){
            foreach ($r_c as $key => $value) {
                $va = (array)$value;
                $va['time'] = substr($va['add_time'],0,10);
                //-------------2018-05-03  修改  作用:返回评论图片
                $comments_id = $va['id'];
                $comments_sql = "select comments_url from lkt_comments_img where comments_id = '$comments_id' ";
                $comment_res = $db->select($comments_sql);
                $va['images'] ='';
                if($comment_res){
                    $va['images'] = $comment_res;
                    $array_c = [];
                    foreach ($comment_res as $kc => $vc) {
                       $url = $vc->comments_url;
                       $array_c[$kc] = array('url' =>$img.$url);
                    }
                    $va['images'] = $array_c;
                }
                //-------------2018-07-27  修改
                $ad_sql = "select content from lkt_reply_comments where cid = '$comments_id' and uid = 'admin' ";
                $ad_res = $db->select($ad_sql);
                if($ad_res){
                    $reply_admin = $ad_res[0]->content;
                }else{
                    $reply_admin = '';
                }

                $va['reply'] = $reply_admin;
                $obj = (object)$va;
                $arr[$key] = $obj;
            }
         }
           if(!empty($r_c)){
                $goodsql = "select count(*) as num from lkt_comments where pid='$gid' and CommentType='GOOD'";
                $goodnum = $db -> select($goodsql);
                $com_num = array();
                $com_num['good'] = $goodnum[0] -> num;
                $badsql = "select count(*) as num from lkt_comments where pid='$gid' and CommentType='BAD'";
                $badnum = $db -> select($badsql);
                $com_num['bad'] = $badnum[0] -> num;
                $notbadsql = "select count(*) as num from lkt_comments where pid='$gid' and CommentType='NOTBAD'";
                $notbadnum = $db -> select($notbadsql);
                $com_num['notbad'] = $notbadnum[0] -> num;
            }else{
                $com_num = array('bad'=>0,'good'=>0,'notbad'=>0);
            }

        $sql_kt = "select g.id, g.ptcode,g.ptnumber,g.endtime,u.user_name,u.headimgurl,g.group_id from lkt_group_open as g left join lkt_user as u on g.uid=u.wx_id where g.group_id='$group_id' and g.ptgoods_id=$gid and g.ptstatus=1 ";
        // print_r($sql_kt);die;
        $res_kt = $db -> select($sql_kt);
        $groupList = [];
        if(!empty($res_kt)){
            foreach ($res_kt as $key => $value) {
                $idddd = $value->id;
                $ptcode = $value->ptcode;
                if( $guigeres -> man_num - $value->ptnumber <1){
                    up_su_status($db,$idddd,$ptcode);//过期修改拼团成功订单
                       // $updsql = "update lkt_group_open set ptstatus=2 where id='$idddd'";
                       //  $updres = $db -> update($updsql);
                    unset($value);
                }else{
                    $res_kt[$key] -> leftTime = strtotime($value -> endtime) - time();
                    if(strtotime($value -> endtime) - time() > 0){
                        array_push($groupList, $res_kt[$key]);
                    }else{
                         up_status($db,$idddd,$ptcode);//过期修改拼团订单

                    }
                }
            }
        }
        $plugsql = "select status from lkt_plug_ins where type = 0 and software_id = 3 and name like '%拼团%'";
        $plugopen = $db -> select($plugsql);
        $plugopen = !empty($plugopen)?$plugopen[0] -> status:0;
        
        $share = array('friends' => true, 'friend' => false);
        // 
        echo json_encode(array('control' =>$contres,'share'=>$share,'detail' => $guigeres,'attrList'=>$attrList,'skuBeanList'=>$skuBeanList,'comments'=>$arr,'comnum' => $com_num,'groupList' => $groupList,'isplug' => $plugopen));exit;
    } 

    public function getcomment(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $pid = intval($request->getParameter('pid'));
        $page = intval($request->getParameter('page'));
        $checked = intval($request->getParameter('checked'));

        $page = $page*8;
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
            $condition = '';
            switch ($checked) {
                case 1:
                    $condition .= " and a.CommentType='GOOD'";
                    break;
                case 2:
                    $condition .= " and a.CommentType='NOTBAD'";
                    break;
                case 3:
                    $condition .= " and a.CommentType='BAD'";
                    break;
                default:
                    $condition = '';
                    break;
            }
        
        
        //查询此商品评价记录
        $sql_c = "select a.id,a.add_time,a.content,a.CommentType,a.size,m.user_name,m.headimgurl from lkt_comments AS a LEFT JOIN lkt_user AS m ON a.uid = m.user_id where a.pid = '$pid'".$condition." limit $page,8";

            $r_c = $db->select($sql_c);
            $arr=[];
          if(!empty($r_c)){
            foreach ($r_c as $key => $value) {
                $va = (array)$value;
                $va['time'] = substr($va['add_time'],0,10);
                //-------------2018-05-03  修改  作用:返回评论图片
                $comments_id = $va['id'];
                $comments_sql = "select comments_url from lkt_comments_img where comments_id = '$comments_id' ";
                $comment_res = $db->select($comments_sql);
                $va['images'] ='';
                if($comment_res){
                    $va['images'] = $comment_res;
                    $array_c = [];
                    foreach ($comment_res as $kc => $vc) {
                       $url = $vc->comments_url;
                       $array_c[$kc] = array('url' =>$img.$url);
                    }
                    $va['images'] = $array_c;
                }
                //-------------2018-07-27  修改
                $ad_sql = "select content from lkt_reply_comments where cid = '$comments_id' and uid = 'admin' ";
                $ad_res = $db->select($ad_sql);
                if($ad_res){
                    $reply_admin = $ad_res[0]->content;
                }else{
                    $reply_admin = '';
                }

                $va['reply'] = $reply_admin;

                $obj = (object)$va;
                $arr[$key] = $obj;
            }
              
        echo json_encode(array('comment' =>$arr));exit;
      }else{
        echo json_encode(array('comment' =>false));exit;
      }
    }
    
    public function getformid(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $uid = addslashes(trim($request->getParameter('userid')));
        $formid = addslashes(trim($request->getParameter('from_id')));
        
        $fromidsql = "select count(*) as have from lkt_user_fromid where open_id='$uid'";
        $fromres = $db -> select($fromidsql);
        $fromres = intval($fromres[0] -> have);
        $lifetime = date('Y-m-d H:i:s',time() + 7*24*3600);
        if($formid != 'the formId is a mock one'){
            if($fromres < 8){           
                $addsql = "insert into lkt_user_fromid(open_id,fromid,lifetime) values('$uid','$formid','$lifetime')";
                $addres = $db -> insert($addsql);
            }else{
                return false;
            }
        }

    }

    public function payfor(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $uid = addslashes(trim($request->getParameter('uid')));
        $oid = addslashes(trim($request->getParameter('oid')));
        $num = addslashes(trim($request->getParameter('num')));
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $sizeid = intval(trim($request->getParameter('sizeid')));

         // 根据用户id,查询开团数
        $r_a1 = $db->select('select * from lkt_group_config');
        // print_r($r_a1);die;
        if($r_a1){
           $dat['open_num'] =$r_a1[0]->open_num;//开团人数 
           $dat['can_num'] =$r_a1[0]->can_num;//参团人数 
        }else{
            $dat['open_num'] =10;//设置的开团数 
           $dat['can_num'] =10;//设置的参团数 
        }
        $r_a2 = $db->selectrow("select id from lkt_group_open where uid='$uid' and ptstatus = 1 ");
        $r_a3 = $db->selectrow("select id from lkt_order where uid=(select user_id from lkt_user where wx_id='$uid' and ptstatus = 1 ");
        if($r_a2){
            $dat['num'] = $r_a2;
        }else{
             $dat['num'] = 0;//自己已开团数
        }
        if($r_a2){
            $dat['cnum'] = $r_a3;
        }else{
             $dat['cnum'] = 0;//自己已参团数
        }
        // 根据用户id,查询收货地址
        $sql_a = 'select id from lkt_user_address where uid=(select user_id from lkt_user where wx_id="'.$uid.' ")';
        $r_a = $db->select($sql_a);
        if($r_a){
            $arr['addemt']=0; // 有收货地址
            // 根据用户id、默认地址,查询收货地址信息
            $sql_e = 'select * from lkt_user_address where uid=(select user_id from lkt_user where wx_id="'.$uid.'  ") and is_default = 1';
            $r_e = $db->select($sql_e);
            //$r_e = (array)$r_e['0'];
            $r_e = !empty($r_e)?(array)$r_e['0']:array(); // 收货地址
            $arr['adds'] = $r_e;
        }else{
            $arr['addemt']=1; // 没有收货地址
            $arr['adds'] = ''; // 收货地址
        }
        
        $attrsql = "select m.*,l.product_title as pro_name ,l.freight from (select c.attribute,c.img as image,g.*,c.num,c.price from lkt_group_product as g left join lkt_configure as c on g.attr_id=c.id where g.group_id='$groupid' and g.attr_id=$sizeid) as m left join lkt_product_list as l on m.product_id=l.id";
        $attrres = $db -> select($attrsql);

        list($attrres) = $attrres;

        //团长价与参团价
          $group_level = unserialize($attrres -> group_level);
          foreach ($group_level as $k_ => $v_){
                $biliArr = explode('~',$v_);
                $man_num = $k_;

                $nn= $db -> select("select open_discount from lkt_group_config where id =1");
                if($nn){
                    $open_discount = $nn[0]->open_discount;//是否开启团长优惠，开启就显示团长价格，未开启就显示拼团价
                    if($open_discount == 1){//开启
                            $openmoney =($biliArr[1]*$attrres->price)/100;//开团 人价格
                    }else{                
                            $openmoney =($biliArr[0]*$attrres->price)/100;//开团 人价格
                    }
                }else{                
                            $openmoney =($biliArr[0]*$attrres->price)/100;//开团 人价格
                    }
                

            }
               
                $canmoney =$biliArr[0]*$attrres->price/100;//参团 人价格
                $attrres->group_price = sprintf("%.2f", $canmoney);  //拼团价格
                $attrres->member_price =sprintf("%.2f", $openmoney);//团长价格
        //计算运费
        $yunfei = 0;
        $yunfei = $yunfei + $this->freight1($attrres->freight,$num,$arr['adds'],$db);
        $attribute = unserialize($attrres->attribute);
        $size = '';
        foreach ($attribute as $ka => $va) {
            $size .= ' '.$va;
        }
        $attrres->size = $size;

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
        $attrres -> image = $img.$attrres -> image;

        $moneysql = 'select user_id,user_name,money from lkt_user where wx_id="'.$uid.'" ';
        $moneyres = $db -> select($moneysql);
        
        if(!empty($moneyres)){
            list($moneyres) = $moneyres;
            $money = $moneyres -> money;
            $user_name = $moneyres -> user_name;
            $userid = $moneyres -> user_id;
        }
        $selfsql = "select count(*) as isset from lkt_order where user_id='$userid' and ptcode='$oid'";
        $is_self = $db -> select($selfsql);
        $is_self = $is_self[0] -> isset;
        
        $groupsql = "select * from lkt_group_config ";
        $groupres = $db -> select($groupsql);
        if(!empty($groupres)){
            $groupres[0]->groupnum=$groupres[0]->can_num;//可同时进行的参团数
            $groupres[0]->man_num=$man_num;//拼团人数
            // $groupres[0]->productnum=$groupres[0]->;//用户参团可购买产品数
            $groupres[0]->status=$groupid;//活动编号
            $groupres[0]->time_over=$groupres[0]->group_time.":0";//活动时限
            list($groupres) = $groupres;
        }else{

            $groupres[0] = new stdClass();
            $groupres[0]->groupnum = '10';//可同时进行的参团数
            $groupres[0]->man_num=$man_num;//拼团人数
            $groupres[0]->status=$groupid;//活动编号
            $groupres[0]->time_over="1:0";//活动时限
            list($groupres) = $groupres;
        }
        // print_r($groupsql);die;
        $havesql = "select count(*) as have from lkt_order where pid='$groupid' and user_id='$userid' and ptstatus=1";
        $haveres = $db -> select($havesql);
        
        if(!empty($haveres)){
           $have = $haveres[0] -> have;
        }
        $attrres -> have = $have;
        
        echo json_encode(array('is_add' => $arr['addemt'],'buymsg' => $arr['adds'],'proattr' => $attrres,'money' => $money,'user_name' => $user_name,'groupres' => $groupres,'isself' => $is_self,'yunfei' => $yunfei,'dat'=>$dat));exit;

    }



    public function creatgroup(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $uid = addslashes(trim($request->getParameter('uid')));
        $form_id = addslashes(trim($request->getParameter('fromid')));
        $pro_id = intval(trim($request->getParameter('pro_id')));//商品ID
        $man_num =  intval(trim($request->getParameter('man_num')));
        $time_over = addslashes(trim($request->getParameter('time_over')));
        $sizeid = intval(trim($request->getParameter('sizeid')));//规格id
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $pro_name = addslashes(trim($request->getParameter('ptgoods_name')));
        $price = (float)(trim($request->getParameter('price')));
        $y_price = (float)(trim($request->getParameter('d_price')));
        $name = addslashes(trim($request->getParameter('name')));
        $sheng = intval(trim($request->getParameter('sheng')));
        $shi = intval(trim($request->getParameter('shi')));
        $quyu = intval(trim($request->getParameter('quyu')));
        $address = addslashes(trim($request->getParameter('address')));
        $tel = addslashes(trim($request->getParameter('tel')));
        $lack = intval(trim($request->getParameter('lack')));
        $buy_num = intval(trim($request->getParameter('num')));
        $paytype = addslashes(trim($request->getParameter('paytype')));
        $trade_no = addslashes(trim($request->getParameter('trade_no')));
        $status = intval(trim($request->getParameter('status')));
        $ordstatus = $status == 1?9:0;

        $db->begin();
        $num = substr(time(),5).mt_rand(10000,99999);
        $num1 = 'KT'.$num;
        $sql_user = "select count(id) as a from lkt_order where sNo = '$num1'";
        // print_r($sql_user);die;
        $ordernum = 'PT'.mt_rand(10000,99999).date('Ymd').substr(time(),5);
        $n = $db->select($sql_user);
        $aa = $n[0]->a ;
        do {
          $group_num = 'KT'.$num;
        } while ($aa > 0);

        $creattime = date('Y-m-d H:i:s');

        $time_over = explode(':', $time_over);

        $time_over = date('Y-m-d H:i:s',$time_over[0]*3600 + $time_over[1]*60 + time());
        //运费
        $freight = $this ->friends($pro_id,$sheng,$buy_num);
        if($freight == -1){
            $freight  = 0;
        }
        $pro_size = $db -> select("select attribute from lkt_configure where id=$sizeid");
       //写入配置
                    $attribute = unserialize($pro_size[0]->attribute);
                    $size = '';
                    foreach ($attribute as $ka => $va) {
                        $size .= $va.' ';
                    }

        $istsql1 = "insert into lkt_group_open(uid,ptgoods_id,ptcode,ptnumber,addtime,endtime,ptstatus,group_id,sNo) values('$uid',$pro_id,'$group_num',1,'$creattime','$time_over',$status,'$groupid','$ordernum')";
        $res1 = $db -> insert($istsql1);
            // echo "$ordernum";
         $nu = $db -> update("update lkt_product_list set volume=volume+$buy_num,num=num-$buy_num where id='$pro_id'");
         $nu11 = $db -> update("update lkt_configure set num=num-$buy_num where id='$sizeid'");//改变库存和销量
            // print_r($nu);die;
        if($res1 < 1){
            $db->rollback();
            echo json_encode(array('code' => 0,'sql'=>$istsql1));exit;
        }
        

        $user_id = $db -> select("select user_id from lkt_user where wx_id='$uid' ");

        $uid = $user_id[0] -> user_id;



        $istsql2 = "insert into lkt_order(user_id,name,mobile,num,z_price,sNo,sheng,shi,xian,address,pay,add_time,status,otype,ptcode,pid,ptstatus,trade_no,source) values('$uid','$name','$tel',$buy_num,$price,'$ordernum',$sheng,$shi,$quyu,'$address','$paytype','$creattime',$ordstatus,'pt','$group_num','$groupid',$status,'$trade_no','1')";

        $res2 = $db -> insert($istsql2);
        // echo "$ordernum";
        if($res2 < 1){
            $db->rollback();
            echo json_encode(array('code' => 0,'sql'=>$istsql2));exit;
        }
        

        $istsql3 = "insert into lkt_order_details(user_id,p_id,p_name,p_price,num,r_sNo,add_time,r_status,size,sid,freight) values('$uid',$pro_id,'$pro_name',$y_price,$buy_num,'$ordernum','$creattime','$ordstatus','$size',$sizeid,'$freight')";

        $res3 = $db -> insert($istsql3);
        // echo "$ordernum";
        if($res3 < 1){
            $db->rollback();
            echo json_encode(array('code' => 0,'sql'=>$istsql3));exit;
        }
        
        
        
        $idres = $db -> select("select id from lkt_order where sNo='$ordernum'");

        if(!empty($idres)) $idres = $idres[0] -> id;
        if($res1 > 0 && $res2 > 0 && $res3 > 0){
            $db->commit();
            echo json_encode(array('order' => $ordernum,'gcode' => $group_num,'group_num' => $group_num,'id' => $idres,'code' => 1));exit;
        }else{
            $db->rollback();
            echo json_encode(array('code' => 0));exit;
        }
        
       
    } 
    
    public function can_group(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $oid = addslashes(trim($request->getParameter('oid')));
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $gid = addslashes(trim($request->getParameter('gid')));
        $user_id = addslashes(trim($request->getParameter('userid')));
        
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

        $groupmsg = $db -> select("select * from lkt_group_open where ptcode='$oid'");
        if($user_id && $user_id!='undefined'){
            $userid = $db -> select("select user_id from lkt_user where wx_id='$user_id' ");
            $userid = $userid[0] -> user_id;
            $isrecd = $db -> select("select count(*) as recd from lkt_order where ptcode='$oid' and pid='$groupid' and user_id='$userid'");
            $recd = $isrecd[0] -> recd;
        }else{
            $recd=0;
        }

        
     if($recd > 0){
        $sql = "select m.*,d.p_name,d.p_price,d.sid from (select k.*,p.name,p.num,p.sheng,p.shi,p.xian,p.address,p.mobile,p.status from lkt_group_open as k right join lkt_order as p on k.ptcode=p.ptcode where p.ptcode='$oid' and p.user_id='$userid') as m left join lkt_order_details as d on m.sNo=d.r_sNo";

        $res = $db -> select($sql);
       
    if($res){
        
        $ptgoods_id = $res[0]->ptgoods_id;
        $aa = $db -> select("select group_level from lkt_group_product where group_id='$groupid' and product_id=$ptgoods_id");
        // print_r($aa);die;
        $res = $res[0];
        $image = $db -> select("select img,yprice,price from lkt_configure where id=$res->sid");
        $group_level = unserialize($aa[0] -> group_level);
        foreach ($group_level as $k_ => $v_){
                        $biliArr = explode('~',$v_);
                        $nn1= $db -> select("select open_discount from lkt_group_config where id =1");
                        if($nn1){
                            $open_discount = $nn1[0]->open_discount;//是否开启团长优惠，开启就显示团长价格，未开启就显示拼团价
                            if($open_discount == 1){//开启
                                    $min_price = $biliArr[1] * $image[0] -> price / 100;//团长价格
                                    $res -> p_price = sprintf("%.2f", $min_price);
                            }else{                
                                    $min_price = $biliArr[0] * $image[0] -> price / 100;//团长价格
                                    $res -> p_price = sprintf("%.2f", $min_price);
                            }
                        }else{                
                                    $min_price = $biliArr[0] * $image[0] -> price / 100;//团长价格
                                    $res -> p_price = sprintf("%.2f", $min_price);
                            }

                    }
                
        $res -> img = $img.$image[0] -> img;
        $res -> yprice = $image[0] -> price;
        $res -> p_price = sprintf("%.2f", $min_price);
        }else{
            $res = (object)array();
        }
        $res -> isSelf = true;
         
     }else{
             // print_r(111);die;
        $res = $groupmsg[0];
        $goodsql = "select z.*,l.product_title as pro_name from (select m.*,c.num,c.img as image,c.yprice,c.price from (select * from lkt_group_product where group_id='$groupid' and product_id=$res->ptgoods_id) as m left join lkt_configure as c on m.attr_id=c.id) as z left join lkt_product_list as l on z.product_id=l.id";
            // print_r($goodsql);die;
        $goods = $db -> select($goodsql);
        $res -> p_name = $goods[0] -> pro_name;

        $res -> yprice = $goods[0] -> price;
        $res -> price = $goods[0] -> price;
        $res -> img = $img.$goods[0] -> image;
        $res -> p_num = $goods[0] -> num;
        $res -> isSelf = false;

        $group_level = unserialize($goods[0]-> group_level);
        foreach ($group_level as $k_ => $v_){
                        $biliArr = explode('~',$v_);

                        $nn1= $db -> select("select open_discount from lkt_group_config where id =1");
                        if($nn1){
                            $open_discount = $nn1[0]->open_discount;//是否开启团长优惠，开启就显示团长价格，未开启就显示拼团价
                            if($open_discount == 1){//开启
                                    $openmoney =($biliArr[1]*$res -> price)/100;//开团 人价格
                                    $res -> p_price = sprintf("%.2f", $openmoney);
                            }else{                
                                    $openmoney =($biliArr[0]*$res -> price)/100;//开团 人价格
                                    $res -> p_price = sprintf("%.2f", $openmoney);
                            }
                        }else{                
                                    $openmoney =($biliArr[0]*$res -> price)/100;//开团 人价格
                                    $res -> p_price = sprintf("%.2f", $openmoney);
                            }
                        
                    }
                $min_price = $biliArr[0] * $res -> price / 100;//拼团价格
        $res -> gprice = sprintf("%.2f", $min_price);
     }
     // print_r($biliArr[1]);die;
       $memsql = "select i.user_id,u.headimgurl from lkt_order as i left join lkt_user as u on i.user_id=u.user_id where i.ptcode='$oid' and i.pid='$groupid'  order by i.id asc";
       // print_r($memsql);die;
       $groupmember = $db -> select($memsql);
 
        $man_num = $db -> select("select * from lkt_group_config where id='1'");//用户参团可购买产品数
        $is_overdue = is_overdue($db,$groupid);//查询该拼团活动是否过期 1 过期，0 没有
        // print_r($is_overdue);die;
       if(isset($man_num[0]) && $is_overdue==0){
                $nn= $man_num[0] -> open_num + $man_num[0] -> can_num;
               $res -> productnum = $nn;//用户参团可购买产品数
               $res -> groupmember = $groupmember;
               $sumsql = "select count(m.sNo) as sum from (select o.sNo from lkt_order as o left join lkt_order_details as d on o.sNo=d.r_sNo where d.p_id='$res->ptgoods_id') as m";
               $sumres = $db -> select($sumsql);
               
               if(!empty($sumres)) $res -> sum = $sumres[0] -> sum;
                switch ($res -> ptstatus) {
                    case 1:
                        $res -> groupStatus = '拼团中';
                        break;
                    case 2:
                        $res -> groupStatus = '拼团成功';
                        break;
                    case 3:
                        $res -> groupStatus = '拼团失败';
                        break;
                    default:
                        $res -> groupStatus = '未付款';
                        break;
                }
                // print_r($res -> endtime);die;
                
                $res -> leftTime = strtotime($res -> endtime) - time();    
                //group_price as price,g.member_price
                    $sql_size = "select g.*,p.attribute,p.num,p.img,p.yprice,p.price,p.id from lkt_group_product as g left join lkt_configure as p on g.attr_id=p.id where g.product_id = '$gid' and group_id='$groupid'";
                         // print_r($sql_size);die;
                    $r_size = $db->select($sql_size);

                    $skuBeanList = [];
                    $attrList = [];
                    if ($r_size) {
                     // print_r($biliArr[1]);die;
                        $attrList = [];
                        $a = 0;
                        $attr = [];
                        foreach ($r_size as $key => $value) {
                            $tuanzhang = $biliArr[1] * $value->price / 100;//团长价
                            $value->member_price = sprintf("%.2f", $tuanzhang);
                            $pin = $biliArr[0] * $value->price / 100;//拼团价
                            $value->price = sprintf("%.2f", $pin);
                            
                            $array_price[$key] = $value->price;
                            $array_yprice[$key] = $value->price;
                            $attribute = unserialize($value->attribute);
                            $attnum = 0;
                            $arrayName = [];
                            foreach ($attribute as $k => $v) {
                                if(!in_array($k, $arrayName)){
                                    array_push($arrayName, $k);
                                    $kkk = $attnum++;
                                    $attrList[$kkk] = array('attrName' => $k,'attrType' => '1','id' => md5($k),'attr' => [],'all'=>[]);
                                }
                            }
                        }
                        foreach ($r_size as $key => $value) {
                            $attribute = unserialize($value->attribute);
                            $attributes = [];
                            $name = '';
                            foreach ($attribute as $k => $v) {
                               $attributes[] = array('attributeId' => md5($k), 'attributeValId' => md5($v));
                               $name .= $v;
                            }
                            $cimgurl = $img.$value->img;
                            $skuBeanList[$key] = array('name' => $name,'imgurl' => $cimgurl,'cid' => $value->id,'price' => $value->price,'count' => $value->num,'attributes' => $attributes);
                            
                            for ($i=0; $i < count($attrList); $i++) {
                                $attr = $attrList[$i]['attr'];
                                $all = $attrList[$i]['all'];
                                foreach ($attribute as $k => $v) {
                                    if($attrList[$i]['attrName'] == $k){
                                        $attr_array = array('attributeId' => md5($k), 'id' =>md5($v), 'attributeValue' => $v, 'enable' => false, 'select' => false);
                                        if(empty($attr)){
                                            array_push($attr, $attr_array);
                                            array_push($all, $v);
                                        }else{
                                            if(!in_array($v, $all)){
                                                array_push($attr, $attr_array);
                                                array_push($all, $v);
                                            }
                                        }
                                    }
                                }
                                $attrList[$i]['all'] =$all;
                                $attrList[$i]['attr'] =$attr;
                            }
                        }

                    }

                $plugsql = "select status from lkt_plug_ins where type = 0 and software_id = 3 and name like '%拼团%'";
                $plugopen = $db -> select($plugsql);
                $plugopen = !empty($plugopen)?$plugopen[0] -> status:0;

                $prostatus = $db -> select("select status from lkt_product_list where id='$gid'");
                $prostatus = $prostatus[0] -> status;
                
                echo json_encode(array('groupmsg' => $res,'groupMember' => $groupmember,'skuBeanList' => $skuBeanList,'attrList' => $attrList,'isplug' => $plugopen,'prostatus' => $prostatus));exit;
        }else{
           echo json_encode(array('groupmsg' => 0,'groupMember' => 0,'skuBeanList' => 0,'attrList' => 0,'isplug' => 0));exit; 
        }


    } 
    
    public function can_order(){
        $db = DBAction::getInstance();
        $db->begin();
        $request = $this->getContext()->getRequest();
        $uid = addslashes(trim($request->getParameter('uid')));
        $form_id = addslashes(trim($request->getParameter('fromid')));
        $oid = addslashes(trim($request->getParameter('oid')));
        $pro_id = intval(trim($request->getParameter('pro_id')));
        $sizeid = intval(trim($request->getParameter('sizeid')));
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $man_num = intval(trim($request->getParameter('man_num')));
        $pro_name = addslashes(trim($request->getParameter('ptgoods_name')));
        $price = (float)(trim($request->getParameter('price')));
        $y_price = (float)(trim($request->getParameter('d_price')));
        $name = addslashes(trim($request->getParameter('name')));
        $sheng = intval(trim($request->getParameter('sheng')));
        $shi = intval(trim($request->getParameter('shi')));
        $quyu = intval(trim($request->getParameter('quyu')));
        $address = addslashes(trim($request->getParameter('address')));
        $tel = addslashes(trim($request->getParameter('tel')));
        $lack = intval(trim($request->getParameter('lack')));
        $buy_num = intval(trim($request->getParameter('num')));
        $paytype = addslashes(trim($request->getParameter('paytype')));
        $trade_no = addslashes(trim($request->getParameter('trade_no')));
        $status = intval(trim($request->getParameter('status')));
        $ordstatus = $status == 1?9:0;

        $creattime = date('Y-m-d H:i:s');
              $pro_size = $db -> select("select attribute from lkt_configure where id=$sizeid");
       //写入配置
                    $attribute = unserialize($pro_size[0]->attribute);
                    $pro_size = '';
                    foreach ($attribute as $ka => $va) {
                        $pro_size .= $va.' ';
                    }
        $selsql = "select ptnumber,ptstatus,endtime from lkt_group_open where group_id='$groupid' and ptcode='$oid'";
        $selres = $db -> select($selsql);
        if(!empty($selres)){
            $ptnumber = $selres[0] -> ptnumber;
            $ptstatus = $selres[0] -> ptstatus;
            $endtime = strtotime($selres[0] -> endtime);
        }
        $ordernum = 'PT'.mt_rand(10000,99999).date('Ymd').substr(time(),5);
        $user_id = $db -> select("select user_id from lkt_user where wx_id='$uid' ");
        $uid = $user_id[0] -> user_id;
        // $freight  =0;
        //运费
        $freight = $this ->friends($pro_id,$sheng,$buy_num);
       if($endtime >= time()){
        if(($ptnumber+1) < $man_num){//拼团中，未满
            
            $istsql2 = "insert into lkt_order(user_id,name,mobile,num,z_price,sNo,sheng,shi,xian,address,pay,add_time,otype,ptcode,pid,ptstatus,status,trade_no,source) values('$uid','$name','$tel',$buy_num,$price,'$ordernum',$sheng,$shi,$quyu,'$address','$paytype','$creattime','pt','$oid','$groupid',$status,$ordstatus,'$trade_no','1')";
            $res2 = $db -> insert($istsql2);   
            if($res2 < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$istsql2));exit;
            }

            $istsql3 = "insert into lkt_order_details(user_id,p_id,p_name,p_price,num,r_sNo,add_time,r_status,size,sid,freight) values('$uid',$pro_id,'$pro_name',$y_price,$buy_num,'$ordernum','$creattime','$ordstatus','$pro_size',$sizeid,'$freight')";   
            $res3 = $db -> insert($istsql3);
            $nu = $db -> update("update lkt_product_list set volume=volume+$buy_num,num=num-$buy_num where id='$pro_id'");
         $nu11 = $db -> update("update lkt_configure set num=num-$buy_num where id='$sizeid'");//改变库存和销量
            if($res3 < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$istsql3));exit;
            }

            $updsql = "update lkt_group_open set ptnumber=ptnumber+1 where group_id='$groupid' and ptcode='$oid'";
            $updres = $db -> update($updsql);
            if($updres < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$updsql));exit;
            }

            $db->commit();
            $idres = $db -> select("select id from lkt_order where sNo='$ordernum'");
                if(!empty($idres)) $idres = $idres[0] -> id;
           
              echo json_encode(array('order' => $ordernum,'gcode' => $oid,'group_num' => $oid,'ptnumber' => $ptnumber, 'id' => $idres,'endtime' => $endtime,'code' => 1));exit;


        }else if(($ptnumber+1) === $man_num){//拼团正好满
            $istsql2 = "insert into lkt_order(user_id,name,mobile,num,z_price,sNo,sheng,shi,xian,address,pay,add_time,otype,ptcode,pid,ptstatus,status,trade_no,source) values('$uid','$name','$tel',$buy_num,'$price','$ordernum',$sheng,$shi,$quyu,'$address','$paytype','$creattime','pt','$oid','$groupid',$status,$ordstatus,'$trade_no','1')";
            $res2 = $db -> insert($istsql2);   

            if($res2 < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$istsql2));exit;
            }

            $istsql3 = "insert into lkt_order_details(user_id,p_id,p_name,p_price,num,r_sNo,add_time,r_status,size,sid,freight) values('$uid',$pro_id,'$pro_name',$y_price,$buy_num,'$ordernum','$creattime',1,'$pro_size',$sizeid,'$freight')";
            
            $res3 = $db -> insert($istsql3);
            if($res3 < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$istsql3));exit;
            }

            $nu = $db -> update("update lkt_product_list set volume=volume+$buy_num,num=num-$buy_num where id='$pro_id'");
            $nu11 = $db -> update("update lkt_configure set num=num-$buy_num where id='$sizeid'");//改变库存和销量

            $updsql = "update lkt_group_open set ptnumber=ptnumber+1,ptstatus=2 where group_id='$groupid' and ptcode='$oid'";
            $updres = $db -> update($updsql);
            
            if($updres < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>$updsql));exit;
            }
            $updres = $db -> update("update lkt_order set ptstatus=2,status=1 where pid='$groupid' and ptcode='$oid'");
            $se = $db->select("select sNo from lkt_order where pid='$groupid' and ptcode='$oid'");
        
            if($se){
                foreach ($se as $key01 => $value02) {
                   $r_sNo = $value02->sNo;
                    $updresy = $db -> update("update lkt_order_details set r_status=1 where r_sNo='$r_sNo'");
                        // print_r("update lkt_order_details set r_status=1 where r_sNo='$r_sNo'");
                }
            }
            if($updres < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>"update lkt_order set ptstatus=2,status=1 where pid='$groupid' and ptcode='$oid'"));exit;
            }
            $selmsg = "select m.*,d.p_name,d.p_price,d.num,d.sid from (select o.id,o.user_id,o.ptcode,o.sNo,o.z_price,u.wx_id as uid from lkt_order as o left join lkt_user as u on o.user_id=u.user_id where o.pid='$groupid' and o.ptcode='$oid' ) as m left join lkt_order_details as d on m.sNo=d.r_sNo";
            $msgres = $db -> select($selmsg);
            
            foreach ($msgres as $k => $v) {
                // $updres = $db -> update("update lkt_configure set num=num-$v->num where id=$v->sid");
                // if($updres < 1){
                //     $db->rollback();
                //     echo json_encode(array('code' => 3,'sql'=>"update lkt_configure set num=num-$v->num where id=$v->sid"));exit;
                // }
                $fromidsql = "select fromid,open_id from lkt_user_fromid where open_id='$v->uid' and id=(select max(id) from lkt_user_fromid where open_id='$v->uid')";
                $fromidres = $db -> select($fromidsql);                           
                foreach ($fromidres as $ke => $val) {
                    if($val -> open_id == $v -> uid){
                        $msgres[$k] -> fromid = $val -> fromid;
                    }
                }     
            }           
            if($res2 > 0 && $res3 > 0){  
                $sql = "select * from lkt_notice where id = '1'";
                $r = $db->select($sql);
                $template_id = $r[0]->group_success;
   
              $this -> Send_success($msgres,date('Y-m-d H:i:s',time()),$template_id,$pro_name);
              $db->commit();
              // echo "2";
              echo json_encode(array('order' => $msgres,'gcode' => $oid,'code' => 2));exit;
            }
         }else if($ptnumber == $man_num){//该团已满，需重新参团或开团
                $updres = $db -> update("update lkt_user set money=money+$price where user_id='$uid' ");
                if($updres < 1){
                    $db->rollback();
                    echo json_encode(array('code' => 3,'sql'=>"update lkt_user set money=money+$price where user_id='$uid' "));exit;
                }
                $db->commit();
                echo json_encode(array('code' => 3));exit;
         }else{

         }


        }else{
            $updres = $db -> update("update lkt_user set money=money+$price where user_id='$uid' ");
            if($updres < 1){
                $db->rollback();
                echo json_encode(array('code' => 3,'sql'=>"update lkt_user set money=money+$price where user_id='$uid'"));exit;
            }
            $db->commit();
            echo json_encode(array('code' => 4));exit;
        }
        
       
    }

    

    public function isgrouppacked(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $oid = addslashes(trim($request->getParameter('oid')));
        $selsql = "select ptnumber from lkt_group_open where ptcode='$oid'";
        
        $selres = $db -> select($selsql);
        if($selres){
            $hasnum = $selres[0] -> ptnumber;
            echo json_encode(array('hasnum' => $hasnum));exit;
        }else{
            echo json_encode(array('hasnum' => 0));exit;
        }

    } 

    public function ordermember(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $uid = addslashes(trim($request->getParameter('uid')));        
        $page = intval(trim($request->getParameter('page')));
        $cid = intval(trim($request->getParameter('cid')));
        
        $pagesize = 5;
        $msgsta = $page*$pagesize;
        
        $condition = '';
        if($cid > 0){
           $condition .= ' and ptstatus='.$cid;
        }
        $gmsg = $db -> select("select man_num,status from lkt_group_buy where is_show=1");
        if(!empty($gmsg)) {
            $man_num = $gmsg[0] -> man_num;
            $groupid = $gmsg[0] -> status;
        }
        $sql = "select i.pro_id,i.ptcode,i.ptordercode,i.ptrefundcode,i.ptgoods_name as name,i.ptstatus,i.per_price as totalPrice,i.orderstatus,c.img from lkt_group_info as i left join lkt_configure as c on i.ptgoods_norm_id=c.id where i.pid='$groupid' and i.uid='$uid'".$condition." limit $msgsta,$pagesize";
        $res = $db -> select($sql);
        

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
        
        
        foreach ($res as $k => $v) {
            $res[$k] -> groupNum = $man_num;
            $res[$k] -> img = $img.$v -> img;
            $sqlsum = "select count(pid) as sum from lkt_group_info where pid='$groupid' and orderstatus>0 and pro_id='$v->pro_id' group by pro_id";
            $ressum = $db -> select($sqlsum);
            if(!empty($ressum)) $res[$k] -> sum = $ressum[0] -> sum;
         switch ($v -> orderstatus) {
            case 0:
                $res[$k] -> groupStatus = '未付歀';
                break;
            case 1:
                $res[$k] -> groupStatus = '待成团';
                break;
            case 2:
                $res[$k] -> groupStatus = '拼团成功-未发货';
                break;
            case 3:
                $res[$k] -> groupStatus = '拼团成功-已发货';
                break;
            case 4:
                $res[$k] -> groupStatus = '拼团成功-已签收';
                break;
            case 5:
                $res[$k] -> groupStatus = '拼团失败-未退款';
                break;
            default:
                $res[$k] -> groupStatus = '已退款';
                break;
         }
        }
         
        echo json_encode(array('groupmsg' => $res,'groupid' => $groupid));exit;
    }

    public function orderdetail(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $oid = addslashes(trim($request->getParameter('id')));        
        $groupid = addslashes(trim($request->getParameter('groupid')));
        //$oid = 'PT477202018052532946';
        //$groupid = '28548';
        $sql = "select m.*,c.img from (select o.user_id,o.ptcode,o.sNo,o.ptstatus,o.z_price,o.name,o.add_time,o.sheng,o.shi,o.xian,o.address,o.mobile,o.status,o.num,d.p_name,d.p_price,d.deliver_time,d.arrive_time,d.sid,d.express_id,d.courier_num from lkt_order as o left join lkt_order_details as d on o.sNo=d.r_sNo where o.pid='$groupid' and o.sNo='$oid') as m left join lkt_configure as c on m.sid=c.id";
        $res = $db -> select($sql);
        
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
        $address = array();
        if(!empty($res)) {
            $res = $res[0];
            $address['username'] = $res -> name;
            $address['tel'] = $res -> mobile;
            $address['province'] = $res -> sheng;
            $address['city'] = $res -> shi;
            $address['county'] = $res -> xian;
            $address['address'] = $res -> address;
            $res -> address = $address;
          if($res->express_id > 0){
            $express = $db -> select("select kuaidi_name from lkt_express where id=$res->express_id");
            $express = $express[0] -> kuaidi_name;
          }else{
             $express = '';   
          }
            $res -> express = $express;     
            $res -> img = $img.$res -> img;

          $goodsattr = $db -> select("select name,color,size from lkt_configure where id=$res->sid");
          $goodsattr = $goodsattr[0];
          $guige = array();
          $guige['pname'] = '规格';
          $guige['name'] = $goodsattr -> name;
          $color = array();
          $color['pname'] = '颜色';
          $color['name'] = $goodsattr -> color;
          $size = array();
          $size['pname'] = '尺寸';
          $size['name'] = $goodsattr -> size;
          $prop = array();
          $prop[] = $guige;
          $prop[] = $color;
          $prop[] = $size;
          $res -> goodsprop = $prop;
         switch ($res -> status) {
            case 0:
                $res -> orderStatus = '待付歀';
                break;
            case 9:
                $res -> orderStatus = '待成团';
                break;
            case 1:
                $res -> orderStatus = '待发货';
                break;
            case 2:
                $res -> orderStatus = '待收货';
                break;
            case 3:
                $res -> orderStatus = '已完成';
                break;
            case 10:
                $res -> orderStatus = '拼团失败';
                break;
            case 11:
                $res -> orderStatus = '已退款';
                break;
         }
        } 
         
        echo json_encode($res);exit;
    }
    
    public function confirmreceipt(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $oid = addslashes(trim($request->getParameter('oid')));        
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $updsql = "update lkt_order set status=3 where sNo='$oid' and pid='$groupid'";
        $updres = $db -> update($updsql);
        
         if($updres > 0){
            echo json_encode(array('code'=>1));exit;
         }
        
    }  
    
    function httpsRequest($url, $data=null) {
        // 1.初始化会话
        $ch = curl_init();
        // 2.设置参数: url + header + 选项
        // 设置请求的url
        curl_setopt($ch, CURLOPT_URL, $url);
        // 保证返回成功的结果是服务器的结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(!empty($data)) {
            // 发送post请求
            curl_setopt($ch, CURLOPT_POST, 1);
            // 设置发送post请求参数数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        // 3.执行会话; $result是微信服务器返回的JSON字符串
        $result = curl_exec($ch);
        // 4.关闭会话
        curl_close($ch);
        return $result;
    }

    public function Send_open()
    {
            $db = DBAction::getInstance();
            $request = $this->getContext()->getRequest();
            $openid = trim($request->getParameter('user_id'));  //--
            $form_id = trim($request->getParameter('form_id'));//--
            $page = trim($request->getParameter('page'));      //--
            // $oid = trim($request->getParameter('oid'));
            $f_price = trim($request->getParameter('price'));
            $f_price = $f_price.'元';
            $f_sNo = trim($request->getParameter('order_sn'));
            $f_pname = trim($request->getParameter('f_pname'));
            $opentime = date('Y-m-d H:i:s',time());
            $endtime = trim($request->getParameter('endtime'));
            $sum = trim($request->getParameter('sum'));
            $sum = $sum.'元';
            $member = trim($request->getParameter('member'));
            $endtime = explode(':', $endtime);
            $endtime = $endtime[0].'小时'.$endtime[1].'分钟';
            
            $sql = "select * from lkt_config where id=1";
            $r = $db->select($sql);
            if($r){
                $appid = $r[0]->appid; // 小程序唯一标识
                $appsecret = $r[0]->appsecret; // 小程序的 app secret

                $opentime = array('value' => $opentime,"color"=> "#173177" );
                $f_pname = array('value' => $f_pname,"color"=> "#173177" );
                $f_sNo = array('value' => $f_sNo,"color"=> "#173177" );
                $f_price = array('value' => $f_price,"color"=> "#173177" );
                $endtime = array('value' => $endtime,"color"=> "#173177" );
                $sum = array('value' => $sum,"color"=> "#173177" );
                $member = array('value' => $member,"color"=> "#173177" );
                $tishi = array('value' => '您可以邀请您的好友一起来拼团，邀请的人越多，成功的几率越高哦!',"color"=> "#FF4500" );
                $o_data = array('keyword1' => $member,'keyword2' => $opentime,'keyword3' => $endtime,'keyword4' => $f_price,'keyword5' => $sum,'keyword6' => $f_sNo,'keyword7' => $f_pname,'keyword8' => array('value'=>'已开团-待成团',"color"=> "#FF4500"),'keyword9' => $tishi);

                $AccessToken = $this->getAccessToken($appid, $appsecret);
                $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$AccessToken;

                $sql = "select * from lkt_notice where id = '1'";
                $r = $db->select($sql);
                $template_id = $r[0]->group_pay_success;
                
                $data = json_encode(array('access_token'=>$AccessToken,'touser'=>$openid,'template_id'=>$template_id,'form_id'=>$form_id,'page'=>$page,'data'=>$o_data));
                
                $da = $this->httpsRequest($url,$data);
                
                echo json_encode($da);

                exit();
            }   
            
    }

    public function Send_can()
    {
            $db = DBAction::getInstance();
            $request = $this->getContext()->getRequest();
            $openid = trim($request->getParameter('user_id'));  //--
            $form_id = trim($request->getParameter('form_id'));//--
            $page = trim($request->getParameter('page'));      //--
            $f_price = trim($request->getParameter('price'));
            $f_price = $f_price.'元';
            $f_sNo = trim($request->getParameter('order_sn'));
            $f_pname = trim($request->getParameter('f_pname'));
            $opentime = date('Y-m-d H:i:s',time());
            $endtime = intval($request->getParameter('endtime')) - time();
            $sum = trim($request->getParameter('sum'));
            $sum = $sum.'元';
            $man_num = trim($request->getParameter('man_num'));
            $hours = ceil($endtime/3600);
            $minute = ceil(($endtime%3600)/60);
            $endtime = $hours.'小时'.$minute.'分钟';

            $sql = "select * from lkt_config where id=1";
            $r = $db->select($sql);
            if($r){
                $appid = $r[0]->appid; // 小程序唯一标识
                $appsecret = $r[0]->appsecret; // 小程序的 app secret

                $opentime = array('value' => $opentime,"color"=> "#173177" );
                $f_pname = array('value' => $f_pname,"color"=> "#173177" );
                $f_sNo = array('value' => $f_sNo,"color"=> "#173177" );
                $f_price = array('value' => $f_price,"color"=> "#173177" );
                $endtime = array('value' => $endtime,"color"=> "#173177" );
                $sum = array('value' => $sum,"color"=> "#173177" );
                $man_num = array('value' => $man_num,"color"=> "#173177" );
                
                $o_data = array('keyword1' => $f_pname,'keyword2' => $f_price,'keyword3' => $sum,'keyword4' => $endtime,'keyword5' => array('value'=>'待成团',"color"=> "#FF4500"),'keyword6' => $opentime,'keyword7' => $man_num,'keyword8' => $f_sNo);

                $AccessToken = $this->getAccessToken($appid, $appsecret);
                $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$AccessToken;
                $sql = "select * from lkt_notice where id = '1'";
                $r = $db->select($sql);
                $template_id = $r[0]->group_pending;
                $data = json_encode(array('access_token'=>$AccessToken,'touser'=>$openid,'template_id'=>$template_id,'form_id'=>$form_id,'page'=>$page,'data'=>$o_data));
                
                $da = $this->httpsRequest($url,$data);
                
                echo json_encode($da);

                exit();
            }   
            
    }

    public function Send_success($arr,$endtime,$template_id,$pro_name)
    {
            $db = DBAction::getInstance();
            $request = $this->getContext()->getRequest();
            $sql = "select * from lkt_config where id=1";
            $r = $db->select($sql);
            if($r){
                $appid = $r[0]->appid; // 小程序唯一标识
                $appsecret = $r[0]->appsecret; // 小程序的 app secret

                $AccessToken = $this->getAccessToken($appid, $appsecret);
                $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$AccessToken;
                        
            }  
            foreach ($arr as $k => $v) {
                $data = array();
                $data['access_token'] = $AccessToken;
                $data['touser'] = $v -> uid;
                $data['template_id'] = $template_id;
                $data['form_id'] = $v -> fromid;
                $data['page'] = "pages/order/detail?orderId=$v->id";
                $z_price = $v -> z_price.'元';
                $p_price = $v -> p_price.'元';
                $minidata = array('keyword1' => array('value' => $pro_name,'color' => "#173177"),'keyword2' => array('value' => $z_price,'color' => "#173177"),'keyword3' => array('value' => $v -> sNo,'color' => "#173177"),'keyword4' => array('value' => '拼团成功','color' => "#FF4500"),'keyword5' => array('value' => $p_price,'color' => "#FF4500"),'keyword6' => array('value' => $endtime,'color' => "#173177"));
                $data['data'] = $minidata;
                
                $data = json_encode($data);        
                $da = $this->httpsRequest($url,$data);
                $delsql = "delete from lkt_user_fromid where open_id='$v->uid' and fromid='$v->fromid'";
                $db -> delete($delsql);  
                
            }
            
            
    }

    function getAccessToken($appID, $appSerect) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appID."&secret=".$appSerect;
            // 时效性7200秒实现
            // 1.当前时间戳
            $currentTime = time();
            // 2.修改文件时间
            $fileName = "accessToken"; // 文件名
            if(is_file($fileName)) {
                $modifyTime = filemtime($fileName);
                if(($currentTime - $modifyTime) < 7200) {
                    // 可用, 直接读取文件的内容
                    $accessToken = file_get_contents($fileName);
                    return $accessToken;
                }
            }
            // 重新发送请求
            $result = $this-> httpsRequest($url);
            $jsonArray = json_decode($result, true);
            // 写入文件
            $accessToken = $jsonArray['access_token'];
            file_put_contents($fileName, $accessToken);
            return $accessToken;
    }

    /*

   * 发送请求

   　@param $ordersNo string 订单号　

     @param $refund string 退款单号

     @param $price float 退款金额

     return array

   */

    private function wxrefundapi($ordersNo,$refund,$price){

          //通过微信api进行退款流程



          $parma = array(

            'appid'=> 'wx9d12fe23eb053c4f',

            'mch_id'=> '1499256602',

            'nonce_str'=> $this->createNoncestr(),

            'out_refund_no'=> $refund,

            'out_trade_no'=> $ordersNo,

            'total_fee'=> $price,

            'refund_fee'=> $price,

            'op_user_id' => '1499256602',

          );

          $parma['sign'] = $this->getSign($parma);

          $xmldata = $this->arrayToXml($parma);

          $xmlresult = $this->postXmlSSLCurl($xmldata,'https://api.mch.weixin.qq.com/secapi/pay/refund');

          $result = $this->xmlToArray($xmlresult);

          return $result;

    }



    /*

   * 生成随机字符串方法

   */

    protected function createNoncestr($length = 32 ){

         $chars = "abcdefghijklmnopqrstuvwxyz0123456789";

         $str ="";

         for ( $i = 0; $i < $length; $i++ ) {

         $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);

         }

         return $str;

    }



    /*

   * 对要发送到微信统一下单接口的数据进行签名

   */

   protected function getSign($Obj){

     foreach ($Obj as $k => $v){

       $Parameters[$k] = $v;

     }

     //签名步骤一：按字典序排序参数

     ksort($Parameters);

     $String = $this->formatBizQueryParaMap($Parameters, false);

     //签名步骤二：在string后加入KEY

     $String = $String."&key=td153g1d2f321g23ggrd123g12fd1g22";

     //签名步骤三：MD5加密

     $String = md5($String);

     //签名步骤四：所有字符转为大写

     $result_ = strtoupper($String);

     return $result_;

   }
  /*

   *排序并格式化参数方法，签名时需要使用

   */

  protected function formatBizQueryParaMap($paraMap, $urlencode){

    $buff = "";

    ksort($paraMap);

    foreach ($paraMap as $k => $v){

      if($urlencode){

        $v = urlencode($v);

      }

      //$buff .= strtolower($k) . "=" . $v . "&";

      $buff .= $k . "=" . $v . "&";

    }

    $reqPar;

    if (strlen($buff) > 0){

      $reqPar = substr($buff, 0, strlen($buff)-1);

    }

    return $reqPar;

  }



  //数组转字符串方法

  protected function arrayToXml($arr){

    $xml = "<xml>";

    foreach ($arr as $key=>$val)

    {

      if (is_numeric($val)){

        $xml.="<".$key.">".$val."</".$key.">";

      }else{

         $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";

      }

    }

    $xml.="</xml>";

    return $xml;

  }



  protected function xmlToArray($xml){

    $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

    return $array_data;

  }



  //需要使用证书的请求

   private function postXmlSSLCurl($xml,$url,$second=30){

      $ch = curl_init();

      //超时时间

      curl_setopt($ch,CURLOPT_TIMEOUT,$second);

      //这里设置代理，如果有的话

      //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');

      //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);

      curl_setopt($ch,CURLOPT_URL, $url);

      curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);

      curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);

      //设置header

      curl_setopt($ch,CURLOPT_HEADER,FALSE);

      //要求结果为字符串且输出到屏幕上

      curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);

      //设置证书

      //使用证书：cert 与 key 分别属于两个.pem文件

      //默认格式为PEM，可以注释

      $cert = str_replace('lib','filter',MO_LIB_DIR).'/apiclient_cert.pem';

      $key = str_replace('lib','filter',MO_LIB_DIR).'/apiclient_key.pem';

      curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');

      curl_setopt($ch,CURLOPT_SSLCERT, $cert);

      //默认格式为PEM，可以注释

      curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');

      curl_setopt($ch,CURLOPT_SSLKEY, $key);

      //post提交方式

      curl_setopt($ch,CURLOPT_POST, true);

      curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);

      $data = curl_exec($ch);

      //返回结果

      if($data){

        curl_close($ch);

        return $data;

      }

      else {

        $error = curl_errno($ch);

        echo "curl出错，错误码:$error"."<br>";

        curl_close($ch);

        return false;

      }

    }

    public function getRequestMethods(){
        return Request :: POST;
    }

    //临时存放微信付款信息
    public function up_out_trade_no(){
        $db = DBAction::getInstance();
        $request = $this -> getContext() -> getRequest();
        $pagefrom = trim($request->getParameter('pagefrom'));
        $uid = addslashes(trim($request->getParameter('uid')));
        $oid = addslashes(trim($request->getParameter('oid')));
        $form_id = addslashes(trim($request->getParameter('fromid')));
        $pro_id = intval(trim($request->getParameter('pro_id')));
        $man_num =  intval(trim($request->getParameter('man_num')));
        $sizeid = intval(trim($request->getParameter('sizeid')));
        $groupid = addslashes(trim($request->getParameter('groupid')));
        $pro_name = addslashes(trim($request->getParameter('ptgoods_name')));
        $price = (float)(trim($request->getParameter('price')));
        $y_price = (float)(trim($request->getParameter('d_price')));
        $name = addslashes(trim($request->getParameter('name')));
        $sheng = intval(trim($request->getParameter('sheng')));
        $shi = intval(trim($request->getParameter('shi')));
        $quyu = intval(trim($request->getParameter('quyu')));
        $address = addslashes(trim($request->getParameter('address')));
        $tel = addslashes(trim($request->getParameter('tel')));
        $lack = intval(trim($request->getParameter('lack')));
        $buy_num = intval(trim($request->getParameter('num')));
        $paytype = addslashes(trim($request->getParameter('paytype')));
        $trade_no = addslashes(trim($request->getParameter('trade_no')));
        $status = intval(trim($request->getParameter('status')));
        $time_over = addslashes(trim($request->getParameter('time_over')));
        $ordstatus = $status == 1?9:0;

        if($pagefrom == 'kaituan'){
            $array = array('uid' => $uid,'form_id' => $form_id,'oid' => $oid,'pro_id' => $pro_id,'sizeid' => $sizeid,'groupid' => $groupid,'man_num' => $man_num,'pro_name' => $pro_name,'price' => $price,'y_price' => $y_price,'name' => $name,'sheng' => $sheng,'shi' => $shi,'quyu' => $quyu,'address' => $address,'tel' => $tel,'lack' => $lack,'buy_num' => $buy_num,'paytype' => $paytype,'trade_no' => $trade_no,'status' => $status,'ordstatus' => $ordstatus,'time_over'=>$time_over,'pagefrom'=>$pagefrom);
        }else{
            $array = array('uid' => $uid,'form_id' => $form_id,'oid' => $oid,'pro_id' => $pro_id,'sizeid' => $sizeid,'groupid' => $groupid,'man_num' => $man_num,'pro_name' => $pro_name,'price' => $price,'y_price' => $y_price,'name' => $name,'sheng' => $sheng,'shi' => $shi,'quyu' => $quyu,'address' => $address,'tel' => $tel,'lack' => $lack,'buy_num' => $buy_num,'paytype' => $paytype,'trade_no' => $trade_no,'status' => $status,'ordstatus' => $ordstatus,'pagefrom'=>$pagefrom);
        }


        $data = serialize($array);

        $sql = "insert into lkt_order_data(trade_no,data,addtime) values('$trade_no','$data',CURRENT_TIMESTAMP)";
        $rid = $db->insert($sql);

        $yesterday= date("Y-m-d",strtotime("-1 day"));
        $sql = "delete from lkt_order_data where addtime < '$yesterday'";
        $db->delete($sql);

        echo json_encode(array('data'=>$array));
        exit();
    }

    public function verification()
    {
        $db = DBAction::getInstance();
        $request = $this -> getContext() -> getRequest();
        $trade_no = addslashes(trim($request->getParameter('trade_no')));
        $gmsg = $db -> select("select id,sNo,ptcode from lkt_order where trade_no='$trade_no'");

        if($gmsg){
            echo json_encode(array('status'=>1,'data'=>$gmsg[0]));
            exit();
        }else{
            echo json_encode(array('status'=>0));
            exit();
        }
    }

    public function friends($id,$sheng,$buy_num ){//查运费

        $db = DBAction::getInstance();
        $request = $this -> getContext() -> getRequest();
        $z_freight = 0;
        $num = $buy_num;
        $sqll = "select  G_CName  from admin_cg_group a  where a.GroupID=".$sheng;
        $rrl = $db->select($sqll);
        if($rrl){
            // print_r($rr)
            $G_CName = $rrl[0]->G_CName;
        }else{
            $z_freight = '-1';
             return  $z_freight;
        }



        // $trade_no = addslashes(trim($request->getParameter('trade_no')));
                $sql_c = "select freight from  lkt_product_list  where id = '$id' ";
                $r_c = $db->select($sql_c);
                if(!empty($r_c)){
                    $freight_id = $r_c[0]->freight; // 运费id
                    if(empty($freight_id) || $freight_id == 0){ // 当运费id不存在 或者 为0 时
                        $freight = 0; // 运费为0
                    }else{
                        // 根据运费id,查询运费信息
                        $sql = "select type,freight from lkt_freight where id = '$freight_id'";

                        $r2 = $db->select($sql);
                        if($r2){
                            $freight_type = $r2[0]->type;
                            $freight_1 = unserialize($r2[0]->freight);
                            $freight_status = 0; // 表示收货地址不存在运费规则里
                            $weight = 1;
                            foreach ($freight_1 as $k2 => $v2){
                    
                                $province_arr = explode(',',$v2['name']); // 省份数组
                                if(in_array($G_CName,$province_arr)){
                                    $one = $v2['one']; // 首件/重
                                    $two = $v2['two']; // 运费
                                    $three = $v2['three']; // 续件/重
                                    $four = $v2['four']; // 续费
                                    $province_name = $G_CName; // 省
                                    $freight_status = 1; // 表示收货地址存在运费规则里
                                    continue;
                                }
                            }
                            if($freight_status == 1){
                                if($freight_type == 0){ // 运费为计件时
                                    if($num > $one){ // 当购买数量大于首件数量时
                                        $Goods_num_1 = $num - $one;
                                        $freight = $two;
                                        $frequency = ceil($Goods_num_1/$three);
                                        $freight = $four * $frequency + $freight; // 运费
                                    }else{ // 当购买数量低于或等于首件数量时
                                        $freight = $two; // 运费
                                    }
                                }else{ // 运费为计重时
                                    $z_weight = $num * $weight;
                                    if($z_weight > $one){ // 当购买数量大于首件数量时
                                        $z_weight_1 = $z_weight - $one;
                                        $freight = $two;
                                        $frequency = ceil($z_weight_1/$three);
                                        $freight = $four * $frequency + $freight; // 运费
                                    }else{ // 当购买数量低于或等于首件数量时
                                        $freight = $two; // 运费
                                    }
                                }
                            }else{
                                $freight = 0; // 运费
                            }
                        }
                    }

                    $z_freight += $freight;
                }
                return  $z_freight;

    }

        public function freight1($freight,$num,$address,$db)
    {

        $sql = "select * from lkt_freight where id = '$freight'";
        $r_1 = $db->select($sql);
        if($r_1){
            $rule = $r_1[0];
            $yunfei = 0;
            if(empty($address)){
                return 0;
            }else{
                $sheng = $address['sheng'];
                $sql2 = "select G_CName from admin_cg_group where GroupID = '$sheng'";
                $r_2 = $db->select($sql2);

                if($r_2){
                    $city = $r_2[0]->G_CName;
                    $rule_1 = $r_1[0]->freight;
                    $rule_2 = unserialize($rule_1);
                    
                    foreach ($rule_2 as $key => $value) {
                        $citys_str = $value['name'];
                        $citys_array=explode(',',$citys_str);
                        $citys_arrays = [];
                        foreach ($citys_array as $k => $v) {
                            $citys_arrays[$v] = $v;
                        }
                        if(array_key_exists($city , $citys_arrays)){
                            if($num > $value['three']){
                                $yunfei += $value['two']; 
                                $yunfei += ($num-$value['three'])*$value['four']; 
                            }else{
                                $yunfei += $value['two']; 
                            }
                        }
                    }

                    return $yunfei;
                }else{
                   return 0;
                }
            }
        }else{
            return 0;
        }
    }



}

?>