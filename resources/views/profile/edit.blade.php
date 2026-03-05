@extends('layouts.app')

@section('content')

<style>
.profile-section{
    min-height:85vh;
    background:#f0f4ff;
    padding:50px 20px;
}

.profile-container{
    max-width:1000px;
    margin:auto;
    display:grid;
    grid-template-columns:320px 1fr;
    gap:30px;
}

.profile-card{
    background:#fff;
    border-radius:20px;
    padding:40px 30px;
    text-align:center;
    box-shadow:0 20px 40px rgba(37,99,235,0.15);
}

.avatar{
    width:110px;
    height:110px;
    border-radius:50%;
    margin:0 auto 20px;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;
    font-size:36px;
    font-weight:bold;
    display:flex;
    align-items:center;
    justify-content:center;
}

.profile-name{
    font-size:22px;
    font-weight:600;
}

.profile-email{
    font-size:14px;
    color:#3b82f6;
    margin-bottom:15px;
}

.profile-bio{
    font-size:14px;
    color:#64748b;
    margin-bottom:25px;
    font-style:italic;
}

.btn-primary{
    padding:12px 25px;
    border:none;
    border-radius:10px;
    background:#2563eb;
    color:white;
    font-weight:600;
    cursor:pointer;
}

.btn-logout{
    padding:12px 25px;
    border:1px solid #ef4444;
    border-radius:10px;
    background:transparent;
    color:#ef4444;
    font-weight:600;
    cursor:pointer;
}

.info-card{
    background:#fff;
    border-radius:20px;
    padding:30px 35px;
    box-shadow:0 20px 40px rgba(37,99,235,0.1);
}

.info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 0;
    border-bottom:1px solid #dbeafe;
    font-size:14px;
}

.edit-input{
    border:1px solid #dbeafe;
    border-radius:5px;
    padding:5px 10px;
    font-size:14px;
    width:60%;
}

.bottom-action{
    margin-top:25px;
    text-align:right;
}

@media(max-width:768px){
    .profile-container{
        grid-template-columns:1fr;
    }
}
</style>

<div class="profile-section">
<div class="profile-container">

<!-- CARD KIRI -->
<div class="profile-card">

<div class="avatar">
{{ strtoupper(substr(auth()->user()->name,0,1)) }}
</div>

<div class="profile-name">{{ auth()->user()->name }}</div>
<div class="profile-email">{{ auth()->user()->email }}</div>

<div class="profile-bio">
{{ auth()->user()->bio ?? 'Belum ada bio. Klik edit untuk menambahkan.' }}
</div>

<!-- LOGOUT -->
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" class="btn-logout">
Log Out
</button>
</form>

</div>

<!-- CARD KANAN -->
<div class="info-card">

<h3 style="margin-bottom:20px;">Informasi Akun</h3>

<form id="profileForm" action="{{ route('profile.update') }}" method="POST">
@csrf
@method('patch')

<div class="info-item">
<span>Nama Lengkap</span>
<input type="text" name="name" class="edit-input" value="{{ auth()->user()->name }}" disabled>
</div>

<div class="info-item">
<span>Email</span>
<input type="email" name="email" class="edit-input" value="{{ auth()->user()->email }}" disabled>
</div>

<div class="info-item">
<span>Bio</span>
<textarea name="bio" class="edit-input" rows="2" disabled>{{ auth()->user()->bio }}</textarea>
</div>

<div class="info-item">
<span>Bergabung Sejak</span>
<strong>{{ auth()->user()->created_at->format('d M Y') }}</strong>
</div>

<div class="info-item">
<span>Role</span>
<span style="background:#2563eb;color:white;padding:4px 12px;border-radius:15px;">
{{ auth()->user()->role ?? 'User' }}
</span>
</div>

<div class="bottom-action">

<button type="button" id="editBtn" class="btn-primary">
Edit Profile
</button>

<button type="submit" id="saveBtn" class="btn-primary" style="display:none;">
Simpan Perubahan
</button>

</div>

</form>

</div>

</div>
</div>

<script>

const editBtn = document.getElementById('editBtn');
const saveBtn = document.getElementById('saveBtn');
const inputs = document.querySelectorAll('.edit-input');

editBtn.onclick = function(){

inputs.forEach(input=>{
input.disabled = false;
});

editBtn.style.display = "none";
saveBtn.style.display = "inline-block";

}

</script>

@endsection