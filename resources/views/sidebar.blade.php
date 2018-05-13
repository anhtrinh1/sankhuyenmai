{{-- begin sidebar --}}
<div id="sidebar" class="w-31  col-md-4 col-sm-12 col-xs-12 col-lg-4">
    <div class="sidebar-box">
        <div class="head">
            <h3>Tìm kiếm</h3>
            <div class="search">
                <form action="{{route('search')}}">
                    @csrf
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
        <div class="news row col-sm-12 col-xs-12">
            <a class="newfeed col-sm-3 col-xs-3" href="#">
                <div class="newfeed_thumb" style="background-image: url('{{ url($new->link_img) }}')"></div>
            </a> 
            @php {{ $repUtf = $replace->ascii($replace->lower($new->title),"en"); $repRegex =
            preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
            $titleRep = str_replace(" ", "-",$repRegex); }}
            @endphp 
            <h5 class="col-sm-9 col-xs-9"><span  class="newfeed"><a href="{{url('tin-'.$new->id.'/'.$titleRep.'.html')}}">{{$new->title}}</a></span></h5>
        </div>
        @endforeach 
        @endif
    </div>
    <div class="sidebar-box">
        <div class="head">
            <h3>Tin tức nên đọc</h3>
        </div>
        @if(isset($kn)) 
        @foreach ($kn as $new)
        @php {{ $repUtf =
        $replace->ascii($replace->lower($new->title),"en"); $repRegex =
        preg_replace("/[!@#$%^&*()+=,.:'\"\;\/\_\-\\\[\]]/", "", $repUtf);
        $titleRep = str_replace(" ", "-",$repRegex); }}
        @endphp 
        <div class="news row ol-sm-12 col-xs-12">
            <a class="newfeed col-sm-3 col-xs-3" href="{{url('tin-'.$new->id.'/'.$titleRep.'.html')}}"><div class="newfeed_thumb" style="background-image: url('{{ url($new->link_img) }}')"></div></a> 
            <h5 class="col-sm-9 col-xs-9"><span class="newfeed"><a href="{{url('tin-'.$new->id.'/'.$titleRep.'.html')}}">{{$new->title}}</a></span></h5>
        </div>
        @endforeach 
        @endif
    </div>
    <div class="sidebar-box">
        <div class="head">
            <h3>Tags</h3>
        </div>
        <div class="tags">
            <ul>
                @if(isset($shopTag)) 
                @foreach ($shopTag as $shop)
                <li><a href="{{ url('shop/'.$shop->id_shop.'.html')}}">{{$shop->name}}<span>{{$shop->num}}</span></a></li>
                @endforeach 
                @endif
            </ul>
        </div>
    </div>
</div>
{{-- end sidebar --}}