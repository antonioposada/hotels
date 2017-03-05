<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- seguridad -->
    <meta name="token" id="token" content="{{ csrf_token() }}"/>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
</head>
<script type="text/javascript">
    /* <![CDATA[ */
    setTimeout(function(){
        var calIn = jQuery( "#date-in" ).datepicker({ disabled: false, altField: "#us-date-in", altFormat: 'dd/mm/yy', minDate:0, onSelect: checkCalendarDates, dateFormat: 'dd/mm/yy'});
        calIn.datepicker('setDate', new Date());

        var calOut = jQuery( "#date-out" ).datepicker({ disabled: false, altField: "#us-date-out", altFormat: 'dd/mm/yy', minDate:1, onSelect: checkCalendarDates, dateFormat: 'dd/mm/yy'});
        calOut.datepicker('setDate', new Date());

        $('#date-in').val('Check in');
        $('#date-out').val('Check out');

        function checkCalendarDates(date, datePickerO)
        {
            var dateIn = calIn.datepicker("getDate");
            var dateOut = calOut.datepicker("getDate");

            if(dateIn >= dateOut && calIn.attr("id") === datePickerO.id)
                calOut.datepicker('setDate', new Date( dateIn.getTime() + (24 * 60 * 60 * 1000) ));

            if(dateOut <= dateIn && calOut.attr("id") === datePickerO.id)
                calIn.datepicker('setDate', new Date( dateOut.getTime() - (24 * 60 * 60 * 1000) ));
        }

        /***Custom Validate***/
        jQuery("button.go").click(function(e){
            jQuery('#booking-form .item .validate').each(function(){
                var arr = ['Check in', 'Check out'];
                var getVal = jQuery(this).val();
                if(jQuery.inArray(getVal,arr)!= -1){
                    e.preventDefault();
                    alert("Por favor seleccione "+getVal);
                    return false;
                }else{
                    return true;
                }
            });

            var getAdults = jQuery('#availability-checker div.selector select#adults').val();
            if(getAdults=="Adultos"){
                jQuery('#availability-checker div.selector select#adults').val("2");
            }
            var getRooms = jQuery('#availability-checker div.selector select#rooms').val();
            if(getRooms=="Habitaciones"){
                jQuery('#availability-checker div.selector select#rooms').val("1");
            }
        });

    },9);
    /* ]]> */
</script>
<body>
<div class="flex-center position-ref full-height">
    <div class="booking-mask-wrapper">
        <span class="bookingmask-overlay"></span>
        <div id="availability-checker">

            <div class="best-rate">
                @if (Route::has('login'))
                    <div class="top-right links form-inline">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>


    </div>

    <div class="content">
        <div class="title m-b-md">
            Search
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
</body>
</html>
