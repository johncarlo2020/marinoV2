<div class="col-12 col-md-12 col-lg-12 col-xl-6 main-container">
    <div class="title-with-paragraph  p-2 p-lg-4 mt-4">
        <h1>{{ $title }}</h1>
        @foreach ($content as $paragraph)
            <p>{{ $paragraph['text'] }}</p>
        @endforeach
    </div>
</div>
