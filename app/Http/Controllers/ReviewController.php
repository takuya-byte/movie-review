<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Review;

class ReviewController extends Controller
{
    //
    public function index()
    {
    $reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);        
    return view('index', compact('reviews'));
    }
    
    public function show($id)
{
    
    $review = Review::where('id', $id)->where('status', 1)->first();

    return view('show', compact('review'));
}
    
    public function create()
    {
        return view('review');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        if ($request->hasFile('image')) {
    
        $review = new Review;
        $review->title = $request->title;
        $review->body = $request->body;
        $review->image =Storage::disk('s3')->url($request->file('image')->store('public/images','s3'));
        $review->user_id = Auth()->id();
        
        $review->save();
        } else {
         $review = new Review;
        $review->title = $request->title;
        $review->body = $request->body;   
         $review->user_id = Auth()->id();
         $review->save();
        }
        return redirect('/')->with('flash_message', '投稿が完了しました');
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review ->delete();
        
        return redirect('/');
    }
    
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        
        return view('edit',[
                'review' => $review,
            ]);
    }
    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
     if ($request->hasFile('image')) {

        
        $review = Review::findOrFail($id);
        // 映画レビュー更新
        $review->title = $request->title;
        $review->body = $request->body;
        $review->image =Storage::disk('s3')->url($request->file('image')->store('public/images','s3'));
        $review->user_id = Auth()->id();
        
        $review->save();
        
        
     } else {
        $review = Review::findOrFail($id);
        // 映画レビュー更新
        $review->title = $request->title;
        $review->body = $request->body;
        $review->user_id = Auth()->id();
        $review->save();
     }

        // トップページへ
        return redirect('/');
    }
    
    
    
    
   
  
}


