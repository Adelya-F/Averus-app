@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="text-white text-center d-flex align-items-center"
    style="height:100vh; background: linear-gradient(135deg,#1e3c72,#2a5298);">
    <div class="container">
        <h1 class="display-3 fw-bold">
            Bimbingan Belajar Terpercaya untuk Prestasi Terbaik
        </h1>
        <p class="lead mt-3">
            Metode belajar terstruktur, efektif, dan menyenangkan bersama Averus.
        </p>
        <a href="#program" class="btn btn-warning btn-lg mt-4 px-4">
            Lihat Program
        </a>
        <a href="#kontak" class="btn btn-outline-light btn-lg mt-4 ms-2 px-4">
            Daftar Sekarang
        </a>
    </div>
</section>

<!-- STATISTIK -->
<section class="py-5 bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="fw-bold text-primary">100+</h2>
                <p>Siswa Aktif</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold text-primary">20+</h2>
                <p>Tutor Profesional</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold text-primary">95%</h2>
                <p>Tingkat Kelulusan</p>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Kenapa Memilih Averus?</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow h-100 p-4">
                    <h5 class="fw-bold">Metode Terstruktur</h5>
                    <p class="text-muted">
                        Sistem pembelajaran bertahap sesuai kemampuan siswa.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow h-100 p-4">
                    <h5 class="fw-bold">Tutor Berpengalaman</h5>
                    <p class="text-muted">
                        Dibimbing oleh pengajar profesional dan sabar.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow h-100 p-4">
                    <h5 class="fw-bold">Belajar Menyenangkan</h5>
                    <p class="text-muted">
                        Suasana belajar nyaman dan interaktif.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM -->
<section id="program" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Program Unggulan</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">Matematika</h5>
                        <p class="text-muted">Penguatan konsep dan latihan intensif.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">Bahasa Inggris</h5>
                        <p class="text-muted">Speaking, grammar, dan reading.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">IPA</h5>
                        <p class="text-muted">Pendalaman materi sains.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <!-- Kiri (Text) -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Tentang Averus</h2>
                <p class="text-muted">
                    Averus adalah bimbingan belajar yang berkomitmen membantu siswa 
                    meningkatkan prestasi akademik melalui metode belajar terstruktur 
                    dan efektif.
                </p>

                <p class="text-muted">
                    Dengan tutor berpengalaman dan sistem pembelajaran bertahap, 
                    kami membantu siswa memahami konsep secara mendalam, bukan 
                    sekadar menghafal.
                </p>

                <a href="#program" class="btn btn-primary mt-3 px-4">
                    Lihat Program Kami
                </a>
            </div>

        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section id="testimoni" class="py-5 bg-light">
    <div class="container text-center">

        <h2 class="fw-bold mb-5">Apa Kata Siswa Kami?</h2>

        <div class="row">

            <!-- Testimoni 1 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <div class="mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-muted">
                        "Sejak bergabung di Averus, nilai matematika saya naik dan 
                        saya jadi lebih percaya diri menghadapi ujian."
                    </p>
                    <h6 class="fw-bold mt-3">Rina - Kelas 10</h6>
                </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <div class="mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-muted">
                        "Metode belajarnya mudah dipahami dan tutor sangat sabar 
                        menjelaskan sampai saya benar-benar mengerti."
                    </p>
                    <h6 class="fw-bold mt-3">Andi - Kelas 9</h6>
                </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <div class="mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-muted">
                        "Belajar di Averus membuat saya lebih disiplin dan 
                        siap menghadapi ujian sekolah."
                    </p>
                    <h6 class="fw-bold mt-3">Salsa - Kelas 11</h6>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- CTA -->
<section id="kontak" class="py-5 text-center text-white"
    style="background: linear-gradient(135deg,#2a5298,#1e3c72);">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Meningkatkan Prestasi?</h2>
        <p>Daftarkan diri sekarang dan raih masa depan gemilang bersama Averus.</p>
        <a href="#" class="btn btn-warning btn-lg mt-3 px-4">
            Daftar Sekarang
        </a>
    </div>
</section>

@endsection