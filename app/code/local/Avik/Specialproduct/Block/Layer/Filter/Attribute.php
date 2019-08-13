<?php 
class Avik_Specialproduct_Block_Layer_Filter_Attribute extends Mage_Catalog_Block_Layer_Filter_Attribute
{
    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'avik_specialproduct/layer_filter_attribute';
    }
}