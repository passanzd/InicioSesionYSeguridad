# Inicio de sesión y Seguridad
## Definición
Este proyecto es un sistema de registro, inicio de sesión y recuperación de contraseña, que incluye diferenciación de roles y medidas de seguridad como, validación de formularios, verificación en dos pasos (2FA), bloqueo por IP, bloqueo geográfico y control de intentos fallidos. Se ha diseñado siguiendo el patrón de arquitectura MVC con capas de servicios y repositorios.
---
## Tecnologías utilizadas
- PHP 8.2+
- MySQL / MariaDB
- HTML + CSS
- JavaScript
- XAMPP
---
## Funcionalidades
- Registro de usuarios con validación y hashing de contraseñas.
- Inicio de sesión y recuperación de contraseña con verificación 2FA por correo electrónico.
- Bloqueo de cuenta tras varios intentos fallidos (durante 10 minutos)
- Validaciones en formularios.
- Validación de IP contra una lista autorizada.
- Bloqueo geográfico por países permitidos.
- Edición y eliminación de perfil
- Panel de administración para gestionar usuarios
- Registro de logs de acceso.
---
## Cómo usar la aplicación
1. Para iniciar sesión, introducir credenciales correctas y el código de verificación enviado al correo electrónico.
2. Para registrarse, introducir las credenciales necesarias para la identificación como usuario.
3. Para recuperar la contraseña, debes estar registrado e introducir el código de verificación enviado al correo electrónico.
4. Usuarios estándar: editar datos y darse de baja.
5. Administradores: consultar, activar y bloquear usuarios registrados y realizar un seguimiento de logs de inicio de sesión.

