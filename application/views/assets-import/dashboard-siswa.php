<!-- Import CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard.css'); ?>">

<!-- Dropdown script -->
<script>
    $(document).ready(function () {
        $(".ui.toggle.button").click(function () {
            $(".mobile.only.grid .ui.vertical.menu").toggle(100);
        });

        $(".ui.dropdown").dropdown();
    });
</script>
<!-- End Dropdown script -->