$(function() {
    "use strict";

    $(document).ready(function(){
      var id =  $('#faculty_id').val();

        if(id){
            $.ajax({
                type: "POST",
                url: BASE_URL+"faculty/getStudenttotal",
                data: {
                    id:id
                },
                dataType: "json",
                success: function(response) {
                    if(response.success === true){

                        Morris.Donut({
                            element: 'order-status-chart',
                            data: [{
                                label: "Total Students",
                                value: response.total
                    
                            }, {
                                label: "Female Students",
                                value: response.female
                            }, {
                                label: "Male Students",
                                value: response.male
                            }],
                            resize: true,
                            colors: ['#0283cc', '#e74a25', '#2ecc71']
                        });
                    }
                }
            });
        }
    });

});
