<?php

namespace Ecentura\LookBook\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class LookBook extends AbstractModel implements IdentityInterface
{
    const CACHE_LOOKBOOK = 'ecentura_lookbook_product';

    protected $_cachelookbook = 'ecentura_lookbook_product';

    protected $_eventPrefix = 'ecentura_lookbook_product';

    const STATUS_ENABLED =1;
    protected function _construct()
    {
        $this->_init('Ecentura\LookBook\Model\ResourceModel\LookBook');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_LOOKBOOK . '_' . $this->getId()];
    }
}
