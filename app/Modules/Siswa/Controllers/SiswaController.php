<?php
namespace App\Modules\Siswa\Controllers;

use Form;
use App\Helpers\Logger;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Desa\Models\Desa;
use App\Modules\Agama\Models\Agama;
use App\Modules\Siswa\Models\Siswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Modules\Sekolah\Models\Sekolah;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Modules\SekolahAsal\Models\SekolahAsal;
use App\Modules\JenisTinggal\Models\JenisTinggal;
use App\Modules\AlatTransportasi\Models\AlatTransportasi;
use Illuminate\Support\Facades\Date;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SiswaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Siswa";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Siswa::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Siswa::siswa', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_sekolah_asal = SekolahAsal::all()->pluck('sekolah','id');
		$ref_sekolah = Sekolah::all()->pluck('nama_sekolah','id');
		$ref_agama = Agama::all()->pluck('agama','id');
		$ref_desa = Desa::all()->pluck('nama_desa','id');
		$ref_alat_transportasi = AlatTransportasi::all()->pluck('transportasi','id');
		$ref_jenis_tinggal = JenisTinggal::all()->pluck('jenis_tinggal','id');
		
		$data['forms'] = array(
			'nisn' => ['Nisn', html()->text("nisn", old("nisn"))->class("form-control") ],
			'nis' => ['Nis', html()->text("nis", old("nis"))->class("form-control") ],
			'nama' => ['Nama', html()->text("nama", old("nama"))->class("form-control") ],
			'jenis_kelamin' => ['Jenis Kelamin', html()->select("jenis_kelamin", ["l" => "Laki-Laki", "p" => "Perempuan"], old("jenis_kelamin"))->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'nik' => ['Nik', html()->text("nik", old("nik"))->class("form-control") ],
			'sekolah_asal' => ['Sekolah Asal', html()->select("id_sekolah_asal", $ref_sekolah_asal, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'id_sekolah' => ['Sekolah', html()->select("id_sekolah", $ref_sekolah, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'tempat_lahir' => ['Tempat Lahir', html()->text("tempat_lahir", old("tempat_lahir"))->class("form-control") ],
			'tgl_lahir' => ['Tgl Lahir', html()->date("tgl_lahir", old("tgl_lahir"))->class("form-control")->class("datepicker") ],
			'agama' => ['Agama', html()->select("id_agama", $ref_agama, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'id_desa' => ['Desa', html()->select("id_desa", $ref_desa, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'alamat' => ['Alamat', html()->text("alamat", old("alamat"))->class("form-control") ],
			'alat_transportasi' => ['Alat Transportasi', html()->select("id_alat_transportasi", $ref_alat_transportasi, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'jenis_tinggal' => ['Jenis Tinggal', html()->select("id_jenis_tinggal", $ref_jenis_tinggal, null)->class("form-control")->class("select2")->placeholder('--PILIH SALAH SATU--') ],
			'no_telp' => ['No Telp', html()->text("no_telp", old("no_telp"))->class("form-control") ],
			'email' => ['Email', html()->text("email", old("email"))->class("form-control") ],
			'no_registrasi_akta_lahir' => ['No Registrasi Akta Lahir', html()->text("no_registrasi_akta_lahir", old("no_registrasi_akta_lahir"))->class("form-control") ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Siswa::siswa_create', array_merge($data, ['title' => $this->title]));
	}

	public function showForm(Request $request)
	{	
		$query = Siswa::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman upload data '.$this->title);
		return view('Siswa::siswa_upload', array_merge($data, ['title' => $this->title]));
	}

	public function import(Request $request)
	{	
		$inputFileType = 'Xlsx';
		$inputFileName = $request->file('excel');

		// dd($request->file('excel'));

		$reader = IOFactory::createReader($inputFileType);
		$spreadsheet = $reader->load($inputFileName);
		$worksheet = $spreadsheet->getActiveSheet();

		$dataArray = $worksheet->toArray();
		unset($dataArray[0]);

	foreach ($dataArray as $dataSiswa) {

		if (count(array_filter($dataSiswa, function ($value) {
        return $value !== null;
    	})) === 0) {
        break;    
   		}

		$nisn = $dataSiswa[0];
		$nis = $dataSiswa[1];
		$nama = $dataSiswa[2];
		$jenis_kelamin = $dataSiswa[3];
		$nik = $dataSiswa[4];
		$sekolahAsal = SekolahAsal::all()->where('sekolah', $dataSiswa[5])->first();
		$id_sekolah_asal = $sekolahAsal ? $sekolahAsal->id : null;
		$sekolah = Sekolah::all()->where('nama_sekolah', $dataSiswa[6])->first();
		$id_sekolah = $sekolah ? $sekolah->id : null;
		$tempat_lahir = $dataSiswa[7];
		$tgl_lahir = $dataSiswa[8];
		$tgl_lahir = SharedDate::excelToDateTimeObject($dataSiswa[8])->format('Y-m-d');
		$agama = Agama::all()->where('agama', $dataSiswa[9])->first();
		$id_agama = $agama ? $agama->id : null;
		$desa = Desa::all()->where('nama_desa', $dataSiswa[10])->first();
		$id_desa = $desa ? $desa->id : null;
		$alamat = $dataSiswa[11];
		$alat_transportasi = AlatTransportasi::all()->where('transportasi', $dataSiswa[12])->first();
		$id_alat_transportasi = $alat_transportasi ? $alat_transportasi->id : null;
		$jenis_tinggal = JenisTinggal::all()->where('jenis_tinggal', $dataSiswa[13])->first();
		$id_jenis_tinggal = $jenis_tinggal ? $jenis_tinggal->id : null;
		$no_telp = $dataSiswa[14];
		$email = $dataSiswa[15];
		$no_registrasi_akta_lahir = $dataSiswa[16];
    	
		$siswa = new Siswa();
		$siswa->nisn = $nisn;
		$siswa->nis = $nis;
		$siswa->nama = $nama;
		$siswa->jenis_kelamin = $jenis_kelamin;
		$siswa->nik = $nik;
		$siswa->id_sekolah_asal = $id_sekolah_asal;
		$siswa->id_sekolah = $id_sekolah;
		$siswa->tempat_lahir = $tempat_lahir;
		$siswa->tgl_lahir = $tgl_lahir;
		$siswa->id_agama = $id_agama;
		$siswa->id_desa = $id_desa;
		$siswa->alamat = $alamat;
		$siswa->id_alat_transportasi = $id_alat_transportasi;
		$siswa->id_jenis_tinggal = $id_jenis_tinggal;
		$siswa->no_telp = $no_telp;
		$siswa->email = $email;
		$siswa->no_registrasi_akta_lahir = $no_registrasi_akta_lahir;
		
		$siswa->created_by = Auth::id();
		$siswa->save();
	}
        return redirect()->route('siswa.upload.create')->with('success', 'Data Berhasil Diimpor');
	}


	function store(Request $request)
	{
		$request->validate([
			'nisn' => 'required',
			'nis' => 'required',
			'nama' => 'required',
			'jenis_kelamin' => 'required',
			'nik' => 'required',
			'id_sekolah_asal' => 'required',
			'id_sekolah' => 'required',
			'tempat_lahir' => 'required',
			'tgl_lahir' => 'required',
			'id_agama' => 'required',
			'id_desa' => 'required',
			'alamat' => 'required',
			'id_alat_transportasi' => 'required',
			'id_jenis_tinggal' => 'required',
			'no_telp' => 'required',
			'email' => 'required',
			'no_registrasi_akta_lahir' => 'required',
			
		]);

		$siswa = new Siswa();
		$siswa->nisn = $request->input("nisn");
		$siswa->nis = $request->input("nis");
		$siswa->nama = $request->input("nama");
		$siswa->jenis_kelamin = $request->input("jenis_kelamin");
		$siswa->nik = $request->input("nik");
		$siswa->id_sekolah_asal = $request->input("id_sekolah_asal");
		$siswa->id_sekolah = $request->input("id_sekolah");
		$siswa->tempat_lahir = $request->input("tempat_lahir");
		$siswa->tgl_lahir = $request->input("tgl_lahir");
		$siswa->id_agama = $request->input("id_agama");
		$siswa->id_desa = $request->input("id_desa");
		$siswa->alamat = $request->input("alamat");
		$siswa->id_alat_transportasi = $request->input("id_alat_transportasi");
		$siswa->id_jenis_tinggal = $request->input("id_jenis_tinggal");
		$siswa->no_telp = $request->input("no_telp");
		$siswa->email = $request->input("email");
		$siswa->no_registrasi_akta_lahir = $request->input("no_registrasi_akta_lahir");
		
		$siswa->created_by = Auth::id();
		$siswa->save();

		$text = 'membuat '.$this->title; //' baru '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return redirect()->route('siswa.index')->with('message_success', 'Siswa berhasil ditambahkan!');
	}

	public function show(Request $request, Siswa $siswa)
	{
		$data['siswa'] = $siswa;

		$text = 'melihat detail '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return view('Siswa::siswa_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Siswa $siswa)
	{
		$data['siswa'] = $siswa;

		$ref_sekolah_asal = SekolahAsal::all()->pluck('sekolah','id');
		$ref_sekolah = Sekolah::all()->pluck('nama_sekolah','id');
		$ref_agama = Agama::all()->pluck('agama','id');
		$ref_desa = Desa::all()->pluck('nama_desa','id');
		$ref_alat_transportasi = AlatTransportasi::all()->pluck('transportasi','id');
		$ref_jenis_tinggal = JenisTinggal::all()->pluck('jenis_tinggal','id');
		
		$data['forms'] = array(
			'nisn' => ['Nisn', html()->text("nisn", $siswa->nisn)->class("form-control") ],
			'nis' => ['Nis', html()->text("nis", $siswa->nis)->class("form-control") ],
			'nama' => ['Nama', html()->text("nama", $siswa->nama)->class("form-control") ],
			'jenis_kelamin' => ['Jenis Kelamin', html()->select("jenis_kelamin", ["l" => "Laki-Laki", "p" => "Perempuan"], $siswa->jenis_kelamin)->class("form-control")->class("select2") ],
			'nik' => ['Nik', html()->text("nik", $siswa->nik)->class("form-control") ],
			'id_sekolah_asal' => ['Sekolah Asal', html()->select("id_sekolah_asal", $ref_sekolah_asal, $siswa->id_sekolah_asal)->class("form-control")->class("select2") ],
			'id_sekolah' => ['Sekolah', html()->select("id_sekolah", $ref_sekolah, $siswa->id_sekolah)->class("form-control")->class("select2") ],
			'tempat_lahir' => ['Tempat Lahir', html()->text("tempat_lahir", $siswa->tempat_lahir)->class("form-control") ],
			'tgl_lahir' => ['Tgl Lahir', html()->date("tgl_lahir", $siswa->tgl_lahir)->class("form-control")->class("datepicker") ],
			'id_agama' => ['Agama', html()->select("id_agama", $ref_agama, $siswa->id_agama)->class("form-control")->class("select2") ],
			'id_desa' => ['Desa', html()->select("id_desa", $ref_desa, $siswa->id_desa)->class("form-control")->class("select2") ],
			'alamat' => ['Alamat', html()->text("alamat", $siswa->alamat)->class("form-control") ],
			'id_alat_transportasi' => ['Alat Transportasi', html()->select("id_alat_transportasi", $ref_alat_transportasi, $siswa->id_alat_transportasi)->class("form-control")->class("select2") ],
			'id_jenis_tinggal' => ['Jenis Tinggal', html()->select("id_jenis_tinggal", $ref_jenis_tinggal, $siswa->id_jenis_tinggal)->class("form-control")->class("select2") ],
			'no_telp' => ['No Telp', html()->text("no_telp", $siswa->no_telp)->class("form-control") ],
			'email' => ['Email', html()->text("email", $siswa->email)->class("form-control") ],
			'no_registrasi_akta_lahir' => ['No Registrasi Akta Lahir', html()->text("no_registrasi_akta_lahir", $siswa->no_registrasi_akta_lahir)->class("form-control") ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return view('Siswa::siswa_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'nisn' => 'required',
			'nis' => 'required',
			'nama' => 'required',
			'jenis_kelamin' => 'required',
			'nik' => 'required',
			'id_sekolah_asal' => 'required',
			'id_sekolah' => 'required',
			'tempat_lahir' => 'required',
			'tgl_lahir' => 'required',
			'id_agama' => 'required',
			'id_desa' => 'required',
			'alamat' => 'required',
			'id_alat_transportasi' => 'required',
			'id_jenis_tinggal' => 'required',
			'no_telp' => 'required',
			'email' => 'required',
			'no_registrasi_akta_lahir' => 'required',
			
		]);
		
		$siswa = Siswa::find($id);
		$siswa->nisn = $request->input("nisn");
		$siswa->nis = $request->input("nis");
		$siswa->nama = $request->input("nama");
		$siswa->jenis_kelamin = $request->input("jenis_kelamin");
		$siswa->nik = $request->input("nik");
		$siswa->id_sekolah_asal = $request->input("id_sekolah_asal");
		$siswa->id_sekolah = $request->input("id_sekolah");
		$siswa->tempat_lahir = $request->input("tempat_lahir");
		$siswa->tgl_lahir = $request->input("tgl_lahir");
		$siswa->id_agama = $request->input("id_agama");
		$siswa->id_desa = $request->input("id_desa");
		$siswa->alamat = $request->input("alamat");
		$siswa->id_alat_transportasi = $request->input("id_alat_transportasi");
		$siswa->id_jenis_tinggal = $request->input("id_jenis_tinggal");
		$siswa->no_telp = $request->input("no_telp");
		$siswa->email = $request->input("email");
		$siswa->no_registrasi_akta_lahir = $request->input("no_registrasi_akta_lahir");
		
		$siswa->updated_by = Auth::id();
		$siswa->save();


		$text = 'mengedit '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return redirect()->route('siswa.index')->with('message_success', 'Siswa berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$siswa = Siswa::find($id);
		$siswa->deleted_by = Auth::id();
		$siswa->save();
		$siswa->delete();

		$text = 'menghapus '.$this->title;//.' '.$siswa->what;
		$this->log($request, $text, ['siswa.id' => $siswa->id]);
		return back()->with('message_success', 'Siswa berhasil dihapus!');
	}

	
}
