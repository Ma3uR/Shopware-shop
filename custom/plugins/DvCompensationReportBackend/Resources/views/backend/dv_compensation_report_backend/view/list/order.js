Ext.define('Shopware.apps.DvCompensationReportBackend.view.list.Order', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    createActionColumnItems: function () {
        var me = this,
            items = me.callParent(arguments);

        return items;
    },

    createToolbarItems: function() {
        var me = this,
            items = me.callParent(arguments);

        items = Ext.Array.insert(
            items,
            2,
            [ me.createToolbarButton() ]
        );

        return items;
    },

    createToolbarButton: function() {
        return Ext.create('Ext.button.Button', {
            text: 'Download PDF report',
            class: 'test',
            listeners: {
                click: function () {
                    print();
                }
            }
        });
    }
});


