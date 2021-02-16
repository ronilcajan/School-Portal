$(document).ready(function(){

    $( "table.dataTable tbody tr" ).hover(function() {
        $(' div.row-options' ).css({ opacity: 1, fontSize: 12});
    });

    $("table tbody tr").click(function () {
        var checkbox = $(this).find("input[type='checkbox']");
        checkbox.attr("checked", !checkbox.attr("checked"));
    });
    
    // check all checkbox when header checkbox column is click 
    $(".checkbox #checkAll").click(function () {
        $("table input:checkbox").not(this).prop("checked", this.checked);
    });
    $("#activityTable").DataTable();
    $("#actTable").DataTable();
    $("#subsTable").DataTable();
    $("#myDatatables").DataTable();
    $("#gradeTable").DataTable();
    $("#act_table").DataTable();
    $("#user_table").DataTable({
        "order": [],
        'columnDefs': [{
            "targets": [0],
            "orderable": false
        }]
    });
    $("#studentTable").DataTable({
        "order": [],
        'columnDefs': [{
            "targets": [0],
            "orderable": false
        }]
    });

    $("#checkAll").click(function () {
        $("#user_table input:checkbox").not(this).prop("checked", this.checked);
    });
        
});

/* =========== Add comma to thousand numbers ================*/
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function deleteUser(){
    var id = [];
    var username = [];
    
    $("#user_table tbody input[type=checkbox]:checked").each(function (i) {
        id[i] = $(this).attr("data-id");
        username[i] = $(this).attr("data-username");
    });
    var list = "";
    if(username.length == 0){
        $(".user_list").html("<li> No user selected! </li>");
    }else{
        for (i = 0; i < username.length; i++) {
            list += "<li>"+ username[i] + "</li>";
        }
    
        $(".user_list").html(list);
        $("#user_id").val(id);
    }
   
}

function changeRole(that){
    var role = $(that).val();
    var id = $(that).attr('data-id');

    if(id && role){
        $.ajax({
            type: "POST",
            url: BASE_URL+"/admin/changeRole",
            data: {
                id:id,role:role
            },
            dataType: "json",
            success: function(response) {
                if(response.success === true){
                    console.log(response);
                    location.reload();
                }
            }
        });
    }
}