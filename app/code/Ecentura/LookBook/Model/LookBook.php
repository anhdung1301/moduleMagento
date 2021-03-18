<?php

namespace Ecentura\LookBook\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class LookBook extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'ecentura_lookbook_product';

    protected $_cacheTag = 'ecentura_lookbook_product';

    protected $_eventPrefix = 'ecentura_lookbook_product';


    protected function _construct()
    {
        $this->_init('Ecentura\LookBook\Model\ResourceModel\LookBook');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
