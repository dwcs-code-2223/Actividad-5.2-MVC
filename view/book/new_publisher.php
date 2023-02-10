<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>


<form method="post" 
      action="FrontController.php?controller=Book&action=addPublisher"
      >
  <div class="mb-3">
    <label for="publisher" class="form-label">Editorial</label>
    <input 
        name="publisher"
        type="text" class="form-control" id="publisher" required >
   
  </div>
  
  <button type="submit" class="btn btn-primary">Crear</button>
</form>

<?php 
if (isset($dataToView["data"])) {
    echo $dataToView["data"];
}
?>
