<?php

/**

 * [Laike System] Copyright (c) 2018 laiketui.com

 * Laike is not a free software, it under the license terms, visited http://www.laiketui.com/ for more details.

 */
class kaituanInputView extends SmartyView {
    public function execute() {
		$request = $this->getContext()->getRequest();
			$this->setAttribute("list",$request->getAttribute("list"));
		$this->setAttribute("is_show",$request->getAttribute("is_show"));
		$this->setAttribute("status",$request->getAttribute("status"));
		$this->setAttribute("pages_show",$request->getAttribute("pages_show"));
		$this->setAttribute("product_title",$request->getAttribute("product_title"));
		$this->setAttribute("user",$request->getAttribute("user"));
		$this->setTemplate("kaituan.tpl");
    }
}
?>
