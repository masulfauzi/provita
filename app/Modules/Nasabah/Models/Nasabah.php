<?php

namespace App\Modules\Nasabah\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\JenisKelamin\Models\JenisKelamin;


class Nasabah extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $dates      = ['deleted_at'];
	protected $table      = 'nasabah';
	protected $fillable   = ['*'];	

	public function jenisKelamin(){
		return $this->belongsTo(JenisKelamin::class,"id_jenis_kelamin","id");
	}

}
