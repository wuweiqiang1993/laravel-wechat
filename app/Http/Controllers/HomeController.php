<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\UserModel;

    class HomeController extends Controller
    {
        public function index(Request $request)
        {
            $a = new UserModel;
            $a->addUser(['username'=>'qwewqe','password'=>md5('asdasd'),'nickname'=>'wwq','login_time'=>date('Y-m-d H:i:s'),'update_time'=>date('Y-m-d H:i:s')]);
        }
    }
    