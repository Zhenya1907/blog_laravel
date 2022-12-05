<!doctype html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Articles</title>
</head>
<body>

<form action="{{ url()->current() }}">
    <input type="text" name="q" value="{{ request()->input('q') }}">
    <button>Search</button>
</form>

<h1>Popular topics</h1>
@foreach($popularTags as $tag)
    <span>[<a href="{{ route('index', ['tag_id' => $tag->id]) }}">{{ $tag->title }}</a>]</span>
@endforeach

@if ($tags && $tags->count() > 0)
    <h1>Tags</h1>
    @foreach($tags as $tag)
        <span>[<a href="{{ route('index', ['tag_id' => $tag->id]) }}">{{ $tag->title }}</a>]</span>
    @endforeach
@endif

<div id="articles_data">
    @include('app.pagination')
</div>

<script>

    $(document).ready(function () {
        $(document).on('click', '.relative', function (event) {
            event.preventDefault();

            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);

        });

        function fetch_data(page) {
            $.ajax({
                url: "{{ route('pagination') }}",
                data: {page: page},
                success: function (data) {
                    $("#articles_data").html(data);
                }
            });
        }
    });

</script>

</body>
</html>

