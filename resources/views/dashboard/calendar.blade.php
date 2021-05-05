@extends('dashboard.master')

@section('content')

    <div id="calender" class="my-3"></div>

    <div class="modal fade" id="saveEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row" id="eventContainer">
                    <div class="col-md-9">
                        <div class="modal-body">

                            <button id="removeEvent" class="btn btn-sm btn-danger float-right"><i
                                    class="fa fa-trash"></i></button>
                            <br>

                            <label class="d-block"><input type="checkbox" id="allDay"> Todo el día: </label>
                            <input type="time" id="time" class="form-control mb-3 d-none">

                            <label for="title" id="ltitle">Título <span class="text-danger"></span></label>
                            <input type="text" id="title" class="form-control">
                            <label for="content" id="lcontent">Contenido <span class="text-danger"></span></label>
                            <textarea id="content" class="form-control"></textarea>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="colorText">Color de Texto</label>
                                    <input type="color" id="colorText" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="colorBg">Color de Fondo</label>
                                    <input type="color" id="colorBg" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="modal-header">
                            <h6 class="modal-title">Archivos</h6>
                        
                        </div>
                        <div class="modal-body">
                            <form class="d-none" id="FormField" action="" data-action="{{ route('event.file', '0') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col">
                                        <span id="buttonFormField" class="btn btn-success">Enviar</span>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>
                    <div class="col-md-3 border-left">
                        Listado


                        <ul id="boxFiles">
                        </ul>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="addEvent" class="btn btn-success"><i class="fa fa-plus"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/calendar.js') }}"></script>

    <script>


    </script>



@endsection
