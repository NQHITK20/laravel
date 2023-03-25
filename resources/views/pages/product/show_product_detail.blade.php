@extends('layout')
@section('content')
@foreach ($product_detail as $items =>$detail)
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/product/'.$detail->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                      <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                      <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                    </div>
                    <div class="item">
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                      </div>
                      <div class="item">
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                        <a href=""><img src="{{URL::to('public/frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                      </div>                 
                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$detail->product_name}}</h2>
            <p>ID sản phẩm: {{$detail->product_id}}</p>
            <img src="{{asset('public/frontend/images/product-details/rating.png')}}" alt="" />
            <form  action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field() }}
                <span>
                    <span>{{number_format( $detail->product_price) . ' ₫'}}</span>
                    <label>Số lượng :</label>
                    <input name="qty" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden"  value="{{$detail->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            
            <p><b>Kho hàng :</b> Còn hàng</p>
            <p><b>Tình trạng sản phẩm:</b> Mới</p>
            <p><b>Thương hiệu:</b>{{$detail->brand_name}} </p>
            <p><b>Danh mục:</b>{{$detail->category_name}} </p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Hồ sơ công ty</a></li>
            <li ><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
          <h2>Mô tả: {{$detail->product_content}}</h2>
          <h3>Nội dung: {{$detail->product_desc}}</h3>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
           
        </div>
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>reviews1</p>
                <p><b>Hãy để lại đánh giá </b></p>
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="{{URL::to('public/frontend/images/product-details/rating.png')}}" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm để cử</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
            @foreach ($relative as $item => $getlaid)
            <a href="{{URL::to('/chi-tiet-sp/'.$getlaid->product_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/upload/product/'.$getlaid->product_image)}}" alt="" />
                                <h2>{{$getlaid->product_price}}</h2>
                                <p>{{$getlaid->product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </a>      
            @endforeach               
            </div>
            <div class="item">
                @foreach ($relative2 as $item2 =>$getshit)                  
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/upload/product/'.$getshit->product_image)}}" alt="" />
                                <h2>{{$getshit->product_price}}</h2>
                                <p>{{$getshit->product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach	
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->

@endsection