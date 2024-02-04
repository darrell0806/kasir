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
      <th>Tanggal</th>
      <th>Total</th>
      <th>Petugas</th>
    </tr>
  </thead>

  <tbody>
  <?php
    $no = 1;
    $grandTotal = 0; // Initialize the grand total

    foreach ($duar as $b) {
  ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td><?php echo $b->tanggal?> </td>
      <td><?php echo $b->total?> </td>
      <td><?php echo $b->nama?> </td>
    </tr>

  <?php
      $grandTotal += $b->total; // Add the total to the grand total
    }
  ?>
    <!-- Display the grand total row at the end -->
    <tr>
      <td colspan="2" style="text-align: right;"><b> Total:</b></td>
      <td><?php echo $grandTotal; ?></td>
      <td></td>
    </tr>
  </tbody>
</table>

<script>
  window.print();
</script>
