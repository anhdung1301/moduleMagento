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
}