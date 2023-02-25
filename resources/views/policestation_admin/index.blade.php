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
    x
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
                      <h2>Manage <b>Police Station Accounts</b></h2>
                  </div>

                  <div class="col-sm-6">
                      <a href="{{ route('policestationadmin.create') }}" class="btn btn-secondary"><i class='bx bxs-plus-circle'></i><span>Create New Record</span></a>
                  </div>

              </div>
          </div>
          <table id="user-table" class="table table-striped table-hover">
              <thead>
                  <tr>


                      <th scope="col">Police Station Account ID</th>
                      <th scope="col">Police Station Account Name</th>
                      <th scope="col">Police Station Account Email</th>
                      <th scope="col">Police Station Account Role</th>
                      <th scope="col">Police Station Account Image</th>
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
      $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('policestationaccounts.getPoliceStationAccounts') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'email', name: 'email' },
              { data: 'role', name: 'role' },
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
    
    
    


    
  

