<?php
namespace Ecentura\Customer\Model\ResourceModel\OutletList;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ecentura_customer';
    protected $_eventObject = 'ecentura_customer_collection';


    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecentura\Customer\Model\OutletList', 'Ecentura\Customer\Model\ResourceModel\OutletList');
    }
    protected function _initSelect()
    {

        parent::_initSelect();
        $this->getSelect()->join(
            ['customerTable' => $this->getTable('customer_entity')],
            'main_table.customer_id = customerTable.entity_id',
            ['']
        );

        return $this;
    }

}