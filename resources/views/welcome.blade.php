@extends('layouts.app') @section('content') @if(isset($status))
<div class="alert alert-danger">{{$status}}</div>
@endif

<!-- coupon -->
@if(isset($coupon))
@foreach($coupon as $value)

<div class="box-coupon">
    <div class="title-coupon">
        <div class="coupon-post">
            <div class="coupon-post-title">
                <h4>{{ $value->title}}</h4>
            </div>
            <div class="coupon-post-bottom text-center">
                <p class="coupon_brand shop">
                    <a
                        href="{{ url('shop-'.$value->id_shop.'/ma-giam-gia-'.$value->name_shop.'.html')}}">
                        {{$value->name_shop}}</a>
                </p>
                <p class="coupon_number">
                    <span class="step size-48 coupon"> <i
                        class="icon ion-ios-cart-outline"></i>
                    </span> {{$value->percent}}
                </p>
                <p class="coupon_date">
                    <span class="step size-48 coupon"> <i class="icon ion-clock"></i>
                    </span> Còn {{$value->numday}} Ngày
                </p>
                <p class="coupon_type">
                    @if($value->id_type=='coupon') <span class="step size-48 coupon">
                        <i class="icon ion-ios-barcode"></i>
                    </span> @else <span class="step size-48 coupon"> <i
                        class="icon ion-bag"></i>
                    </span> @endif {{$value->name_type}}
                </p>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="control-coupon row">
            <span onclick="displayDetail('coupon_detail_{{$value->id_coupon}}');"
                class="button-detail"> <i class="fas fa-angle-down"></i> Chi
                Tiết
            </span> <span class="popup button-watch" id="coppy_{{$value->id_coupon}}"
                onmouseover="showPopup('popup_{{$value->id_coupon}}')"
                onmouseout="hidPopup('popup_{{$value->id_coupon}}')" @if($value->id_type==
                'coupon') data-clipboard-text="{{$value->coupon_code}}"
                onclick="getCoupon('{{$value->id_coupon}}','{{$value->link}}','{{url('link-click/'.$value->id_coupon)}}')">
                <span class="popuptext" id="popup_{{$value->id_coupon}}">Nhấn
                    để coppy mã và chuyển đến trang khuyến mãi!</span> <i
                class="icon ion-scissors"></i>&nbsp;Lấy Mã @else
                onclick="getLink('{{$value->link}}')" > <span class="popuptext"
                id="popup_{{$value->id_coupon}}">Nhấn để đến trang chi tiết
                    khuyến mãi!</span> <i class="icon ion-android-open"></i>&nbsp;Xem Ngay
                @endif

            </span>
        </div>
        <div id="coupon_detail_{{$value->id_coupon}}" class="coupon_detail"
            style="display: none;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 center">
                    <table class="table-responsive coupon_detail_table">
                        <tr>
                            <td></td>
                            <th>Ngày hết hạn:</th>
                            <td>{{$value->end_day}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Loại ưu đãi:</th>
                            <td>{{$value->name_type}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Số lần sử dụng:</th>
                            <td>{{$value->number_click}}</td>
                        </tr>
                        @if($value->notes!=null)
                        <tr>
                            <td></td>
                            <th>Lưu ý:</th>
                            <td>{!!html_entity_decode($value->notes)!!}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="row" style="height: 50px; width: 100%">
                    <div class="share-buttons">
                        @php {{ $repUtf =
                        $replace->ascii($replace->lower($value->title),"en"); $repRegex =
                        preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
                        $titleRep = str_replace(" ", "-",$repRegex); }} @endphp <a
                            target="_blank"
                            href="http://www.facebook.com/sharer/sharer.php?u={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}"
                            class="facebook"><i class="fab fa-facebook-square"></i><span>Facebook</span></a>
                        <a target="_blank"
                            href="https://twitter.com/intent/tweet?text={{$value->title}}&url={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}&via=sănkhuyếnmãi.com"
                            class="twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                        <a target="_blank"
                            href="https://plus.google.com/share?url={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}"
                            class="google"><i class="fab fa-google-plus-square"></i><span>Google+</span></a>
                        <a target="_blank"
                            href="http://www.linkedin.com/shareArticle?mini=true&url={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}&title={{$value->title}}&source={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}"
                            class="linkedin"><i class="fab fa-linkedin-in"></i><span>linkedin</span></a>
                        <a target="_blank"
                            href="http://pinterest.com/pin/create/button/?url={{ url('san-khuyen-mai-'.$value->id_coupon.'/'.$titleRep.'.html') }}&description={{$value->title}}&media={{$value->link_img}}"
                            class="pinterest"><i class="fab fa-pinterest"></i><span>pinterest</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="{{ asset('js/clipboard.min.js') }}"></script>
<div class="div-pagination">{{
    $coupon->links('vendor.pagination.simple-bootstrap-4') }}</div>
@endif
<!-- shopAll -->
@if(isset($shopAll))
<div class="col-lg-12">
    <div class="sidebar-box">
        <div
            style="padding: 1em; border-top: 2px solid #A0D460; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1); text-transform: uppercase;">
            @foreach ($shopFilter as $value) <a
                href="{{ url('shop/'.$value->filter.'.html') }}"
                style="padding: 10px 10px; color: black; font-weight: bold;"><span>{{$value->filter}}</span></a>
            @endforeach
        </div>
    </div>
</div>
<div class="col-lg-12" style="margin-top: 1em;">
    <table class="table-borderless">
        <tbody>
            @foreach($shopAll as $value) @php {{ if($loop->first) $filter =
            $value->filter;}} @endphp
            <tr>
                @if($filter != $value->filter || $loop->first) @php {{ $filter =
                $value->filter;}} @endphp
                <th scope="row">{{$filter}}</th> @else
                <th scope="row"></th> @endif
                <td style="padding: 2% 10% 0 10%; margin: 5px 0 5px 0;"><a
                    href="{{ url('shop-'.$value->id_shop.'/ma-giam-gia-'.$value->name.'.html')}}">
                        <img class="img-thumbnail" width="20%" src="{{$value->logo}}"
                        style="margin-right: 10%; padding: 0px;"><span>{{$value->name}}</span>
                </a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<!-- category All -->
@if(isset($categoryAll))
<div class="col-lg-12" style="margin-top: 1em;">
    <div class="container">
        <div class="row category_all">
            @foreach ($categoryAll as $value) <span class="step"> <i
                class="icon {{$value->icon_class}}"></i> <a
                href="{{ url('danh-muc-'.$value->id_category.'/ma-giam-gia-tin-khuyen-mai-'.$value->name.'.html')}}">{{$value->name}}</a>
            </span> @endforeach
        </div>
    </div>
</div>
@endif
<!-- new -->
@if(isset($new)) @foreach ($new as $value)
<div class="box-coupon">{!!html_entity_decode($value->content)!!}
</div>
@endforeach @endif

<!-- newAll -->
@if(isset($newAll)) @foreach($newAll as $value) @php {{ $repUtf =
$replace->ascii($replace->lower($value->title),"en"); $repRegex =
preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
$titleRep = str_replace(" ", "-",$repRegex); }} @endphp
<div class="box-coupon">
    <div class="title-new">
        <div>
            <a href="{{url('tin-'.$value->id.'/'.$titleRep.'.html')}}"><h4>{{
                    $value->title}}</h4></a>
        </div>
        <span><i class="ion-ios-calendar-outline"></i>
            {{$value->updated_at->format('Y-m-d')}}</span>
        <div class="time-new">
            <div class="row">
                <div class="col-lg-4">
                    <div class="img-new-thumb"
                        style="background-image: url({{ $value->link_img}});"></div>
                </div>
                <div class="col-lg-8">
                    <div>{!!html_entity_decode($value->description)!!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="div-pagination">{{
    $newAll->links('vendor.pagination.simple-bootstrap-4') }}</div>
@endif @endsection
