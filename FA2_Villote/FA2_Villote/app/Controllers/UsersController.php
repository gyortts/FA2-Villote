<?php
namespace App\Controllers;
use App\Models\UserModel;
class UsersController extends BaseController {
 public function index(){return view('users/index',['items'=>(new UserModel())->select('id,username')->findAll()]);}
 public function create(){return view('users/form',['item'=>null]);}
 public function store(){if(!$this->validateData($this->request->getPost(),['username'=>'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username]','password'=>'required|min_length[8]']))return redirect()->back()->withInput()->with('error','Use a unique username and password of at least 8 characters.');(new UserModel())->insert(['username'=>$this->request->getPost('username'),'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT)]);return redirect()->to('/users');}
 public function edit($id){$item=(new UserModel())->find($id);if(!$item)throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();return view('users/form',['item'=>$item]);}
 public function update($id){$model=new UserModel();$item=$model->find($id);if(!$item)throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();$username=(string)$this->request->getPost('username');$password=(string)$this->request->getPost('password');if(strlen($username)<3||strlen($username)>50||($password!==''&&strlen($password)<8)||$model->where('username',$username)->where('id !=',$id)->first())return redirect()->back()->withInput()->with('error','Invalid or duplicate username, or password too short.');$data=['username'=>$username];if($password!=='')$data['password']=password_hash($password,PASSWORD_DEFAULT);$model->update($id,$data);return redirect()->to('/users');}
 public function delete($id){if((int)$id===(int)session('user_id'))return redirect()->to('/users')->with('error','You cannot delete your own account.');(new UserModel())->delete($id);return redirect()->to('/users');}
}
