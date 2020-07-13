<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Code;

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
        $store = $code->generate_codes ('0123456789', $request->input('number'));
        if(!$store) {
            return redirect()->route('create')->withErrors(['number'=>'Wystapil problem, kody nie zostaly wygenerowane'])->withInput();
        }

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
        $codes = preg_split("/[\s,]+/", trim($request->input('codes')));
        if (!count($codes) > 0) {
            return redirect()->back()->withErrors(['codes'=>'Wpisz poprawny kod'])->withInput();
        }

        $delete = $code->delete_codes ($codes);
        
        if ($delete['error']) {
            return redirect()->back()->withErrors(['codes'=>'Kody ' . implode(', ' , $delete['not_exist']) . ' nie istnieja'])->withInput();
        }

        return redirect()->route('delete')->with('success', 'Usunieto '. $delete['count'].' kodow. Lista: '.implode(', ' , $delete['codes']));
    }
}
