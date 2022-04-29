<style>
    .wd{
        margin-left: 2%; width: 100px !important;
    }
</style>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="" id="critShowScoring">
        <label class=""for="score">Sub Criteria</label>
        <label class=""for="score" style="margin-left:72%;">Score</label>
        
      
                    <div class="row">
                        <div class="col-9">
                            <div class="input-group mb-1" style="width:500px;">
                                <div class="input-group-text"></div>
                                <input type="text" class="form-control font-weight-bold" placeholder="" disabled>
                                <input type="hidden" name="crit_id[]" value="">
                                
                            </div>
                        </div>
                        <div class="col-3">
                               <input type="number" class="form-control font-weight-bold text-center wd" name="score[]" max="" required>
                        </div>
                    </div>
            
          
        
    </div>
 
    <button class="btn btn-primary btn-sm float-right mt-2 btn-submit" type="submit">Submit</button>
    
    
</form>
<script>
    $('.btn-submit').click(function(e){
			swal ({
			    title: "Are you sure?",
			      text: "Are you sure you want to submit this ?!",
			      icon: "warning",
			      buttons: true,
			      dangerMode: true,
			}).then((result) => {
				if (result) {
					$(this).closest('form').submit();
				}
			})
		});
</script>