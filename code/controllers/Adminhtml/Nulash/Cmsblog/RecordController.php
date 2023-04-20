<?php
class NulAsh_CmsBlog_Adminhtml_Nulash_Cmsblog_RecordController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('cms/blog/records');
        $this->_addBreadcrumb($this->__('CMS'), $this->__('CMS'));
        $this->_addBreadcrumb($this->__('Blog'), $this->__('Blog'));
        $this->_addBreadcrumb($this->__('Manage Records'), $this->__('Manage Records'));
        $this->_addContent($this->getLayout()->createBlock('cmsblog/adminhtml_record'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsblog/record')->load($id);

        if ($model->getId() || $id == 0) {
            Mage::register('record_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('cms/blog/records');
            $this->_addBreadcrumb($this->__('CMS'), $this->__('CMS'));
            $this->_addBreadcrumb($this->__('Blog'), $this->__('Blog'));
            $this->_addBreadcrumb($this->__('Manage Records'), $this->__('Manage Records'));

            $this->_addContent($this->getLayout()->createBlock('cmsblog/adminhtml_record_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Record does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('cmsblog/record');
            $model->setData($data)->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Record was successfully saved'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('cmsblog/record');
                $model->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Record was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cmsblog/records');
    }
}
