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
  console.log('some')
  alertify
  .defaultValue("Nuevo Nombre")
  .prompt("¿Cuál es el nombre del nuevo Item?",
    function (val, ev) {
      ev.preventDefault()
      ajaxRequest({
        url: '',
        action: '',
        data: {
          nuevoNombre: val
        }
      })
    }, function(ev) {
      console.log(ev)
    })
})
