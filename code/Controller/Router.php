<?php
class NulAsh_CmsBlog_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    // This method tries to match a custom route
    public function match(Zend_Controller_Request_Http $request)
    {
        // Get the path info from the request and trim any trailing slashes
        $identifier = trim($request->getPathInfo(), '/');

        // Check if the path info starts with 'cms/blog', if not, return false
        if (substr($identifier, 0, 8) !== 'cms/blog') {
            return false;
        }

        // Extract the URL key from the identifier
        $urlKey = substr($identifier, 9);

        // Load the CMS blog record by URL key
        $record = Mage::getModel('cmsblog/record')->loadByUrlKey($urlKey);

        // If the record doesn't exist or is not active, return false
        if (!$record->getId() || !$record->getIsActive()) {
            return false;
        }

        // Set the module name, controller name, action name, and parameters on the request
        $request->setModuleName('cmsblog')
            ->setControllerName('index')
            ->setActionName('view')
            ->setParam('id', $record->getId());

        // Set the request alias to the original path info
        $request->setAlias(Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS, $identifier);

        return true;
    }

    // This method is called to initialize the custom router
    public function initControllerRouters($observer)
    {
        // Get the front controller from the observer
        $front = $observer->getEvent()->getFront();

        // Add the custom router to the front controller
        $front->addRouter('cmsblog', $this);
    }
}
