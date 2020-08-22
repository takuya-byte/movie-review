<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;

class UsersController extends Controller
{
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = Auth::user($id);
        
        
        // ログインユーザのレビュ一覧を作成日時の降順で取得
        $reviews = $user->reviews()->orderBy('created_at', 'desc')->get();

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
    
    public function favorites($id)
    {
        $user = Auth::user($id);
        
        $user->loadRelationshipCounts();
        
       $reviews = $user->favorites()->orderBy('created_at', 'desc')->get();
        
        return view('users.favorites',[
            'user' => $user,
            'reviews'=>$reviews,
            
            ]);
    }
    
   
}
