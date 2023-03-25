@extends('layout')
@section('content')
<div class="features_items">
    @foreach ($category_name as $item => $key)
    <h2 class="title text-center">{{$key->category_name}}</h2>
    @endforeach
      @foreach ($category_by_id as $key =>$product)
      @if ($product->product_status==1)
        
      <a href="{{URL::to('/chi-tiet-sp/'.$product->product_id)}}">


    <div class="col-sm-4">
            
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
                    <h2>{{number_format($product->product_price).' '.'vnđ'}}</h2>
                    <p>{{$product->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                </ul>
            </div>


        </div>

    </div>
      </a>
      @endif
    @endforeach

</div>

@endsection