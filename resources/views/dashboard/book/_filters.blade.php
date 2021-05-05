<style>
    #mode_data_value {
        position: absolute;
        margin-left: 22px;
    }

</style>

<form>
    <div class="row">
        <div class="col-md-3">
            <label class="mb-3">Clasificación</label>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary active">
                    A <input 
                    {{ request('classification') && in_array('A', request('classification')) ? 'checked' : '' }}
                    value="A" type="checkbox" name="classification[]">
                </label>
                <label class="btn btn-primary">
                    B <input 
                    {{ request('classification') && in_array('B', request('classification')) ? 'checked' : '' }}
                    value="B" type="checkbox" name="classification[]">
                </label>
                <label class="btn btn-primary">
                    C <input {{ request('classification') && in_array('C', request('classification')) ? 'checked' : '' }} value="C" type="checkbox" name="classification[]">
                </label>
            </div>
        </div>

        <div class="col-md-3">
            <label class="mb-3" for="type">Tipo</label>
        <input list="types" type="text" name="type" id="type" class="form-control" value="{{ request('type') }}">

            <datalist id="types">
                @foreach ($types as $t)
                    <option value="{{ $t }}">
                @endforeach

            </datalist>

        </div>

        <div class="col-md-4">
            <select name="mode_type" class="form-control form-control-sm mb-2">
                <option value="price">Precio</option>
                <option value="age">Año</option>
            </select>
        <label id="mode_data_value" class="badge btn-primary">{{ request('mode_data') }}</label>
            <input value="{{ request('mode_data') ? request('mode_data') : 0}}" min="0" max="600" step="5" name="mode_data" type="range"
                class="form-control-range w-100 mt-4">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-success text-white"><i class="fa fa-filter"> Enviar</i></button>
        </div>

    </div>
</form>


<script>
    document.querySelector("[name=mode_data]").addEventListener('change', function() {
        document.querySelector("#mode_data_value").innerText = this.value
    })

    document.querySelector("[name=mode_type]").addEventListener('change', function() {
        var range = document.querySelector("[name=mode_data]");

        if (this.value == "age") {
            range.setAttribute('min', 1970)
            document.querySelector("#mode_data_value").innerText = 1970
            range.setAttribute('max', "{{date('Y')}}")
            range.setAttribute('step', 10)
            range.value = 1970
        } else {
            // precio
            range.setAttribute('min', 0)
            range.setAttribute('max', 600)
            document.querySelector("#mode_data_value").innerText = 0
            range.setAttribute('step', 5)
            range.value = 0
        }

    })

</script>
