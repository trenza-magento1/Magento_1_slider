<?php
class Trenza_Slider_Block_Slider extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSlider()     
     { 
        if (!$this->hasData('slider')) {
            $this->setData('slider', Mage::registry('slider'));
        }
        return $this->getData('slider');
        
    }
	
	public function getSliderCollection() {
		$collection = Mage::getModel('slider/slider')->getCollection()
			->addFieldToFilter('status',1);
        
        $collection->getSelect()->order('position');           
		
        $current_store = Mage::app()->getStore()->getId();
		$sliders = array();
		foreach ($collection as $slider) {
            $stores = explode(',',$slider->getStoreId());
			if (in_array(0,$stores) || in_array($current_store,$stores))
				$sliders[] = $slider;
		}
		return $sliders;
	}
	
	public function isShowDescription(){
		return (int)Mage::getStoreConfig('slider/general/show_description');
	}
	
	public function getListStyle(){
		return (int)Mage::getStoreConfig('slider/general/list_style');
	}
}
