@extends('dashboard.master')

@section('content')

    <div class="card mt-4">
        <div class="card-header">
            Listado de Libros Mongo
        </div>
        <div class="card-body">

            <a class="text-white btn btn-success my-2" href="{{ route('book.create') }}"><i class="fa fa-plus"></i>
                Crear</a>


           @include('dashboard.book._filters')
           @include('dashboard.book._details')


            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Años</th>
                        <th>Clasificación</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($books as $b)
                        <tr>
                            <td>{{ $b->_id }}</td>
                            <td>{{ $b->title }}</td>
                            <td>{{ $b->created_at->format('d-m') }} - {{ $b->updated_at->format('d-m') }}</td>
                            <td>{{ $b->price }}</td>
                            <td>{{ $b->age }}</td>
                            <td>
                                {{ implode(',', $b->classification ? $b->classification : []) }}
                            </td>
                            <td>{{ $b->type }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('book.edit', $b->_id) }}"><i
                                        class="fa fa-edit text-white"></i></a>
                                <a data-id="{{ $b->_id }}" data-title="{{ $b->title }}" class="btn btn-sm btn-danger"
                                    href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>






    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar: <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    ¿Seguro que quieres eliminar el registro seleccionado?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    <form id="formDelete" data-action="{{ route('book.destroy', 0) }}"
                        action="{{ route('book.destroy', 0) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <script>
        var deleteModal = document.getElementById('deleteModal')
        deleteModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget

            // Extract info from data-* attributes
            var id = button.getAttribute('data-id')
            var title = button.getAttribute('data-title')

            // form 
            var action = document.getElementById('formDelete').getAttribute('data-action')
            action = action.slice(0, -1)
            document.getElementById('formDelete').setAttribute('action', action + id)

            // Update the modal's content.
            var modalTitle = deleteModal.querySelector('.modal-title span')

            modalTitle.textContent = title
        })

    </script>

@endsection
