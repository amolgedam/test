<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Quotation
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Quotation</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="content-header_button  pull-right">
                          <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Create Quotation</a> 
                        </div>  
                    </div>
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Mail</h4>
      </div>
      <form action="<?= site_url('Quotation/send_mail')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="quot_id" id="quot_id">
          <div class="row">
            <div class="col-md-6">
              To :
              <input type="text" name="to" id="to" class="form-control" placeholder="Recipient mail address" readonly>
            </div>
            <div class="col-md-6">
              From :
              <input type="text" name="from" class="form-control" placeholder="Sender's mail address" value="account@worldplanetesolution.com">
            </div>
            <div class="col-md-12">
              <label>Attachment:</label>
              <input type="file" class="form-control" name="attachment" id="attachment">
            </div>
            <div class="col-md-12">
              Subject :
              <input type="text" name="subject" class="form-control">
              Description :
              <textarea id="editor1" name="description" class="form-control ckeditor description"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Send</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');  ?>
<script type="text/javascript" src="<?= base_url();?>assets/custom_js/quotation.js"></script>