@extends('layouts.app')

@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $room->name }} </div>
                    <div class="panel-body">
                        <h3>Rates ({{ count($room->rates) }})</h3>

                        @include('partials/errors')

                        <div class="row">
                            <div class="col-md-12">
                                <form name="add_service_hotel_{!! $room->id !!}" id="add_service_hotel_{!! $room->id !!}"
                                      method="post" action="{{  url('/roomrates/'. $room->id) }}">
                                    {{ csrf_field() }}
                                    <input value="{!! $room->id !!}" name="room_id" type="hidden">
                                    <div class="col-md-6">
                                        <select id="rate_id" name="rate_id" class="form-control">
                                            <option value="-1">-Select rate-</option>
                                            @foreach ($rates as $rate)
                                                <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn-primary btn-lg" value="Add rate">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <form name="delete_rate_room" id="delete_rate_room"
                                  method="post" action="{{  url('/deleterate') }}">
                                {{ csrf_field() }}
                                <input value="{{ $room->id }}" name="room_id" type="hidden">
                                <input value="" name="rate_id" id="delete_rate_id" type="hidden">
                            </form>
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Name</th>
                                        <th>Begin</th>
                                        <th>End</th>
                                        <th>Price</th>
                                        <th>Avalability</th>
                                        <th width="75px">&nbsp;</th>
                                    </tr>
                                @foreach ($room->rates as $rate)
                                    <tr>
                                        <td>{{ $rate->name }}</td>
                                        <td>{{ $rate->begin_date }}</td>
                                        <td>{{ $rate->end_date }}</td>
                                        <td>{{ $rate->price }}</td>
                                        <td>{{ $rate->avalability }}</td>
                                        <td>
                                            <a href="#" onclick="event.preventDefault();deleteRate('{{ $rate->id }}');">
                                                <span class="alert-danger glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function deleteRate(rate_id){
            var x = confirm("Are you sure to delete this service?");
            if (x) {
                document.getElementById('delete_rate_id').value = rate_id;
                document.getElementById('delete_rate_room').submit();
            }else {
                return false;
            }
        }
    </script>
@endsection