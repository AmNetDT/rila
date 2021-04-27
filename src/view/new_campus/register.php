 <div class="col-sm-3 pt-3 border">
            
            <div class="card-body px-3 text-center">
              
              <p class="login-card-description mt-2">
              Create a new campus</p>
              <form method="POST" action="" class="mb-5" autocomplete="off">
                  <div class="form-group">
                    <label for="name" class="sr-only">Campus Name</label>
                    <input type="text" name="name" value="" id="UserId" 
                    class="form-control" placeholder="Full name" />
                  </div>
                  <div class="form-group">
                    <label for="username" class="sr-only">Location Address</label>
                    <input type="text" name="username" value="" 
                    class="form-control" placeholder="Username" />
                  </div>
                  <div class="form-group">
                    <label for="name" class="sr-only">Telephone</label>
                    <input type="text" name="name" value="" id="UserId" 
                    class="form-control" placeholder="Full name" />
                  </div>
                  <div class="form-group">
                    <label for="username" class="sr-only">Email</label>
                    <input type="text" name="username" value="" 
                    class="form-control" placeholder="Username" />
                  </div>
                  
                  <div id="submitButton">
                  <button type="submit" id="" class="btn btn-primary px-5 mb-3">
  				         Save 
                 </button>
                 <p><?php if(isset($fmsg)){ echo '<div class="alert alert-danger">' . $fmsg .'<div>'; }else if(isset($smsg)){echo $smsg;}; ?></p>
                 </div>
                </form>
                
            </div>
          </div>