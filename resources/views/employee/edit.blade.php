<!DOCTYPE html>
<html>
<head>
    <title>Process Drive - Employees</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css"/>


    
        <link rel="stylesheet" href="{{ asset('css/fSelect.css') }}">
        <script src="{{ asset('js/fSelect.js') }}" defer></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>

        <style type="text/css">
            .container{
                margin-top:100px;
            }
            h2{
                margin-bottom:20px;
                font-size: 30px;
                font-weight: 700;
                
            }
    
</style>

</head>

      

    

        <body>

   @livewire('navigation-dropdown')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Process Drive - Employee</h2>
                </div>
               

            </div>
        </div>
    </div>
   
<div class="container">
    <div class="row">
        <div class="col-md-12 offset-md-2">


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" class="w-200">
  <div class="carousel-inner">

        @foreach($fileuploaded as $key => $slider)

    <div class="carousel-item {{$key == 0 ? 'active' : '' }}" class="d-block w-100">

      <img class="d-block w-100" src="{{ url ('/')}}/storage/uploads/{{ $slider->file_name }}" alt="First slide" class="img-responsive img-fluid">
    </div>
         @endforeach

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    
                <div class="alert alert-danger" style="display:none"></div>

                <form id="employeeForm" name="employeeForm" class="form-horizontal pt-5 pb-10" enctype="multipart/form-data" action="{{ route('employee.store') }}" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="employee_id" id="employee_id" value="{{$editdata->id}}">
                    <div class="form-group">
                        <label for="employee number" class="col-md-8 control-label">Employee Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="emp_no" name="emp_no" placeholder="Enter Employee Number" value="{{$editdata->emp_no}}" maxlength="50" required>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="emp name" class="col-sm-4 control-label">Employee Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee Name" value="{{$editdata->name}}" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emp age" class="col-sm-4 control-label">Employee Age</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="age" name="age" placeholder="Enter Employee Age" value="{{$editdata->age}}" maxlength="50" required>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Date of Birth</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="dob" name="dob" placeholder="Enter Employee DOB" value="{{$editdata->dob}}" maxlength="50" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Employee Address" value="{{$editdata->address}}" maxlength="50" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Position</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="position" name="position" value="{{$editdata->position}}">
                            <option>Select Position...</option>
                            <option value="Manager" @if($editdata->position=="Manager") {{ 'selected'}} @endif >Manager</option>
                            <option value="Senior Manager" @if($editdata->position=="Senior Manager") {{ 'selected'}} @endif >Senior Manager</option>
                            </select>

                        </div>
                    </div>  
 
                     <div class="form-group">
                        <label for="emp dob" class="col-sm-4 control-label">Project</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="project" name="project[]" multiple="multiple">

                    @foreach ($project as $projectkey => $projectvalue)
                           <option value="{{ $projectvalue->id }}"  {!! in_array($projectvalue->id, $projectselected) ? 'selected' : '' !!}>{{ $projectvalue->project_name }}</option>
                    @endforeach 

                            </select>
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="emp file" class="col-sm-4 control-label">File Upload</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="filenames[]" placeholder="file" multiple>
                        </div>
                    </div> 

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update changes</button>
                    </div>
                </form>












            
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