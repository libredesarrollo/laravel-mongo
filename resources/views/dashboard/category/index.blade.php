@extends('dashboard.master')

@section('content')

    <div class="card mt-4">
        <div class="card-header">
            Listado de Categorías Mongo
        </div>
        <div class="card-body">

        <a class="text-white btn btn-success my-2" href="{{route('category.create')}}"><i class="fa fa-plus"></i> Crear</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Creación</th>
                        <th>Actualido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $c)
                        <tr>
                            <td>{{ $c->_id }}</td>
                            <td>{{ $c->title }}</td>
                            <td>{{ $c->created_at->format('d-m-Y') }}</td>
                            <td>{{ $c->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('category.edit', $c->_id) }}"><i
                                        class="fa fa-edit text-white"></i></a>
                                <a data-id="{{ $c->_id }}" data-title="{{ $c->title }}" class="btn btn-sm btn-danger"
                                    href="#" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
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

                    <form id="formDelete" data-action="{{ route('category.destroy', 0) }}"
                        action="{{ route('category.destroy', 0) }}" method="post">
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
