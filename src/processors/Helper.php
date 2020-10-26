<?php
namespace Bageur\Company\Processors;

class Helper {

    public static function go($data,$loc) {
       $namaBerkas = rand(000,999).'-'.$data->getClientOriginalName();
      \Storage::makeDirectory('public/bageur.id');
       $path = $data->storeAs('public/bageur.id/'.$loc.'/', $namaBerkas);
       return basename($path);
    }

     public static function get( $name, $image = null, $folder = "bageur", $type = "initials") {
        if (empty($image)) {
            if (!empty($name)) {
                return 'https://avatars.dicebear.com/v2/'.$type.'/' . preg_replace('/[^a-z0-9 _.-]+/i', '', $name) . '.svg';
            }
            return null;
        }
        return url('storage/bageur.id/company/'.$image);
    }
}
