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

@include('layouts.flash-messages')

<div class="container-xl" style = "margin-left: 120px;">  <div class="table-responsive">
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
                      <h2>Manage <b>Hospitals</b></h2>
                  </div>
                  <div class="col-sm-6">
                      <a href="{{ route('hospital.create') }}" class="btn btn-secondary"><i class='bx bxs-plus-circle'></i><span>Create New Record</span></a>
                  </div>
              </div>
          </div>
          <table id="hospital-table" class="table-responsive table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">Hospital ID</th>
                      <th scope="col">Hospital Name</th>
                      <th scope="col">Hospital Type</th>
                      <th scope="col">Hospital Medical Director</th>
                      <th scope="col">Hospital Location</th>
                      <th scope="col">Hospital Schedule</th>
                      <th scope="col">Hospital Contact</th>
                      <th scope="col">Hospital Image</th>

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
      $('#hospital-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('hospitals.getHospital') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'hospital_name', name: 'hospital_name' },
              { data: 'hospital_type', name: 'hospital_type' },
              { data: 'hospital_medical_director', name: 'hospital_medical_director'},
              { data: 'hospital_location', name: 'hospital_location' },
              { data: 'hospital_schedule', name: 'hospital_schedule' },
              { data: 'hospital_contact', name: 'hospital_contact' },
              { data: 'img', name: 'img',
              "render": function (data, type, full, meta) {
                  return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";
              },orderable: false},
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

