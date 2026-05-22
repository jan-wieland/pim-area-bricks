document.addEventListener(pimcore.events.prepareAssetTreeContextMenu, function (e) {
  var menu = e.detail.menu
  var asset = e.detail.asset

  if (asset.data.type !== 'folder') return

  menu.add({
    text: t('jwPimAreas.contextMenuTheme.label'),
    iconCls: 'pimcore_icon_asset',
    handler: function () {
      Ext.Msg.confirm(t('jwPimAreas.contextMenuTheme.title'), t('jwPimAreas.contextMenuTheme.folder').replace('%folder%', asset.data.text), function (btn) {
        if (btn !== 'yes') return
        Ext.Ajax.request({
          url: '/admin/jwAreaBricks/run-theme-import',
          method: 'POST',
          params: {
            folderId: asset.data.id,
          },
          success: function (response) {
            var result = Ext.decode(response.responseText)
            if (result.success) {
              pimcore.helpers.showNotification(
                t('jwPimAreas.contextMenuTheme.success.title'),
                t('jwPimAreas.contextMenuTheme.success.message').replace('%folder%', asset.data.text),
                'success',
              )
            } else {
              pimcore.helpers.showNotification(
                t('jwPimAreas.contextMenuTheme.error.title'),
                t('jwPimAreas.contextMenuTheme.error.message').replace('%folder%', asset.data.text).replace('%message%', result.message),
                'error',
              )
            }
          },
          failure: function (response) {
            pimcore.helpers.showNotification(
              t('jwPimAreas.contextMenuTheme.failure.title'),
              t('jwPimAreas.contextMenuTheme.failure.message').replace('%folder%', asset.data.text).replace('%status%', response.status),
              'error',
            )
          },
        })
      })
    },
  })
})
