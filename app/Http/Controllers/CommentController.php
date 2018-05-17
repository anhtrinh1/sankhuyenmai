<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Validator;
use Auth;
use App\Comment;
use App\SubComment;

class CommentController extends Controller
{
	public function getCommentCoupon(Request $request,$couponId)
	{
		$Comment = new Comment;
		$comment = $Comment->getComment(null,$couponId);
		$coutCmt = $Comment->getCountCmt(null,$couponId);
		$SubComment = new SubComment;
		$subComment = $SubComment->getSubComment(null,$couponId);

		return response()->view('getcomment',compact('comment','subComment','coutCmt'));
	}
	public function getCountCmtCoupon(Request $request,$couponId)
	{
		$Comment = new Comment;
		$coutCmt = $Comment->getCountCmt(null,$couponId);
		return $coutCmt;
	}
	 
    public function comment(Request $request) {
       
        $rules = [
            'message' =>'required|min:5',
        ];
        $messages = [
            'message.required' => 'Bình luận phải ít nhất 5 kí tự',
            'message.min' => 'Bình luận phải ít nhất 5 kí tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 200);
            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $message = $request->input('message');
            $cmtId = $request->cmtId;
            $couponId = $request->couponId;
            $newId = $request->newId;

            if($request->user()!=null) {
            	$userId = $request->user()->id;
            	if($cmtId == null || $cmtId == ''){
            		$comment = new Comment;
            	    $comment->message = $message;
            	    $couponId!=null ? $comment->coupon_id = $couponId:$comment->coupon_id = 0; 
            	    $newId!=null ? $comment->new_id = $newId:$comment->new_id = 0 ;
            	    $comment->user_id = $userId;
            	    if($userId<2)
            	    	$comment->approve = true;
            	    $comment->save();
            	}else{
            		$subComment = new SubComment;
            	    $subComment->message = $message;
            	    $subComment->user_id = $userId;
            	    $subComment->cmt_id = $cmtId;
            	    if($userId<2)
            	    	$subComment->approve = true;
            	    $subComment->save();
            	}
                return response()->json([
                    'error' => false,
                    'message' => 'Bình luận của bạn sẽ sớm được phê duyệt, Cảm ơn!'
                ], 200);
                // return redirect()->intended('/');
            } else {
                $errors = new MessageBag(['errorlogin' => 'Mời bạn đăng nhập để bình luận!']);
                return response()->json([
                    'error' => true,
                    'message' => $errors
                ], 200);
                // return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
}
