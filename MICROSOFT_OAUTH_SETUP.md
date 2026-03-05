# Configuración de Autenticación con Microsoft/Hotmail

Este documento describe cómo configurar la autenticación OAuth con Microsoft para permitir que los usuarios se autentiquen usando sus cuentas de Hotmail, Outlook o Microsoft.

## Requisitos Previos

1. Laravel Socialite ya está instalado en el proyecto
2. SocialiteProviders/Microsoft ya está instalado y configurado
3. Una cuenta de Microsoft Azure con acceso al portal de Azure

## Paquetes Instalados

- `laravel/socialite` - Paquete base de Laravel para OAuth
- `socialiteproviders/microsoft` - Proveedor específico para Microsoft
- EventServiceProvider configurado para Microsoft OAuth

## Paso 1: Registrar la aplicación en Microsoft Azure

1. Ve al [Portal de Azure](https://portal.azure.com/)
2. Navega a "Azure Active Directory" > "App registrations"
3. Haz clic en "New registration"
4. Completa el formulario:
   - **Name**: Nombre de tu aplicación (ej: "Viáticos Alcaldía")
   - **Supported account types**: "Accounts in any organizational directory and personal Microsoft accounts"
   - **Redirect URI**: 
     - Tipo: Web
     - URL: `http://localhost/auth/microsoft/callback` (para desarrollo local)
     - URL de producción: `https://tudominio.com/auth/microsoft/callback`

## Paso 2: Obtener las credenciales

1. Una vez creada la aplicación, ve a la sección "Overview"
2. Copia el **Application (client) ID**
3. Ve a "Certificates & secrets" > "Client secrets"
4. Haz clic en "New client secret"
5. Proporciona una descripción y selecciona la expiración
6. Copia el **Client secret value** (¡guárdalo de inmediato, no podrás verlo después!)

## Paso 3: Configurar las variables de entorno

Agrega las siguientes variables a tu archivo `.env`:

```bash
MICROSOFT_CLIENT_ID=tu_client_id_aqui
MICROSOFT_CLIENT_SECRET=tu_client_secret_aqui
MICROSOFT_REDIRECT_URI=http://localhost/auth/microsoft/callback
```

Para producción, actualiza la URL de redirección:
```bash
MICROSOFT_REDIRECT_URI=https://tudominio.com/auth/microsoft/callback
```

## Paso 4: Ejecutar las migraciones

```bash
php artisan migrate
```

## Paso 5: Configurar permisos adicionales (opcional)

En el portal de Azure, ve a "API permissions" para configurar qué información puede acceder tu aplicación:

- **User.Read**: Información básica del perfil (habilitado por defecto)
- **email**: Acceso al email del usuario
- **profile**: Acceso al perfil del usuario

## Rutas disponibles

- **Iniciar autenticación**: `/auth/microsoft`
- **Callback de Microsoft**: `/auth/microsoft/callback`

## Uso

Los usuarios ahora pueden hacer clic en el botón "Sign in with Microsoft" en la página de login para autenticarse usando su cuenta de Microsoft/Hotmail.

## Funcionalidades implementadas

1. **Autenticación OAuth**: Los usuarios pueden iniciar sesión con Microsoft
2. **Registro automático**: Si el usuario no existe, se crea automáticamente
3. **Actualización de datos**: Si el usuario ya existe, se actualiza su información
4. **Avatar**: Se guarda el avatar del usuario de Microsoft
5. **Verificación de email**: Se marca automáticamente como verificado

## Solución de problemas

### Error: "AADSTS50011: The reply URL specified in the request does not match the reply URLs configured for the application"

Verifica que la URL de redirección en Azure coincida exactamente con la configurada en `MICROSOFT_REDIRECT_URI`.

### Error: "Invalid client secret"

Regenera el client secret en Azure y actualiza la variable `MICROSOFT_CLIENT_SECRET`.

### Error de conexión SSL en desarrollo local

Si usas `http://localhost`, asegúrate de que en Azure has configurado la URL de redirección sin HTTPS.

## Consideraciones de seguridad

1. **Nunca** expongas las credenciales de Microsoft en el código fuente
2. Usa HTTPS en producción
3. Considera implementar rate limiting en las rutas de autenticación
4. Revisa regularmente los logs de autenticación en Azure

## Personalización adicional

Para personalizar el comportamiento de la autenticación, puedes modificar el archivo:
`app/Http/Controllers/Auth/MicrosoftAuthController.php`

Puedes agregar campos adicionales, validaciones personalizadas o lógica de negocio específica según tus necesidades.
