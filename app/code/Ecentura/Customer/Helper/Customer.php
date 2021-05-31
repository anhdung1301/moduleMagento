<?php
namespace Ecentura\Customer\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\Address\Mapper;
use Magento\Framework\App\RequestInterface;
class Customer extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $request;
    protected $address;
    protected $addressConfig;
    protected $addressMapper;
    protected $customerRepository;
    protected $customer;
    protected $coreRegistry;
    protected $serialize;
    protected $addressModel;
    public function __construct(
        Context $context,
        RequestInterface $request,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Model\Address $addressModel,
        \Magento\Customer\Model\Address\Config $addressConfig,
        Mapper $addressMapper,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Customer $customer,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Serialize\Serializer\Json $serialize
    )
    {
        $this->request = $request;
        $this->address = $addressRepository;
        $this->addressConfig = $addressConfig;
        $this->addressMapper = $addressMapper;
        $this->customer = $customer;
        $this->customerRepository = $customerRepository;
        $this->coreRegistry = $registry;
        $this->serialize = $serialize;
        $this->addressModel = $addressModel;
        parent::__construct($context);
    }

    public function unserialize($string){
        return $this->serialize->unserialize($string);
    }

    public function canCreateInvoice(){
        $return = new \Magento\Framework\DataObject();
        try{
//            $type = 'invoice';
//            $custom = $this->request->getParam('type');
//            if($custom == 'order'){
//                $type = $custom;
//            }

            $customerId = $this->request->getParam('customer');

            $registry = $this->coreRegistry->registry('current_customer');
//            if($registry instanceof \Ecentura\Sales\Model\Invoice || $registry instanceof \Ecentura\Sales\Model\Order){
//                $customerId = $registry->getCustomerId();
//            }
            if(!$customerId){
                $return->setData('customer',false);
                return $return;
            }
            $customer = $this->customerRepository->getById($customerId);
            $billingId = $customer->getDefaultBilling();
            try{

                $address = $this->address->getById($billingId);
                if($addressHtml = $this->getAddressHtml($address)){
                    $return->setData('address',$addressHtml);
                    $return->setData('customer',$customer);
                }
            }
            catch (\Magento\Framework\Exception\LocalizedException $localizedException){
                $return->setData('notice',__('FEHLER: DIESER KUNDE HAT KEINE ADRESSE HINTERLEGT ('.$customer->getFirstname().' '.$customer->getLastname().' - '.$customer->getEmail().')'));
                $return->setData('customer',false);
            }
            return $return;
        }
        catch (\Magento\Framework\Exception\NoSuchEntityException $noSuchEntityException){
            $return->setData('customer',false);
            return $return;
        }
    }

    public function getAddressHtml(\Magento\Customer\Api\Data\AddressInterface $address = null)
    {
        if ($address !== null) {
            /** @var \Magento\Customer\Block\Address\Renderer\RendererInterface $renderer */
            $renderer = $this->addressConfig->getFormatByCode('html')->getRenderer();
            return $renderer->renderArray($this->addressMapper->toFlatArray($address));
        }
        return false;
    }

    public function getCustomerAddress($customer){
        if(!$customer instanceof \Magento\Customer\Api\Data\CustomerInterface){
            $customer = $this->customerRepository->getById($customer);
        }
        $billingId = $customer->getDefaultBilling();
        $address = $this->address->getById($billingId);
        return $address;
    }

    public function getBillingAddress($id){
        return $this->customer->load($id)->getDefaultBillingAddress();
    }
    public function getAddressById($id){
        return $this->addressModel->load($id);
    }
}