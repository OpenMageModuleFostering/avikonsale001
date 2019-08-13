<?php

class Avik_Specialproduct_Model_Layer_Filter_Category extends Mage_Catalog_Model_Layer_Filter_Category
{
    protected function _getItemsData(){
       
        
        $key = $this->getLayer()->getStateKey().'_SUBCATEGORIES';
        $data = $this->getLayer()->getAggregator()->getCacheData($key);

        if ($data === null) {
            $categoty   = $this->getCategory();
            $categories = $categoty->getChildrenCategories();

            $this->getLayer()->getProductCollection()
                ->addCountToCategories($categories);

            $data = array();
            foreach ($categories as $category) {
                if ($category->getIsActive() && $category->getProductCount()) {
                    $urlKey = $category->getUrlKey();
                    if (empty($urlKey)) {
                        $urlKey = $category->getId();
                    }
                    
                    $data[] = array(
                        'label' => Mage::helper('core')->htmlEscape($category->getName()),
                        'value' => $urlKey,
                        'count' => $category->getProductCount(),
                    );
                }
            }
            $tags = $this->getLayer()->getStateTags();
            $this->getLayer()->getAggregator()->saveCacheData($data, $key, $tags);
        }
        return $data;
    }

    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock){
       
        $filter = $request->getParam($this->getRequestVar());
        if (!$filter) {
            return $this;
        }

        $this->_appliedCategory = Mage::getModel('catalog/category')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->loadByAttribute('url_key', $filter);

        if (! ($this->_appliedCategory instanceof Mage_Catalog_Model_Category)) {
            return parent::apply($request, $filterBlock);
        }        
        
        $this->_categoryId = $this->_appliedCategory->getId();
        Mage::register('current_category_filter', $this->getCategory(), true);        
        
        if ($this->_isValidCategory($this->_appliedCategory)) {
            $this->getLayer()->getProductCollection()
                ->addCategoryFilter($this->_appliedCategory);

            $this->getLayer()->getState()->addFilter(
                $this->_createItem($this->_appliedCategory->getName(), $filter)
            );
        }

        return $this;
    }
   
}
