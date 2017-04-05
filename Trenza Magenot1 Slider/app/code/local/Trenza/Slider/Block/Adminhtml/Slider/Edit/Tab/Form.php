<?php

class Trenza_Slider_Block_Adminhtml_Slider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('slider')->__('General information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('slider')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
		
      $fieldset->addField('position', 'text', array(
          'label'     => Mage::helper('slider')->__('Position'),
          'required'  => false,
          'name'      => 'position',
      )); 
      
      $data = array();
	  $out = '';
	  if ( Mage::getSingleton('adminhtml/session')->getSliderData() )
		{
			$data = Mage::getSingleton('adminhtml/session')->getSliderData();
		} elseif ( Mage::registry('slider_data') ) {
			$data = Mage::registry('slider_data')->getData();
		}

	  if ( !empty($data['filename']) ) {
		  $url = Mage::getBaseUrl('media') .'slider/' . $data['filename'];
          $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
		  $out .= "<img src=" . $url . " width='250px' />";
		  $out .= '</a></center>';
	  }

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('slider')->__('Image File'),
          'required'  => false,
          'name'      => 'filename',
          'note' => 'Image used for this silde '.$out,
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('slider')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('slider')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('slider')->__('Disabled'),
              ),
          ),
      ));
      
			if (!Mage::app()->isSingleStoreMode()) {
				$fieldset->addField('store_id', 'multiselect', array(
							'name'      => 'stores[]',
							'label'     => Mage::helper('cms')->__('Store View'),
							'title'     => Mage::helper('cms')->__('Store View'),
							'required'  => true,
							'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
					));
			}
			else {
				$fieldset->addField('store_id', 'hidden', array(
						'name'      => 'stores[]',
						'value'     => Mage::app()->getStore(true)->getId()
				));
			}
			
    $fieldset->addField('weblink', 'text', array(
          'label'     => Mage::helper('slider')->__('Web Url'),
          'required'  => false,
          'name'      => 'weblink',
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('slider')->__('Content'),
          'title'     => Mage::helper('slider')->__('Content'),
          'style'     => 'width:280px; height:150px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getsliderData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getsliderData());
          Mage::getSingleton('adminhtml/session')->setsliderData(null);
      } elseif ( Mage::registry('slider_data') ) {
          $form->setValues(Mage::registry('slider_data')->getData());
      }
      return parent::_prepareForm();
  }
}
