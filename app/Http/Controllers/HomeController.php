<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $posts = Post::paginate();
        return view('index', compact('posts'));
    }

    public function checkSubmit(Request $request)
    {
        switch ($request['status']) {

            case 'publish':
                Post::whereIn('id', $request['newIds'])->update([
                    'status' => 'publish',
                ]);
                break;
            case 'unpublish':
                Post::whereIn('id', $request['newIds'])->update([
                    'status' => 'unpublish',
                ]);

                break;

            default:
                response()->json('Lỗi');
        }
        return redirect(route('index'));
    }

    public function listUser()
    {
        $users = User::all();
        return view('user', compact('users'));
    }
}
