<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <meta name="author" content="Abhishek Verma">

        <title>REGISTER NEW USER</title>

        <link href="./css/css/metro.css" rel="stylesheet">
        <link href="./css/css/metro-icons.css" rel="stylesheet">
        <link href="./css/css/metro-responsive.css" rel="stylesheet">
        <link href="./css/css/metro-schemes.css" rel="stylesheet">

        <link href="./css/css/docs.css" rel="stylesheet">

        <script src="./css/js/jquery-2.1.3.min.js"></script>
        <script src="./css/js/metro.js"></script>
        <script src="./css/js/docs.js"></script>
        <script src="./css/js/prettify/run_prettify.js"></script>
        <script src="./css/js/ga.js"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        
        <style>
            
                      
            .users{
                position:absolute;
                width:50%;
                height:80%;
                top:5em;
                right:0px;
                
                border-left:solid;
                border-color:lightgray;
             }
             
             .table a{
                 text-decoration:none;
                 padding:10px;
             }
             
             .button {
                background-color: #00b2b3;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 20px;
                border-radius: 10px;
            }
             
        </style>
       
    </head>
    <body>
            
                <div class="app-bar green" data-role="appbar" data-flexstyle="sidebar2">

                    <a class="app-bar-element branding">REGISTER NEW USER </a>

                                      
                    <ul class="app-bar-menu place-right" data-flexdirection="reverse">
                        <!--<li>
                            <div class="input-control text">
                                <input type="text" placeholder="Search...">
                            </div>
                        </li>-->
                        <li><a href="./index.php"><span class="mif-home"></span></a></li>
                        <li><a href="./index.php">GO Back</a></li>
                    </ul>
                </div>
                <!--=================================End of Menu Bar===============================-->
      <div class="container page-content">
            <div class="grid " >  
                <div class ="padding20">
                      <form id = "select_values" method ="GET" action= "./ADMIN/register_user.php" >   
                            
                            <!-- ********User_name**************-->
                            <div class = "row cells1">  
                                                
                                            <div class = "cell">
                                                    <div class="input-control text">
                                                        <input type="text" placeholder = "NAME" name = "user_name">
                                                    </div>
                                            </div><!--end of cell div-->
                            </div> <!-- end of row div -->
                            <!-- ********user_emp_id**************-->
                            <div class = "row cells1">   
                                            <div class = "cell">
                                                    <div class="input-control text" >
                                                        <input type="text" placeholder = "Employee iD" name = "user_emp_id">
                                                    </div>
                                            
                                            </div><!--end of cell div-->
                            </div> <!-- end of row div -->
                            <!-- ********user_type**************-->
                            <div class="input-control select">
                                <select name = "user_type">
                                    <option value = "1">ANM</option>
                                    <option value = "2">GYNAC</option>
                                    <option value = "3">MO</option>
                                    <option value = "4">MO/GYNAC</option>
                                    <option value = "5">ADMIN</option>
                                </select>
                            </div>

                            <!-- ********registered_by**************-->

                          <div class = "row cells1">   
                                            <div class = "cell">
                                                    <div class="input-control text" >
                                                        <input type="text" placeholder = "Registered By" name = "registered_by">
                                                    </div>
                                            
                                            </div><!--end of cell div-->
                            </div> <!-- end of row div -->

                            <!-- ********Remark**************-->

                          <div class = "row cells1">   
                                            <div class = "cell">
                                                    <div class="input-control text" >
                                                        <input type="text" placeholder = "Remark" name = "remark">
                                                    </div>
                                            
                                            </div><!--end of cell div-->
                            </div> <!-- end of row div -->

                            
                            
                            <div class = "row cells1"> 
                                            <div class = "cell">      
                                                <input type="submit" value="Register">
                                            </div>
                                            
                            </div> <!-- end of row div -->
                            
                            <div class = "row cells1"> 
                                            <div class = "cell">      
                                               <h4><?php 
                                               
                                               if(isset($_GET['message']))
                                               {
                                               echo $_GET['message']; 
                                               }                                           
                                               
                                               ?></h4>
                                            </div>
                                            
                            </div> <!-- end of row div -->
                        
                     </form> 
                     
                 </div>    <!-- end place left div -->  
            </div>  <!-- end of grid div -->
            
           
            
        </div>  <!-- end of container div -->
        
        
        
        <!--=======================Database Connection===========================-->
        <!--=====================================================================-->
        <?php
        include("./dbconnect.php");
                               
                            $query = "SELECT * FROM user_white_list";
                            $result = mysqli_query($conn,$query);                          
                           // mysqli_close();
        ?>
        
         <div class = "users">
                
               <table class = "table">
                   <thead>
                        <tr>
                            <th >NAME</th>
                            <th >Emp_id</th>
                            <th >TYPE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                   <?php   foreach ($result as $row )
                            { ?>
                                <tr>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['user_emp_id']; ?></td>
                                        <td><?php echo $row['user_type']; ?></td>
                                        <td><?php echo $row['account_flag']; ?></td>
                                        <?php $emp_id = $row['user_emp_id']; 

                                            echo "<td>
                                            <a class = \"button\" style = \"background-color: #2ecc71;\"  href ='./ADMIN/change_status.php?flag=A&emp_id=$emp_id'>A</a>
                                            <a class = \"button\" style = \"background-color: #f1c40f;\" href ='./ADMIN/change_status.php?flag=S&emp_id=$emp_id'>S</a>
                                            <a class = \"button\" style = \"background-color: #e74c3c;\" href ='./ADMIN/change_status.php?flag=D&emp_id=$emp_id'>D</a>
                                                </td>";
                                        
                                        ?>
                                        
                                </tr>   
                            
                        
                    <?php   }     ?>
                      
                    </tbody>    
                              
               </table> 
         </div>
        
        
    </body>
</html>