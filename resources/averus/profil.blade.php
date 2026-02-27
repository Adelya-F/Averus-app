@extends('layouts.app')

@section('content')
<div class="averus-container">

    <div class="averus-header">
        <img src="{{ asset('images/logo.png') }}" class="averus-logo">
        <h1>AVERUS</h1>
        <p class="tagline">Bimbingan Belajar SD • SMP • SMA</p>
    </div>

    <div class="card">
        <h2>Tentang AVERUS</h2>
        <p>
            AVERUS adalah lembaga bimbingan belajar yang berkomitmen membantu
            siswa mencapai prestasi terbaik melalui metode pembelajaran efektif,
            terstruktur, dan didampingi oleh pengajar berpengalaman.
        </p>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Visi</h3>
            <p>
                Menjadi bimbingan belajar unggulan dan terpercaya dalam
                mencetak generasi berprestasi.
            </p>
        </div>

        <div class="card">
            <h3>Misi</h3>
            <ul>
                <li>Menyediakan pengajar profesional</li>
                <li>Menggunakan metode belajar efektif</li>
                <li>Meningkatkan prestasi dan kepercayaan diri siswa</li>
            </ul>
        </div>
    </div>

    <div class="card contact">
        <h3>Kontak Kami</h3>
        <p>📍 Jl. Pendidikan No.10</p>
        <p>📞 0812-3456-7890</p>
        <p>✉️ admin@averus.id</p>
    </div>

</div>
@endsection