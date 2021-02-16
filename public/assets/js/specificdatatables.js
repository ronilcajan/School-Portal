$(document).ready(function(){

    $( "table.dataTable tbody tr" ).hover(function() {
        $(' div.row-options' ).css({ opacity: 1, fontSize: 12});
    });

    $("table tbody tr").click(function () {
        var checkbox = $(this).find("input[type='checkbox']");
        checkbox.attr("checked", !checkbox.attr("checked"));
    });
    
    // checked all checkbox when header checkbox column is click 
    $(".checkbox #checkAll").click(function () {
        $("table input:checkbox").not(this).prop("checked", this.checked);
    });
    
    var path = window.location.pathname;
    var orientation = 'portrait';
    var h1Title = $('h3.box-title').text();

    if(path.includes('firms/view')){
        var column =  [1,2,3,4,5,6,7];
        var id = $('#law_firm_id').val();
        var myAjaxpath = '/datatables/attorneys-table/'+id;
        var fileTitle = h1Title+" Attorney's Report";
        var pdfWidth = ['5%','16%','16%','16%','10%','17%','17%'];
        var orientation = 'landscape';
        var actionURL = BASE_URL + '/admin/attorneys/bulk-delete';
    }
    if(path.includes('attorneys/view')){
        var column =  [1,2,3,4,5,6,7];
        var id = $('#attorneys_id').val();
        var myAjaxpath = '/datatables/claimants-table/'+id;
        var fileTitle = h1Title+" Claimant's Report";
        var pdfWidth = ['5%','16%','16%','16%','10%','17%','17%'];
        var orientation = 'landscape';
        var actionURL = BASE_URL + '/admin/claimants/bulk-delete';
    }
    if(path.includes('claimants/view')){
        var column =  [1,2,3,4,5,6,7,8];
        var id = $('#attorneys_id').val();
        var myAjaxpath = '/datatables/deals-table/'+id;
        var fileTitle = h1Title+" Deals Report";
        var pdfWidth = ['5%','14%','14%','10%','14%','14%','14%','14%'];
        var orientation = 'landscape';
        var actionURL = BASE_URL + '/admin/deals/bulk-delete';
        var columnTD = [
            {
                "targets": 0,
                "orderable": false,
                "width": "5%" 
            },
            {
                "targets": 1,
                "width": "5%" 
            },
            {
                "targets": 6,
                "className": "text-center",
            },
            {
                "targets": 7,
                "className": "text-center",
            },
            {
                "targets": 8,
                "className": "text-center",
            }
        ];
        var footerCallback = function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // converting to integer to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // computing column Total of the complete result 
            var total_obligation = api
                .column( 6 , { page: 'current'})
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0 );
                
            var min_payoff = api
                .column( 7 , { page: 'current'})
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0 );
            var total_payoff = api
                .column( 8 , { page: 'current'})
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0 );

            // Update footer by showing the total with the reference of the column index 
            $( api.column( 6 ).footer() ).html('$ '+ numberWithCommas(total_obligation.toFixed(2)));
            $( api.column( 7 ).footer() ).html('$ '+ numberWithCommas(min_payoff.toFixed(2)));
            $( api.column( 8 ).footer() ).html('$ '+ numberWithCommas(total_payoff.toFixed(2)));
        };
    }
    const buttonformat = {
        columns: column,
        format: {
            body: function (data) { // remove View/Edit/Delete when exporting
                return $('<div></div>')
                .append(data)
                .find('.row-options')
                .remove()
                .end()
                .text()
                .trim()
            }
        }
    };

    var specifictable = $("#myspecificDatatables").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": BASE_URL + myAjaxpath,
        "search": {
            regex: false,
            smart: false
         },
        "dom": 'lBfrtip',
        "lengthMenu":[[5,10,25, 50, 75, -1], [5,10,25, 50, 75, "All"]],
        "iDisplayLength": 10,
        "buttons": [{
            "extend": 'collection',
            "text": 'Export',
            "buttons": [
                {
                    extend: "copy",
                    exportOptions: buttonformat,
                    title: fileTitle
                },
                {
                    extend: "excel",
                    exportOptions: buttonformat,
                    title: fileTitle
                },
                {
                    extend: "csv",
                    exportOptions: buttonformat,
                    title: fileTitle
                },
                {
                    extend: "pdf",
                    exportOptions: buttonformat,
                    title: fileTitle,
                    orientation: orientation,
                    customize : function(doc){ 
                        doc.styles.title.fontSize = 15;
                        doc.styles.tableHeader.fontSize = 10;  
                        doc.styles.tableHeader.alignment = 'left'; 
                        doc.content[1].table.widths = pdfWidth;

                    },
                
                },
                {
                    extend: "print",
                    exportOptions: buttonformat,
                    title: fileTitle,
                    customize : function(doc){ 
                        $(doc.document.body).find('h1').css('font-size', '15pt');
                    },
                }
            ]},
            {
            "extend": 'collection',
            "text": 'Bulk Action',
            "buttons": [{ 
                text: 'Delete',
                className: 'btn-bulk-delete',
                action: function (e, node, config){
                    var id = [];
                    $('input[name="delete"]:checked').each(function (i) {
                        id[i] = $(this).val();
                    });
                    $("#delete-form").attr('action', actionURL);
                    $("#delete-form input#delete-id").val(id);
                    $('#delete-modal').modal('show');
                }
             }
            ]},

            {
                text: '<i class="fa fa-refresh"></i>',
                action: function ( e, dt, node, config ) {
                    dt.ajax.reload();
                }
            }
        ],
        
        "language": {
                    "search": "<i class='fa fa-search'></i>",
                    "searchPlaceholder": "Search...",
                    "processing": '<i class="fa fa-spin fa-spinner text-primary" style="font-size:70px;"></i>',
                    "sLengthMenu": "_MENU_",
                    "infoFiltered": ""
                },
        "columnDefs": [
            {
            "targets": 0,
            "orderable": false,
            "width": "5%" 
            },
            {
                "targets": 1,
                "width": "5%" 
            },
            {
                "targets": 4,
                "oSearch": {
                    "bSmart": false
                }
            },
            
        ],
        "columnDefs": columnTD,
        "footerCallback": footerCallback,
        "order": []
    });
  
    if(path.includes('firms/view')){
        if ( $('input[name="status"]:checked')) {
            specifictable.columns(5).search("1").draw();
        } 
    
        $('input[name="status"]').change(function () {
            if (this.checked) {
                specifictable.columns(5).search("1").draw();
            } else {
                specifictable.columns(5).search("").draw();
            }
        });
    }
    if(path.includes('claimants/view')){
        if ( $('input[name="status"]:checked')) {
            specifictable.columns(4).search("1").draw();
        } 
    
        $('input[name="status"]').change(function () {
            if (this.checked) {
                specifictable.columns(4).search("1").draw();
            } else {
                specifictable.columns(4).search("").draw();
            }
        });
    }

});