@extends('layouts.base')
@include('partials.sidebar2')

@section('body')
<div class="container-xl" style = "margin-left: 120px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Notifications
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                        @forelse($notifications as $notification)
                        @if($notification->status == 'unread')
                            <div class="alert alert-info" role="alert" id="mark">
                                [{{ $notification->created_at }}] {{ $notification->message}}
                                <a id="read" href="#" role="alertss" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                    Mark as read
        
                                </a>
                                
                            </div>
                          
                            @elseif($notification->status == 'read')
                            <div class="alert alert-info" style="background: white" role="alert" id="mark">
                                [{{ $notification->created_at }}] {{ $notification->message}}

                            </div>
                         @endif

                            <!-- @if($loop->last)
                                <a href="#" id="mark-all">
                                    Mark all as read
                                </a>
                            @endif -->
                        @empty
                            There are no new notifications
                        @endforelse
              
                  
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@parent

    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('barangayreport.markNotification') }}", {
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            }
        });
    }

    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                // $(this).parent('div.alert').setAttribute("class", "alert alert-light");
                $(this).parents('div.alert').css({"background": "white"});
                // document.getElementById('mark').setAttribute("class", "alert alert-light");

                $(this).css({"background": "white", "color": "white", "visibility": "hidden"});
                // document.getElementById('read').setAttribute("hidden", "hidden");

            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').css({"background": "white"});
            })
        });
    });

    </script>

@endsection



