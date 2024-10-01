<link rel="stylesheet" href="assets/css/sweetalert2.min.css">
<?php if (isset($_GET['msg'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        title: '<?php echo $_GET['msg'] ?>',
        text: "<?php echo $_GET['msg'] ?> Successfully",
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
<?php } ?>

<?php if (isset($_GET['alrt'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        title: '<?php echo $_GET['alrt'] ?>',
        text: "<?php echo $_GET['alrt'] ?>",
        icon: 'warning',
        timer: 3500,
        showConfirmButton: false
    });
});
</script>
<?php } ?>


<?php if (isset($_GET['del'])) { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        title: '<?php echo $_GET['del'] ?>',
        text: "<?php echo $_GET['del'] ?> Successfully",
        icon: 'success',
        timer: 2500,
        showConfirmButton: false
    });
});
</script>
<?php } ?>
<script src="assets/js/sweetalert2.js"></script>