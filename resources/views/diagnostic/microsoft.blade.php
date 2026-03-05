<!DOCTYPE html>
<html>
<head>
    <title>Diagnóstico Microsoft OAuth - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #0078d4; color: white; padding: 20px; margin: -20px -20px 20px -20px; border-radius: 8px 8px 0 0; }
        .status { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; }
        .btn { display: inline-block; padding: 10px 20px; background: #0078d4; color: white; text-decoration: none; border-radius: 4px; margin: 10px 5px 10px 0; }
        .btn:hover { background: #106ebe; }
        .code { background: #f8f9fa; padding: 15px; border-radius: 4px; font-family: 'Courier New', monospace; margin: 10px 0; border-left: 4px solid #0078d4; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .step { margin: 20px 0; padding: 15px; border-left: 4px solid #0078d4; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Diagnóstico Microsoft OAuth</h1>
            <p>Verificación de configuración para {{ config('app.name') }}</p>
        </div>

        <div class="status {{ $config['client_id'] && $config['client_secret'] && $config['redirect'] ? 'success' : 'error' }}">
            <strong>Estado de Configuración:</strong>
            @if($config['client_id'] && $config['client_secret'] && $config['redirect'])
                ✅ Configuración básica completa
            @else
                ❌ Configuración incompleta
            @endif
        </div>

        <h2>📋 Configuración Actual</h2>
        <table>
            <tr>
                <th>Variable</th>
                <th>Valor</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>MICROSOFT_CLIENT_ID</td>
                <td>{{ $config['client_id'] ?? 'No configurado' }}</td>
                <td>{{ $config['client_id'] ? '✅' : '❌' }}</td>
            </tr>
            <tr>
                <td>MICROSOFT_CLIENT_SECRET</td>
                <td>{{ $config['client_secret'] ? substr($config['client_secret'], 0, 10) . '...' : 'No configurado' }}</td>
                <td>{{ $config['client_secret'] ? '✅' : '❌' }}</td>
            </tr>
            <tr>
                <td>MICROSOFT_REDIRECT_URI</td>
                <td>{{ $config['redirect'] ?? 'No configurado' }}</td>
                <td>{{ $config['redirect'] ? '✅' : '❌' }}</td>
            </tr>
        </table>

        <h2>🚀 Pruebas</h2>
        <a href="{{ $authUrl }}" class="btn">🔗 Probar Autenticación Microsoft</a>
        <a href="/diagnostic/microsoft/json" class="btn">📊 API JSON</a>

        <h2>🔧 URLs Configuradas</h2>
        <div class="code">
            <strong>URL de Autenticación:</strong><br>
            {{ $authUrl }}
            <br><br>
            <strong>URL de Callback:</strong><br>
            {{ $callbackUrl }}
        </div>

        <div class="warning">
            <strong>⚠️ Si ves error "unauthorized_client":</strong><br>
            El problema está en Azure Portal, no en Laravel.
        </div>

        <h2>🛠️ Solución para "unauthorized_client"</h2>
        
        <div class="step">
            <h3>Paso 1: Verificar en Azure Portal</h3>
            <p>1. Ve a <a href="https://portal.azure.com" target="_blank">Azure Portal</a></p>
            <p>2. Azure Active Directory → App registrations</p>
            <p>3. Busca tu app: <code>{{ $config['client_id'] }}</code></p>
        </div>

        <div class="step">
            <h3>Paso 2: Configurar Authentication</h3>
            <p><strong>MUY IMPORTANTE:</strong> En "Supported account types" selecciona:</p>
            <div class="code">
                ✅ Accounts in any organizational directory (Any Azure AD directory - Multitenant) 
                and personal Microsoft accounts (e.g. Skype, Xbox)
            </div>
        </div>

        <div class="step">
            <h3>Paso 3: Verificar Redirect URI</h3>
            <p>Debe coincidir exactamente:</p>
            <div class="code">{{ $callbackUrl }}</div>
        </div>

        <div class="step">
            <h3>Paso 4: API Permissions</h3>
            <p>Permisos necesarios en Microsoft Graph:</p>
            <ul>
                <li>User.Read (Delegated)</li>
                <li>profile (Delegated)</li>
                <li>email (Delegated)</li>
                <li>openid (Delegated)</li>
            </ul>
            <p><strong>Importante:</strong> Haz clic en "Grant admin consent"</p>
        </div>

        <div class="step">
            <h3>💡 Tip Final</h3>
            <p>Después de hacer cambios en Azure, espera 5-10 minutos para que se propaguen.</p>
        </div>

        <h2>📚 Documentación</h2>
        <p>Para más detalles, consulta: <code>SOLUCION_UNAUTHORIZED_CLIENT.md</code></p>
    </div>
</body>
</html>
