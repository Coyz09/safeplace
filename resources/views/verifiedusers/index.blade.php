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
                      <h2>Manage <b>Verified Users</b></h2>
                  </div>
                
              </div>
          </div>
          <table id="verified-table" class="table table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">VerifiedUser ID</th>
                      <th scope="col">VerifiedUser First Name</th>
                      <th scope="col">VerifiedUser Middle Name</th>
                      <th scope="col">VerifiedUser Last Name</th>
                      <th scope="col">VerifiedUser Gender</th>
                      <th scope="col">VerifiedUser Birthdate</th>
                      <th scope="col">VerifiedUser Address</th>
                      <th scope="col">VerifiedUser Contact</th>
                      <th scope="col">VerifiedUser Email</th>

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
      $('#verified-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('verifiedusers.getVerifiedUser') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'fname', name: 'fname' },
              { data: 'mname', name: 'mname' },
              { data: 'lname', name: 'lname' },
              { data: 'gender', name: 'gender' },
              { data: 'birthdate', name: 'birthdate' },
              { data: 'address', name: 'address' },
              { data: 'contact', name: 'contact' },
              { data: 'email', name: 'email' },
              // { data: 'status', name: 'status' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

