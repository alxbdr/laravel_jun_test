<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Code;

class CodesController extends Controller
{
    //

    public function __construct () {
        $this->middleware('auth');
    }

    /**
     * Show the list of codes
     * 
     * @param  \App\Code $code
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Code $code) {
        return view('list', [
            'title'=>'Lista kodów', 
            'codes'=>$code->all()
        ]);
    }

    /**
     * Show form for generating new codes
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create() {
        return view('create', [
            'title'=>'Utwórz kody'
        ]);
    }

    /**
     * Generate codes and store created codes in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request, Code $code) {
        $validatedData = $request->validate([
            'number' => ['required', 'integer', 'min:1', 'max:10']
        ]);
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $i=0;
        while($i < $request->input('number')) {
            $random = substr(str_shuffle($chars), 0, 10);
            if(!$code->where('code', $random)->count()) {
               $code->fill([
                    'code'=>$random
                ]);             
                $i++;
            }      
        }
        $code->save();

        return redirect()->route('create')->with('success', 'Kody zostały pomyślnie wygenerowane');
    }

    /**
     * Show form for deleting codes
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete() {
        return view('delete', [
            'title'=>'Usuń kody'
        ]);
    }

    /**
     * Remove the specified codes from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Code $code) {

        $validatedData = $request->validate([
            'codes' => ['required', 'string', 'min:10']
        ]);
        $input = trim($request->input('codes'));
        $array = preg_split("/[\s,]+/", $input);
        $codes_id_array = [];
        foreach ($array as $string) {
            if(!$code->where('code', $string)->count()) {
                return redirect()->back()->withErrors(['codes'=>'Kod ' .$string. ' nie istnieje'])->withInput();
            }  
            $codes_id_array []= $code->where('code', $string)->pluck('id'); 
         }
         $code->destroy($codes_id_array);

         return redirect()->route('delete')->with('success', 'Kody zostały usuniete');
        }
}
