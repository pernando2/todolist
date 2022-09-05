<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(MataKuliah::all());
        return view('backend-template.mahasiswa.content', [
            'lists' => MataKuliah::where('user_id', auth()->user()->id)->groupBy('mata_kuliah')->get(),
            'listMatkul' => MataKuliah::groupBy('mata_kuliah')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mata_kuliah' => "required|max:255",
            'user_id' => "required",
        ]);
        // dd($validatedData);

        MataKuliah::create($validatedData);

        return redirect('/dashboard')->with('success', 'List has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response 
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(MataKuliah $list)
    {
        return view('backend-template.mahasiswa.edit', [
            'list' => $list,
            'listMatkul' => MataKuliah::groupBy('mata_kuliah')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataKuliah $list)
    {
        $rules = [
            'mata_kuliah' => "required|max:255",
        ];

        $validatedData = $request->validate($rules);

        MataKuliah::where('id', $list->id)->update($validatedData);

        return redirect('/dashboard')->with('success', 'List has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $list)
    {
        MataKuliah::destroy($list->id);

        return redirect('/dashboard')->with('delete', 'List has been deleted!');
    }
}
