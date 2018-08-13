@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User List</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table style='border-collapse: separate; border-spacing: 10px;'>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            <script>
                                function deleteuser(id) {
                                    if(confirm('Are you sure')){
                                        window.location.href = "/admin/delete/user/"+id;
                                    }
                                }
                            </script>
                            <?php
                            foreach ($users as $user) {
                                echo "<tr><td>".$user->name ."</td><td>". $user->email ."</td><td>". $user->role ."</td>" ;
                                if($user->approved)
                                    echo "<td>$user->created_at</td><td>Approved</td><td>N/A</td><td><i class='fa fa-trash' title='Delete User' style='cursor:pointer;color:#4093cf' onclick=\"deleteuser($user->id)\"></i></td></tr>";
                                else
                                    echo "<td>$user->created_at</td><td>Not Approved</td><td><a href='/admin/approve/user/$user->id'>Approve User</a></td><td><i class='fa fa-trash' title='Delete User' style='cursor:pointer;color:#4093cf'  onclick=\"deleteuser($user->id)\"></i></td><tr>";
                            }
                            ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection