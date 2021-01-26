{extends file='parent:frontend/account/index.tpl'}

{block name="frontend_index_left_categories_wrapper"}{/block}

{* Breadcrumb *}
{block name='frontend_index_start'}
    {$smarty.block.parent}

    {$sBreadcrumb[] = ['name' => 'Compensation report', 'link' => {url}]}
{/block}

{include file="frontend/account/sidebar.tpl"}

{* Main content *}
{block name="frontend_index_content"}
    <div class="content account--content">

        {* Welcome text *}
        {block name="frontend_account_orders_welcome"}
            <div class="account--welcome panel">
                {block name="frontend_account_orders_welcome_headline"}
                    <h1 class="panel--title">Compensation report</h1>
                {/block}

                {block name="frontend_account_orders_sorting"}
                    <form class="action--sort action--content block" method="get" data-action-form="true">
                        <input type="hidden" name="p" value="1">
                        <label for="month" class="sort--label action--label incline">Sorting by month</label>
                        <div class="sort--select select-field">
                            <select id="month" name="month" class="sort--field action--field" data-auto-submit="true">
                                {foreach $options as $id => $label}
                                    <option value="{$id}"{if $month eq $id} selected="selected"{/if}>{$label}</option>
                                {/foreach}
                            </select>
                        </div>
                    </form>
                {/block}

                {block name="frontend_account_orders_welcome_content"}
                    <div class="panel--body is--wide flex flex--center">
                        <p>Here you can find your orders by current month, or select the month you want.</p>
                    </div>
                {/block}

                {if $total}
                    {block name="frontend_account_orders_welcome_content"}
                        <div class="panel--body is--wide">
                            <h2>Total: {$total|currency}</h2>
                        </div>
                    {/block}
                {/if}
            </div>
        {/block}
        {* Orders overview *}
        {block name="frontend_account_orders_overview"}
            <div class="account--orders-overview panel is--rounded">
                {if $orders}
                    {block name="frontend_account_orders_table"}
                        <div class="panel--table">
                            {block name="frontend_account_orders_table_head"}
                                <div class="orders--table-header panel--tr">

                                    {block name="frontend_account_orders_table_head_date"}
                                        <div class="panel--th column--date">Order date</div>
                                    {/block}

                                    {block name="frontend_account_orders_table_head_id"}
                                        <div class="panel--th column--id">Order number</div>
                                    {/block}

                                    {block name="frontend_account_orders_table_head_id"}
                                        <div class="panel--th column--price">Price</div>
                                    {/block}

                                    {block name="frontend_account_orders_table_head_status"}
                                        <div class="panel--th column--status">Status</div>
                                    {/block}
                                </div>
                            {/block}

                            {block name="frontend_account_order_item_overview"}
                                {foreach $orders as $order}
                                    {block name="frontend_account_order_item_overview_row"}
                                        <div class="order--item panel--tr">

                                            {* Order date *}
                                            {block name="frontend_account_order_item_date"}
                                                <div class="order--date panel--td column--date">
                                                    {block name="frontend_account_order_item_date_label"}
                                                        <div class="column--label">
                                                            Order date
                                                        </div>
                                                    {/block}

                                                    {block name="frontend_account_order_item_date_value"}
                                                        <div class="column--value">
                                                            {$order.ordertime|date}
                                                        </div>
                                                    {/block}
                                                </div>
                                            {/block}

                                            {* Order id *}
                                            {block name="frontend_account_order_item_number"}
                                                <div class="order--number panel--td column--id is--bold">
                                                    {block name="frontend_account_order_item_number_label"}
                                                        <div class="column--label">
                                                            Order number
                                                        </div>
                                                    {/block}

                                                    {block name="frontend_account_order_item_number_value"}
                                                        <div class="column--value">
                                                            {$order.ordernumber}
                                                        </div>
                                                    {/block}
                                                </div>
                                            {/block}

                                            {* Dispatch type *}
                                            {block name="frontend_account_order_item_dispatch"}
                                                <div class="order--dispatch panel--td column--dispatch">
                                                    {block name="frontend_account_order_item_dispatch_label"}
                                                        <div class="column--label">
                                                            Price
                                                        </div>
                                                    {/block}

                                                    {block name="frontend_account_order_item_dispatch_value"}
                                                        <div class="column--value">
                                                            {$order.invoice_amount|currency}
                                                        </div>
                                                    {/block}
                                                </div>
                                            {/block}

                                            {* Order status *}
                                            {block name="frontend_account_order_item_status"}
                                                <div class="order--status panel--td column--status">
                                                    {block name="frontend_account_order_item_status_label"}
                                                        <div class="column--label">
                                                            Status
                                                        </div>
                                                    {/block}

                                                    {block name="frontend_account_order_item_status_value"}
                                                        <div class="column--value">
                                                            <span class="order--status-icon status--{$order.status}">&nbsp;</span>
                                                            {if $order.status==0}
                                                                Not Processed
                                                            {elseif $order.status==1}
                                                                In Progress
                                                            {elseif $order.status==2}
                                                                Completed
                                                            {elseif $order.status==3}
                                                                Partially Completed
                                                            {elseif $order.status==4}
                                                                Canceled
                                                            {elseif $order.status==5}
                                                                Ready For Shipping
                                                            {elseif $order.status==6}
                                                                Partially Shipped
                                                            {elseif $order.status==7}
                                                                Shipped
                                                            {elseif $order.status==8}
                                                                Clarification Needed
                                                            {/if}
                                                        </div>
                                                    {/block}
                                                </div>
                                            {/block}
                                        </div>
                                    {/block}
                                {/foreach}
                            {/block}
                        </div>
                    {/block}

                    {block name="frontend_account_orders_actions_paging"}
                        <div class="account--paging panel--paging">
                            {if $sPages.previous}
                                <a href="{$sPages.previous}" class="btn paging--link paging--prev">
                                    <i class="icon--arrow-left"></i>
                                </a>
                            {/if}

                            {foreach $sPages.numbers as $page}
                                {if $page.markup}
                                    <a class="paging--link is--active">{$page.value}</a>
                                    {$sPage=$page.value}
                                {else}
                                    <a href="{$page.link}" class="paging--link">{$page.value}</a>
                                {/if}
                            {/foreach}

                            {if $sPages.next}
                                <a href="{$sPages.next}" class="btn paging--link paging--next">
                                    <i class="icon--arrow-right"></i>
                                </a>
                            {/if}
                        </div>
                    {/block}
                {else}
                    <h3 class="align-center">No orders here</h3>
                {/if}
            </div>
        {/block}
    </div>
{/block}
