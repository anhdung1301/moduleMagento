<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ecentura\Customer\Controller\Adminhtml\Index;

use Ecentura\Customer\Model\ResourceModel\OutletList\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Ui\Model\Export\ConvertToCsv;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class Render
 */
class Exportdata extends Action
{
    /**
     * @var ConvertToCsv
     */
    protected $converter;

    /**
     * @var FileFactory
     */
    protected $fileFactory;
    protected $request;
    protected $_collectionFactory;
    /**
     * @var Filter
     */
    private $filter;
    /**
     * @var LoggerInterface
     */
    private $logger;
    protected $customerRepository;

    /**
     * @param Context $context
     * @param ConvertToCsv $converter
     * @param FileFactory $fileFactory
     * @param Filter|null $filter
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        Context $context,
        CollectionFactory $CollectionFactory,
        ConvertToCsv $converter,
        FileFactory $fileFactory,
        Filter $filter = null,
        LoggerInterface $logger = null,
        Filesystem $filesystem,
        Http $request,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository

    )
    {
        parent::__construct($context);
        $this->converter = $converter;
        $this->fileFactory = $fileFactory;
        $this->filter = $filter ?: ObjectManager::getInstance()->get(Filter::class);
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->request = $request;
        $this->_collectionFactory = $CollectionFactory;
        $this->customerRepository = $customerRepository;

    }

    /**
     * Export data provider to CSV
     *
     * @return ResponseInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $data = array();
        if (isset($this->request->getParam('filters')['partitions'])) {
            $filters = $this->request->getParam('filters')['partitions'];

            $data = $this->_collectionFactory->create()->addFieldToFilter('partitions', $filters)->getData();
        } else {
            $data = $this->_collectionFactory->create()->getData();
        }
        $objectManager = ObjectManager::getInstance();

        $heading = [
            __('Name'),
            __('Email'),
            __('Address'),
            __('Telephone')
        ];
        $outputFile = "Export -" . date('Ymd_His') . ".csv";
        $handle = fopen($outputFile, 'w');
        fputcsv($handle, $heading);
        foreach ($data as $value) {
            $customerData = $objectManager->create('Magento\Customer\Model\Customer')->load($value['customer_id']);
            $fullName = $customerData->getFirstname() . " " . $customerData->getLastname();
            $customerAddress = array();

            foreach ($customerData->getAddresses() as $address)
            {
                $customerAddress[] = $address->toArray();
            }
            $dataAddres = '';
            foreach ($customerAddress as $customerAddres) {
                $dataAddres = $customerAddres['street'] . ' ' . $customerAddres['city']  ;
            }
            $row = [
                $fullName,
                $customerData->getEmail(),
                $dataAddres,
                $customerData->getPrimaryBillingAddress()->getTelephone()
            ];
            fputcsv($handle, $row);
        }

        $this->downloadCsv($outputFile);


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
        }
    }
}
