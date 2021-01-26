<?php declare(strict_types=1);

use Shopware\Bundle\SearchBundle\Condition\CategoryCondition;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Models\Category\Category;

function smarty_modifier_getProductsByCategory(\Shopware\Models\Category\Category $category) {
    $criteria = new Criteria();
    $criteria->limit(10);
    $criteria->addCondition(new CategoryCondition([$category->getId()]));

    $context = Shopware()->Container()->get('shopware_storefront.context_service')->getShopContext();
    $service = Shopware()->Container()->get('shopware_search.product_number_search');
    $result = $service->search($criteria, $context);

    $productIds = [];
    foreach($result->getProducts() as $product) {
        $productIds[] = $product->getId();
    }

    $products = [];
    foreach ($productIds as $id) {
        $products[] = Shopware()->Modules()->Articles()->sGetArticleById($id);
    }

    return $products;
}

