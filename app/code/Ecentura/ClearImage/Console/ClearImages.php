<?php

namespace Ecentura\ClearImage\Console;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearImages extends Command
{
    /**
     * @var ProductFactory
     */
    protected $_productFactory;
    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;
    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * ClearImages constructor.
     * @param ProductFactory $productFactory
     * @param DirectoryList $dir
     * @param Filesystem $fileSystem
     * @param File $file
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        DirectoryList $dir,
        Filesystem $fileSystem,
        File $file,
        CollectionFactory $productCollectionFactory

    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_productFactory = $productFactory;
        $this->_file = $file;   
        $this->fileSystem = $fileSystem;
        parent::__construct($name = null);
        $this->dir = $dir;
    }

    protected function configure()
    {
        $this->setName('ecentura:clearimages');
        $this->setDescription('Delete Unused Catalog Product Images');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $images = $this->getfileInFolder();
        $pathImage = $this->getPathImage($images);
        $countImage = count($pathImage);
        foreach ($pathImage as $url) {
            if ($this->_file->isExists($url)) {
                $this->_file->deleteFile($url);
            }
        }

        $output->writeln('Delete ' . $countImage . ' items');
    }

    public function getfileInFolder()
    {
        $data = $this->getfileImage();
        $path = $this->dir->getPath('media') . '/catalog/product/';
        $images = $this->scd($path);
        $images = array_unique($images);
        foreach ($data as $items) {
            foreach ($images as $key => $value) {
                if (strpos($items, $value)) {
                    unset($images[$key]);
                }
            }
        }
        return $images;
    }

    public function getfileImage()
    {
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

    public function scd($path)
    {
        $di = new RecursiveDirectoryIterator($path);
        $files = [];
        $iterator = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

        $allowed = ['gif', 'jpg', 'jpeg', 'png'];

        foreach ($iterator as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {
                $files[] = $file->getFileName();
            }
        }
        return $files;
    }

    public function getPathImage($namefile)
    {
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
}
