$(document)
.on('click','.addItemsWarehouse',function(ev){
  var id = $(ev.currentTarget).closest('tr').attr('id')
  $.ajax({
    url: './ws.php',
    type: 'post',
    data: {
      action: 'getItems'
    },
    success: function(res) {
      res = JSON.parse(res)
      if(res.status == true)
        addToWarehouse(id,res.data)
    }
  })
})
.on('click','.verItemsWarehouse',function(ev){
  var id = $(ev.currentTarget).closest('tr').attr('id'),
  whname = $(ev.currentTarget).closest('tr').find('.whname').text()
  $.ajax({
    url: './ws.php',
    type: 'post',
    data: {
      action: 'getWarehouseItems',
      data: {
        id: id
      }
    },
    success: function(res){
      res = JSON.parse(res)
      if( res.status == true ) {
        var inputs = createTable(res.data)
        vex.dialog.open({
          unsafeMessage: whname,
          input: inputs,
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
      }
    }
  })
})
.on('click','.deleteFromWarehouse',function(ev){
})
.on('click','.transferirItemsWarehouse',function(ev){

})

function addToWarehouse(id,data){
  vex.dialog.open({
    unsafeMessage: 'Agrega un Item',
    input: [
      '<input type="hidden" name="warehouse" value="'+id+'">',
      createSelect(data),
      '<input type="text" class="form-control" placeholder="Cantidad" name="quantity">'
    ].join(''),
    className: 'vex-theme-plain',
    buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Guardar' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
    ],
    callback: function(data) {
      if( data ) {
        var result = ajaxRequest({
          action: 'addToWarehouse',
          data: data
        })
        if( result == true)
          location.reload()
      }
    }
  })
}
function createSelect(data) {
  var select = [
    '<select class="form-control" name="item">'
  ]
  for (var i = 0; i < data.length; i++) {
    select.push('<option value="'+data[i].id+'">'+data[i].name+'</option>')
  }
  select.push('</select>')
  return select.join('')
}
function createTable(data) {
  var table = [
  '<table class="table table-hover table-striped">']
  for (var i = 0; i < data.length; i++) {
    table.push('<tr id="'+data[i].id+'">')
    table.push('<td>'+data[i].name+'</td>')
    table.push('<td>'+data[i].quantity+'</td>')
    table.push('<td>')
    table.push('<button type="button" class="btn btn-danger deleteFromWarehouse"><i class="fa fa-times"></i></button>')
    table.push('</td>')
    table.push('</tr>')
  }
  table.push('</table>')
  return table.join('')
}
