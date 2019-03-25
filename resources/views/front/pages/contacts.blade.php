@extends('front.layouts.master')

@section('content')
    <div class="mg-page-title relative"
         @if($slider)
         style="background-image: url({{ asset($slider->slug) }}); background-size: cover"
            @endif
    >
        <div class="bg-overlay-dark-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Контакты</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="mg-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h2 class="mg-sec-left-title">Отправьте нам сообщение</h2>
                    <div id="contact_info"></div>
                    <form class="clearfix" action="{{ route('front.contact.send') }}">
                        <div class="mg-contact-form-input">
                            <label for="name">Имя*</label>
                            <input class="form-control" id="name" name="name" type="text" required>
                        </div>
                        <div class="mg-contact-form-input">
                            <label for="email">E-mail*</label>
                            <input class="form-control" id="email" name="email" type="email" required>
                        </div>
                        <div class="mg-contact-form-input">
                            <label for="subject">Тема*</label>
                            <input class="form-control" id="subject" name="subject" type="text" required>
                        </div>
                        <div class="mg-contact-form-input">
                            <label for="message">Сообщение*</label>
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                        </div>
                        <p>* все поля являются обязательными</p>
                        <button class="btn btn-dark-main pull-right" type="button">Отправить</button>
                    </form>
                </div>
                <div class="col-lg-7 mt-4 mt-lg-0">
                    <h2 class="mg-sec-left-title">Адрес</h2>
                    <ul class="mg-contact-info">
                        <li><i class="fa fa-map-marker"></i> Россия, Москва, Улица 1, Дом 1</li>
                        <li><i class="fa fa-phone"></i> 8 (495) 123-45-67</li>
                        <li><i class="fa fa-envelope"></i> <a href="mailto:info@your-test.site">info@your-test.site</a>
                        </li>
                    </ul>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2257.753568495067!2d37.53048011564533!3d55.53666158049609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x414aac6acb94f09b%3A0x5199d151a90fc625!2z0K7QttC90L7QsdGD0YLQvtCy0YHQutCw0Y8g0YPQuy4sIDQ5LCDQnNC-0YHQutCy0LAsIDExNzA0Mg!5e0!3m2!1sru!2sru!4v1549464080030" width="100%" height="354" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/contact.js') }}"></script>
@endsection