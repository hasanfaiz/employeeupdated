    $(function () {

     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employee.index') }}",
        columns: [
            {data: 'emp_no', name: 'emp_no'},
            {data: 'name', name: 'name'},
            {data: 'age', name: 'age'},
            {data: 'dob', name: 'dob'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
        buttons: [
          'excel', 'pdf'
        ],
    });
     
     $('#DataTables_Table_0_length').css("width", 200);
     $('.buttons-html5').css("padding", '0.1em 1em');
     $('.buttons-html5').css("background-color", '#007bff');

    $('#createNewEmployee').click(function () {
//      $('#project').selectmenu('refresh');
       // $('#ajaxModel').html().selectmenu('refresh', true);


        $('#saveBtn').html('Save Changes');
        $('.alert-danger').hide();
        $('#employee_id').val('');
        $('#employeeForm').trigger("reset");
        $('#modelHeading').html("Create New Employee");
        $('#ajaxModel').modal('show');
        $('#saveBtn').val("create-user");


    });
    
    $('body').on('click', '.editEmployee', function () {
        var employee_id = $(this).data('id');
        // $('#project').fSelect('destroy');

        var url = "{{ route('employee.index') }}" +'/' + employee_id +'/edit';
        window.location = url

        /*$.get("{{ route('employee.index') }}" +'/' + employee_id +'/edit', function (data) {



            //console.log(data.employee, "Data");
            //console.log(data.selected_projects, "selected_projects");
            //console.log(data.selected_file, "selected_file");

            $('#modelHeading').html("Edit Employee");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#employee_id').val(data.employee.id);
            $('#emp_no').val(data.employee.emp_no);
            $('#name').val(data.employee.name);
            $('#age').val(data.employee.age);
            $('#dob').val(data.employee.dob);
            $('#address').val(data.employee.address);
            $('#position').val(data.employee.position);

            // $('#project').val(data.employee.project);
            //$('#project').fSelect('destroy');

             var i=0;
             $("#project option").each(function () {
             if ($(this).val() == data.selected_projects[i]) {
                 $(this).attr('selected', 'selected');
                 i++;

             }
                 
            })
             $('#project').fSelect('reload');

        })*/
    });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save Employee');
        var formData = new FormData(document.getElementById("employeeForm"));

        $.ajax({
            type: "POST",
            url: "{{ route('employee.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                    if(data.errors)
                        {
                            $('.alert-danger').html('');

                            $.each(data.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#employeeForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.draw();
                            //console.log('Data Log:', data);
                        }
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Employee');
            }
        });
    });

    $('body').on('click', '.deleteEmployee', function (){
        var employee_id = $(this).data("id");
        var result = confirm("Are You sure want to delete !");
        if(result){
            $.ajax({
                type: "DELETE",
                url: "{{ route('employee.store') }}"+'/'+employee_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            return false;
        }
    });

        $('#dob').datepicker({
            orientation: "left",
            weekStart: 1,
            autoclose: true,
            format: 'dd.mm.yyyy',
            clearBtn: true,
            todayHighlight: true,
            allowClear: true
        });

      // $('#project').fSelect();

    /*var placeholder = $('#project').attr('data-placeholder');
    var searchText = $('#project').attr('data-search');
    var overflowText = $('#project').attr('data-overflowtext');
    $('#project').fSelect({
        placeholder: placeholder,
        searchText: searchText,
        overflowText: overflowText
    });
    $("#project").siblings('div .fs-dropdown').find('.fs-option').removeClass('disabled');
*/

$('#project').fSelect({
    placeholder: 'Select some options',
    numDisplayed: 5,
    overflowText: '{n} selected',
    noResultsText: 'No results found',
    searchText: 'Search',
    showSearch: true
});


}); 