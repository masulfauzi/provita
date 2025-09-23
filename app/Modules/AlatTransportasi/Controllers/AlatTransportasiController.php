<?php
namespace App\Modules\AlatTransportasi\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\AlatTransportasi\Models\AlatTransportasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlatTransportasiController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Alat Transportasi";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = AlatTransportasi::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('AlatTransportasi::alattransportasi', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'transportasi' => ['Transportasi', html()->text("transportasi", old("transportasi"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('AlatTransportasi::alattransportasi_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'transportasi' => 'required',
			
		]);

		$alattransportasi = new AlatTransportasi();
		$alattransportasi->transportasi = $request->input("transportasi");
		
		$alattransportasi->created_by = Auth::id();
		$alattransportasi->save();

		$text = 'membuat '.$this->title; //' baru '.$alattransportasi->what;
		$this->log($request, $text, ['alattransportasi.id' => $alattransportasi->id]);
		return redirect()->route('alattransportasi.index')->with('message_success', 'Alat Transportasi berhasil ditambahkan!');
	}

	public function show(Request $request, AlatTransportasi $alattransportasi)
	{
		$data['alattransportasi'] = $alattransportasi;

		$text = 'melihat detail '.$this->title;//.' '.$alattransportasi->what;
		$this->log($request, $text, ['alattransportasi.id' => $alattransportasi->id]);
		return view('AlatTransportasi::alattransportasi_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, AlatTransportasi $alattransportasi)
	{
		$data['alattransportasi'] = $alattransportasi;

		
		$data['forms'] = array(
			'transportasi' => ['Transportasi', html()->text("transportasi", $alattransportasi->transportasi)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$alattransportasi->what;
		$this->log($request, $text, ['alattransportasi.id' => $alattransportasi->id]);
		return view('AlatTransportasi::alattransportasi_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'transportasi' => 'required',
			
		]);
		
		$alattransportasi = AlatTransportasi::find($id);
		$alattransportasi->transportasi = $request->input("transportasi");
		
		$alattransportasi->updated_by = Auth::id();
		$alattransportasi->save();


		$text = 'mengedit '.$this->title;//.' '.$alattransportasi->what;
		$this->log($request, $text, ['alattransportasi.id' => $alattransportasi->id]);
		return redirect()->route('alattransportasi.index')->with('message_success', 'Alat Transportasi berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$alattransportasi = AlatTransportasi::find($id);
		$alattransportasi->deleted_by = Auth::id();
		$alattransportasi->save();
		$alattransportasi->delete();

		$text = 'menghapus '.$this->title;//.' '.$alattransportasi->what;
		$this->log($request, $text, ['alattransportasi.id' => $alattransportasi->id]);
		return back()->with('message_success', 'Alat Transportasi berhasil dihapus!');
	}

}
