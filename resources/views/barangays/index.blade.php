

@extends('layouts.base')
@include('partials.sidebar')


@section('body')
<style>
        .message    {
        margin-left: 250px;
        margin-bottom: 200px;
        }
    
    
        .delete {
        background-color: transparent;
        border:transparent;
        color: red;
        font-size: 25px
        }
    
    
        .edit {
        background-color: transparent;
        border:transparent;
        color: rgb(255, 238, 0);
        font-size: 25px
        }
    
        .pagination{
            background-color: transparent;
        }
</style>

@include('layouts.flash-messages2')

    
<div class="container-xl" style = "margin-left: 120px;">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Barangay</b></h2>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('barangay.create') }}" class="btn btn-secondary"><i class='bx bxs-plus-circle'></i><span>Create New Record</span></a>
                    </div>
                </div>
            </div>
            
            <table id="barangay-table" class="table-responsive table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Barangay ID</th>
                        <th scope="col">Barangay Name</th>
                        <th scope="col">Barangay Captain</th>
                        <th scope="col">Barangay Location</th>
                        <th scope="col">Barangay Schedule</th>
                        <th scope="col">Barangay Contact</th>
                        <th scope="col">Barangay Image</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>  
            </table> 
        </div>
    </div>
@endsection
    
 @section('scripts')
    <script>
        $(document).ready(function(){
          $('#barangay-table').DataTable({
            processing:true,
            serverSide:true,
            ajax: '{!! route('barangays.getBarangay') !!}',
            columns: [
            { data: 'id',   name: 'id' },
            { data: 'barangay_name', name: 'barangay_name' },
            { data: 'barangay_captain', name: 'barangay_captain' },
            { data: 'barangay_location', name: 'barangay_location' },
            { data: 'barangay_schedule', name: 'barangay_schedule' },
            { data: 'barangay_contact', name: 'barangay_contact' },
            { data: 'img', name: 'img',
              "render": function (data, type, full, meta) {
                  return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";
              },orderable: false},
            {data: 'action', name: 'action', orderable: false},
           
            ]
          });
        });
    </script>
@endsection
    
    
    


    
  

