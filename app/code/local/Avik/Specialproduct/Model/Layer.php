<?php
class Avik_Specialproduct_Model_Layer extends Mage_Catalog_Model_Layer
{
    public function getStateKey()
    {
        if ($this->_stateKey === null) {
            $this->_stateKey = 'STORE_'.Mage::app()->getStore()->getId()
                . '_NEW_PRODUCTS_'
                . '_CUSTGROUP_' . Mage::getSingleton('customer/session')->getCustomerGroupId();
        }

        return $this->_stateKey;
    }

    public function getStateTags(array $additionalTags = array())
    {
        $additionalTags = array_merge($additionalTags, array('special_products'));
        return $additionalTags;
    }

    public function getProductCollection()
    {
	
        if (isset($this->_productCollections['special_products'])) {
			
            $collection = $this->_productCollections['special_products'];
        } else {
		
            $collection = $this->_getCollection();
            $this->prepareProductCollection($collection);
            $this->_productCollections['special_products'] = $collection;
        }
	
        return $collection;
    }
    public function prepareProductCollection($collection)
    {
	
        $collection
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite();

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        return $this;
    }
	
    protected function _getCollection()
    {
		 $collection = Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*')->addStoreFilter();
		
		$collection->getSelect()->where('price_index.final_price < price_index.price');
         
		
        return $collection;
    }
	
	
}