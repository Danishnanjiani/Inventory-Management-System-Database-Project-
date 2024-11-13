<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $supplier = find_by_id('Suppliers',(int)$_GET['id']);
  if(!$supplier){
    $session->msg("d","Missing supplier id.");
    redirect('supplier.php');
  }
?>
<?php
  $delete_id = delete_by_id('Suppliers',(int)$supplier['id']);
  if($delete_id){
      $session->msg("s","Supplier deleted.");
      redirect('supplier.php');
  } else {
      $session->msg("d","Supplier deletion failed.");
      redirect('supplier.php');
  }
?>
