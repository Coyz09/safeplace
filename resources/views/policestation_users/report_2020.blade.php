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

  .edit {
  background-color: transparent;
  border:transparent;
  color: black;

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
                    @foreach($users as $user)
                      <h2>Manage <b>{{$user->name}}</b></h2>
                      @endforeach
                  </div>
                  <div class="col-sm-6">
                  </div>
              </div>
          </div>
          <a href="{{ route('policestation_user.index')}}"  class="edit"><i class='bx bx-detail' ></i>2023</a>
          <a href="{{ route('policestation_user.reports2022')}}"  class="edit"><i class='bx bx-detail' ></i>2022</a>
          <a href="{{ route('policestation_user.reports2021')}}"  class="edit"><i class='bx bx-detail' ></i>2021</a>
          <a href="{{ route('policestation_user.reports2020')}}"  class="edit"><i class='bx bx-detail' ></i>2020</a>

          <table id="policestation_reports-table" class="table table-striped table-hover">
              <thead>
                  <tr>

                      <th scope="col">Report ID</th> 
                      <th scope="col">Incident Type</th>
                      <th scope="col">Barangay</th>
                      <th scope="col">Street</th>                     
                      <th scope="col">Date Reported</th>
                      <th scope="col">Time Reported</th>
                      <th scope="col">Date Committed</th>
                      <th scope="col">Time Committed</th>

                      <th style="width: 100px">View Report</th>
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
      $('#policestation_reports-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: '{!! route('policestation_user.getPoliceStationReports2020') !!}',
            columns: [
              { data: 'id', name: 'id' },
              { data: 'incident_type', name: 'incident_type' },
              { data: 'barangay', name: 'barangay' },
              { data: 'street', name: 'street' },
              { data: 'date_reported', name: 'date_reported' },
              { data: 'time_reported', name: 'time_reported' },
              { data: 'date_commited', name: 'date_commited' },
              { data: 'time_commited', name: 'time_commited' },
              { data: 'action', name: 'action', orderable: false},
             ]
        });
  });

  </script>
  @endsection

