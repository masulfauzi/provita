<?php
namespace App\Modules\Akun\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Akun\Models\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Akun";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Akun::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Akun::akun', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'no_akun' => ['No Akun', html()->text("no_akun", old("no_akun"))->class("form-control") ],
			'nama_akun' => ['Nama Akun', html()->text("nama_akun", old("nama_akun"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Akun::akun_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'no_akun' => 'required',
			'nama_akun' => 'required',
			
		]);

		$akun = new Akun();
		$akun->no_akun = $request->input("no_akun");
		$akun->nama_akun = $request->input("nama_akun");
		
		$akun->created_by = Auth::id();
		$akun->save();

		$text = 'membuat '.$this->title; //' baru '.$akun->what;
		$this->log($request, $text, ['akun.id' => $akun->id]);
		return redirect()->route('akun.index')->with('message_success', 'Akun berhasil ditambahkan!');
	}

	public function show(Request $request, Akun $akun)
	{
		$data['akun'] = $akun;

		$text = 'melihat detail '.$this->title;//.' '.$akun->what;
		$this->log($request, $text, ['akun.id' => $akun->id]);
		return view('Akun::akun_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Akun $akun)
	{
		$data['akun'] = $akun;

		
		$data['forms'] = array(
			'no_akun' => ['No Akun', html()->text("no_akun", $akun->no_akun)->class("form-control") ],
			'nama_akun' => ['Nama Akun', html()->text("nama_akun", $akun->nama_akun)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$akun->what;
		$this->log($request, $text, ['akun.id' => $akun->id]);
		return view('Akun::akun_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'no_akun' => 'required',
			'nama_akun' => 'required',
			
		]);
		
		$akun = Akun::find($id);
		$akun->no_akun = $request->input("no_akun");
		$akun->nama_akun = $request->input("nama_akun");
		
		$akun->updated_by = Auth::id();
		$akun->save();


		$text = 'mengedit '.$this->title;//.' '.$akun->what;
		$this->log($request, $text, ['akun.id' => $akun->id]);
		return redirect()->route('akun.index')->with('message_success', 'Akun berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$akun = Akun::find($id);
		$akun->deleted_by = Auth::id();
		$akun->save();
		$akun->delete();

		$text = 'menghapus '.$this->title;//.' '.$akun->what;
		$this->log($request, $text, ['akun.id' => $akun->id]);
		return back()->with('message_success', 'Akun berhasil dihapus!');
	}

}
