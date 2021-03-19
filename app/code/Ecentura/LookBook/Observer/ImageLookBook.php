<?php

namespace Ecentura\LookBook\Observer;

    class ImageLookBook implements \Magento\Framework\Event\ObserverInterface
    {
        const ENABLE = 1;
        /**
         * @var \Magento\Framework\Registry
         */


        protected $_registry;

        public function __construct(
            \Magento\Framework\Registry $registry
        )
        {
            $this->_registry = $registry;
        }


        public function execute(\Magento\Framework\Event\Observer $observer)
        {
            $product = $this->_registry->registry('current_product');

            if (!$product){
                return $this;
            }
            if($product->getlookbook_attribute() == ImageLookBook::ENABLE){
                $layout = $observer->getLayout();
                $layout->getUpdate()->addHandle('product_view_customlayout');
            }

            return $this;
        }
    }