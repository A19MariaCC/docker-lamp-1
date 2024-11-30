<div class="mb-3">           
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="apellidos">Apellidos:</label><br>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? htmlspecialchars($apellidos) : '' ?>" required>
</div>
<div class="mb-3">  
    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" value="<?php echo isset($contrasena) ? htmlspecialchars($contrasena) : '' ?>" required>
</div>
    