<?php
namespace App\Modules\Sekolah\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\Jenjang\Models\Jenjang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SekolahController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Sekolah";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Sekolah::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Sekolah::sekolah', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_jenjang = Jenjang::all()->pluck('jenjang','id');
		
		$data['forms'] = array(
			'npsn' => ['Npsn', html()->text("npsn", old("npsn"))->class("form-control") ],
			'nama_sekolah' => ['Nama Sekolah', html()->text("nama_sekolah", old("nama_sekolah"))->class("form-control") ],
			'alamat' => ['Alamat', html()->text("alamat", old("alamat"))->class("form-control") ],
			'no_telp' => ['No Telp', html()->text("no_telp", old("no_telp"))->class("form-control") ],
			'id_jenjang' => ['Jenjang', html()->select("id_jenjang", $ref_jenjang, null)->class("form-control")->class("select2") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Sekolah::sekolah_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'npsn' => 'required',
			'nama_sekolah' => 'required',
			'alamat' => 'required',
			'no_telp' => 'required',
			'id_jenjang' => 'required',
			
		]);

		$sekolah = new Sekolah();
		$sekolah->npsn = $request->input("npsn");
		$sekolah->nama_sekolah = $request->input("nama_sekolah");
		$sekolah->alamat = $request->input("alamat");
		$sekolah->no_telp = $request->input("no_telp");
		$sekolah->id_jenjang = $request->input("id_jenjang");
		
		$sekolah->created_by = Auth::id();
		$sekolah->save();

		$text = 'membuat '.$this->title; //' baru '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return redirect()->route('sekolah.index')->with('message_success', 'Sekolah berhasil ditambahkan!');
	}

	public function show(Request $request, Sekolah $sekolah)
	{
		$data['sekolah'] = $sekolah;

		$text = 'melihat detail '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return view('Sekolah::sekolah_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Sekolah $sekolah)
	{
		$data['sekolah'] = $sekolah;

		$ref_jenjang = Jenjang::all()->pluck('jenjang','id');
		
		$data['forms'] = array(
			'npsn' => ['Npsn', html()->text("npsn", $sekolah->npsn)->class("form-control") ],
			'nama_sekolah' => ['Nama Sekolah', html()->text("nama_sekolah", $sekolah->nama_sekolah)->class("form-control") ],
			'alamat' => ['Alamat', html()->text("alamat", $sekolah->alamat)->class("form-control") ],
			'no_telp' => ['No Telp', html()->text("no_telp", $sekolah->no_telp)->class("form-control") ],
			'id_jenjang' => ['Jenjang', html()->select("id_jenjang", $ref_jenjang, null)->class("form-control")->class("select2") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return view('Sekolah::sekolah_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'npsn' => 'required',
			'nama_sekolah' => 'required',
			'alamat' => 'required',
			'no_telp' => 'required',
			'id_jenjang' => 'required',
			
		]);
		
		$sekolah = Sekolah::find($id);
		$sekolah->npsn = $request->input("npsn");
		$sekolah->nama_sekolah = $request->input("nama_sekolah");
		$sekolah->alamat = $request->input("alamat");
		$sekolah->no_telp = $request->input("no_telp");
		$sekolah->id_jenjang = $request->input("id_jenjang");
		
		$sekolah->updated_by = Auth::id();
		$sekolah->save();


		$text = 'mengedit '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return redirect()->route('sekolah.index')->with('message_success', 'Sekolah berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$sekolah = Sekolah::find($id);
		$sekolah->deleted_by = Auth::id();
		$sekolah->save();
		$sekolah->delete();

		$text = 'menghapus '.$this->title;//.' '.$sekolah->what;
		$this->log($request, $text, ['sekolah.id' => $sekolah->id]);
		return back()->with('message_success', 'Sekolah berhasil dihapus!');
	}

}
