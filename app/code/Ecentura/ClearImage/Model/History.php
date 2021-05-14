<?php
namespace Ecentura\ClearImage\Model;
class History extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'ecentura_history_clear_image';

    protected $_cacheTag = 'ecentura_history_clear_image';

    protected $_eventPrefix = 'ecentura_history_clear_image';

    protected function _construct()
    {
        $this->_init('Ecentura\ClearImage\Model\ResourceModel\History');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}