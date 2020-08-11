<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\UserLesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::where('role', 0)->orderBy('id', 'desc')->get();

        return view('admin.home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function userStore(Request $request)
    {
        if (User::where('student_number', $request->student_number)->first()) {
            return redirect(route('admin'))->with('errorMsg', 'Bu Öğrenci Numarasına Ait Bir Kayıt Mevcut !');
        }
        $user = new User();
        $user->firstName = $request->name;
        $user->surName = $request->surname;
        $user->age = $request->age;
        $user->student_number = $request->student_number;
        $user->password = Hash::make('password');
        $user->save();
        return redirect(route('admin'))->with('successMsg', 'Başarıyla Eklendi !');

    }

    public function lessonStore($userId, $lessonId)
    {
        if(UserLesson::where('user_id', $userId)->where('lesson_id', $lessonId)->first())
        {
            return redirect()->back()->with('errorMsg','Öğrenci Bu Dersi Zaten Alıyor');
        }
        $user_lesson = new UserLesson();
        $user_lesson->user_id = $userId;
        $user_lesson->lesson_id = $lessonId;
        $user_lesson->save();
        return redirect()->back()->with('successMsg','Başarıyla Alındı !');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $lessons = Lesson::all();
        return view('admin.detail', compact('user','lessons'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function userShow(Request $request)
    {
        $user = User::where('student_number', $request->student_number)->first();
        return view('admin.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function userDestroy(Request $request)
    {
        $user = User::where('student_number', $request->student_number)->first();
        if ($user) {
            User::where('student_number', $request->student_number)->delete();
            return redirect(route('admin'))->with('successMsg', 'Başarıyla Silindi !');
        } else {
            return redirect(route('admin'))->with('errorMsg', 'Böyle Bir Öğrenci Bulunumadı !');
        }
    }

    public function lessonDestroy($userId, $lessonId)
    {
        $delete = UserLesson::where('user_id', $userId)->where('lesson_id', $lessonId)->delete();
        if($delete)
        {
            return redirect()->back()->with('successMsg','Başarıyla Çıkarıldı !');
        }
    }
}
