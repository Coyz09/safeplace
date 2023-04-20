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
  font-size: 30px

  }


  .edit {
  background-color: transparent;
  border:transparent;

  font-size: 30px

  }

  .edit2 {
  background-color: transparent;
  border:transparent;
  color: black;


  }

  .pagination{
      background-color: transparent;
  }

  .table-striped {
  font-size: 19px;
}
</style>



@include('layouts.flash-messages2')

<div class="container-xl" style = "margin-left: 120px;">
  <div class="table-responsive">
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
                         
                  <h2>Police Substation <b>Archives </b></h2>
                  </div>
                  <div class="col-sm-6">
                  </div>
              </div>
          </div>
          <!-- <a href="{{ route('policestation_user.index')}}"  class="edit2"><i class='bx bx-detail' ></i>2023</a>
          <a href="{{ route('policestation_user.reports2022')}}"  class="edit2"><i class='bx bx-detail' ></i>2022</a>
          <a href="{{ route('policestation_user.reports2021')}}"  class="edit2"><i class='bx bx-detail' ></i>2021</a>
          <a href="{{ route('policestation_user.reports2020')}}"  class="edit2"><i class='bx bx-detail' ></i>2020</a>
          
    -->

          <table id="policestation_reports-table" class="table-responsive table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">Report ID</th> 
                      <th scope="col">Complainant Name</th>
                      <th scope="col">Complainant Contact</th>
                      <th scope="col">Incident Type</th>
                      <th scope="col">Barangay</th>
                      <th scope="col">Street</th>                     
                      <th scope="col">Date Reported</th>
                      <th scope="col">Time Reported</th>
                      <th scope="col">Year Reported</th>
                      <th scope="col">Report Status</th>
                      <th style="width: 100px">View Report</th>
                  </tr>
              </thead>

          </table>

          <!-- <a href="{{ route('user.logout') }}" class="log-out">
            <i class='text-light bx bx-log-out'></i>
          </a> -->

  </div>
</div>
@endsection




@section('scripts')
  <script >
    $(document).ready(function()
    {
      $('#policestation_reports-table').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, 'desc'],[6, 'desc'],[7, 'desc'],[8, 'desc']],
            ajax: '{!! route('admin.getPoliceArchives') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'complainant_name', name: 'complainant_name' },
              { data: 'complainant_contact', name: 'complainant_contact' },
              { data: 'incident_type', name: 'incident_type' },
              { data: 'barangay', name: 'barangay' },
              { data: 'street', name: 'street' },
              { data: 'date_reported', name: 'date_reported' },
              { data: 'time_reported', name: 'time_reported' },
              { data: 'year_reported', name: 'year_reported' },
              { data: 'report_status', name: 'report_status' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

