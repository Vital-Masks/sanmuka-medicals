@extends('layouts.app')

@section('content')

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row mb-5">
            <aside class="single_sidebar_widget search_widget">
                <form action="{{ route('searchMedicine') }}" method="get">
                    <div class="input-group">
                        {{ csrf_field() }}
                        <input type="text" class="form-control" placeholder="Search Medicines" name="search" id="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="lnr lnr-magnifier"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /input-group -->
                <div class="br"></div>
            </aside>
        </div>
        <div class="row">
            @forelse($medicines as $med)
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <article class="categories_post">
                    <h4 class="bg-green-400 py-1">Brand: {{ $med->brand->name}}</h4>
                    <div class="blog_post">
                        @if($med->images->count())
                        <img src="{{ asset($med->images[0]->ImageName) }}" alt="">
                        @else
                        <img src="/img/products/no-image.png" alt="">
                        @endif
                        <div class="blog_details text-left">
                            <a href="#">
                                <h2>{{ $med->title}}</h2>
                            </a>
                            <p class="mt-2 h-36 text-ellipsis overflow-hidden ">
                                {{ $med->description}}
                            </p>
                            <ul class="mt-2">
                                <li>Category: {{ $med->category->name}}</li>
                                <li>Disease: {{ $med->disease}}</li>
                                <li>Dosage: {{ $med->dosage}}</li>
                                <li>Age category: {{ $med->age}}</li>
                            </ul>

                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="container text-center">
                <p class="text-center billing-alert text-danger m-0">No items found!.</p>
                <a class="button button-blog mt-2" href="{{ route('medicines') }}">Go back</a>
            </div>
            @endforelse
        </div>


    </div>
    <nav class="blog-pagination justify-content-center d-flex mt-5">
        {{-- {{ $medicines->links() }} --}}
        {{ $medicines->appends(request()->input())->links() }}
    </nav>
</section>
<!--================Blog Categorie Area =================-->


@endsection