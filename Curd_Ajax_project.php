<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .active{
        background-color: orange !important;
        color:white;
        border: 0px;
    }
    .bule{
        background-color: blue  !important;
        color:white;
        border: 0px;
        opacity: 70%;
    }
</style>
<body>
    <h3 class="mt-4 ms-5 fw-bold text-danger  ps-2" id="title"> Coruse informeation</h3>
    <div class="container-fuild  mt-3 px-5 ">
        <div class="row">
            <div class="col-8 mt-3  ">
                <table border="1" class="table text-center align-middle px-3 pe-4 rounded-3" style="">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Time</th>
                            <th>Session</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "Connection.php";
                        global $con;
                        $insert = "SELECT * FROM `tb_ajax` WHERE `status` = 1 "; 
                        $res = $con->query($insert);
                        while($row = $res->fetch_assoc()){
                            echo '
                            <tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['Cours_name'].'</td>
                            <td>'.$row['price'].'</td>
                            <td>'.$row['Time'].'</td>
                            <td>'.$row['Session'].'</td>
                            <td><img width="70px " src="../uploads/'.$row['image'].'" alt=""></td>
                            <td> 
                                <div class="d-flex justify-content-center " >
                                     <button class="btn btn-danger fw-bold me-2 btndelete " >Delete</button>
                                     <button class="btn btn-warning fw-bold px-4 btnedit">Edit</button>
                                </div>
                            </td>
                        </tr>
                            ';
                        }
                        ?>

                    </tbody>

                </table>

               
            </div>
            <div class=" col-4 shadow rounded-3 px-5 py-4 mt-3 ">
                 <form action="" method="post" empty="">
                    <h4>Insert course</h4>
                    <div class="form-group">
                        <label for="name" >Name: </label>
                        <input type="text" name="name" id="name" class="form-control name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price: </label>
                        <input type="text" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="time" >Time: </label>
                        <input type="text" name="time" id="time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="session" >Session: </label>
                        <select name="session" id="session" class="form-select">
                            <option disabled value="">Monday -- thurday</option>
                            <option  value="9:00 - 10:30 AM">9:00 - 10:30 AM</option>
                            <option  value="11:00 - 12:15 AM">11:00 - 12:15 AM</option>
                            <option  value="12:30 - 1:45 AM">11:00 - 12:15 AM</option>
                            <option disabled value="">Saturday -- sunday</option>
                             <option  value="8:00 - 11:00 AM ">8:00 - 11:00 AM</option>
                            <option  value="11:00 - 1:45 AM ">11:00 - 1:45 PM</option>
                            <option  value="2:00 - 5:00 AM">2:00 - 5:00 PM</option>   
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image" >Image: </label>
                        <input type="file" name="image" id="image" class="form-control"><br>
                        <input type="hidden" name="image_hide" id="image_hide" class="form-control">
                        <img id="img" width="100px" height="90px" class="rounded-3 mt-1 obj-fit-cover" style="cursor:pointer" src="https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=" alt="">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-warning px-3 fw-bold text-white">Reset</button>
                        <button class="btn btn-primary px-5 ms-3 fw-bold text-white" id="btnadd" >Add </button>
                        <button class="btn btn-warning px-5 ms-3 fw-bold text-white" id="btnedit" >Update </button>
                        
                    </div>
                 </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#image').hide();
            $('#btnedit').hide();
            $('#img').click(function(){
                $('#image').click();
                 $('#btnadd').show();
                $('#btnedit').hide();
            })
            $('#image').change(function(){
                let formData = new FormData();
                let file =this.files[0];
                formData.append('image',file);
                $.ajax({
                    url:'Move_file_img.php',
                    method:'post',
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    success:function(param){
                    console.log(param);
                    $('#img').attr('src','../uploads/'+param);
                    $('#image_hide').val(param);
                    }
                })
            })
            $('#btnadd').click(function(e){
                 e.preventDefault();
                const name = $('#name').val();
                const price = $('#price').val();
                const time = $('#time') .val();
                const session = $('#session').val();
                const hide_image = $('#image_hide').val();
                $.ajax({
                    url:'Insert.php',
                    method:'post',
                    data:{
                        name:name,
                        price:price,
                        time:time,
                        session:session,
                        image:hide_image,     
                    },
                    cache:false,
                    success:function(id){
                        $('tbody').append(`
                         <tr>
                            <td>${id}</td>
                            <td>${name}</td>
                            <td>${price}</td>
                            <td>${time}</td>
                            <td>${session}</td>
                            <td><img width="70px " src="../uploads/${hide_image}" alt=""></td>
                            <td> 
                                <div class="d-flex justify-content-center " >
                                     <button class="btn btn-danger fw-bold me-2 fs-6 btndelete" type="button">Delete</button>
                                     <button class="btn btn-warning fw-bold px-4 fs-6">Edit</button>
                                </div>
                            </td>
                        </tr>
                        `);
                    }

                })
                clear();
            })
            let row='';
            $(document).on('click', '.btndelete', function(e){
               
                  row = $(this).parents('tr');
                 let id = row.find('td:first').text();
                //  console.log(row);
                 
                $.ajax({
                    url:'delete.php',
                    method:'post',
                    data:{id:id},
                    success: function(response){
                        console.log(response);
                        if(response==1){
                            row.remove();
                            
                        }else{
                            console.log(2);
                            
                        }
                    }


                })
            })
            $(document).on('click','.btnedit',function(){
            
                $('#btnedit').show();
                $('#btnadd').hide();
                
                let tr = $(this).closest('tr');   
                console.log(tr);
                let name = tr.find('td').eq(1).text();
                let price = tr.find('td').eq(2).text();
                let time = tr.find('td').eq(3).text();
                let session = tr.find('td').eq(4).text().trim();
                let img_old = tr.find('img').first().attr('src');
                $('#name').val(name);
                $('#price').val(price);
                $('#time').val(time);
                $('#session').val(session);
                $('#image_hide').val(img_old);
                $('#img').attr('src',img_old);
            

            })
            function clear(){
                $('#name').val('');
                $('#price').val('');
                $('#time').val('');
                $('#session').val('');
                $('#img').attr('src','https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=');
            }
            
        })
    </script>
</body>
</html>