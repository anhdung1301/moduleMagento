<?php
namespace Ecentura\LookBook\Model\ResourceModel\Image;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'image_id';
    protected $_eventPrefix = 'ecentura_lookbook_Image_collection';
    protected $_eventObject = 'lookbook_image_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecentura\LookBook\Model\Image', 'Ecentura\LookBook\Model\ResourceModel\Image');
    }

}