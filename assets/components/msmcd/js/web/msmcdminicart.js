(function( window, document, $, msMCDMiniCartConfig ){
    var msMCDMiniCart = msMCDMiniCart || {};

    msMCDMiniCart.selectors = function() {
        this.outerMC = '#mcd-mini-cart';
        this.ofsetId = '#dropdownMiniCart';
        this.dropdownId = '#msmcd-dropdown';
        this.formId = '#msmcd-form-';
        this.dropdownToggle = '.dropdown-toggle';
        this.imgClacc = '.msmcd-img';
        this.msmcdCountAdd = '#msmcd-count-add';
        this.actionName = 'ms2_action';
        this.action = ':submit[name=' + this.actionName + ']';
        this.productId = 'input[name=msmcd_id]';
        this.countPlusMinus = 'input[name=count]';
        this.msmcdCount = '.msmcd-count';
        this.$doc = $(document);
        this.actionUrl = msMCDMiniCartConfig.actionUrl;
        this.animation = msMCDMiniCartConfig.animate;
        this.drop = msMCDMiniCartConfig.dropdown;
        this.ctx = msMCDMiniCartConfig.ctx;
    };

    msMCDMiniCart.initialize = function() {
        msMCDMiniCart.selectors();
        var k = null;
        // drop down
        this.$doc.on('hidden.bs.dropdown', this.dropdownId, function () {
            $(msMCDMiniCart.dropdownId ).attr('data-msmcddropdown', 'false');
        });
        this.$doc.on('show.bs.dropdown', this.dropdownId, function () {
            $(msMCDMiniCart.dropdownId ).attr('data-msmcddropdown', 'true');
        });
        this.$doc.on("click.bs.dropdown", "body", function (e) {
            e.stopPropagation();
        });
        // Включает анимацию добавления товара
        this.$doc.on('click', this.action + ', ' + this.msmcdCountAdd, function() {
            if ($(this).val() != 'cart/remove') {
                msMCDMiniCart.animationCart(this);
            } else if ($(this).val() == 'cart/remove') {
                k = $(this).closest('form').find(msMCDMiniCart.productId).val();
            }
        });

        // Разрешает ввод в input[name=count] только цифры
        this.$doc.on( 'keypress', this.countPlusMinus, function(b){
            var C = /[0-9\x25\x24\x23\x13]/;
            var a = b.which;
            var c = String.fromCharCode(a);
            return !!(a==0||a==8||a==9||a==13||c.match(C));
        });

        // Ручное изменение количества
        this.$doc.on('change keypress', this.countPlusMinus, function(event) {
            var selectorForm = '#' +  $(this).closest('form').attr('id');
            var current = $(selectorForm + ' ' + msMCDMiniCart.msmcdCount);
            var c = parseInt(current.val());
            var act = $(selectorForm + ' ' + msMCDMiniCart.msmcdAction).val();

            if ( event.which == 13 ) {
                $(this).blur();
                return false;
            } else if (event.type == 'change') {
                $(this).closest(selectorForm).submit();
                if (act == 'cart/add' && c > 0) {
                    msMCDMiniCart.animationCart(this);
                    msMCDCount.addCart(selectorForm, c);
                } else {
                    if ( isNaN(c) || c == 0 ) {
                        $(selectorForm + ' ' + msMCDMiniCart.msmcdAction).val('cart/add');
                        $(selectorForm + ' ' + msMCDMiniCart.keyItem).val('');
                    }
                }

                if ($('.ms2_product .msmcd-count').length) {
                    var id = $(selectorForm + ' ' + msMCDMiniCart.productId).val();
                    $(msMCDMiniCart.formId + id + ' ' + msMCDMiniCart.msmcdCount).val(c);
                }

                var sendData = {
                    action: 'msmcd/chunk',
                    ctx: msMCDMiniCart.ctx
                };
                setTimeout(function() {
                    msMCDMiniCart.send(sendData);
                }, 700);
            }
        });

        miniShop2.Callbacks.add('Cart.add.response.success', 'msmcd_add', function(response) {
            var sendData = {
                action: 'msmcd/chunk',
                ctx: msMCDMiniCart.ctx
            };
            msMCDMiniCart.send(sendData);
        });

        miniShop2.Callbacks.add('Cart.remove.response.success', 'msmcd_remove', function(response) {
            if ($('.ms2_product .msmcd-count').length) {
                $(msMCDMiniCart.formId + k + ' ' + msMCDCount.msmcdCount).val(0);
                $(msMCDMiniCart.formId + k + ' ' + msMCDCount.msmcdAction).val('cart/add');
            }

            var sendData = {
                action: 'msmcd/chunk',
                ctx: msMCDMiniCart.ctx
            };
            msMCDMiniCart.send(sendData);
        });
    };

    msMCDMiniCart.animationCart = function(row) {
        if (msMCDMiniCart.animation) {
            var img = $(row).closest('form').find(msMCDMiniCart.imgClacc);
            var imgOffset = img.offset();
            var cartOffset = $(msMCDMiniCart.ofsetId).offset();

            img.clone()
                .css({
                    'position': 'absolute',
                    'z-index': '9999',
                    'background-size': 'cover',
                    top: imgOffset.top,
                    left: imgOffset.left
                })
                .appendTo('body')
                .animate({
                    left: cartOffset.left,
                    top: cartOffset.top,
                    //width: [ "toggle", "swing" ],
                    //height: [ "toggle", "swing" ],
                    opacity: "toggle"
                }, 1000, function () {
                    $(this).remove();
                });
        }
    };

    msMCDMiniCart.send = function(sendData) {
        $.ajax({
            method: 'POST',
            url: this.actionUrl,
            data: sendData,
            cache: false,
            success: function( res ) {
                var status = $.parseJSON( res );
                if (status.success) {
                    $(msMCDMiniCart.outerMC).html(status.data.tpl);
                    var dropStatus = $(msMCDMiniCart.dropdownId ).attr('data-msmcddropdown');
                    // Открыть мини-корзину
                    if (msMCDMiniCart.drop && dropStatus === 'false') {
                        $(msMCDMiniCart.dropdownId + ' ' + msMCDMiniCart.dropdownToggle).dropdown('toggle');
                        $(msMCDMiniCart.dropdownId ).attr('data-msmcddropdown', 'true');
                    }
                }
            }
        });
    };

    $(document).ready(function ($) {
        msMCDMiniCart.initialize();
    });

    window.msMCDMiniCart = msMCDMiniCart;
})( window, document, jQuery, msMCDMiniCartConfig );
