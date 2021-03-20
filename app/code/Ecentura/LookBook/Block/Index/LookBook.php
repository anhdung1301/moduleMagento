<?php

namespace Ecentura\LookBook\Block\Index;

use Ecentura\LookBook\Model\ResourceModel\Image\CollectionFactory as ImageCollection;
use Ecentura\LookBook\Model\ResourceModel\LookBook\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class LookBook extends Template
{
    const  ENABLE = 1;
    protected $_lookbookFactory;
    protected $_imageFactory;
    protected $_registry;
    protected $_storeManager;


    public function __construct(
        Context $context,
        CollectionFactory $lookbookFactory,
        ImageCollection $_imageFactory,
        Registry $registry,
        StoreManagerInterface $storeManager
    )
    {
        $this->_lookbookFactory = $lookbookFactory;
        $this->_imageFactory = $_imageFactory;
        $this->_registry = $registry;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getImageLookBook()
    {
        $product = $this->_registry->registry('current_product');
        $attribute = $product->getlookbook_attribute();
        return $this->_imageFactory->create()
            ->addFieldToFilter('is_active', ['eq' => LookBook::ENABLE])
            ->addFieldToFilter('image_id', ['eq' => $attribute])
            ->getFirstItem()
            ->getData();

    }

    public function getLocationLookBook($location)
    {

        $id = explode(',', $location);
        $listlocation = array();
        foreach ($id as $item) {
            $listlocation[] = $this->_lookbookFactory->create()
                ->addFieldToFilter('is_active', ['eq' => LookBook::ENABLE])
                ->addFieldToFilter('id', ['eq' => $item])
                ->getData();
        }
        return $listlocation;
    }

    public function getURlImage($image)
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl.'ecentura/feature/'.$image;
    }


}