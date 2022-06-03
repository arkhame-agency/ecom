$('#order-status').change((e) => {
    $.ajax({
        type: 'PUT',
        url: route('admin.orders.status.update', e.currentTarget.dataset.id),
        data: { status: e.currentTarget.value },
        success: (message) => {
            success(message);
        },
        error: (xhr) => {
            error(xhr.responseJSON.message);
        },
    });
});


$('#detail-shipping-label').hide();
$('#create-shipping-label').on('click', (e) => {
    $.ajax({
        type: 'POST',
        url: route('admin.orders.create.label.shipment', e.currentTarget.dataset.id),
        data: {},
        dataType: 'json',
        success: (shippo) => {
            success('Label created with success');
            $('#create-shipping-label').hide();
            $('#detail-shipping-label').show();
            $('#url-shipping-label').attr('href', shippo.label_url);
            $('#tracking-url').attr('href', shippo.tracking_url_provider);
            $('#tracking-id').text(shippo.tracking_number);
        },
        error: (xhr) => {
            error(xhr.responseJSON.message);
        },
    });
});
