<?php

namespace App\Models\Empresa;

use App\Models\Confi\TipoDocumento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Grupo extends Model
{
     use HasFactory,Notifiable;
    protected $table = 'grupos';
    protected $guarded = [];

    //==================================================================================
    //----------------------------------------------------------------------------------
    public function administrador()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    //----------------------------------------------------------------------------------
    public function tipo_docu()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'grupo_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //==================================================================================
}
