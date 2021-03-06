<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Items
        <span class="pull-right">Inventory Total: Rp. <span id="total"><?php echo $total; ?></span></span>
        </h1> 
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
</div>
<div class="row">
 <div class="col-lg-12">
     <div class="panel panel-default">
         <div class="panel-heading">
             Items List
         </div>

         <!-- /.panel-heading -->
         <div class="panel-body">
             <table class="table table-responsive table-hover table-bordered" id="item_tbl">
             		<thead>
             			<tr>
 
             				<th width="20%">Item Name</th>
             				<th width="13%">Category</th> 
             				<th width="12%">Price</th>
                            <th width="10%">Quantity</th>
                            <th width="12%">Total</th>
                            <th width="13%">Supplier</th>
             				<th width="10%">Status</th>
             				<th width="10%">Action</th>
             			</tr>
             		</thead>
             		<tbody>
             			<?php foreach ($items as $key => $item): ?>
             				<?php 
                                $stocks = $orderingLevel->getQuantity($item->id)->quantity; 
                                $item_price = $price->getPrice($item->id);
                                $capital = $item_price * $stocks;
                            ?>
                            <tr>
                 	 
                 				<td><?php echo $item->name ?></td>
                 				<td><?php echo $categoryModel->getName($item->category_id); ?></td> 
                 				<td><?php echo 'Rp. '. number_format($item_price) ?></td>
                                <td><?php echo $orderingLevel->getQuantity($item->id)->quantity ? $orderingLevel->getQuantity($item->id)->quantity : 'Out of stock'; ?></td>
                                <td><?php echo 'Rp. '. number_format($capital) ?></td>
                                <td><?php echo $item->supplier_name; ?></td>
                 				<td><?php echo $stocks <= 0 ? '<span class="badge bg-danger">Stock Out</span>' : ($stocks <= $item->status ? '<span class="badge badge-success">Needs restock</span>' : '<span class="badge badge-success">Available</span>') ?></td>
                 				<td>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-primary btn-sm">Actions <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                            <a href='<?php echo base_url("items/stock-in/$item->id") ?>'>
                                            <i class="fa fa-plus"></i> Stock In</a></li>
                                            <li><a href='<?php echo base_url("items/edit/$item->id") ?>'><i class="fa fa-edit"></i> Edit</a> </li>
                                            <li>
                                                <a  class="delete-item" href='#' data-link="<?php echo base_url('ItemController/delete/') ?>" data-id="<?php echo $item->id; ?>">
                                                <i class="fa fa-trash"></i>
                                                Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                 			<?php endforeach; ?>
                            </tr>
             		</tbody>
             </table>
         </div>
         <!-- /.panel-body -->
     </div>
     <!-- /.panel -->
 </div>
 <!-- /.col-lg-12 -->
</div>
 