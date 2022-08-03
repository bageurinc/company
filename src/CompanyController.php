<?php
namespace Bageur\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bageur\Company\Model\company;
use Bageur\Company\Processors\Helper;
use Illuminate\Support\Facades\Http;
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
                        'nama_perusahaan'	=> 'required',
                        'file'		     	=> 'nullable|base64image|base64max:1000',
                        'email'             => 'nullable|email',
                        'nohp'              => 'nullable',
                        'wa'                => 'nullable|numeric',
                        'fb'                => 'nullable|url',
                        'ig'                => 'nullable|url',
                        'tw'                => 'nullable|url',
                        'yt'                => 'nullable|url',

                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $cp              		   = company::findOrFail($id);
            $cp->nama_perusahaan	   = $request->nama_perusahaan;
            $cp->alamat                = $request->alamat;
            $cp->email                 = $request->email;
            $cp->nohp                  = $request->nohp;
            $cp->wa                    = $request->wa;
            $cp->fb                    = $request->fb;
            $cp->in                    = $request->in;
            $cp->ig                    = $request->ig;
            $cp->yt                    = $request->yt;
            $cp->tw                    = $request->tw;
            $cp->tentang_kami          = \Bageur::textarea($request->tentang_kami);
            $cp->syarat_ketentuan      = \Bageur::textarea($request->syarat_ketentuan);
            $cp->kebijakan_privacy     = \Bageur::textarea($request->kebijakan_privacy);
            $cp->jam_operasional       = $request->jam_operasional;
            $cp->web                   = $request->web;
            $cp->link_map              = $request->link_map;
            $cp->legal                 = \Bageur::textarea($request->legal);
            if($request->file != null){
                $upload                = Helper::avatarbase64($request->file,'company');
	           	$cp->logo	           = $upload['up'];
                $cp->logo_path         = $upload['path'];
       		}
            if($request->file2 != null){
                $upload                = Helper::avatarbase64($request->file2,'company');
                $cp->favicon              = $upload['up'];
                $cp->favicon_path         = $upload['path'];
            }
            $cp->save();
            try {
                $response = Http::get('https://api.miccapro.com/api/company/syncnow');
            } catch (\Throwable $th) {
                // dd($th);
                //throw $th;
            }
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
