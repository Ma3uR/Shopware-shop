{extends file="parent:frontend/listing/product-box/product-image.tpl"}

{block name='frontend_listing_box_article_image_picture_element'}
        <img class="product-image"
             srcset="{$sArticle.image.thumbnails[0].sourceSet}"
             alt="{$desc}"
             data-extension="{$sArticle.image.extension}"
             title="{$desc|truncate:160}"
             width="100%"/>
{/block}
