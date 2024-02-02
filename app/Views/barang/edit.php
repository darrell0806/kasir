<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Edit Data <?=$title?></h3>
					<p class="text-subtitle text-muted">
						Silakan Edit Data <?=$title?>
					</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav
					aria-label="breadcrumb"
					class="breadcrumb-header float-start float-lg-end"
					>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?=base_url('login/dashboard')?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Edit Data <?=$title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<form action="<?= base_url('barang/aksi_edit/')?>" method="post" class="row g-3" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $jojo->id_barang ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="logo_website" class="form-label">Foto Barang</label>
								<div class="mb-3">
									<div class="custom-file">
										<div class="col-12 col-md-12">
											<input type="file" class="logo-perusahaan" id="logo_website" name="fotob" accept="image/*" onchange="previewImage()">
										</div>
									</div>
									<input type="hidden" name="old_logo_website" value="<?= $jojo->fotob ?>">
								</div>
								<div id="preview">
									<?php if ($jojo->fotob): ?>
										<img src="<?=base_url('images/'. $jojo->fotob)?>" width="25%">
									<?php endif; ?>
								</div>
							</div>

						

							<div class="mb-3">
								<label for="nama_website" class="form-label">Nama Barang</label>
								<input type="text" class="form-control" id="nama_Barang" placeholder="Masukkan Nama Website" name="nama_brg" value="<?php echo $jojo->nama_brg ?>" required>
							</div>
                            <div class="mb-3">
								<label for="nama_website" class="form-label">Stock</label>
								<input type="text" class="form-control" id="nama_Barang" placeholder="Masukkan Stock" name="stock" value="<?php echo $jojo->stock ?>" required>
							</div>
                            <div class="mb-3">
								<label for="nama_website" class="form-label">Harga</label>
								<input type="text" class="form-control" id="nama_Barang" placeholder="Masukkan Harga" name="harga" value="<?php echo $jojo->harga ?>" required>
							</div>
						</div>
					</div>

					<!-- bagian tombol submit -->
					<div class="col-12">
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-0 col-md-offset-0">
								<a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
					<!-- bagian tombol submit -->
				</form>
			</div>


			<script>
				function previewImage() {
					var preview = document.querySelector('#preview');
					var file = document.querySelector('#foto').files[0];
					var reader = new FileReader();

					reader.addEventListener("load", function () {
						var image = new Image();
						image.src = reader.result;
						image.style.width = '25%';
						preview.innerHTML = '';
						preview.appendChild(image);
					}, false);

					if (file) {
						reader.readAsDataURL(file);
					}
				}
			</script>

		</body>
		</html>