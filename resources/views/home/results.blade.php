@extends('home.layout')

@section('content')
    <div class="container mtb">

            <div class="row">

                @include('partials/errors')

                <!-- FILTROS -->
                <form name="filtros" id="filtros" action="/index.php" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div id="contenido_filtros" class="col-sm-4 col-md-3 hidden-xs">
                    <div class="well well-clear mt formulario_busqueda">
                        <h4><strong>Search</strong></h4>

                        <div class="form-group">
                            <label for="hotel_id">Hotels</label>
                            <select name="hotel_id" id="hotel_id" size="1" class="form-control">
                                <option value="-1" selected="selected">-Selected-</option>
                                @foreach($hotels as $hot)
                                    <option value="{!! $hot->id !!}">Hotel {!! $hot->name !!}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_entrada" class="form-label">Fecha entrada</label>
                            <input name="fecha_entrada" id="fecha_entrada" value="{!! $datestart !!}" class="form-control" data-date-format="dd/mm/yyyy" type="text">
                        </div>

                        <div class="form-group">
                            <label for="fecha_entrada" class="form-label">Fecha salida</label>
                            <input name="fecha_entrada" id="fecha_entrada" value="{!! $dateend !!}" class="form-control" data-date-format="dd/mm/yyyy" type="text">
                        </div>

                        <div class="form-group">
                            <label for="adultos">Adultos</label>
                            <select id="adultos" name="adultos" size="1" class="form-control">
                                <option value="1" {!! ($adults == 1)? 'selected=""' : '' !!} >1</option>
                                <option value="2" {!! ($adults == 2)? 'selected=""' : '' !!} >2</option>
                                <option value="3" {!! ($adults == 3)? 'selected=""' : '' !!} >3</option>
                                <option value="4" {!! ($adults == 4)? 'selected=""' : '' !!} >4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ninos">Niños</label>
                            <select name="ninos" id="ninos" size="1" onchange=" cargarSelectEdadNinos(1,12, this.value,0,'Edad' );" class="form-control">
                                <option value="0" {!! ($children == 0)? 'selected=""' : '' !!}>0</option>
                                <option value="1" {!! ($children == 1)? 'selected=""' : '' !!}>1</option>
                                <option value="2" {!! ($children == 2)? 'selected=""' : '' !!}>2</option>
                                <option value="3" {!! ($children == 3)? 'selected=""' : '' !!}>3</option>
                                <option value="4" {!! ($children == 4)? 'selected=""' : '' !!}>4</option>
                            </select>
                        </div>

                        <input value="Filtrar" onclick="ejecutarFiltros();" class="btn btn-default btn-sm" type="button">
                        <input value="Eliminar Filtros" onclick="eliminarFiltros();" class="btn btn-default btn-sm" type="button">
                    </div>
                </div>
                <!-- END FILTROS -->
                </form>


                <div class="resultados_listado col-sm-8 col-md-9 mt">
                    <div id="pagina_resultados">
                        <!-- BEGIN RESULTADOS -->
                        <div id="resultadosBE" class="bn_reserva_estado">

                            <!-- RECORREMOS LOS ARTICULOS COTIZADOS  -->
                            <div class="well well-white well-small" data-prestatario_nombre="Hotel {!! $hotel->name !!}" >
                                <div class="row ">
                                    <div class="col-md-3 mobile-vertical-margin tablet-vertical-margin ">
                                        <img class="img-full-width borde" alt="Hotel en Polop de la Marina" src="/images/hotel.jpg">
                                    </div>
                                    <div class="col-md-6 ">
                                        <p class="listado_hoteles_titulo">Hotel en Polop de la Marina <span class="categoria stars{!! $hotel->category !!}"></span></p>
                                        <p class="listado_hoteles_direccion">{!! $hotel->address !!}</p>
                                        <div class="listado_hoteles_descripcion hidden-xs line-clamping">
                                            <p>El Hotel Golf Campoamor alberga centro de fitness y más de 100.000 m²
                                                de instalaciones deportivas. Hay pistas de tenis, pádel y críquet a
                                                disposición de los huéspedes.</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class=" mt ml mr">
                                    <div class="row ">
                                        <!-- TIPO DE HABITACION -->
                                        <div class="col-xs-10 col-md-5 mobile-vertical-margin ">
                                            <span class="grey mr">1838</span>
                                            <span name="info_articulo_1838" class="be_articulo_nombre_0">
                                                Deluxe Junior Suite + Alojamiento y desayuno
                                              </span>
                                        </div>
                                        <!-- REGIMEN -->
                                        <div class="col-xs-2 col-md-1 mobile-vertical-margin">
                                            <span class="be_suplemento_afecta_0" title="6237 - Alojamiento y desayuno">(AD)</span>
                                        </div>
                                        <div class="col-xs-9 col-md-2 mobile-vertical-margin div-boton-seleccion" style="display: inline-flex;">
                                            <a href="#" class="btn btn-xs btn-success listado_hoteles_precio "  onclick="">
                                              <span class="be_importe_bajo_peticion habitacion_precio" title="51,89 €" data-cotizacion_sin_formatear="51.891">
                                                51,89€
                                              </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- TIPO DE HABITACION -->
                                        <div class="col-xs-10 col-md-5 mobile-vertical-margin">
                                            <span class="grey mr">1820</span>
                                            <span name="info_articulo_1820" class="be_articulo_nombre_0">
                                                Standard + Alojamiento y desayuno
                                                <!-- informacion del articulo -->
                                              </span>
                                        </div>
                                        <!-- REGIMEN -->
                                        <div class="col-xs-2 col-md-1 mobile-vertical-margin">
                                            <span class="be_suplemento_afecta_0" title="6214 - Alojamiento y desayuno">(AD)</span>
                                        </div>
                                        <div class="col-xs-9 col-md-2 mobile-vertical-margin div-boton-seleccion" style="display: inline-flex;">

                                            <a href="#div_precio_por_dia_748967_1_1820_0_wrapper" class="btn btn-xs btn-success listado_hoteles_precio " data-toggle="collapse" onclick="javascript:mostrarPrecioPorDia_new(1820,'a:2:{i:0;i:6214;i:1;i:6221;}','2017-02-11',1,2,0,'a:0:{}','a:1:{i:0;a:1:{i:0;i:6214;}}',748967,1, '51.891', 'a:0:{}','0',this); return false;">
                                              <span class="be_importe_bajo_peticion habitacion_precio" title="51,89 €" data-cotizacion_sin_formatear="51.891">
                                                51,89€
                                                              </span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- BEGIN pie_prestatarios -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- FIN ARTICULOS COTIZADOS -->
                    </div>
                    <!-- END RESULTADOS -->
                </div>
            </div>
    </div>
@endsection


@section('scripts')

@endsection