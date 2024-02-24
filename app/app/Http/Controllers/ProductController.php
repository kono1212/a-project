<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
use App\Buy;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'required',
            'explain' => 'required',
            'condition' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->image = $imageName;
        $post->amount = $request->amount;
        $post->explain = $request->explain;
        $post->condition = $request->condition;
        $post->save();

        return redirect()->route('home')->with('success', '商品を出品しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post_detail', compact('post'));
    }

    public function myshow($id)
    {
        $post = Post::findOrFail($id);
        return view('my_post', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('products.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('home')->with('success', '商品が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('home')->with('success', '商品が削除されました');
    }

    public function purchaseDetail(Post $post)
{
    // 購入処理を実行するコードをここに記述する

    // 購入者情報を登録するページにリダイレクト
    return view('buy', compact('post'));
}



public function purchaseConfirm(Request $request, Post $post)

{    
    
    $name = $request->input('name');
    $tel = $request->input('tel'); // 修正
    $post_code = $request->input('post_code'); // 修正
    $address = $request->input('address');
    return view('buy_conf', compact('post', 'name', 'tel', 'post_code', 'address'));
}


public function purchaseComplete(Request $request)
{
    // フォームから送られてきた購入情報を取得
    $data = $request->only(['name', 'tel', 'post_code', 'address', 'post_id']);

    // ログインユーザーのIDを取得するか、適切なユーザーIDを設定します。
    $userId = auth()->id(); // もしくは、適切なユーザーIDを設定

    // 購入情報をデータベースに登録
    $buy = new Buy();
    $buy->user_id = $userId;
    $buy->post_id = $data['post_id'];
    $buy->name = $data['name'];
    $buy->tel = $data['tel'];
    $buy->post_code = $data['post_code'];
    $buy->address = $data['address'];
    $buy->save();

    // 対応する投稿のstatus_flgを更新する
    $post = Post::findOrFail($data['post_id']);
    $post->status_flg = 1;
    $post->save();

    // データ登録後は、適切なページにリダイレクトする
    return view('buy_comp');
}






}
