<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Wish;
use App\models\Subscribe;

class SubscribeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  //応募状況表示
  public function index()
  {
      $subscribes = Subscribe::where('user_id',auth()->id())->get();

      return view('subscribes.index',compact('subscribes'));
  }

  //応募画面表示
  public function show($id)
  {
      $wish = Wish::find($id);
      if($wish->user_id == auth()->id()){
        $wish->content = str_replace("\r\n", '<br>', $wish->body);
        return view('pages.wish',compact('wish'));
      }
      $data = Subscribe::where('user_id',auth()->id())
            ->where('wish_id',$id)
            ->where('status',1)
            ->first();
      $wish_id = $id;
      $user_id = auth()->id();
      if (isset($data)) {
          $message = $data->message;
      } else {
          $message = '';
      }
      return view('subscribes.show',compact('wish','message','wish_id','user_id'));
  }

  //応募・納品をする
  public function store(Request $request)
  {
       $wish = Wish::find($request->wish_id);
       $data = Subscribe::where('user_id',$request->user_id)
               ->where('wish_id',$request->wish_id)
               ->where('status',$request->status)
               ->first();
      if (!isset($data)) {
          $data = new Subscribe();
          $data->user_id = $request->user_id;
          $data->wish_id = $request->wish_id;
          $data->status = $request->status;
      }
      $data->message = $request->message;
      $wish_id = $data->wish_id;
      $user_id = $data->user_id;
      $message = $data->message;
      if ($request->status == 1 ) {
          //応募完了
          $data->save();
          return view('subscribes.store',compact('wish','message','wish_id','user_id'));
      } else if ($request->status == 3) {
          //引き取り
          $subscribes = Subscribe::where('wish_id',$wish_id)
                      ->where('user_id',$user_id)
                      ->where('status',2)
                      ->first();
          if (isset($subscribes)) {
              //引き取る人が特定できた時
              $subscribes->status = 3;
              $subscribes->save();
          }
          return $this->index();
      }
   }
}
