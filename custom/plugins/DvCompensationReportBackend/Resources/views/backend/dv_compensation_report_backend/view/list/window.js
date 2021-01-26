//
Ext.define('Shopware.apps.DvCompensationReportBackend.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : 'User orders listing',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.DvCompensationReportBackend.view.list.Order',
            listingStore: 'Shopware.apps.DvCompensationReportBackend.store.Order'
        };
    }
});
