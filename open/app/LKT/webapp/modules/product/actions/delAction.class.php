<?php
/**
 * [Laike System] Copyright (c) 2018 laiketui.com
 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.
 */
require_once(MO_LIB_DIR . '/DBAction.class.php');

class delAction extends Action {

    public function getDefaultView() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $admin_id = $this->getContext()->getStorage()->read('admin_id');

        // 接收信息
        $id = $request->getParameter('id'); // 产品id

        $num = 0;
        $id = rtrim($id, ','); // 去掉最后一个逗号
        $id = explode(',',$id); // 变成数组
        $db->begin();
		$r0=0;
		$k0=0;
        foreach ($id as $k => $v){
            $sa= $db->select("select id from lkt_group_product where product_id = $v and recycle = 0 and g_status < 3");//查询该商品是否正在参加拼团活动
            if($sa){
                   $res = array('status' => '2','info'=>'该商品有参与插件活动，无法删除！');
                   $db-> rollback();
                    echo json_encode($res);
            return;

            }
            
            $sql = "delete from lkt_cart where Goods_id = '$v'";
            $db->delete($sql);

            $sql = "delete from lkt_user_footprint where Goods_id = '$v'";
            $db->delete($sql);

            $sql = "delete from lkt_user_collection where Goods_id = '$v'";
            $db->delete($sql);
            // 根据产品id，删除产品信息
            $sql01 = "update lkt_product_list set recycle = 1,status = 1 where id = '$v'";
            $re0=$db->update($sql01);
			if($re0=1){
				$r0++;
			}
			$k0++;	
            $sql = "update lkt_configure set recycle = 1 where pid = '$v'";
            $db->update($sql);

            $sql = "update lkt_product_img set recycle = 1 where product_id = '$v'";
            $db->update($sql);

            $db->admin_record($admin_id,' 删除商品id为 '.$v.' 的信息',3);

        }
		if($k0==$r0){
			$res = array('status' => '1','info'=>'成功！');
			$db-> commit();
			echo json_encode($res);
		}else{
         $db-> rollback();
        }
        return;
    }

    public function execute(){
        return $this->getDefaultView();
    }


    public function getRequestMethods(){
        return Request :: NONE;
    }

}

?>