<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa = \App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_siswa =\App\Siswa::all();
        }
    	//$data_siswa = \App\Siswa::all();
    	return view('siswa.index',['data_siswa'=>$data_siswa]);
    }
    public function create(Request $request)
    {
        //insert nang table user e 
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = str_random(60);
        $user->save();

        //insert nang table siswa
        $request->request->add(['user_id' => $user->id ]);
    	$siswa = \App\Siswa::create($request->all());
    	return redirect('/siswa')->with('sukses','Data berhasil diinput');
    }
    public function edit($id)
    {
    	$siswa=\App\Siswa::find($id);
    	
    	return view('siswa/edit',['siswa' => $siswa]);
    }
    public function update(Request $request,$id)
    {
        //dd($request->all());
    	$siswa=\App\Siswa::find($id);
    	$siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
    	return redirect('/siswa')->with('sukses','Data berhasil diupdate');
    }
    public function delete($id)
    {
    	$siswa=\App\Siswa::find($id);
    	$siswa->delete($siswa);
    	return redirect('siswa')->with('sukses','Data Berhasil Dihapus');
    }
    
    public function profile($id)
    {
        $siswa=\App\Siswa::find($id);
        $matapelajaran=\App\Mapel::all();

        //nyiapno data chart
        $categories = [];
        $data = [];
        foreach ($matapelajaran as $mp) {
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
             $categories[]= $mp->nama;
             $data[]= $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }
        //dd($mapel);
        return view('siswa.profile',['siswa' => $siswa,'matapelajaran' => $matapelajaran, 'categories' => $categories,'data'=>$data]);
    }
    public function addnilai(Request $request,$idsiswa)
    {
    
        $siswa= \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('error','data mata pelajaran sudah ada..');
        }
        $siswa->mapel()->attach($request->mapel,['nilai'=>$request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Data nilai wes melbu'); 
    }

}
