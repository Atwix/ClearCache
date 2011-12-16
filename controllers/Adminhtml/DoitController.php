<?php

class Atwix_ClearCache_Adminhtml_DoitController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        foreach (Mage::app()->getCacheInstance()->getTypes() as $type) {
            $cacheType = $type->getId();
            Mage::app()->getCacheInstance()->cleanType($cacheType);
            Mage::dispatchEvent('adminhtml_cache_refresh_type', array('type' => $cacheType));
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(
            Mage::helper('adminhtml')->__('Cache was cleared.');
        );
        $this->_redirectUrl($this->_getRefererUrl());
    }
}