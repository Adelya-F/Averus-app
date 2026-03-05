@extends('layouts.app')

@section('content')

<style>
.profile-section{
    min-height:100vh;
    background:#f4f7ff;
    padding:110px 20px 60px;
}

.profile-container{
    max-width:1100px;
    margin:auto;
    display:grid;
    grid-template-columns:320px 1fr;
    gap:30px;
}

.profile-card,
.info-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    border:1px solid rgba(0,0,0,0.05);
}

.profile-card{
    padding:35px 25px;
    text-align:center;
    position:sticky;
    top:120px;
}

.info-card{
    padding:40px;
}

.avatar-wrapper{
    position:relative;
    width:130px;
    height:130px;
    margin:auto;
    margin-bottom:20px;
}

.avatar{
    width:100%;
    height:100%;
    border-radius:50%;
    background:#2563eb;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:45px;
    overflow:hidden;
    border:4px solid #fff;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.upload-label{
    position:absolute;
    bottom:5px;
    right:5px;
    background:#2563eb;
    color:white;
    width:38px;
    height:38px;
    border-radius:50%;
    display:none;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    border:3px solid #fff;
}

.grid-form{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-bottom:10px;
}

.input-group{
    display:flex;
    flex-direction:column;
}

.input-label{
    font-size:11px;
    font-weight:700;
    color:#64748b;
    margin-bottom:8px;
    text-transform:uppercase;
}

.edit-input{
    border:1.5px solid #e2e8f0;
    border-radius:12px;
    padding:12px 16px;
    font-size:14px;
    background:#f8fafc;
    transition:0.3s;
}

.edit-input:focus{
    border-color:#2563eb;
    outline:none;
    background:#fff;
    box-shadow:0 0 0 4px rgba(37,99,235,0.1);
}

.edit-input:disabled{
    cursor:not-allowed;
    background:#f1f5f9;
    color:#94a3b8;
}

.btn-action{
    padding:12px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    border:none;
    width:100%;
    margin-top:10px;
}

.btn-edit{
    background:#64748b;
    color:white;
}

.btn-save{
    background:#2563eb;
    color:white;
    display:none;
}

.btn-logout{
    background:#fff;
    color:#ef4444;
    border:1px solid #fee2e2;
    width:100%;
    margin-top:12px;
    padding:10px;
    border-radius:12px;
    font-weight:600;
}

.role-badge{
    background:#dbeafe;
    color:#2563eb;
    padding:6px 16px;
    border-radius:20px;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
}

@media(max-width:768px){
.profile-container{
grid-template-columns:1fr;
}

.profile-card{
position:relative;
top:0;
}

.grid-form{
grid-template-columns:1fr;
}
}
</style>


<div class="profile-section">

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('patch')

<div class="profile-container">

<div class="profile-card">

<div class="avatar-wrapper">

<div class="avatar" id="avatarPreview">

@if(auth()->user()->avatar)
<img src="{{ asset('storage/avatars/'.auth()->user()->avatar) }}">
@else
{{ strtoupper(substr(auth()->user()->name,0,1)) }}
@endif

</div>

<label for="avatarInput" class="upload-label" id="uploadBtn">
📷
</label>

<input type="file" name="avatar" id="avatarInput" style="display:none" onchange="previewImage(this)">

</div>

<h2 style="font-size:20px;font-weight:700;">
{{ auth()->user()->name }}
</h2>

<p style="color:#64748b;font-size:14px;margin-bottom:20px;">
{{ auth()->user()->email }}
</p>

<div style="margin-bottom:15px;">
<span class="role-badge">
{{ auth()->user()->role }}
</span>
</div>

<button type="button" id="editBtn" class="btn-action btn-edit">
Edit Profil
</button>

<button type="submit" id="saveBtn" class="btn-action btn-save">
Simpan Perubahan
</button>

</form>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button type="submit" class="btn-logout">
Logout
</button>
</form>

</div>


<div class="info-card">

<h3 style="font-size:18px;font-weight:700;margin-bottom:25px;border-left:4px solid #2563eb;padding-left:15px;">
Informasi Personal
</h3>

<div class="grid-form">

<div class="input-group">
<label class="input-label">Nama Lengkap</label>
<input type="text" name="name" value="{{ old('name',auth()->user()->name) }}" class="edit-input" disabled>
</div>

<div class="input-group">
<label class="input-label">Email</label>
<input type="email" name="email" value="{{ old('email',auth()->user()->email) }}" class="edit-input" disabled>
</div>

@if(auth()->user()->role !== 'admin')

<div class="input-group">
<label class="input-label">WhatsApp</label>
<input type="text" name="phone" value="{{ old('phone',auth()->user()->phone) }}" class="edit-input" disabled>
</div>

<div class="input-group">
<label class="input-label">Instagram</label>
<input type="text" name="instagram" value="{{ old('instagram',auth()->user()->instagram) }}" class="edit-input" disabled>
</div>

<div class="input-group">
<label class="input-label">TikTok</label>
<input type="text" name="tiktok" value="{{ old('tiktok',auth()->user()->tiktok) }}" class="edit-input" disabled>
</div>

@endif

@if(auth()->user()->role === 'pengajar')

<div class="input-group">
<label class="input-label">Mata Pelajaran</label>
<input type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran',auth()->user()->mata_pelajaran) }}" class="edit-input" disabled>
</div>

@endif

</div>

<div class="input-group" style="margin-top:15px;">
<label class="input-label">Bio (Opsional)</label>
<textarea name="bio" rows="3" class="edit-input" disabled>{{ old('bio',auth()->user()->bio) }}</textarea>
</div>

</div>

</div>

</div>


<script>

const editBtn=document.getElementById('editBtn')
const saveBtn=document.getElementById('saveBtn')
const uploadBtn=document.getElementById('uploadBtn')
const inputs=document.querySelectorAll('.edit-input')

editBtn.onclick=function(){

inputs.forEach(input=>{
input.disabled=false
})

uploadBtn.style.display="flex"
editBtn.style.display="none"
saveBtn.style.display="block"

}

function previewImage(input){

if(input.files && input.files[0]){

var reader=new FileReader()

reader.onload=function(e){

document.getElementById('avatarPreview').innerHTML='<img src="'+e.target.result+'">'

}

reader.readAsDataURL(input.files[0])

}

}

</script>

@endsection