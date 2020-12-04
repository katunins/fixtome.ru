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
        
        dd($_FILES);
        $rules = [
            'title' => 'required|max:255',
        ];
        $messages = [
            'title.required' => 'Укажите заголовок',
            'image.mimes' => 'Картинка должна быть: jpg или png',
            'image.image' => 'Файл не является изображением',
            'image.required' => 'Файлу не удалось загрузиться на сервер',
        ];
        if ($request->image) {
            $rules['image'] = 'required|mimes:jpeg,png,jpg';
        }
        $request->validate($rules, $messages);
        // проверим есть ли уже такие записи
        $token = $request->_token . Str::random(2);
        $dublicates = DB::table('order')->where(['token' => $token])->get();
        if ($dublicates->count() > 10) {
            return redirect()->back()
                ->withErrors([
                    'count' => 'У вас уже есть созданные опросы. Повторите попытку на следующий день или оплатите подписку'
                ]);
        };

        if ($request->image) {
            $file = $request->image;
            Image::make($file)
                ->orientate()
                ->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->sharpen(5)->save();
            $filename = $token;
            $path = $file->storeAs('public', 'uploads/' . $filename . '.' . $request->image->extension());
            $path = str_replace('public/', '/storage/', $path);
        } else {
            $path = null;
        }

        DB::table('order')->insert([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'token' => $token,
        ]);

        return View('neworder')->with('data', [
            'title' => $request->title,
            'token' => $token,
        ]);
    }

    static function getResearch($token)
    {
        $dataArr = DB::table('order')->where('token', $token)->first();
        $likesArr = DB::table('likes')->where('orderToken', $token)->get()->sortByDesc('likes');

        return View('research', compact('dataArr', 'likesArr'));
    }

    public function setLike(Request $request)
    {
        $like = DB::table('likes')->where('id', $request->id)->first();
        $likeUserlist = json_decode($like->likeUserlist);
        // dd (array_search($request->_token, $likeUserlist));
        if ($likeUserlist == '') {
            $likeUserlist = [];
        } elseif (array_search($request->_token, $likeUserlist) == 0) {
            return response()->json(false);
        }
        $likeUserlist[] = $request->_token;
        DB::table('likes')->where('id', $request->id)
            ->update([
                'likeUserlist' => $likeUserlist,
                'likes' => $like->likes + 1
            ]);
        return response()->json($like->likes + 1);
    }

    public function newTweet(Request $request)
    {
        // проверим нет ли уже твита от этого пользователя
        // нет ли похожего твита
        // ...
        DB::table('likes')->insert([
            'orderToken' => $request->orderToken,
            'userToken' => $request->_token,
            'tweet' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    static function getAllResearch()
    {
        // token": "Zhm55cXLlWp7Pdo1KaW18l4dMj2LZScPJfaTdMbzek"
        // +"title": "ауц"
        // +"description": null
        // +"image": null
        $dataArr = [];
        foreach (DB::table('order')->get() as $item) {
            $dataArr[$item->token] = [
                'title' => $item->title,
                'description' => $item->description,
                'image' => $item->image
            ];
        }
        // orderToken": "Zhm55cXLlWp7Pdo1KaW18l4dMj2LZScPJfaTdMbzek"
        // +"userToken": "Zhm55cXLlWp7Pdo1KaW18l4dMj2LZScPJfaTdMbz"
        // +"likeUserlist": null
        // +"tweet": "цуа"
        // +"description": null
        // +"likes": 0
        foreach (DB::table('likes')->get() as $item) {
            $dataArr[$item->orderToken]['likes'][$item->userToken] = [
                'tweet' => $item->tweet,
                'description' => $item->description,
                'likes' => $item->likes
            ];
        }

        // foreach (DB::table('order')->get() as $item) {
        //     $dataArr[$item['token'] = [
        //         'title'
        //     ]];
        // }
        // $likesArr = DB::table('likes')->where('orderToken',$token)->get()->sortByDesc('likes');   

        return $dataArr;
    }
}
