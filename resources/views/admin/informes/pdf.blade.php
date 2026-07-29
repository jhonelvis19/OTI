{{-- resources/views/admin/informes/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{ $informe->codigo_informe }}</title>
<style>
    /* ── RESET ── */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'DejaVu Sans', Arial, sans-serif;
        font-size: 9pt;
        color: #1e293b;
        background: #f1f5f9;
        padding: 20px 24px;
    }

    /* ── PAGE WRAPPER ── */
    .page-wrapper {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* ── HEADER BAND ── */
    .header-band {
        background: #1d4ed8;
        padding: 0;
    }
    .header-inner {
        width: 100%;
        border-collapse: collapse;
    }
    .header-logo-cell {
        width: 90px;
        padding: 14px 14px 14px 16px;
        vertical-align: middle;
    }
    .logo-img {
        width: 62px;
        height: 62px;
        object-fit: contain;
        background: #ffffff;
        border-radius: 8px;
        padding: 4px;
    }
    .logo-box-fallback {
        width: 62px;
        height: 62px;
        background-color: #1e40af;
        border: 2px solid #bfdbfe;
        border-radius: 8px;
        text-align: center;
        padding: 10px 6px 6px 6px;
    }
    .logo-icon {
        color: #ffffff;
        font-size: 14pt;
        font-weight: bold;
        letter-spacing: 1px;
        line-height: 1;
    }
    .logo-sub {
        color: #bfdbfe;
        font-size: 5pt;
        margin-top: 3px;
        letter-spacing: 0.5px;
    }
    .header-title-cell {
        vertical-align: middle;
        text-align: center;
        padding: 14px 10px;
    }
    .header-doc-title {
        font-size: 12pt;
        font-weight: bold;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        line-height: 1.3;
    }
    .header-doc-sub {
        font-size: 7.5pt;
        color: #bfdbfe;
        margin-top: 3px;
        letter-spacing: 0.5px;
    }
    .header-meta-cell {
        width: 155px;
        vertical-align: middle;
        text-align: right;
        padding: 14px 16px 14px 10px;
    }
    .meta-card {
        background: rgba(255,255,255,0.12);
        border: 1.5px solid rgba(255,255,255,0.3);
        border-radius: 8px;
        padding: 8px 12px;
    }
    .meta-code {
        font-size: 10pt;
        font-weight: bold;
        color: #ffffff;
        letter-spacing: 0.5px;
    }
    .meta-row {
        font-size: 7pt;
        color: #bfdbfe;
        margin-top: 3px;
    }
    .meta-val {
        font-weight: bold;
        color: #ffffff;
    }

    /* ── STATUS BAR ── */
    .status-bar {
        width: 100%;
        border-collapse: collapse;
        background: #eff6ff;
        border-bottom: 2px solid #bfdbfe;
    }
    .status-bar td {
        padding: 6px 16px;
        font-size: 7.5pt;
        color: #1e40af;
        vertical-align: middle;
    }
    .status-bar .status-label {
        font-weight: bold;
        color: #64748b;
        text-transform: uppercase;
        font-size: 6.5pt;
        letter-spacing: 0.5px;
    }
    .status-bar .status-val {
        font-weight: bold;
        color: #1d4ed8;
    }
    .sep { color: #cbd5e1; padding: 0 6px; }

    /* ── BODY AREA ── */
    .body-area {
        padding: 16px 18px 18px 18px;
    }

    /* ── SECTION BLOCK ── */
    .section-block {
        border: 1.5px solid #c7d2fe;
        border-radius: 8px;
        margin-bottom: 12px;
        overflow: hidden;
    }
    .section-header {
        background: #eef2ff;
        border-bottom: 1.5px solid #c7d2fe;
        padding: 5px 12px;
    }
    .section-header-title {
        font-size: 7.5pt;
        font-weight: bold;
        color: #3730a3;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .section-body {
        padding: 0;
    }

    /* ── DATA GRID TABLE ── */
    .data-grid {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .data-grid td {
        padding: 6px 12px;
        vertical-align: top;
        border-bottom: 1px solid #f1f5f9;
    }
    .data-grid tr:last-child td {
        border-bottom: none;
    }
    .data-grid .lbl {
        font-size: 7pt;
        color: #64748b;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        width: 28%;
        background: #f8fafc;
        white-space: nowrap;
        border-right: 1px solid #f1f5f9;
    }
    .data-grid .val {
        font-size: 8.5pt;
        color: #1e293b;
        font-weight: 500;
        word-wrap: break-word;
        word-break: break-word;
    }
    .val-empty {
        color: #94a3b8;
        font-style: italic;
        font-size: 8pt;
    }

    /* ── TEXT BLOCK (multiline) ── */
    .text-area-block {
        font-size: 8.5pt;
        color: #1e293b;
        line-height: 1.55;
        padding: 8px 12px;
        background: #f8fafc;
    }
    .text-area-label {
        font-size: 6.5pt;
        font-weight: bold;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 5px 12px 2px 12px;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
    }
    .text-area-content {
        font-size: 8.5pt;
        color: #1e293b;
        line-height: 1.55;
        padding: 7px 12px 9px 12px;
        word-wrap: break-word;
        word-break: break-word;
    }
    .text-area-divider {
        border-top: 1px dashed #e2e8f0;
        margin: 0 12px;
    }

    /* ── BADGES ── */
    .badge {
        display: inline-block;
        padding: 2px 9px;
        border-radius: 20px;
        font-size: 7.5pt;
        font-weight: bold;
        letter-spacing: 0.3px;
    }
    .badge-green  { background:#dcfce7; color:#166534; border: 1px solid #86efac; }
    .badge-red    { background:#fee2e2; color:#991b1b; border: 1px solid #fca5a5; }
    .badge-blue   { background:#dbeafe; color:#1d4ed8; border: 1px solid #93c5fd; }
    .badge-indigo { background:#e0e7ff; color:#3730a3; border: 1px solid #a5b4fc; }

    /* ── FIRMAS ── */
    .firmas-section {
        border: 1.5px solid #c7d2fe;
        border-radius: 8px;
        margin-bottom: 12px;
        overflow: hidden;
    }
    .firmas-header {
        background: #eef2ff;
        border-bottom: 1.5px solid #c7d2fe;
        padding: 5px 12px;
    }
    .firmas-header-title {
        font-size: 7.5pt;
        font-weight: bold;
        color: #3730a3;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .firmas-table {
        width: 100%;
        border-collapse: collapse;
    }
    .firma-cell {
        width: 50%;
        text-align: center;
        padding: 14px 20px 12px 20px;
        vertical-align: bottom;
    }
    .firma-cell-left {
        border-right: 1px solid #e2e8f0;
    }
    .firma-img-wrapper {
        height: 70px;
        display: block;
        text-align: center;
        margin-bottom: 4px;
    }
    .firma-img-wrapper img {
        max-height: 68px;
        max-width: 200px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }
    .firma-placeholder {
        height: 70px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        margin-bottom: 4px;
    }
    .firma-line {
        border-top: 1.5px solid #334155;
        margin: 0 16px 5px 16px;
    }
    .firma-name {
        font-size: 8.5pt;
        font-weight: bold;
        color: #1e293b;
        margin-top: 3px;
    }
    .firma-detail {
        font-size: 7pt;
        color: #475569;
        margin-top: 2px;
    }
    .firma-role {
        font-size: 6.5pt;
        color: #94a3b8;
        margin-top: 2px;
        letter-spacing: 0.3px;
        font-style: italic;
    }

    /* ── FOOTER ── */
    .footer {
        text-align: center;
        font-size: 7pt;
        color: #94a3b8;
        border-top: 1px solid #e2e8f0;
        padding: 8px 16px;
        background: #f8fafc;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* ── PAGE ── */
    @page {
        margin: 12mm 12mm 12mm 12mm;
        size: A4 portrait;
    }
</style>
</head>
<body>

<div class="page-wrapper">

    {{-- ══ HEADER ══ --}}
    <div class="header-band">
        <table class="header-inner">
            <tr>
                <td class="header-logo-cell">
                    <div class="logo-box-fallback">
                        <div class="logo-icon">OTI</div>
                        <div class="logo-sub">TECNOLOGÍA<br>INFORMÁTICA</div>
                    </div>
                </td>
                <td class="header-title-cell">
                    <div class="header-doc-title">Acta de Mantenimiento de Equipos de Cómputo</div>
                    <div class="header-doc-sub">Oficina de Tecnología Informática — Sistema de Gestión de Mantenimiento</div>
                </td>
                <td class="header-meta-cell">
                    <div class="meta-card">
                        <div class="meta-code">{{ $informe->codigo_informe }}</div>
                        <div class="meta-row">Fecha: <span class="meta-val">{{ \Carbon\Carbon::parse($informe->fecha)->format('d/m/Y') }}</span></div>
                        <div class="meta-row">Inicio: <span class="meta-val">{{ substr($informe->hora_inicio, 0, 5) }}</span></div>
                        @if($informe->hora_salida)
                        <div class="meta-row">Salida: <span class="meta-val">{{ substr($informe->hora_salida, 0, 5) }}</span></div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ══ STATUS BAR ══ --}}
    <table class="status-bar">
        <tr>
            <td>
                <span class="status-label">Estado:</span>&nbsp;
                @if($informe->solucionado)
                    <span class="badge badge-green">✔ Solucionado</span>
                @else
                    <span class="badge badge-red">✖ No Solucionado</span>
                @endif
                <span class="sep">|</span>
                <span class="status-label">Técnico:</span>&nbsp;
                <span class="status-val">{{ $informe->user->name ?? '—' }} {{ $informe->user->apellido ?? '' }}</span>
                <span class="sep">|</span>
                <span class="status-label">Sede:</span>&nbsp;
                <span class="status-val">{{ $informe->sede->nombre ?? '—' }}</span>
            </td>
        </tr>
    </table>

    {{-- ══ BODY ══ --}}
    <div class="body-area">

        {{-- ① DATOS DEL USUARIO --}}
        <div class="section-block">
            <div class="section-header">
                <span class="section-header-title">① Datos del Usuario</span>
            </div>
            <div class="section-body">
                <table class="data-grid">
                    <tr>
                        <td class="lbl">Nombre y Apellido</td>
                        <td class="val">{{ strtoupper($informe->nombre_atendido) }}</td>
                        <td class="lbl">DNI</td>
                        <td class="val">{{ $informe->dni_atendido }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Tipo de Persona</td>
                        <td class="val">
                            <span class="badge badge-indigo">{{ ucfirst($informe->persona_atendida) }}</span>
                        </td>
                        <td class="lbl">Facilidades</td>
                        <td class="val">
                            @if($informe->brindaron_facilidad)
                                <span class="badge badge-green">✔ Sí brindó</span>
                            @else
                                <span class="badge badge-red">✖ No brindó</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ② SEDE Y UBICACIÓN --}}
        <div class="section-block">
            <div class="section-header">
                <span class="section-header-title">② Sede y Ubicación</span>
            </div>
            <div class="section-body">
                <table class="data-grid">
                    <tr>
                        <td class="lbl">Sede (CEDE)</td>
                        <td class="val">{{ $informe->sede->nombre ?? '—' }}</td>
                        <td class="lbl">Oficina</td>
                        <td class="val">
                            @if($informe->oficina)
                                {{ $informe->oficina->nombre }}
                            @elseif($informe->otra_oficina)
                                {{ $informe->otra_oficina }}
                            @else
                                <span class="val-empty">No especificada</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Técnico Asignado</td>
                        <td class="val" colspan="3">
                            {{ $informe->user->name ?? '—' }}
                            @if($informe->user->apellido ?? null) {{ $informe->user->apellido }} @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ③ INFORMACIÓN DEL EQUIPO --}}
        <div class="section-block">
            <div class="section-header">
                <span class="section-header-title">③ Información del Equipo</span>
            </div>
            <div class="section-body">
                <table class="data-grid">
                    <tr>
                        <td class="lbl">Cód. Patrimonio</td>
                        <td class="val">{{ $informe->codigo_patrimonial }}</td>
                        <td class="lbl">Tipo de Equipo</td>
                        <td class="val">{{ $informe->tipoEquipo->nombre ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Marca</td>
                        <td class="val">{{ $informe->marca }}</td>
                        <td class="lbl">Modelo</td>
                        <td class="val">{{ $informe->modelo }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">N° de Serie</td>
                        <td class="val">{{ $informe->serie ?: '—' }}</td>
                        <td class="lbl">N° de Equipos</td>
                        <td class="val">{{ $informe->numero_equipos }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ④ DESCRIPCIÓN Y RESOLUCIÓN --}}
        <div class="section-block">
            <div class="section-header">
                <span class="section-header-title">④ Descripción Detallada del Mantenimiento</span>
            </div>
            <div class="section-body">
                <div class="text-area-label">Problema Reportado</div>
                <div class="text-area-content">{!! nl2br(e($informe->descripcion_problema)) !!}</div>

                @if($informe->resolucion_tecnica)
                <div class="text-area-divider"></div>
                <div class="text-area-label">Resolución Técnica</div>
                <div class="text-area-content">{!! nl2br(e($informe->resolucion_tecnica)) !!}</div>
                @endif

                @if($informe->observaciones)
                <div class="text-area-divider"></div>
                <div class="text-area-label">Observaciones</div>
                <div class="text-area-content">{!! nl2br(e($informe->observaciones)) !!}</div>
                @endif
            </div>
        </div>

        {{-- ⑤ FACTIBILIDAD --}}
        <div class="section-block">
            <div class="section-header">
                <span class="section-header-title">⑤ Factibilidad de Solución</span>
            </div>
            <div class="section-body">
                <table class="data-grid">
                    <tr>
                        <td class="lbl">¿Se solucionó?</td>
                        <td class="val" colspan="3">
                            @if($informe->solucionado)
                                <span class="badge badge-green">✔ SÍ — Inconveniente solucionado satisfactoriamente</span>
                            @else
                                <span class="badge badge-red">✖ NO — No fue posible solucionar el inconveniente</span>
                            @endif
                        </td>
                    </tr>
                    @if(!$informe->solucionado && $informe->motivo_no_solucion)
                    <tr>
                        <td class="lbl">Motivo</td>
                        <td class="val" colspan="3">{{ $informe->motivo_no_solucion }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- ⑥ FIRMAS --}}
        <div class="firmas-section">
            <div class="firmas-header">
                <span class="firmas-header-title">⑥ Firmas de Conformidad</span>
            </div>
            <table class="firmas-table">
                <tr>
                    {{-- FIRMA PERSONA ATENDIDA --}}
                    <td class="firma-cell firma-cell-left" style="vertical-align: bottom;">

                        {{-- Imagen de firma SOBRE la línea --}}
                        @if($informe->firma_persona && \Illuminate\Support\Facades\Storage::disk('public')->exists($informe->firma_persona))
                            <div class="firma-img-wrapper">
                                <img src="{{ storage_path('app/public/' . $informe->firma_persona) }}" alt="Firma Persona">
                            </div>
                        @else
                            <div class="firma-placeholder"></div>
                        @endif

                        {{-- Línea --}}
                        <div class="firma-line"></div>

                        {{-- Datos debajo de la línea --}}
                        <div class="firma-name">{{ strtoupper($informe->nombre_atendido) }}</div>
                        <div class="firma-detail">DNI: {{ $informe->dni_atendido }}</div>
                        <div class="firma-role">Firma del Usuario Atendido</div>
                    </td>

                    {{-- FIRMA TÉCNICO --}}
                    <td class="firma-cell" style="vertical-align: bottom;">

                        {{-- Imagen de firma SOBRE la línea --}}
                        @if($informe->firma_tecnico && \Illuminate\Support\Facades\Storage::disk('public')->exists($informe->firma_tecnico))
                            <div class="firma-img-wrapper">
                                <img src="{{ storage_path('app/public/' . $informe->firma_tecnico) }}" alt="Firma Técnico">
                            </div>
                        @else
                            <div class="firma-placeholder"></div>
                        @endif

                        {{-- Línea --}}
                        <div class="firma-line"></div>

                        {{-- Datos debajo de la línea --}}
                        <div class="firma-name">
                            {{ strtoupper($informe->user->name ?? '—') }}
                            {{ strtoupper($informe->user->apellido ?? '') }}
                        </div>
                        <div class="firma-detail">Técnico de OTI</div>
                        <div class="firma-role">Firma del Técnico Responsable</div>
                    </td>
                </tr>
            </table>
        </div>

    </div>{{-- /body-area --}}

    {{-- ══ FOOTER ══ --}}
    <div class="footer">
        Documento generado el {{ now()->format('d/m/Y \a \l\a\s H:i') }}
        &nbsp;·&nbsp;
        {{ $informe->codigo_informe }}
        &nbsp;·&nbsp;
        Oficina de Tecnología Informática
        &nbsp;·&nbsp;
        Sistema de Gestión de Mantenimiento
    </div>

</div>{{-- /page-wrapper --}}

</body>
</html>