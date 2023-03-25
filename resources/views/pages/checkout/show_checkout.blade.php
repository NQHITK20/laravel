@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
              <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
              <li class="active">Đơn hàng của bạn</li>
            </ul>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Địa chỉ nhận</p>
                            <div class="form-one">
                                <form action="{{URL::to('/save-check-out-customer')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_email" placeholder="Email*">
                                    <input type="text" name="shipping_name"placeholder="Họ và tên *">
                                    <input type="text" name="shipping_address" placeholder="Địa chỉ *">
                                    <input type="text" name="shipping_phone" placeholder="Số điện thoại *">
                                    <textarea name="shipping_notes"  placeholder="những lưu ý và yêu cầu khi giao hàng của bạn" rows="16"></textarea>
                                    <input type="submit" value="Đặt hàng" name="send_order" class="btn btn-primary btn-sm">
                                </form>                                   
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
        </div>
    </div>
</section> <!--/#cart_items-->



    
@endsection