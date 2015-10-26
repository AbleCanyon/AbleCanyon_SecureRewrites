<?php

class AbleCanyon_SecureRewrite_Model_Observer
{
    /**
     * Redirect category and product page requests over ssl to their non-ssl versions.
     *
     * @param Varien_Event_Observer $observer
     * @return AbleCanyon_SecureRewrite_Model_Observer $this
     */
    public function unsecureRewrite(Varien_Event_Observer $observer)
    {
        $action = $observer->getControllerAction();
        $request = $action->getRequest();

        if ($request->isSecure()) {
            $action->getResponse()->setRedirect(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, false) . ltrim($request->getRequestString(), '/'), 301);
            $action->getRequest()->setDispatched(true);
        }

        return $this;
    }
}