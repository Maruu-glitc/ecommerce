 <section class="py-3"
     style="background-image: asset('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">

                 <div class="banner-blocks">

                     <div class="banner-ad large bg-info block-1">

                         <div class="swiper main-swiper">
                             <div class="swiper-wrapper">

                                 <div class="swiper-slide">
                                     <div class="row banner-content p-5 align-items-center">
                                         <div class="content-wrapper col-md-7">
                                             <div class="categories my-3">NEW ARRIVAL</div>

                                             <h3 class="display-4 fw-bold">
                                                 Kaos Lokal Berkualitas
                                             </h3>

                                             <p>
                                                 Bahan adem, desain eksklusif, cocok untuk gaya harian dan streetwear.
                                             </p>

                                             <a href="#"
                                                 class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">
                                                 Shop Now
                                             </a>
                                         </div>

                                         <div class="img-wrapper col-md-5 text-center">
                                             <img src="{{ asset('images/IklanKaos1.jpeg') }}" class="img-fluid">
                                         </div>
                                     </div>
                                 </div>


                                 <div class="swiper-slide">
                                     <div class="row banner-content p-5 align-items-center">
                                         <div class="content-wrapper col-md-7">
                                             <div class="categories mb-3 pb-3">STREETWEAR</div>

                                             <h3 class="banner-title">
                                                 Kaos Street Style
                                             </h3>

                                             <p>
                                                 Tampil lebih percaya diri dengan desain bold dan modern.
                                             </p>

                                             <a href="#"
                                                 class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                                 Shop Collection
                                             </a>
                                         </div>

                                         <div class="img-wrapper col-md-5 text-center">
                                             <img src="{{ asset('images/IklanKaos2.jpeg') }}" class="img-fluid">
                                         </div>
                                     </div>
                                 </div>


                                 <div class="swiper-slide">
                                     <div class="row banner-content p-5 align-items-center">
                                         <div class="content-wrapper col-md-7">
                                             <div class="categories mb-3 pb-3">LIMITED OFFER</div>

                                             <h3 class="banner-title">
                                                 Koleksi Kaos Terbaru
                                             </h3>

                                             <p>
                                                 Dapatkan diskon spesial untuk koleksi pilihan minggu ini.
                                             </p>

                                             <a href="#"
                                                 class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                                 Shop Collection
                                             </a>
                                         </div>

                                         <div class="img-wrapper col-md-5 text-center">
                                             <img src="{{ asset('images/IklanKaos3.jpeg') }}" class="img-fluid">
                                         </div>
                                     </div>
                                 </div>

                             </div>

                             <div class="swiper-pagination"></div>

                         </div>
                     </div>

                     <div class="banner-ad bg-success-subtle block-2 kaos-banner">
                         <div class="row banner-content px-5 py-5 h-100 align-items-center">

                             <div class="content-wrapper col-md-7">
                                 <div class="categories sale mb-3 pb-3 text-dark">20% OFF</div>

                                 <h3 class="banner-title text-primary">
                                     Kaos Premium Lokal
                                 </h3>

                                 <p class="text-muted mb-3">
                                     Nyaman dipakai, desain kekinian, cocok untuk gaya harianmu.
                                 </p>

                                 <a href="#" class="d-flex align-items-center nav-link fw-semibold">
                                     Lihat Koleksi
                                     <svg width="24" height="24" class="ms-1">
                                         <use xlink:href="#arrow-right"></use>
                                     </svg>
                                 </a>
                             </div>

                         </div>
                     </div>



                     <div class="banner-ad bg-danger block-3"
                         style="background:url('images/ad-image-2.png') no-repeat;background-position: right bottom">
                         <div class="row banner-content p-5">

                             <div class="content-wrapper col-md-7">
                                 <div class="categories sale mb-3 pb-3">15% off</div>
                                 <h3 class="item-title">Baked Products</h3>
                                 <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg
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
     .main-swiper .content-wrapper {
         animation: slideFade .7s ease;
     }

     @keyframes slideFade {
         from {
             opacity: 0;
             transform: translateY(30px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     .kaos-banner .content-wrapper {
         animation: fadeUp .6s ease;
     }

     @keyframes fadeUp {
         from {
             opacity: 0;
             transform: translateY(20px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     .kaos-banner {
         background-image: url('images/kaos2.png');
         background-repeat: no-repeat;
         background-position: right bottom;
         /* PAS */
         background-size: contain;
         /* gambar utuh */
         min-height: 280px;
         border-radius: 20px;
         overflow: hidden;
     }

     .block-1 {
         min-height: 500px;
         /* tinggi ideal desktop */
         max-height: 590px;
         overflow: hidden;
         border-radius: 20px;
     }

     .block-1 .swiper,
     .block-1 .swiper-slide {
         height: 100%;
     }

     .block-1 .img-wrapper img {
         max-height: 300px;
         width: auto;
         object-fit: contain;
     }
 </style>
