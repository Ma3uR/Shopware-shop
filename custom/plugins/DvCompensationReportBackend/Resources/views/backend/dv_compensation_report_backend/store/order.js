//

Ext.define('Shopware.apps.DvCompensationReportBackend.store.Order', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'DvCompensationReportBackend'
        };
    },

    model: 'Shopware.apps.DvCompensationReportBackend.model.Order'
});
