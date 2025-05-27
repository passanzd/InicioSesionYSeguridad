<?php require_once __DIR__ . '/../util/Auth.php'; ?>
<div class="admin-panel-wrapper">


    <div class="admin-header-unificado">
        <div class="admin-indicador">Panel de Administración</div>

        <div class="admin-busqueda">
            <button class="toggle-busqueda" type="button"></button>
            <input type="text" id="campo-busqueda" placeholder="Buscar usuario..." class="visible">
        </div>

        <form action="/cimpa_tfc_proyecto/proyecto/public/index.php" method="GET" class="form-logs">
            <input type="hidden" name="action" value="logs">
            <button type="submit" class="btn-logs">
                <i class="fa-solid fa-file-lines"></i> Logs
            </button>
        </form>


        <form action="/cimpa_tfc_proyecto/proyecto/app/controller/Logout.php" method="POST" class="cerrar-sesion-form">
            <button type="submit" class="btn-cerrar">
                <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
            </button>
        </form>
    </div>



    <div class="tabla-wrapper">


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['ID_USUARIO']) ?></td>
                        <td><?= htmlspecialchars($usuario['NOMBRE']) ?></td>
                        <td><?= htmlspecialchars($usuario['APELLIDO'] ?? '') ?></td>
                        <td><?= htmlspecialchars($usuario['MAIL']) ?></td>
                        <td><?= htmlspecialchars($usuario['TELEFONO']) ?></td>
                        <td><?= htmlspecialchars($usuario['estado']) ?></td>
                        <td>
                            <form method="POST" action="/cimpa_tfc_proyecto/proyecto/public/index.php?action=change_state" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['ID_USUARIO'] ?>">
                                <input type="hidden" name="nuevo_estado" value="Activado">
                                <button type="submit" class="btn-tabla activar" title="Activar usuario">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>

                            <form method="POST" action="/cimpa_tfc_proyecto/proyecto/public/index.php?action=change_state" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['ID_USUARIO'] ?>">
                                <input type="hidden" name="nuevo_estado" value="Bloqueado">
                                <button type="submit" class="btn-tabla bloquear" title="Bloquear usuario">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tbody id="sin-resultados" style="display:none;">
                <tr>
                    <td colspan="7" style="text-align:center; color: #888;">No se encontraron usuarios con ese criterio.</td>
                </tr>
            </tbody>

        </table>
    </div>
</div>