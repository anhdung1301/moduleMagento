<?php

namespace Ecentura\LandingPage\Block\Landing;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Helper\Output;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Registry;
use Magento\Framework\Url\Helper\Data;

/**
 * Class RelatedProduct
 * @package Ecentura\LandingPage\Block\Landing
 */
class Custom extends ListProduct
{
    protected $_categoryFactory;
    protected $helperData;
    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var Output
     */
    protected $outputHelper;
    /**
     * RelatedProduct constructor.
     *
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Output $output
     * @param Data $urlHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        CategoryRepositoryInterface $categoryRepository,
        Output $output,
        Data $urlHelper,
        \Ecentura\LandingPage\Helper\Data $helperData,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->outputHelper = $output;
        $this->helperData = $helperData;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    /**
     * @return Output
     */
    public function getHelper()
    {
        return $this->outputHelper;
    }

    public function getInforCat($ide){
        return $this->helperData->getListcategories($ide);
    }
    public function getCategory($categoryId)
    {
        $category = $this->_categoryFactory->create()->load($categoryId);
        return $category;
    }
    public function list(){
        return [
            'title_list1' => 'cat_list1',
            'title_list2' => 'cat_list2',
            'title_list3' => 'cat_list3'
            ];

    }
    public function getChildren($categoryId)
    {
        $categories = $this->_categoryFactory->create()->load($categoryId)->getChildren();
        if ($categories) {
            $dataChils = array();
            $subcategories = explode(',', $categories);
            foreach ($subcategories as $key => $value) {
                $dataChil[$value] = [
                    'name' => $this->getCategory($value)->getName(),
                    'url' => $this->getCategory($value)->getUrl(),
                    'image'=> $this->getCategory($value)->getImage(),
                    'count_product'=> $this->getCategory($value)->getProductCount(),
                ];
            }
            array_push($dataChils,$dataChil);
            return $dataChils;
        }
    }
    public function getListCat($id){
        return $this->getChildren($id);
    }

}
