<?php

/**
 * [Laike System] Copyright (c) 2018 laiketui.com
 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.
 */

require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ServerPath.class.php');

class setproAction extends Action
{


    public function getDefaultView()
    {
        $db = DBAction::getInstance();
        $request = $this->getContext()->getRequest();
        $store_id = $this->getContext()->getStorage()->read('store_id');


        if (isset($_GET['from']) && $_GET['from'] == 'pro') {
            // var_dump($_GET['from']);die;

            $id = $_GET['id'];

            $this->getContext()->getStorage()->write('susu', $id);
            echo json_encode(array('code' => 1));
            exit;

        } else if (isset($_GET['from']) && $_GET['from'] == 'attr') {
            $str = $this->getContext()->getStorage()->read('susu');

            $arr = array();
            $idarr = explode(',', $str);

            $sql = 'select c.*,l.product_title from lkt_configure as c left join lkt_product_list as l on c.pid=l.id where l.store_id = '.$store_id.' and c.pid in (' . $str . ') order by c.pid';

            $res = $db->select($sql);
            $attrid = '';
            foreach ($res as $key => $value) {
                $value->image = ServerPath::getimgpath($value->img,$store_id);
                $attr = unserialize($value->attribute);
                $attr = array_values($attr);
                if($attr){
                 if (gettype($attr[0]) != 'string') unset($attr[0]);
                }
                $value->attr = implode(',', $attr);
                //$arr[] = $value;
            }

            //$this->getContext()->getStorage()->write('prod', $arr);

            $request->setAttribute("arr", $res);
            
            return View :: INPUT;

        }

    }

    public function execute()
    {

        $db = DBAction::getInstance();

        $request = $this->getContext()->getRequest();
        $store_id = $this->getContext()->getStorage()->read('store_id');

        $tuanZ = $request->getParameter('tuanZ');
        $goods_id = $request->getParameter('goods_id');
        
        $this->getContext()->getStorage()->write('tuanZ', $tuanZ);
        $this->getContext()->getStorage()->write('goods_id', $goods_id);
        
        echo json_encode(array('code' => 1));exit;
        
    }

    public function getRequestMethods()
    {
        return Request :: POST;
    }
}
?>