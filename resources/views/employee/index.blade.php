
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html>
<head>
    <title>Process Drive - Employees</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/fSelect.css') }}">
    <script src="{{ asset('js/fSelect.js') }}" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css"/>


</head>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>

        <style type="text/css">
    .container{
        margin-top:150px;
    }
    h2{
        margin-bottom:30px;
        font-size: 30px;
        font-weight: 700;
        
    }
</style>

        <body>

   @livewire('navigation-dropdown')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Process Drive - Employee</h2>
                </div>
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewEmployee"> Create New Employee</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>Emp Name</th>
                                 <th>Emp DOB</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>

                <form id="employeeForm" name="employeeForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id" id="employee_id">
                    <div class="form-group">
                        <label for="employee number" class="col-sm-4 control-label">Employee Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="emp_no" name="emp_no" placeholder="Enter Employee Number" value="" maxlength="50" required>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="emp name" class="col-sm-4 control-label">Employee Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee Name" value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emp age" class="col-sm-4 control-label">Employee Age</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="age" name="age" placeholder="Enter Employee Age" value="" maxlength="50" required>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Date of Birth</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="dob" name="dob" placeholder="Enter Employee DOB" value="" maxlength="50" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Employee Address" value="" maxlength="50" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Position</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="position" name="position">
                            <option selected>Select Position...</option>
                            <option value="Manager">Manager</option>
                            <option value="Senior Manager">Senior Manager</option>
                            </select>
                        </div>
                    </div>  

                     <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Project</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="project" name="project[]" multiple="multiple">
                            @foreach ($project as $p)
                            
                            <option value="{{ $p->id }}">{{ $p->project_name }}</option>

                            @endforeach 

                            </select>
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="emp file" class="col-sm-4 control-label">File Upload</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="filenames[]" placeholder="file" multiple id="file">
                        </div>
                    </div> 



                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
            </div>
               <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
</div>
    
</body>
    
<script type="text/javascript">
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
</script>
        @livewireScripts

</html>