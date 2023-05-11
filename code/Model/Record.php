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

        // Process URL key
        $urlKey = $this->getData('url_key');
        $urlKey = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $urlKey);
        $urlKey = strtolower(trim($urlKey, '-'));
        $this->setData('url_key', $urlKey);

        return $this;
    }

    public function loadByUrlKey($urlKey)
    {
        $this->_getResource()->loadByUrlKey($this, $urlKey);
        return $this;
    }
}
