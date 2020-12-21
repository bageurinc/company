<?php

namespace Bageur\Company\Model;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = 'bgr_company';
    protected $appends = ['avatar','avatarfav','etc_data'];

    public function getAvatarAttribute()
    {
        $bageur = new Bageur;
        return $bageur->avatar($this->nama_perusahaan,$this->logo,$this->logo_path);
    }  
    public function getAvatarfavAttribute()
    {
        $bageur = new Bageur;
        return $bageur->avatar($this->nama_perusahaan,$this->favicon,$this->favicon_path);
    }  
    public function getEtcDataAttribute()
    {
            return json_decode($this->etc);
    }   
    public function scopeDatatable($query,$request,$page=12)
    {
          $search       = ["nama_perusahaan"];
          $searchqry    = '';

        $searchqry = "(";
        foreach ($search as $key => $value) {
            if($key == 0){
                $searchqry .= "lower($value) like '%".strtolower($request->search)."%'";
            }else{
                $searchqry .= "OR lower($value) like '%".strtolower($request->search)."%'";
            }
        } 
        $searchqry .= ")";
        if(@$request->sort_by){
            if(@$request->sort_by != null){
            	$explode = explode('.', $request->sort_by);
                 $query->orderBy($explode[0],$explode[1]);
            }else{
                  $query->orderBy('created_at','desc');
            }

             $query->whereRaw($searchqry);
        }else{
             $query->whereRaw($searchqry);
        }
        if($request->get == 'all'){
            return $query->get();
        }else{
                return $query->paginate($page);
        }

    }
}
