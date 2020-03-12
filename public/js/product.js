function saveCat()
{
    let name = $("#catname").val();
    if(name=="")
    {
        alert("សូមបញ្ចូលទិន្នន័យអោយបានត្រឹមត្រូវ!");
    }
    else{
        $.ajax({
            type: "GET",
            url: burl + "/product/category/save",
            data: {catname: name},
            success: function(data){
                data = JSON.parse(data);
                $("#addCat").modal('hide');
                var opt = "<option value='" + data.id + "'>" + data.name + "</option>";
                $("#category option:first-child").before(opt);
                $('#category').val(data.id);
                $("#category").trigger('chosen:updated');
                $("#catname").val("");
                $("#catModal").modal('hide');
            }
        });
    }
}
// save unit
function saveUnit()
{
   let name = $("#uname").val();

   if(name=="")
   {
       alert('Please input data correctly!');
   }
   else
   {
       $.ajax({
           type: "GET",
           url: burl +"/product/unit/save",
           data: {
               name: name
           },
         
           success: function (data) {
                data = JSON.parse(data);
                $("#unitModal").modal('hide');
                var opt = "<option value='" + data.id + "'>" + data.name + "</option>";
                $("#unit option:first-child").before(opt);
                $('#unit').val(data.id);
                $("#unit").trigger('chosen:updated');
                $("#uname").val("");
           }
       });
   }
}