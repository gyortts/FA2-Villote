<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class DemoSeeder extends Seeder {
 public function run(){
  $username='staff';$password='Staff12345!';
  if(!$this->db->table('users')->where('username',$username)->countAllResults())$this->db->table('users')->insert(['username'=>$username,'password'=>password_hash($password,PASSWORD_DEFAULT),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
 }
}
