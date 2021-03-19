<?php
namespace Ecentura\LookBook\Block\Index;
use Ecentura\LookBook\Model\LookBook as LookbookModel;

class LookBook extends \Magento\Framework\View\Element\Template
{
    protected $_lookbookFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecentura\LookBook\Model\ResourceModel\LookBook\CollectionFactory $lookbookFactory
    )
    {
        $this->_lookbookFactory = $lookbookFactory;
        parent::__construct($context);
    }

    public function getPostCollection(){
        return $this->_lookbookFactory->create()
        ->addFieldToFilter('is_active', ['eq' => 1])->getData();

    }
}