@extends('home.layout')

@section('content')

    <div class="container mtb">
        <h3>HOTEL {!! $hotel->name !!} Category: {!! $hotel->category !!}</h3>
        <div class="row">

            <div class="col-lg-6">
                <img class="img-responsive" src="/images/hotel.jpg" alt="">
            </div>

            <div class="col-lg-6">
                <div class="well formulario_busqueda formulario_num_ocupaciones">
                    @include('partials/errors')
                    <form name="buscar_hotel_{!! $hotel->id !!}" id="buscar_hotel_{!! $hotel->id !!}" method="post" action="\results">
                        {{ csrf_field() }}
                        <input value="{!! $hotel->id !!}" name="hotel_id" type="hidden">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group campos">
                                    <label for="fecha_entrada" class="form-label">Fecha entrada</label>
                                    <input name="fecha_entrada" id="fecha_entrada" value="11/02/2017" class="fecha form-control hasDatepicker" data-date-format="dd/mm/yyyy" type="text">
                                    <input id="minDateClase" value="1" type="hidden">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group campos">
                                    <label for="fecha_salida" class="form-label">Fecha salida</label>
                                    <input id="fecha_salida" name="fecha_salida" value="12/02/2017" class="fecha form-control hasDatepicker" data-date-format="dd/mm/yyyy" type="text">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group" style="position:relative;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6" id="campos_adultos_1">
                                                    <div class="form-group">
                                                        <label for="adultos">Adultos</label>
                                                        <select id="adultos" name="adultos" size="1" class="form-control num_ocupaciones num_adultos_1">
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2" selected="selected">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="campos_ninos_1">
                                                    <div class="form-group">
                                                        <label for="ninos">Niños</label>
                                                        <select name="ninos" id="ninos" size="1" onchange=" cargarSelectEdadNinos(1,12, this.value,0,'Edad' );" class="form-control num_ocupaciones num_ninos_1">
                                                            <option value="0" selected="selected">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div id="div_edad_nino_1"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="buscar" value="Buscar" class="btn btn-primary btn-md btn-block frm_buscar buscar_hotel enviar_formulario_busqueda" type="submit">
                                </div>
                            </div>

                            <div class="clearfix"></div>

                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <p>{!! $hotel->address !!}</p>
            </div>
        </div><! --/row -->
    </div><! --/container -->
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#fecha_entrada').datepicker({
                todayHighlight: true
            });
            $('#fecha_salida').datepicker({
                todayHighlight: true
            });
        });
    </script>


@endsection