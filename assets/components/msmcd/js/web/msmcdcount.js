(function(window, document, $){
    var msMCDCount = msMCDCount || {};

    msMCDCount.selectors = function() {
        this.$doc = $(document);
        this.countPlusMinus = 'input[name=count]';
        this.keyItem = 'input[name=key]';
        this.msmcdChange = '.msmcd-change';
        this.msmcdAction = '.msmcd-action';
        this.msmcdCount = '.msmcd-count';
    };

    msMCDCount.initialize = function() {
        msMCDCount.selectors();

        // Изменение количества при нажатии
        this.$doc.on('click', this.msmcdChange, function() {
            var v = parseInt($(this).data('msmcdvalue'));
            var selectorForm = '#' +  $(this).closest('form').attr('id');
            var current = $(selectorForm + ' ' + msMCDCount.msmcdCount);
            var c = parseInt(current.val());
            var sum = 0;

            var result = msMCDCount.parseCount(c, v);
            var sendData = {
                action: 'msmcd/chunk',
                ctx: msMCDMiniCart.ctx
            };

            switch (result) {
                case 'add':
                    c = 0;
                    sum = c + v;
                    current.val(sum).submit();
                    msMCDCount.addCart(selectorForm, sum);
                    return;

                case 'remove':
                    current.val( '' ).submit();
                    $(selectorForm + ' ' + msMCDCount.msmcdAction).val('cart/add');
                    setTimeout(function() {
                        msMCDMiniCart.send(sendData);
                    }, 700);
                    return;

                case 'change':
                    sum = c + v;
                    current.val(sum).submit();
                    setTimeout(function() {
                        msMCDMiniCart.send(sendData);
                    }, 700);
                    return;
            }
        });
    };

    msMCDCount.parseCount = function(c, v) {
        if ( isNaN(c) && v == -1 ) {
            return false;
        } else if ( isNaN(c) && v == +1 ) {
            return 'add';
        } else if (c == 1 && v == -1) {
            return 'remove';
        } else {
            return 'change';
        }
    };

    msMCDCount.addCart = function(selectorForm, count) {
        miniShop2.Callbacks.add('Cart.add.response.success', 'msmcdcount_add', function(response) {
            if( response['success'] == true ) {
                $(selectorForm + ' ' + msMCDCount.msmcdCount).val(count);
                $(selectorForm + ' ' + msMCDCount.msmcdAction).val('cart/change');
                $(selectorForm + ' ' + msMCDCount.keyItem).val(response['data']['key']);
            }
        });
    };

    $(document).ready(function ($) {
        msMCDCount.initialize();
    });

    window.msMCDCount = msMCDCount;
}) (window, document, $);
