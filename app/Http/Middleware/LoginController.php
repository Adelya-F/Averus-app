protected function authenticated($request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('siswa.dashboard');
    }
}