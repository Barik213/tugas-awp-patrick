<div class="container">
  <div class="row">
    <div class="col-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="#"></a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Controller_Function/logout') ?>">Logout</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
        <table id="data" class="col-3 display table-bordered table">
          <tbody>
          <h4 class="text-center">Welcome</h4>
          <h4 class="text-center">User Details</h4>
            <tr>
              <?php 
              $browser = $this->agent->browser(); 
              $browser_version = $this->agent->version();
              $os = $this->agent->platform();
              $ip_address = $this->input->ip_address();
              ?>
              <td>Browser Name : <?= $browser." ".$browser_version ?></td>
            </tr>
            <tr>
              <td>IP Address : <?= $ip_address ?></td>
            </tr>
            <tr>
              <td>Operating System : <?= $os ?></td>
            </tr>                      
          </tbody>
        </table>
        <div class="alert alert-success" id="success" style="display:none;">
          
        </div>
        <button id="btnAdd" class="btn btn-success">Add Table</button>
        <table id="dataTable" class="table display table-bordered">
          <thead>
            <th>
              <tr>
              <th>ID</th>
              <th>QR Code </th>
              <th>Username</th>
              <th>Email</th>
              <th>Action</th>
              </tr>
            </th>
          </thead>
          <tbody id="showData">
            <tr>
            <td><?php $barcode= $data['email'] ?>
            <img src="<?= base_url('Controller_Function/QRcode/'.$barcode); ?>"></td>
            <td>Young Lex</td>
            <td>Young Lex</td>
            <td><a href="javascript:;" class="btn btn-info">Update</a>
            <a href="javascript:;" class="btn btn-danger">Update</td>
              </tr>
          </tbody>
          <tfoot>
            <tr>
            <th>ID</th>
            <th>QR Code</th>
            <th>Username</th>
            <th>Email</tH>
            <th>Action</th>
            </tr>

          </tfoot>
        </table>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="myForm" class="form-horizontal" method="post">
          <input type="hidden" name="detectId" values="0">
          <div class="form-group">
            <label for="username" class="label-control col-md-4">Username</label>
            <div class="col-md-12">
              <input type="text" class="form-control" name="username">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="label-control col-md-4">Email</label>
            <div class="col-md-12">
              <input type="text" class="form-control" name="email">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="label-control col-md-4">Password</label>
            <div class="col-md-12">
              <input type="password" class="form-control" name="password">
            </div>
          </div>
          <div class="form-group">
            <label for="retype-password" class="label-control col-md-4">Retype-Password</label>
            <div class="col-md-12">
              <input type="password" class="form-control" name="retypePassword">
            </div>
          </div>                                
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Are you sure to delete this data?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  $(function(){
    //Show All Data
    showAllData();
    //Add New Menu
    $('#btnAdd').click(function(){
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Add New Data');
      $('#myForm').attr('action','<?= base_url('Controller_Function/addNew') ?>');
    });

    $('#btnSave').click(function(){
      var url = $('#myForm').attr('action');
      var data = $('#myForm').serialize();
      //Validate Form
      var username = $('input[name=username]');
      var email = $('input[name=email]');
      var password = $('input[name=password]');
      var retypePassword = $('input[name=retypePassword]');
      var result = '';
      if(username.val() == ''){
        username.parent().parent().addClass('has-error');
        }else{
        username.parent().parent().removeClass('has-error');
        result += '1';
      }
          if(email.val() == ''){
            email.parent().parent().addClass('has-error');
            }else{
              email.parent().parent().removeClass('has-error');
              result += '2';
        }
            if(password.val() == ''){
                password.parent().parent().addClass('has-error');
              }else{
                password.parent().parent().removeClass('has-error');
                result += '3';
            }
                if(retypePassword.val() == ''){
                  retypePassword.parent().parent().addClass('has-error');
                  }else{
                    retypePassword.parent().parent().removeClass('has-error');
                    result += '4';
                }      

      if(result=='1234'){
        $.ajax({
          type: 'ajax',
          method: 'post',
          url: url,
          data: data,
          async: true,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#myModal').modal('hide');
              $('#myForm')[0].reset();
              if(response.type=='add'){
                var type="Added";
              }else if(response.type=='update'){
                var type = "Updated";
              }
              $('#success').html('Data '+type+' Successfully!').fadeIn().delay(4000).fadeOut('slow');
              showAllData();
            }else{
              alert('Error');
            }          
          },
          error: function(){
            alert('Could Not Add Data');
          }
        });
      }
    });

    //Function Edit Data
    $('#showData').on('click','.item-edit',function(){
      var id = $(this).attr('data');
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Edit Data');
      $('#myForm').attr('action','<?= base_url() ?>Controller_Function/updateData');

      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?= base_url() ?>Controller_Function/editData',
        data: {id: id},
        async: true,
        dataType: 'json',
        success: function(data){
          $('input[name=username').val(data.username);
          $('input[name=email]').val(data.email);
          $('input[name=password]').val(data.password);
          $('input[name=retypePassword]').val(data.password);
          $('input[name=detectId]').val(data.id);
        },
        error: function(){
          alert('Could not Edit Data');
        }
      });
    });

      //Function Delete
  $('#showData').on('click','.item-delete',function(){
    var id = $(this).attr('data');
    $('#deleteModal').modal('show');

    //Prevent Previous Handler - Unbind
    $('#btnDelete').unbind().click(function(){
      $.ajax({
        type: 'ajax',
        method: 'get',
        async: true,
        url: '<?= base_url() ?>Controller_Function/deleteData',
        data: {id: id},
        dataType: 'json',
        success: function(response){
          if(response.success){
            $('#deleteModal').modal('hide');
            $('.alert-success').html('Data deleted successfully').fadeIn().delay(4000).fadeOut('slow');
            showAllData();
          }else{
            alert('Error');
          }
        },
        error: function(){
          alert('Error Deleting');
        }
      });
    });
  });



    //Function Read Data
    function showAllData(){
      $.ajax({
        type: 'ajax',
        url: '<?= base_url() ?>Controller_Function/showAllData',
        async: true,
        dataType: 'json',
        success: function(data){
          var html= '';
          var i;
          for(i=0;i<data.length;i++){
            html += '<tr>' + 
                      '<td>'+data[i].id+'</td>'+
                      '<td>'+'<img src="<?= base_url() ?>Controller_Function/QRcode/'+data[i].email+'">'+'</td>'+
                      '<td>'+data[i].username+'</td>'+
                      '<td>'+data[i].email+'</td>'+
                      '<td>'+
                          '<a href="javascript:;" class="btn btn-info btn-block item-edit" data="'+data[i].id+'">Edit</a> '+
                          '<a href="javascript:;" class="btn btn-danger btn-block item-delete" data="'+data[i].id+'">Delete</a>'+
                      '</td>'+
                      '</tr>';

            }
            $('#showData').html(html);
          },
        error: function(){
          alert('Could not get data from database');
        }
      });
    }
  });




</script>
