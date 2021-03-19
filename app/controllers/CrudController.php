<?php 
use Illuminate\Support\Facades\Request;
use CrudModel;

class CrudController extends BaseController {

    public function getAllusers() {
        // $posts = DB::table('users')->get();    
        $posts = CrudModel::all();
        return $posts;
    }

    public function userList() {
        $posts = $this->getAllusers();        
        return View::make('list', ['data' => $posts]);
    }

    public function addUser() {
        $postData = Input::all();
        $crud = new CrudModel;
        $crud->name = $postData['name'];
        $crud->email = $postData['email'];
        $crud->phone = $postData['phone'];
        $res = $crud->save();
        if ($res) {
            Session::flash('msg', '<h2 class="alert alert-success">User has been created successfully.</h2>');
        } else {
            Session::flash('msg', '<h2 class="alert alert-danger">Something went wrong.</h2>');
        }

        return Redirect::to('/list');
    }
    
    public function updateUser() {
        $crud = new CrudModel;

        $postData = Input::all();
        $data = [
            'name' => $postData['name'],
            'phone' => $postData['phone'],
            'email' => $postData['email']
        ];

        $id = $postData['editId'];
        // $isUpdated = DB::table($this->table)->where('id', $id)->update($data);
        $isUpdated = $crud->where('id', $id)->update($data);
        if ($isUpdated) {
            Session::flash('msg', '<h2 class="alert alert-success">User has been updated successfully.</h2>');
        } else {
            Session::flash('msg', '<h2 class="alert alert-danger">Something went wrong.</h2>');
        }

        return Redirect::to('/list');
    }

    public function edit() {
       $editId = Request::segment(2);
       $data = CrudModel::where('id', $editId)->get();

       $posts = $this->getAllusers();     
       return View::make('list', ['data' => $posts, 'editData' => $data, 'editId' => $editId]);
    }

    public function delete() {
        $deleteId = Request::segment(2);
        $isDeleted = CrudModel::where('id', $deleteId)->delete();
        if ($isDeleted) {
            Session::flash('msg', '<h2 class="alert alert-success">User has been deleted successfully.</h2>');
        } else {
            Session::flash('msg', '<h2 class="alert alert-danger">Something went wrong.</h2>');
        }

        return Redirect::to('/list');
    }
}
?>