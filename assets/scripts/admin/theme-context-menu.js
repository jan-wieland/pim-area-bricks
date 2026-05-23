document.addEventListener(pimcore.events.prepareAssetTreeContextMenu, function (e) {
  var menu = e.detail.menu
  var asset = e.detail.asset

  if (asset.data.type !== 'folder') return

  menu.add({
    text: t('jwPimAreas.contextMenuTheme.label'),
    iconCls: 'pimcore_icon_rgbaColor',
    handler: function () {
      Ext.Msg.confirm(t('jwPimAreas.contextMenuTheme.title'), t('jwPimAreas.contextMenuTheme.folder').replace('%folder%', asset.data.text), function (btn) {
        if (btn !== 'yes') return
        Ext.Ajax.request({
          url: '/admin/jwAreaBricks/run-theme-import',
          method: 'POST',
          params: {
            assetFolderId: asset.data.id,
            language: pimcore.settings.language,
          },
          success: function (response) {
            var result = Ext.decode(response.responseText)
            if (result.success) {
              pimcore.helpers.showNotification(
                t('jwPimAreas.contextMenuTheme.import.success.title'),
                t('jwPimAreas.contextMenuTheme.import.success.message').replace('%folder%', asset.data.text),
                'success',
              )
            } else {
              pimcore.helpers.showNotification(
                t('jwPimAreas.contextMenuTheme.import.error.title'),
                t('jwPimAreas.contextMenuTheme.import.error.message').replace('%folder%', asset.data.text).replace('%message%', result.message),
                'error',
              )
            }
          },
          failure: function (response) {
            pimcore.helpers.showNotification(
              t('jwPimAreas.contextMenuTheme.import.failure.title'),
              t('jwPimAreas.contextMenuTheme.import.failure.message').replace('%folder%', asset.data.text).replace('%status%', response.status),
              'error',
            )
          },
        })
      })
    },
  })
})
