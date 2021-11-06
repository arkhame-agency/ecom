window.admin.removeSubmitButtonOffsetOn('#images');
$('#name').on('blur', function () {
    $('#slug').val(window.admin.generateSlug($(this).val()));
});
