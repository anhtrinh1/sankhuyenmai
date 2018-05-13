<!DOCTYPE html>
<html lang="vi">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }}</title>
  {{-- Styles --}}
  <link rel="icon" href="{{ asset('iconlogo.ico') }}" type="image/gif"
  sizes="16x16">
  <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
  <link href="{{ asset('ionicons/css/ionicons.css') }}" rel="stylesheet"
  type="text/css" />

  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    <header>
      <div class="menu">
        <div class="menu-top" id="menu-top">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 text-center">
              <a href="{{route('welcome')}}"><img src="{{ asset('logo.png') }}" alt="Săn Khuyến Mãi" class="logo" /></a>
            </div>
          </div>
        </div>
        <div class="menu-bottom">
          <div class="row container">
            <nav
            class="navbar navbar-expand-sm bg-light navbar-light menu-show-small">
            <button class="navbar-toggler" type="button"
            data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav menu-parent">
              <li class="nav-item active"><a class="nav-link"
                href="{{route('welcome')}}"> <i class="fas fa-home"></i>&nbsp;Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link"
                  href="{{ url('danh-muc.html') }}"><i
                  class="fas fa-list-ul"></i>&nbsp;Danh Mục</a>
                  <div class="sub-menu-category category-list">
                    <div class="container">
                      <ul class="row">
                        @if(isset($category)) @foreach ($category as $cate)
                        <li class="col-md-3 col-xs-12"><a href="{{ url('danh-muc/'.$cate->id_category.'.html')}}">
                          <span class="step"><i class="{{$cate->icon_class}}"></i> &nbsp;{{$cate->name}}</span>
                        </a></li> @endforeach @endif
                      </ul>
                    </div>
                  </div></li>
                  <li class="nav-item"><a class="nav-link"
                    href="{{ url('shop.html') }}"><i
                    class="fas fa-shopping-cart"></i>&nbsp; Shop</a>
                    <div class="sub-menu-category" id="category">
                      <div class="container">
                        <div class="row">
                          @if(isset($shopTop)) @foreach ($shopTop as $shop) 
                          <a href="{{ url('shop/'.$shop->id_shop.'.html')}}">
                            <div class="menu_shop">
                              <div class="article">
                                <div class="log-shop-menu-thumb" style="background-image: url({{asset($shop->logo)}});">
                                </div>
                              </div>
                            </div>
                          </a>
                          @endforeach @endif
                        </div>
                      </div>
                    </div></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('tin-tuc-kinh-nghiem.html')}}">Tin Tức-Kinh
                    Nghiệm</a>
                    <div class="sub-menu-category category-list" >
                      <div class="container">
                        <ul class="row">
                          @if(isset($typeNew)) @foreach ($typeNew as $value)
                          <li class="col-md-3 col-xs-12"><a href="{{ url('news/'.$value->id.'.html')}}"><span                   class="step"><i class="{{$value->icon_class}}"></i>
                            {{$value->name}}</span></a></li> @endforeach @endif
                          </ul>
                        </div>
                      </div></li>
                    </ul>
                  </div>
                </nav>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </header>

        <marquee onmouseover="this.stop();" onmouseout="this.start();">
          @if(isset($topNews)) 
          @foreach($topNews as $value) 
          @php {{
          $repUtf = $replace->ascii($replace->lower($value->title),"en");
          $repRegex =
          preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "",
          $repUtf); 
          $titleRep = str_replace(" ", "-",$repRegex); 
          }} @endphp 
          <span class="font-weight-bold">{{$value->name}}</span>
          <a class="marquee_news" href="{{url('tin-'.$value->id.'/'.$titleRep.'.html')}}">{{$value->title}}</a>
          @endforeach @endif
        </marquee>
        {{-- end header --}}
        <div id="content" class="row container">
          {{-- begin main-content --}}
          <div class="main-content col-md-8 col-xs-12 col-lg-8 col-sm-12" >
            <div id="top_content">
              <h1 class="_strong text-center">
                {{$titleH1[0]}}<br>{{$titleH1[1]}}
              </h1>

            </div>
              @yield('content')
          </div>
          {{-- end main-content --}}
         @include('sidebar')
        </div>
        {{-- end content --}}
        {{-- begin footer --}} 
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
      {{-- end footer --}}  
      </div>   
     <i class="fa fa-chevron-circle-up" title="Go to top" style="font-size: 48px; color: #655afc" onclick="topFunction()"
      id="btnOnTop"></i>
      {{-- Scripts --}}
      <script src="{{ asset('js/clipboard.min.js') }}"></script>
      <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
      <script src="{{ asset('js/jquery.min.js') }}"></script> 
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/popper.min.js')}}"></script>
      <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    </body>
    </html>
