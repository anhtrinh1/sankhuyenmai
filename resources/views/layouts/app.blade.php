<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title }}</title>

<!-- Styles -->
<link rel="icon" href="{{ asset('iconlogo.ico') }}" type="image/gif"
  sizes="16x16">
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
  crossorigin="anonymous">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('ionicons/css/ionicons.css') }}" rel="stylesheet"
  type="text/css" />
</head>
<body>
  <div class="container-fluid">
    <header>
      <div class="menu">
        <div class="menu-top" id="menu-top">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 text-center">
              <a href="{{url('/')}}"><img src="{{ asset('logo.png') }}"
                alt="l" border="0" class="logo" /></a>
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
                    href="{{url('/')}}"> <i class="fas fa-home"></i>&nbsp
                      Trang chủ
                  </a></li>
                  <li class="nav-item"><a class="nav-link"
                    href="{{ url('danh-muc.html') }}"><i
                      class="fas fa-list-ul"></i>&nbsp Danh Mục</a>
                    <div class="sub-menu-category" id="category-list">
                      <div class="container">
                        <ul class="row">
                          @if(isset($category)) @foreach ($category as $cate)
                          <li class="col-md-3 col-xs-12"><a
                            href="{{ url('danh-muc-'.$cate->id_category.'/ma-giam-gia-danh-muc-'.$cate->name.'.html')}}">
                              <span class="step"><i
                                class="{{$cate->icon_class}}"></i> {{$cate->name}}</span>
                          </a></li> @endforeach @endif
                        </ul>
                      </div>
                    </div></li>
                  <li class="nav-item"><a class="nav-link"
                    href="{{ url('shop.html') }}"><i
                      class="fas fa-shopping-cart"></i>&nbsp Shop</a>
                    <div class="sub-menu-category" id="category">
                      <div class="container">
                        <div class="row">
                          @if(isset($shopTop)) @foreach ($shopTop as $shop) <a
                            href="{{ url('shop-'.$shop->id_shop.'/ma-giam-gia-'.$shop->name.'.html')}}">
                            <div class="menu_shop">
                              <div class="article">
                                <div class="log-shop-menu-thumb"
                                  style="background-image: url({{ $shop->logo}});">
                                </div>
                              </div>
                            </div>
                          </a> @if($loop->index == 2) <span class="step size-48">
                            <i class="icon ion-android-more-horizontal"></i>
                          </span> @endif @endforeach @endif
                        </div>
                      </div>
                    </div></li>
                  <li class="nav-item"><a class="nav-link"
                    href="{{ url('tin-tuc-kinh-nghiem.html')}}">Tin Tức-Kinh
                      Nghiệm</a>
                    <div class="sub-menu-category" id="category-list">
                      <div class="container">
                        <ul class="row">
                          @if(isset($typeNew)) @foreach ($typeNew as $value)
                          <li class="col-md-3 col-xs-12"><a
                            href="{{ url('news/'.$value->id.'.html')}}"> <span
                              class="step"><i class="{{$value->icon_class}}"></i>
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
    <!-- end header -->
    <div id="content" class="row container">
      <!-- begin main-content -->
      <div class="col-md-7 main-content col-sm-7 col-xs-12 col-lg-8">

        <div id="top_content">
          <h1 class="_strong text-center">
            {{$titleH1[0]}}<br>{{$titleH1[1]}}
          </h1>
          <div class="content">
            <div class="simple-marquee-container">
              <div class="marquee">
                <marquee onmouseover="this.stop();" onmouseout="this.start();">
                  @if(isset($topNews)) @foreach($topNews as $value) @php {{
                  $repUtf = $replace->ascii($replace->lower($value->title),"en");
                  $repRegex =
                  preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "",
                  $repUtf); $titleRep = str_replace(" ", "-",$repRegex); }}
                  @endphp <span class="font-weight-bold">{{$value->name}}</span>
                  <a class="marquee_news"
                    href="{{url('tin-'.$value->id.'/'.$titleRep.'.html')}}">{{$value->title}}</a>
                  @endforeach @endif
                </marquee>
              </div>

            </div>
          </div>
        </div>
        @yield('content')
      </div>
      <!-- end main-content -->
      <!-- begin sidebar -->
      <div id="sidebar" class="w-31  col-md-5 col-sm-5 col-xs-12 col-lg-4">
        <div class="sidebar-box">
          <div class="head">
            <h3>Tìm kiếm</h3>
            <div class="search">
              <form action="{{url('tim-kiem.html')}}">
                <input type="text" name="search" placeholder="Nhập tìm kiếm">
              </form>
            </div>
          </div>

        </div>
        <div class="sidebar-box">
          <div class="head">
            <h3>Thông Tin Giảm Giá</h3>
          </div>
          @if(isset($tinTuc)) @foreach ($tinTuc as $new)
          <div class="news row">
            <a class="newfeed col-sm-3 col-xs-3" href="#">
              <div class="newfeed_thumb"
                style="background-image: url('{{ url($new->link_img) }}')"></div>
            </a> @php {{ $repUtf =
            $replace->ascii($replace->lower($new->title),"en"); $repRegex =
            preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
            $titleRep = str_replace(" ", "-",$repRegex); }} @endphp <span
              class="newfeed col-sm-9 col-xs-9"><a
              href="{{url('tin-'.$new->id.'/'.$titleRep.'.html')}}"><h5>{{$new->title}}</h5></a></span>
          </div>
          @endforeach @endif
        </div>
        <div class="sidebar-box">
          <div class="head">
            <h3>Tin tức nên đọc</h3>
          </div>
          @if(isset($kn)) @foreach ($kn as $new)
          <div class="news row ">
            <a class="newfeed col-sm-3 col-xs-3" href="#">
              <div class="newfeed_thumb"
                style="background-image: url('{{ url($new->link_img) }}')"></div>
            </a> @php {{ $repUtf =
            $replace->ascii($replace->lower($new->title),"en"); $repRegex =
            preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
            $titleRep = str_replace(" ", "-",$repRegex); }} @endphp <span
              class="newfeed col-sm-9 col-xs-9"><a
              href="{{url('tin-'.$new->id.'/'.$titleRep.'.html')}}"><h5>{{$new->title}}</h5></a></span>
          </div>
          @endforeach @endif
        </div>
        <div class="sidebar-box">
          <div class="head">
            <h3>Tags</h3>
            <div class="tags">
              <ul>
                @if(isset($shopTag)) @foreach ($shopTag as $shop)
                <li><a
                  href="{{ url('shop-'.$shop->id_shop.'/ma-giam-gia-'.$shop->name.'.html')}}">{{$shop->name}}<span>{{$shop->num}}</span></a></li>
                @endforeach @endif
              </ul>
            </div>
          </div>

        </div>
      </div>
      <!-- end sidebar -->
    </div>
    <!-- end content -->
    <i class="fa fa-chevron-circle-up" title="Go to top"
      style="font-size: 48px; color: #655afc" onclick="topFunction()"
      id="btnOnTop"></i>
    <!-- begin footer -->
    <footer class="footer">

      <div class="text-center font-weight-bold">Copyright ©&nbsp;2018
        - Săn Khuyến Mãi</div>
    </footer>
    <!-- end footer -->
  </div>

  <!-- Scripts -->
  <script defer
    src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"></script>
  <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('js/jquery.tickerNews.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
