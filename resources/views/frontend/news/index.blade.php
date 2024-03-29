@extends('frontend.parent')

@section('content')
    <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                        <div class="swiper-wrapper">
                            @foreach ($sliderNews as $row)
                            <div class="swiper-slide">
                                <a href="{{ route('detailNews', $row->slug) }}" class="img-bg d-flex align-items-end"
                                    style="background-image: url('{{ $row->image }}');">
                                    <div class="img-bg-inner">
                                        <h2>{{ $row->title }}</h2>
                                        <p>{{ Str::limit(strip_tags($row->content, 50)) }}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="custom-swiper-button-next">
                            <span class="bi-chevron-right"></span>
                        </div>
                        <div class="custom-swiper-button-prev">
                            <span class="bi-chevron-left"></span>
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($category as $row)
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>{{ $row->name }}</h2>
                    <div><a href="{{ route('detailCategory', $row->slug) }}" class="more">See All {{ $row->name }}</a></div>
                </div>

                <div class="row">
                    <div class="col-md-9">

                        @php
                            $latestNews = \App\Models\News::where('category_id', $row->id)
                                ->latest()
                                ->take(1)
                                ->get();
                        @endphp

                        @foreach ($latestNews as $news)
                            <div class="d-lg-flex post-entry-2">
                                <a href="{{ route('detailNews', $news->slug) }}" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                    <img src="{{ $news->image }}" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $row->name }}</span> <span
                                            class="mx-1">&bullet;</span>
                                        <span>{{ $news->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h3><a href="{{ route('detailNews', $news->slug) }}">{{ $news->title }}</a></h3>
                                    <p>
                                        {{ Str::limit(strip_tags($news->content, 50)) }}
                                    </p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ asset('zen/assets/img/person-2.jpg') }}"
                                                alt="" class="img-fluid"></div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">Wade Warren</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- get the first news form the category  --}}
                        {{-- fungsi take(1) untuk mengambil 1 data --}}

                        <div class="row">
                            {{-- fungsi random mengambil berita secara acak --}}
                            @foreach ($row->news->random(1) as $news)
                                <div class="col-lg-4">
                                    <div class="post-entry-1 border-bottom">
                                        <a href="{{ route('detailNews', $news->slug) }}"><img src="{{ $news->image }}" alt=""
                                                class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">{{ $row->name }}</span> <span
                                                class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                                        <h2 class="mb-2"><a href="{{ route('detailNews', $news->slug) }}">{{ $news->title }}</a></h2>
                                        <span class="author mb-3 d-block">Admin</span>
                                        <p class="mb-4 d-block">  {{ Str::limit(strip_tags($news->content, 100)) }}</p>
                                    </div>
                                    
                                    <div class="post-entry-1">
                                        <div class="post-meta"><span class="date">Culture</span> <span
                                                class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                                        <h2 class="mb-2"><a href="{{ route('detailNews', $news->slug) }}">5 Great Startup Tips for Female
                                                Founders</a></h2>
                                        <span class="author mb-3 d-block">Jenny Wilson</span>
                                    </div>
                                </div>
                            @endforeach
                            
                            @foreach ($row->news->random(1) as $news )
                            <div class="col-lg-8">
                                <div class="post-entry-1">
                                    <a href="{{ route('detailNews', $news->slug) }}"><img
                                            src="{{ $news->image }}" alt=""
                                            class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">{{ $row->name }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                                    <h2 class="mb-2"><a href="{{ route('detailNews', $news->slug) }}">{{ $news->title }}</a></h2>
                                    <span class="author mb-3 d-block">Admin</span>
                                    <p class="mb-4 d-block"> {{ Str::limit(strip_tags($news->content, 100)) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-3">

                        @php
                            $sideNews = \App\Models\News::where('category_id', $row->id)->latest()->take(10)->get();
                        @endphp

                        @foreach ($sideNews as $news)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $row->name }}</span>
                                    {{-- fungsi diffForHumans() untuk menampilkan waktu dalam bentuk last hour/days --}}
                                    {{-- fungsi format ('d F Y')  menampilkan hari bulan tahun --}}
                                    <span class="mx-1">&bullet;</span>
                                    <span>{{ $news->created_at->format('d F Y') }}</span>
                                </div>
                                <h2 class="mb-2"><a href="{{ route('detailNews', $news->slug) }}">
                                        {{-- limit karakter --}}
                                        {{ Str::limit($news->title, 30) }}
                                    </a></h2>
                                <span class="author mb-3 d-block">Admin</span>
                            </div>
                        @endforeach
                    </div>
                
                </div>
            </div>
        </section>
    @endforeach
@endsection
