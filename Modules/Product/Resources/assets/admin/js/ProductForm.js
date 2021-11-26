export default class {
    constructor() {
        this.managerStock();

        window.admin.removeSubmitButtonOffsetOn([
            '#images', '#downloads', '#attributes', '#options',
            '#related_products', '#up_sells', '#cross_sells', '#reviews',
        ]);

        $('#product-create-form, #product-edit-form').on('submit', this.submit);
        if ($('#slug').val() === '') {
            $('#name').on('blur', function () {
                $('#slug').val(window.admin.generateSlug($(this).val()));
            });
        }
    }

    managerStock() {
        $('#manage_stock').on('change', (e) => {
            if (e.currentTarget.value === '1') {
                $('#qty-field').removeClass('hide');
            } else {
                $('#qty-field').addClass('hide');
            }
        });
    }

    submit(e) {
        e.preventDefault();

        DataTable.removeLengthFields();

        window.form.appendHiddenInputs('#product-create-form, #product-edit-form', 'up_sells', DataTable.getSelectedIds('#up_sells .table'));
        window.form.appendHiddenInputs('#product-create-form, #product-edit-form', 'cross_sells', DataTable.getSelectedIds('#cross_sells .table'));
        window.form.appendHiddenInputs('#product-create-form, #product-edit-form', 'related_products', DataTable.getSelectedIds('#related_products .table'));

        e.currentTarget.submit();
    }
}
