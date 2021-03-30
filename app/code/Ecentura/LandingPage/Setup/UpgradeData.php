<?php
namespace Ecentura\LandingPage\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;
use Psr\Log\LoggerInterface;

class UpgradeData implements UpgradeDataInterface {

    private $blockFactory;
    protected $_storeManager;

    public function __construct(
        LoggerInterface $logger,
        BlockFactory $blockFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->blockFactory = $blockFactory;
        $this->_storeManager = $storeManager;
    }
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $url_base = $this->_storeManager->getStore()->getBaseUrl();

        $setup->startSetup();
        $control= '{"mage/tabs": {"openedState": "active", "animate": {"duration": 100}, "active": 0,"disabledState": "disabled"}}';
            $widget1 =' {{widget type="Ecentura\LandingPage\Block\Widget\ShowProduct" product_id="1,2,4,5,6"}}';
            $widget2 =' {{widget type="Ecentura\LandingPage\Block\Widget\ShowProduct" product_id="1,2,4,5,6"}}';
            $widget3 =' {{widget type="Ecentura\LandingPage\Block\Widget\ShowProduct" product_id="6,7,8,9,10,11,12,14"}}';
            $widget4 =' {{widget type="Ecentura\LandingPage\Block\Widget\ShowProduct" product_id="15,23,33,42,51"}}';

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

            <div class=" usp">
                <i class="fa fa-check" aria-hidden="true"></i><span class="usp-head">Gemakkelijk <strong>online bestellen</strong></span>
            </div>

            <div class=" usp">
                <i class="fa fa-check" aria-hidden="true"></i> <span class="usp-head"><strong>Gratis</strong> digitaal ontwerp</span>
            </div>

            <div class=" usp">
                <i class="fa fa-check" aria-hidden="true"></i><span class="usp-head">Snelle levering en service</span>
            </div>

        </div>
    </div>
    <div class="main-subcat">
        <div class="ad_related_pro">
            <div class="raleted_pro_general">
                <div class="raleted_pro_detailds"><a
                        href=""
                        title="Polyester rugzakken bedrukken" class="panel-body">
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
                        href=""
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
                        href=""
                        title="Papieren tassen bedrukken????" class="panel-body">
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

        $listproducts='
<div class="container">
    <div class="container related">
        <div class="col-xs-12">
            <div class="title">Onze top 10 producten</div>
        </div>
        <input type="text" id="top_offset" class="hidden" value="1">
        <div class="product data items"data-mage-init='.$control.'>
            <div class="heading-tabs">
                <div class="item title" data-role="collapsible">
                    <a class="switch" data-toggle="trigger" href="#tab-1">Best verkocht</a>
                </div>
                <div class="item title" data-role="collapsible">
                    <a class="switch" data-toggle="trigger" href="#tab-2">Budget</a>
                </div>
                <div class="item title" data-role="collapsible">
                    <a class="switch" data-toggle="trigger" href="#tab-3">Spoed</a>
                </div>
                <div class="item title" data-role="collapsible">
                    <a class="switch" data-toggle="trigger" href="#tab-4">Kleine oplage</a>
                </div>
            </div>
            <div class="list-product">
                <div id="tab-1" class="item content" data-role="content">
                    '.$widget1.'
                </div>
                <div id="tab-2" class="item content" data-role="content">
                    '.$widget2.'
                </div>
                <div id="tab-3" class="item content" data-role="content">
                    '.$widget3.'
                </div>
                <div id="tab-4" class="item content" data-role="content">
                   '.$widget4.'
                </div>
            </div>
        </div>
    </div>
</div>
';
        if (version_compare($context->getVersion(), '0.0.11') < 0) {
            try{
                $staticBlockInfo = [
                    'title' => 'Landing Page',
                    'identifier' => 'Landing-page-product',
                    'stores' => ['0'],
                    'is_active' => 1,
                    'content' => $listproducts.'<p>{{block class="Ecentura\LandingPage\Block\Landing\Custom" name ="landing-page" template="Ecentura_LandingPage::custom.phtml"}} </p>'
                ];
                $staticBlockListProduct = [
                    'title' => 'slide Landing Page',
                    'identifier' => 'slide-landing-page',
                    'stores' => ['0'],
                    'is_active' => 1,
                    'content' => $banner,
                ];
                $this->blockFactory->create()->setData($staticBlockInfo)->save();
                $this->blockFactory->create()->setData($staticBlockListProduct)->save();
            }catch (Exception $e){
                echo $e->getMessage();
            }
        }

        $setup->endSetup();
    }
}