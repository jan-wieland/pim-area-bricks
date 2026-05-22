document.addEventListener(pimcore.events.pimcoreReady, function () {
  pimcore.asset.tree.panel.prototype.onNodeContextmenu = pimcore.asset.tree.panel.prototype.onNodeContextmenu.sequence(function (node, event) {
    if (node.data.type !== 'folder') return
    var menu = event.contextmenu
    if (!menu) return
    menu.add({
      text: t('jwPimAreas.contextMenuTheme.label'),
      iconCls: 'pimcore_icon_asset',
      handler: function () {
        Ext.Msg.confirm(t('jwPimAreas.contextMenuTheme.title'), t('jwPimAreas.contextMenuTheme.folder').replace('%folder%', node.data.text), function (btn) {
          if (btn !== 'yes') return
          Ext.Ajax.request({
            url: '/admin/jwAreaBricks/run-theme-import',
            method: 'POST',
            params: {
              folderId: node.data.id,
            },
            success: function (response) {
              var result = Ext.decode(response.responseText)
              if (result.success) {
                pimcore.helpers.showNotification(
                  t('jwPimAreas.contextMenuTheme.success.title'),
                  t('jwPimAreas.contextMenuTheme.success.message').replace('%folder%', node.data.text),
                  'success',
                )
              } else {
                pimcore.helpers.showNotification(
                  t('jwPimAreas.contextMenuTheme.error.title'),
                  t('jwPimAreas.contextMenuTheme.error.message').replace('%folder%', node.data.text).replace('%message%', result.message),
                  'error',
                )
              }
            },
            failure: function (response) {
              pimcore.helpers.showNotification(
                t('jwPimAreas.contextMenuTheme.failure.title'),
                t('jwPimAreas.contextMenuTheme.failure.message').replace('%folder%', node.data.text).replace('%status%', response.status),
                'error',
              )
            },
          })
        })
      },
    })
  })
})
