<!DOCTYPE html>
<html>
<head>
	<title>Detay | DugunBuketi</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">	<style>
		.link{color:black} .link:hover{color:lightblue}
        .table th {
            text-align: center;
        }
        .newButton{border-radius:2px;font-weight: bold;}
	</style>
</head>
<body>
    <div class="container" style="margin-top:50px;background-color: white;text-align: center;">
        <img src="{{asset('img/icon/user1.png')}}" width="128">
		<h2><b>{{$user->firstName}} {{$user->surName}}</b></h2>
        <p>{{$user->firstName}} {{$user->surName}}adlı öğrencinin kayıtlı olduğu dersler.</p>
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
        <div class="row" style="padding:15px;float: left;">
            <button data-toggle="modal" data-target="#addLesson" class="btn btn-success newButton" style="float: left;"><i class="fas fa-plus-circle"></i> Derse Kaydı Oluştur</button>
        </div>
		<table class="table table-bordered">
		  <thead>
			<tr>
			  <th>Ders Kodu</th>
			  <th>Ders Adı</th>
			  <th>Dersten Çıkar</th>
			</tr>
		  </thead>
		  <tbody>
          @foreach($user->lessons as $lesson)
			<tr>
				<td>{{$lesson->code}}</td>
				<td>{{$lesson->name}}</td>
				<td><a href="{{route('admin_remove_lesson',['user_id' => $user->id, 'lesson_id' => $lesson->id])}}"><img data-toggle="tooltip" title="Dersten Çıkar !" src="{{asset('/img/icon/remove.png')}}" width="13"></a></td>
            </tr>
          @endforeach
		  </tbody>
		</table>
      </div>

    <!-- Add Lesson -->
    <div id="addLesson" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center;font-weight: bold;">Eklemek İstediğiniz Dersin Üstüne Tıklayınız</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                @foreach($lessons as $lesson)
                    <a href="{{route('admin_add_lesson',['userId' => $user->id, 'lessonId' => $lesson->id])}}">
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
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
