@extends('layout')
@section('content')
    
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <?php
          $message= Session ::get('message');
		  if($message){
			echo '<span class="text-alert">'. $message.'</span>';
			Session ::put('message',null);
		  }
	             ?>
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="email_account" placeholder="Email" />
                        <input type="password" name="password_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">HOẶC</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('login-add-checkout')}}" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" placeholder="Họ và tên"/>
                        <input type="email" name="customer_email" placeholder="Email"/>
                        <input type="password" name="customer_password" placeholder="Mật khẩu"/>
                        <input type="password" name="customer_confirm_password" placeholder="Xác nhận Mật khẩu"/>
                        <input type="number" name="customer_phone" placeholder="Điện thoại"/>
                        <button type="submit" name="customer_signup" class="btn btn-default">Đăng ký</button>
                    </form>
                       
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
<script>
</script>













@endsection