<?php
class Avik_Specialproduct_Block_New extends Mage_Catalog_Block_Product_List
{
    public function __construct()
    {
		 $this->addData(array(
            'cache_lifetime' => 3600,
            'cache_tags'        => array(Mage_Core_Model_Store::CACHE_TAG, Mage_Cms_Model_Block::CACHE_TAG)
        ));
        parent::__construct();
    }
    public function getModuleName()
    {
        return 'Mage_Catalog';
    }
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $this->_productCollection = $this->getLayer()->getProductCollection();
        }
		$this->_productCollection->getSelect();
		
        return $this->_productCollection;
    }
    public function getLayer()
    {
        $layer = Mage::registry('current_layer');
        if ($layer) {
		
            return $layer;
        }
        return Mage::getSingleton('avik_specialproduct/layer');
    }
}