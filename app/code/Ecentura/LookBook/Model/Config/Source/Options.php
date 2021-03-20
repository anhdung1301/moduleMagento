<?php
namespace Ecentura\LookBook\Model\Config\Source;


class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected  $_brand;

    public function __construct(
        \Ecentura\LookBook\Model\Image $location
    ) {
        $this->_location = $location;
    }


    /**
     * Get Gift Card available templates
     *
     * @return array
     */
    public function getAvailableTemplate()
    {
        $locations = $this->_location->getCollection()
            ->addFieldToFilter('is_active', '1');
        $listlocation = array();
        foreach ($locations as $location) {
            $listlocation[] = array('label' => $location->getName(),
                'value' => $location->getId());
        }
        return $listlocation;
    }

    /**
     * Get model option as array
     *
     * @return array
     */
    public function getAllOptions($withEmpty = true)
    {
        $options = array();
        $options = $this->getAvailableTemplate();

        if ($withEmpty) {
            array_unshift($options, array(
                'value' => '',
                'label' => '-- Please Select --',
            ));
        }
        return $options;
    }
}
