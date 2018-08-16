@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Logs</div>
                    <script>
                        function deleteuser(id) {
                            if(confirm('Are you sure')){
                                window.location.href = "/delete/log/"+id;
                            }
                        }
                    </script>
                    <style>
                        .time{
                            width: 20px;
                        }
                    </style>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif



                                    <?php
//                                echo '<pre>';
//                                print_r($Logs);
//                                echo '</pre>';
                                if(!empty($Logs)){
                                    $date = '';
                                    $flag = true;
                                    $flag2 = false;
                                    foreach ($Logs  as $log) {
                                        if($date!= $log['date']){
                                            $date=$log['date'];
                                            if($flag==true){
                                                ?>
                    <div class="panel-body">
                        <table style='border-collapse: separate; border-spacing: 10px; width: 100%;'>
                            <tr>
                                <th colspan="3">
                                    <b><?php echo date('Y-m-d', strtotime($log['created_at'])) ?></b>
                                </th>
                            </tr>

                    <?php
                            echo "<tr><td style='width: 10%'>".date('h:i:s', strtotime($log['created_at'])) ."</td><td style='width: 75%'>". $log['log'] ."</td><td><i class='fa fa-trash' title='Delete User' style='cursor:pointer;color:#4093cf' onclick=\"deleteuser($log->id)\"></i></td></tr>" ;
                                                $flag=false;
                                            }else{
                                                $flag2=true;
                                                ?>

                        </table>
                    </div>
                            <div class="panel-body">
                                <table style='border-collapse: separate; border-spacing: 10px; width: 100%;'>
                                    <tr>
                                        <th colspan="3">
                                            <b><?php echo date('Y-m-d', strtotime($log['created_at'])) ?></b>
                                        </th>
                                    </tr>

                            <?php
                            echo "<tr><td style='width: 10%'>".date('h:i:s', strtotime($log['created_at'])) ."</td><td style='width: 75%'>". $log['log'] ."</td><td><i class='fa fa-trash' title='Delete User' style='cursor:pointer;color:#4093cf' onclick=\"deleteuser($log->id)\"></i></td></tr>" ;
                                            }
                                        }else{
                                        echo "<tr><td>".date('h:i:s', strtotime($log['created_at'])) ."</td><td style='width: 75%'>". $log['log'] ."</td><td><i class='fa fa-trash' title='Delete User' style='cursor:pointer;color:#4093cf' onclick=\"deleteuser($log->id)\"></i></td></tr>" ;
                                    }
                                        ?>

                                    <?php


                                    }
                                    if($flag2){
                                        echo '</table></div>';
                                    }
                                }else{
                                    echo "<tr><td></td><td>No logs</td></tr>" ;
                                }
                            ?>
                    <div class="panel-body">
                        <table style='border-collapse: separate; border-spacing: 10px; width: 100%;'>
                            <tr>

                                    <td class="time" colspan="3">
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