<?php

namespace App\Modules\Siswa\Models;

use App\Helpers\UsesUuid;
use App\Modules\Desa\Models\Desa;
use Illuminate\Support\Facades\DB;
use App\Modules\Agama\Models\Agama;
use App\Modules\AlatTransportasi\Models\AlatTransportasi;
use App\Modules\JenisTinggal\Models\JenisTinggal;
use App\Modules\Sekolah\Models\Sekolah;
use App\Modules\SekolahAsal\Models\SekolahAsal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Siswa extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $dates      = ['deleted_at'];
	protected $table      = 'siswa';
	protected $fillable   = ['nisn', 'nis', 'nama', 'jenis_kelamin', 'nik', 'id_sekolah_asal', 'id_sekolah', 'tempat_lahir', 'tgl_lahir', 'id_agama', 'id_desa', 'alamat', 'id_alat_transportasi', 'id_jenis_tinggal', 'no_telp', 'email', 'no_registrasi_akta_lahir'];	

	public function sekolah(){
		return $this->belongsTo(Sekolah::class,"id_sekolah","id");
	}
	public function desa(){
		return $this->belongsTo(Desa::class,"id_desa","id");
	}
	public function agama(){
		return $this->belongsTo(Agama::class,"id_agama","id");
	}
	public function sekolah_asal(){
		return $this->belongsTo(SekolahAsal::class,"id_sekolah_asal","id");
	}
	public function alat_transportasi(){
		return $this->belongsTo(AlatTransportasi::class,"id_alat_transportasi","id");
	}
	public function jenis_tinggal(){
		return $this->belongsTo(JenisTinggal::class,"id_jenis_tinggal","id");
	}
}
