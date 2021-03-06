<?php
namespace Ecentura\Orderattachment\Block\Adminhtml\Order\View\Tab;

use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Store\Model\ScopeInterface;
use Ecentura\Orderattachment\Model\Attachment;

class Attachments extends AbstractOrder implements TabInterface
{
    /**
     * @var \Ecentura\Orderattachment\Helper\Attachment
     */
    protected $attachmentHelper;

    /**
     * @var \Ecentura\Orderattachment\Helper\Attachment
     */
    protected $dataHelper;
   
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param \Ecentura\Orderattachment\Helper\Attachment $attachmentHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        \Ecentura\Orderattachment\Helper\Attachment $attachmentHelper,
        \Ecentura\Orderattachment\Helper\Data $dataHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $registry, $adminHelper, $data);
        $this->attachmentHelper = $attachmentHelper;
        $this->dataHelper = $dataHelper;
        $this->scopeConfig = $scopeConfig;
    }

    public function getOrder()
    {
        return $this->_coreRegistry->registry('current_order');
    }

    public function getAttachmentConfig()
    {
        $config = $this->dataHelper->getAttachmentConfig($this);

        return $config;
    }

    public function getOrderAttachments()
    {
        $orderId = $this->getOrder()->getId();

        return $this->attachmentHelper->getOrderAttachments($orderId);
    }

    public function getUploadUrl()
    {
        return $this->getUrl(
            'orderattachment/attachment/upload',
            ['order_id' => $this->getOrder()->getId()]
        );
    }

    public function getUpdateUrl()
    {
        return $this->getUrl(
            'orderattachment/attachment/update',
            ['order_id' => $this->getOrder()->getId()]
        );
    }

    public function getRemoveUrl()
    {
        return $this->getUrl(
            'orderattachment/attachment/delete',
            ['order_id' => $this->getOrder()->getId()]
        );
    }

    public function getTabLabel()
    {
        return __($this->dataHelper->getTitle());
    }

    public function getTabTitle()
    {
        return __($this->dataHelper->getTitle());
    }

    public function canShowTab()
    {
        return $this->dataHelper->isOrderAttachmentEnabled();
    }

    public function isHidden()
    {
        return false;
    }
}
