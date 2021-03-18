<?php
namespace Ecentura\LookBook\Model\ResourceModel\LookBook;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ecentura_lookbook_product_collection';
    protected $_eventObject = 'lookbook_product_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecentura\LookBook\Model\LookBook', 'Ecentura\LookBook\Model\ResourceModel\LookBook');
    }

}