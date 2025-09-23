<?php
namespace App\Modules\JenisTinggal\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JenisTinggal\Models\JenisTinggal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenisTinggalController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jenis Tinggal";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JenisTinggal::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JenisTinggal::jenistinggal', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_tinggal' => ['Jenis Tinggal', html()->text("jenis_tinggal", old("jenis_tinggal"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JenisTinggal::jenistinggal_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$request->validate([
			'jenis_tinggal' => 'required',
			
		]);

		$jenistinggal = new JenisTinggal();
		$jenistinggal->jenis_tinggal = $request->input("jenis_tinggal");
		
		$jenistinggal->created_by = Auth::id();
		$jenistinggal->save();

		$text = 'membuat '.$this->title; //' baru '.$jenistinggal->what;
		$this->log($request, $text, ['jenistinggal.id' => $jenistinggal->id]);
		return redirect()->route('jenistinggal.index')->with('message_success', 'Jenis Tinggal berhasil ditambahkan!');
	}

	public function show(Request $request, JenisTinggal $jenistinggal)
	{
		$data['jenistinggal'] = $jenistinggal;

		$text = 'melihat detail '.$this->title;//.' '.$jenistinggal->what;
		$this->log($request, $text, ['jenistinggal.id' => $jenistinggal->id]);
		return view('JenisTinggal::jenistinggal_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JenisTinggal $jenistinggal)
	{
		$data['jenistinggal'] = $jenistinggal;

		
		$data['forms'] = array(
			'jenis_tinggal' => ['Jenis Tinggal', html()->text("jenis_tinggal", $jenistinggal->jenis_tinggal)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jenistinggal->what;
		$this->log($request, $text, ['jenistinggal.id' => $jenistinggal->id]);
		return view('JenisTinggal::jenistinggal_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'jenis_tinggal' => 'required',
			
		]);
		
		$jenistinggal = JenisTinggal::find($id);
		$jenistinggal->jenis_tinggal = $request->input("jenis_tinggal");
		
		$jenistinggal->updated_by = Auth::id();
		$jenistinggal->save();


		$text = 'mengedit '.$this->title;//.' '.$jenistinggal->what;
		$this->log($request, $text, ['jenistinggal.id' => $jenistinggal->id]);
		return redirect()->route('jenistinggal.index')->with('message_success', 'Jenis Tinggal berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jenistinggal = JenisTinggal::find($id);
		$jenistinggal->deleted_by = Auth::id();
		$jenistinggal->save();
		$jenistinggal->delete();

		$text = 'menghapus '.$this->title;//.' '.$jenistinggal->what;
		$this->log($request, $text, ['jenistinggal.id' => $jenistinggal->id]);
		return back()->with('message_success', 'Jenis Tinggal berhasil dihapus!');
	}

}
