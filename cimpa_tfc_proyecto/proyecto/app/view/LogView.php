<?php require_once __DIR__ . '/../util/Auth.php'; ?>
<div class="admin-panel-wrapper">
    <div class="admin-header-unificado">
        <div class="admin-indicador">Panel de Administración</div>
        <div class="admin-busqueda">
            <button class="toggle-busqueda" type="button"></button>
            <input type="text" id="campo-busqueda" placeholder="Buscar usuario..." class="visible">
        </div>

        <form action="/cimpa_tfc_proyecto/proyecto/public/index.php" method="GET" class="form-logs">
            <input type="hidden" name="action" value="dashboard_admin">
            <button type="submit" class="btn-logs">
                <i class="fa-solid fa-users"></i> Usuarios
            </button>
        </form>
        <form action="/cimpa_tfc_proyecto/proyecto/app/controller/logout.php" method="POST" class="cerrar-sesion-form">
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
                    <th>IP</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= htmlspecialchars($log['id']) ?></td>
                        <td><?= htmlspecialchars($log['ip']) ?></td>
                        <td><?= htmlspecialchars($log['fecha']) ?></td>
                        <td><?= htmlspecialchars($log['resultado']) ?></td>
                        <td><?= htmlspecialchars($log['NOMBRE']) ?></td>
                        <td><?= htmlspecialchars($log['APELLIDO']) ?></td>
                        <td><?= htmlspecialchars($log['MAIL']) ?></td>
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