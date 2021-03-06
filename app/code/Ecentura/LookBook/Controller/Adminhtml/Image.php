<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecentura\LookBook\Controller\Adminhtml;
/**
 * Class Beluv
 * @package Ecentura\LookBook\Controller\Adminhtml
 */
abstract class Image extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Ecentura_LookBook::image';
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Beluv constructor.
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
        $resultPage->setActiveMenu('Ecentura_LookBook::product')
            ->addBreadcrumb(__('IMAGE'), __('IMAGE'))
            ->addBreadcrumb(__('image lookbook'), __('image lookbook'));
        return $resultPage;
    }
}