<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {
    /*
    时间2018年03月13日
    修改内容：修改首页商品及分类请求数据
    修改人：苏涛
    主要功能：处理小程序首页请求结果
    公司：湖南壹拾捌号网络技术有限公司
     */
    public function getDefaultView() {
        return ;
    }

    public function execute(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $m = addslashes(trim($request->getParameter('m')));
        if($m == 'index'){
            $this->index();
        }elseif ($m == 'get_more') {
            $this->get_more();
        }
        return;
    }

    public function getRequestMethods(){
        return Request :: POST;
    }
    // 获取小程序首页数据
    public function index(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
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
        $title = $r_1[0]->company;
        $logo = $img.$r_1[0]->logo;
        // 查询轮播图,根据排序、轮播图id顺序排列
        $sql = "select * from lkt_banner order by sort,id";
        $r = $db->select($sql);
        $banner = array();
        foreach($r as $k=>$v){
            $result = array();
            $result['id'] = $v->id; // 轮播图id
            $result['image'] = $img . $v->image; // 图片
            $result['url'] = $v->url; // 链接
            $banner[] = $result;
            unset($result); // 销毁指定变量
        }

        $shou = [];
        $sql = "select * from lkt_index_page order by sort desc";
        $r_t = $db->select($sql);
        if($r_t){
            foreach ($r_t as $k => $v) {
                if($v->type == 'category'){
                    $product_class = $v->url;
                    $sql_cs = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.product_class like '%-$product_class-%' and a.status = 0 and a.num >0 group by c.pid  order by a.sort DESC";
                    $r_cs = $db->select($sql_cs);

                    // $cproduct = [];
                    if($r_cs){
                        foreach ($r_cs as $keyc => $valuec) {
                            $valuec->imgurl = $img . $valuec->imgurl;
                            $shou[] = $valuec;
                        }
                    }

                }
            }
        }else{
            $sql_cs = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.status = 0 and a.num >0 group by c.pid  order by a.sort DESC";

                    $r_cs = $db->select($sql_cs);
                    // $cproduct = [];
                    if($r_cs){
                        foreach ($r_cs as $keyc => $valuec) {
                            $valuec->imgurl = $img . $valuec->imgurl;
                            $shou[] = $valuec;
                        }
                    }
            }
            if($shou){
                $key = "id";
                $arr =$shou;
                $tmp_arr =[];
                foreach ($arr as $k => $v) {
                    if (in_array($v->$key, $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                        unset($arr[$k]);
                    } else {
                        $tmp_arr[] = $v->$key;
                    }
                }

                sort($arr);
                $shou=$arr;
            }
        $start=0;
        $pagesize=10;
        $shou = array_slice($shou,$start,$pagesize);
        //查询用户等级判断是否升级
        $distribus = [];
        //列出等级关系
        $distributor = [];
        //查询商品并分类显示返回JSON至小程序
        $sql_c = 'select cid,pname from lkt_product_class where sid=0 and recycle!=1 order by sort desc';
        $r_c = $db->select($sql_c);
        $twoList = [];
        foreach ($r_c as $key => $value) {
            $sql_e = 'select cid,pname,img from lkt_product_class where sid=\''.$value->cid.'\' and recycle!=1 order by sort desc LIMIT 0,10';
            $r_e = $db->select($sql_e);
            $icons=[];
            if($r_e){
                foreach ($r_e as $ke => $ve) {
                    $imgurl = $img . $ve->img;
                    $icons[$ke] = array('id' => $ve->cid,'name' => $ve->pname,'img' => $imgurl);
                }
            }else{
                $icons=[];
            }

            $ttcid = $value->cid;

            $sql_s = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.product_class like '%-$ttcid-%' and a.status = 0 and a.num >0 group by c.pid  order by a.sort DESC LIMIT 0,10";
            $r_s = $db->select($sql_s);
            $product = [];

            $r_s = empty($r_s)? []:($r_s ? $r_s:[]);

            foreach ($r_s as $k => $v) {
                $imgurl = $img .$v->imgurl;
                $pid = $v->id;
                $price =$v->yprice;
                $price_yh =$v->price;
                $product[$k] = array('id' => $v->id,'name' => $v->product_title,'price' => $price,'price_yh' => $price_yh,'imgurl' => $imgurl,'volume' => $v->volume);
            }
            $twoList['0'] = array('id' => '0','name' => '首页','count' => 1,'twodata' => $shou,'distributor'=>$distributor);
            $twoList[$key+1] = array('id' => $value->cid,'name' => $value->pname,'count' => 1,'twodata' => $product,'icons'=>$icons);
        }
        $sql = "select * from lkt_background_color where status = 1";
        $r = $db -> select($sql);
        if($r){
            $bgcolor = $r[0]->color;
        }else{
            $bgcolor = '#FF6347';
        }


        // 查询插件表里,状态为启用的插件
        $sql = "select * from lkt_plug_ins where status = 1 and type = 0 and software_id = 3";
        $plug = $db->select($sql);
        if($plug){
            foreach ($plug as $k => $v) {
                $v->image = $img . $v->image;
                if($v->name == '钱包'){
                    unset($plug[$k]);
                }
                if($v->name == '积分'){
                    unset($plug[$k]);
                }

              
                if(strpos($v->name,'我的客户') !== false){ 
                    // if(!$rfhb){
                        unset($plug[$k]);
                    // }
                }
            }
        }
        $pmd = [];

        $lkt_set_notice = "select id,name from lkt_set_notice order by time desc";
        $notice = [];
        $res_notice= $db -> select($lkt_set_notice);//公告
        if($res_notice){
            foreach ($res_notice as $key => $value) {
               $notice[$key] = array('url' => $value->id, 'title' => $value->name);
            }
        }
        echo json_encode(array('banner'=>$banner,'notice'=>$notice,'djname'=>'','twoList'=>$twoList,'bgcolor'=>$bgcolor,'plug'=>$plug,'title'=>$title,'logo'=>$logo,'list'=>$pmd));
        exit();
        
    }


    // 加载更多商品
    public function get_more(){
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $paegr = trim($request->getParameter('page')); //  '显示位置'
        $index = trim($request->getParameter('index')); //  '分类ID'
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

        if(!$paegr){
            $paegr = 1;
        }
        $start = 10*$paegr;
        $end = 10;
        //查询商品并分类显示返回JSON至小程序
        if($index == 0){
        $sql = "select * from lkt_index_page order by sort desc";
        $r_t = $db->select($sql);
         $product = [];
        if($r_t){
            foreach ($r_t as $k => $v) {
                if($v->type == 'category'){
                    $product_class = $v->url;
                    $sql_cs = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.product_class like '%-$product_class-%' and a.status = 0 and a.num >0 group by c.pid  order by a.sort DESC ";
                    $r_cs = $db->select($sql_cs);

                    if($r_cs){
                        foreach ($r_cs as $keyc => $valuec) {
                            $valuec->imgurl = $img . $valuec->imgurl;
                            $product[] = array('id' => $valuec->id,'product_title' => $valuec->product_title,'price' =>$valuec->yprice,'price_yh' => $valuec->price,'imgurl' => $valuec->imgurl,'volume' => $valuec->volume);
                        }
                    }
                }
            }

        }else{
                $sql_cs = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.status = 0 and a.num >0 group by c.pid  order by a.sort DESC";

                        $r_cs = $db->select($sql_cs);
                        if($r_cs){
                            foreach ($r_cs as $keyc => $valuec) {
                                $valuec->imgurl = $img . $valuec->imgurl;
                                $product[$k] = array('id' => $valuec->id,'product_title' => $valuec->product_title,'price' =>$valuec->yprice,'price_yh' => $valuec->price,'imgurl' => $valuec->imgurl,'volume' => $valuec->volume);
                            }
                        }
        }
        if($product){
                $arr =$product;
                $tmp_arr =[];
                foreach ($arr as $k => $v) {
                    if (in_array($v['id'], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                        unset($arr[$k]);
                    } else {
                        $tmp_arr[] =$v['id'];
                    }
                }
                sort($arr);
                $product=$arr;
            }
        $product = array_slice($product,$start,$end);
         echo json_encode(array('prolist'=>$product,'status'=>1));
                    exit;
        }else if(!$index){
                    echo json_encode(array('prolist'=>[],'status'=>0));
                    exit;
               
        }else{
            //查询商品并分类显示返回JSON至小程序
            $sql_t = "select a.id,a.product_title,a.volume,min(c.price) as price,c.yprice,a.imgurl,c.name from lkt_product_list AS a RIGHT JOIN lkt_configure AS c ON a.id = c.pid where a.num >0 and a.status = 0 and a.product_class like '%-$index-%' group by c.pid  order by a.sort DESC LIMIT $start,$end";
            $r_s = $db->select($sql_t);
            $product = [];
            if($r_s){
            foreach ($r_s as $k => $v) {
                $imgurl = $img .$v->imgurl;/* end 保存*/
                $pid = $v->id;
                $price =$v->yprice;
                $price_yh =$v->price;
                $product[$k] = array('id' => $v->id,'product_title' => $v->product_title,'price' => $price,'price_yh' => $price_yh,'imgurl' => $imgurl,'volume' => $v->volume);
            }
                    echo json_encode(array('prolist'=>$product,'status'=>1));
                    exit;
            }else{
                    echo json_encode(array('prolist'=>$product,'status'=>0));
                    exit;
            }
        }

    }
  public function class_sort($product_class)//根据类别查询下一级
    {
          $db = DBAction::getInstance();
         $typestr=trim($product_class,'-');
            $typeArr=explode('-',$typestr);
            //  取数组最后一个元素 并查询分类名称
            $cid = end($typeArr);//找到本级ID
            $k[] = '-'.$product_class.'-';

            if(!empty($cid)){//循环下一级
                $sql_e = "select cid,pname from lkt_product_class where recycle = 0 and sid = $cid";
                $r_e = $db->select($sql_e);

                if($r_e){
                    foreach ($r_e as $k01 => $v01) {//循环第三级
                        $k[] = '-'.$product_class.'-'.$v01->cid.'-';
                        $sql_e01 = "select cid,pname from lkt_product_class where recycle = 0 and sid = $v01->cid";
                        $r_e01 = $db->select($sql_e01); 

                        if($r_e01){
                            foreach ($r_e01 as $k02 => $v02) {
                                
                               $k[] = '-'.$product_class.'-'.$v01->cid.'-'.$v02->cid.'-';
                            }
                        } 
                    }  
                }
            }
            return $k;
    }
}

?>