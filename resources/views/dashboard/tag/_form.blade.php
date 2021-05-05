@csrf

<label for="title">Título</label>
<input name="title" id="title" type="text" class="form-control" value="{{ old('title', $tag->title) }}">
