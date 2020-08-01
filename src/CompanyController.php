<?php
namespace Bageur\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bageur\Company\model\company;
use Bageur\Company\Processors\Helper;
use Validator;
class CompanyController extends Controller
{

    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return company::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules    	= [
                        'nama_perusahaan'		=> 'required',
                        'gambar'		     	=> 'mimes:jpg,jpeg,png|max:1000',
                    ];
                    
        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $artikel              			= company::findOrFail($id);
            $artikel->nama_perusahaan	    = $request->nama_perusahaan;
            $artikel->email                 = $request->email == 'null' ? '' : $request->email;
            $artikel->nohp                  = $request->nohp == 'null' ? '' : $request->nohp;
            $artikel->wa                    = $request->wa == 'null' ? '' : $request->wa;
            $artikel->fb                    = $request->fb == 'null' ? '' : $request->fb;
            $artikel->in                    = $request->in == 'null' ? '' : $request->in;
            $artikel->ig                    = $request->ig == 'null' ? '' : $request->ig;
            $artikel->tw                    = $request->tw == 'null' ? '' : $request->tw;
            if($request->file('gambar') != null){
                $upload                     = Helper::go($request->file('gambar'),'company');
	           	$artikel->logo	        = $upload;
       		}
            $artikel->save();
            return response(['status' => true ,'text'    => 'has input'], 200); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}