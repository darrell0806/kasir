<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3><?=$title?></h3>
					<p class="text-subtitle text-muted">Anda dapat melihat <?=$title?> di bawah</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>

		<section class="section">
			<div class="card">
				<div class="card-header">
					<a href="<?php echo base_url('barang/create/')?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i>
					Tambah</button></a>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table1">
							<thead>
								<tr>
									<th>No</th>
                                    <th>Foto</th>
									<th>Nama Barang</th>
                                    <th>Stock</th>
                                    <th>Harga</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php
							$no=1;
							foreach ($jojo as $riz) {
								?>
								<tr>
									<td><?= $no++ ?></td>
                                    <td style="width: 100px; height: 100px; overflow: hidden; border-radius: 5px;">
                                        <img src="<?php echo base_url('images/' . $riz->fotob) ?>" style="width: 100%; height: 100%; object-fit: contain;" alt="Foto">
                                    </td>
									<td><?php echo $riz->nama_brg ?></td>     
                                    <td><?php echo $riz->stock?></td>  
                                    <td><?php echo $riz->harga ?></td>            
									<td>
										<a href="<?php echo base_url('barang/edit/'. $riz->id_barang)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
										<a href="<?php echo base_url('barang/delete/'. $riz->id_barang)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
