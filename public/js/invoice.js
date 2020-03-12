 // function to get room price
 function getPrice()
 {
     
     let product_id = $("#product").val();
     let customer_id = $('#customer_id').val();
     if(customer_id=='')
     {
        alert('Please select a customer to create invoice!');
     }
     else
     {
        $.ajax({
            type: "GET",
            url: burl + "/product/price/" + product_id + '?cid='+customer_id,
            success: function(data) {
                
                data = JSON.parse(data);
                console.log(data);
                $("#price").val(data.price);
                $("#unit").val(data.name);
                $("#quantity").val("1");
                $("#discount").val("0");
                $("#unit").val(data.uname);
            }
        });
     }
    
 }
 function getPrice1(pp)
 {
     let product_id = $("#product1").val();
     let customer_id = $('#customer_id').val();
     if(customer_id=='')
     {
        alert('Please select a customer to create invoice!');
     }
     else
     {
        $.ajax({
            type: "GET",
            url: burl + "/product/price/" + product_id + '?cid='+customer_id,
            success: function(data) {
                
                data = JSON.parse(data);
                
                $("#price1").val(data.price);
                $("#unit1").val(data.uname);
                $("#quantity").val("1");
                $("#discount").val("0");
                
            }
        });
     }
     
 }
 // function to add item to table
 function addItem()
 {
     let product = $("#product").val();
     let unit = $("#unit").val();
     let product_name = $("#product :selected").text();
     let quantity = $("#quantity").val();
     let price = $("#price").val();
     let disc = $("#discount").val();
     if(price=="" || quantity== 0 || product == "" )
     {
         alert("Please input data correctly!");
     }
     else{
         let subtotal = 0;
         subtotal = quantity * price * (1- disc/100);
         // add item to table
         let trs = $("#data tr");
         let html = "<tr product='" +  product + "'>";
         html += "<td>" + product_name + "</td>";
         html += "<td>" + quantity + "</td>";
         html += "<td>" + unit + "</td>";
         html += "<td>" + price + "</td>";
         html += "<td>" + disc + "</td>";
         html += "<td> " + subtotal + "</td>";

         html += "<td>" + "<button class='btn btn-danger btn-sm btn-oval' type='button' onclick='deleteItem(this)'>Delete</button>&nbsp;";
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
         $("#unit").val("");
         $("#unit").val("");

         $("#quantity").val("");
         $("#discount").val("0");
         $("#product").trigger("chosen:updated");
         $("#exampleModal").modal("hide");
     }
 }
 // function to remove an item
 function deleteItem(obj)
 {
     let con = confirm("តើអ្នកពិតជាចង់លុបមែនទេ?");
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
    //  let product_name = $(tds[0]).html();
     let price = $(tds[3]).html();
     let disc = $(tds[4]).html();
     let quanity = $(tds[1]).html();
     let unit = $(tds[2]).html();
     $("#product1").val(product);
     $("#price1").val(price);
     $("#discount1").val(disc);
     $("#quanity1").val(quanity);
     $("#unit1").val(unit);
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
     let unit = $("#unit1").val();
     let quanity = $("#quanity1").val();
     if(price=="" || quanity== 0 || product == "" )
     {
         alert("សូមបញ្ចូលទិន្នន័យអោយត្រឹមត្រូវ!");
     }
     else{
         let subtotal = 0;
         subtotal = quanity*price*(1-disc/100);
         let tr = $("#data tr.active");
         $(tr[0]).attr('product', product);
         let tds = $("#data tr.active td");
         tds[0].innerHTML = product_name;
         tds[1].innerHTML = quanity;
         tds[2].innerHTML = unit;
         tds[3].innerHTML = price;
         tds[4].innerHTML = disc;
         tds[5].innerHTML = subtotal;
         getTotal();
         // clear text box
         $("#product1").val("");
         $("#product1").trigger("chosen:updated");
         $("#price1").val("0");
         $("#quanity1").val("0");
         $("#unit1").val("");
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
         total += Number($(tds[5]).html());
     }
     let g_disc = $("#g_discount").val();
     total = total - (total * g_disc/100);
     total = total.toPrecision(3);
     
     let rate = $("#exc").html();
     let khtotal = total*rate;
     $("#total").html(total);
     $("#total_kh").html(" = KHR " + khtotal)
 }
 // function to save invoice to db
 function save()
 {
     let master = {
         customer_id: $("#customer_id").val(),
         invoice_date: $("#invoice_date").val(),
         due_date: $("#due_date").val(),
         note: $("#note").val(),
         total: $("#total").html(),
         reference: $("#reference").val(),
         exchange: $("#exc").html(),
         vat: $("#vat").val(),
         g_disc: $("#g_discount").val()
     };
     let items = [];
     let trs = $("#data tr");
     // check data
     
     if($("#invoice_date").val()=='')
     {
         alert("Please select invoice date!");
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
             let price_str = $(tds[3]).html();
             let disc_str = $(tds[4]).html();
             let item = {
                 product_id: product_id,
                 price: price_str,
                 quanity:quanity,
                 discount: disc_str,
                 total: $(tds[5]).html()
             };
             items.push(item);
         }

         // save to database
         let data = {invoice: master, items: items};
         $.ajax({
             type: "POST",
             url: burl +"/invoice/save",
             data: data,
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
             },
             success: function (sms) {
                //  console.log(sms);

                 if(sms>0)
                 {
                    location.href = burl + "/invoice/detail/" + sms;
                 }
                 else{
                     alert("Fail to save data!");
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
 function saveCustomer()
 {
    let vcompany = $("#vcompany").val();
    let full_name = $("#vfull_name").val();
    let email = $("#vemail").val();
    let phone = $("#vphone").val();
    let address = $("#vaddress").val();
    if(vcompany=="" || full_name=="")
    {
        alert('Please input data correctly!');
    }
    else
    {
        $.ajax({
            type: "POST",
            url: burl +"/invoicing/customer/save1",
            data: {
                company: vcompany,
                full_name: full_name,
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
					$("#customer_id option:first-child").before(opt);
					$('#customer_id').val(data.id);
                    $("#customer_id").trigger('chosen:updated');
                    
					$("#vcompany").val("");
					$("#full_name").val("");
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
             url: burl +"/invoicing/income-category/save1",
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
             url: burl +"/invoicing/product/save1",
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
  function getVat()
  {
      let cid = $("#customer_id").val();
      $.ajax({
          type: "GET",
          url: burl + "/getvat/" + cid,
          success: function(data){
              $("#vat").val(data);
          }
      });
  }