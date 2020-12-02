<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function newResearch(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
        ];
        $messages = [
            'title.required' => 'Укажите заголовок',
            'image.mimes' => 'Картинка должна быть: jpg или png',
            'image.image' => 'Файл не является изображением',
        ];
        if ($request->image) {
            $rules['image']='mimes:jpeg,png,jpg';
        }
        $request->validate($rules, $messages);
        // проверим есть ли уже такие записи
        $token =$request->_token.Str::random(2);
        $dublicates = DB::table('order')->where(['token'=>$token])->get();
        if ($dublicates->count() >10) {
            return redirect()->back()
            ->withErrors([
                'count'=>'У вас уже есть созданные опросы. Повторите попытку на следующий день или оплатите подписку'
                ]);
        };

        if ($request->image) {
        $file = $request->image;
        Image::make($file)
            ->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->sharpen(5)->save();
            $filename = $token;
            $path = $file->storeAs('public', 'uploads/'.$filename.'.'.$request->image->extension());
            $path = str_replace('public/', '/storage/', $path);
        } else {
            $path = null;
        }
        
        DB::table('order')->insert([
            'image'=>$path,
            'title'=>$request->title,
            'description'=>$request->description,
            'token'=>$token,
        ]);

        return View('neworder')->with('data', [
            'title'=>$request->title,
            'token'=>$token,
        ]);
    }

    static function getResearch($token) {
        $dataArr = DB::table('order')->where('token',$token)->first();
        $likesArr = DB::table('likes')->where('orderToken',$token)->get()->sortByDesc('likes');
        
        return View('research', compact('dataArr', 'likesArr'));
    }

    public function setLike(Request $request)
    {
        $like = DB::table('likes')->where('id', $request->id)->first();
        // $token = Session::get('_token');
        $likeUserlist = json_decode($like->likeUserlist);
        
        if ($likeUserlist == ''){ 
            $likeUserlist = [];
        } elseif (array_search($request->_token, $likeUserlist) !==false) {
            return response()->json(false);    
        }
        $likeUserlist[] = $request->_token;
        DB::table('likes')->where('id', $request->id)
        ->update([
            'likeUserlist'=>$likeUserlist,
            'likes' => $like->likes+1
            ]);
        return response()->json($like->likes+1);
    }

    public function newTweet(Request $request)
    {
        // проверим нет ли уже твита от этого пользователя
        // нет ли похожего твита
        // ...
        DB::table('likes')->insert([
            'orderToken'=>$request->orderToken,
            'userToken'=>$request->_token,
            'tweet'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect()->back();
    }
}
