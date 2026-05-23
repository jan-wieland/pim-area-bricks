document.addEventListener(pimcore.events.preMenuBuild, function (e) {
  e.detail.menu.jwPimAreaBricks = {
    text: t('jwPimAreas.adminMenuDocs.label'),
    iconCls: 'pimcore_icon_import_warning',
    priority: 100,
    items: [
      {
        text: t('jwPimAreas.adminMenuDocs.item'),
        iconCls: 'pimcore_icon_log',
        handler: function () {
          pimcore.helpers.openGenericIframeWindow('jwPimAreas_docs', '/admin/jwAreaBricks/docs', 'pimcore_icon_info', t('jwPimAreas.adminMenuDocs.docs'))
        },
      },
    ],
  }
})
