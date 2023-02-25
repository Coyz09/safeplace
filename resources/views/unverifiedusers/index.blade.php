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
                      <h2>Manage <b>Unverified Users</b></h2>
                  </div>
                
              </div>
          </div>
          <table id="unverified-table" class="table table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">UnverifiedUser ID</th>
                      <th scope="col">UnverifiedUser First Name</th>
                      <th scope="col">UnverifiedUser Middle Name</th>
                      <th scope="col">UnverifiedUser Last Name</th>
                      <th scope="col">UnverifiedUser Email</th>
                      <th scope="col">UnverifiedUser Status</th>
                      <th scope="col">Verification Attempt</th>
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
      $('#unverified-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('unverifiedusers.getUnverifiedUser') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'fname', name: 'fname' },
              { data: 'mname', name: 'mname' },
              { data: 'lname', name: 'lname' },
              { data: 'email', name: 'email' },
              { data: 'status', name: 'status' },
              { data: 'verification_attempt', name: 'verification_attempt' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

