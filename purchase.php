<?php
	require_once('./pieces/header.php');
?>
<div class="col-lg-10" id="center">
	<div class="widget animation-fadeInQuick" data-toggle="modal">
		<div class="widget-content">
			<div class="row">
				<?php
					$serv = mysqli_query($sql, 'SELECT * FROM plans ORDER BY PlanID');
					while($row = mysqli_fetch_array($serv)) {
						?>
							<div class="col-xs-2" style="box-shadow: 0px 0px 30px 0px #000; padding: 35px;height: 160; width: 260px; margin: 15px; margin-top: 5px; margin-left: 5px;">
								<div class="text-muted"><em><?php echo $row['PlanName']; ?></em></div>
								<div class="endline"></div>
								<div class="text-danger push-bit" style="margin-top: 15px;">
									Price:<span class="shopElement"><?php echo $row['PlanPrice']; ?>$</span>
								</div>
								<div class="text-danger push-bit">
									Length:<span class="shopElement"><?php echo $row['PlanLength']; ?></span>
								</div>
								<div class="text-danger push-bit">
									Generates:<span class="shopElement">Unlimited</span>
								</div>		
								<form method="POST" action="https://www.paypal.com/cgi-bin/webscr">
									<input type="hidden" name="cmd" value="_xclick">
									<input type="hidden" name="business" value="<?php echo settings::website('PaypalEmail'); ?>">
									<input type="hidden" name="no_shipping" value="1">
									<input type="hidden" name="quantity" value="1">
									<input type="hidden" name="page_style" value="primary">
									<input type="hidden" name="no_note" value="Test this">
									<input type="hidden" name="cancel_return" value="<?php echo settings::website('WebsiteDomain'); ?>checkout.php">
									<input type="hidden" name="return" value="<?php echo settings::website('WebsiteDomain'); ?>checkout.php">
									<input type="hidden" name="notify_url" value="<?php echo settings::website('WebsiteDomain'); ?>checkout.php">
									<input type="hidden" name="lc" value="US">
									<input type="hidden" name="currency_code" value="USD">
									<input type="hidden" name="amount" value="<?php echo $row['PlanPrice']; ?>">
									<input type="hidden" name="item_name" value="<?php echo strtoupper($row['PlanName']); ?> Plan.">
									<input type="hidden" name="item_number" value="<?php echo $row['PlanID']; ?>">
									<input type="hidden" name="custom" value="<?php echo $row['PlanLength']; ?>">
									<input type="submit" name="<?php echo $row['PlanID']; ?>" class="btn btn-info" style="margin-top: 5px; width: 100%;" value="Purchase" />
								</form>
							</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	include('./pieces/footer.php');
?>