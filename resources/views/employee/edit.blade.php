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
        <div class="col-md-12 offset-md-2">


   
                <div class="alert alert-danger" style="display:none"></div>

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
                    @include('employee/_edit')
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

@stop
