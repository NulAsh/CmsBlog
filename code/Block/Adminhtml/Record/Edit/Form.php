<?php
class NulAsh_CmsBlog_Block_Adminhtml_Record_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('cmsblog_form', array('legend' => $this->__('Record Information')));

        $fieldset->addField('title', 'text', array(
            'label' => $this->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));
        $fieldset->addField('store_id', 'select', array(
            'label' => $this->__('Store View'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'store_id',
            'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
        ));

        $fieldset->addField('content', 'textarea', array(
            'label' => $this->__('Content'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'content',
        ));

        $fieldset->addField('url_key', 'text', array(
            'label' => $this->__('URL Key'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'url_key',
        ));

        $fieldset->addField('is_active', 'select', array(
            'label' => $this->__('Is Active'),
            'name' => 'is_active',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => $this->__('Enabled'),
                ),
                array(
                    'value' => 0,
                    'label' => $this->__('Disabled'),
                ),
            ),
        ));

        if (Mage::getSingleton('adminhtml/session')->getRecordData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getRecordData());
            Mage::getSingleton('adminhtml/session')->setRecordData(null);
        } elseif (Mage::registry('record_data')) {
            $form->setValues(Mage::registry('record_data')->getData());
        }

        return parent::_prepareForm();
    }
}
