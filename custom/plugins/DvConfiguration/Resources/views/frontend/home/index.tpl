{extends file="parent:frontend/home/index.tpl"}

{block name='frontend_index_content'}
    <div class="category-block flex flex--center">
        {foreach $categories as $category}
            {if $category|getCategoriesWithArticles}
                <h2 class="align-center uppercase">{$category->getName()}</h2>
                {if $category|getProductsByCategory|@count gt 4}
                    <div class="category-block__products product-slider" data-product-slider="false"
                         data-itemMinWidth="26%">
                        <div class="product-slider--container is--horizontal">
                            <a class="product-slider--arrow arrow--next is--horizontal"></a>
                            <a class="product-slider--arrow arrow--prev is--horizontal"></a>
                            {foreach $category|getProductsByCategory as $sArticle}
                                <div class="category-block__products__item product-slider--item">
                                    <div class="category-block__products__item__wrapper">
                                        {block name='frontend_listing_box_article_picture'}
                                        <div class="image--wrapper">
                                            {include file="frontend/listing/product-box/product-image.tpl"}
                                        </div>
                                        {/block}
                                        <div class="category-block__products__info">
                                            {block name='frontend_listing_box_article_name'}
                                                <a href="{$sArticle.linkDetails}"
                                                   class="product--title"
                                                   title="{$sArticle.articleName|escapeHtml}">
                                                    {$sArticle.articleName|truncate:50|escapeHtml}
                                                </a>
                                            {/block}
                                            {block name='frontend_listing_box_article_price_info'}
                                                <div class="product--price-info">
                                                    {* Product price - Unit price *}
                                                    {block name='frontend_listing_box_article_unit'}
                                                        {include file="frontend/listing/product-box/product-price-unit.tpl"}
                                                    {/block}
                                                    {* Product price - Default and discount price *}
                                                    {block name='frontend_listing_box_article_price'}
                                                        {include file="frontend/listing/product-box/product-price.tpl"}
                                                    {/block}
                                                </div>
                                            {/block}
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                {else}
                    <div class="category-block__products flex flex--center flex--between">
                        {foreach $category|getProductsByCategory as $sArticle}
                            <div class="category-block__item-no--slider flex flex--center">
                                {block name='frontend_listing_box_article_picture'}
                                    <div class="image--wrapper">
                                        {include file="frontend/listing/product-box/product-image.tpl"}
                                    </div>
                                {/block}
                                <div class="category-block__products__info">
                                    {block name='frontend_listing_box_article_name'}
                                        <a href="{$sArticle.linkDetails}"
                                           class="product--title"
                                           title="{$sArticle.articleName|escapeHtml}">
                                            {$sArticle.articleName|truncate:50|escapeHtml}
                                        </a>
                                    {/block}
                                    {block name='frontend_listing_box_article_price_info'}
                                        <div class="product--price-info">
                                            {* Product price - Unit price *}
                                            {block name='frontend_listing_box_article_unit'}
                                                {include file="frontend/listing/product-box/product-price-unit.tpl"}
                                            {/block}
                                            {* Product price - Default and discount price *}
                                            {block name='frontend_listing_box_article_price'}
                                                {include file="frontend/listing/product-box/product-price.tpl"}
                                            {/block}
                                        </div>
                                    {/block}
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {/if}
            {/if}
        {/foreach}
    </div>
{/block}
