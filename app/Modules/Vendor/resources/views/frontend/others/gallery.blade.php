@extends('layouts.vendor.master')

@section('title')
    @lang('lang.gallery')
@endsection

@section('breadcrumb')
    @lang('lang.gallery')
@endsection
@push('styles')
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class="page-gallery pb-5 py-5">
        <div class="container">
            <section class="sc-gallery px-3 overflow-hidden">
                <div class="gallery-content">
                    <div class="gallery-cards row">
                        @forelse ($gallery as $item)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="gallery-card h-100">
                                    <div class="gallery-card-img">
                                        <img src="{{ $item->image ?? asset('frontendfiles/assets/images/gallery-img-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-card-footer mt-3">
                                        <span
                                            class="d-block text-xs text-silver">{{ !is_null($item->created_at) ? $item->created_at->format('DS M Y') : '14th December 2021' }}
                                        </span>
                                        <h2 class="text-xl fw-6">{{ $item->title ?? '' }} </h2>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </section>
            <!-- gallery view modal -->
            {{-- <div class="gallery-modal">
                <div class="container">
                    <div class="gallery-modal-content text-white position-relative">
                        <button type="button" class="gallery-modal-close-btn text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="gallery-modal-header mb-3">
                            <span class="d-block text-xs text-silver">14th December 2021</span>
                            <h2 class="text-xl fw-6">NADA Car Event </h2>
                        </div>
                        <div class="gallery-modal-body">
                            <div class="img-preview">
                                <img src="{{ asset('frontendfiles/assets/images/gallery-img-3.png') }}" alt="">
                            </div>
                            <div class="img-thumbnails-temp">
                                <div class="img-thumbnails d-flex align-items-center justify-content-center">
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-1.png') }}" alt="">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-2.png') }}" alt="">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-3.png') }}" alt="">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-4.png') }}" alt="">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-5.png') }}" alt="">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img src="{{ asset('frontendfiles/assets/images/gallery-img-6.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end of gallery view modal -->
        </div>
    </main>


    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
@endpush
