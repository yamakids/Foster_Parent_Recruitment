<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\app\models\Wish;
use Illuminate\Pagination\Paginator;

class PageController extends Controller
{
  //案件一覧表示
   public function list()
   {
       $list = Wish::paginate(5);
       return view('pages.wishlist',compact('list'));
   }

   //案件詳細表示
   public function show($id)
   {
       $wish = Wish::find($id);
       $wish->content = str_replace("\r\n", '<br>', $wish->body);
       return view('pages.wish',compact('wish'));
   }
}
