<?php

namespace Ecentura\Theme\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Ecentura\Theme\Helper\Data;
class Themes extends Template
{
    protected $helperData;

    public function __construct(
        Context $context,
        Data $helperData
    )
    {
        $this->helperData = $helperData;
        parent::__construct($context);
    }
    public function getCssHeader($field){
        return $this->helperData->getValueCss('header/',$field);
    }
    public function getCssContent($field){
        return $this->helperData->getValueCss('content/',$field);
    }
    public function getCssFooter($field){
        return $this->helperData->getValueCss('footer/',$field);
    }
    public function LogoImage(){
        return $this->helperData->getImageLogo();
    }
    public function getCss(){
        return $this->helperData->getCustomCss();
    }
    public function getRatio($field){
        return $this->helperData->getRatio($field);
    }
}
