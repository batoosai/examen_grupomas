$(document)
.on('click','.addItem',function(ev){
  vex.dialog.open({
      unsafeMessage: 'Nuevo Item',
      input: [
        '<div class="form-group"><input class="form-control" name="name" placeholder="Nombre"></div>',
        '<div class="form-group"><input class="form-control" name="buyPrice" placeholder="Precio de Compra"></div>',
        '<div class="form-group"><input class="form-control" name="sellPrice" placeholder="Precio de Venta"></div>',
      ].join(''),
      className: 'vex-theme-plain',
      buttons: [
          $.extend({}, vex.dialog.buttons.YES, { text: 'Guardar' }),
          $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
      ],
      callback: function(data) {
        if( data ) {
          var result = ajaxRequest({
            action: 'addItem',
            data: data
          })
          if( result == true)
            location.reload()
        }
      }
  })
})
.on('click','.modifyItem',function(ev){
  var id = $(ev.currentTarget).closest('tr').attr('id'),
  name = $(ev.currentTarget).closest('tr').find('.name').text(),
  buyPrice = $(ev.currentTarget).closest('tr').find('.buyPrice').text(),
  sellPrice = $(ev.currentTarget).closest('tr').find('.sellPrice').text()
  vex.dialog.open({
    unsafeMessage: 'Modificar Item',
    input: [
      '<input type="hidden" name="id" value="'+id+'">',
      '<div class="form-group">',
      '<input class="form-control" name="name" placeholder="Nombre" value="'+name+'">',
      '</div>',
      '<div class="form-group">',
      '<input class="form-control" name="buyPrice" placeholder="Precio de Compra" value="'+buyPrice+'">',
      '</div>',
      '<div class="form-group">',
      '<input class="form-control" name="sellPrice" placeholder="Precio de Venta" value="'+sellPrice+'">',
      '</div>',
    ].join(''),
    className: 'vex-theme-plain',
    buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Guardar' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
    ],
    callback: function(data) {
      if( data ) {
        var result = ajaxRequest({
          action: 'modifyItem',
          data: data
        })
        if( result == true)
          location.reload()
      }
    }
  })
})
.on('click','.deleteItem',function(ev){
  var id = $(ev.currentTarget).closest('tr').attr('id')
  vex.dialog.confirm({
      unsafeMessage: 'Eliminar Item',
      className: 'vex-theme-plain',
      buttons: [
          $.extend({}, vex.dialog.buttons.YES, { text: 'Guardar' }),
          $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
      ],
      callback: function(data) {
        if( data ) {
          var result = ajaxRequest({
            action: 'deleteItem',
            data: {
              id: id
            }
          })
          if( result == true)
            location.reload()
        }
      }
  })
})
