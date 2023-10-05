<div id="msmcd-dropdown" class="dropdown" data-msmcddropdown="false">
    <a class="btn btn-secondary dropdown-toggle w-100" href="#" role="button" id="dropdownMiniCart"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {'ms2_minicart' | lexicon}&nbsp;&nbsp; <span class="badge badge-light ms2_total_count">{$total_count}</span>
    </a>

    <div id="mcd-mini-cart" class="dropdown-menu w-100" aria-labelledby="dropdownMiniCart">
        {$output}
    </div>
</div>