<?php
namespace Bageur\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bageur\Company\Model\bank;
use Bageur\Company\Processors\Helper;
use Validator;
class BankController extends Controller
{

    public function index(Request $request)
    {
        return bank::datatable($request);
    }    
    
    public function resultByType(Request $request)
    {
        return bank::where("type",$request->type)->all();
    }

    public function store(Request $request)
    {
         $rules    = [
            'judul'     => 'required',
            'nama_bank' => 'required',
            'kcp'       => 'required',
            'an'        => 'required',
            'no'        => 'required',
            // 'file'      => 'nullable|base64image|base64max:1000',
        ];

        $messages = [
        ];

        $attributes = [
        ];
        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $tambah             = new bank;
            $tambah->type       = $request->type;
            $tambah->judul      = $request->judul;
            $tambah->nama_bank  = $request->nama_bank;
            $tambah->kcp        = $request->kcp;
            $tambah->an         = $request->an;
            $tambah->no         = $request->no;
            // $tambah->img        = $request->img;
            $tambah->save();
            return response(['status' => true ,'text'    => 'has input'], 200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return bank::findOrFail($id);
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
         $rules    = [
            'judul'     => 'required',
            'nama_bank' => 'required',
            'kcp'       => 'required',
            'an'        => 'required',
            'no'        => 'required',
            // 'file'      => 'nullable|base64image|base64max:1000',
        ];

        $messages = [
        ];

        $attributes = [
        ];
        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $tambah             = bank::find($id);
            $tambah->type       = $request->type;
            $tambah->judul      = $request->judul;
            $tambah->nama_bank  = $request->nama_bank;
            $tambah->kcp        = $request->kcp;
            $tambah->an         = $request->an;
            $tambah->no         = $request->no;
            $tambah->save();
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
        $bank =  bank::find($id);
        $bank->delete();
        return response(['status' => true ,'text'    => 'has input'], 200); 
    }

}