@extends('layouts.base')
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
                      <h2>Manage <b>Barangay Reports</b></h2>
                  </div>
                  <div class="col-sm-6">
                  </div>
              </div>
          </div>
          <table id="barangay_reports-table" class="table table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">Report ID</th>
                      <th scope="col">Report Title</th>
                      <th scope="col">Report Details</th>
                      <th scope="col">Report Status</th>

                      <th style="width: 100px">Action</th>
                  </tr>
              </thead>

          </table>


        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>

  </div>
</div>
@endsection




@section('scripts')
  <script >
    $(document).ready(function()
    {
      $('#barangay_reports-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('barangay_user.getBarangayReports') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'report_title', name: 'report_title' },
              { data: 'report_details', name: 'report_details' },
              { data: 'report_status', name: 'report_status' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

