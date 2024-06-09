<button type="button" scripture-number="{{ $data->scripture_number }}" class="btn btn-sm btn-info select-ref">Pilih</button>

<script>
    $('.select-ref').on('click', function() {
        var scriptureNumber = $(this).attr('scripture-number');
        $('#mail_ref').val(scriptureNumber);
        $('#closeRef').attr('data-dismiss', 'modal').trigger('click');
    });
</script>