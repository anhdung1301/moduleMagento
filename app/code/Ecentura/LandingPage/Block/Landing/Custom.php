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
     * Default limit related products
     */
    const LIMIT = '10';

    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

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
     * @param CollectionFactory $productCollectionFactory
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
        CollectionFactory $productCollectionFactory,
        Output $output,
        Data $urlHelper,
        \Ecentura\LandingPage\Helper\Data $helperData,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory;
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

    public function getProductCollection($categoryId)
    {
        $category = $this->_categoryFactory->create()->load($categoryId);
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoryFilter($category);
        $collection->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        $collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $collection->getSelect()->limit(Custom::LIMIT);
        return $collection;
    }


    public function getProductTab(){
        return [
            'tab-1' => $this->getProductCollection($this->helperData->getTabPro('cat_tab1')),
            "tab-2" => $this->getProductCollection($this->helperData->getTabPro('cat_tab2')),
            'tab-3' => $this->getProductCollection($this->helperData->getTabPro('cat_tab3')),
            'tab-4' => $this->getProductCollection($this->helperData->getTabPro('cat_tab4'))
        ];
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
