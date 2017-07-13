function ajaxRequest(data){
  $.ajax({
    url: './ws.php',
    type: 'post',
    data: {
      action: data.action,
      data: data.data
    },
    success: function(res){
      res = JSON.parse(res)
      if( res.status == true ) {
        location.reload()
      } else {
        alertify.error(res.message)
      }
    }
  })
}
