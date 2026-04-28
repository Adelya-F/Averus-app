use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::all();
        return view('absensi.index', compact('absensis'));
    }

    public function create()
    {
        return view('absensi.create');
    }

    public function store(Request $request)
    {
        Absensi::create($request->all());
        return redirect()->route('absensi.index');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index');
    }
}