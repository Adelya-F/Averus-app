@extends('layouts.app')

@section('content')

<style>
/* Container utama */
.profile-section {
    min-height: 85vh;
    background: #f0f4ff;
    padding: 50px 20px;
}

/* Grid 2 kolom */
.profile-container {
    max-width: 1000px;
    margin: auto;
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 30px;
}

/* Card kiri (avatar + info utama) */
.profile-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
}

/* Avatar bulat */
.avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
    font-size: 36px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Nama dan email */
.profile-name {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 5px;
}

.profile-email {
    font-size: 14px;
    color: #3b82f6;
    margin-bottom: 25px;
}

/* Tombol edit */
.btn-primary {
    padding: 12px 25px;
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

/* Card kanan (info tambahan) */
.info-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px 35px;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.1);
}

/* Item info */
.info-item {
    display: flex;
    justify-content: space-between;
    padding: 18px 0;
    border-bottom: 1px solid #dbeafe;
    font-size: 14px;
}

.info-item:last-child {
    border-bottom: none;
}

/* Badge status */
.badge {
    background: #3b82f6;
    color: white;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Responsive mobile */
@media (max-width: 768px) {
    .profile-container {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="profile-section">
    <div class="profile-container">

        <!-- Kiri: Avatar + Info Utama -->
        <div class="profile-card">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>

            <div class="profile-name">
                {{ auth()->user()->name }}
            </div>

            <div class="profile-email">
                {{ auth()->user()->email }}
            </div>

            <button class="btn-primary">
                Edit Profile
            </button>
        </div>

        <!-- Kanan: Info tambahan -->
        <div class="info-card">
            <h3 style="margin-bottom:20px;">Informasi Akun</h3>

            <div class="info-item">
                <span>ID User</span>
                <strong>{{ auth()->user()->id }}</strong>
            </div>

            <div class="info-item">
                <span>Bergabung Sejak</span>
                <strong>{{ auth()->user()->created_at->format('d M Y') }}</strong>
            </div>

            <div class="info-item">
                <span>Status</span>
                <span class="badge">Aktif</span>
            </div>

            <div class="info-item">
                <span>Role</span>
                <strong>{{ auth()->user()->role ?? 'User' }}</strong>
            </div>
        </div>

    </div>
</div>

@endsection