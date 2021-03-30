<?php


namespace Ecentura\LandingPage\Block\Widget;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Helper\Output;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;
use Magento\Widget\Block\BlockInterface;

class ShowProduct extends ListProduct implements BlockInterface
{
    protected $_productFactory;
    public function __construct(Context $context,
                                PostHelper $postDataHelper,
                                Resolver $layerResolver,
                                ProductFactory $productFactory,
                                Output $output,
                                CategoryRepositoryInterface $categoryRepository,
                                Data $urlHelper, array $data = [])
    {
        $this->_productFactory = $productFactory;
        $this->outputHelper = $output;
        parent::__construct($context, $postDataHelper, $layerResolver,
            $categoryRepository, $urlHelper, $data);
        $this->setTemplate("Ecentura_LandingPage::widget/product.phtml");
    }

    public function getProductInformation(){
        $productId = $this->getProduct_id();
        $productId = preg_replace('/\s+/', '', $productId);

        $id = explode(',',$productId);
        $data = array();
        foreach ($id as $key){
            $data[] = $this->_productFactory->create()->load($key);
        }
            return $data;
    }
    public function getHelper()
    {
        return $this->outputHelper;
    }
    /**
     * @inheritdoc
     */
    public function getMode()
    {
        return 'grid';
    }

    /**
     * @inheritdoc
     */
    public function getToolbarHtml()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAdditionalHtml()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function _beforeToHtml()
    {
        return $this;
    }



}
