<?php
	require_once('./pieces/header.php');
	
	header("Expires: Mon, 26 Jul 2018 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	if(isset($_POST['payment_status']) && $_POST['payment_status'] == 'Completed') {
		$query = mysqli_query($sql, 'SELECT TransactionVerifySign FROM transactions WHERE TransactionVerifySign = "'.$_POST['verify_sign'].'"');
		
		if(mysqli_num_rows($query) > 0) {
			header('Location: index.php');
			exit();
		}
		
		$membership = $_POST['item_number'];
		$membershipname = $_POST['item_name'];
		$length = $_POST['custom'];
		$userid = $_SESSION['auth'];
		
		if($length == 'Daily')
			$time = time() + 86400;
		if($length == 'Weekly')
			$time = time() + 604800;
		if($length == 'Mothly')
			$time = time() + 2678400;
		if($length == 'Lifetime')
			$time = time() + 2147483647;
		
		mysqli_query($sql, 'UPDATE users SET UserMembership = '.$membership.', UserExpire='.$time.' WHERE UserID = '.$userid.'');
		mysqli_query($sql, 'INSERT INTO transactions (TransactionAmount, TransactionVerifySign, TransactionUserID, TransactionPlanID, TransactionDate) VALUES ("'.$_POST['payment_gross'].'", "'.$_POST['verify_sign'].'", "'.$userid.'", "'.$membership.'", "'.time().'")');
?>
	<div class="warper container-fluid">
		<div class="page-header"><h1>Invoice <small>#M</small></h1></div>
		<div class="page-header text-right"><h3 class="no-margn"><?php echo settings::website('WebsiteName'); ?> <small>Pvt. Ltd.</small></h3></div>
		<hr>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Qty</th>
							<th>Plan Name</th>
							<th>Expiration</th>
							<th class="price">Taxed</th>
							<th class="total">Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>			
							<td><?php echo $membershipname; ?></td>
							<td><?php echo $length; ?></td>
							<td class="price">$<?php echo $_POST['payment_gross']; ?></td>
							<td class="total">$<?php echo $_POST['payment_gross']; ?></td>
						</tr>
						<tr>
							<td colspan="3" class="sub_total"></td>
							<td class="sub_total">Subtotal:</td>
							<td class="sub_total">$<?php echo $_POST['payment_gross']; ?></td>
						</tr>
						<tr class="total_bar">
							<td colspan="3" class="grand_total"></td>
							<td class="grand_total">Total:</td>
							<td class="grand_total">$<?php echo $_POST['payment_gross']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 text-right"><button class="btn btn-success" type="button">The invoice is paid.</button></div>
		</div>
	</div>
<?php
	} else {
		header('Location: ./index.php');
		exit();
	}
	
	require_once('./pieces/footer.php');
?>