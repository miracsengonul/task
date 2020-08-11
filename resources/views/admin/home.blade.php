<!DOCTYPE html>
<html>
<head>
    <title>Yönetici Paneli | DugunBuketi</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
        .table th {
            text-align: center;
        }
        .newButton {
            border-radius: 2px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container" style="background-color: white;text-align: center;">
    <h1 style="color:black">Yönetici Paneli</b></h1>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <img data-toggle="tooltip" title="Çıkış Yap !" src="{{asset('img/icon/logout.png')}}" width="28">
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <hr>
    <h2>Öğrenciler</h2>
    <p>Tüm öğrencilere ve detaylarına ulaşabilirsiniz.</p>
    <hr>
    <div class="container">
        <div class="col-md-4">
            <button data-toggle="modal" data-target="#addStudent" class="btn btn-success btn-md newButton"><i
                    class="fas fa-user-plus"></i> Öğrenci Ekle
            </button>
        </div>
        <div class="col-md-4">
            <button data-toggle="modal" data-target="#deleteStudent" class="btn btn-danger btn-md newButton"><i
                    class="fas fa-user-minus"></i> Öğrenci Sil
            </button>
        </div>
        <div class="col-md-4">
            <button data-toggle="modal" data-target="#findStudent" class="btn btn-primary btn-md newButton"><i
                    class="fas fa-search"></i> Öğrenci Ara
            </button>
        </div>
    </div>
    <hr>

    <!-- Öğrenci Ekle -->
    <div id="addStudent" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Öğrenci Ekle</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('add_user')}}" method="POST">
                      @csrf
                        <div class="form-group">
                            <label for="name">İsim</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Öğrenci İsmi" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="surname">Soyisim:</label>
                            <input type="text" class="form-control" id="surname" name="surname"
                                   placeholder="Öğrenci Soyismi" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="age">Yaş:</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Öğrenci Yaşı" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Öğrenci Numarası:</label>
                            <input type="text" class="form-control" id="number" name="student_number" placeholder="Öğrenci Numarası" required autocomplete="off">
                        </div>
                        <input type="submit" value="Kaydet" class="btn btn-success">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteStudent" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Öğrenci Sil</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('delete_user')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="number">Öğrenci Numarası</label>
                            <input type="text" class="form-control" id="number" name="student_number" placeholder="Öğrenci Numarası" autocomplete="off">
                        </div>
                        <input type="submit" value="Sil" class="btn btn-danger">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>

    <div id="findStudent" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Öğrenci Ara</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('search_user')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="number">Öğrenci Numarası</label>
                            <input type="text" class="form-control" id="number" name="student_number" placeholder="Öğrenci Numarası" autocomplete="off">
                        </div>
                        <input type="submit" value="Ara" class="btn btn-primary">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Vazgeç</button>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('errorMsg'))
        <hr>
        <div class="alert alert-danger alert-dismissible" style="color:black;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('errorMsg') }}
        </div>
        <hr>
    @elseif(Session::has('successMsg'))
        <hr>
        <div class="alert alert-success alert-dismissible" style="color:black;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('successMsg') }}
        </div>
        <hr>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Numara</th>
            <th>Öğrenci</th>
            <th>Son Giriş</th>
            <th>Detay</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->student_number}}</td>
                <td>{{$user->firstName}} {{$user->surName}}</td>
                <td>{{$user->login_time ?? 'Giriş Yapmadı'}}</td>
                <td><a href=" {{route('admin_user',['id' => $user->id])}}"><img data-toggle="tooltip" title="Öğrenci Detayı" src="{{asset('img/icon/user.png')}}" width="16"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
