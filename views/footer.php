<?php
require __DIR__ . '/../felv/model/SchoolModel.php';
$school_list_model = new felv\model\SchoolModel();
?>

<footer>
  <div class="blocks flex row">
    <section id="contact">
      <h2>Kapcsolat</h2>
      <div class="container">
        <p>Ha kérdése van a felvételivel kapcsolatban keressen bennünket.</p>
        <address>
          <p>Nobel Középiskola</p>
          <p>Felcsút</p>
          <p>Nobel u. 1.</p>
        </address>
        <p class="contact-email">Email: nobel@example.com</p>
        <p class="contact-phone">Telefon: 1-444-555</p>
      </div>
    </section>
  </div>
  <p class="copyright">&copy; <?php echo date("Y"); ?> Nobel Középiskola</p>
</footer>

