<?php
class NulAsh_CmsBlog_Model_Resource_Record extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('cmsblog/record', 'id');
    }

    public function loadByUrlKey(NulAsh_CmsBlog_Model_Record $record, $urlKey)
    {
        $adapter = $this->_getReadAdapter();
        $bind = array('url_key' => $urlKey);
        $select = $adapter->select()
            ->from($this->getMainTable())
            ->where('url_key = :url_key');

        $data = $adapter->fetchRow($select, $bind);

        if ($data) {
            $record->setData($data);
        }

        return $this;
    }
}
