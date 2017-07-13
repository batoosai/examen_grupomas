$(document)
.on('click','.verItemsWarehouse',function(ev){
  var res = ajaxRequest({
    action: 'getWarehouseItems',
    data: {
      id: $(ev.currentTarget).closest('tr').attr('id')
    }
  })
  console.log(res)
})
