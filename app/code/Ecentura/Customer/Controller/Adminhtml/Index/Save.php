<?php


namespace Ecentura\Customer\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Ecentura\Customer\Model\OutletListFactory;

/**
 * Class Save
 * @package Ecentura\LookBook\Controller\Adminhtml\Index
 */
class Save extends \Ecentura\Customer\Controller\Adminhtml\AbstractSave
{

    /**
     * @var OutletList
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'id';

    /**
     * Save constructor.
     * @param Context $context
     * @param OutletListFactory $LookBookFactory
     */
    public function __construct(
        Context $context,
        OutletListFactory $lookBookFactory
    ) {
        $this->modelFactory = $lookBookFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMessageSuccess()
    {
        return __('You saved the customer.');
    }
}