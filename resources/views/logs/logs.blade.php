@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Logs</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table style='border-collapse: separate; border-spacing: 10px; width: 100%;'>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            <style>
                                .time{
                                    width: 20px;
                                }
                            </style>
                            <script>
                                function deleteuser(id) {
                                    if(confirm('Are you sure')){
                                        window.location.href = "/admin/delete/user/"+id;
                                    }
                                }
                            </script>
                            <?php
//                                echo '<pre>';
//                                print_r($Logs);
//                                echo '</pre>';
                                if(!empty($Logs)){
                                    foreach ($Logs  as $log) {
                                        echo "<tr><td>".$log['created_at'] ."</td><td>". $log['log'] ."</td>" ;

                                    }
                                }else{
                                    echo "<tr><td></td><td>No logs</td></tr>" ;
                                }
                            ?>
                            <tr class="row">

                                    <td class="time" colspan="2">
                                        <form action="/logs" method="POST">
                                            <textarea title="Enter logs" style="width: 100%;" name="log"></textarea>
                                            <br>
                                            <div style="float: right"><button type="submit" name="submit"  class="button">Enter..</button></div>
                                            <input type="hidden" name="userId" value="{{ $user->id }}">
                                            {{ csrf_field() }}
                                        </form>
                                    </td>

                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection