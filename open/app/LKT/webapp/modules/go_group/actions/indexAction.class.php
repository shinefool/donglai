<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */

require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/ServerPath.class.php');
require_once(MO_LIB_DIR . '/Timer.class.php');
class IndexAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        // $store_id = $this->getContext()->getStorage()->read('store_id');
        $admin_name = $this->getContext()->getStorage()->read('admin_name');
        $proname = $request->getParameter("proname"); // 商品名字
        $username = $request->getParameter("username"); // 用户名字
        $group_status = $request->getParameter("group_status"); // 活动状态
        $group_num = $request->getParameter("group_num"); // 拼团人数
        $status = trim($request->getParameter('status'));
        $pagesize = $request->getParameter('pagesize');
                $pageto = $request -> getParameter('pageto'); 
        $pagesize = $pagesize ? $pagesize : 10;
        // 每页显示多少条数据
        $page = $request->getParameter('page');
        if ($page) {
            $start = ($page - 1) * $pagesize;
        } else {
            $start = 0;
        }
        $whereStr = '';
        //如果名字不为空
        if($proname!=''){
            $whereStr.=" and p_name LIKE '%$proname%' ";
        }
        //如果商品名字不为空
        if($username!=''){
            $whereStr.=" AND user_name LIKE '%$username%' ";
        }
        //如果活动状态不为空
        if($group_status!='' && $group_status!='#'){
            // $whereStr.=" AND gp.g_status = $group_status";
             $whereStr.=" AND a.ptstatus = $group_status";
            
        }
        $rrr = huodongzhuangtai($db);////监测拼团活动有没有过期的，改变其活动状态
        $img = $this->img($db);
        //如果是查看订单
        if($status > 3){
            if($status == 4){
                $type = 'record';
                $sql= "select a.*,b.user_id,b.user_name,c.product_title as p_name,d.sid as attr_id,c.id as goods_id  from lkt_group_open as a,lkt_user as b ,lkt_product_list as c ,lkt_order_details as d  where a.uid = b.wx_id and a.ptgoods_id = c.id and a.sNo= d.r_sNo".$whereStr ." order by a.addtime desc limit $start,$pagesize";
                                // print_r($sql);die;
                $sql1 = "select a.*,b.user_id,b.user_name,c.product_title as p_name,d.sid as attr_id,c.id as goods_id  from lkt_group_open as a,lkt_user as b ,lkt_product_list as c ,lkt_order_details as d  where a.uid = b.wx_id and a.ptgoods_id = c.id and a.sNo= d.r_sNo".$whereStr ." order by a.addtime desc ";
            }else{
                $type = 'canrecord';
                $sql = "SELECT b.*,c.user_name,d.product_title AS p_name,d.product_title, a.ptcode,f.endtime,a.sNo as a,f.sNo as b,b.product_id as goods_id,f.ptstatus
                        FROM lkt_order as a ,lkt_group_product as b,lkt_user as c,lkt_product_list as d,lkt_group_open as f
                        where a.pid = b.group_id and a.user_id = c.user_id and b.product_id = d.id and a.ptcode = f.ptcode and a.sNo <> f.sNo"
                                .$whereStr."
                        ORDER BY f.endtime desc
                        limit $start,$pagesize";
                $sql1 = "SELECT b.*,c.user_name,d.product_title AS p_name, a.ptcode,f.endtime,a.sNo ,f.sNo,f.ptstatus
                        FROM lkt_order as a ,lkt_group_product as b,lkt_user as c,lkt_product_list as d,lkt_group_open as f
                        where a.pid = b.group_id and a.user_id = c.user_id and b.product_id = d.id and a.ptcode = f.ptcode and a.sNo <> f.sNo"
                                .$whereStr."
                        ORDER BY f.endtime desc";
            }
            $res = $db->select($sql);
            $res_all = $db->select($sql1);
            // print_r($res);die;
            if ($res) {
                       //            echo $sql;exit;
                foreach ($res as $k => $v){

            //                查询商品属性
                    $sql = "SELECT price,img from lkt_configure where id = $v->attr_id";
                    $c_res = $db->select($sql);
                    $v->price = $c_res[0]->price;
                    $v->imgurl = $img.$c_res[0]->img;
                        //查询拼团配置
                    $sql = "SELECT * FROM lkt_group_product where  attr_id = $v->attr_id and group_id = $v->group_id";
                    $gp_res = $db->select($sql);
                    if($gp_res){
                        if(!empty($gp_res[0]->group_level)){
                            $biliArr = unserialize($gp_res[0]->group_level);
                            $v->group_title = $gp_res[0]->group_title;
                            if($v->group_title == ''){
                                $v->group_title = $v->p_name;
                            }
                        }
                        $v->openmoney = 0;
                        if(!empty($biliArr)){
                            foreach ($biliArr as $key => $value) {
                               $groupman =$v->groupman= $key;
                                $KC_arr = explode("~",$value);
                                $v->openmoney =($KC_arr[1]*$v->price)/100;//开团 人价格
                                $v->canmoney =$KC_arr[0]*$v->price/100;//参团 人价格
                            }
                           // print_r(121212);die;
                            $cfg = unserialize($gp_res[0]->group_data);
                            $v->start_time = $cfg->starttime;
                            $v->end_time = $cfg->endtime;
                            $start_time = strtotime($v->start_time);
                            $end_time = strtotime($v->end_time);
                            if(time()< $start_time){
                                $v->group_status = 0;
                            }else if(time()> $start_time && time()< $end_time){
                                $v->group_status = 1;
                            }else if(time() > $end_time){
                                $v->group_status = 2;
                            }
                        }else{
                            $v->openmoney =0;//开团 人价格
                            $v->canmoney =0;//参团 人价格
                            $v->start_time = '';
                            $v->end_time = '';
                        }
                    }else{
                        unset($res[$k]);
                    }
                    
                }
            }

            // print_r($res);die;
            $total = count($res_all);
            $pager = new ShowPager($total, $pagesize, $page);
            $url = "index.php?module=go_group&action=index&status=$status&proname=$proname&username=$username&group_num=$group_num&group_status=$group_status&pagesize=" . urlencode($pagesize);
            $pages_show = $pager->multipage($url, $total, $page, $pagesize, $start, $para = '');
            // print_r($res);die;
            $request->setAttribute("list",$res);
            $request->setAttribute("type",$type);
            $request->setAttribute("status",$status);
            $request->setAttribute("proname",$proname);
            $request->setAttribute("group_num",$group_num);
            $request->setAttribute("group_status",$group_status);
            $request->setAttribute("username",$username);
            $request->setAttribute("pages_show",$pages_show);
            return View :: INPUT;

        }
        
        // 导出

        if($pageto == 'all'){             //导出数据
            $sql = "select * from lkt_group_product";
            $res = $db -> select($sql);
            $db->admin_record($store_id,$admin_name,' 导出用户列表全部数据 ',4);
            $request->setAttribute("list",$res);
            $request->setAttribute("pageto",$pageto);
            return View :: INPUT;
        }
        $and = "g.recycle = 0  ";
        if($group_status){
            $and .= " and g.g_status=$group_status";
        }
        if($proname != ''){
            $and .= " and p.product_title like '%$proname%'";
        }

        // 查询插件表
        $sql = "select *
                from lkt_group_product as g 
                left join lkt_product_list as p on g.product_id=p.id 
                left join lkt_configure as c on g.attr_id=c.id 
                where $and" . " 
                group by g.group_id 
                order by g.id desc limit $start,$pagesize";
                // print_r($sql);die;
        $res = $db -> select($sql);
        $res1 = $db -> select("select *
                from lkt_group_product as g 
                left join lkt_product_list as p on g.product_id=p.id 
                left join lkt_configure as c on g.attr_id=c.id 
                where $and" . " 
                group by g.group_id 
                order by g.id desc ");

        if($res){
            foreach ($res as $k => $v) {
                $group_data = unserialize($v -> group_data);
                $group_level = unserialize($v -> group_level);
                
                    $min_man = 1;
                    $min_bili = 100;
                    foreach ($group_level as $k_ => $v_){
                        $biliArr = explode('~',$v_);
                            if($biliArr[0] < $min_bili){
                                $min_man = $k_;
                                $min_bili = $biliArr[0];
                            }
                    }
                $v->min_man = $min_man;
                $min_price = $min_bili * $v->price / 100;
                $v->min_price = sprintf("%.2f", $min_price);
                $str = '';
                foreach ($group_level as $key => $value) {
                    $arr = explode('~', $value);
                    $str .= '<div><span class="tored">' . $key . '</span>人团,价:参 <span class="tored">' . $arr[0] . '%</span> ,开 <span class="tored">' . $arr[1] . '%</span></div>';
                }
                $v -> group_level = $str;
                $v -> starttime = $group_data -> starttime;
                if ($group_data -> endtime =='changqi') {
                    $dt=$group_data -> starttime;
                    $dt=date('Y-m-d H:i:s',strtotime("$dt+1year"));
                    
                    $v -> endtime = $dt;
                }else{
                    $v -> endtime = $group_data -> endtime;
                }
                
                $v -> actime = $group_data -> starttime . ' <br> ' .  $v -> endtime;
                $v -> imgurl = $img.$v->imgurl;
            }

        }

        $total = count($res1);  
        $pager = new ShowPager($total, $pagesize, $page);
        $url = "index.php?module=go_group&action=index&proname=" . urlencode($proname) . "&pagesize=" . urlencode($pagesize);
        $pages_show = $pager->multipage($url, $total, $page, $pagesize, $start, $para = '');
        // print_r($res);die;
        $request->setAttribute("list",$res);
        $request->setAttribute("pageto",$pageto);     
        $request->setAttribute("status",$status);
        $request->setAttribute("proname",$proname);
        $request->setAttribute("pages_show",$pages_show);
        $request->setAttribute("group_status",$group_status);

        return View :: INPUT;
    }
    
    public function execute() {

    }

    public function getRequestMethods(){
        return Request :: NONE;
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