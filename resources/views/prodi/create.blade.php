<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row pt-4">
      <div class="col">
        <h2>Form Prodi</h2>
        @if (session()->has('info'))
            <div class="alert alert-success">
              {{session()->get('info')}}
            </div>
        @endif
        <form action="{{url('prodi/store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{old('nama')}}">
            @error('nama')
                <div class="text-danger">{{$message}}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="nama">Foto/Logo</label>
            <input type="file" name="foto" id="foto" class="form-control">
            @error('foto')
                <div class="text-danger">{{$message}}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>