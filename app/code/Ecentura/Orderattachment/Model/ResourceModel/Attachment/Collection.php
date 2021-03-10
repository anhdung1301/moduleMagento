<?php

namespace Ecentura\Orderattachment\Model\ResourceModel\Attachment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Ecentura\Orderattachment\Model\Attachment', 'Ecentura\Orderattachment\Model\ResourceModel\Attachment');
    }
}
