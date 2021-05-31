<?php

namespace Ecentura\Customer\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class OutletList extends AbstractModel implements IdentityInterface
{
    const CACHE_LOOKBOOK = 'ecentura_customer';

    protected $_cachelookbook = 'ecentura_customer';

    protected $_eventPrefix = 'ecentura_customer';

    const STATUS_ENABLED =1;
    protected function _construct()
    {
        $this->_init('Ecentura\Customer\Model\ResourceModel\OutletList');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_LOOKBOOK . '_' . $this->getId()];
    }


}
