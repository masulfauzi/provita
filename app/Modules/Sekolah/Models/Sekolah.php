<?php

namespace App\Modules\Sekolah\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Jenjang\Models\Jenjang;


class Sekolah extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $dates      = ['deleted_at'];
	protected $table      = 'sekolah';
	protected $fillable   = ['*'];	

	public function jenjang(){
		return $this->belongsTo(Jenjang::class,"id_jenjang","id");
	}

}
