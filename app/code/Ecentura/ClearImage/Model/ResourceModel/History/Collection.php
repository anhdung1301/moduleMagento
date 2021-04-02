<?php
namespace Ecentura\ClearImage\Model\ResourceModel\History;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ecentura_history_clear_image_collection';
    protected $_eventObject = 'ecentura_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecentura\ClearImage\Model\History', 'Ecentura\ClearImage\Model\ResourceModel\History');
    }

}
