<?php
  $page_title = 'Edit Supplier';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all Suppliers.
  $supplier = find_by_id('Suppliers',(int)$_GET['id']);
  if(!$supplier){
    $session->msg("d","Missing supplier id.");
    redirect('supplier.php');
  }
?>

<?php
if(isset($_POST['edit_sup'])){
  $req_field = array('supplier-name');
  validate_fields($req_field);
  $sup_name = remove_junk($db->escape($_POST['supplier-name']));
  if(empty($errors)){
        $sql = "UPDATE Suppliers SET name='{$sup_name}'";
       $sql .= " WHERE id='{$supplier['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Supplier");
       redirect('supplier.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('supplier.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('supplier.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($supplier['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="supplier-name" value="<?php echo remove_junk(ucfirst($supplier['name']));?>">
           </div>
           <button type="submit" name="edit_sup" class="btn btn-primary">Update supplier</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
