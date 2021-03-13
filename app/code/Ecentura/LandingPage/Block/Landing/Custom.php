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
     * @var \Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory
     */
    protected $_collectionFactory;

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
        CategoryRepositoryInterface $categoryRepository,
        CollectionFactory $productCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory $collectionFactory,

        Output $output,
        Data $urlHelper,
        array $data = []
    ) {
        $this->_registry = $registry;

        $this->_productCollectionFactory = $productCollectionFactory;
        $this->outputHelper = $output;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    /**
     * @return Output
     */
    public function getHelper()
    {
        return $this->outputHelper;
    }

    /**
     * @return mixed
     */
    public function hasProduct()
    {
        $collection = $this->_getProductCollection();

        return $collection->getSize();
    }

    /**
     * @return mixed
     * get ProductCollection in same brand ( filter by Atrribute Option_Id )
     */
    public function _getProductCollection()
    {
        if ($this->_productCollection === null) {
            $postId = $this->getRequest()->getParam('id');
            $collection = $this->_productCollectionFactory->create()
                ->addAttributeToSelect('*')
                ->addStoreFilter();
            $collection->getSelect()
//                ->join(
//                    ['product_post' => $collection->getTable('sm_blog_post_product')],
//                    'e.entity_id = product_post.entity_id'
//                )
//                ->where('product_post.post_id = ' . $postId)
//                ->order('product_post.position ASC')
                ->limit((int)self::LIMIT);

            $this->_productCollection = $collection;
        }
        return $this->_productCollection;
    }

    /**
     * @return mixed
     */
    public function getBestSellerData()
    {
        $category_ids = $this->_registry->registry('current_category') ? $this->_registry->registry('current_category')->getId() : null;
        $bestSellerProdcutCollection = $this->_collectionFactory->create()
            ->setModel('Magento\Catalog\Model\Product')
            ->setPeriod('month')
            ->join(['secondTable' => 'catalog_category_product'], 'sales_bestsellers_aggregated_monthly.product_id = secondTable.product_id', ['category_id' => 'secondTable.category_id'])
            ->addFieldToFilter('category_id', $category_ids);

        return $bestSellerProdcutCollection;
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
