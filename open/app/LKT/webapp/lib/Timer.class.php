<?php
//转换到HTML

function huodongzhuangtai($db){//监测拼团活动有没有过期的，改变其活动状态
	$rrr=$db -> select("select * from lkt_group_product order by group_id desc");
	// print_r($rrr);die;
	if($rrr){
		foreach ($rrr as $key => $value) {
			$cfg = unserialize($value->group_data);
      // print_r($cfg);
			$starttime = $cfg->starttime;
            $end_time = $cfg->endtime;
            $g_status = $value->g_status;
            $data = date('Y-m-d H:i:s', time());
            if($starttime<$data && $data < $end_time && $g_status == 1){//处理正在进行中的

               $re= $db->select("select lkt_product_list.recycle ,lkt_product_list.status from lkt_group_product,lkt_product_list where group_id = $value->id and lkt_group_product.product_id = lkt_product_list.id");
              if($re){
                  if($re[0]->recycle !=1 && $re[0]->status !=1){
                      $res = $db->update("UPDATE `lkt_group_product` SET `g_status`='2' WHERE id = ".$value->id);
                     
                  }
              }

            }

            if($end_time <$data || $g_status == 3){//处理过期的
              // print_r($value->id);
              // print_r($end_time);
              // print_r($data);die;
  				$res = $db->update("UPDATE `lkt_group_product` SET `g_status`='3' WHERE id = ".$value->id);

  				$r = $db -> select("select * from lkt_group_open where group_id=$value->group_id and ptstatus =1 ");

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

            }
		}
	}
	return;
}


	function is_overdue($db,$group_id){//查询该拼团活动是否过期 1 过期，0 没有
	  $rrr=$db -> select("select * from lkt_group_product where group_id =$group_id ");
        $cfg = unserialize($rrr[0]->group_data);
        $end_time = $cfg->endtime;
        $data = date('Y-m-d H:i:s', time());
        if($rrr[0]->recycle ==1){//活动已删除
            return 1;
        }
        if($end_time<$data){
        	return 1;
        }else{
        	return 0;
        }
   
	}
	function select_num($db,$group_id){//查询该拼团活动拼团人数 
		$man_num = $db -> select("select *  from lkt_group_product where group_id ='$group_id'");
		// print_r($man_num);
		if ($man_num) {
			$biliArr = unserialize($man_num[0]->group_level);
 			foreach ($biliArr as $key => $value) {
                           $groupman = $key;
                            // $KC_arr = explode("~",$value);
                            // $openmoney =($KC_arr[1]*$v->price)/100;//开团 人价格
                            // $canmoney =$KC_arr[0]*$v->price/100;//参团 人价格
                        }
		}else{
			$groupman=0;
		}
		  
        return $groupman?$groupman:0;
		}

function guoqi($db,$group_id){//处理点击停止活动，处理该活动下面所有进行中拼团停止，拼团成功的则不变
    // $res = $db->update("UPDATE `lkt_group_product` SET `g_status`='3' WHERE group_id = ".$group_id);

          $r = $db -> select("select * from lkt_group_open where group_id=$group_id and ptstatus < 2 ");

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
	}
  function addkuncun($db,$size_id,$pid,$num){//取消订单或者取消支付或者过期未付款修改库存
        // 根据商品id,修改商品数量
        $sql_p = "update lkt_configure set  num = num + $num where id = $size_id";
        $r_p = $db->update($sql_p); 
        // 根据商品id,修改卖出去的销量
        $sql_x = "update lkt_product_list set volume = volume - $num,num = num+$num where id = $pid";
        $r_x = $db->update($sql_x); 

  return;
  }

  function delkuncun($db,$size_id,$pid,$num){//创建订单修改库存
        // 根据商品id,修改商品数量
                $sql_p = "update lkt_configure set  num = num - $num where id = $size_id";
                $r_p = $db->update($sql_p); 
                // 根据商品id,修改卖出去的销量
                $sql_x = "update lkt_product_list set volume = volume + $num,num = num-$num where id = $pid";
                $r_x = $db->update($sql_x); 
                // print_r(12412545);die;

  return;
  }

    function up_status($db,$id,$ptcode){//过期修改拼团未成功订单
      $updres = $db -> update("update lkt_group_open set ptstatus=3 where id='$id'");//时间到了拼团未满
      $updres1 = $db -> update( "update lkt_order set status=11,ptstatus = 3 where ptcode='$ptcode'");//订单状态
      // echo "update lkt_order set status=10,ptstatus = 3 where pid='$group_id'";
      $ds =$db -> select("select sNo,z_price,user_id from lkt_order where ptcode='$ptcode'");
      if($ds){
        foreach ($ds as $key => $value) {
          $r_sNo =$value->sNo;
          $updres2 = $db -> update("update lkt_order_details set r_status=11 where r_sNo='$r_sNo'");//订单详情
          $db->update("UPDATE lkt_user SET money =money+$value->z_price WHERE user_id = '".$value->user_id."'");
                  $event = $value->user_id.'退回拼团金额'.$value->z_price.'';
                        $sqlldr = "insert into lkt_record (user_id,money,oldmoney,event,type) values ('$value->user_id','$value->z_price','','$event',5)";
                        
                        // print_r($sqlldr);
                        $beres1 = $db->insert($sqlldr);
        }
      }
      
      return;
  }
      function up_su_status($db,$id,$ptcode){//过期修改拼团成功订单
      $updres = $db -> update("update lkt_group_open set ptstatus=2 where id='$id'");//时间到了拼团未满
      $updres1 = $db -> update( "update lkt_order set status=1,ptstatus = 2 where ptcode='$ptcode'");//订单状态
      $ds =$db -> select("select sNo from lkt_order where ptcode='$ptcode'"); 
      if($ds){
        foreach ($ds as $key => $value) {
          $r_sNo =$value->sNo;
          $updres2 = $db -> update("update lkt_order_details set r_status=1 where r_sNo='$r_sNo'");////订单详情
          // echo "update lkt_order_details set r_status=1 where r_sNo='$r_sNo''";
        }
      }
      return;
  }

?>