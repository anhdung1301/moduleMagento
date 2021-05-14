<?php
namespace Ecentura\GenerateCode\Model\ResourceModel;


class Generate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('ecentura_generate_code', 'id');
    }

}
