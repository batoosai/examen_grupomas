function ajaxRequest(data){
  $.ajax({
    url: data.url,
    type: 'post',
    data: {
      action: data.action,
      data: data.data
    },
    success: function(res){
      console.log(res)
    }
  })
}

$(document)
.on('click','.addItem',function(ev){
  vex.dialog.open({
      unsafeMessage: 'Nuevo Item',
      input: [
        '<div class="form-group"><input class="form-control" name="name" placeholder="Nombre"></div>',
        '<div class="form-group"><input class="form-control" name="precio_compra" placeholder="Precio de Compra"></div>',
        '<div class="form-group"><input class="form-control" name="precio_venta" placeholder="Precio de Venta"></div>',
      ].join(''),
      className: 'vex-theme-plain',
      buttons: [
          $.extend({}, vex.dialog.buttons.YES, { text: 'Guardar' }),
          $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
      ],
      callback: function(data) {
        ajaxRequest({
          url: '',
          action: '',
          data: data
        })
      }
  })
})
