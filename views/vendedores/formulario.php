<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor/a" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="apellido vendedor/a" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Telefono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Telefono del vendedor/a" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>