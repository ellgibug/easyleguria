@extends('front.layouts.master')

@section('content')
    <div class="mg-page-title relative"
         @if($slider)
         style="background-image: url({{ asset($slider->slug) }}); background-size: cover; position: relative"
            @endif
    >
        <div class="bg-overlay-dark-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Предложения</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="mg-book-now">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h2 class="mg-bn-title">Поиск предложений</h2>
                </div>
                <div class="col-lg-9">
                    <div class="mg-bn-forms">
                        <form action="{{ route('front.houses') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <select class="cs-select cs-skin-elastic" name="sortBy">
                                                <option disabled>Сортировать по</option>
                                                <option value="price" {{ request()->get('sortBy') == 'price' ? 'selected' : ''}}>Цена</option>
                                                <option value="area" {{ request()->get('sortBy') == 'area' ? 'selected' : ''}}>Площадь</option>
                                                <option value="capacity" {{ request()->get('sortBy') == 'capacity' ? 'selected' : ''}}>Количество спален</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <select class="cs-select cs-skin-elastic" name="order">
                                                <option disabled>Тип сортировки</option>
                                                <option value="asc" {{ request()->get('order') == 'asc' ? 'selected' : ''}}>По возрастанию</option>
                                                <option value="desc" {{ request()->get('order') == 'desc' ? 'selected' : ''}}>По убыванию</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 mb-3">
                                    <button class="btn btn-main btn-block" type="submit">Сортировать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mg-page">
        <div class="container">
            <div class="row">
                @foreach($houses as $house)
                <div class="col-md-4">
                    @include('components.house')
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                {{ $houses->links() }}
            </div>
        </div>
    </div>
@endsection