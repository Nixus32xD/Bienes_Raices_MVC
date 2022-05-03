<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach ($errores as $error) : ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>

    <?php endforeach; ?>
    <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input data-cy="email-login" type="email" name="email" placeholder="Tu E-mail" id="email">
            <label for="password">Password</label>
            <input data-cy="password-login" type="password" name="password" placeholder="Tu password" id="password">

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </fieldset>
    </form>
</main>