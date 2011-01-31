<h2></h2>

<h2>Administrasi</h2>

<ul>
    <li><a href="index.php/master/home/ganti_password">Ganti password admin</a></li>
    <li><a href="index.php/master/home/db_dump">Backup database</a></li>
</ul>

<br/>

<h2>Statistik</h2>

<table class="rounded-corner" style="width: 50%">
    <tr>
        <td>Jumlah produk</td>
        <td><strong><?php echo $this->db->count_all('produk'); ?> produk</strong></td>
    </tr>
    <tr>
        <td>Jumlah merek</td>
        <td><strong><?php echo $this->db->count_all('merek'); ?> merek</strong></td>
    </tr>
    <tr>
        <td>Jumlah model</td>
        <td><strong><?php echo $this->db->count_all('model'); ?> model</strong></td>
    </tr>
    <tr>
        <td>Jumlah agen</td>
        <td><strong><?php echo $this->db->count_all('agen'); ?> agen</strong></td>
    </tr>
</table>