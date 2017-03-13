@extends('layouts.app')

@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $hotel->name }} </div>
                    <div class="panel-body">
                        <h3>Services ({{ count($hotel->services) }})</h3>

                        @include('partials/errors')

                        <div class="row">
                            <div class="col-md-12">
                                <form name="add_service_hotel_{!! $hotel->id !!}" id="add_service_hotel_{!! $hotel->id !!}"
                                      method="post" action="{{  url('/hotelservices/'. $hotel->id) }}">
                                    {{ csrf_field() }}
                                    <input value="{!! $hotel->id !!}" name="hotel_id" type="hidden">
                                    <div class="col-md-6">
                                        <select id="service_id" name="service_id" class="form-control">
                                            <option value="-1">-Select service-</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn-primary btn-lg" value="Add service">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <form name="delete_service_hotel" id="delete_service_hotel"
                                  method="post" action="{{  url('/deleteservice') }}">
                                {{ csrf_field() }}
                                <input value="{{ $hotel->id }}" name="hotel_id" type="hidden">
                                <input value="" name="service_id" id="delete_service_id" type="hidden">
                            </form>
                        @foreach ($hotel->services as $service)
                            <div class="col-md-3">
                                <span class="tag label label-default">
                                    {{ $service->name }}
                                    <a href="#" onclick="event.preventDefault();deleteService('{{ $service->id }}');">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </span>
                            </div>
                        @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function deleteService(service_id){
            var x = confirm("Are you sure to delete this service?");
            if (x) {
                document.getElementById('delete_service_id').value = service_id;
                document.getElementById('delete_service_hotel').submit();
            }else {
                return false;
            }
        }
    </script>
@endsection