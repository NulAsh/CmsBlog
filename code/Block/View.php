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
        if (!$this->hasData('record')) {
            $this->setData('record', Mage::registry('nulash_cmsblog_current_record'));
        }
        return $this->getData('record');
    }
}
