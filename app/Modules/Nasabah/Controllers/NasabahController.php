<?php
namespace App\Modules\Nasabah\Controllers;

use App\Modules\Rekening\Models\Rekening;
use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Nasabah\Models\Nasabah;
use App\Modules\JenisKelamin\Models\JenisKelamin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Nasabah";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Nasabah::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Nasabah::nasabah', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_jenis_kelamin = JenisKelamin::all()->pluck('jenis_kelamin','id');
		
		$data['forms'] = array(
			'nama_nasabah' => ['Nama Nasabah', html()->text("nama_nasabah", old("nama_nasabah"))->class("form-control") ],
			'no_hp' => ['No Hp', html()->text("no_hp", old("no_hp"))->class("form-control") ],
			'nik' => ['Nik', html()->text("nik", old("nik"))->class("form-control") ],
			'alamat' => ['Alamat', html()->text("alamat", old("alamat"))->class("form-control") ],
			'email' => ['Email', html()->text("email", old("email"))->class("form-control") ],
			'tgl_lahir' => ['Tgl Lahir', html()->text("tgl_lahir", old("tgl_lahir"))->class("form-control") ],
			'id_jenis_kelamin' => ['Jenis Kelamin', html()->select("id_jenis_kelamin", $ref_jenis_kelamin, null)->class("form-control")->class("select2") ],
			'tgl_daftar' => ['Tgl Daftar', html()->text("tgl_daftar", old("tgl_daftar"))->class("form-control") ],
			'is_aktif' => ['Is Aktif', html()->text("is_aktif", old("is_aktif"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Nasabah::nasabah_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'nama_nasabah' => 'required',
			'no_hp' => 'required',
			'nik' => 'required',
			'alamat' => 'required',
			'email' => 'required',
			'tgl_lahir' => 'required',
			'id_jenis_kelamin' => 'required',
			'tgl_daftar' => 'required',
			'is_aktif' => 'required',
			
		]);

		$nasabah = new Nasabah();
		$nasabah->nama_nasabah = $request->input("nama_nasabah");
		$nasabah->no_hp = $request->input("no_hp");
		$nasabah->nik = $request->input("nik");
		$nasabah->alamat = $request->input("alamat");
		$nasabah->email = $request->input("email");
		$nasabah->tgl_lahir = $request->input("tgl_lahir");
		$nasabah->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$nasabah->tgl_daftar = $request->input("tgl_daftar");
		$nasabah->is_aktif = $request->input("is_aktif");
		
		$nasabah->created_by = Auth::id();
		$nasabah->save();

		$text = 'membuat '.$this->title; //' baru '.$nasabah->what;
		$this->log($request, $text, ['nasabah.id' => $nasabah->id]);
		return redirect()->route('nasabah.index')->with('message_success', 'Nasabah berhasil ditambahkan!');
	}

	public function show(Request $request, Nasabah $nasabah)
	{
		$data['nasabah'] = $nasabah;
		$data['rekening'] = Rekening::whereIdNasabah($nasabah->id)->get();

		$text = 'melihat detail '.$this->title;//.' '.$nasabah->what;
		$this->log($request, $text, ['nasabah.id' => $nasabah->id]);
		return view('Nasabah::nasabah_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Nasabah $nasabah)
	{
		$data['nasabah'] = $nasabah;

		$ref_jenis_kelamin = JenisKelamin::all()->pluck('jenis_kelamin','id');
		
		$data['forms'] = array(
			'nama_nasabah' => ['Nama Nasabah', html()->text("nama_nasabah", $nasabah->nama_nasabah)->class("form-control") ],
			'no_hp' => ['No Hp', html()->text("no_hp", $nasabah->no_hp)->class("form-control") ],
			'nik' => ['Nik', html()->text("nik", $nasabah->nik)->class("form-control") ],
			'alamat' => ['Alamat', html()->text("alamat", $nasabah->alamat)->class("form-control") ],
			'email' => ['Email', html()->text("email", $nasabah->email)->class("form-control") ],
			'tgl_lahir' => ['Tgl Lahir', html()->text("tgl_lahir", $nasabah->tgl_lahir)->class("form-control") ],
			'id_jenis_kelamin' => ['Jenis Kelamin', html()->select("id_jenis_kelamin", $ref_jenis_kelamin, null)->class("form-control")->class("select2") ],
			'tgl_daftar' => ['Tgl Daftar', html()->text("tgl_daftar", $nasabah->tgl_daftar)->class("form-control") ],
			'is_aktif' => ['Is Aktif', html()->text("is_aktif", $nasabah->is_aktif)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$nasabah->what;
		$this->log($request, $text, ['nasabah.id' => $nasabah->id]);
		return view('Nasabah::nasabah_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'nama_nasabah' => 'required',
			'no_hp' => 'required',
			'nik' => 'required',
			'alamat' => 'required',
			'email' => 'required',
			'tgl_lahir' => 'required',
			'id_jenis_kelamin' => 'required',
			'tgl_daftar' => 'required',
			'is_aktif' => 'required',
			
		]);
		
		$nasabah = Nasabah::find($id);
		$nasabah->nama_nasabah = $request->input("nama_nasabah");
		$nasabah->no_hp = $request->input("no_hp");
		$nasabah->nik = $request->input("nik");
		$nasabah->alamat = $request->input("alamat");
		$nasabah->email = $request->input("email");
		$nasabah->tgl_lahir = $request->input("tgl_lahir");
		$nasabah->id_jenis_kelamin = $request->input("id_jenis_kelamin");
		$nasabah->tgl_daftar = $request->input("tgl_daftar");
		$nasabah->is_aktif = $request->input("is_aktif");
		
		$nasabah->updated_by = Auth::id();
		$nasabah->save();


		$text = 'mengedit '.$this->title;//.' '.$nasabah->what;
		$this->log($request, $text, ['nasabah.id' => $nasabah->id]);
		return redirect()->route('nasabah.index')->with('message_success', 'Nasabah berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$nasabah = Nasabah::find($id);
		$nasabah->deleted_by = Auth::id();
		$nasabah->save();
		$nasabah->delete();

		$text = 'menghapus '.$this->title;//.' '.$nasabah->what;
		$this->log($request, $text, ['nasabah.id' => $nasabah->id]);
		return back()->with('message_success', 'Nasabah berhasil dihapus!');
	}

}
