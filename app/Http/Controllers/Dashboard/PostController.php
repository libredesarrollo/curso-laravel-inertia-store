<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public $columns = [
        'id' => 'Id',
        'date' => 'Date',
        'title' => 'Title',
        'description' => 'Description',
        'type' => 'Type',
        'category_id' => 'Category',
    ];

    public function index()
    {

        $categories = Category::get();
        $search = request('search');
        $from = request('from');
        $to = request('to');
        $type = request('type');
        $category_id = request('category_id');
        $posted = request('posted');

        $sortColumn = request('sortColumn') ?? 'id';
        $sortDirection = request('sortDirection') ?? 'desc';

        $posts = Post::with('category')->orderBy($sortColumn, $sortDirection);

        if (request('search')) {
            $posts->where(function ($query) {
                $query->orWhere("id", "like", "%" . request("search") . "%")
                    ->orWhere("title", "like", "%" . request("search") . "%")
                    ->orWhere("description", "like", "%" . request("search") . "%");
            });
        }

        if (request('from') && request('to')) {
            $posts->whereBetween('date', [date(request("from")), date(request("to"))]);
        }

        if (request('type')) {
            $posts->where('type', request("type"));
        }
        if (request('category_id')) {
            $posts->where('category_id', request("category_id"));
        }
        if (request('posted')) {
            $posts->where('posted', request("posted"));
        }

        $posts = $posts->paginate(10);

        return inertia("Dashboard/Post/Index", ["sortDirection" => $sortDirection, "sortColumn" => $sortColumn, "columns" => $this->columns, "posts" => $posts, "categories" => $categories, "posted" => $posted, "category_id" => $category_id, "type" => $type, "from" => $from, "to" => $to, "search" => $search,]);
    }

    public function create()
    {
        $categories = Category::get();
        return inertia("Dashboard/Post/Save", compact('categories'));
    }

    public function store(Store $request)
    {
        $post = Post::create($request->validated());
        $this->upload($request, $post);
        return to_route('post.index')->with('message', "Created post successfully");
    }

    public function edit(Post $post)
    {
        $categories = Category::get();
        return inertia("Dashboard/Post/Save", compact('post', 'categories'));
    }

    public function update(Put $request, Post $post)
    {
        $post->update($request->validated());
        $this->upload($request, $post);
        return redirect()->route('post.index')->with('message', "Updated post successfully");
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('message', "Deleted post successfully");
    }

    public function upload(Request $request, Post $post)
    {
        $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
            ]
        );

        Storage::disk("public_upload")->delete("image/post/" . $post->image);

        $data['image'] = $filename = time() . "." . $request['image']->extension();

        $request->image->move(public_path("image/post"), $filename);

        $post->update($data);

        return to_route('post.index')->with('message', "Upload image to post successfully");
    }

    public function imageDelete(Post $post)
    {
        Storage::disk("public_upload")->delete("image/post/" . $post->image);
        $post->update(['image' => '']);
        return to_route('post.edit', $post->id)->with('message', "image removed to post successfully");
    }
}
