<div id="msMiniCart" class="{$total_count > 0 ? 'full' : ''}">
    <div class="empty px-2">
        {'ms2_minicart_is_empty' | lexicon} <span class="badge badge-light">{$total_count}</span>
    </div>
    <div class="not_empty">
        {foreach $cart as $k => $item}
            <div class="d-flex px-2">
                <div class="media col-10">
                    {if $item.img?}
                        <img class="align-self-center mb-3" src="{$item.img}" alt="{$item.pagetitle}">
                    {else}
                        <img class="mb-product-img mb-3" src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
                             srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
                             alt="{$item.pagetitle}" width="50" />
                    {/if}
                    <div class="media-body">
                        <h6 class="msmcd-product-pagetitle fw-bold">{$item.pagetitle}</h6>
                    </div>
                </div>

                <div class="col-2">
                    <form method="post" class="ms2_form">
                        <input type="hidden" name="key" value="{$k}">
                        <input type="hidden" name="msmcd_id" value="{$item.id}">
                        <button class="btn-close" type="submit" name="ms2_action" value="cart/remove" title="{'msmcd_delete' | lexicon}"></button>
                    </form>
                </div>
            </div>

            {if 'msmcd_change_count_mini_cart' | option}
                <form method="post" id="msmcd-mc-{$item.id}" class="ms2_form">
                    <input type="hidden" name="key" value="{$k}">
                    <input type="hidden" name="msmcd_id" value="{$item.id}">
                    <div class="d-flex justify-content-center">
                        <div class="btn-group">
                            <input type="number" min="0" name="count" value="{$item.count}"
                                   placeholder="0" class="input-sm form-control msmcd-count" />
                        </div>
                        <div class="btn-group">&times;</div>
                        <div class="btn-group"><span>{$item.price}</span></div>
                        <div class="btn-group">=</div>
                        <div class="btn-group"><span>{$item.sum}</span></div>  {'ms2_frontend_currency' | lexicon}
                    </div>
                    <button class="btn btn-default msmcd-action" type="submit"
                            name="ms2_action" value="cart/change" style="display: none;"></button>
                </form>
            {else}
                <div class="px-2">
                    <span>{$item.count}</span> &times; <span>{$item.price}</span> = <span>{$item.sum}</span> {'ms2_frontend_currency' | lexicon}
                </div>
            {/if}
            <div class="dropdown-divider"></div>
        {/foreach}

        {'ms2_minicart_goods' | lexicon} <strong class="ms2_total_count">{$total_count}</strong> {'ms2_frontend_count_unit' | lexicon},
        {'ms2_minicart_cost' | lexicon} <strong class="ms2_total_cost">{$total_cost}</strong> {'ms2_frontend_currency' | lexicon}
    </div>
</div>