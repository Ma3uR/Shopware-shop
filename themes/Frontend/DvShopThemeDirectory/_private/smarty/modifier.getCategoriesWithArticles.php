<?php declare(strict_types=1);

use Shopware\Models\Category\Category;

function smarty_modifier_getCategoriesWithArticles($category) {
    return $CategoriesWithArticles = Shopware()->Models()->getRepository(Category::class)->getActiveArticleIdByCategoryId($category->getId());
}
