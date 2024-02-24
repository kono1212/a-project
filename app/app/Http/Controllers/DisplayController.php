<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Buy; 
use App\Follow;
use App\Like;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index()
    {
        // ポストテーブルの全データを取得
        $posts = Post::paginate(15);

        if (!Auth::check()) {
            // ログインしていない場合の処理
            return view('top', compact('posts'));
        }

        // ログインしている場合の処理
        return view('home', compact('posts'));
    }

    // コントローラーのメソッド内での検索処理の例
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $priceRange = $request->input('price');
    
        // 商品モデルを適切に取得するクエリを組み立てる
        $query = Post::query();
    
        // キーワードでの検索
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                  ->orWhere('explain', 'like', "%$keyword%");
            });
        }
    
        // 価格範囲での絞り込み
        // 価格範囲での絞り込み
if ($priceRange) {
    if ($priceRange === '5000-') {
        $minPrice = 5000;
        $query->where('amount', '>=', $minPrice);
    } else {
        $priceArray = explode('-', $priceRange);
        if (count($priceArray) == 2) {
            $minPrice = (int)$priceArray[0];
            $maxPrice = (int)$priceArray[1];
            if ($maxPrice === 1000) {
                $query->where('amount', '<=', $maxPrice);
            } else {
                $query->whereBetween('amount', [$minPrice, $maxPrice]);
            }
        }
    }
}

    
        // 検索結果を取得
        $posts = $query->paginate(15);
    
        // 検索結果をビューに渡して表示
        return view('home', compact('posts'));
    }
    

    

    public function PostDetail()
    {
        return view('post_detail');
    }

    public function mypage()
    {
        // 現在ログインしているユーザーの情報を取得
        $user = Auth::user();
    
        // ビューにユーザー情報を渡してマイページを表示
        return view('mypage', compact('user'));
    }
    

    // アカウント情報の編集
public function editAccount()
{
        $user = Auth::user();
        // 取得したユーザー情報をビューに渡す
        return view('user_edit', compact('user'));
        
}



    // 売上履歴の表示
    public function salesHistory()
    {
        // 売上履歴の表示などの処理を実装
    }

    // 購入履歴の表示
    public function purchaseHistory()
    {
        // 購入履歴の表示などの処理を実装
    }

    // フォロー一覧の表示
    public function followList()
    {
        // ログイン中のユーザーがフォローしているユーザーを取得
        $followings = User::whereIn('id', function ($query) {
                            $query->select('follow_id')
                                  ->from('follows')
                                  ->where('user_id', auth()->id());
                        })->get();

        return view('follow', compact('followings'));
    }



    // いいね一覧の表示
    public function likeList()
    {
        $userLikes = Like::where('user_id', auth()->id())->get();
        return view('like', compact('userLikes'));
    }

    // 出品一覧の表示
    public function listing()
    {
        // 出品一覧の表示などの処理を実装
    }

    public function top()
    {
        return view('top');
    }

    

    public function userUpdate(Request $request, User $user)
    {
        // フォームから送信されたデータを取得
        $data = $request->only(['name', 'email', 'profile']);
    
        // ユーザーモデルのプロパティを更新
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->profile = $data['profile'];
    
        // アップロードされた画像ファイルの処理
        if ($request->hasFile('image')) {
            // アップロードされたファイルを取得
            $image = $request->file('image');
    
            // 画像を保存して、パスをデータベースに保存する処理

$path = $image->store('public/images');
    
            // publicディレクトリに移動
            $publicPath = str_replace('public/', 'storage/', $path);
            $user->image = $publicPath;



        }
    
        // ユーザーモデルを保存
        $user->save();
    
        // リダイレクト
        return redirect()->route('mypage');
    }
    
    

    



public function deleteConfirm($id)
{
    // ユーザー情報を取得して確認ページに渡す
    $user = User::findOrFail($id);
    return view('user_delete_conf', compact('user'));
}

public function delete(Request $request, $id)
{
    // ユーザーを取得
    $user = User::findOrFail($id);
        $user->del_flag = true; // del_fig カラムを true に設定
        $user->save();

        Auth::logout();

        return redirect('/')->with('success', 'アカウントを削除しました');

}


public function sell()
{
    // ログインユーザーが出品した商品の一覧を取得し、ページネーションを適用
    $posts = Post::where('user_id', auth()->id())->paginate(15);

    // sell.blade.phpビューを返す
    return view('sell', compact('posts'));
}




public function buyHistory()
{
    // ログイン中のユーザーが購入した商品の一覧を取得
    $purchasedItems = Buy::where('user_id', auth()->id())->get();

    // sell_history.blade.phpビューを返す
    return view('buy_history', compact('purchasedItems'));
}


    public function sellHistory()
    {
        // ログインユーザーが出品した商品のうち、売り切れとなっている商品を取得
        $soldItems = Post::where('user_id', auth()->id())
                         ->where('status_flg', 1) // 売り切れ
                         ->get();

        return view('sell_history', compact('soldItems'));
    }
    
    public function userPage($id)
    {
        // ユーザー情報と関連する出品商品を取得
        $user = User::findOrFail($id);
        $posts = $user->posts()->paginate(10);

        // ユーザーページのビューを表示
        return view('user_page', compact('user', 'posts'));
    }
    

    public function toggleFollow($id)
    {
        $userToFollow = User::findOrFail($id);
        
        if (auth()->user()->isFollowing($userToFollow)) {
            auth()->user()->unfollow($userToFollow);
        } else {
            auth()->user()->follow($userToFollow);
        }
        
        return back();
    }

}
