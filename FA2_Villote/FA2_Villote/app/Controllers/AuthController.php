<?php
namespace App\Controllers;
use App\Models\UserModel;
class AuthController extends BaseController {
 public function home(){return redirect()->to(session('logged_in')?'/dashboard':'/login');}
 public function login(){if(session('logged_in'))return redirect()->to('/dashboard');return view('auth/login');}
 public function attempt(){
  $rules=['username'=>'required','password'=>'required'];
  if(!$this->validateData($this->request->getPost(),$rules))return redirect()->back()->withInput()->with('error','Enter your username and password.');
  $user=(new UserModel())->where('username',(string)$this->request->getPost('username'))->first();
  if(!$user || !password_verify((string)$this->request->getPost('password'),$user['password']))return redirect()->back()->withInput()->with('error','Invalid login details.');
  session()->regenerate();session()->set(['user_id'=>$user['id'],'username'=>$user['username'],'logged_in'=>true]);
  return redirect()->to('/dashboard');
 }
 public function dashboard(){return view('auth/dashboard');}
 public function logout(){session()->destroy();return redirect()->to('/login');}
}
