<footer class="footer col-lg-12 ">
          <div class="row" >
            <div class="col-lg-2 about-me" >
              <div class="logo-thumb-footer" style="background-image: url({{ asset('logo.png') }});">
              </div>
            </div>
            <div class="about-me col-lg-3 font-weight-bold">
              <h5 class="font-weight-bold text-center">Về Chúng Tôi</h5><p>Săn khuyến mãi mong muốn góp phần giúp người mua hàng được giá rẻ nhất, với tiêu chí sự hài lòng của các bạn là niều vui của chúng tôi</p>
              <h5 class="font-weight-bold text-center">ĐĂNG KÝ NHẬN MÃ GIẢM GIÁ</h5>
              <div class="form-contact">  
                <form >
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Nam</label><input style="width: 30px" type="radio" value="1" name="gender"  >
                    <label>Nữ</label><input style="width: 30px" type="radio" value="0" name="gender" >
                  </div>
                  <button type="button" name="submit" class="btn btn-primary text-center">Đăng Ký</button>
                </form>
              </div> 
            </div>
            <div class="about-me col-lg-3 font-weight-bold">
              <h5 class="font-weight-bold text-center">Menu</h5>
              <h6 class="font-weight-bold ">Danh Mục</h6>
              @if(isset($category)) @foreach ($category as $cate)
              <a href="{{ url('danh-muc/'.$cate->id_category.'.html')}}"><span><i class="{{$cate->icon_class}}"></i>&nbsp;{{$cate->name}}</span></a>
              @endforeach @endif
              <h6 class="font-weight-bold ">Shop</h6>
              @if(isset($shopTop)) @foreach ($shopTop as $shop) 
              <a href="{{ url('shop/'.$shop->id_shop.'.html')}}"><span>{{$shop->name}}</span></a>
              @endforeach @endif
            </div>
            <div class="about-me col-lg-4 font-weight-bold">
              <h5 class="font-weight-bold text-center">Liên hệ</h5>
              <div class="form-contact">  
                <form>
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" placeholder="Message" maxlength="140"></textarea>
                    <p class="help-block"><span class="help-block">Thật tuyệt với khi nhận được những ý kiến từ các bạn!</span></p>                  
                  </div>    
                  <button type="button" name="submit" class="btn btn-primary">Gửi Liên Hệ</button>
                </form>
              </div>
            </div>
          </div>
          <div class="text-center font-weight-bold">Copyright ©&nbsp;2018- Săn Khuyến Mãi</div>
        </footer>