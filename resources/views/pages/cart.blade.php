<x-app-layout>
    <!--============================
        CART START
    =============================-->
    <section class="wsus__cart mt_170 pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 wow fadeInUp">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="pro_img">Item</th>

                                        <th class="pro_name">Name</th>

                                        <th class="pro_select">Quantity</th>

                                        <th class="pro_tk">Price</th>

                                        <th class="pro_icon">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="pro_img">
                                            <img src="{{ asset($product['image']) }}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="pro_name">
                                            <a href="#">{{ $product['name'] }}</a>
                                        </td>

                                        <td class="pro_select">
                                            <div class="quentity_btn">
                                                <button data-id="{{ $product['id'] }}" class="minus decrement"
                                                    type="submit"><i class="far fa-minus"></i></button>
                                                <input type="text" placeholder="01" value="{{ $product['qty'] }}" min="1" class="qty">
                                                <button data-id="{{ $product['id'] }}" class="plus increment"
                                                    type="submit"><i class="far fa-plus"></i></button>
                                            </div>
                                        </td>

                                        <td class="pro_tk">
                                            <h6>${{ $product['price']   * $product['qty'] }}</h6>
                                        </td>

                                        <td class="pro_icon">
                                            <form action="{{ route('remove-from-cart', $product['id']) }}"
                                                method="POST">
                                                <button class="submit">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class="fal fa-times"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="wsus__cart_list_bottom">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-xl-5 ms-auto">
                                <div class="wsus__cart_list_pricing">
                                    <h6>Total <span>
                                    @php 
                                    $total = 0;
                                    foreach ($products as $product) {
                                        $total += $product['price'] * $product['qty'];
                                    }
                                    echo $total;
                                    @endphp

                                    </span></h6>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <ul class="wsus__cart_list_bottom_btn">
                        <li><a href="products.html" class="common_btn cont_shop">Continue To Shipping</a>
                        </li>
                        <li><a href="checkout.html" class="common_btn common_btn_2">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART END
    =============================-->


    <x-slot name="scripts">
        <script>
        $(document).ready(function() {


            $('.increment').on('click', function() {
                let qty = $(this).siblings('.qty').val();
                let id = $(this).data('id');
                qty = parseInt(qty) + 1;
                $(this).siblings('.qty').val('qty');
                $.ajax({
                    method: 'POST',
                    url: "{{ route('update-qty') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        qty: qty,
                        id: id,
                        type: 'increment'
                     
                    },
                    success: function(data) {
                        if (data.status == 'ok') {
                                window.location.reload();
                            $('.cart-count').html(data.cart_count);
                        
                            notyf.success('Product quantity updated.');
                        }
                    },
                    error: function(xhr, status, error) {}
                })
            })

            $('.decrement').on('click', function() {
               let qty = $(this).siblings('.qty').val();
                let id = $(this).data('id');
                if (qty > 1) {
                    qty = parseInt(qty) - 1;
                    $(this).siblings('.qty').val('qty');
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('update-qty') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            qty: qty ,
                            type: 'decrement'
                        },
                        success: function(data) {
                            if (data.status == 'ok') {
                                 window.location.reload();
                                $('.cart-count').html(data.cart_count);
                               
                                notyf.success('Product quantity updated.');
                            }
                        },
                        error: function(xhr, status, error) {}
                    })
                }
            })
        })
        </script>
    </x-slot>
</x-app-layout>