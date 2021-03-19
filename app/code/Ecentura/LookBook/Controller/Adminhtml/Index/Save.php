<?php


namespace Ecentura\LookBook\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Ecentura\LookBook\Model\LookBookFactory;

/**
 * Class Save
 * @package Ecentura\LookBook\Controller\Adminhtml\Index
 */
class Save extends \Ecentura\LookBook\Controller\Adminhtml\AbstractSave
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ecentura_LookBook::save';
    /**
     * @var LookBookFactory
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'id';

    /**
     * Save constructor.
     * @param Context $context
     * @param LookBookFactory $LookBookFactory
     */
    public function __construct(
        Context $context,
        LookBookFactory $lookBookFactory
    ) {
        $this->modelFactory = $lookBookFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMessageSuccess()
    {
        return __('save location success');
    }
}