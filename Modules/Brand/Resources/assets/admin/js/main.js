window.admin.removeSubmitButtonOffsetOn('#images');

if ($('#slug').val() === '') {
    $('#name').on('blur', function () {
        $('#slug').val(window.admin.generateSlug($(this).val()));
    });
}
