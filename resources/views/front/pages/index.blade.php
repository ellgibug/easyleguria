@extends('front.layouts.master')

@section('content')
    @if(\count($sliders))
    <div class="carousel slide" id="mega-slider" data-ride="carousel">
        <!-- Indicators-->
        <ol class="carousel-indicators">
            @foreach($sliders as $k => $slider)
                <li class="{{ $k == 0 ? 'active' : '' }}" data-target="#mega-slider" data-slide-to="{{ $k }}"></li>
            @endforeach
        </ol>
        <!-- Wrapper for slides-->
        <div class="carousel-inner relative">

            @foreach($sliders as $k => $slider)
            <div class="carousel-item text-center {{ $k == 0 ? 'active beactive' : '' }}" style="background: url({{ asset($slider->slug) }});background-size: cover;">
                <a href="{{ $slider->link }}" target="_blank">
                    <div class="bg-overlay-dark-2"></div>
                    <img src="{{ asset($slider->slug) }}" alt="..." width="100%">
                </a>
            </div>
            @endforeach
        </div>
        <div class="carousel-control-prev carousel-control left" href="#mega-slider" role="button" data-slide="prev"></div>
        <div class="carousel-control-next carousel-control right" href="#mega-slider" role="button" data-slide="next"></div>
    </div>
    @endif
    <section class="mg-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-justify">
                    <div class="mg-sec-title undefined">
                        <h2>EASYLIGURIA</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mg-feature main-page-text">
                                <p>Дорогие друзья,</p>
                                <p>Как часто за бокалом итальянского вина вы мечтали, чтобы воспоминания о лете, проведенном в Италии стали бы неотъемлемой частью вашей жизни.</p>
                                <p>Море, променад, итальянские бары и рестораны, свежий воздух и невероятное ощущение спокойствия и стабильности должны ли быть только составляющими отпуска?</p>
                                <p>EasyLiguria готова предложить вам недвижимость в Лигурии – одной из самых респектабельных областей Италии, знаменитом Лазурном береге, оканчивающимся во Франции.</p> 
                                <p>Теплые зимы, большое количество солнечных дней, великолепная буйством красок природа могут стать частью вашей жизни.</p>
                                <p>Мы сами проживаем в Лигурии и как никто ответственны перед нашими клиентами.</p>
                                <p>Помимо подбора недвижимости для каждого и полного сопровождения сделки мы готовы предложить нашим клиентам помощь в получении вида на жительство, помогать в любых вопросах, связанных с эксплуатацией недвижимости, обеспечить консьерж-сервис.</p>
                                <p>Давайте станем друг другу добрыми соседями!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection