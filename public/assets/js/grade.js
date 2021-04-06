$(document).on('change','#grade-action', function(){
    var data = $(this).val();
    var grade_id = $(this).attr('data-grade');
    var student_id = $(this).attr('data-student_id');
    var subject_id = $(this).attr('data-subs');
    var grade1 = $(this).closest("tr").find(".grade1").text();
    var grade2 = $(this).closest("tr").find(".grade2").text();
    var grade3 = $(this).closest("tr").find(".grade3").text();
    var grade4 = $(this).closest("tr").find(".grade4").text();
    var remarks = $(this).closest("tr").find(".remarks").text();
    if(data=='save'){

        if(grade_id){
            $.ajax({
                type: "POST",
                url: BASE_URL+"faculty/saveGrade",
                data: {
                    grade1:grade1,grade2:grade2,grade3:grade3,grade4:grade4,remarks:remarks,grade_id:grade_id
                },
                dataType: "json",
                success: function(response) {
                    if(response.success === true){
                        console.log(response);
                        $('p#message').text(response.msg);
                        $("#mssge").show();
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 3000);
                    }
                }
            });
        }
    }

    if(data=='student'){
        if(grade_id){
            $.ajax({
                type: "POST",
                url: BASE_URL+"faculty/notifyGrade",
                data: {
                    subject_id:subject_id,student_id:student_id,grade_id:grade_id
                },
                dataType: "json",
                success: function(response) {
                    if(response.success === true){
                        console.log(response);
                        $('p#message').text(response.msg);
                        $("#mssge").show();
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 3000);
                    }
                }
            });
        }
    }

    if(data=='parents'){
        if(grade_id){
            $.ajax({
                type: "POST",
                url: BASE_URL+"faculty/notifyParents",
                data: {
                    subject_id:subject_id,student_id:student_id,grade_id:grade_id
                },
                dataType: "json",
                success: function(response) {
                    if(response.success === true){
                        console.log(response);
                        $('p#message').text(response.msg);
                        $("#mssge").show();
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 3000);
                    }
                }
            });
        }
    }
})