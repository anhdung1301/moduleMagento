<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ecentura\GenerateCode\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Download extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;
    protected $generateFactory;
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        \Ecentura\GenerateCode\Model\GenerateFactory $generateFactory

    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->generateFactory = $generateFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $sum = $this->getRequest()->getParam('number');
        $this->generateFactory->create()->getCollection()->getData();
        $dbGenerate = $this->generateFactory->create()->getCollection()->getData();

        $datas = explode(";", $this->generateCode($sum));
        $datas = array_filter($datas);
        foreach ($datas as $key => $values) {
            foreach ($dbGenerate as $value){
                if($value['code'] == $values){
                   $datas[$key] = $this->ramdom();
                }
            }
        }
        $heading = [
            __('code'),
        ];
        $outputFile = "Code" . date('Y-m-d') . ".csv";
        $handle = fopen($outputFile, 'w');
        fputcsv($handle, $heading);
        foreach ($datas as $data) {
            $db['code']=$data;
            $this->generateFactory->create()->setData( $db)->save();
            $row = [
                $data
            ];
            fputcsv($handle, $row);
        }
        $this->downloadCsv($outputFile);
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

    public function generateCode($sum)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($j = 0; $j < $sum; $j++) {
            for ($i = 0; $i < 7; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $randomString .= ';';
        }
        return $randomString;
    }

    public function downloadCsv($file)
    {
        if (file_exists($file)) {
            //set appropriate headers
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit();
        }
    }

    public function ramdom()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}