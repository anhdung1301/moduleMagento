<?php
/**
* Copyright 2016 ecentura. All rights reserved.
* See LICENSE.txt for license details.
*/

namespace Ecentura\Customer\Block\Adminhtml\Index\Edit\Button;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Save
 * @package Ecentura\Sales\Block\Adminhtml\Invoice\Edit\Button
 */
class Save implements ButtonProviderInterface
{

    private $helper;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        \Ecentura\Customer\Helper\Customer $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        if(!$this->helper->canCreateInvoice()->getCustomer()){
            return [];
        }
        return [
            'label' => __('Erstellen'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'save']
                ],
                'form-role' => 'save',
            ],
            'sort_order' => 50,
        ];
    }
}
