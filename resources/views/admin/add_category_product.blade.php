@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" data-validation="lenght" data-validation-lenght="min3" data-validation-error-msg="Ít nhất buscu cho t"
                             class="form-control" name="category_product_name" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="5" type="text" name="category_product_description" class="form-control"   placeholder="Đẹt críp sòn" required></textarea>
                        </div>
                       <div class="form-group">
                         <label for="">Tình trạng</label>
                         <select class="form-control" name="category_product_status">
                           <option value="0">Ẩn</option>
                           <option value="1">Hiển thị</option>
                         </select>
                       </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection