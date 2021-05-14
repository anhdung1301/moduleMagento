<?php
namespace Ecentura\GenerateCode\Model\ResourceModel\Generate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ecentura_generate_code';
    protected $_eventObject = 'ecentura_generate_code_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecentura\GenerateCode\Model\Generate', 'Ecentura\GenerateCode\Model\ResourceModel\Generate');
    }

}