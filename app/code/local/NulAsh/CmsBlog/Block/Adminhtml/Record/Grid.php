<?php
class NulAsh_CmsBlog_Block_Adminhtml_Record_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('cmsblog_record_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('cmsblog/record')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->__('ID'),
            'align'  => 'right',
            'width'  => '50px',
            'index'  => 'id',
        ));

        $this->addColumn('title', array(
            'header' => $this->__('Title'),
            'align'  => 'left',
            'index'  => 'title',
        ));

        $this->addColumn('store_id', array(
            'header' => $this->__('Store ID'),
            'align'  => 'left',
            'index'  => 'store_id',
        ));

        $this->addColumn('content', array(
            'header' => $this->__('Content'),
            'align'  => 'left',
            'index'  => 'content',
        ));

        $this->addColumn('is_active', array(
            'header' => $this->__('Is Active'),
            'align'  => 'left',
            'index'  => 'is_active',
            'type'   => 'options',
            'options' => array(
                0 => $this->__('No'),
                1 => $this->__('Yes'),
            ),
        ));

        $this->addColumn('date_created', array(
            'header' => $this->__('Date Created'),
            'align'  => 'left',
            'index'  => 'date_created',
            'type'   => 'datetime',
        ));

        $this->addColumn('date_modified', array(
            'header' => $this->__('Date Modified'),
            'align'  => 'left',
            'index'  => 'date_modified',
            'type'   => 'datetime',
        ));

        $this->addColumn('action', array(
            'header'   => $this->__('Action'),
            'width'    => '100',
            'type'     => 'action',
            'getter'   => 'getId',
            'actions'  => array(
                array(
                    'caption' => $this->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id',
                ),
                array(
                    'caption' => $this->__('Delete'),
                    'url'     => array('base' => '*/*/delete'),
                    'field'   => 'id',
                    'confirm' => $this->__('Are you sure you want to delete this record?')
                ),
            ),
            'filter'   => false,
            'sortable' => false,
            'index'    => 'stores',
            'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
