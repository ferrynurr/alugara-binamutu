<html>
<head>

<title>LAPORAN UPI</title>
</head>
<style type="text/css">
body {
  font-family: "Roboto", "Helvetica", "Arial", sans-serif;
}
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color:  #6dbbcb;
  color: white;
}
</style>
<body>

      <center>
      <H4>DINAS KELAUTAN DAN PERIKANAN JAWA TIMUR</H4>
      <p>LAPORAN UPI</p>
      </center>
        <br/><br/>
        
          <table >
                    <tr>
                       <th style="text-align:center;">NAMA UPI</th>
                       <th style="text-align:center;">ALAMAT</th>
                       <th style="text-align:center;">NO.TELP</th>
                       <th style="text-align:center;">EMAIL</th>
                       <th style="text-align:center;">JENIS UPI</th>
                       <th style="text-align:center;">GRADE</th>

                    </tr>
                  <?php
                   foreach ($data_pdf as $dt) {
                       ?>
                       <tr>
                           <td style="text-align: center;"><?php echo $dt->nama_upi; ?></td>
                           <td style="text-align: center;"><?php echo $dt->alamat; ?></td>
                           <td style="text-align: center;"><?php echo $dt->no_telp; ?></td>
                           <td style="text-align: center;"><?php echo $dt->email; ?></td>
                           <td style="text-align: center;"><?php echo $dt->nama_upi_jenis; ?></td>
                           <td style="text-align: center;"><?php echo $dt->peringkat; ?></td>
                       </tr>

                   <?php } ?>
              
            </table>
  
</body>
</html>
