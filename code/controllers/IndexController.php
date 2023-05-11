<?php
class NulAsh_CmsBlog_IndexController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        // Get the 'id' parameter from the request
        $recordId = $this->getRequest()->getParam('id');

        // Load the record by its ID
        $record = Mage::getModel('cmsblog/record')->load($recordId);

        // If the record doesn't exist or is not active, forward to the 'noRoute' action
        if (!$record->getId() || !$record->getIsActive()) {
            $this->_forward('noRoute');
            return;
        }

        // Load the layout and set the page title to the record's title
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($record->getTitle());

        // Retrieve the 'cmsblog.view' block from the layout and assign the record to it
        $block = $this->getLayout()->getBlock('cmsblog.view');
        $block->setRecord($record);

        // Render the layout
        $this->renderLayout();
    }
}
