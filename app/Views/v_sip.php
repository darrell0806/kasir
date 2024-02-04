<style>
  #datatable-buttons {
    width: 76%;
    margin: auto;
    border-collapse: collapse;
    border: 1px solid black; 
  }

  #datatable-buttons th,
  #datatable-buttons td {
    padding: 8px;
    border: 1px solid black; 
  }

  #datatable-buttons th {
    background-color: white;
    color: black;
    text-align: center;
  }

  #datatable-buttons tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
  }

  #datatable-buttons tbody tr:hover {
    background-color: #ddd;
  }
</style>

<table id="datatable-buttons" border="1" width="76%" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>ID Penjualan</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $grandTotal = 0; // Initialize the grand total

    foreach ($duar as $b) {
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $b->id ?> </td>
        <td><?= $b->nama_brg ?> </td>
        <td><?= $b->jumlah ?> </td>
        <td><?= $b->subtotal ?> </td>
      </tr>
      <?php
      $grandTotal += $b->subtotal; // Add the subtotal to the grand total
    } ?>

    <!-- Display the total in a separate row -->
    <tr>
      <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
      <td><?= $grandTotal ?></td>
    </tr>
  </tbody>
</table>

<script>
  window.print();
</script>
