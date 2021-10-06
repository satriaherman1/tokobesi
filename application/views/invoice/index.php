<div class="row">
  <div class="col-lg-12">
  <h1 class="page-header">Invoice </h1>
  </div>
  <div class="col-md-12">
      <?php 
       if($this->session->flashdata('successMessage')){
                echo $this->session->flashdata('successMessage');
                $this->session->unset_userdata('successMessage');
                $this->session->unset_userdata('errorMessage');
        }
        else{
            echo $this->session->flashdata('errorMessage');
            $this->session->unset_userdata('errorMessage');
        }
    
      ?>
  </div>
  <!-- /.col-lg-12 -->
</div>
<div class="row">
 <div class="col-lg-12">
   <div class="panel panel-default">
     <div class="panel-heading">
       Invoice List
     </div>
     <!-- /.panel-heading -->
     <div class="panel-body">
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
          <p><?php echo $this->session->flashdata('success') ?></p>
        </div>
      <?php endif; ?> 
      <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>
      <table class="table table-striped table-bordered table-hover table-responsive" id="invoice_table">
        <thead>
          <tr>
            <th style="white-space: nowrap;">No Invoice</th>
            <th style="white-space: nowrap;">Suplier</th>
            <th style="white-space: nowrap;">Jumlah Batang Kayu</th> 
            <th style="white-space: nowrap;">Jenis Kayu</th>
            <th style="white-space: nowrap;">Jumlah Volume</th>
            <th style="white-space: nowrap;">Total Pembayaran</th>
            <th style="white-space: nowrap;">PDF</th>
            <th style="white-space: nowrap;">Action</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($invoices as $invoice) :?>
            <tr>
             <td><?= $invoice->invoice_number; ?></td>
             <td><?= $invoice->supplier; ?></td>
             <td><?= $invoice->total_log; ?></td>
             <td><?= $invoice->log_type; ?></td>
             <td><?= $invoice->total_volume; ?></td>
             <td><?= $invoice->total_paid; ?></td>
             <td><button class="btn btn-warning btn-sm edit" onclick="setPdfUrl('<?= $invoice->id ?>')" data-toggle="modal" data-target="#pdf-invoice" data-id="<?= $invoice->id ?>">Pdf</button>
               </td>
             <td>
               <button class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#edit-invoice" data-id="<?= $invoice->id ?>">Edit</button>
               
               <a onclick="return window.confirm('Yakin mau dihapus?');" class="btn btn-danger btn-sm" href="<?= base_url('invoice/delete/' . $invoice->id ) ?>">Delete</a>
             </td>
           </tr>
            <?php endforeach; ?>
       </tbody>
     </table>
   </div>
   <!-- /.panel-body -->
 </div>
 <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>



<div id="addInvoiceModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Invoice</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('invoice/insert') ?>">
        	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[invoice_number]" placeholder="No Invoice">
        	</div>
        	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[supplier]" placeholder="Supplier">
        	</div>
        	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[total_log]" placeholder="Jumlah Kayu">
        	</div>
        	<div class="form-group">
        		<select required="required" type="text" class="form-control" name="invoice[log_type]" placeholder="Jenis Kayu">
                    <?php foreach($log_categories as $categorie) : ?>
                        <option value="<?= $categorie->name ?>"><?= $categorie->name ?></option>
                    <?php endforeach ;?>
                </select>
        	</div>
            <div class="form-group">
                <input required="required" type="text" class="form-control" name="invoice[total_volume]" placeholder="Jumlah Volume">
            </div>
            <div class="form-group">
                <input required="required" type="text" class="form-control" name="invoice[total_paid]" placeholder="Jumlah Pembayaran">
            </div>
        	<div class="form-group">
        		<button class="btn btn-success" type="submit">Save</button>
        	</div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="edit-invoice" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Invoice</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('invoice/update') ?>" id="edit-invoice-form">
          <input type="hidden" name="id" id="invoice_id">
         	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[invoice_number]" placeholder="No Invoice">
        	</div>
        	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[supplier]" placeholder="Jumlah Kayu">
        	</div>
        	<div class="form-group">
        		<input required="required" type="text" class="form-control" name="invoice[total_log]" placeholder="Jumlah Kayu">
        	</div>
        	<div class="form-group">
        		<div class="form-group">
                    <select required="required" type="text" class="form-control" name="invoice[log_type]" placeholder="Jenis Kayu">
                        <?php foreach($log_categories as $categorie) : ?>
                            <option value="<?= $categorie->name ?>"><?= $categorie->name ?></option>
                        <?php endforeach ;?>
                    </select>
                </div>
        	</div>
            <div class="form-group">
                <input required="required" type="text" class="form-control" name="invoice[total_volume]" placeholder="Jumlah Volume">
            </div>
            <div class="form-group">
                <input required="required" type="text" class="form-control" name="invoice[total_paid]" placeholder="Jumlah Pembayaran">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="pdf-invoice" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"  style="height: 80vh;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Invoice</h4>
      </div>
      <div class="modal-body">
       <embed src="" id="invoiceEmbed" data-url="<?= base_url('invoice/pdf/'); ?>" style="min-height: 400px;" width="100%" type="application/pdf">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  const setPdfUrl = (url) => {
    const embed = document.querySelector('#invoiceEmbed')
    const baseUrl = embed.dataset.url
    embed.src = baseUrl + url
    console.log(embed.url)
  }
</script>