<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Portfolio;

class PortfolioController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  //ポートフォリオ表示
  public function show($id)
  {
    $list = Portfolio::where('user_id','=',$id)->get();
    return view('portfolio.portfoliolist',compact('list'));
  }
}
