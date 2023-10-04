<div class="text-center col-12 col-sm-6 col-lg-4 ms2_product">
    <form method="post" id="msmcd-form-{$id}" class="ms2_form mb-card ">
        {if $thumb?}
            <img class="mb-product-img msmcd-img" src="{$thumb}" alt="{$pagetitle}" title="{$pagetitle}"/>
        {else}
            <img class="mb-product-img msmcd-img" src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
                 srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
                 alt="{$pagetitle}" title="{$pagetitle}"/>
        {/if}

        <div class="card-body mb-card-body">
            <h5 class="card-title"><a href="{$id | url}">{$pagetitle}</a></h5>

            <span class="flags">
                {if $new?}
                    <i class="glyphicon glyphicon-flag" title="{'ms2_frontend_new' | lexicon}"></i>
                {/if}
                {if $popular?}
                    <i class="glyphicon glyphicon-star" title="{'ms2_frontend_popular' | lexicon}"></i>
                {/if}
                {if $favorite?}
                    <i class="glyphicon glyphicon-bookmark" title="{'ms2_frontend_favorite' | lexicon}"></i>
                {/if}
            </span>

            <span class="price">
                {$price} {'ms2_frontend_currency' | lexicon}
            </span>
            {if $old_price?}
                <span class="old_price">{$old_price} {'ms2_frontend_currency' | lexicon}</span>
            {/if}
        </div>

        <div class="card-footer">

            {'!msMCDCount' | snippet: [
                'id' => "{$id}"
            ]}

            <input type="hidden" name="id" value="{$id}">
            <input type="hidden" name="options" value="[]">
        </div>

    </form>
</div>