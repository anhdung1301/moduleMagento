<?php

namespace Ecentura\LandingPage\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
    protected $_storeManager;
    public function __construct(
        BlockFactory $blockFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->blockFactory = $blockFactory;
        $this->_storeManager = $storeManager;


    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $url_base = $this->_storeManager->getStore()->getBaseUrl();
        $banner = '
        <div class="ad_content_banner">
    <div class="main-banner">
        <div class="main-category">
            <div class="text"><h2>Katoenen tassen bedrukken</h2>
                <ul>
                    <li>Al vanaf <strong>10</strong> stuks voor <strong>€ 45<span>,67</span></strong></li>
                    <li>Leverbaar binnen <strong><span class="delivery-days">4</span> werkdagen</strong></li>
                </ul>
                <a href="'.$url_base.'" class="btn btn-success btn-xl">Katoenen
                    tassen</a></div>
            <img src="https://www.pinkcube.nl/media/homepage/katoenen-tassen.png" title="Katoenen tassen bedrukken">
        </div>
        <div class="mhmr">

            <div class="head">
                <a href="'.$url_base.'"
                   title="Moeiteloos het mooiste resultaat" target="_blank">Moeiteloos het <strong>mooiste
                        resultaat</strong></a>
            </div>

            <div class="row usp">
                <i class="fa fa-check" aria-hidden="true"></i><span class="usp-head">Gemakkelijk <strong>online bestellen</strong></span>
            </div>

            <div class="row usp">
                <i class="fa fa-check" aria-hidden="true"></i> <span class="usp-head"><strong>Gratis</strong> digitaal ontwerp</span>
            </div>

            <div class="row usp">
                <i class="fa fa-check" aria-hidden="true"></i><span class="usp-head">Snelle levering en service</span>
            </div>

        </div>
    </div>
    <div class="row main-subcats">
        <div class="ad_related_pro">
            <div class="raleted_pro_general">
                <div class="raleted_pro_detailds"><a
                            href="'.$url_base.'"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/p/o/polyester-reclame-rugzakje-wit-deco.jpg"
                                    alt="Polyester rugzakken bedrukken" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Polyester rugzakken</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 25 stuks</li> </ul> </span></div>
                        </div>
                        <i class="fa fa-angle-rights" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="raleted_pro_detailds"><a
                            href="'.$url_base.'"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/o/p/opvouwbare-boodschappentas-met-unieke-opvouwfunctie-navy-532c-deco.png"
                                    alt="Opvouwbare boodschappentasjes bedrukken????" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Opvouwbare boodschappentasjes</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 25 stuks</li> </ul> </span></div>
                        </div>
                        <i class="fa fa-angle-rights" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="raleted_pro_detailds"><a
                            href="'.$url_base.'"
                            title="Opvouwbare boodschappentasjes bedrukken" class="panel-body">
                        <div class="cat-img"><img
                                    src="https://www.pinkcube.nl/media/catalog/product/cache/9/small_image/275x/9df78eab33525d08d6e5fb8d27136e95/b/u/budget-papieren-tas-a4-deco.jpg"
                                    alt="Papieren tassen bedrukken????" height="90"></div>
                        <div class="sub-info">
                            <div class="align-middle"><span class="name">Papieren tassen</span> <span
                                        class="sub-caption"> <ul> <li>Al vanaf 50 stuks</li> </ul> </span></div>
                        </div>

                    </a>
                    <i class="fa fa-angle-rights" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

</div>';
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'is_landing', [
                'type' => 'int',
                'label' => 'Landing Page',
                'input' => 'select',
                'source' => Boolean::class,
                'sort_order' => 2,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]

        );


        $cmsBlockData = [
            'title' => 'Landing Page',
            'identifier' => 'Landing-page',
            'content' => $banner.'<p>{{block class="Ecentura\LandingPage\Block\Landing\Custom"  name ="landing-page" template="Ecentura_LandingPage::custom.phtml"}} </p>'.$content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];
        $this->blockFactory->create()->setData($cmsBlockData)->save();
    }
}
