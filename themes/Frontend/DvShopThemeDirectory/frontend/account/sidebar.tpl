{extends file="parent:frontend/account/sidebar.tpl"}

{block name="frontend_account_menu_greeting"}
    {s name="AccountGreetingBefore"}{/s}
    {$userInfo['firstname']}
{/block}

{block name="frontend_account_menu_list"}
    {block name="frontend_account_menu_link_report"}
        <li class="navigation--entry">
            <a href="{url module='frontend' controller='CompensationReport' action=index}" title="{s name="AccountLinkProfile"}{/s}" class="navigation--link{if {controllerName|lower} == 'account' && $sAction == 'profile'} is--active{/if}" rel="nofollow">
                Compensation report
            </a>
        </li>
    {/block}
    {$smarty.block.parent}
{/block}
