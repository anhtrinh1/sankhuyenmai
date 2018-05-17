<div id="comment-{{$value->id_coupon}}" class="comment-list" style="display: none">
    <div class="alert">Rất vui khi nhận được ý kiến từ các bạn!</div>
 <div id="alert-success-{{$value->id_coupon}}" class="alert alert-success" style="display: none;"></div>
 <div id="alert-danger-{{$value->id_coupon}}" class="alert alert-danger" style="display: none;"></div>
 <div class="lazy" data-loader="comment" data-src="{{url('/getCommentCoupon/'.$value->id_coupon)}}">  
</div>
<div class="input">
    <img style=" background-image: url(http://cp91279.biography.com/1000509261001/1000509261001_1822909398001_BIO-Biography-29-Innovators-Mark-Zuckerberg-115956-SF.jpg);">
    <textarea id="input-cmt-{{$value->id_coupon}}" placeholder="Write a comment..."></textarea>
    <button onclick="comment('{{route('comment')}}','input-cmt-{{$value->id_coupon}}',null, '{{$value->id_coupon}}', null);">Comment</button>
</div>
</div>