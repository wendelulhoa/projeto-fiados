<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    public function index($title = null, Request $request){
        $categories = Posts::getCategories();

        if(isset($request->param)){
           $posts      = Posts::where([['title', 'ilike', '%' . $request->param . '%']])->orWhere([['content', 'ilike', '%' . $request->param . '%']])->join('users', 'posts.user_id', 'users.id')
           ->select('users.name as author', 'users.image', 'posts.*')->paginate(9) ?? [];
           return view('posts.index', ['posts'=>$posts, 'categories'=> $categories]);
        } else if($title == null){
            $posts = Posts::join('users', 'posts.user_id', 'users.id')
            ->select('users.name as author', 'users.image', 'posts.*')->paginate(9);

            return view('posts.index', ['posts'=>$posts, 'categories'=> $categories]);
        }else{
            $idCategory = array_search($title, $categories);
            $posts = Posts::where('category', $idCategory)->join('users', 'posts.user_id', 'users.id')
            ->select('users.name as author', 'users.image', 'posts.*')->paginate(9);
            return view('posts.index', ['posts'=>$posts, 'categories'=> $categories]);
        }
    }

    public function detail($id){
        $post = Posts::where('posts.id', $id)->join('users', 'posts.user_id', 'users.id')
        ->select('users.name as author', 'users.image', 'posts.*')->paginate(10);

        return view('posts.detail', ['post'=>$post]);
    }

    public function getStrutureCreate()
    {
        try {
            $categories = Posts::getCategoriesPt();
            return view('posts.create', ['categories'=> $categories]);
        } catch (Exception $e) {

        }
    }
    public function getStrutureEdit($id)
    {
        try {
            $post       = Posts::where(['id'=> $id, 'user_id'=> auth()->user()->id])->get();
            $categories = Posts::getCategoriesPt();
            if(count($post) == 0){
               return redirect(Route('index'));
            }
            return view('posts.create', ['post'=> $post, 'id'=>$id, 'categories'=> $categories]);
        } catch (Exception $e) {

        }
    }

    public function create(Request $request){
        try {
            $data           = $request->all();
            $principalImage = '';
            
            if(isset($request->file)){
                $principalImage = $request->file->store('/posts/images') ?? '';
            }

            DB::beginTransaction();
               Posts::create([
                    'title'=> $data['title'],
                    'image_principal'=> $principalImage,
                    'content'=>json_encode(['content'=>$data['content']]),
                    'category'=> $data['category'],
                    'approved'=> false,
                    'user_id'=> auth()->user()->id
               ]); 
            DB::commit();
            return redirect(Route('my-posts'));
        } catch (Exception $e) {
            DB::rollBack();
            Storage::delete($principalImage);
            return redirect(Route('my-posts'));
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $data           = $request->all();
            $imagesDelete   = [];
            $principalImage = [];

            DB::beginTransaction();
                Posts::where('id', $id)->update([
                    'title'=> $data['title'],
                    'content'=>json_encode(['content'=>$data['content']]),
                    'user_id'=> auth()->user()->id,
                    'approved'=> false,
                ]);
            DB::commit();
            return redirect(Route('my-posts'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(Route('my-posts'));
        }
    }

    public function myPosts(){
        try {
            $posts = Posts::orderBy('id','asc')->where(['user_id'=> auth()->user()->id])->paginate(6) ?? [];
            $categories = Posts::getCategories();
            return view('admin.approved', ['posts'=>$posts, 'categories'=> $categories]);
        } catch (Exception $e) {
            abort(400);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $post     = Posts::where('id', $id)->get();
            $user     = $post[0]->user_id ?? 0;
            $comments = Comments::where(['id_mod' => $id])
                ->join('users', 'comments.user_id', 'users.id')
                ->select('users.name', 'users.image', 'comments.*')
                ->orderBy('comments.id')->get();

            /*apaga os comentarios*/ 
            foreach($comments as $value){
                $value->delete();
            }

            Storage::delete($post[0]->image_principal);
            
            Posts::where('id', '=', $id)->delete();

            DB::commit();
            return response()->json('success', 200);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function approvedPost(Request $request)
    {
        try {
            DB::beginTransaction();
                if (isset($request->type) && $request->type == 'true') {
                    Posts::where('id', '=', $request->id)->update(['approved' => false]);
                } else {
                    Posts::where('id', '=', $request->id)->update(['approved' => true]);
                }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

        }
    }
}
