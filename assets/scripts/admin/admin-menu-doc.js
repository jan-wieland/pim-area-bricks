document.addEventListener(pimcore.events.preMenuBuild, function (e) {
  e.detail.menu.jwPimAreaBricks = {
    label: t('jwPimAreas.adminMenuDocs.label'),
    iconCls: 'pimcore_icon_info',
    priority: 100,
    items: [
      {
        label: t('jwPimAreas.adminMenuDocs.docs'),
        iconCls: 'pimcore_icon_info',
        handler: function () {
          pimcore.helpers.openGenericIframeWindow('jwPimAreas_docs', '/admin/jwAreaBricks/docs', 'pimcore_icon_info', t('jwPimAreas.menu.docs'))
        },
      },
    ],
  }
})
