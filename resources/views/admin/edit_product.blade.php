@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <?php
                $message= Session ::get('message');
                    if($message){
                   echo '<span class="text-alert">'. $message.'</span>';
                   Session ::put('message',null);
                                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                       @foreach ($edit_product as $key =>$pro)
                            
                      <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text"    
                            class="form-control" name="product_name" value="{{$pro->product_name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Danh mục sản phẩm</label>
                            <select class="form-control" name="product_cate">
                                @foreach ($cate_product as $key =>$cate)
                                @if ($cate->category_id==$pro->category_id)
                                <option selected value="{{($cate->category_id)}}">{{$cate->category_name}}</option>
                                    
                                @else
                                <option value="{{($cate->category_id)}}">{{$cate->category_name}}</option>

                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text"    
                            class="form-control" name="product_price"   value="{{$pro->product_price}}" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                            <img src="{{URL::to('public/upload/product/',$pro->product_image)}}" alt="bugimg" height="150" width="130">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none"   
                             id="ckeditor10" rows="5" type="text" name="product_description" class="form-control" required>{{$pro->product_desc}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt sản phẩm</label>
                            <textarea style="resize: none"    
                             id="ckeditor11" rows="5" type="text" name="product_content" class="form-control" required >{{$pro->product_content}}</textarea>
                        </div>


                          <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <select class="form-control" name="product_brand">
                                @foreach ($brand_product as $key =>$brand)
                                @if ($brand->brand_id==$pro->brand_id)
                                <option selected value="{{($brand->brand_id)}}">{{$brand->brand_name}}</option>
                                    
                                @else
                                <option value="{{($brand->brand_id)}}">{{$brand->brand_name}}</option>

                                @endif
                                @endforeach
                            </select>
                          </div>

                       <div class="form-group">
                         <label for="">Tình trạng</label>
                         <select class="form-control" name="product_status">
                           <option value="0">Ẩn</option>
                           <option value="1">Hiển thị</option>
                         </select>
                       </div>
                        <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                     </form>
                     @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection