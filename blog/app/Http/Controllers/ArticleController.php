<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $tagId = $request->get('tag_id');

        $articles = Article::when($request->get('q'), function ($query) use ($request) {
            return $query->where('title', 'like', '%' . $request->get('q') . '%');
        })->when($tagId, function ($query) use ($tagId) {
            return $query->whereIn('id', Tag::find($tagId)->articles->pluck('id'));
        })->paginate(4);

        $tags = $tagId ? [] : Tag::when($request->get('q'), function ($query) use ($request) {
            return $query->where('title', 'like', '%' . $request->get('q') . '%');
        })->get();

        return view('app.index', compact('articles', 'tags'));
    }

    public function tags()
    {
        $popularArticleIds = DB::table('comments')
            ->select('articles.id', DB::raw('count(*) as c'))
            ->join('articles', 'articles.id', '=', 'comments.article_id')
            ->groupBy('articles.id')
            ->orderByDesc('c')
            ->limit(3)
            ->get()
            ->pluck('id');

        $tags = Tag::query()
            ->join('article_tag', 'article_tag.tag_id', '=', 'tags.id')
            ->select('tags.*')
            ->distinct()
            ->whereIn('article_tag.article_id', $popularArticleIds)
            ->get();

        return view('app.tags', compact('tags'));
    }

    public function article(Article $article)
    {
        return view('app.post', compact('article'));
    }

    public function pushComment(Article $article, PushCommentRequest $request)
    {
        Comment::create(['content' => $request->get('content'), 'article_id' => $article->id]);
        return back();
    }
}
