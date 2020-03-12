 // function to get room price
 function getPrice()
 {
     let product_id = $("#product").val();
     $.ajax({
         type: "GET",
         url: burl + "/invoicing/product/price1/" + product_id,
         success: function(data) {
             data = JSON.parse(data);
             $("#price").val(data.cost);
             $("#unit").html(data.name);
             $("#quantity").val("1");
             $("#discount").val("0");
         }
     });
 }
 function getPrice1(pp)
 {
     let product_id = $("#product1").val();
     $.ajax({
         type: "GET",
         url: burl + "/product/price1/" + product_id,
         success: function(data) {
             $("#price1").val(data);
         }
     });
 }
 // function to add item to table
 function addItem()
 {
     let product = $("#product").val();
     let product_name = $("#product :selected").text();
     let quantity = $("#quantity").val();
     let price = $("#price").val();
     let disc = $("#discount").val();
     if(price=="" || quantity== 0 || product == "" )
     {
         alert("សូមបញ្ចូលទិន្នន័យអោយត្រឹមត្រូវ!");
     }
     else{
         let subtotal = 0;
         subtotal = quantity * price * (1- disc/100);
         // add item to table
         let trs = $("#data tr");
         let html = "<tr product='" +  product + "'>";
         html += "<td>" + product_name + "</td>";
         html += "<td>" + quantity + "</td>";
         html += "<td>" + price + "</td>";
         html += "<td>" + disc + "</td>";
         html += "<td> " + subtotal + "</td>";

         html += "<td>" + "<button class='btn btn-danger btn-sm btn-oval' type='button' onclick='deleteItem(this)'>Delete</button>&nbsp;&nbsp;";
         html +=  "<button class='btn btn-primary btn-sm btn-oval' type='button' onclick='editItem(this)'>Edit</button>";
         html += "</tr>";
         if(trs.length>0)
         {
             $("#data tr:last").after(html);
             getTotal();
         }
         else{
             $("#data").html(html);
             getTotal();
         }
         $("#product").val("");
         $("#price").val("");
         $("#quanity").val("0");
         $("#discount").val("0");
         $("#product").trigger("chosen:updated");
         $("#exampleModal").modal("hide");
     }
 }
 // function to remove an item
 function deleteItem(obj)
 {
     let con = confirm("You want to delete?");
     if(con)
     {
         $(obj).parent().parent().remove();
         getTotal();
     }
 }
 // function to load edit form
 function editItem(obj)
 {
     //remove active class from all row
     $("#data tr").removeClass('active');
     let tr = $(obj).parent().parent();
     // add class active to the current edit row
     $(tr).addClass('active');
     let tds = $(tr).children("td");

     let product = $(tr).attr('product');

     let product_name = $(tds[0]).html();
     let price = $(tds[2]).html();
     let disc = $(tds[3]).html();
     let quanity = $(tds[1]).html();
     $("#product1").val(product);
     $("#price1").val(price);
     $("#discount1").val(disc);
     $("#quanity1").val(quanity);

     $("#product1").trigger("chosen:updated");

     
     $("#editModal").modal('show');
 }
 // save edit item back to table
 function saveItem()
 {
     let product = $("#product1").val();
     let product_name = $("#product1 :selected").text();
     let price = $("#price1").val();
     let disc = $("#discount1").val();
     let quanity = $("#quanity1").val();
     if(price=="" || quanity== 0 || product == "" )
     {
         alert("Please input data correctly!");
     }
     else{
         let subtotal = 0;
         subtotal = quanity*price*(1-disc/100);
         let tr = $("#data tr.active");
         $(tr[0]).attr('product', product);
         let tds = $("#data tr.active td");
         tds[0].innerHTML = product_name;
         tds[1].innerHTML = quanity;
         tds[2].innerHTML = price;
         tds[3].innerHTML = disc;
         tds[4].innerHTML = subtotal;
         getTotal();
         // clear text box
         $("#product1").val("");
         $("#product1").trigger("chosen:updated");
         $("#price1").val("0");
         $("#quanity1").val("0");
         $("#discount1").val("0");
         $("#editModal").modal('hide');
     }
 }
 // find total
 function getTotal()
 {
     let trs = $("#data tr");
     let total = 0;
     for(let i=0; i<trs.length;i++)
     {
         let tds = $(trs[i]).children("td");
         total += Number($(tds[4]).html());
     }
     $("#total").html(total);
 }
 // function to save invoice to db
 function save()
 {
     let master = {
         vendor_id: $("#vendor_id").val(),
         bill_date: $("#bill_date").val(),
         due_date: $("#due_date").val(),
         category_id: $("#category").val(),
         note: $("#note").val(),
         total: $("#total").html()
     };
     let items = [];
     let trs = $("#data tr");
     // check data
     
     if($("#invoice_date").val()=='')
     {
         alert("Please choose a date!");
     }
     else if(trs.length<=0)
     {
         alert("Please select an item!");
     }
     else{
         for(let i=0;i<trs.length;i++)
         {
             let product_id = $(trs[i]).attr('product');
             let tds = $(trs[i]).children("td");
             let quanity = $(tds[1]).html();
             let price_str = $(tds[2]).html();
             let disc_str = $(tds[3]).html();
             let item = {
                 product_id: product_id,
                 price: price_str,
                 quanity:quanity,
                 discount: disc_str,
                 total: $(tds[4]).html()
             };
             items.push(item);
         }

         // save to database
         let data = {invoice: master, items: items};
         $.ajax({
             type: "POST",
             url: burl +"/invoicing/bill/save",
             data: data,
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
             },
             success: function (sms) {
                 console.log(sms);

                 if(sms>0)
                 {
                    location.href = burl + "/invoicing/bill/detail/" + sms;
                 }
                 else{
                     alert("Fail to save data, please check again!");
                 }
             }
         });
     }
     
 }
 function getProduct()
 {
     let cid = $("#category").val();
     $.ajax({
         type: "GET",
         url: burl + "/income/product/" + cid,
         success: function(data) {
             data = JSON.parse(data);
             let opts = '<option value="0"> -- ជ្រើសរើស -- </option>';
             for(let p of data){
                 opts += "<option value='" + p.id + "'>" + p.name + "</option>";
             }
             $("#product").html(opts);
             $("#product").trigger("chosen:updated");
         }
     });
 }
 // save vendor
 function saveVendor()
 {
    let fname = $("#vfirst_name").val();
    let lname = $("#vlast_name").val();
    let email = $("#vemail").val();
    let phone = $("#vphone").val();
    let address = $("#vaddress").val();
    if(fname=="" || lname=="")
    {
        alert('Please input data correctly!');
    }
    else
    {
        $.ajax({
            type: "POST",
            url: burl +"/invoicing/vendor/save1",
            data: {
                first_name: fname,
                last_name: lname,
                email: email,
                phone: phone,
                address: address
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (data) {
                data = JSON.parse(data);
                $("#vendorModal").modal('hide');
					var opt = "<option value='" + data.id + "'>" + data.company_name + "</option>";
					$("#vendor_id option:first-child").before(opt);
					$('#vendor_id').val(data.id);
                    $("#vendor_id").trigger('chosen:updated');
                    
					$("#vfirst_name").val("");
					$("#vlast_name").val("");
					$("#vemail").val("");
					$("#vphone").val("");
					$("#vaddress").val("");
            }
        });
    }
 }
  // save project
  function saveProject()
  {
     let name = $("#proname").val();
     let desc = $("#prodescription").val();

     if(name=="")
     {
         alert('Please input data correctly!');
     }
     else
     {
         $.ajax({
             type: "POST",
             url: burl +"/invoicing/project/save1",
             data: {
                 name: name,
                 description: desc
             },
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
             },
             success: function (data) {
                 data = JSON.parse(data);
                 $("#projectModal").modal('hide');
                     var opt = "<option value='" + data.id + "'>" + data.name + "</option>";
                     $("#project option:first-child").before(opt);
                     $('#project').val(data.id);
                     $("#project").trigger('chosen:updated');
                     
                     $("#proname").val("");
                     $("#prodescription").val("");
             }
         });
     }
  }
  // save category
  function saveCategory()
  {
     let name = $("#catname").val();

     if(name=="")
     {
         alert('Please input data correctly!');
     }
     else
     {
         $.ajax({
             type: "POST",
             url: burl +"/invoicing/expense-category/save1",
             data: {
                 name: name
             },
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
             },
             success: function (data) {
                 data = JSON.parse(data);
                 $("#catModal").modal('hide');
                     var opt = "<option value='" + data.id + "'>" + data.name + "</option>";
                     $("#category option:first-child").before(opt);
                     $('#category').val(data.id);
                     $("#category").trigger('chosen:updated');
                     $("#catname").val("");
             }
         });
     }
  }
  // save product
  function saveProduct()
  {
     let name = $("#pname").val();
    let code = $("#pcode").val();
    let cat = $("#pcategory").val();
    let unit = $("#punit").val();
    let type = $("#ptype").val();

     if(name=="" || cat=="" || unit=="")
     {
         alert('Please input data correctly!');
     }
     else
     {
         $.ajax({
             type: "POST",
             url: burl +"/invoicing/product/save",
             data: {
                 name: name,
                 category_id: cat,
                 code: code,
                 unit_id: unit,
                 type: type
             },
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
             },
             success: function (data) {
                 data = JSON.parse(data);
                 $("#productModal").modal('hide');
                     var opt = "<option value='" + data.id + "'>" + data.name + "</option>";
                     $("#product option:first-child").before(opt);
                     $('#product').val(data.id);
                     $("#product").trigger('chosen:updated');
                     $("#pname").val("");
                     $("#pcode").val("");
                     getPrice();
             }
         });
     }
  }