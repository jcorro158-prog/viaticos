# Solución para Error: "unauthorized_client" - Microsoft OAuth

## Error Actual
```
unauthorized_client: The client does not exist or is not enabled for consumers. 
If you are the application developer, configure a new application through the App Registrations in the Azure Portal
```

## ✅ Causa del Problema
Este error indica que la aplicación en Azure Portal no está configurada correctamente para permitir autenticación de usuarios consumidores (personal Microsoft accounts).

## 🔧 Solución Paso a Paso

### Paso 1: Verificar Configuración en Azure Portal

1. Ve al [Portal de Azure](https://portal.azure.com/)
2. Navega a **Azure Active Directory** > **App registrations**
3. Busca tu aplicación (ID: `df2c669a-31b4-4374-b885-2259c710b4ce`)

### Paso 2: Configurar Tipos de Cuenta Soportados

**MUY IMPORTANTE**: Este es el paso crítico que falta

1. En tu aplicación, ve a **Authentication** (Autenticación)
2. En **Supported account types** (Tipos de cuenta compatibles), asegúrate de seleccionar:
   
   **✅ OPCIÓN CORRECTA:**
   ```
   Accounts in any organizational directory (Any Azure AD directory - Multitenant) 
   and personal Microsoft accounts (e.g. Skype, Xbox)
   ```
   
   **❌ NO seleccionar:**
   - Solo cuentas organizacionales
   - Solo single tenant

### Paso 3: Verificar Redirect URIs

En la sección **Redirect URIs**:

1. Tipo: **Web**
2. URIs configuradas:
   ```
   https://morfeo.viaticos.barrancabermeja.gov.co/auth/microsoft/callback
   http://localhost/auth/microsoft/callback (para desarrollo)
   ```

### Paso 4: Configurar API Permissions

1. Ve a **API permissions**
2. Asegúrate de tener estos permisos:
   - **Microsoft Graph**:
     - `User.Read` (Delegated) ✅
     - `profile` (Delegated) ✅
     - `email` (Delegated) ✅
     - `openid` (Delegated) ✅

3. **IMPORTANTE**: Haz clic en **Grant admin consent** para aprobar los permisos

### Paso 5: Verificar Client Secret

1. Ve a **Certificates & secrets**
2. Verifica que el secret `gPd8Q~bd-NWR4agXcrZGzftRL3FUBd5Sb_I4laoU` esté activo
3. Si ha expirado, genera uno nuevo

### Paso 6: Configuración de Manifest (Opcional)

Si el problema persiste, ve a **Manifest** y verifica:

```json
{
  "signInAudience": "AzureADandPersonalMicrosoftAccount",
  "accessTokenAcceptedVersion": 2
}
```

## 🎯 Configuración Más Probable que Falta

**EL PROBLEMA MÁS COMÚN ES EL PASO 2**: La aplicación está configurada solo para cuentas organizacionales y no para cuentas personales de Microsoft (Hotmail, Outlook.com, etc.).

## 🧪 Prueba de Verificación

Después de hacer los cambios en Azure:

1. Guarda todos los cambios en Azure Portal
2. Espera 5-10 minutos para que se propaguen los cambios
3. Prueba el login desde: `https://morfeo.viaticos.barrancabermeja.gov.co/auth/microsoft`

## 📋 Checklist de Verificación

- [ ] Tipos de cuenta incluyen "personal Microsoft accounts"
- [ ] Redirect URI está configurada correctamente
- [ ] Client ID y Secret son correctos y activos
- [ ] API permissions están configurados y aprobados
- [ ] La aplicación está habilitada para consumidores

## 🚨 Si el Problema Persiste

Si después de estos pasos el error continúa:

1. **Crear nueva aplicación**: A veces es más rápido crear una nueva app registration
2. **Verificar región**: Asegúrate de estar en la región correcta de Azure
3. **Logs de Azure**: Revisa los logs en Azure AD para más detalles del error

## 💡 Tip Importante

Microsoft requiere que las aplicaciones que van a autenticar usuarios personales (Hotmail, Outlook.com) estén explícitamente configuradas para esto desde el momento de la creación o modificadas posteriormente.
