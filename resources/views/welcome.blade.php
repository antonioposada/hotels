@extends('home.layout')

@section('content')

    <!-- *****************************************************************************************************************
     HEADERWRAP
     ***************************************************************************************************************** -->
    <div id="headerwrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Welcome to the page of hotel group</h3>
                    <h5>You can book rooms in the best hotels in our group</h5>
                </div>
                <div class="col-lg-8 col-lg-offset-2 himg">
                    <img src="/images/hotel.jpg" class="img-responsive">
                </div>
            </div><!-- /row -->
        </div> <!-- /container -->
    </div><!-- /headerwrap -->

    <!-- *****************************************************************************************************************
     SERVICE LOGOS
     ***************************************************************************************************************** -->
    <div id="service">
        <div class="container">
            <div class="row centered">
                @if (count($hotels) > 0)
                    @foreach($hotels as $hotel)
                        <div class="col-md-4">
                            <h4>Hotel {!! $hotel->name !!}</h4>
                            <p>Welcome to {!! $hotel->name !!}. Category:  {!! $hotel->category !!} {!! $hotel->address !!}</p>
                            <p><br/><a href="{{ url('booking', $hotel->id ) }}" class="btn btn-theme">More Info</a></p>
                        </div>
                    @endforeach
                @else
                    <div class="alert_container col-md-12">
                        <p class="alert alert-danger">No hotels available</p>
                    </div>
                @endif
            </div>
        </div><! --/container -->
    </div><! --/service -->
@endsection
