@extends('layouts.master')

@section('content')
	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Update</h3>
				</div>
				<div class="panel-body">
					<form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
        	{{csrf_field()}}

		  <div class="form-group">
		    <label for="exampleInputEmail1">Kode</label>
		    <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kode" value="{{$siswa ->nama_depan}}">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Nama Alat</label>
		    <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Alat" value="{{$siswa ->nama_belakang}}">
		  </div>

			<div class="form-group">
			    <label for="exampleFormControlSelect1">Jenis Alat</label>
			    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
			      <option value="L" @if($siswa -> jenis_kelamin == 'Accoustic') selected @endif>Accoustic</option>
			      <option value="P" @if($siswa -> jenis_kelamin == 'Electric') selected @endif>Electric</option>
			    </select>
			  </div>

			<div class="form-group">
		    <label for="exampleInputEmail1">Harga</label>
		    <input name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Harga" value="{{$siswa ->agama}}">
		  </div>

		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Keterangan</label>
		    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$siswa -> alamat}}</textarea>
		  </div>

		   <div class="form-group">
		    <label for="exampleFormControlTextarea1">Avatar</label>
		    <input type="file" name="avatar" class="form-control">
		   
		  </div>


			
			<div class="col-lg-8 mx-auto my-5">	
 
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
 
				
				</div>
			</div>

		   <button type="submit" class="btn btn-warning">Update</button>
        </form>
				</div>
			</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
@section('content1')
		<h1>Edit data siswa</h1>
		@if(session('sukses'))
		<div class="alert alert-success" role="alert">
			{{session('sukses')}}
		</div>
		@endif
		<div class="row">
			<div class="col-lg-12">
		
        </div>
	
</div>
@endsection

