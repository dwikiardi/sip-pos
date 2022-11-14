function cart(data, table)
{
    data != null ? $('.block-hide').prop('hidden', false) : $('.block-hide').prop('hidden', true);
    console.log(data)
    $(table+' tbody').empty()
    $.each(data, function (index, value) { 
        var tr_list = '<tr>' +
            '<td>' + '<img src="' + assets(value.associatedModel.image) + '" width=100px/>' + '</td>' +
            '<td>' + value.name + '</td>' +
            '<td>' + convertToRupiah(value.price) + '</td>' +
            // '<td>' + value.quantity + '</td>' +
            '<td>' +
                '<div class="handle-counter" id="handleCounter4">' +
                    '<button type="button" class="btn btn-white lh-2 shadow-none '+(value.quantity == 1 ? "btn-remove" : "counter-minus")+'" data-id="'+value.id+'">' +
                        '<i class="fa fa-minus text-muted"></i>' +
                    '</button>' +
                    '<input type="text" value="'+value.quantity+'" class="qty form-control-lg text-center" name="qty" readonly>' +
                    '<button type="button" class="counter-plus btn btn-white lh-2 shadow-none" data-id="' + value.id + '">' +
                        '<i class="fa fa-plus text-muted"></i>' +
                    '</button>' +
                '</div>' +
            '</td>' +
            '<td>' + convertToRupiah(value.quantity * value.price) + '</td>' +
            '<td>' + '<button type="button" class="btn btn-danger btn-remove" data-id="'+ value.id +'"><i class="fa fa-trash"></i></button>' + '</td>' +
        '</tr>';

        $('#tableCart tbody').append(tr_list);
    });
}

// check if session discount exists
function discount()
{
    if($.session.get("discount") != undefined) {
        $('.total-discount').text($.session.get("discount") + '%');
    } else {
        $('.total-discount').text('0%');
    }
}

function totalPrice()
{
    let subtotal = retnum($('.sub-total').text());
    let totalDiscount = retnum($('.total-discount').text());
    
    // total = subtotal - (subtotal * (totalDiscount/100));
    total = subtotal;

    $('.total-price').text(convertToRupiah(total));
}

function priceCut()
{
    let subtotal = retnum($('.sub-total').text());
    let totalDiscount = retnum($('.total-discount').text());

    total = subtotal * (totalDiscount/100);

    $('.price-cut').text(convertToRupiah(total));
}

$(document).ready(function () {
    $('#tableCart td').length > 1 ? $('.block-hide').prop('hidden', false) : $('.block-hide').prop('hidden', true);

    discount();

    // set total price
    totalPrice();

    // set price cut
    priceCut();

    $('body').on('click', '.btn-search', function() {
        var slug = $('input[name=slug]').val()
        if(slug == '') {
            Swal.fire(
                'Info',
                'Mohon untuk mengisi data pencarian...',
                'info'
            );

            return false;
        }
        $.get("/sale/search-product/"+slug, function (data) {
            $('#tableProduct tbody').empty();
            if(data.length > 0) {
                $.each(data, function (index, value) { 
                    var tr_list = '<tr>' +
                                    '<td>' + '<img src="' + assets(value.image) + '" width=100px/>' + '</td>' +
                                    '<td>' + value.name + '</td>' +
                                    '<td>' + convertToRupiah(value.sell_price) + '</td>' +
                                    '<td>' + (value.attribute != null ? value.attribute.stock : 0) + '</td>' +
                                    '<td>' + '<button type="button" class="btn btn-primary btn-add" data-id="'+ value.id +'"><i class="fa fa-plus"></i></button>' + '</td>' +
                                '</tr>';
                    
                    $('#tableProduct tbody').append(tr_list);
                });
            } else {
                var tr_list = '<tr><td colspan="5" class="text-center"><h3>Tidak ada data yang ditemukan...</h3></td></tr>';
                $('#tableProduct tbody').append(tr_list);
            }
        });
    });

    $('body').on('click', '.btn-add', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Tambah ke keranjang?',
            text: "Tambahkan",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!',
        }).then((result) => {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/cart/add",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: response.status,
                            title: response.title,
                            text: response.message,
                        })

                        if (response.status == 'success') {
                            cart(response.cart, '#tableCart')
                            $('#tableTotalCart').find('.sub-total').text(response.subtotal)
                            totalPrice();
                            priceCut();
                        }
                    }
                });
            }
        })
    });

    $('body').on('click', '.btn-remove', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/cart/remove/' + id,
                    type: 'GET',
                    success: function (result) {
                        Swal.fire(
                            result.title,
                            result.message,
                            result.status
                        )
                        if (result.status == 'success') {
                            $('#tableCart tbody').empty()
                            if(result.cart.length == 0) {
                                var tr_list = '<tr>' +
                                                '<td colspan="6" class="text-center">' +
                                                    '<h3>Tidak ada data pada keranjang...</h3>' +
                                                '</td>' +
                                                '</tr>';
                                $('#tableCart tbody').append(tr_list);
                                $('.block-hide').prop('hidden', true)
                                return false;
                            }
                            cart(result.cart, '#tableCart')
                            $('#tableTotalCart').find('.sub-total').text(result.subtotal)
                            totalPrice();
                            priceCut();
                        }
                    }
                });
            }
        })
    });

    $('body').on('click', '.btn-clear', function() {
        $('input[name=slug]').val('')
        $('#tableProduct tbody').empty();
    });

    $('body').on('click', '.counter-plus', function() {
        var id = $(this).data('id');
        var qty = parseInt($(this).parent().find('.qty').val()) + 1;
        var cat = 'plus';
        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                id: id,
                qty: qty,
                cat: cat,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                Swal.fire(
                    result.title,
                    result.message,
                    result.status
                )
                if (result.status == 'success') {
                    cart(result.cart, '#tableCart')
                    $('#tableTotalCart').find('.sub-total').text(result.subtotal)
                    totalPrice();
                    priceCut();
                }
            }
        });
    });

    $('body').on('click', '.counter-minus', function() {
        var id = $(this).data('id');
        var qty = parseInt($(this).parent().find('.qty').val()) - 1;
        var cat = 'minus';

        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                id: id,
                qty: qty,
                cat: cat,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                Swal.fire(
                    result.title,
                    result.message,
                    result.status
                )
                if (result.status == 'success') {
                    cart(result.cart, '#tableCart')
                    $('#tableTotalCart').find('.sub-total').text(result.subtotal)
                    totalPrice();
                    priceCut();
                }
            }
        });
    });

    $("input[name=discount]").inputFilter(function(value) {
        return /^\d*$/.test(value) && (value === "" || parseInt(value) > 0 ) && (value === "" || parseInt(value) <= 100 ); 
    }, "Hanya mengandung angka 0 - 100");

    $('body').on('click', '.btn-discount', function() {
        let discount = $('input[name=discount]').val()
        if(discount == '') {
            Swal.fire(
                'Info',
                'Mohon untuk mengisi diskon sebelum diterapkan...',
                'info'
            );

            return false;
        }
        
        $(function() {
            $.session.set("discount", discount);
        });

        Swal.fire(
            'Berhasil',
            'Diskon berhasil diterapkan',
            'success'
        );

        $('input[name=discount]').val('');
        $('.total-discount').text(discount + '%');
        totalPrice();
        priceCut();
    });

    $('body').on('click', '.btn-remove-discount', function() {
        $(function() {
            $.session.remove("discount");
        });

        Swal.fire(
            'Berhasil',
            'Diskon berhasil dihapus',
            'success'
        );

        $('.total-discount').text('0%');
        totalPrice();
        priceCut();
    });

    $('body').on('click', '.btn-checkout', function() {
        Swal.fire({
            title: 'Proses?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pesan',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                var formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('total', $('body .total-price').text().replace(/[^0-9]/g,''));
                formData.append('date', $('body .date').val());
                $.ajax({
                    url: '/cart/checkout',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        Swal.fire(
                            result.title,
                            result.message,
                            result.status
                        )
                        if (result.status == 'success') {
                            location.reload();
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Maaf...', text: 'Terjadi kesalahan!' })
                    }
                });
            }
        })
    });

});