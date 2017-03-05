@extends('layouts.app')

@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Hotels</div>
                    <div class="panel-body">
                        <apphotel></apphotel>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="js/app.js"></script>
@endsection
