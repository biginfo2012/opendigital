<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view('volanty/assetsinclude') ?>
</head>

<body class="index">

  <video loop muted autoplay id="myVideo">
    <source src="<?= base_url('assets/vid/full.mp4') ?>" type="video/mp4">
  </video>
  <div class="top">
    <button id="mute" onclick="mute(); return false;"><i class="fas fa-volume-off"></i></button>
  </div>
  <div class="content text-right">
    <button id="myBtn"><a href="<?= base_url('volanty/agenda') ?>"><i class="fas fa-car"></i> Comprar Minha Revisão <i class="fas fa-angle-right"></i></a></button>
  </div>


</body>

</html>