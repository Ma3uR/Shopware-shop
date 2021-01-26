<?php

namespace Shopware\Themes\DvShopThemeDirectory;

use Shopware\Components\Form as Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'Responsive';

    protected $name = <<<'SHOPWARE_EOD'
DvShopTheme
SHOPWARE_EOD;

    protected $description = <<<'SHOPWARE_EOD'
The initial theme for dv shop
SHOPWARE_EOD;

    protected $author = <<<'SHOPWARE_EOD'
Andriim
SHOPWARE_EOD;

    protected $license = <<<'SHOPWARE_EOD'
MIT
SHOPWARE_EOD;
    protected $javascript = [
        'src/js/jquery.product-slider.js'
    ];

    public function createConfig(Form\Container\TabContainer $container)
    {
    }
}
