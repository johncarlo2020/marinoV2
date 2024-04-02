<div class="col-12 col-md-12 col-lg-12 col-xl-6 ">
    <div class="brands-container">
         @foreach ($list as $brand)
            <div class="item-list">
                <img src="{{ $brand['imageUrl'] }}" alt="">
            </div>
         @endforeach
    </div>
</div>
