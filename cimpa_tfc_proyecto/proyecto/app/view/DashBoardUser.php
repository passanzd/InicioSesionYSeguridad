<?php require_once __DIR__ . '/../util/Auth.php'; ?>

<div class="perfil-layout perfil-actualizado">
    <div class="perfil-info ampliado">
        <div class="icono-usuario"><i class="fa-solid fa-user-large"></i></div>
        <h2>Perfil de Usuario</h2>
        <p><strong>Nombre: </strong><?= htmlspecialchars($_SESSION["NOMBRE"]) ?></p>
        <p><strong>Apellido: </strong><?= htmlspecialchars($_SESSION["APELLIDO"]) ?></p>
        <p><strong>Correo: </strong><?= htmlspecialchars($_SESSION["MAIL"]) ?></p>
        <p><strong>Dirección: </strong> <?= htmlspecialchars($_SESSION["DIRECCION"]) ?></p>
        <p><strong>Teléfono: </strong><?= htmlspecialchars($_SESSION["TELEFONO"]) ?></p>
        <div class="perfil-botones">
            <button class="btn editar">Editar datos</button>
            <form method="POST" action="/cimpa_tfc_proyecto/proyecto/public/index.php?action=delete_user">
                <button type="button" class="btn baja" onclick="openModalBaja()">Darse de baja</button>
            </form>
        </div>
    </div>
    <div class="tarjetas-menu">
        <div class="card-opcion">
            <i class="fa-solid fa-recycle"></i>
            <span>ECOOFFICE</span>
        </div>
        <div class="card-opcion">
            <i class="fa-solid fa-store"></i>
            <span>ECOTIENDA</span>
        </div>
        <div class="card-opcion">
            <i class="fa-solid fa-chart-line"></i>
            <span>ESTADÍSTICAS</span>
        </div>
        <div class="card-opcion">
            <i class="fa-solid fa-bullseye"></i>
            <span>GEOUAX</span>
        </div>
        <div class="card-opcion">
            <i class="fa-solid fa-camera"></i>
            <span>FOTOGRAFÍA RSC</span>
        </div>
        <form action="/cimpa_tfc_proyecto/proyecto/app/controller/Logout.php" method="POST">
            <button class="card-opcion cerrar-sesion" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</div>

<!-- Modal para editar usuario -->
<div id="editModal" class="modal" style="display:none;">
    <div class="modal-contenido">
        <h3>Editar tus datos</h3>
        <form id="formEditar" method="POST" action="/cimpa_tfc_proyecto/proyecto/public/index.php?action=edit_user">
            <div class="input-group">
                <label>Correo electrónico:</label>
                <input type="email" name="mail" value="<?= htmlspecialchars($_SESSION['MAIL']) ?>" required>
            </div>
            <div class="input-group">
                <label>Dirección:</label>
                <input type="text" name="direccion" value="<?= htmlspecialchars($_SESSION['DIRECCION']) ?>" required>
            </div>
            <div class="input-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($_SESSION['TELEFONO']) ?>" required>
            </div>
            <div class="perfil-botones">
                <button type="submit" class="btn editar">Guardar cambios</button>
                <button type="button" class="btn baja" onclick="closeModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal personalizado para darse de baja -->
<div id="modalBaja" class="modal" style="display:none;">
    <div class="modal-contenido">
        <h3>¿Estás seguro?</h3>
        <p>Esta acción eliminará permanentemente tu cuenta.</p>
        <div class="perfil-botones">
            <form method="POST" action="/cimpa_tfc_proyecto/proyecto/public/index.php?action=delete_user">
                <button type="submit" class="btn baja">Sí, eliminar cuenta</button>
            </form>
            <button class="btn editar" onclick="closeModalBaja()">Cancelar</button>
        </div>
    </div>
</div>