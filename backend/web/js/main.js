function collectionOfValues(input) {
    let obj = {},
        url,
        dataField = {};
    obj = $(input).data();
    url = obj['url'];
    delete obj['url'];
    if (input.getAttribute('type') == 'checkbox') {
        obj.value = input.checked ? 1 : 0

    } else {
        obj.value = input.value;
    }
    dataField.url = url;
    dataField.data = obj;
    return dataField;

}

function changeElementStatus(elm) {
    let obj = collectionOfValues(elm),
        url = obj.url,
        data = obj.data,
        wrapper = document.querySelector('[data-pjax-container]').getAttribute('id'),
        container = '#' + wrapper;

    $.ajax({
        headers: {
            Accept: "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            'X-CSRF-Token': $('head meta[name=csrf-token]').attr('content')
        },
        type: 'POST',
        url: url,
        data: data,
        success: function () {
            $.pjax.reload({
                container: container
            }).done(function () {
                console.log('success');
            });
        },
        error: function (response) {
            console.error('AJAX-change error!');
        }
    });
}