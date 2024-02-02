<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Input Data <?=$title?></h3>
					<p class="text-subtitle text-muted">
						Silakan Masukkan Data <?=$title?>
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
							Input Data <?=$title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<form action="<?= base_url('barang_masuk/aksi_create/')?>" method="post" class="row g-3" enctype="multipart/form-data">
				<div class="card-body">
					<div class="row">
                    <div class="col-lg-6 col-md-12">	
						
                    <div class="mb-3">
								<label for="jeniskelamin" class="form-label">Barang</label>
								<select class="form-select" id="basicSelect" name="id_barang">
                                        <option>-PILIH-</option>
                                        <?php
                                        foreach ($a as $b) {
                                            ?>
                                            <option value ="<?= $b->id_barang?>"><?php echo $b->nama_brg?>
                                        </option>
                                        <?php } ?>
                                    </select>
							</div>
							

							

							
						</div>
                        <div class="col-md-6">
						<div class="mb-3">
								<label for="nama_perusahaan" class="form-label">Jumlah</label>
								<input type="text" class="form-control" id="nama_perusahaan" placeholder="Masukkan Jumlah" name="jumlah" required>
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