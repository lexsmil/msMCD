<div id="msMiniCart" class="{$total_count > 0 ? 'full' : ''}">
    <div class="empty">
        {'ms2_minicart_is_empty' | lexicon} <span class="badge badge-light">{$total_count}</span>
    </div>
    <div class="not_empty">
        {foreach $cart as $k => $item}
            <div class="clearfix row">
                <div class="media col-10">
                    {if $item.img?}
                        <img class="align-self-center mr-3" src="{$item.img}" alt="{$item.pagetitle}">
                    {else}
                        <img class="mb-product-img" src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
                             srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
                             alt="{$item.pagetitle}" width="50" />
                    {/if}
                    <div class="media-body">
                        <h6 class="mt-0">{$item.pagetitle}</h6>
                    </div>
                </div>

                <div class="col-1">
                    <form method="post" class="ms2_form">
                        <input type="hidden" name="key" value="{$k}">
                        <input type="hidden" name="msmcd_id" value="{$item.id}">
                        <button class="close" type="submit" name="ms2_action" value="cart/remove" title="{'msmcd_delete' | lexicon}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                </div>
            </div>

            {if 'msmcd_change_count_mini_cart' | option}
                <form method="post" id="msmcd-mc-{$item.id}" class="ms2_form">
                    <input type="hidden" name="key" value="{$k}">
                    <input type="hidden" name="msmcd_id" value="{$item.id}">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <input type="text" min="0" name="count" value="{$item.count}"
                                   placeholder="0" class="input-sm form-control msmcd-count" />
                        </div>
                        <div class="btn-group">x</div>
                        <div class="btn-group"><span>{$item.price}</span></div>
                        <div class="btn-group">=</div>
                        <div class="btn-group"><span>{$item.sum}</span></div>
                    </div>
                    <button class="btn btn-default msmcd-action" type="submit"
                            name="ms2_action" value="cart/change" style="display: none;"></button>
                </form>
            {else}
                <div clss="pull-right">
                    <span>{$item.count}</span> x <span>{$item.price}</span> = <span>{$item.sum}</span>
                </div>
            {/if}
            <div class="dropdown-divider"></div>
        {/foreach}

        {'ms2_minicart_goods' | lexicon} <strong class="ms2_total_count">{$total_count}</strong> {'ms2_frontend_count_unit' | lexicon},
        {'ms2_minicart_cost' | lexicon} <strong class="ms2_total_cost">{$total_cost}</strong> {'ms2_frontend_currency' | lexicon}
    </div>
</div>