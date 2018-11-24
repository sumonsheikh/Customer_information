<?php 
include('../controller/server.php');
include('../controller/config.php');
	if (isset($_GET['edit'])) {
		$cid = $_GET['edit'];
		$update = true;
		$record = mysqli_query($myconn, "SELECT * FROM customer_info WHERE cid=$cid");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$customerName = $n['customerName'];
			$address = $n['address'];
			$email=$n['email'];
			$phone=$n['phone'];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="../model/login.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
	</div>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($myconn, "SELECT * FROM customer_info"); ?>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Phone</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['customerName']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['cid']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="../controller/server.php?del=<?php echo $row['cid']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
	


<form method="post" action="../controller/server.php" >

	<input type="hidden" name="cid" value="<?php echo $cid; ?>">

	<div class="input-group">
		<label>Name</label>
		<input type="text" name="customerName" value="<?php echo $customerName; ?>">
	</div>
	<div class="input-group">
		<label>Address</label>
		<input type="text" name="address" value="<?php echo $address; ?>">
	</div>
	<div class="input-group">
		<label>Eamil</label>
		<input type="text" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Phone</label>
		<input type="text" name="phone" value="<?php echo $phone; ?>">
	</div>
	<div class="input-group">

		<?php if ($update == false): ?>
			<button class="btn" type="submit" name="save" >Save</button>
		<?php else: ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
		<?php endif ?>
	</div>
</form>
</body>
</html>