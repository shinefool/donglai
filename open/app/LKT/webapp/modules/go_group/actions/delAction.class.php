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
        // 查询插件表

        if(isset($_GET['use']) && $_GET['use'] == 1){
            $this -> delgroup();
        }else if(isset($_GET['use']) && $_GET['use'] == 2){
            $this -> startgroup();
        }else if(isset($_GET['use']) && $_GET['use'] == 3){
            $this -> stopgroup();
        }

        return View :: INPUT;
    }
    public function delgroup() {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $id = addslashes(trim($request->getParameter('id')));
        $db->begin();
        $sql = 'update lkt_group_product set recycle=1 where group_id="'.$id.'"';
        $res = $db -> update($sql);

       $r = $db -> select("select * from lkt_group_open where group_id=$id and ptstatus =1 ");

                if($r){

                    foreach ($r as $key01 => $value01) {
                        // print_r(111);
                         $db->update("UPDATE `lkt_group_open` SET `ptstatus`='3' WHERE id = ".$value01->id);
                         $ee = $db->select("select user_id,z_price,sNo,pay from lkt_order where ptcode = '".$value01->ptcode."'");
                         // print_r($ee);die;
                         if($ee){
                            foreach ($ee as $key02=> $value02) {
                                $db->update("UPDATE `lkt_order_details` SET `r_status`='11' WHERE r_sNo = '".$value02->sNo."'");
                                $db->update("UPDATE lkt_user SET money =money+$value02->z_price WHERE user_id = '".$value02->user_id."'");
                                $event = $value02->user_id.'退回拼团金额'.$value02->z_price.'';
                                 $sqlldr = "insert into lkt_record (user_id,money,oldmoney,event,type) values ('$value02->user_id','$value02->z_price','','$event',5)";
                                $beres1 = $db->insert($sqlldr);
                            }
                         }
                         $db->update("UPDATE `lkt_order` SET `ptstatus`='3', `status`='11' WHERE ptcode = ".$value01->ptcode);
                    }
                }


        $db-> rollback();
        if($res > 0 ){
            echo json_encode(array('status' => 1));exit;
        }
    }

    // public function startgroup() {
    //     $db = DBAction::getInstance();
    //     $request = $this->getContext()->getRequest();
    //     $id = addslashes(trim($request->getParameter('id')));

    //     $sql = 'update lkt_group_buy set is_show=1 where status="'.$id.'"';
    //     $res = $db -> update($sql);
        
    //     if($res > 0){
    //         echo json_encode(array('status' => 1));exit;
    //     }
    // }
    
    // public function stopgroup() {
    //     $db = DBAction::getInstance();
    //     $request = $this->getContext()->getRequest();
    //     $id = addslashes(trim($request->getParameter('id')));

    //     $sql = 'update lkt_group_buy set is_show=0 where status="'.$id.'"';
    //     $res = $db -> update($sql);
        
    //     if($res > 0){
    //         echo json_encode(array('status' => 1));exit;
    //     }
    // }

    public function execute() {

    }

    public function getRequestMethods(){
        return Request :: NONE;
    }

}

?>