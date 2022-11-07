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
    
        }
    
    
        .edit {
        background-color: transparent;
        border:transparent;
        color: rgb(255, 238, 0);
    
        }
    
        .pagination{
            background-color: transparent;
        }
</style>

@include('layouts.flash-messages')


<div class="container-xl">
  <div class="table-responsive">
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
                      <h2>Manage <b>Police Station</b></h2>
                  </div>

                  <div class="col-sm-6">
                      <a href="{{ route('policestation.create') }}" class="btn btn-secondary"><i class='bx bxs-plus-circle'></i><span>Create New Record</span></a>
                  </div>
              </div>
          </div>
          
          <table id="policestation-table" class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th scope="col">Police Station ID</th>
                      <th scope="col">Police Station Name</th>
                      <th scope="col">Police Station Commander</th>
                      <th scope="col">Police Station Location</th>
                      <th scope="col">Police Station Schedule</th>
                      <th scope="col">Police Station Contact</th>
                      <th style="width: 100px">Action</th>
                  </tr>
              </thead>  
          </table> 
      </div>
  </div>
@endsection



@section('scripts')
  <script >
    $(document).ready(function() 
    {
      $('#policestation-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('policestations.getPoliceStation') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'policestation_name', name: 'policestation_name' },
              { data: 'policestation_commander', name: 'policestation_commander' },
              { data: 'policestation_location', name: 'policestation_location' },
              { data: 'policestation_schedule', name: 'policestation_schedule' },
              { data: 'policestation_contact', name: 'policestation_contact' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

