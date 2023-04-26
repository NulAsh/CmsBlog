<?php
class NulAsh_CmsBlog_Model_Record extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('cmsblog/record');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        $date = Mage::getModel('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setData('date_created', $date);
        }
        $this->setData('date_modified', $date);

        return $this;
    }
}
