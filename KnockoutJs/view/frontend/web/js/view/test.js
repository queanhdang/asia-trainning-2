define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
 ], function (ko, Component, urlBuilder,storage) {
    'use strict';
    var id=1;
 
    return Component.extend({
 
        defaults: {
            template: 'AHT_KnockoutJs/test',
        },
 
        productList: ko.observableArray([]),
 
        getProduct: function () {
            var self = this;
            var serviceUrl = urlBuilder.build('knockout/test/product?id='+id);
            id ++;
            return storage.post(
                serviceUrl,
                ''
            ).done(
                function (response) {
                    alert('Success');
                    self.productList.push(JSON.parse(response));
                }
            ).fail(
                function (response) {
                    alert(response);
                }
            );
        },
        /**
         * @return {Boolean}
         */
        getClick: function() {
            alert('hoho');
            return true;
        }
 
    });
 });