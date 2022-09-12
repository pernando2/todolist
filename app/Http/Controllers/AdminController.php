<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Mahasiswa::all());
        return view('backend-template.content', [
            'mahasiswa' => User::all(),
        ]);
    }

    public function indexDashboard()
    {
        // dd(Mahasiswa::all());
        return view('backend-template.content', [
            'mahasiswa' => User::all(),
        ]);
    }

    public function indexMatkul()
    {
        // dd(Mahasiswa::all());
        return view('backend-template.admin.mataKuliah.content', [
            'matakuliah' => MataKuliah::groupBy('mata_kuliah', 'user_id', 'id')->get(),
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
            'nama' => "required|max:255",
            'username' => "required|unique:users",
            'nim' => "required",
            'alamat' => "required",
            'password' => "required",
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/mahasiswa')->with('success', 'Mahasiswa has been created!');
    }

    public function storeMatkul(Request $request)
    {
        $validatedData = $request->validate([
            'mata_kuliah' => "required",
        ]);

        $validatedData['user_id'] = mt_rand(1,6);

        MataKuliah::create($validatedData);

        return redirect('/dashboard/mataKuliah')->with('success', 'Mata Kuliah has been created!');
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
    public function edit(User $user)
    {
        // dd($user);
        return view('backend-template.admin.mahasiswa.edit', [
            'mahasiswa' => $user
        ]);
    }

    public function editMatkul(MataKuliah $matkul)
    {
        // dd($user);
        return view('backend-template.admin.mataKuliah.edit', [
            'matakuliah' => $matkul
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => "required|max:255",
            'username' => "required|unique:users",
            'nim' => "required",
            'alamat' => "required",
            'password' => "required",
        ];

        $validatedData = $request->validate($rules);

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/mahasiswa')->with('success', 'Mahasiswa has been updated!');
    }

    public function updateMatkul(Request $request, MataKuliah $matkul)
    {
        $rules = [
            'mata_kuliah' => "required",
        ];

        $validatedData = $request->validate($rules);

        MataKuliah::where('id', $matkul->id)->update($validatedData);

        return redirect('/dashboard/mataKuliah')->with('success', 'Mata Kuliah has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/dashboard/mahasiswa')->with('delete', 'Mahasiswa has been deleted!');
    }

    public function destroyMatkul(MataKuliah $matkul)
    {
        MataKuliah::destroy($matkul->id);

        return redirect('/dashboard/mataKuliah')->with('delete', 'Mahasiswa has been deleted!');
    }

    public function generatePDF(User $user)
    {
        $data = MataKuliah::where('user_id', $user->id)->groupBy('mata_kuliah', 'user_id', 'id')->get();
        // dd($data);

        // return view('backend-template.admin.mahasiswa.pdf', [
        //     'lists' => $data
        // ]);
          
        $pdf = PDF::loadView('backend-template.admin.mahasiswa.pdf', ['lists' => $data]);
    
        return $pdf->stream('Mahasiswa');
    }
}
