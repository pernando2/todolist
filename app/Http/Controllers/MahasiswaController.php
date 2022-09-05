<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(ToDoList::where('user_id', auth()->user()->id)->get());
        return view('backend-template.mahasiswa.content', [
            'lists' => ToDoList::where('user_id', auth()->user()->id)->get()
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
            'nama_list' => "required|max:255",
            'user_id' => "required",
        ]);
        // dd($validatedData);

        ToDoList::create($validatedData);

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
    public function edit(ToDoList $list)
    {
        return view('backend-template.mahasiswa.edit', [
            'list' => $list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDoList $list)
    {
        $rules = [
            'nama_list' => "required|max:255",
        ];

        $validatedData = $request->validate($rules);

        ToDoList::where('id', $list->id)->update($validatedData);

        return redirect('/dashboard')->with('success', 'List has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDoList $list)
    {
        ToDoList::destroy($list->id);

        return redirect('/dashboard')->with('delete', 'List has been deleted!');
    }
}
