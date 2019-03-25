<figure class="mg-room">
    <a href="{{ route('front.house', $house->id) }}">
        @if(\count($house->images))
            <img class="img-fluid" src="{{ asset($house->images->first()->slug) }}" alt="img11">
        @else
            <img class="img-fluid" src="assets/images/room-1.png" alt="img11">
        @endif
        <figcaption>
            <h2>{{ $house->name }}</h2>
            <div class="mg-room-price">{{ \number_format($house->price,0,'', ' ') }} &#8364;</div>
            <p>Количество спален - {{ $house->capacity }}<br>Площадь - {{ $house->area }} кв.м</p>
        </figcaption>
    </a>
</figure>