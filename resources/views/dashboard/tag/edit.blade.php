@extends('dashboard.master')

@section('content')

    <div class="card mt-4">
        <div class="card-header">
            Editar libro: {{ $tag->title }}
        </div>
        <div class="card-body">

            @include('dashboard.partials.errors-form')

            <form action="{{ route('tag.update',$tag->_id) }}" method="post">
                @method('PUT')
                @include('dashboard.tag._form')
                <input type="submit" value="Actualizar" class="mt-3 btn btn-success">

            </form>

        </div>
    </div>

@endsection
