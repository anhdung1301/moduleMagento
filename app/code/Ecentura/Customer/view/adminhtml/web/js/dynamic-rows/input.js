/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'jquery',
    'Magento_Ui/js/form/element/abstract',
    'ko',
    './select2'
], function ($,Element,ko) {
    'use strict';

    return Element.extend({

        initSearch: function () {
            var self = this;
            setTimeout(function () {
                $('#'+self.uid).select2({
                    minimumInputLength: 3,
                    width: "100%",
                    placeholder: "Search Sku"
                });
            },200);
        },

        getListProduct: function () {
            return Object.values(window.productJson);
        },

        isSelect: function () {
            if(this.initialValue){
                return false;
            }
            return true;
        },

        getProductName: function () {
            return window.productJson[this.initialValue].name;
        },

        setProductName: function (uid) {
            var sku = $('#'+uid).val(),
                inputPrice = $('#'+uid).closest('tr').find('[data-index="price"]').find('input'),
                inputSku = $('#'+uid).closest('tr').find('[data-index="custom_sku"]').find('input');
            $('#'+uid).closest('td').next('td').find('input').val(window.productJson[sku].name_only).trigger('change');
            inputPrice.val(window.productJson[sku].price).trigger('change');
            inputPrice.attr('disabled','disabled');
            inputSku.attr('disabled','disabled');
            $('#'+uid).closest('td').nextUntil('[data-index="actionDelete"]').find('select').val(window.productJson[sku].tax_rate).attr('disabled','disabled').trigger('change');
        }
    });
});
