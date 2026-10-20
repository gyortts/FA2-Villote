<?php
namespace App\Controllers;
use App\Models\CustomerModel;
class CustomersController extends BaseController {
 public function index(){return view('customers/index',['items'=>(new CustomerModel())->findAll()]);}
 public function create(){return view('customers/form',['item'=>null]);}
 public function store(){if(!$this->validateData($this->request->getPost(),['name'=>'required|max_length[120]','email'=>'permit_empty|valid_email','phone'=>'permit_empty|max_length[30]']))return redirect()->back()->withInput()->with('error','Check the form fields.');(new CustomerModel())->insert($this->data());return redirect()->to('/customers');}
 public function edit($id){$item=(new CustomerModel())->find($id);if(!$item)throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();return view('customers/form',['item'=>$item]);}
 public function update($id){$model=new CustomerModel();if(!$model->find($id))throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();if(!$this->validateData($this->request->getPost(),['name'=>'required|max_length[120]','email'=>'permit_empty|valid_email','phone'=>'permit_empty|max_length[30]']))return redirect()->back()->withInput()->with('error','Check the form fields.');$model->update($id,$this->data());return redirect()->to('/customers');}
 public function delete($id){(new CustomerModel())->delete($id);return redirect()->to('/customers');}
 private function data(){return ['name'=>(string)$this->request->getPost('name'),'email'=>(string)$this->request->getPost('email'),'phone'=>(string)$this->request->getPost('phone')];}
}
