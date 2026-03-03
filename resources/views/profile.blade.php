@extends('layouts.app')

@section('content')

<style>
    .profile-wrapper {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f3f4f6;
        padding: 40px 20px;
    }

    .profile-card {
        background: white;
        width: 100%;
        max-width: 600px;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        text-align: center;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 36px;
        font-weight: bold;
        margin: 0 auto 20px;
    }

    .profile-name {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .profile-email {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .profile-info {
        text-align: left;
        margin-top: 20px;
    }

    .profile-info div {
        margin-bottom: 15px;
        padding: 12px;
        border-radius: 10px;
        background: #f9fafb;
        font-size: 14px;
    }

    .btn-edit {
        margin-top: 25px;
        padding: 10px 20px;
        border-radius: 10px;
        border: none;
        background: #4f46e5;
        color: white;
        font-weight: 500;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-edit:hover {
        background: #4338ca;
        transform: translateY(-2px);
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">

        {{-- Avatar (Huruf Pertama Nama) --}}
        <div class="profile-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="profile-name">
            {{ auth()->user()->name }}
        </div>

        <div class="profile-email">
            {{ auth()->user()->email }}
        </div>

        <div class="profile-info">
            <div><strong>ID User:</strong> {{ auth()->user()->id }}</div>
            <div><strong>Bergabung sejak:</strong> {{ auth()->user()->created_at->format('d M Y') }}</div>
            <div><strong>Status:</strong> Aktif</div>
        </div>

        <button class="btn-edit">
            Edit Profile
        </button>

    </div>
</div>

@endsection