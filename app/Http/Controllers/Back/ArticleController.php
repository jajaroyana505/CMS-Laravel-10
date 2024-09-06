<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use PhpParser\Node\Arg;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            // response ajax datatable server side
            $article = Article::with('Category')->latest()->get();
            return DataTables::of($article)
                // Custome column
                ->addIndexColumn()
                ->addColumn("category_id", function ($article) {
                    return $article->Category->name;
                })
                ->addColumn("status", function ($article) {
                    if ($article->status != 0) {
                        return "<span class='badge bg-success'>Publish</span>";
                    } else {
                        return "<span class='badge bg-danger'>Private</span>";
                    }
                })
                ->addColumn("button", function ($article) {
                    return '<div class="text-center">
                                <a href="' . url('articles/' . $article->id) . '" class="btn btn-secondary btn-sm btn-round">Detail</a>
                                <a href="' . url('articles/' . $article->id) . '/edit" class="btn btn-outline-primary btn-sm btn-round">Edit</a>
                                <a href="#" onClick="deleteArticle(this)" data-id=" ' . $article->id . '" class="btn btn-outline-danger btn-sm btn-round">Delete</a>
                            </div>';
                })
                // Panggil costume column
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }
        return view('back.article.index', [
            "page" => 'article',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("back.article.create", [
            "page" => 'article',
            "categories" => Category::get()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('img');
        $filenName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/back/' . $filenName);

        $data['img'] = $filenName;
        $data['slug'] = Str::slug($data['title']);

        // dd($data);

        Article::create($data);
        return redirect(url('articles'))->with('success', 'Article has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("back.article.detail", [
            "page" => 'article',
            "article" => Article::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("back.article.update", [
            "page" => 'article',
            "article" => Article::find($id),
            "categories" => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->file('img') != null) {
            $file = $request->file('img');
            $filenName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/back/' . $filenName);

            // unlink atau hapus file img dari penyimpanan
            Storage::delete('public/back/' . $request->old_img);

            $data['img'] = $filenName;
        } else {
            $data['img'] = $request->old_img;
        }

        // dd($data);
        Article::find($id)->update($data);
        return redirect('articles/')->with("success", "Article has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Article::find($id);
        Storage::delete('public/back/' . $data->img);
        $data->delete();

        return response()->json([
            "message" => "data has been deleted"
        ]);
    }
}
