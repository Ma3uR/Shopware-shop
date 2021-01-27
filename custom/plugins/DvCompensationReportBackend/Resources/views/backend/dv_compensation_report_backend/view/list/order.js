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
            [ me.createToolbarReportButton(), me.createToolbarSlackButton() ]
        );

        return items;
    },

    createToolbarReportButton: function() {
        return Ext.create('Ext.button.Button', {
            text: 'Download PDF report',
            class: 'report',
            listeners: {
                click: function () {
                    print();
                }
            }
        });
    },
    createToolbarSlackButton: function() {
        return Ext.create('Ext.button.Button', {
            text: 'Send slack notice',
            class: 'slack',
            handler: function() {
                Ext.Ajax.request({
                    url: '{url controller=DvCompensationReportBackend action=sendNotice}',
                    method: 'POST',
                    success: function (response, conn) {
                        Shopware.Notification.createGrowlMessage(undefined, 'The notification was sent to slack');
                    },
                    failure: function (response, conn) {
                        alert('fail');
                    }
                })
            }
        })
    }
});


