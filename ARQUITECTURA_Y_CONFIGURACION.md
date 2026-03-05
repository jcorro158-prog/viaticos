# 📋 Arquitectura y Configuración del Sistema - Viáticos Alcaldía de Barrancabermeja

## 📖 Información General del Proyecto

### 🏛️ **Datos del Sistema**
- **Nombre:** Sistema de Viáticos Alcaldía de Barrancabermeja
- **Tipo:** Aplicación Web Gubernamental
- **Propósito:** Gestión de viáticos y gastos de funcionarios municipales
- **Framework Base:** Laravel 12.0 con Livewire
- **Fecha de Creación:** Julio 2025

### 🎯 **Objetivos del Sistema**
- Gestión centralizada de viáticos municipales
- Control de gastos de funcionarios públicos
- Auditoría y trazabilidad de transacciones
- Seguridad máxima para recursos públicos

---

## 🏗️ Arquitectura del Sistema

### 📊 **Stack Tecnológico**

#### **Backend**
- **Framework:** Laravel 12.0
- **PHP:** ^8.2
- **Base de Datos:** SQLite (default), configurable a MySQL/PostgreSQL
- **Autenticación:** Microsoft OAuth 2.0 (Azure AD)

#### **Frontend**
- **UI Framework:** Livewire Flux 2.1.1
- **CSS Framework:** Tailwind CSS 4.0.7
- **Build Tool:** Vite 6.0
- **JavaScript:** Vanilla JS + Alpine.js (via Livewire)

#### **Herramientas de Desarrollo**
- **Package Manager:** Composer (PHP) + NPM (JavaScript)
- **Testing:** PHPUnit 11.5.3
- **Code Style:** Laravel Pint 1.18
- **Debugging:** Laravel Pail 1.2.2

---

## 📁 Estructura del Proyecto

### 🗂️ **Estructura de Directorios**

```
viaticosAlcaldia/
├── 📁 app/
│   ├── 📁 Console/Commands/          # Comandos Artisan personalizados
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   └── 📁 Auth/
│   │   │       └── MicrosoftAuthController.php
│   │   └── 📁 Middleware/
│   │       └── EnsureProfileComplete.php    # Middleware personalizado
│   ├── 📁 Livewire/                 # Componentes Livewire
│   │   ├── 📁 Actions/              # Acciones reutilizables
│   │   ├── 📁 Auth/                 # Componentes de autenticación
│   │   ├── 📁 Parameterization/     # Gestión de parámetros
│   │   ├── 📁 Settings/             # Configuración de usuario
│   │   ├── CommissionComponent.php   # Gestión de comisiones
│   │   └── UsersComponent.php       # Gestión de usuarios
│   ├── 📁 Models/
│   │   └── User.php                 # Modelo de usuario principal
│   └── 📁 Providers/                # Service Providers
├── 📁 config/                       # Configuraciones
├── 📁 database/
│   ├── 📁 migrations/               # Migraciones de BD
│   ├── 📁 factories/                # Factory para testing
│   └── 📁 seeders/                  # Datos iniciales
├── 📁 resources/
│   ├── 📁 views/                    # Vistas Blade
│   ├── 📁 css/                      # Estilos
│   ├── 📁 js/                       # JavaScript
│   └── 📁 lang/                     # Internacionalización (ES/EN)
├── 📁 routes/                       # Definición de rutas
└── 📁 storage/                      # Archivos y logs
```

---

## ⚙️ Configuración Técnica

### 🔧 **Dependencias Principales**

#### **PHP Dependencies (composer.json)**
```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "laravel/socialite": "*",
        "livewire/flux": "^2.1.1",
        "livewire/volt": "^1.7.0",
        "socialiteproviders/microsoft": "^4.6"
    }
}
```

#### **JavaScript Dependencies (package.json)**
```json
{
    "dependencies": {
        "@tailwindcss/vite": "^4.0.7",
        "tailwindcss": "^4.0.7",
        "vite": "^6.0",
        "axios": "^1.7.4"
    }
}
```

### 🗄️ **Configuración de Base de Datos**

#### **Conexión Default**
- **Motor:** SQLite (desarrollo)
- **Ubicación:** `database/database.sqlite`
- **Configuración:** `config/database.php`

#### **Migraciones Disponibles**
```
✅ 0001_01_01_000000_create_users_table.php          # Tabla usuarios base
✅ 0001_01_01_000001_create_cache_table.php          # Sistema de caché
✅ 0001_01_01_000002_create_jobs_table.php           # Cola de trabajos
✅ 2025_07_02_003735_add_microsoft_fields_to_users_table.php    # Campos Microsoft OAuth
✅ 2025_07_10_194700_add_missing_columns_in_users.php          # Campos adicionales perfil
```

#### **Esquema de Usuario**
```sql
users:
├── id (Primary Key)
├── name (Nombres)
├── surname (Apellidos)
├── email (Email único)
├── dni (Cédula única)
├── cellphone (Teléfono)
├── address (Dirección)
├── microsoft_id (ID Microsoft único)
├── avatar (Avatar URL)
├── email_verified_at
├── password (Encriptado)
└── timestamps
```

---

## 🔐 Seguridad y Autenticación

### 🛡️ **Sistema de Autenticación**

#### **Microsoft OAuth 2.0**
- **Proveedor:** Azure AD (Microsoft Entra ID)
- **Scopes:** `openid profile email`
- **Configuración:** `config/services.php`

```php
'microsoft' => [
    'client_id' => env('MICROSOFT_CLIENT_ID'),
    'client_secret' => env('MICROSOFT_CLIENT_SECRET'),
    'redirect' => env('MICROSOFT_REDIRECT_URI'),
    'tenant' => env('MICROSOFT_TENANT_ID', 'common'),
    'include_tenant_info' => true,
],
```

#### **Flujo de Autenticación**
```
1. Usuario → /auth/microsoft
2. Redirección → Microsoft Login
3. Callback → /auth/microsoft/callback
4. Creación/Actualización Usuario
5. Autenticación Laravel
6. Redirección → Dashboard
```

#### **Seguridad Implementada**
- ✅ **Forzar Re-autenticación**: `prompt=login` + `max_age=0`
- ✅ **Perfil Obligatorio**: Middleware `EnsureProfileComplete`
- ✅ **Registro Único**: Solo vía Microsoft OAuth
- ✅ **Verificación Email**: Automática via Microsoft

---

## 🔒 Middleware de Seguridad

### 🛡️ **EnsureProfileComplete**

#### **Propósito**
Garantiza que usuarios tengan perfil completo antes de acceder al sistema.

#### **Campos Requeridos**
- ✅ Nombres (`name`)
- ✅ Apellidos (`surname`)
- ✅ Cédula (`dni`)
- ✅ Teléfono (`cellphone`)
- ✅ Dirección (`address`)

#### **Rutas Protegidas**
```php
// Requieren perfil completo
'dashboard'           → middleware: ['auth', 'verified', 'profile.complete']
'usuarios'            → middleware: ['auth', 'profile.complete']
'comisiones'          → middleware: ['auth', 'profile.complete']
'parametrizacion/*'   → middleware: ['auth', 'profile.complete']
```

#### **Rutas Exentas**
```php
// No requieren perfil completo
'settings/*'          → Configuración de perfil
'logout'              → Cerrar sesión
'auth/microsoft/*'    → Autenticación
'login'               → Login
'register'            → Registro
```

---

## 🎨 Interfaz de Usuario

### 🎯 **Componentes Livewire**

#### **Autenticación**
- `Login.php` - Pantalla de login
- `Register.php` - Registro (deshabilitado)
- `ForgotPassword.php` - Recuperar contraseña
- `ResetPassword.php` - Reset contraseña

#### **Configuración**
- `Profile.php` - Gestión de perfil completo
- `Password.php` - Cambio de contraseña
- `Appearance.php` - Configuración visual

#### **Funcionales**
- `UsersComponent.php` - Gestión de usuarios
- `CommissionComponent.php` - Gestión de comisiones
- `ParameterizationComponent.php` - Configuración del sistema

#### **Parametrización**
- `JobPositionComponent.php` - Puestos de trabajo
- `DependenciesComponent.php` - Dependencias municipales
- `OfficeComponent.php` - Cargos administrativos

### 🎨 **Diseño UI**

#### **Framework CSS**
- **Base:** Tailwind CSS 4.0.7
- **Componentes:** Livewire Flux 2.1.1
- **Responsive:** Mobile-first design
- **Tema:** Profesional gubernamental

#### **Internacionalización**
- ✅ **Español** (es) - Idioma principal
- ✅ **Inglés** (en) - Idioma secundario
- **Archivos:** `lang/es/` y `lang/en/`

---

## 🚀 Rutas del Sistema

### 🔗 **Rutas Principales**

#### **Públicas**
```php
GET  /                     → welcome.blade.php
GET  /login                → Livewire\Auth\Login
```

#### **Autenticación Microsoft**
```php
GET  /auth/microsoft           → MicrosoftAuthController@redirectToMicrosoft
GET  /auth/microsoft/callback  → MicrosoftAuthController@handleMicrosoftCallback
POST /logout                   → Livewire\Actions\Logout
```

#### **Protegidas (Requieren perfil completo)**
```php
GET  /dashboard                → dashboard.blade.php
GET  /usuarios                 → UsersComponent
GET  /comisiones               → CommissionComponent
GET  /parametrizacion          → ParameterizationComponent
GET  /parametrizacion/puestos  → JobPositionComponent
GET  /parametrizacion/dependencias → DependenciesComponent
GET  /parametrizacion/cargos   → OfficeComponent
```

#### **Configuración (Exentas de perfil completo)**
```php
GET  /settings/profile     → Settings\Profile
GET  /settings/password    → Settings\Password
GET  /settings/appearance  → Settings\Appearance
```

---

## 📊 Flujos de Trabajo

### 🔄 **Flujo de Primer Acceso**

```
1. Usuario accede → /login
2. Clic "Login Microsoft" → /auth/microsoft
3. Redirección Microsoft → Pantalla credenciales (SIEMPRE)
4. Autorización → /auth/microsoft/callback
5. Creación usuario → Base de datos
6. Verificación perfil → INCOMPLETO
7. Redirección forzada → /settings/profile
8. Usuario completa datos → Guarda perfil
9. Middleware permite acceso → /dashboard
```

### 🔄 **Flujo de Acceso Recurrente**

```
1. Usuario accede → /login
2. Clic "Login Microsoft" → /auth/microsoft
3. Forzar re-auth → Pantalla credenciales Microsoft
4. Autorización → /auth/microsoft/callback
5. Actualización usuario → Base de datos
6. Verificación perfil → COMPLETO
7. Acceso directo → /dashboard
```

---

## 🛠️ Configuración de Desarrollo

### 📋 **Requisitos del Sistema**
- **PHP:** ^8.2
- **Composer:** Latest
- **Node.js:** ^18.0
- **NPM:** Latest

### 🔧 **Comandos de Desarrollo**

#### **Instalación**
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

#### **Desarrollo**
```bash
php artisan serve          # Servidor Laravel
npm run dev                # Compilación assets
php artisan queue:work     # Cola de trabajos
```

#### **Producción**
```bash
npm run build              # Build assets optimizado
php artisan config:cache   # Cache configuración
php artisan route:cache    # Cache rutas
php artisan view:cache     # Cache vistas
```

---

## 📈 Consideraciones de Producción

### 🚀 **Optimizaciones**
- ✅ Cache de configuración habilitado
- ✅ Cache de rutas optimizado
- ✅ Assets minificados (Vite)
- ✅ Database SQLite para rendimiento
- ✅ Middleware de seguridad activo

### 📊 **Monitoreo**
- **Logs:** `storage/logs/laravel.log`
- **Errores:** Sistema de logging Laravel
- **Performance:** Queries optimizadas Eloquent

### 🔒 **Seguridad en Producción**
- ✅ HTTPS obligatorio
- ✅ Headers de seguridad configurados
- ✅ Validación CSRF activa
- ✅ Rate limiting implementado
- ✅ Microsoft OAuth en tenant específico

---

## 📚 Documentación Adicional

### 📋 **Documentos del Proyecto**
- `MICROSOFT_SESSION_PERSISTENCE.md` - Análisis persistencia sesiones OAuth
- `IMPLEMENTACION_SEGURIDAD_MICROSOFT.md` - Implementación seguridad
- `MICROSOFT_OAUTH_SETUP.md` - Configuración OAuth Microsoft
- `README.md` - Documentación general

### 🆘 **Soporte y Mantenimiento**
- **Framework:** Laravel 12.0 (LTS Support)
- **Actualizaciones:** Versionado semántico
- **Backup:** Configurar backup automático BD
- **Monitoreo:** Logs centralizados recomendados

---

## 🎯 Conclusión

El sistema de Viáticos de la Alcaldía de Barrancabermeja está construido con las mejores prácticas de desarrollo Laravel, implementando máxima seguridad para el manejo de recursos públicos municipales, con una arquitectura escalable y mantenible que garantiza la integridad de las operaciones gubernamentales.

**🏛️ Diseñado específicamente para cumplir con los estándares de seguridad y auditoría requeridos por entidades públicas municipales.**
