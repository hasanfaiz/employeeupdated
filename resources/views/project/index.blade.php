<!DOCTYPE html>
<html>
<head>
    <title>Process Drive - Projects</title>
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


    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


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
                    <h2>Process Drive - Projects</h2>
                </div>
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewProject"> Create New Project</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                                    <div class="alert alert-danger" style="display:none"></div>

                <form id="projectForm" name="projectForm" class="form-horizontal">
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Project Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Enter Project Name" value="" maxlength="50" required>
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
        ajax: "{{ route('project.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'project_name', name: 'project_name'},
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

    $('#createNewProject').click(function () {
        $('#saveBtn').html('Save Changes');
                            $('.alert-danger').hide();

        $('#project_id').val('');
        $('#projectForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProject', function () {
        var project_id = $(this).data('id');
        $.get("{{ route('project.index') }}" +'/' + project_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Project");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#project_id').val(data.id);
            $('#project_name').val(data.project_name);
        })
    });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save Project');
    
        $.ajax({
            data: $('#projectForm').serialize(),
            url: "{{ route('project.store') }}",
            type: "POST",
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

                            $('#projectForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.draw();


                        }



            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Project');
            }
        });
    });

    $('body').on('click', '.deleteProject', function (){
        var project_id = $(this).data("id");
        var result = confirm("Are You sure want to delete !");
        if(result){
            $.ajax({
                type: "DELETE",
                url: "{{ route('project.store') }}"+'/'+project_id,
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
});
</script>
        @livewireScripts

</html>