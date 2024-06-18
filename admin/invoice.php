<html>
<head>
	<meta charset="utf-8">
	<title>Invoice</title>
	<link rel="stylesheet" href="style.css">
	<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
		type="text/css" />
	<!-- Ionicons -->
	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
</head>
<!-- <body onload="window.print();"> -->
<body>
	<?php
	ob_start();
	include '../database/config.php';
	// Hotel data fetch 
	$sql = "Select * from hotel";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);
	$id = $_GET['id'];
	$date = date('d-m-Y');
	$sql = "select * from `roombooking_details` where id = '$id' ";
	$re = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($re);
	$cid = $row[1];
	$s = "SELECT * FROM `customer_details` WHERE `UserID` = '$cid';";
	$r = mysqli_query($conn, $s);
	$cinfo = mysqli_fetch_array($r);
	$roomid = $row[2];
	$s1 = "SELECT * FROM `room` WHERE `id` = '$roomid';";
	$r1 = mysqli_query($conn, $s1);
	$rinfo = mysqli_fetch_array($r1);
	?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<br>
<br>
<h1 class="col p-2 pe-3" style="text-align:center;letter-spacing: 0.5em;">INVOICE</h1>
<br>
	<div class="container">
		<div class="row align-items-center align-center">
			<div class="col-6 h-200">
				<img src="http://localhost/hotel-management-system/resources/logo.jpg" class="img-fluid" alt="...">
			</div>
			<div class="col-6">
				<div class="align-items-end">
					</div>
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 m-2" >
					<h6>Invoice No.:</h6>
					<h6>
						<?php echo $id; ?>
					</h6>
				</div>
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6>Due Date.:</h6>
					<h6>
						<?php echo $row[4]; ?>
					</h6>
				</div>
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6>Invoice Date.:</h6>
					<h6>
						<?php echo $row[13]; ?>
					</h6>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<h3 class="ps-3">Billed From</h3>
				<div class="rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6><?php echo $data[1]; ?></h6>
				</div>
				<div class="rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<p><?php echo $data[13]; ?></p>
					<p>+91 <?php echo $data[2]; ?></p>
					<p><?php echo $data[3]; ?></p>
				</div>
			</div>
			<div class="col-6" style="text-align:right;">
				<h3 class="pe-3">Billed To</h3>
				<div class="rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6>
						<?php echo $cinfo[1]; ?>
					</h6>
				</div>
				<div class="rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<p>
					<?php echo $cinfo[2]; ?>
					</p>
					<p>
				+91	<?php echo $cinfo[4]; ?>
					</p>
					<p>
					<?php echo $cinfo[5]; ?>
					</p>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col">
					<table class="table">
						<thead>
							<tr>
								<th>Room Type</th>
								<th>Per Night</th>
								<th>Days</th>
								<th>Other</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<td><span>
										<?php echo $rinfo[1]; ?> Room
									</span></td>
								<td><span>₹</span><span>
								<?php echo $rinfo[5]; ?>
									</span></td>
								<td><span>
								<?php echo $row[5]; ?>
									</span></td>
									<td><span>
								<?php echo ""; ?>
									</span></td>
								<td><span data-prefix>₹</span>
								<span>
								<?php echo $row[6]; ?>
									</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col">
					<table class="table m-auto">
						<thead>
							<tr>
								<th>Subtotal</th>
								<th>Taxes</th>
								<th>Discount</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span data-prefix>₹ </span><?php echo $row[6]; ?></td>
								<td><span data-prefix>0 %</span></td>
								<td><span data-prefix>0 %</span></td>
								<td><span data-prefix>₹ </span><?php echo $row[6]; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> -->
			<br>
			<div class="row align-items-center">
			<div class="col-6">
				<h6 class="m-2">Payment Instrustion or other notes</h6>
				<textarea name="" id="" cols="36" rows="6" class=" rounded border p-3" placeholder="you can make online or offline payment"></textarea>
			</div>
			<div class="col-6">
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6>Total :</h6>
					<h6>
					₹ <?php echo $row[6]; ?>
					</h6>
				</div>
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 align-items-center m-2">
					<h6>Advanced Paid : </h6>
					<h6>
					₹ <?php echo $row[7]; ?>
					</h6>
				</div>
				<br>
				<div class="d-flex justify-content-between rounded border pt-1 pe-3 ps-3 align-items-center m-2" style="background-color: lightblue">
					<?php 
					if($row[8] == 0)
					{
						echo "<h5>Final Amount Paid :</h5>
						<h5>₹ $row[7]</h5>
						";
					}
					else{
echo "<h5>Due Amount :</h5>
<h5>
₹ $row[8]";
					}
					?>
				</div>
			</div>
		</div>
		<script>
	openPrintPreview();
	function openPrintPreview() {
				// Open the print preview
				window.print();
				setTimeout(function () {
                // Redirect to another page
                window.location.href = 'booking-details.php';
            }, 1000);
        }
</script>	
</body>
</html>