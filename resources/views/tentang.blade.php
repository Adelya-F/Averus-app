@extends('layouts.app')

@section('content')

<section class="py-5 mt-5">
    <div class="container">
        <h1 class="fw-bold text-center mb-4">Tentang Averus</h1>

        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="fw-bold">Visi Kami</h4>
                <p class="text-muted">
                    Menjadi bimbingan belajar terpercaya yang membantu siswa 
                    meraih prestasi terbaik dan masa depan gemilang.
                </p>

                <h4 class="fw-bold mt-4">Misi Kami</h4>
                <ul class="text-muted">
                    <li>Memberikan metode belajar terstruktur</li>
                    <li>Menghadirkan tutor profesional</li>
                    <li>Menciptakan suasana belajar menyenangkan</li>
                </ul>
            </div>

            <div class="col-md-6 text-center">
                <img src="https://via.placeholder.com/400x300" 
                     class="img-fluid rounded shadow" 
                     alt="Tentang Averus">
            </div>
        </div>
    </div>
</section>

@endsection