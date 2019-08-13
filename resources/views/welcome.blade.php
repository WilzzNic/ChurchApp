@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-default py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 mt-6">
                    <h1 class="text-white">SELAMAT DATANG DI GBI RUMAH PERSEMBAHAN!</h1>
                    <blockquote class="blockquote">
                        <p class="text-white mb-1">Mempersiapkan umat yang layak bagi Raja Kemuliaan.</p>
                        <p class="text-white mb-1">(Prepare the way for the King of glory)</p>
                        <footer class="blockquote-footer"><cite title="Source Title">Yesaya 40:3, Mazmur 24:7 dan Lukas
                                1:16-17.</cite></footer>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <div id="indicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#indicators" data-slide-to="0" class="active"></li>
                            <li data-target="#indicators" data-slide-to="1"></li>
                            <li data-target="#indicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img') }}/mission-ben.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>MISI KAMI</h5>
                                    <blockquote class="blockquote">
                                        <p class="text-white mb-0">Melayani dengan pola ibadah pemulihan pondok Daud
                                            yaitu doa, pujian dan penyembahan dalam unity dan keintiman.</p>
                                        <footer class="blockquote-footer"><cite title="Source Title">Kisah Para Rasul
                                                15:16-17 dan I Tawarikh 23:30.</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img') }}/bible-ben.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <blockquote class="blockquote">
                                        <h3 class="text-default mb-0"><b>Seek the kingdom of God above all else, and
                                                live righteously, and he will give you everything you need.</b></h3>
                                        <footer class="blockquote-footer"><cite title="Source Title">Matthew 6:33</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img') }}/bible-photo.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <blockquote class="blockquote">
                                        <p class="text-white mb-0">Our lives begin to end the day we become silent about things that matter.</p>
                                        <footer class="blockquote-footer"><cite title="Source Title">Martin Luther King Jr.</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#indicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#indicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>

<div class="container mt--10 pb-5">
    <div class="row">
        <div class="col">
            <h1 class="text-white"><b>Kami Menyambutmu!</b></h1>
            <p class="text-white">Jika Anda ingin tahu lebih mengenai Tuhan Yesus dan belum bergabung dengan gereja lokal mana pun dan Anda ingin memiliki komunitas yang kuat dan peduli untuk mendapat dukungan, kami mengundang Anda untuk memulai perjalanan di sini.</p>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .carousel-item {
        height: 300px;
        overflow: hidden;
        width: 100%;
    }

    .carousel-item img {
        width: 100%;
    }
</style>

@endpush