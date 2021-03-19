<?php 
if (!empty($editId)) {
    $action = '/updateUser';
} else {
    $action = '/addUser';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User list page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <?= Session::get('msg');?>
    <h2>Create New User</h2>          
    <form action="<?= $action;?>" method="post">
        <?php if (!empty($editId)) { ?>
            <input type="hidden" value="<?= $editId;?>" name="editId" />
        <?php }?>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= !empty($editData) ? $editData[0]->name : '';?>">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" value="<?= !empty($editData) ? $editData[0]->email : '';?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone No:</label>
            <input type="number" class="form-control" name="phone" value="<?= !empty($editData) ? $editData[0]->phone : '';?>">
        </div>           
        <button type="submit" class="btn btn-default">Submit</button>
    </form>    

    <h2>User List</h2>          
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $key => $value) {?>
            <tr>
                <td><?= $value->name;?></td>
                <td><?= $value->phone;?></td>
                <td><?= $value->email;?></td>
                <td>
                    <a href="<?= url("edit/$value->id");?>">Edit</a>
                </td>
                <td>
                    <a href="<?= url("delete/$value->id");?>">Delete</a>
                </td>
            </tr>     
        <?php }?>       
        </tbody>
    </table>
</div>

</body>
</html>
