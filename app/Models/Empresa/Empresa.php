<?php

namespace App\Models\Empresa;

use App\Models\Confi\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'empresas';
    protected $guarded = [];
    //==================================================================================
    //----------------------------------------------------------------------------------
    public function tipo_docu()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
    //----------------------------------------------------------------------------------
    public function areas()
    {
        return $this->hasMany(Area::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
}
