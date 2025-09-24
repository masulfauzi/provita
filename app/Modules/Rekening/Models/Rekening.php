<?php

namespace App\Modules\Rekening\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Nasabah\Models\Nasabah;
use App\Modules\JenisRekening\Models\JenisRekening;


class Rekening extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $dates      = ['deleted_at'];
	protected $table      = 'rekening';
	protected $fillable   = ['*'];	

	public function nasabah(){
		return $this->belongsTo(Nasabah::class,"id_nasabah","id");
	}
public function jenisRekening(){
		return $this->belongsTo(JenisRekening::class,"id_jenis_rekening","id");
	}

}
