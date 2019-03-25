<header class="header transp sticky">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar navbar-expand-md justify-content-between"><a class="navbar-brand" href="{{ route('front.index') }}"><img src="{{ asset('assets/images/logo_white_new.svg') }}" alt="logo"></a>
                <div class="mg-navs">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav navbar-right">
                            <li class="{{ Request::route()->getName() == 'front.index' ? 'active' : '' }}">
                                <a href="{{ route('front.index') }}">Главная</a>
                            </li>
                            <li class="{{ Request::route()->getName() == 'front.houses' || Request::route()->getName() == 'front.house' ? 'active' : '' }}">
                                <a href="{{ route('front.houses') }}">Предложения</a>
                            </li>
                            <li class="{{ Request::route()->getName() == 'front.page' ? 'active' : '' }}">
                                <a href="{{ route('front.page') }}">Дополнительные услуги</a>
                            </li>
                            <li class="{{ Request::route()->getName() == 'front.contact.get' ? 'active' : '' }}">
                                <a href="{{ route('front.contact.get') }}">Контакты</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

