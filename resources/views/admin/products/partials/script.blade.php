<script type="text/javascript" defer>
    let types = {!! json_encode($jsonTypes) !!};

    let current_type = {!! isset($product) ? "'{$product->getCategory()->getId()}'" : 'null' !!};

    let inputs = {!! isset($inputs) ? json_encode($inputs) : 'null' !!};

    document.addEventListener("DOMContentLoaded", function(event) {

        let out_func = function (type) {
            let out = '';
            for (let input in types[type])
            {
                let input_value = inputs && inputs[input] ? inputs[input] : '';
                out += '<div class="form-group"><label for="'+input+'">'+types[type][input]+'</label><input type="text" class="form-control" name="'+input+'" id="'+input+'" value="'+input_value+'" /></div>'
            }
            return out;
        };

        let another_data = document.getElementById('another_data');

        if(current_type !== null) {
            another_data.innerHTML = out_func(current_type)
        }

        document.getElementById('category').addEventListener('change', function (event) {
            let type = event.target.value;
            another_data.innerHTML = out_func(type);
        }, false)
    });
</script>