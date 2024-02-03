<!-- add_barang.php -->
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?=$title?></h3>
                    <p class="text-subtitle text-muted">Anda dapat Menambah <?=$title?> di bawah</p>
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
    </div>
    <form action="<?php echo base_url('/penjualan/save') ?>" method="post" id="penjualanForm">
        <!-- Form untuk menambah barang -->
        <div class="card">
            <div class="card-body" id="barang-container">

            </div>
            <button type="button" class="btn btn-success btn-sm mt-2" onclick="addRow()">Tambah</button>
        </div>

        <!-- Form untuk data penjualan -->
        <input type="hidden" name="id_penjualan" value="<?= $id_penjualan ?>">
        <!-- Data penjualan lainnya -->
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>

    <!-- ... -->
    <script>
    function addRow() {
        var container = document.getElementById("barang-container");
        var newRowId = container.children.length; // Generate new row id
        var newCard = document.createElement("div");
        newCard.className = "card-body";

        var newRow = document.createElement("div");
        newRow.className = "form-group";
        newRow.id = "row-" + newRowId;

        var select = document.createElement("select");
        select.name = "id_barang[]";
        select.className = "form-select";
        select.addEventListener('change', function () { updateSubtotal(newRow); });

        var optionDefault = document.createElement("option");
        optionDefault.text = "-PILIH-";
        optionDefault.value = "";
        select.add(optionDefault);

        <?php foreach ($a as $b) : ?>
            var option = document.createElement("option");
            option.text = "<?= $b->nama_brg ?>";
            option.value = "<?= $b->id_barang ?>";
            option.setAttribute('data-harga', '<?= $b->harga ?>');
            select.add(option);
        <?php endforeach; ?>

        var inputJumlah = document.createElement("input");
        inputJumlah.type = "text";
        inputJumlah.name = "jumlah[]";
        inputJumlah.className = "form-control";
        inputJumlah.placeholder = "Jumlah";
        inputJumlah.addEventListener('input', function () { updateSubtotal(newRow); });

        var buttonRemove = document.createElement("button");
        buttonRemove.type = "button";
        buttonRemove.className = "btn btn-danger btn-sm";
        buttonRemove.innerHTML = "Hapus";
        buttonRemove.onclick = function () {
            removeRow(newRowId);
        };

        newRow.appendChild(select);
        newRow.appendChild(inputJumlah);
        newRow.appendChild(buttonRemove);
        newCard.appendChild(newRow);
        container.appendChild(newCard);

        // Inisialisasi Choices.js di elemen baru
        var choicesInstance = new Choices(select, {});
        
        calculateAllSubtotals();
    }

    function removeRow(rowId) {
        var row = document.getElementById("row-" + rowId);
        row.parentNode.removeChild(row);
        calculateAllSubtotals();
    }

    function updateSubtotal(row) {
        if (!row) return;

        var select = row.querySelector('select');
        var inputJumlah = row.querySelector('input[name="jumlah[]"]');
        
        var harga = parseFloat(select.selectedOptions[0].dataset.harga) || 0;
        var jumlah = parseFloat(inputJumlah.value) || 0;

        // Subtotal tidak perlu ditampilkan, hanya untuk perhitungan di server
    }

    function calculateAllSubtotals() {
        var container = document.getElementById("barang-container");
        var rows = container.getElementsByClassName("form-group");
        var total = 0;

        for (var i = 0; i < rows.length; i++) {
            updateSubtotal(rows[i]);
        }
    }
</script>
