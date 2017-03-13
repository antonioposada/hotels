@extends('layouts.app')

@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Rooms</div>
                    <div class="panel-body">
                        <approom></approom>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="js/app.js"></script>
@endsection
