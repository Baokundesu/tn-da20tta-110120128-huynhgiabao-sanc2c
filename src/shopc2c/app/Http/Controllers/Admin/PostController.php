<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        // Logic lấy danh sách bài đăng
        $posts = Post::all(); // Ví dụ lấy tất cả bài đăng, bạn có thể thay đổi logic lấy dữ liệu theo yêu cầu

        return view('admin.posts.index', compact('posts'));
    }

    public function pending()
    {
        // Logic lấy danh sách bài đăng chưa duyệt
        $pendingPosts = Post::where('approved', false)->get();

        return view('admin.posts.pending', compact('pendingPosts'));
    }

    public function approve($id)
    {
        // Logic duyệt bài đăng
        $post = Post::findOrFail($id);
        $post->approved = true;
        $post->save();

        return redirect()->route('admin.posts.pending')->with('success', 'Bài đăng đã được duyệt thành công.');
    }

    public function destroy($id)
    {
        // Logic xóa bài đăng
    }
}

