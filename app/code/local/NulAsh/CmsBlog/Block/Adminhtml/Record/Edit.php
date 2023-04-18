<?php
class NulAsh_CmsBlog_Block_Adminhtml_Record_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'cmsblog';
        $this->_controller = 'adminhtml_record';

        $this->_updateButton('save', 'label', $this->__('Save Record'));
        $this->_updateButton('delete', 'label', $this->__('Delete Record'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('record_data') && Mage::registry('record_data')->getId()) {
            return $this->__('Edit Record "%s"', $this->htmlEscape(Mage::registry('record_data')->getTitle()));
        } else {
            return $this->__('Add New Record');
        }
    }
}
