<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreatePosTables extends Migration {
 public function up(){
  $this->forge->addField(['id'=>['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],'username'=>['type'=>'VARCHAR','constraint'=>50],'password'=>['type'=>'VARCHAR','constraint'=>255],'created_at'=>['type'=>'DATETIME','null'=>true],'updated_at'=>['type'=>'DATETIME','null'=>true]]);
  $this->forge->addKey('id',true);$this->forge->addUniqueKey('username');$this->forge->createTable('users',true);
  $this->forge->addField(['id'=>['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],'name'=>['type'=>'VARCHAR','constraint'=>120],'email'=>['type'=>'VARCHAR','constraint'=>150,'null'=>true],'phone'=>['type'=>'VARCHAR','constraint'=>30,'null'=>true],'created_at'=>['type'=>'DATETIME','null'=>true],'updated_at'=>['type'=>'DATETIME','null'=>true]]);
  $this->forge->addKey('id',true);$this->forge->createTable('customers',true);
 }
 public function down(){$this->forge->dropTable('customers',true);$this->forge->dropTable('users',true);}
}
