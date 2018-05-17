 @if(isset($comment))
 @foreach($comment as $cmt)
 <div class="comment-section">
    <div class="single-comment">
        <img style=" background-image: url(http://cp91279.biography.com/1000509261001/1000509261001_1822909398001_BIO-Biography-29-Innovators-Mark-Zuckerberg-115956-SF.jpg);">
        <div class="single-container">
            <span>{{$cmt->name}}</span><span>{{$cmt->message}}</span>
        </div>
        <div class="buttons">
            <p class="action-button" onclick="displayDetail('repply-{{$cmt->cmt_id}}')">Repply</p>
            <p>{{$cmt->daytime}}</p>
        </div>
        <div id="repply-{{$cmt->cmt_id}}" class="input" style="display: none;">
            <img style=" background-image: url(http://cp91279.biography.com/1000509261001/1000509261001_1822909398001_BIO-Biography-29-Innovators-Mark-Zuckerberg-115956-SF.jpg);">
            <textarea id="input-repply-{{$cmt->cmt_id}}" placeholder="Write a comment..."></textarea>
            <button onclick="comment('{{route('comment')}}','input-repply-{{$cmt->cmt_id}}','{{$cmt->cmt_id}}', '{{$cmt->coupon_id}}', '{{$cmt->new_id}}');">Comment</button>
        </div>
    </div>
    @if(isset($subComment) && $subComment!=null)
    @foreach($subComment as $value)
    @if($value->cmt_id == $cmt->cmt_id )
    <div  class="single-comment repply-comment">
            <img style=" background-image: url(http://cp91279.biography.com/1000509261001/1000509261001_1822909398001_BIO-Biography-29-Innovators-Mark-Zuckerberg-115956-SF.jpg);">
            <div class="single-container">
                <span>{{$value->name}}</span><span>{{$value->message}}</span>
            </div>
            <div class="buttons">
                <p>{{$value->daytime}}</p>
            </div>
    </div>
    @endif
    @endforeach
    @endif
</div>
@endforeach
@endif