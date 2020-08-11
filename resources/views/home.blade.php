<!DOCTYPE html>
<html>
<head>
	<title>Hoşgeldiniz | DugunBuketi Task</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
		.table th {
			text-align: center;
		}
        .newButton{border-radius:2px;font-weight: bold;}
        .link{color:black} .link:hover{color:lightblue}
    </style>
</head>
<body>
	<div class="container" style="margin-top:50px;background-color: white;text-align: center;">
		<img src="{{asset('img/icon/user1.png')}}" width="128">
		<h2>Merhaba, <b>{{$firstname}} {{$surname}} !</b>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img data-toggle="tooltip" title="Çıkış Yap !" src="{{asset('img/icon/logout.png')}}" width="28">
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </h2>
		<hr>
        <button data-toggle="modal" data-target="#addLesson" class="btn btn-success newButton"><i class="fas fa-plus"></i> Derse Kayıt Ol</button>
        <!-- Modal -->
        <div id="addLesson" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Kayıt Olmak İçin Ders Seçiniz</h4>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        @foreach($lessons as $lesson)
                            <a href="{{route('add_user_lesson',['id' => $lesson->id])}}">
                                <div class="row link">
                                    <div class="col-md-6">{{$lesson->code}}</div>
                                    <div class="col-md-6">{{$lesson->name}}</div>
                                </div>
                            </a>
                            <hr>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                    </div>
                </div>
            </div>
        </div>
		<hr>
        <h2>Kayıtlı Derslerim</h2>
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
			  <th>Ders Kodu</th>
			  <th>Ders Adı</th>
			  <th>Ders Çıkar</th>
			</tr>
		  </thead>
		  <tbody>
            @foreach($myLessons as $lesson)
                <tr style="color: green;">
                    <td>{{$lesson->code}}</td>
                    <td>{{$lesson->name}}</td>
                    <td><a href="{{route('remove_user_lesson',['id' => $lesson->id])}}"><img data-toggle="tooltip" title="Dersi Bırak !" src="{{asset('img/icon/remove.png')}}" width="16"></a></td>
                </tr>
            @endforeach
		  </tbody>
		</table>
	  </div>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
