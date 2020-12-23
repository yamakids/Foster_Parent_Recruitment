<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wish;
use App\Models\Subscribe;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Storage;

class WishController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth');
  }

// 案件登録ページ表示
  public function index()
   {
       $data = Wish::where('user_id', '=', auth()->id())->first();
       if (isset($data)) {
           $title = $data->title;
           $body = $data->body;
           $subscribes = Subscribe::where('wish_id',$data->id)->get();
       } else {
           $title = '';
           $body = '';
           $subscribes = null;
       }
       return view('wishes.index',compact('title','body','subscribes'));
   }

// 案件登録
   public function store(Request $request)
    {
        $upload_image = $request->file('image');

        if($upload_image) {
          if($request->title == null or  $request->body == null){
             return $this->index();
          }
          //アップロードされた画像を保存する
           $path = Storage::disk('s3')->putFile('uploads_animal',$upload_image, 'public');
          //画像の保存に成功したらDBに記録する
          if($path){
              if ($request->func == 1) {
               //案件登録
               $path = Storage::disk('s3')->url($path);
              $params = [
                'user_id' => auth()->id(),
                'title' => $request->title,
                'body' => $request->body,
                'wish_at' =>  date_format(Carbon::now() , 'Y-m-d'),
                'file_name' => $upload_image->getClientOriginalName(),
                'file_path' => $path,
              ];

              $data = Wish::where('user_id', '=', auth()->id())->first();
              if (!isset($data)) {
                Wish::create($params);
              }else{
                $data->fill($params)->save();
              }
             }
           }
        }

               //応募者から決定
              if ($request->func == 2) {
               $data = Wish::where('user_id', '=', auth()->id())->first();
               if($data == null){
                   return $this->index();
               }
               $query = Subscribe::where('wish_id',$data->id)
                      ->where('status','<>',1);
               if ($query->count() == 0) {
                 //応募者だけの時は指定の人を決定とする
                   $subscribes = Subscribe::where('wish_id',$data->id)
                              ->where('user_id',$request->user_id)
                              ->where('status',1)
                              ->first();
                   if (isset($subscribes)) {
                       //誰にするか決まった時
                       $subscribes->status = 2;
                       $subscribes->save();
                   }
               } else {
                 //引き取られたか？
                   $query = Subscribe::where('wish_id',$data->id)
                         ->where('user_id',$request->user_id)
                         ->where('status',3);
                   if ($query->count() == 1) {
                       //引き取り済み
                       $subscribes = $query->first();
                       if (isset($subscribes)) {
                           //引き取った人が特定できた時
                           $subscribes->status = 4;
                           $subscribes->save();
                           //ポートフォリオに記載
                           $portfolio = new Portfolio();
                           $portfolio->user_id=$request->user_id;
                           $wish = Wish::find($data->id);
                           $portfolio->title = $wish->title;
                           $portfolio->body = $wish->body;
                           $portfolio->save();
                       }
                   }
               }
             }
            return $this->index();
       }
}
