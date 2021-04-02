<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecentura\ClearImage\Controller\Adminhtml;
/**
 * Class Clear
 * @package Ecentura\LookBook\Controller\Adminhtml
 */
abstract class Clear extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Ecentura_ClearImage::cleariamge';
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @param $resultPage
     * @return mixed
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Ecentura_ClearImage::claer')
            ->addBreadcrumb(__('CLEARIMAGES'), __('CLEARIMAGES'))
            ->addBreadcrumb(__('clear images'), __('clear images'));
        return $resultPage;
    }
}