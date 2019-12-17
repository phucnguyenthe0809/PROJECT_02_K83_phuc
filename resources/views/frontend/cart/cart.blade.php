@extends('frontend.master.master')
@section('title','Giỏ Hàng')
@section('content')
<div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Giỏ hàng</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>02</span></p>
                            <h3>Thanh toán</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Hoàn tất thanh toán</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-name">
                        <div class="one-forth text-center">
                            <span>Chi tiết sản phẩm</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Giá</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Số lượng</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Tổng</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Xóa</span>
                        </div>
                    </div>

                    @foreach ($cart as $row)
                    <div class="product-cart">
                        <div class="one-forth">
                            <div class="product-img">
                                <img class="img-thumbnail cart-img"
                                    src="/backend/img/{{$row->options->img}}">
                            </div>
                            <div class="detail-buy">
                                <h4>Mã : {{$row->id}}</h4>
                                <h5>{{$row->name}}</h5>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price">{{number_format($row->price,0,"",".")}} đ</span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                            <input onchange="return update('{{ $row->rowId }}',this.value)" type="number" id="quantity" name="quantity"
                                class="form-control input-number text-center" value="{{$row->qty}}">
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price">{{number_format($row->price*$row->qty,0,"",".")}} đ</span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                            <a href="/cart/del/{{$row->rowId}}" class="closed"></a>
                            </div>
                        </div>
                    </div>
                    @endforeach




                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="total-wrap">
                        <div class="row">
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-3 col-md-push-1 text-center">
                                <div class="total">
                                    <div class="sub">
                                        <p><span>Tổng:</span> <span>{{$total}} đ</span></p>
                                    </div>
                                    <div class="grand-total">
                                        <p><span><strong>Tổng cộng:</strong></span> <span>{{$total}} đ</span></p>
                                        <a href="/checkout" class="btn btn-primary">Thanh toán <i
                                                class="icon-arrow-right-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        function update(rowId,qty){
            $.get(
                "cart/update/"+rowId+"/"+qty,
                function(data){
                    if (data=='success') {
                        location.reload();
                    } else {
                        alert('update false');
                    }
                }
            );
        }
    </script>
    <script>
            $(document).ready(function () {

                var quantitiy = 0;
                $('.quantity-right-plus').click(function (e) {

                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());

                    // If is not undefined

                    $('#quantity').val(quantity + 1);


                    // Increment

                });

                $('.quantity-left-minus').click(function (e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());

                    if (quantity > 0) {
                        $('#quantity').val(quantity - 1);
                    }
                });

            });

        </script>

@endsection

