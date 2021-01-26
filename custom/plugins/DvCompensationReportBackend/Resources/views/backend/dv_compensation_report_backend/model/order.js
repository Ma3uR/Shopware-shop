
Ext.define('Shopware.apps.DvCompensationReportBackend.model.Order', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'DvCompensationReportBackend',
        };
    },

    fields: [
        { name : 'name', type: 'string', useNull: true},
        { name : 'ordersCount', type: 'int', useNull: true},
        { name : 'sumInvoice', type: 'float', useNull: true},
    ]
});

