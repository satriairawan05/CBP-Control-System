@extends('layout.app')

@section('app')
    <!-- about section start -->
    <div class="about_section layout_padding" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="about_taital">About Softwares</h1>
                    <p class="about_text">We make software according to client needs and develop the system regularly</p>
                    {{-- <div class="read_bt"><a href="#">Read More</a></div> --}}
                </div>
                <div class="col-md-6">
                    <div><img src="{{ asset('asset_landing/images/img-1.png') }}" class="image_1"></div>
                </div>
            </div>
        </div>
    </div>
    <!--about section end -->
    <!--software section start -->
    <div class="software_section layout_padding" id="softwares">
        <div class="container">
            <h1 class="software_taital">Our Software</h1>
            <p class="software_text">We have made various information systems</p>
            <div class="software_section_2 layout_padding">
                <div class="owl-carousel">
                    <div>
                        <img src="{{ asset('img/portofolio/Skripsi-SIG-UMKM-Laundry.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Geografis UMKM Laundry Berbasis Web</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/UMKM-Tailor.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Geografis UMKM Menjahit Berbasis Web</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/UMKM-Kerajinan-Tangan.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Geografis UMKM Kerajinan Tangan Berbasis Web</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/UMKM-Barbershop.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Geografis UMKM Barbershop Berbasis Web</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/Minutes-of-Meeting-PT-BANGUN-SEMERU-SEJAHTERA.png') }}" class="image_6">
                        <h4 class="ipsum_text">Minutes of Meeting PT. BSS</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/InOffice-PT-BANGUN-SEMERU-SEJAHTERA.png') }}" class="image_6">
                        <h4 class="ipsum_text">InOffice PT. BSS</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/SIP-SC.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Surat Cuti PT. Coalindo Adhi Perkasa Berbasis Website</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/BSS-Dashboard.png') }}" class="image_6">
                        <h4 class="ipsum_text">Dashboard PT. BSS</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/SIP-SK.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Surat Keputusan Politeknik Pertanian Negeri Samarinda Berbasis Website</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/ARMS.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Archive Record Management System Dinas Perhubungan Kota Samarinda</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/AKG-SOP.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Arsip Surat PT. Alam Karya Gemilang Berbasis Website</h4>
                    </div>
                    <div>
                        <img src="{{ asset('img/portofolio/Surat-Prodi.png') }}" class="image_6">
                        <h4 class="ipsum_text text-dark">Sistem Informasi Surat Kemahasiswaan Politeknik Pertanian Negeri Samarinda Berbasis Website</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--software section end -->
    <!--services section start -->
    <div class="services_section layout_padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="services_taital">What We Do </h1>
                    <div class="image_2"><img src="{{ asset('asset_landing/images/img-2.png') }}"></div>
                </div>
                <div class="col-md-6">
                    <div class="box_main">
                        <h1 class="technology_text">Analysist</h1>
                        <p class="dummy_text">At this stage we analyze what kind of client needs and there will be many sessions such as interviews and observations</p>
                    </div>
                    {{-- <div class="readmore_bt"><a href="#">Read More</a></div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="image_2"><img src="{{ asset('asset_landing/images/img-3.png') }}"></div>
                </div>
                <div class="col-md-6">
                    <div class="box_main">
                        <h1 class="technology_text">Interview or Observed</h1>
                        <p class="dummy_text">At this stage we interview the client directly to understand what features will be created</p>
                    </div>
                    {{-- <div class="readmore_bt"><a href="#">Read More</a></div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="image_2"><img src="{{ asset('asset_landing/images/img-5.png') }}"></div>
                </div>
                <div class="col-md-6">
                    <div class="box_main">
                        <h1 class="technology_text">Development & Coding</h1>
                        <p class="dummy_text">At this stage we start making programs and clients just wait to hear from us</p>
                    </div>
                    {{-- <div class="readmore_bt"><a href="#">Read More</a></div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="image_2"><img src="{{ asset('asset_landing/images/img-4.png') }}"></div>
                </div>
                <div class="col-md-6">
                    <div class="box_main">
                        <h1 class="technology_text">Testing or Documented</h1>
                        <p class="dummy_text">At this stage we test the system independently, after that the client tests the system we make</p>
                    </div>
                    {{-- <div class="readmore_bt"><a href="#">Read More</a></div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--services section end -->
    <!--works section start -->
    <div class="works_section layout_padding" id="works">
        <div class="container">
            <h1 class="work_taital">How It Works</h1>
            <div class="works_section_2 layout_padding">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="fully_text">Analysist</h3>
                        <p class="lorem_text">We analyze the system according to client requirements</p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="fully_text">Development</h3>
                        <p class="lorem_text">We develop the system regularly and continuously</p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="fully_text">Testing or Documented</h3>
                        <p class="lorem_text">We test the system that has been created and document it according to existing needs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--works section end -->
    <!--company trusted section start -->
    <div class="works_section layout_padding" id="trusted">
        <div class="container">
            <h1 class="work_taital">Trusted by campanies</h1>
            <div class="works_section_2 layout_padding">
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/Politani.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Politeknik Pertanian Negeri Samarinda</h3>
                        <p class="lorem_text"><a
                                href="https://politanisamarinda.ac.id/" class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/PemkotSmd.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Pemerintah Kota Samarinda</h3>
                        <p class="lorem_text"><a href="https://samarindakota.go.id/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/Pusnas.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Dinas Perpustakaan dan Kearsipan Kota Samarinda</h3>
                        <p class="lorem_text"><a href="https://perpustakaankearsipan.samarindakota.go.id/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/RRI.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Radio Republik Indonesia</h3>
                        <p class="lorem_text"><a href="https://www.rri.co.id/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/Suemerugrup.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Suemeru Group</h3>
                        <p class="lorem_text"><a href="https://bss.id/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/Coalindo.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Coalindo Group</h3>
                        <p class="lorem_text"><a
                                href="https://www.coalindo-group.com/id"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/Dishub.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Dinas Perhubungan Kota Samarinda</h3>
                        <p class="lorem_text"><a
                                href="https://dishub.samarindakota.go.id/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a></p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('img/companies/AlamKaryaGemilang.png') }}" alt="logo instansi"
                                class="img-fluid img-fixed-size mb-2">
                        </div>
                        <h3 class="fully_text">Alam Karya Gemilang</h3>
                        <p class="lorem_text"><a href="https://alamkaryagemilang.com/"class="btn btn-sm btn-dark" target="__blank">Go To Website</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--company trusted section end -->
    <!--contact section start -->
    {{-- <div class="contact_section layout_padding" id="contact">
        <div class="container">
            <h1 class="work_taital">Get In Touch</h1>
        </div>
    </div>
    <div class="contact_section_2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 padding_0">
                    <div><img src="{{ asset('asset_landing/images/img-10.png') }}" class="image_10"></div>
                </div>
                <div class="col-md-6">
                    <div class="email_text">
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="email-bt" placeholder="Phone Numbar" name="phone">
                        </div>
                        <div class="form-group">
                            <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="massage"></textarea>
                        </div>
                        <div class="btn">
                            <button type="submit" class="btn btn-dark text-white">SEND</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--contact section end -->
@endsection
