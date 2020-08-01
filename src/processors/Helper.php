<?php
namespace Bageur\Company\Processors;

class Helper {

    public static function go($data,$loc) {
       $namaBerkas = date('YmdHis').'.'.$data->getClientOriginalExtension();
       $path = $data->storeAs('public/'.$loc.'/', $namaBerkas);
       return basename($path);
    }

     public static function get( $name, $image = null, $folder = "bageur", $type = "initials") {
        if (empty($image)) {
            if (!empty($name)) {
                return 'https://avatars.dicebear.com/v2/'.$type.'/' . preg_replace('/[^a-z0-9 _.-]+/i', '', $name) . '.svg';
            }
            return null;
        }
        return url('storage/company/'.$image);
    }
}
