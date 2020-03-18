@extends('layouts.master')
@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					@if(session('sukses'))
					<div class="alert alert-success" role="alert">
						{{session('sukses')}}
					</div>
					@endif
					@if(session('error'))
					<div class="alert alert-danger" role="alert">
						{{session('error')}}
					</div>
					@endif
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
										<h3 class="name">{{$siswa->nama_depan}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$siswa->mapel->count()}} <span>Mata pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Awards</span>
											</div>
										<div class="col-md-4 stat-item">
											2174 <span>Points</span>
										</div>
									</div>
								</div>
							</div>
			<!-- END PROFILE HEADER -->
			<!-- PROFILE DETAIL -->
			<div class="profile-detail">
				<div class="profile-info">
					<h4 class="heading">Data diri</h4>
					<ul class="list-unstyled list-justify">
						<li>Jenis Alat <span>{{$siswa->jenis_kelamin}}</span></li>
						<li>Harga <span>{{$siswa->agama}}</span></li>
						<li>Keterangan <span>{{$siswa->alamat}}</span></li>
					</ul>
				</div>

				<div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
			</div>
			<!-- END PROFILE DETAIL -->
		</div>


		<!-- RIGHT COLUMN -->
		<div class="profile-right">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data </button>
					<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Alat Musik</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>KODE</th>
												<th>NAMA</th>
												<th>JENIS</th>
												<th>STOK</th>
											</tr>
										</thead>
										<tbody>
											@foreach($siswa->mapel as $mapel)
											<tr>
												<td>{{$mapel->kode}}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
												<td>{{$mapel->pivot->nilai}}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- END TABBED CONTENT -->
							<div class="panel">
								<div id="chartNilai"></div>
							</div>
						</div>
						<!-- END RIGHT COLUMN -->
					</div>
				</div>
			</div>
		</div>

							<!-- END MAIN CONTENT -->
	</div>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				         <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
				        	{{csrf_field()}}
				        	 <div class="form-group">
							    <label for="mapel">Alat Musik</label>
							    <select class="form-control" id="mapel" name="mapel">
							      @foreach($matapelajaran as $mp)
							      <option value="{{$mp->id}}">{{$mp->nama}}</option>
							      @endforeach
							    </select>
							  </div>
						  <div class="form-group ">
						    <label for="exampleInputEmail1">Stok</label>
						    <input name="nilai" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nilai">
						  </div>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-primary">Simpan</button>
				       </form>
				      </div>
				    </div>
				  </div>
				</div>
@stop
@section('footer')

@stop