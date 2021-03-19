<?php

namespace Ecentura\LookBook\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class image extends AbstractModel implements IdentityInterface
{
    const CACHE_IMAGE = 'ecentura_lookbook_image';

    protected $_cacheimage = 'ecentura_lookbook_image';

    protected $_eventPrefix = 'ecentura_lookbook_image';

    const STATUS_ENABLED =1;
    protected function _construct()
    {
        $this->_init('Ecentura\LookBook\Model\ResourceModel\Image');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_IMAGE . '_' . $this->getId()];
    }
}
