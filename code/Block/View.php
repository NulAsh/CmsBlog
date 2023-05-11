<?php
class NulAsh_CmsBlog_Block_View extends Mage_Core_Block_Template
{
    public function setRecord($record)
    {
        $this->setData('record', $record);
        return $this;
    }

    public function getRecord()
    {
        return $this->_getData('record');
    }
}
