<?php
namespace Ecentura\Customer\Controller\Adminhtml\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;

class Edit extends \Magento\Backend\App\Action {


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
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Ecentura\Customer\Model\OutletList');
        if ($id) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $model->load($id);
            $customer_id = $model->getcustomer_id();;
            try {
                $customer = $this->customerRepository->getById($customer_id);
            }
            catch (\Magento\Framework\Exception\NoSuchEntityException $e){
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('current_customer',$model);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This customer no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $resultPage = $this->resultPageFactory->create();
        if($model->getId()){
            $resultPage->getConfig()->getTitle()->prepend(__('Customer : '. $customer->getFirstname(). ' '. $customer->getLastname() ));
        }
        else{
            $resultPage->getConfig()->getTitle()->prepend(__('New Customer'));
        }

        return $resultPage;
    }

}