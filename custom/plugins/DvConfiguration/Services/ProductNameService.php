<?php declare(strict_types=1);

namespace DvConfiguration\Services;

class ProductNameService
{
    public function getCategories()
    {
        $category = Shopware()->Models()->getRepository('Shopware\Models\Category\Category')->findAll();
        unset($category[0]);
        unset($category[1]);
        return $category;
    }
}
