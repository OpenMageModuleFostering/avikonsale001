<?php 
class Avik_Specialproduct_Block_Layer_Filter_Decimal extends Mage_Catalog_Block_Layer_Filter_Decimal
{
    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'avik_specialproduct/layer_filter_decimal';
    }
}