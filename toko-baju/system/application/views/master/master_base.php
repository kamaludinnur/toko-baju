<html>

    <head>
        <base href="<?php echo base_url(); ?>"/>
        <title><?php echo $title; ?></title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.uitablefilter.js"></script>

    </head>

    <body>
        <h1>Toko Baju Kompugel</h1>

        <hr/>

        <?php $this->load->view('master/' . $view_konten); ?>
    </body>

</html>

