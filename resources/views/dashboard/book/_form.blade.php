@csrf

<label for="title">Título</label>
<input name="title" id="title" type="text" class="form-control" value="{{ old('title', $book->title) }}">

<label for="age">Año</label>
<input name="age" id="age" type="numeric" class="form-control" value="{{ old('age', $book->age) }}">

<label for="category_id">Categoría</label>

<select class="form-control" name="category_id" id="category_id">
    @foreach ($categories as $title => $id)
        <option {{ $book->category_id == $id ? 'selected' : '' }} value="{{ $id }}">{{ $title }}</option>
    @endforeach
</select>

<label for="age">Precio</label>
<input name="price" id="price" type="numeric" class="form-control" value="{{ old('price', $book->price) }}">

<label for="type">Tipo</label>
<input  list="types" type="text" name="type" id="type" class="form-control" value="{{ old('type', $book->type) }}">

<datalist id="types">
    <option value="Infantil">
    <option value="Todo público">
    <option value="Adultos">
    <option value="Adolescentes">
    <option value="Otro">
    <option value="Para mujeres">
</datalist>

<label>Clasificación</label>

<div class="btn-group mt-2" data-toggle="buttons">
    <label class="btn btn-primary active">
        A <input {{ in_array('A', old('classification',$book->classification ? $book->classification : [])) ? 'checked' : '' }} value="A" type="checkbox" name="classification[]">
    </label>
    <label class="btn btn-primary">
        B <input {{ in_array('B', old('classification',$book->classification ? $book->classification : [])) ? 'checked' : '' }} value="B" type="checkbox" name="classification[]">
    </label>
    <label class="btn btn-primary">
        C <input {{ in_array('C', old('classification',$book->classification ? $book->classification : [])) ? 'checked' : '' }}  value="C" type="checkbox" name="classification[]">
    </label>
</div>

<div class="clearfix"></div>


<label for="description">Descripción</label>

<textarea id="description" name="description" class="form-control">
{{ old('description', $book->description) }}
</textarea>
