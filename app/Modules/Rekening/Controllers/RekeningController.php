<?php
namespace App\Modules\Rekening\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Rekening\Models\Rekening;
use App\Modules\Nasabah\Models\Nasabah;
use App\Modules\JenisRekening\Models\JenisRekening;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Rekening";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Rekening::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Rekening::rekening', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_nasabah = Nasabah::all()->pluck('nama_nasabah','id');
		$ref_jenis_rekening = JenisRekening::all()->pluck('jenis_rekening','id');
		
		$data['forms'] = array(
			'no_rekening' => ['No Rekening', html()->text("no_rekening", old("no_rekening"))->class("form-control") ],
			'id_nasabah' => ['Nasabah', html()->select("id_nasabah", $ref_nasabah, null)->class("form-control")->class("select2") ],
			'id_jenis_rekening' => ['Jenis Rekening', html()->select("id_jenis_rekening", $ref_jenis_rekening, null)->class("form-control")->class("select2") ],
			'is_utama' => ['Is Utama', html()->text("is_utama", old("is_utama"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Rekening::rekening_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'no_rekening' => 'required',
			'id_nasabah' => 'required',
			'id_jenis_rekening' => 'required',
			'is_utama' => 'required',
			
		]);

		$rekening = new Rekening();
		$rekening->no_rekening = $request->input("no_rekening");
		$rekening->id_nasabah = $request->input("id_nasabah");
		$rekening->id_jenis_rekening = $request->input("id_jenis_rekening");
		$rekening->is_utama = $request->input("is_utama");
		
		$rekening->created_by = Auth::id();
		$rekening->save();

		$text = 'membuat '.$this->title; //' baru '.$rekening->what;
		$this->log($request, $text, ['rekening.id' => $rekening->id]);
		return redirect()->route('rekening.index')->with('message_success', 'Rekening berhasil ditambahkan!');
	}

	public function show(Request $request, Rekening $rekening)
	{
		$data['rekening'] = $rekening;

		$text = 'melihat detail '.$this->title;//.' '.$rekening->what;
		$this->log($request, $text, ['rekening.id' => $rekening->id]);
		return view('Rekening::rekening_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Rekening $rekening)
	{
		$data['rekening'] = $rekening;

		$ref_nasabah = Nasabah::all()->pluck('nama_nasabah','id');
		$ref_jenis_rekening = JenisRekening::all()->pluck('jenis_rekening','id');
		
		$data['forms'] = array(
			'no_rekening' => ['No Rekening', html()->text("no_rekening", $rekening->no_rekening)->class("form-control") ],
			'id_nasabah' => ['Nasabah', html()->select("id_nasabah", $ref_nasabah, null)->class("form-control")->class("select2") ],
			'id_jenis_rekening' => ['Jenis Rekening', html()->select("id_jenis_rekening", $ref_jenis_rekening, null)->class("form-control")->class("select2") ],
			'is_utama' => ['Is Utama', html()->text("is_utama", $rekening->is_utama)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$rekening->what;
		$this->log($request, $text, ['rekening.id' => $rekening->id]);
		return view('Rekening::rekening_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'no_rekening' => 'required',
			'id_nasabah' => 'required',
			'id_jenis_rekening' => 'required',
			'is_utama' => 'required',
			
		]);
		
		$rekening = Rekening::find($id);
		$rekening->no_rekening = $request->input("no_rekening");
		$rekening->id_nasabah = $request->input("id_nasabah");
		$rekening->id_jenis_rekening = $request->input("id_jenis_rekening");
		$rekening->is_utama = $request->input("is_utama");
		
		$rekening->updated_by = Auth::id();
		$rekening->save();


		$text = 'mengedit '.$this->title;//.' '.$rekening->what;
		$this->log($request, $text, ['rekening.id' => $rekening->id]);
		return redirect()->route('rekening.index')->with('message_success', 'Rekening berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$rekening = Rekening::find($id);
		$rekening->deleted_by = Auth::id();
		$rekening->save();
		$rekening->delete();

		$text = 'menghapus '.$this->title;//.' '.$rekening->what;
		$this->log($request, $text, ['rekening.id' => $rekening->id]);
		return back()->with('message_success', 'Rekening berhasil dihapus!');
	}

}
