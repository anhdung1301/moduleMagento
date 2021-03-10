<?php
namespace Ecentura\Orderattachment\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Ecentura\Orderattachment\Model\Attachment;
use Magento\Store\Model\ScopeInterface;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var \Ecentura\Orderattachment\Model\ResourceModel\Attachment\Collection
     */
    protected $attachmentCollection;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Ecentura\Orderattachment\Model\ResourceModel\Attachment\Collection $attachmentCollection
    ) {
        parent::__construct($context);
        $this->jsonEncoder = $jsonEncoder;
        $this->attachmentCollection = $attachmentCollection;
    }

    /**
     * Get title
     * @return boolean
     */
    public function getTitle()
    {
        $titleValue = $this->scopeConfig->getValue(
            \Ecentura\Orderattachment\Model\Attachment::XML_PATH_ATTACHMENT_ON_ATTACHMENT_TITLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

     
        return (trim($titleValue))?$titleValue:\Ecentura\Orderattachment\Model\Attachment::DEFAULT_TITLE_ATTACHMENT;
    }
    
    /**
     * Get config for order attachments enabled
     * @return boolean
     */
    public function isOrderAttachmentEnabled()
    {
        return (bool)$this->scopeConfig->getValue(
            \Ecentura\Orderattachment\Model\Attachment::XML_PATH_ENABLE_ATTACHMENT,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    /**
     * Get attachment config json
     * @param mixed $block
     * @return string
     */
    public function getAttachmentConfig($block)
    {
        $attachments = $this->attachmentCollection;
        $attachSize = $this->scopeConfig->getValue(
                \Ecentura\Orderattachment\Model\Attachment::XML_PATH_ATTACHMENT_FILE_SIZE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );


        if ($block->getOrder()->getId()) {
            $attachments->addFieldToFilter('quote_id', ['is' => new \Zend_Db_Expr('null')]);
            $attachments->addFieldToFilter('order_id', $block->getOrder()->getId());
        }

        $config = [
            'attachments' => $block->getOrderAttachments(),
            'ecenturaAttachmentLimit' => $this->scopeConfig->getValue(
                \Ecentura\Orderattachment\Model\Attachment::XML_PATH_ATTACHMENT_FILE_LIMIT,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ),
            'ecenturaAttachmentSize' => $attachSize,
            'ecenturaAttachmentExt' => $this->scopeConfig->getValue(
                \Ecentura\Orderattachment\Model\Attachment::XML_PATH_ATTACHMENT_FILE_EXT,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ),
            'ecenturaAttachmentUpload' => $block->getUploadUrl(),
            'ecenturaAttachmentUpdate' => $block->getUpdateUrl(),
            'ecenturaAttachmentRemove' => $block->getRemoveUrl(),
            'ecenturaAttachmentTitle' =>  $this->getTitle(),
            'ecenturaAttachmentInfromation' => $this->scopeConfig->getValue( Attachment::XML_PATH_ATTACHMENT_ON_ATTACHMENT_INFORMATION, ScopeInterface::SCOPE_STORE ),
            'removeItem' => __('Remove Item'),
            'ecenturaAttachmentInvalidExt' => __('Invalid File Type'),
            'ecenturaAttachmentComment' => __('Write comment here'),
            'ecenturaAttachmentInvalidSize' => __('Size of the file is greather than allowed') . '(' . $attachSize . ' KB)',
            'ecenturaAttachmentInvalidLimit' => __('You have reached the limit of files'),
            'attachment_class' => 'ecentura-attachment-id',
            'hash_class' => 'ecentura-attachment-hash',
            'totalCount' => $attachments->getSize()
        ];

        return $this->jsonEncoder->encode($config);
    }
}
