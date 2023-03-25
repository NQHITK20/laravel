@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" 
                            class="form-control" name="product_name" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục sản phẩm</label>
                            <select class="form-control" name="product_cate">
                                @foreach ($cate_product as $key =>$cate)
                                <option value="{{($cate->category_id)}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                          </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="number"   
                            class="form-control" name="product_price" placeholder="Enter price" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none"   
                             rows="5" type="text" name="product_description" class="form-control" id="ckeditor" placeholder="Đẹt críp sòn" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt sản phẩm</label>
                            <textarea style="resize: none"  
                             rows="5" type="text" name="product_content" class="form-control" id="ckeditor1" placeholder="Đẹt críp sòn" required></textarea>
                        </div>

                          <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <select class="form-control" name="product_brand">
                                @foreach ($brand_product as $key =>$brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection