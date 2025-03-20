<?php
    echo '<script> var sesionIniciada="";  </script>';
    session_destroy();
    echo '<script> window.location = "ingreso";  </script>';