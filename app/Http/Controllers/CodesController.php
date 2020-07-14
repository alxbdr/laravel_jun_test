<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Code;
use App\Http\Requests\DeleteCodes;
use App\Http\Requests\StoreCodes;

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
    public function list() {
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
     * @param  App\Http\Requests\StoreCodes  $request
     * @param  \App\Code $code
     * @return \Illuminate\Http\Response
     */
    public function store (StoreCodes $request, Code $code) {
        $validated = $request->validated();
        //Generate new unique codes using provided characters set
        $store = $code->generate_codes ($validated['number'], '0123456789');
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
     * @param  App\Requests\DeleteCodes  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteCodes $request, Code $code) {
        //Get validated codes from input
        $codes = $request->validated();
        //Check if requested codes exist and delete
        $delete = $code->delete_codes ($codes);
        
        if ($delete['error']) {
            return redirect()->back()->withErrors(['codes'=>'Kody ' . implode(', ' , $delete['not_exist']) . ' nie istnieja'])->withInput();
        }

        return redirect()->route('delete')->with('success', 'Usunieto '. $delete['count'].' kodow. Lista: '.implode(', ' , $delete['codes']));
    }
}
