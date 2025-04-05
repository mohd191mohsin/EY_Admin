<div class="page-wrapper">
    <div class="content container-fluid">
        <?php if($this->session->flashdata('unauthorize_error')){  ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $this->session->flashdata('unauthorize_error'); ?>
        </div>
        <?php }?>
        <div class="row">
            <!-- <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon bg-success"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>
                    <div class="dash-widget-info">
                        <h3><?=$totalPages?></h3>
                        <span>Pages</span>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                    <div class="dash-widget-info">
                        <h3><?=$totalAdminUser?></h3>
                        <span>Users</span>
                    </div>
                </div>
            </div>
        </div>                
    </div>
    </div>