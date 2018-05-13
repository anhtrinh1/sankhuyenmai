{{-- begin comment --}}
<div id="comment_{{$value->id_coupon}}" class="coupon_detail" style="display: none;">
        <div class="wrap">
            <p>Rất vui khi nhận được ý kiến từ các bạn!</p>
            {{-- Form Start --}}
            <div class='form-comment'>
                <div class="row">
                    <div class="col-md-12">
                        <form action="comment" method="POST" class="commentform">
                            <div class="form-row comment-name">
                                <input type = "text" placeholder = "Tên (Bắt Buộc)" name = "dname"  class = "name" >
                            </div>
                            <div class="form-row comment-email">
                                <input type = "text" placeholder = "Mail (Bắt buộc)" name = "demail"  class = "email">
                            </div>
                            <div class="form-row comment-url">
                                <input type = "text" placeholder = "Website" name = "url"  class = "url" >
                            </div>
                            <div class="form-row comment-message">
                                <textarea name = "comment" placeholder = "Message (Bắt buộc)" class = "comment" ></textarea>
                            </div>
                            <input type="submit" name="dsubmit" class="commentSubmit" value="Submit Comment">
                            <input style="width: 30px" type="checkbox" value="1" name="subscribe" class="subscribe" checked="checked">
                            <p><b>Nhận thông báo khi có phản hồi.</b></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- end comment --}}