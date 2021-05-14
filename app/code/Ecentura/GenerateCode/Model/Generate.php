<?php

namespace Ecentura\GenerateCode\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Generate extends AbstractModel implements IdentityInterface
{
    const CACHE_LOOKBOOK = 'ecentura_generate_code';

    protected $_cachelookbook = 'ecentura_generate_code';

    protected $_eventPrefix = 'ecentura_generate_code';

    const STATUS_ENABLED =1;
    protected function _construct()
    {
        $this->_init('Ecentura\GenerateCode\Model\ResourceModel\Generate');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_LOOKBOOK . '_' . $this->getId()];
    }
}
