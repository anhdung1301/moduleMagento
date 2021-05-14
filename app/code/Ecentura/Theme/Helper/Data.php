<?php

namespace Ecentura\Theme\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper

{
    const XML_PATH_SECTION = "theme/";

    public function getValueCss($group, $field)
    {
        return $this->scopeConfig->getValue(Data::XML_PATH_SECTION . $group . $field, ScopeInterface::SCOPE_STORE);
    }

    public function getImageLogo()
    {
        return $this->scopeConfig->getValue('theme/logo/image', ScopeInterface::SCOPE_STORE);
    }

    public function getCustomCss()
    {
        return $this->scopeConfig->getValue('theme/custom_css/css', ScopeInterface::SCOPE_STORE);
    }
    public function getRatio($field){
        return $this->scopeConfig->getValue('theme/logo/'.$field, ScopeInterface::SCOPE_STORE);

    }
}
