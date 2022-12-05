<h1>News</h1>
@foreach($articles as $article)
    <h2>{{ $article->title }}</h2>
    <p>{{ $article->content }}</p>
    <a href="{{ route('show_one_article', $article->id) }}">More</a>
@endforeach

{{ $articles->links() }}
