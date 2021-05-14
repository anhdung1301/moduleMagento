<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ecentura\ClearImage\Controller\Adminhtml\Index;

use Ecentura\ClearImage\Model\History;
use Ecentura\ClearImage\Model\HistoryFactory;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Magento\Framework\Filesystem;


class Clear extends \Ecentura\ClearImage\Controller\Adminhtml\Clear implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ecentura_ClearImage::save';
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    protected $_productFactory;
    protected $_productCollectionFactory;
    /**
     * @var HistoryFactory
     */
    private $historyFactory;
    protected $fileSystem;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param HistoryFactory $hisoryFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProductFactory $productFactory,
        PageFactory $resultPageFactory,
        HistoryFactory $hisoryFactory,
        DirectoryList $dir,
        Filesystem $fileSystem,
        \Magento\Framework\Filesystem\Driver\File $file,
        CollectionFactory $productCollectionFactory

    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_productFactory = $productFactory;
        $this->_file = $file;
        $this->fileSystem = $fileSystem;

        $this->historyFactory = $hisoryFactory;
        parent::__construct($context, $coreRegistry);
        $this->dir = $dir;
    }

    /**
     * Edit condition
     *
     * @return ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $images = $this->getfileInFolder();
        $pathImage= $this->getPathImage($images);
        $countImage = count($pathImage);
        foreach ($pathImage as $url){
        if ($this->_file->isExists($url)) {
            $this->_file->deleteFile($url);
        }
    }
        $model = $this->historyFactory->create();
        $data['history'] = 'Delete '. $countImage . ' items';
        $model->setData($data)->save();
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

    public function scd($path)
    {
        $di = new RecursiveDirectoryIterator($path);
        $files = [];
        $iterator = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

        $allowed = ['gif', 'jpg', 'jpeg', 'png'];

        foreach ($iterator as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {
                $files[] = $file->getFileName();;
            }
        }
        return $files;
    }
    public function getPathImage($namefile){
        $path = $this->dir->getPath('media') . '/catalog/product/';
        $di = new RecursiveDirectoryIterator($path);
        $files = [];
        $iterator = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $file) {
            $ext = pathinfo($file, PATHINFO_BASENAME);
            if (in_array($ext, $namefile)) {
                $files[] = $file->getPathName();
            }
        }
        return $files;
    }
    public function getfileImage(){
        $data = [];

        $collection = $this->_productCollectionFactory->create();
        foreach ($collection as $productID) {
            $product = $this->_productFactory->create()->load($productID->getID());
            $productImages = $product->getData('media_gallery');
            foreach ($productImages as $value) {
                foreach ($value as $item){
                    $data[] = $item['file'];
                }
            }
        }
        return $data;
    }
    public function getfileInFolder(){
        $data = $this->getfileImage();
        $path = $this->dir->getPath('media') . '/catalog/product/';
        $images = $this->scd($path);
        $images = array_unique($images);
        foreach ($data as $items) {
            foreach ($images as $key => $value) {
                if (strpos($items, $value) ) {
                    unset($images[$key]);
                }
            }
        }
        return $images;
    }

}
