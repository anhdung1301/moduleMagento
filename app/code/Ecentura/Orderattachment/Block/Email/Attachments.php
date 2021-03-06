<?php
namespace Ecentura\Orderattachment\Block\Email;

class Attachments extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'email/order/attachments.phtml';

    /**
     * @var \Ecentura\Orderattachment\Helper\Attachment
     */
    protected $attachmentHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ecentura\Orderattachment\Helper\Attachment $attachmentHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecentura\Orderattachment\Helper\Attachment $attachmentHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->attachmentHelper = $attachmentHelper;
    }

    public function getOrderId()
    {
        $order = $this->getData('order');
        if ($order) {
            return $order->getId();
        }
        return false;
    }

    public function getOrderAttachments()
    {
        $order = $this->getData('order');
        if (!$order) {
            return [];
        }
        $quoteId = $order->getQuoteId();

        return $this->attachmentHelper->getOrderAttachments($quoteId, false);
    }
}
