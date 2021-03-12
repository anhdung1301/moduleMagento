<?php

namespace Ecentura\LandingPage\Observer;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

class LoadlandingPage implements ObserverInterface
{
    /**
     * @var Registry
     */
    protected $_registry;
    /**
     * @var CollectionFactory
     */
    protected $_categoryCollection;
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;
    public function __construct(
        Registry $registry,
        StoreManagerInterface $storeManager,
        CollectionFactory $categoryCollection
    ) {
        $this->_registry = $registry;
        $this->_categoryCollection = $categoryCollection;
        $this->_storeManager = $storeManager;
    }

    public function execute(Observer $observer)
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
