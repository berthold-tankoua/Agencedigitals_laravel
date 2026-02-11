<script>
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Etes-vous sûr?',
                text: "Supprimer cette publication",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                        'Supprimer!',
                        'Votre publication a été supprimé.',
                        'success'
                    )
                }
            }); //end sweet alert script
        });
    }); //end script

    function NotAvailable() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'my-toast-font'
            }
        })

        Toast.fire({
            type: 'error',
            icon: 'error',
            title: 'Cette option est indisponible pour le moment.'
        })
    }

    function reloadPage() {
        location.reload();
    }

    //Cart product view with modal
    function productView(id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('/product/view/modal') }}/" + id,
            dataType: 'json',
            success: function(data) {

                $('#pname').text(data.product.product_name);
                $('#pdescp').text(data.product.short_descp);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name);
                $('#pviews').text(data.product.views);
                $('#action_type').html(data.product.action_type);
                $('#pimage').attr('src', '/' + data.product.product_thambnail);
                $('#plink').attr('href', `/product/details/${id}/${data.product.product_slug}`);
                $('#product_id').val(id);
                $('#qty').val(1);

                $('#pprice').text(data.price);

                // stock option
                if (data.product.product_qty > 0) {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('En Stock');
                } else {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#stockout').text('Epuisé');
                }

                // color
                $('select[name="pcolor"]').empty();
                $.each(data.color, function(key, value) {
                    $('select[name="pcolor"]').append('<option value="' + value + '">' + value +
                        '</option>')
                    if (data.color == "") {
                        $('#colorArea').hide();
                    } else {
                        $('#colorArea').show();
                    }
                })
                // size
                $('select[name="psize"]').empty();
                $.each(data.size, function(key, value) {
                    $('select[name="psize"]').append('<option value="' + value + '">' + value +
                        '</option>')
                    if (data.size == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                })


            }

        }) // end
    }

    // Add To Cart
    function addToCarts() {
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var store_name = $('#pstore').val();
        var color = $('#pcolor option:selected').text();
        var size = $('#psize option:selected').text();
        var quantity = $('#qty').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name,
                store_name: store_name
            },
            url: "{{ url('/cart/data/store') }}/" + id,
            success: function(data) {

                $('#closeModalCart').click();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 4000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })
                $('#paiementClick').click();

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }
        })
        minicart();
    }
    // end add to cart

    // Show MINI CART
    function minicart() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/product/mini/cart') }}",
            dataType: 'json',
            success: function(response) {
                console.log(response)

                $('#CartSubTotal').text(response.cartTotal);
                $('#CartQty').text(response.cartQty);

                var minicart = ""
                $.each(response.carts, function(key, value) {
                    minicart += `
                          <li class="list-group-item py-3 ps-0 border-top">
            <div class="row align-items-center">
              <div class="col-3 col-md-2">
                <img src="{{ url('${value.options.image}') }}" alt="${value.name}" class="img-fluid">
              </div>
              <div class="col-4 col-md-6 col-lg-5">
                <a href="shop-single.html" class="text-inherit">
                  <p class="mb-0 font-small">${value.name}</p>
                </a>
                <span><small class="text-muted font-extra-small"> Quantité: ${value.qty}</small></span>
              </div>
              <!-- input group -->
              <div class="col-3 px-0">
                <div class="form-group" >
                 <label for="qty"> Quantité</label>

                  <input type="number" value="${value.qty}" min="0" style="width: 70%" class="form-control">

                </div>
                <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit">
                    <span class="me-1 align-middle"><i class="bi bi-trash"></i></span>
                    <span class="text-muted font-extra-small" id="${value.rowId}" onclick="minicartRemove(this.id)">Supprimer</span></a>
                </div>
              </div>
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold">${value.price} ${value.options.currency}</span>
              </div>
            </div>
          </li>
                `
                });
                $('#minicart').html(minicart);
                $('#mbl-minicart').html(minicart);
                $('#nav-minicart').html(minicart);
            }
        })
    }
    minicart();
    // End Minicart show

    function cartview() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/user/get-cart-product') }}",
            dataType: 'json',
            success: function(response) {

                console.log(response)
                $('#CartviewTotal').text(response.cartTotal);

                var rows = ""
                $.each(response.carts, function(key, value) {
                    rows += `<tr>
                    <td>
                        <div class="ps-product--cart">

                        <div class="ps-product__thumbnail">

                            <a href="#"><img src="{{ url('/${value.options.image}') }}" alt="AgenceDigitals"></a>

                        </div>

                        <div class="ps-product__content">

                            <a href="#">${value.name}</a>

                            <p>Boutique : <strong>${value.options.store} </strong></p>

                        </div>

                        </div>
                    </td>

                    <td class="price">
                        ${value.price} FCFA
                    </td>

                    <td><span class="ps-tag ps-tag--in-stock">En stock</span></td>

                    <td>
                      Quantite : ${value.qty}
                    </td>

                    <td>${value.subtotal} FCFA </td>

                    <td><a id="${value.rowId}" onclick="minicartRemove(this.id)"><i class="fa fa-trash"></i></a></td>

                    </tr><hr>
                    `
                });
                $('#cartview').html(rows);
            }
        })
    }
    cartview();

    // MINICART REMOVE
    function minicartRemove(rowId) {
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#pcolor option:selected').text();
        var size = $('#psize option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: 'GET',
            url: "{{ url('/minicart/product-remove/') }}/" + rowId,
            dataType: 'json',
            success: function(data) {
                minicart();
                cartview();
                // start
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }

            }
        })
    }
    // End remove to minicart

    $("#btnContact").click(function(e) {
        e.preventDefault();
        name = $("#name").val();
        email = $("#email").val();
        phone = $("#phone").val();
        user_phone = $("#user_phone").val();
        subject = $("#subject").val();
        message = $("#message").val();

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'my-toast-font'
            }
        })
        // Vérifie si les champs requis sont remplis (HTML5 gère aussi avec required)
        if (!name || !email || !phone || !subject || !message) {
            Toast.fire({
                icon: "error",
                title: "Veuillez remplir tous les champs obligatoires."
            });
            return;
        }

        var data = new FormData();
        data.append('name', name);
        data.append('email', email);
        data.append('phone', phone);
        data.append('user_phone', user_phone);
        data.append('subject', subject);
        data.append('message', message);

        const input = document.querySelector('#phone');
        const iti = intlTelInput.getInstance(input);
        const number = iti.getNumber(intlTelInput.utils.numberFormat.E164);
        if (iti.isValidNumber()) {
            $('.telstatus').hide();
            $.ajax({
                url: "{{ url('/contact/add') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }

                }

            }); // end ajax
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    popup: 'my-toast-font'
                }
            })
            Toast.fire({
                type: 'error',
                icon: 'error',
                title: 'Saisir un numero de telephone valide'
            })
            $('.telstatus').show();
        }

    }); // end one

    const get_phone = document.querySelector("#phone");
    if (get_phone) {
        window.intlTelInput(get_phone, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.2/build/js/utils.js",
            initialCountry: "cm",
        });
    }

    $('#phone').keyup(function() {
        var query = $(this).val();
        const input = document.querySelector('#phone');
        const iti = intlTelInput.getInstance(input);
        const number = iti.getNumber(intlTelInput.utils.numberFormat.E164);
        $("#user_phone").val(number);
    });
</script>


<script>
    function StoreBlogReview() {
        var rname = $('#rname').val();
        var id = $('#blog_id').val();
        var remail = $('#remail').val();
        var rcomment = $('#rcomment').val();
        var rmark = $('#rmark').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                rname: rname,
                remail: remail,
                rcomment: rcomment,
                rmark: rmark,
                id: id
            },
            url: "{{ url('/review/blog/store') }}",
            success: function(data) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }
        });

    }

    function StoreProductReview() {
        var rname = $('#rname').val();
        var id = $('#product_id').val();
        var remail = $('#remail').val();
        var rcomment = $('#rcomment').val();
        var rmark = $('#rmark').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                rname: rname,
                remail: remail,
                rcomment: rcomment,
                rmark: rmark,
                id: id
            },
            url: "{{ url('/review/product/store') }}",
            success: function(data) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }
        });
    }
</script>

<script>
    // Fonction réutilisable pour charger les produits
    function loadProducts(extraFilter = null) {
        var filter = extraFilter ?? $("select[name='options']").val(); // récupère le filtre
        var product_name = $('#product_search').val();
        var max_price = $('#max_price').val();
        var min_price = $('#min_price').val();
        var category = $("input[name='category']:checked").val();
        var rating = $("input[name='rating']:checked").val();
        alert(filter)
        $.ajax({
            type: 'GET',
            url: "{{ url('/ajax/product/filter') }}",
            dataType: 'json',
            data: {
                filter: filter,
                product_name: product_name,
                max_price: max_price,
                min_price: min_price,
                category: category,
                rating: rating
            },
            success: function(response) {
                $('#productPaginate').hide();

                if (response.count < 1) {
                    $('#productPaginate').html(
                        '<p class="text-danger text-center h5">Désolé, aucun produit ne correspond à votre recherche.</p>'
                    );
                    $('#advancedsearch').empty(); // vide la zone produit
                    return;
                }
                $('#resultcount').text(response.count);
                var rows = "";
                $.each(response.products, function(key, value) {
                    rows += `
                <div class="col-12 col-md-4 mb-3">
                    <div class="border border-1 theme-border-radius">
                        <div class="box h-auto">
                            <img src="{{ url('/${value.product_thambnail}') }}" class="img-fluid" alt="${value.product_name}">
                            <div class="content">
                                <div class="deal-badge">
                                    <span class="badge bg-danger">${value.discount_price == null ? `En stock` : `En solde`}</span>
                                </div>
                            </div>
                            <div class="content-hover flex-row">
                                <a href="#" class="quick-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                    <i class="bi bi-eye" title="Vue Rapide" id="${value.id}" onclick="productView(this.id)"></i>
                                </a>
                                <div id="${value.id}" onclick="addToWishlist(this.id)" class="quick-btn mx-2" title="Ajouter au Favoris">
                                    <i class="bi bi-heart mx-3"></i>
                                </div>
                                <a href="{{ url('product/details/${value.id}/${value.product_slug}') }}" class="quick-btn" title="Passer commande">
                                    <i class="bi bi-bag"></i>
                                </a>
                            </div>
                        </div>
                        <div class="position-relative p-3 mb-0 theme-border-radius-bottom card-effect theme-bg-white">
                            <span class="text-warning">
                                <small>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </small>
                                <span class="text-muted small ms-1">(${value.views}) Vues</span>
                            </span><br>
                            <a href="{{ url('product/details/${value.id}/${value.product_slug}') }}" class="theme-text-secondary fs-6 fw-bold mt-2 d-inline-block">
                                ${value.product_name}
                            </a>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="theme-text-secondary">
                                    ${value.discount_price == null
                                        ? `${value.selling_price} FCFA ${value.action_type}`
                                        : `${value.discount_price} FCFA ${value.action_type} <del>${value.selling_price} FCFA</del>`}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="font-small theme-text-accent-one">
                                    <i class="bi bi-postage me-1"></i> AgenceDigitals
                                </span>
                                <div class="custom-button">
                                    <a href="{{ url('product/details/${value.id}/${value.product_slug}') }}"
                                       class="rounded-pill custom-btn-secondary font-small button-effect d-flex justify-content-center align-items-center add-btn">
                                        Commander
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                });

                $('#advancedsearch').html(rows);
            }
        });
    }

    // Quand on change l’option de tri
    $('#options').on('change', function() {
        loadProducts($(this).val());
    });

    // Quand on soumet le formulaire recherche
    $('#ajaxProductSearch').on('submit', function(e) {
        e.preventDefault();
        loadProducts();
    });
</script>
<script>
    function InvoiceAutoSend() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/send-invoice-mail') }}",
            dataType: 'json',
            success: function(response) {
                if (response['status']) {
                    console.log('Invoice Mail succes')
                } else {
                    console.log('Invoice Mail error')
                }
            }
        })
    }
    InvoiceAutoSend()

    function CurrencyDailyUpdate() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/currency-daily-update') }}",
            dataType: 'json',
            success: function(response) {
                if (response['status']) {
                    console.log('Currency update succes')
                } else {
                    console.log('Currency update error')
                }
            }
        })
    }
    CurrencyDailyUpdate()

    function UserHistoryWeeklyDelete() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/history-weekly-check') }}",
            dataType: 'json',
            success: function(response) {
                if (response['status']) {
                    console.log('History Weekly succes')
                } else {
                    console.log('History Weekly error')
                }
            }
        })
    }
    UserHistoryWeeklyDelete()


    function addToWishlist(product_id) {
        $.ajax({
            type: 'POST',
            url: "{{ url('/add-to-wishlist') }}/" + product_id,
            dataType: 'json',
            success: function(data) {

                // start
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })
                countwishlist()
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }
        })
    }

    // Count wishlist
    function countwishlist() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/get-wishlist-count') }}",
            dataType: 'json',
            success: function(response) {

                $('#Wishlistcount').text(response);
                $('#mblWishlistcount').text(response);

            }
        })
    }
    countwishlist()
</script>
