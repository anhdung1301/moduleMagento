<?php

namespace Ecentura\LandingPage\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class LoadlandingPage implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollection;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection
    )
    {
        $this->_registry = $registry;
        $this->_categoryCollection = $categoryCollection;
        $this->_storeManager = $storeManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $categoryIdCurrent = $this->_registry->registry('current_category') ? $this->_registry->registry('current_category')->getId() : null;
        $categories = $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->setStore($this->_storeManager->getStore())
            ->addAttributeToFilter('is_landing', '1')
            ->addAttributeToFilter('is_active', '1');
        foreach ($categories as $category) {
            if ($categoryIdCurrent == $category->getID()) {
                $layout = $observer->getLayout();
                $layout->getUpdate()->addHandle('custom_layout');
            }
        }
        return $this;
    }
}