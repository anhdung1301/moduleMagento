<?php

namespace Ecentura\LookBook\Model\Source;

use Ecentura\LookBook\Model\LookBook;
use Ecentura\LookBook\Model\ResourceModel\LookBook\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Condition
 * @package Ecentura\LookBook\Model\Source
 */
class Location implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var null
     */
    protected $options = null;

    /**
     * Condition constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        $configOptions = $this->collectionFactory->create()
            ->addFieldToFilter('is_active', ['eq' => LookBook::STATUS_ENABLED]);
        if (empty($this->options)) {
            $this->options = $configOptions->toOptionArray();
        }
        return $this->options;
    }
}
