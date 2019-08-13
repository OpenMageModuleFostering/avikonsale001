<?php
class Avik_Specialproduct_IndexController extends Mage_Core_Controller_Front_Action{    

	protected function _initAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock("content")->setTitle($this->__("Special Offers"));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
		
			$breadcrumbs->addCrumb("home", array(
        "label" => $this->__("Home"),
        "title" => $this->__("Home"),
        "link"  => Mage::getBaseUrl()
           ));

         $breadcrumbs->addCrumb("special-offers", array(
        "label" => $this->__("Special Offers"),
        "title" => $this->__("Special Offers")
           ));
		
        return $this;
  }
    public function indexAction(){
		
		$this->_initAction();
		$this->renderLayout();
    }
	
    
}