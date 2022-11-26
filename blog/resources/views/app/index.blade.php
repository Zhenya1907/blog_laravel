<form action="{{ url()->current() }}">
    <input type="text" name="q" value="{{ request()->input('q') }}">
    <button>Search</button>
</form>

@if ($tags && $tags->count() > 0)
    <h1>Tags</h1>
    @foreach($tags as $tag)
        <span>[<a href="{{ route('index', ['tag_id' => $tag->id]) }}">{{ $tag->title }}</a>]</span>
    @endforeach
@endif

<h1>News</h1>
@foreach($articles as $article)
    <h2>{{ $article->title }}</h2>
    <p>{{ $article->content }}</p>
    <a href="{{ route('show_one_article', $article->id) }}">More</a>
@endforeach

{{ $articles->links() }}
