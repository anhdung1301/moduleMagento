<?php
namespace Ecentura\LookBook\Model\ResourceModel;


class Image extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('ecentura_lookbook_image', 'image_id');
    }

}
