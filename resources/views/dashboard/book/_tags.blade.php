<div class="row">

    <div class="col-10">
        <select class="form-control" id="tag_id">
            @foreach ($tags as $title => $id)
                <option value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <button class="btn btn-success" id="tag_save">Enviar</button>
    </div>
</div>

<div id="tags_buttons">
    @foreach ($book->tags as $t)
        <button id="{{ $t->_id }}" class="tag_delete _{{ $t->_id }} btn btn-danger btn-sm mt-2 ml-1"><i
                class="fa fa-trash"></i>
            {{ $t->title }}</button>
    @endforeach
</div>
<script>
    document.querySelector("#tag_save").addEventListener("click", function() {

        stag_id = document.querySelector("#tag_id")
        tag_id = stag_id.value
        tag_text = stag_id.options[stag_id.selectedIndex].text
        axios.get("/dashboard/tag/add/{{ $book->_id }}/" + tag_id).then(function(res) {

            // validar que existe boton
            if (document.querySelector("._" + tag_id) != null) return

            document.querySelector("#tags_buttons").innerHTML += '<button id="' + tag_id +
                '" class="tag_delete _' + tag_id +
                ' btn btn-danger btn-sm mt-2 ml-1"><i class="fa fa-trash"></i> ' + tag_text +
                '</button>'
            tags_delete()

        });

    });

    function tags_delete() {
        document.querySelectorAll(".tag_delete")
            .forEach(item => {
                item.addEventListener("click", function() {

                    b = this
                    tag_id = b.id
                    
                    axios.get("/dashboard/tag/destroy/{{ $book->_id }}/" + tag_id).then(function(res) {
                        b.remove()
                    });
                });
            })


    }

    tags_delete()

</script>
