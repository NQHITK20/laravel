@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
              <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ul>
        </div><!--/breadcrums-->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content=Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng cộng</td>
                        <td>Xóa</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href="" ><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}" width="50" alt="bug"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>ID sản phẩm: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price) . ' '. 'vnđ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                    {{ csrf_field() }}
                                <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="btn btn-default btn-sm">
                                <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">

                                </form>
                                
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                $subtotal=$v_content->price * $v_content->qty;
                                echo number_format($subtotal) . ' ' . 'vnđ';

                                ?>          
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}} "><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="review-payment">
            <h2 style="color:blue;padding-bottom:2rem;font-size:2rem;">Hình thức thanh toán</h2>
            <h2 style="color:rgb(255, 30, 0);padding-bottom:2rem;font-size:2rem;">(Lưu ý: chỉ chọn 1 phương thức)</h2>
        </div>
        <div class="payment-options">
            <form action="{{URL::to('/order-place')}}" method="post">
                {{ csrf_field() }}
                <span>
                    <label><input name="payment_option" value="1"  type="checkbox"> Thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Thanh toán khi nhận hàng</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox"> Dùng thẻ ghi nợ</label>
                </span>
                <input type="submit" value="Thanh toán" name="send_order" class="btn btn-primary btn-sm">
            </form>
            </div>
    </div>
    
</section> <!--/#cart_items-->



    
@endsection