<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<section class="py-3"
    style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="banner-blocks">

                    <div class="banner-ad large bg-info block-1">

                        <div class="swiper main-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories my-3 text-dark">100% premium,</div>
                                            <h3 class="display-4 text-primary">Kaos Distro Premium</h3>
                                            <p>Desain eksklusif, bahan adem, nyaman dipakai harian.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Beli
                                                Sekarang</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="{{ asset('images/produk-kaos.png') }}" class="img-fluid"
                                                width="400" alt="banner" id="kaos1">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">New Arrival</div>
                                            <h3 class="banner-title">Koleksi Kaos Tebaru</h3>
                                            <p>Gaya streetwear modern untuk tampilan lebih percaya diri.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Koleksi Toko</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="{{ asset('images/kaos2.png') }}" class="img-fluid" width="400"
                                                alt="banner" id="kaos1">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">Limited edition</div>
                                            <h3 class="banner-title">Kaos Wanita Stylish</h3>
                                            <p>Nyaman, fashionable, cocok untuk aktivitas sehari-hari.</p>
                                            <a href="#"
                                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Koleksi Toko</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="{{ asset('images/girlsKaos.png') }}"
                                                class="img-fluid me-4 rounded-2" width="300" alt="banner"
                                                id="kaos1" style="margin-right: 10em;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="swiper-pagination"></div> --}}


                        </div>
                    </div>

                    <div class="banner-ad bg-success-subtle block-2"
                        style="background:url('images/kaosPanjang.png') no-repeat;background-position: right bottom; background-size: contain">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">20% off</div>
                                <h3 class="banner-title">Kaos Distro Lengan Panjang Terbaru</h3>
                                <a href="#" class="d-flex align-items-center nav-link">Koleksi Toko <svg
                                        width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>

                    <div class="banner-ad bg-danger block-3"
                        style="background:url('images/kaosBoy.png') no-repeat;background-position: right bottom ; background-size: contain">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">15% off</div>
                                <h3 class="item-title">Kaos Street Style </h3>
                                <a href="#" class="d-flex align-items-center nav-link">Koleksi Toko <svg
                                        width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- / Banner Blocks -->

            </div>
        </div>
    </div>
</section>
<style>
    .main-swiper {
        position: relative;
    }

    .main-swiper .swiper-pagination {
        position: absolute;
        bottom: 50px;
        /* jarak dari bawah banner */
        left: 0;
        right: 0;
        text-align: center;
    }

    .main-swiper .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        opacity: 0.4;
    }

    .main-swiper .swiper-pagination-bullet-active {
        opacity: 1;
        transform: scale(1.2);
    }

    .main-swiper .swiper-slide {
        width: 100% !important;
    }

    .swiper-pagination {
        z-index: 10;
    }


    #kaos1 {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;
        bottom: 40 !important;
        margin: auto !important;

    }

    #kaos1 {
        z-index: -1 !important;
    }

    .banner-content {
        position: relative;
        z-index: 1;
    }
    
</style>

<script>
    const swiper = new Swiper('.main-swiper', {
        slidesPerView: 1,
        loop: true,
        loopedSlides: 3,

        observer: true,
        observeParents: true,
        observeSlideChildren: true,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },

        pagination: {
            el: '.main-swiper .swiper-pagination',
            clickable: true,
        },

        speed: 800,
    });
</script>
