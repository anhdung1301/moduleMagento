<?php
/**
 * Copyright 2016 ecentura. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecentura\Customer\Controller\Adminhtml\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action {


    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var CoreRegistry
     */
    protected $coreRegistry;
    protected $customerRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {
        parent::__construct($context);
        $this->coreRegistry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Index action
     */

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */

        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {

                // init model and delete
                $model = $this->_objectManager->create(\Ecentura\Customer\Model\OutletList::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the customer.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a customer to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/index');
    }

}