# Scripts SQL para la Base de Datos hermes002

Este archivo contiene instrucciones y consultas SQL que deben ejecutarse en la base de datos `hermes002` para realizar actualizaciones o modificaciones específicas.

**¡IMPORTANTE!**

* Asegúrate de estar conectado a la base de datos `hermes002` antes de ejecutar estas consultas.
* Realiza una copia de seguridad de la base de datos antes de ejecutar cualquier script, por si acaso necesitas revertir los cambios.
* Ejecuta las consultas en el orden en que aparecen en este archivo, si el orden es relevante.

## Consultas y Procedimientos

### Agregar columna `condicion` a la tabla `usuarios`

Se debe agregar una columna llamada `condicion` de tipo `ENUM` a la tabla `usuarios`, ubicada después de la columna `estado`. Los posibles valores son `'penalizado'`, `'advertido'` y `'en_regla'`, siendo `'en_regla'` el valor por defecto.

```sql
ALTER TABLE usuarios
ADD COLUMN condicion ENUM('penalizado', 'advertido', 'en_regla') NOT NULL DEFAULT 'en_regla'
AFTER estado;
```

### Encriptación de claves para usuarios

Se recomienda almacenar las contraseñas de los usuarios encriptadas utilizando el algoritmo bcrypt. A continuación se muestran los valores encriptados para las contraseñas de ejemplo:

- **admin123**  
  Valor encriptado:  
  `$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S`

- **clave123**  
  Valor encriptado:  
  `$2a$07$asxx54ahjppf45sd87a5auPSL9GB5Ad5sH/D3rUMKo4UJe4U/qGLO`

#### Consultas SQL para actualizar las contraseñas en la tabla `usuarios`

```sql
-- Asignar clave encriptada para el usuario administrador : clave=admin123
UPDATE usuarios
SET clave = '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S'
WHERE nombre = 'admin';

-- Asignar clave encriptada para los demás usuarios excepto para el admin clave=clave123
UPDATE usuarios
SET clave = '$2a$07$asxx54ahjppf45sd87a5auPSL9GB5Ad5sH/D3rUMKo4UJe4U/qGLO'
WHERE nombre <> 'admin';


Asegúrate de que la columna `clave` en la tabla `usuarios` tenga suficiente longitud para almacenar los hashes bcrypt (al menos `VARCHAR(200)`).

### Agregar columna `foto` a la tabla `usuarios`

Se debe agregar una columna llamada `foto` de tipo `VARCHAR(100)` a la tabla `usuarios`, ubicada después de la columna `genero`.

```sql
ALTER TABLE usuarios
ADD COLUMN foto VARCHAR(100) AFTER genero;
```

### Ruta por defecto para la foto de usuario

Al crear un nuevo usuario, el valor por defecto de la columna `foto` debe ser:  
`vistas/img/usuarios/default/anonymous.png`

### Creación automática de carpetas para fotos de usuario

Cuando se crea un usuario nuevo:
- Se debe crear automáticamente la carpeta `img` dentro de la carpeta `vistas` si no existe.
- Dentro de `img`, se debe crear la carpeta `usuarios`.
- Dentro de `usuarios`, se debe crear una carpeta con el número de documento del usuario.
- En esa carpeta es donde se almacenará la foto del usuario.

### Ejemplo de actualización de datos

```sql
-- Ejemplo: Actualizar la ruta de la foto para todos los usuarios existentes
UPDATE usuarios
SET foto = 'vistas/img/usuarios/default/anonymous.png';
```


### Espacio para la instrucciones de auditoria 

