<div style="width:100%; text-align:center">

    <input type="checkbox" id="chk_{{ $column['name'] . "_" . $entry->id }}" onclick="toggleVal(
    {{ $entry->id }},
        '{{ route("check-ajax-handler") }}',
        '{{ urlencode(get_class($crud->model)) }}',
        '{{ $column['name'] }}',

    @if(isset($column['action']))
        '{{ $column['action'] }}'
    @endif

    );"

           @if($entry->{$column['name']} == 1 || (bool) strtotime($entry->{$column['name']}))
           checked
        @endif
    />

</div>


<script>

    if(! jQuery.isFunction(toggleVal)) {

        function toggleVal(entryId, url, className, property, action = undefined) {

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    entryId: entryId,
                    className: className,
                    property: property,
                    action: action
                },
                success: function (serverResponse, property) {

                    if (serverResponse['status'] == 'error') {
                        alert('Failed to save data');
                        return;
                    }

                    newVal = (serverResponse['newVal'] == 1) ? true : false;

                    $('#chk_' + property + '_' + entryId).prop('checked', newVal);

                }
            });

        }

    }

</script>
