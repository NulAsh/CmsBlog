<?php
class NulAsh_CmsBlog_Block_Adminhtml_Record extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_record';
        $this->_blockGroup = 'cmsblog';
        $this->_headerText = $this->__('Manage Records');
        $this->_addButtonLabel = $this->__('Add New Record');
        parent::__construct();
    }
}
