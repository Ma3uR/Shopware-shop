{extends file="parent:widgets/checkout/info.tpl"}

{block name="frontend_index_checkout_actions_notepad"}
{/block}
{block name="frontend_index_checkout_actions_account"}
    <a href="{url controller='account'}"
       title="{"{if $userInfo}{s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}{$userInfo['firstname']}{s name="AccountGreetingAfter" namespace="frontend/account/sidebar"}{/s} - {/if}{s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}"|escape}"
       aria-label="{"{if $userInfo}{s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}{$userInfo['firstname']}{s name="AccountGreetingAfter" namespace="frontend/account/sidebar"}{/s} - {/if}{s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}"|escape}"
       class="btn is--icon-left entry--link account--link{if $userInfo} account--user-loggedin{/if}">
        <i class="icon--account"></i>
        {if $userInfo}
            <span class="account--display navigation--personalized">
                <span class="account--display-greeting">
                    {s name="AccountGreetingBefore" namespace="frontend/account/sidebar"}{/s}
                    {$userInfo['firstname']}
                </span>
                {s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}
            </span>
        {else}
            <span class="account--display">
                {s namespace='frontend/index/checkout_actions' name='IndexLinkAccount'}{/s}
            </span>
        {/if}
    </a>
{/block}
