$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});

function getSubject(that){  // get the subject when selecting an attorney from create modal clients
    var id = $(that).attr('data-id');
    $.ajax({
        type: "POST",
        url: BASE_URL+"/admin/getSubject",
        data: {
            id:id
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            $('#subject_code').val(response.msg.subject_code);
            $('#subject').val(response.msg.subject);
            $('#description').val(response.msg.description);
            $('#id').val(response.msg.id);
        }
    });
}

function getSection(that){  // get the sections when selecting an  from create modal clients
    var id = $(that).attr('data-id');
    $.ajax({
        type: "POST",
        url: BASE_URL+"/admin/getSection",
        data: {
            id:id
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            $('#section').val(response.msg.section_name);
            $('#grade').val(response.msg.section_year);
            $('#school_year').val(response.msg.school_year);
            $('#description').val(response.msg.description);
            $('#id').val(response.msg.id);
            var data = [];
            $.each(response.subs, function( index, value ) {
                data.push(value.id);
            });
            $('#subject_id').val(data).trigger("change");
        }
    });
}

function selectSection(that){  // get the sections when selecting an attorney from create modal clients
    var id = $(that).val();
    $.ajax({
        type: "POST",
        url: BASE_URL+"/admin/selectSection",
        data: {
            id:id
        }, 
        dataType: "json",
        success: function(response) {
            console.log(response);
            $('#group_section_id').html('');
            $.each(response.msg, function( index, value ) {
                $('#group_section_id').append('<option value="'+value.id+'">Grade '+value.section_year+' - '+value.section_name+'</option>');
            });
        }
    });
}

function studentID(that){
    var id = $(that).val();
    $('#student_id').val(id);
}

function getActivity(that){
    var id = $(that).attr('data-id');

    $.ajax({
        type: "POST",
        url: BASE_URL+"/faculty/getActivity",
        data: {
            id:id
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            $('#edit-activity #title').val(response.msg.title);
            $('#edit-activity #desc').val(response.msg.description);
            $('#edit-activity #id').val(response.msg.id);
            $('select#status').val(response.msg.status);
            $('#edit-activity #input-file-now-custom').attr('data-default-file', BASE_URL+'uploads/'+response.msg.file)
        }
    });

}

function changeActiStatus(that){
    var id = $(that).attr('data-id');
    var status = $(that).val();

    $.ajax({
        type: "POST",
        url: BASE_URL+"faculty/changeActiStatus",
        data: {
            id:id,status:status
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

function activityStatus(that){
    var actID = $(that).attr('data-acc');
    var status = $(that).val()

    $.ajax({
        type: "POST",
        url: BASE_URL+"student/changeActiStatus",
        data: {
            actID:actID,status:status
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
function getFaculty(that){
    var id = $(that).attr('data-group');
    $('#profile').attr("src", BASE_URL+"plugins/images/users/hanna.jpg");
    $('#name').text('');
    $('#phone').text('');
    $('#email').text('');
    $.ajax({
        type: "POST",
        url: BASE_URL+"student/getFaculty",
        data: {
            id:id
        },
        dataType: "json",
        success: function(response) {
            if(response.success === true){
                console.log(response);
                if(response.img){
                    $('#profile').attr("src", BASE_URL+"uploads/"+response.img);
                }
                $('#name').text(response.name);
                $('#phone').text(response.phone);
                $('#email').text(response.email);
            }
        }
    });
}

function clearanceDone(that){
    var id = $(that).attr('data-id');
    var status = $(that).attr('data-status');

    $.ajax({
        type: "POST",
        url: BASE_URL+"admin/clearance/clearanceDone",
        data: {
            id:id,status:status
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
function FclearanceDone(that){
    var id = $(that).attr('data-id');
    var status = $(that).attr('data-status');

    $.ajax({
        type: "POST",
        url: BASE_URL+"faculty/clearanceDone",
        data: {
            id:id,status:status
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

function editClearance(that){
    var student_id = $(that).attr('data-stud');
    var title = $(that).attr('data-title');
    var id = $(that).attr('data-id');
    var desc = $(that).attr('data-desc');
    var status = $(that).attr('data-stat');

    $('#edit-modal #student_id').val(student_id).trigger("change");
    $('#edit-modal #title').val(title);
    $('#edit-modal #desc').val(desc);
    $('#edit-modal #id').val(id);
    $('#edit-modal #status').val(status).trigger("change");
}