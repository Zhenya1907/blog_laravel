<h1>Popular topics</h1>
@foreach($tags as $tag)
    <span>[<a href="{{ route('index', ['tag_id' => $tag->id]) }}">{{ $tag->title }}</a>]</span>
@endforeach
