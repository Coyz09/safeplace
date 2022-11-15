@extends('layouts.admin')
@section('body')

<div class="card">
   

    <div class="card-body">
        <form method="POST" action="{{ route("policestation.store") }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                 {!!Form::label('PoliceStation Location:')!!}
                <input class="form-control map-input {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('policestation_location') }}">
                <input type="text" name="latitude" id="address-latitude" value="{{ old('latitude') ?? '0' }}" />
                <input type="text" name="longitude" id="address-longitude" value="{{ old('longitude') ?? '0' }}" />
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                    @endif
                <!-- <span class="help-block">{{ trans('cruds.shop.fields.address_helper') }}</span> -->
              
            </div>
            <div id="address-map-container" class="mb-2" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script>
<script src="/js/mapInput.js"></script>

@endsection