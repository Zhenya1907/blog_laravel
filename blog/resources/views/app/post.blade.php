<h2>{{ $article->title }}</h2>
<h4>{{ $article->content }}</h4>
<h4>{{ $article->created_at }}</h4>

@foreach($article->tags as $tag)
    <span>[<a href="{{ route('index', ['tag_id' => $tag->id]) }}">{{ $tag->title }}</a>]</span>
@endforeach

@foreach($article->comments as $comment)
    <h2>{{ $comment->content}}</h2>
    <h4>{{ $comment->created_at }}</h4>
@endforeach

@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

<form action="{{ route('add_comment', $article) }}" method="post">
    @csrf
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <button>Push</button>
</form>

<a href="{{ URL::previous() }}">Back</a>



