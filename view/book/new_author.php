<form class='form-control' method="post" action="FrontController.php?controller=Book&action=addAuthor">
    <div>
        <label for="first" class="form-label col-3">Nombre</label>
        <input name="first" type="text" class="form-control col-9" id="first" 
               required pattern="^(?!\s*$).+"
               />
        <!--https://stackoverflow.com/questions/3085539/regular-expression-for-anything-but-an-empty-string-->
    </div>
    <div>
        <label for="middle" class="form-label col-3">Segundo nombre</label>
        <input name="middle" type="text" class="form-control col-9" id="middle" pattern="^(?!\s*$).+"
               />
    </div>

    <div>
        <label for="last" class="form-label col-3">Apellidos</label>
        <input name="last" type="text" class="form-control col-9" id="last" pattern="^(?!\s*$).+"
               required/>
    </div>


    <div>
        <label for="bdate" class="form-label col-3">Fecha de nacimiento</label>
        <input name="bdate" type="date" class="form-control col-9" id="bdate" 
               />
    </div>
    <button type="submit" class="btn btn-primary my-3">Crear</button>


</div>
</form>

<?php 
if (isset($dataToView["data"])) {
    echo $dataToView["data"];
}
?>