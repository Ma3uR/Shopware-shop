{extends file="parent:frontend/checkout/confirm.tpl"}

{block name='frontend_checkout_confirm_submit'}
    {if $sPayment.embediframe || $sPayment.action}
        {include file="frontend/checkout/button.tpl"}
    {else}
        <button type="submit" class="btn is--primary is--large right is--icon-right" form="confirm--form" data-preloader-button="true">
            {s name='ConfirmActionSubmit'}{/s}<i class="icon--arrow-right"></i>
        </button>
    {/if}
{/block}

