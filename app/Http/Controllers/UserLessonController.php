<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\UserLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLessonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firstname = Auth::user()->firstName;
        $surname = Auth::user()->surName;
        $myLessons = User::find(Auth::id())->lessons;
        $lessons = Lesson::all();
        return view('home', compact('firstname','surname','myLessons','lessons'));
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
    public function store(Request $request,$id)
    {
        $lesson = Lesson::findOrFail($id);
        if(UserLesson::where('user_id', Auth::id())->where('lesson_id', $id)->first())
        {
            return redirect(route('home'))->with('errorMsg','Bu Dersi Zaten Alıyorsunuz');
        }
        $user_lesson = new UserLesson();
        $user_lesson->user_id = Auth::id();
        $user_lesson->lesson_id = $id;
        $user_lesson->save();
        return redirect(route('home'))->with('successMsg','Başarıyla Alındı !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $delete = UserLesson::where('user_id', Auth::id())->where('lesson_id', $id)->delete();
        if($delete)
        {
            return redirect(route('home'))->with('successMsg','Başarıyla Çıkarıldı !');
        }
    }
}
