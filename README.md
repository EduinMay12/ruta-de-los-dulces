<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🎃 Rutas de los Dulces

**Plataforma web interactiva para explorar, crear y administrar rutas de Halloween.**

Rutas de los Dulces es un sistema desarrollado con **Laravel, PHP, MySQL y JavaScript** que permite a las familias descubrir lugares donde se entregan dulces durante Halloween mediante mapas interactivos y geolocalización.

La plataforma también cuenta con herramientas administrativas para gestionar rutas, destinos, usuarios, roles y permisos.

## 🚀 Características principales

- 🗺️ **Mapa interactivo:** visualización de rutas y destinos mediante Leaflet y OpenStreetMap.
- 📍 **Geolocalización:** permite localizar al usuario y explorar destinos cercanos.
- 🎃 **Gestión de rutas:** creación, edición y administración de rutas de Halloween.
- 🏠 **Gestión de destinos:** registro de lugares, direcciones, coordenadas y estado abierto/cerrado.
- 📊 **Dashboard administrativo:** estadísticas y administración de rutas y destinos.
- 🔐 **Super Admin:** administración de usuarios, roles y permisos.
- 🌙 **Modo día/noche:** interfaz moderna con estilo Liquid Glass.
- 📱 **Diseño responsive:** compatible con computadoras, tabletas y teléfonos.
- 👻 **Experiencia Halloween:** elementos visuales y animaciones temáticas.

## 🛠️ Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| Laravel | Framework backend |
| PHP | Lógica del servidor |
| MySQL | Base de datos |
| Blade | Plantillas y vistas |
| JavaScript | Interactividad |
| Tailwind CSS | Diseño de interfaces |
| Leaflet | Mapas interactivos |
| OpenStreetMap | Cartografía |
| Composer | Dependencias PHP |
| Node.js / NPM | Dependencias frontend |
| Vite | Compilación de recursos |

## 📋 Requisitos previos

Antes de instalar el proyecto, asegúrate de contar con:

- PHP compatible con la versión de Laravel del proyecto.
- Composer.
- MySQL o MariaDB.
- Node.js y NPM.
- Git.
- Extensiones PHP requeridas por Laravel y las dependencias del proyecto.

## 📥 1. Clonar el repositorio

Abre una terminal y ejecuta:

```bash
git clone https://github.com/EduinMay12/ruta-de-los-dulces.git
```

Ingresa al directorio:

```bash
cd ruta-de-los-dulces
```

## 📦 2. Instalar las dependencias

Instala las dependencias del backend:

```bash
composer install
```

Instala las dependencias del frontend:

```bash
npm install
```

## ⚙️ 3. Configurar el entorno

Crea el archivo de configuración a partir del ejemplo:

**Ubuntu / Linux:**

```bash
cp .env.example .env
```

**Windows (CMD):**

```cmd
copy .env.example .env
```

Genera la clave de la aplicación:

```bash
php artisan key:generate
```

## 🗄️ 4. Crear la base de datos MySQL

Accede a MySQL desde la terminal:

```bash
mysql -u root -p
```

Crea una nueva base de datos:

```sql
CREATE DATABASE rutas_dulces
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Comprueba que se haya creado:

```sql
SHOW DATABASES;
```

Sal de MySQL:

```sql
EXIT;
```

## 🔧 5. Configurar la conexión a MySQL

Abre el archivo `.env` y configura los datos de conexión:

```env
APP_NAME="Rutas de los Dulces"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rutas_dulces
DB_USERNAME=root
DB_PASSWORD=
```

**Importante:** reemplaza `DB_USERNAME` y `DB_PASSWORD` por las credenciales de tu instalación de MySQL. Si tu usuario tiene contraseña, debes especificarla.

Limpia la configuración en caché:

```bash
php artisan config:clear
```

## 🏗️ 6. Ejecutar las migraciones

Crea las tablas del sistema:

```bash
php artisan migrate
```

Si el proyecto incluye seeders para generar datos iniciales:

```bash
php artisan db:seed
```

También puedes ejecutar ambos procesos en una instalación nueva:

```bash
php artisan migrate --seed
```

Los seeders deben estar configurados previamente en el proyecto. Si no existen, ejecuta únicamente las migraciones.

**Advertencia:** evita `php artisan migrate:fresh` en una base de datos con información importante, porque elimina todas las tablas antes de volver a crearlas.

## 📁 7. Configurar el almacenamiento

Crea el enlace simbólico para acceder a los archivos públicos:

```bash
php artisan storage:link
```

En Ubuntu, verifica que Laravel tenga permisos de escritura en `storage` y `bootstrap/cache`.

## ▶️ 8. Ejecutar el sistema

Abre dos terminales dentro del directorio del proyecto.

**Terminal 1 — Servidor Laravel**

```bash
php artisan serve
```

**Terminal 2 — Servidor Vite**

```bash
npm run dev
```

Abre el navegador:

**http://127.0.0.1:8000**

La aplicación estará disponible mientras ambos procesos estén ejecutándose.

### Alternativa: compilar los recursos frontend

Si prefieres generar los archivos CSS y JavaScript:

```bash
npm run build
```

Después inicia Laravel:

```bash
php artisan serve
```

## 📱 9. Ejecutar desde un teléfono en la misma red

Para probar la aplicación desde otro dispositivo conectado a la misma red Wi-Fi:

**1. Consulta la IP local del equipo (Ubuntu):**

```bash
hostname -I
```

**2. Inicia Laravel escuchando en todas las interfaces:**

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

**3. Compila los recursos frontend:**

```bash
npm run build
```

**4. Abre desde tu teléfono:**

```text
http://IP-DE-TU-PC:8000
```

Ejemplo:

```text
http://192.168.1.100:8000
```

La dirección IP es ilustrativa y debe reemplazarse por la IP real del equipo.

**Nota:** la geolocalización del navegador puede requerir HTTPS en dispositivos móviles. El servidor de desarrollo no debe exponerse directamente a Internet.

## 🧭 10. Módulos del sistema

### 🌐 Área pública

Permite a los visitantes consultar las rutas registradas, explorar destinos en el mapa y visualizar la información de los lugares participantes.

### 🎃 Panel administrativo

Permite gestionar rutas, registrar destinos, establecer coordenadas geográficas y consultar estadísticas del sistema.

### 🔐 Super Admin

Proporciona funciones de administración general para usuarios, roles, permisos y control de acceso.

## 🧪 Comandos útiles

**Limpiar cachés de Laravel:**

```bash
php artisan optimize:clear
```

**Consultar las rutas registradas:**

```bash
php artisan route:list
```

**Verificar el estado de las migraciones:**

```bash
php artisan migrate:status
```

**Ejecutar pruebas automatizadas:**

```bash
php artisan test
```

## 🔄 Actualizar el proyecto desde GitHub

Para descargar cambios del repositorio:

```bash
git pull origin main
```

Si se actualizaron las dependencias o las migraciones:

```bash
composer install
npm install
php artisan migrate
npm run build
php artisan optimize:clear
```

## 🔒 Seguridad

- No publiques el archivo `.env`.
- No compartas contraseñas ni credenciales de MySQL.
- Mantén actualizadas las dependencias.
- Utiliza `APP_DEBUG=false` en producción.
- Configura permisos adecuados para usuarios y administradores.
- Realiza copias de seguridad de la base de datos.

## 👨‍💻 Autor

**Eduin May**

Desarrollador de software enfocado en aplicaciones web, backend, APIs REST y bases de datos.

GitHub: [@EduinMay12](https://github.com/EduinMay12)

## 📄 Licencia

Proyecto desarrollado con fines educativos, tecnológicos y comunitarios. Consulta el archivo `LICENSE`, si está disponible, para conocer los términos de uso.

---

🎃 **Rutas de los Dulces — Una experiencia interactiva para disfrutar Halloween.** 👻