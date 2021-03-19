<?php


namespace Ecentura\LookBook\Controller\Adminhtml\Image;

use Magento\Backend\App\Action\Context;
use Ecentura\LookBook\Model\ImageFactory;
use Ecentura\LookBook\Model\ImageUploader;

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
     * @var ImageFactory
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'image_id';
    protected $imageUploader;

    /**
     * Save constructor.
     * @param Context $context
     * @param ImageFactory $LookBookFactory
     */
    public function __construct(
        Context $context,
        ImageFactory $imageFactory,
        ImageUploader $imageUploader

    ) {
        $this->imageUploader = $imageUploader;
        $this->modelFactory = $imageFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMessageSuccess()
    {
        return __('save image success');
    }
}