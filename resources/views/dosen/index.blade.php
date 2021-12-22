@extends('layouts.template')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    
        <h2 class="my-3">
            <i class="bi bi-people-fill"></i>
            Data Dosen
        </h2>
        <hr>
        <div class="table-responsive">
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary btn-sm mb-2">
                <i class="bi bi-plus"></i> Tambah Data
            </button>

            {{-- Success display --}}
            @if (session('berhasil'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses</strong> {{ session('berhasil') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Error display --}}
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Fungsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $dosen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nip }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->Prodi->nama }}</td>
                        <td>{{ $dosen->alamat }}</td>
                        <td>{{ $dosen->nomor }}</td>
                        <td width="13%" class="text-center">
                            <a href="#" class="btn btn-secondary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal{{ $dosen->id }}"><i class="bi bi-eye"></i></a>

                            <a href="#" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#tambahModal{{ $dosen->id }}"><i class="bi bi-pen"></i></a>

                            <a href="#" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $dosen->id }}"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.dosen.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="prodi_id" class="form-label">Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="form-control">
                                <option value="">-- pilih --</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="Nip..." value="{{ old('nip') }}">
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="nama..." value="{{ old('nama') }}">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat lahir..." value="{{ old('tempat_lahir') }}">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control">
                                    <option value="">-- pilih --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                </select>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-Laki" checked>
                                    <label class="form-check-label" for="jk1">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan">
                                    <label class="form-check-label" for="jk2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat..." value="{{ old('alamat') }}">
                            </div>
                        
                            <div class="mb-3 col-6">
                                <label for="nomor" class="form-label">Nomor Telepon</label>
                                <input type="text" name="nomor" class="form-control" id="nomor" placeholder="Nomor telepon..." value="{{ old('nomor') }}">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail --}}
    @foreach ($dosens as $dosen)
        <div class="modal fade" id="detailModal{{ $dosen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person"></i> Detail Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>NIP</td>
                                <td>: {{ $dosen->nip }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $dosen->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>: {{ $dosen->tempat_lahir }}, {{ date('d/m/Y', strtotime($dosen->tanggal_lahir)) }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>: {{ $dosen->agama }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: {{ $dosen->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>: {{ $dosen->nomor }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ $dosen->email }}</td>
                            </tr>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Hapus --}}
    @foreach ($dosens as $dosen)
    <div class="modal fade" id="hapusModal{{ $dosen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-trash"></i> Hapus Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="post">
                        @csrf

                        <p>Yakin data dosen: {{ $dosen->nama }} akan dihapus..?</p>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali</button>
                           <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    
@endsection