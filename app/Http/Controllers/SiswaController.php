namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        return view('siswa.dashboard', compact('user'));
    }
}