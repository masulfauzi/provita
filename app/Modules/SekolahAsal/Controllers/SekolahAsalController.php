<?php
namespace App\Modules\SekolahAsal\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\SekolahAsal\Models\SekolahAsal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SekolahAsalController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Sekolah Asal";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = SekolahAsal::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('SekolahAsal::sekolahasal', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'sekolah' => ['Sekolah', html()->text("sekolah", old("sekolah"))->class("form-control") ],
			'npsn' => ['Npsn', html()->text("npsn", old("npsn"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('SekolahAsal::sekolahasal_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'sekolah' => 'required',
			'npsn' => 'required',
			
		]);

		$sekolahasal = new SekolahAsal();
		$sekolahasal->sekolah = $request->input("sekolah");
		$sekolahasal->npsn = $request->input("npsn");
		
		$sekolahasal->created_by = Auth::id();
		$sekolahasal->save();

		$text = 'membuat '.$this->title; //' baru '.$sekolahasal->what;
		$this->log($request, $text, ['sekolahasal.id' => $sekolahasal->id]);
		return redirect()->route('sekolahasal.index')->with('message_success', 'Sekolah Asal berhasil ditambahkan!');
	}

	public function show(Request $request, SekolahAsal $sekolahasal)
	{
		$data['sekolahasal'] = $sekolahasal;

		$text = 'melihat detail '.$this->title;//.' '.$sekolahasal->what;
		$this->log($request, $text, ['sekolahasal.id' => $sekolahasal->id]);
		return view('SekolahAsal::sekolahasal_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, SekolahAsal $sekolahasal)
	{
		$data['sekolahasal'] = $sekolahasal;

		
		$data['forms'] = array(
			'sekolah' => ['Sekolah', html()->text("sekolah", $sekolahasal->sekolah)->class("form-control") ],
			'npsn' => ['Npsn', html()->text("npsn", $sekolahasal->npsn)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$sekolahasal->what;
		$this->log($request, $text, ['sekolahasal.id' => $sekolahasal->id]);
		return view('SekolahAsal::sekolahasal_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'sekolah' => 'required',
			'npsn' => 'required',
			
		]);
		
		$sekolahasal = SekolahAsal::find($id);
		$sekolahasal->sekolah = $request->input("sekolah");
		$sekolahasal->npsn = $request->input("npsn");
		
		$sekolahasal->updated_by = Auth::id();
		$sekolahasal->save();


		$text = 'mengedit '.$this->title;//.' '.$sekolahasal->what;
		$this->log($request, $text, ['sekolahasal.id' => $sekolahasal->id]);
		return redirect()->route('sekolahasal.index')->with('message_success', 'Sekolah Asal berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$sekolahasal = SekolahAsal::find($id);
		$sekolahasal->deleted_by = Auth::id();
		$sekolahasal->save();
		$sekolahasal->delete();

		$text = 'menghapus '.$this->title;//.' '.$sekolahasal->what;
		$this->log($request, $text, ['sekolahasal.id' => $sekolahasal->id]);
		return back()->with('message_success', 'Sekolah Asal berhasil dihapus!');
	}

}
