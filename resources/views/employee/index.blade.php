@extends('employee-master')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
</x-slot>

@section('content') 
</div>
        </div>
    </div>
    <div class="row">
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewEmployee"> Create New Employee</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table id="dataT">
                        <thead>
                            <tr>
                                <th>Emp ID</th>
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
        <x:notify-messages />

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
            <div class="alert dark alert-danger alert-dismissible ajax_msg" role="alert" >
            </div>
                 {!! Form::open([
                            'method' => 'POST',
                            'role' => 'form' ,
                            'class' => 'form-horizontal form-validate-jquery',
                            'id' => 'employeeForm',
                            'url' => '/employee',
                            'files' => true
                        ])
                    !!}
                    @include('employee/_form')
                {!! Form::close() !!}

            </div>
               <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
</div>
    
@stop
</x-app-layout>
@notifyJs

@notifyCss 

@section('scripts')

{!! Html::script(mix('js/employee.js')) !!}

    
<script type="text/javascript">
    $(function () {
   
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/employee",
        columns: [
            {data: 'id', name: 'id'},
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
     
 

});
</script>
@stop
