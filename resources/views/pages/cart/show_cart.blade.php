@extends('layout')
@section('content')
<section id="cart_items" >
    <div class="container" style="width: 100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->
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
                    <?php $stt=0; ?>
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
                                $stt+=$subtotal;
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
</section> <!--/#cart_items-->
<section id="do_action "  >
    <div class="container" style="width: 100%;padding-bottom:3rem;">
            <div class="col-sm-6" style="width: 100%;padding-bottom:3rem;background-color:aliceblue;">
                <div class="total_area">
                    <ul>
                        <li>Giá trị đơn <span><?php echo number_format($stt) . ' vnđ' ; ?></span></li>
                        <li>Thuế <span><?php echo number_format($stt * 0.1) . ' vnđ' ; ?></span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng cộng <span><?php echo number_format($stt * 1.1) . ' vnđ' ; ?></span></li>
                    </ul>
                    <?php
                    $customer_id=Session::get('customer_id');
                    if($customer_id!=Null){
                    ?>
                <a class="btn btn-default" href="{{URL::to('/check-out')}}">Thanh toán</a>
                     <?php }else{ ?>
                <a class="btn btn-default" href="{{URL::to('/login-checkout')}}"> Đăng nhập/đăng kí để thanh toán</a>
                     <?php
                     }
                     ?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
    
@endsection