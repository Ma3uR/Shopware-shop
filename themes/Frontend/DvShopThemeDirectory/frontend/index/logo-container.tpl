{extends file="parent:frontend/index/logo-container.tpl"}

{block name='frontend_index_logo'}
    <div class="logo--shop block">
        {s name="IndexLinkDefault" namespace="frontend/index/index" assign="snippetIndexLinkDefault"}{/s}
        <a class="logo--link flex flex--center" href="{url controller='index'}" title="{"{config name="shopName"}"|escapeHtml} - {$snippetIndexLinkDefault|escape}">
            <picture>
                <source srcset="{link file=$theme.desktopLogo}" media="(min-width: 78.75em)">
                <source srcset="{link file=$theme.tabletLandscapeLogo}" media="(min-width: 64em)">
                <source srcset="{link file=$theme.tabletLogo}" media="(min-width: 48em)">
                <img srcset="{link file=$theme.mobileLogo}" alt="{"{config name="shopName"}"|escapeHtml} - {$snippetIndexLinkDefault|escape}" />
            </picture>
        </a>
    </div>
{/block}

