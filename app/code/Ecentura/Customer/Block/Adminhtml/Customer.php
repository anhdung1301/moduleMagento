<?php
namespace Ecentura\Customer\Block\Adminhtml;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Address\Mapper;
class Customer extends \Magento\Config\Block\System\Config\Form\Field {


    protected $customer;
    protected $request;
    protected $helper;
    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\Customer $customer,
        RequestInterface $request,
        \Ecentura\Customer\Helper\Customer $helper,
        \Magento\Framework\Registry $registry,
        array $data = [])
    {
        $this->setTemplate('select_customer.phtml');
        $this->customer = $customer;
        $this->request = $request;
        $this->helper = $helper;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getCustomerCollection(){
        return $this->customer->getCollection();
    }

    public function canShowCustomField(){
        if($this->registry->registry('current_'.$this->getCurrentType())){
            return true;
        }
        return false;
    }
    public function getIsSendEmail(){
        $invoice =  $this->registry->registry('current_'.$this->getCurrentType());
        if($invoice){
            return $invoice->getEmail() == 1;
        }
        return false;
    }
    public function getCurrentType(){
//        $type = $this->getRequest()->getParam('type');
//        return $type ? $type : 'invoice';
        return 'customer';
    }
    public function getCurrentForward(){
        return $this->getRequest()->getParam('forward');
    }
    public function getCurrentEntity(){
        return $this->registry->registry('current_'.$this->getCurrentType());
    }
}