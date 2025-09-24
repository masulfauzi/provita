<?php
namespace App\Modules\JenisRekening\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JenisRekening\Models\JenisRekening;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenisRekeningController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jenis Rekening";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JenisRekening::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JenisRekening::jenisrekening', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_rekening' => ['Jenis Rekening', html()->text("jenis_rekening", old("jenis_rekening"))->class("form-control") ],
			'kode_jenis_rekening' => ['Kode Jenis Rekening', html()->text("kode_jenis_rekening", old("kode_jenis_rekening"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JenisRekening::jenisrekening_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'jenis_rekening' => 'required',
			'kode_jenis_rekening' => 'required',
			
		]);

		$jenisrekening = new JenisRekening();
		$jenisrekening->jenis_rekening = $request->input("jenis_rekening");
		$jenisrekening->kode_jenis_rekening = $request->input("kode_jenis_rekening");
		
		$jenisrekening->created_by = Auth::id();
		$jenisrekening->save();

		$text = 'membuat '.$this->title; //' baru '.$jenisrekening->what;
		$this->log($request, $text, ['jenisrekening.id' => $jenisrekening->id]);
		return redirect()->route('jenisrekening.index')->with('message_success', 'Jenis Rekening berhasil ditambahkan!');
	}

	public function show(Request $request, JenisRekening $jenisrekening)
	{
		$data['jenisrekening'] = $jenisrekening;

		$text = 'melihat detail '.$this->title;//.' '.$jenisrekening->what;
		$this->log($request, $text, ['jenisrekening.id' => $jenisrekening->id]);
		return view('JenisRekening::jenisrekening_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JenisRekening $jenisrekening)
	{
		$data['jenisrekening'] = $jenisrekening;

		
		$data['forms'] = array(
			'jenis_rekening' => ['Jenis Rekening', html()->text("jenis_rekening", $jenisrekening->jenis_rekening)->class("form-control") ],
			'kode_jenis_rekening' => ['Kode Jenis Rekening', html()->text("kode_jenis_rekening", $jenisrekening->kode_jenis_rekening)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jenisrekening->what;
		$this->log($request, $text, ['jenisrekening.id' => $jenisrekening->id]);
		return view('JenisRekening::jenisrekening_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'jenis_rekening' => 'required',
			'kode_jenis_rekening' => 'required',
			
		]);
		
		$jenisrekening = JenisRekening::find($id);
		$jenisrekening->jenis_rekening = $request->input("jenis_rekening");
		$jenisrekening->kode_jenis_rekening = $request->input("kode_jenis_rekening");
		
		$jenisrekening->updated_by = Auth::id();
		$jenisrekening->save();


		$text = 'mengedit '.$this->title;//.' '.$jenisrekening->what;
		$this->log($request, $text, ['jenisrekening.id' => $jenisrekening->id]);
		return redirect()->route('jenisrekening.index')->with('message_success', 'Jenis Rekening berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jenisrekening = JenisRekening::find($id);
		$jenisrekening->deleted_by = Auth::id();
		$jenisrekening->save();
		$jenisrekening->delete();

		$text = 'menghapus '.$this->title;//.' '.$jenisrekening->what;
		$this->log($request, $text, ['jenisrekening.id' => $jenisrekening->id]);
		return back()->with('message_success', 'Jenis Rekening berhasil dihapus!');
	}

}
