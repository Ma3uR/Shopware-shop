//

Ext.define('Shopware.apps.DvCompensationReportBackend', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.DvCompensationReportBackend',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Order',
    ],

    models: [ 'Order' ],
    stores: [ 'Order' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});
