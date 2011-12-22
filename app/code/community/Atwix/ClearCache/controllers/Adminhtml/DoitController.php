<?php

/**
 * Clear Cache module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Atwix
 * @package    Atwix_ClearCache
 * @copyright  Copyright (c) 2011 Atwix (http://www.atwix.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Alexander Turiak <alex@atwix.com>
 */

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
            Mage::helper('adminhtml')->__('Cache was cleared.')
        );
        $this->_redirectUrl($this->_getRefererUrl());
    }
}