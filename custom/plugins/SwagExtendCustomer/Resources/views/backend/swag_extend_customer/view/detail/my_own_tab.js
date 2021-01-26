// This tab will be shown in the customer module
Ext.define('Shopware.apps.SwagExtendCustomer.view.detail.MyOwnTab', {
    extend: 'Ext.container.Container',
    padding: 15,
    title: 'MyOwnTab',

    initComponent: function() {
        var me = this;

        me.items  =  [{
            xtype: 'label',
            html: '<h1>Generate and download compensation report by single user</h1>' +
                '<h2>hello</h2>' +
                '<button>123</button>'
        }];

        me.callParent(arguments);
    }
});
