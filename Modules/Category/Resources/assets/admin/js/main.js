import CategoryForm from './CategoryForm';

new CategoryForm();

$('#name').on('blur', function () {
    $('#slug').val(window.admin.generateSlug($(this).val()));
});
