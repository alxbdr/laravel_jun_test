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
        $chars = '0123456789';
        $i=0;
        $codes_array = [];
        while($i < $request->input('number')) {
            $random = substr(str_shuffle($chars), 0, 10);
            if(!$code->where('code', $random)->count()) {
                $codes_array[] = [
                    'code' => $random,
                    'created_at' => now()
                ];
                $i++;
            }      
        }
        $code->insert($codes_array);

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
        $codes_not_exist = [];
        foreach ($array as $string) {
            $model = $code->where('code', $string)->select('id')->first();
            if(!$model) {
                $codes_not_exist[] = $string;
            } else {
                $codes_id_array [] = $model->id;
            }
         }
         if (count($codes_not_exist) > 0) {
            return redirect()->back()->withErrors(['codes'=>'Kody ' . implode(', ' , $codes_not_exist) . ' nie istnieja'])->withInput();
         }
         $code->destroy($codes_id_array);

         return redirect()->route('delete')->with('success', 'Kody ID '.implode(', ' , $codes_id_array).' zostały usuniete');
        }
}
