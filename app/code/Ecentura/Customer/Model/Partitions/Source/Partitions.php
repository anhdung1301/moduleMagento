<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecentura\Customer\Model\Partitions\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class PageLayout
 */
class Partitions implements OptionSourceInterface
{

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 0,
                'label' => __('bis Euro 1000'),
            ],
            [
                'value' => 1,
                'label' => __('ab 1001 bis 2000 Euro'),
            ],
            [
                'value' => 2,
                'label' => __('mehr als 2000 Euro'),
            ],
        ];
    }
}
