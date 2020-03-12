function saveEdu()
{
    $.ajax({
            type: "POST",
            url: burl +"/hrms/edu/save",
            data: {
                employee_id: $("#id").val(),
                year: $("#year").val(),
                school_name: $("#school_name").val(),
                degree: $("#degree").val(),
                school_address: $("#school_address").val()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (sms) {
                var edu = JSON.parse(sms);
                let tr = "";
                tr +="<tr id='" + edu.id + "'>";
                tr +="<td>" + edu.year + "</td>";
                tr +="<td>" + edu.degree + "</td>";
                tr +="<td>" + edu.school_name + "</td>";
                tr +="<td>" + edu.school_address + "</td>";
                tr +="<td>" + "<a href='#' onclick='deleteEdu(event, this)' class='text-danger' title='Delete'><i class='fa fa-trash'></i> </a>"  + "</td>";
                tr +="</tr>";
                $("#edu_form").before(tr);
                $("#year").val("");
                $("#degree").val("");
                $("#school_name").val("");
                $("#school_address").val("");
                $("#year").focus();
            }
        });
}
// delete education
function deleteEdu(evt, obj)
{
    evt.preventDefault();
    var con = confirm('You want to delete?');
    if(con)
    {
        let id = $(obj).parent().parent().attr("id");
        $.ajax({
            type: "GET",
            url: burl + "/hrms/edu/delete/" + id,
            success: function(sms)
            {
                if(sms>0)
                {
                    $(obj).parent().parent().remove();
                }
            }
        });
    }

}
// save family information
function saveFamily()
{

    $.ajax({
            type: "POST",
            url: burl +"/hrms/family/save",
            data: {
                employee_id: $("#id").val(),
                name: $("#fname").val(),
                type: $("#ftype").val(),
                address: $("#faddress").val(),
                career: $("#fcareer").val(),
                phone: $("#fphone").val()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (sms) {
                var fm = JSON.parse(sms);
                let tr = "";
                tr +="<tr id='" + fm.id + "'>";
                tr +="<td>" + fm.name + "</td>";
                tr +="<td>" + fm.type + "</td>";
                tr +="<td>" + fm.address + "</td>";
                tr +="<td>" + fm.career + "</td>";
                tr +="<td>" + fm.phone + "</td>";
                tr +="<td>" + "<a href='#' onclick='deleteFamily(event, this)' class='text-danger' title='Delete'><i class='fa fa-trash'></i> </a>"  + "</td>";
                tr +="</tr>";
                $("#family_form").before(tr);
                $("#fname").val("");
                $("#ftype").val("");
                $("#faddress").val("");
                $("#fcareer").val("");
                $("#fphone").val("");
                $("#fname").focus();
            }
        });
}
// delete family
function deleteFamily(evt, obj)
{
    evt.preventDefault();
    var con = confirm('You want to delete?');
    if(con)
    {
        let id = $(obj).parent().parent().attr("id");
        $.ajax({
            type: "GET",
            url: burl + "/hrms/family/delete/" + id,
            success: function(sms)
            {
                if(sms>0)
                {
                    $(obj).parent().parent().remove();
                }
            }
        });
    }

}
// save work
function saveWork()
{
    $.ajax({
            type: "POST",
            url: burl +"/hrms/work/save",
            data: {
                employee_id: $("#id").val(),
                year: $("#wyear").val(),
                position: $("#wposition").val(),
                address: $("#waddress").val(),
                company_name: $("#wcompany").val()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (sms) {
                var wk = JSON.parse(sms);
                let tr = "";
                tr +="<tr id='" + wk.id + "'>";
                tr +="<td>" + wk.year + "</td>";
                tr +="<td>" + wk.position + "</td>";
                tr +="<td>" + wk.company_name + "</td>";
                tr +="<td>" + wk.address + "</td>";
                tr +="<td>" + "<a href='#' onclick='deleteWork(event, this)' class='text-danger' title='Delete'><i class='fa fa-trash'></i> </a>"  + "</td>";
                tr +="</tr>";
                $("#work_form").before(tr);
                $("#wyear").val("");
                $("#wposition").val("");
                $("#wcompany").val("");
                $("#waddress").val("");
                $("#wyear").focus();
            }
        });
}
// delete work
function deleteWork(evt, obj)
{
    evt.preventDefault();
    var con = confirm('You want to delete?');
    if(con)
    {
        let id = $(obj).parent().parent().attr("id");
        $.ajax({
            type: "GET",
            url: burl + "/hrms/work/delete/" + id,
            success: function(sms)
            {
                if(sms>0)
                {
                    $(obj).parent().parent().remove();
                }
            }
        });
    }

}
// save document
function saveDoc()
{
    var file_data = $('#dfile').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file_name', file_data);
    form_data.append('employee_id', $("#id").val());
    form_data.append('title', $("#dtitle").val());
    form_data.append('description', $("#ddescription").val());
    $.ajax({
        type: 'POST',
        url:burl + '/hrms/document/save',
        data: form_data,
        type: 'POST',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: false,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
        },
        success:function(sms){
            let doc = JSON.parse(sms);
            let tr = "";
            tr +="<tr id='" + doc.id + "'>";
            tr +="<td>" + doc.title + "</td>";
            tr +="<td><a href='" + burl + "/" + doc.file_name + "' "  + " target='_blank'>" + doc.title + "</a></td>";
            tr +="<td>" + doc.company_name + "</td>";
            tr +="<td>" + "<a href='#' onclick='deleteDoc(event, this)' class='text-danger' title='Delete'><i class='fa fa-trash'></i> </a>"  + "</td>";
            tr +="</tr>";
            $("#doc_form").before(tr);
            $("#dtitle").val("");
            $("#dfile").val("");
            $("#ddescription").val("");
            $("#dtitle").focus();
        },
    });
}
// delete work
function deleteDoc(evt, obj)
{
    evt.preventDefault();
    var con = confirm('You want to delete?');
    if(con)
    {
        let id = $(obj).parent().parent().attr("id");
        $.ajax({
            type: "GET",
            url: burl + "/hrms/document/delete/" + id,
            success: function(sms)
            {
                if(sms>0)
                {
                    $(obj).parent().parent().remove();
                }
            }
        });
    }

}
