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
        background: #ffffff;
        padding: 18px 22px;
    }

    /* ── HEADER ── */
    .header-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    .header-logo-cell {
        width: 72px;
        vertical-align: middle;
        padding-right: 10px;
    }
    .logo-box {
        width: 64px;
        height: 64px;
        background-color: #1d4ed8;
        border-radius: 6px;
        text-align: center;
        padding: 8px;
    }
    .logo-box-icon {
        color: #ffffff;
        font-size: 22pt;
        font-weight: bold;
        line-height: 1;
    }
    .logo-box-text {
        color: #bfdbfe;
        font-size: 6pt;
        margin-top: 2px;
    }
    .header-title-cell {
        vertical-align: middle;
        text-align: center;
    }
    .header-title {
        font-size: 13pt;
        font-weight: bold;
        color: #1e3a8a;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .header-subtitle {
        font-size: 8pt;
        color: #3b82f6;
        margin-top: 2px;
    }
    .header-meta-cell {
        width: 160px;
        vertical-align: top;
        text-align: right;
    }
    .meta-box {
        border: 1.5px solid #1d4ed8;
        border-radius: 4px;
        padding: 6px 10px;
        background-color: #eff6ff;
    }
    .meta-code {
        font-size: 10pt;
        font-weight: bold;
        color: #1d4ed8;
    }
    .meta-row {
        font-size: 7.5pt;
        color: #475569;
        margin-top: 2px;
    }
    .meta-value {
        font-weight: bold;
        color: #1e293b;
    }

    /* ── DIVIDER ── */
    .divider {
        width: 100%;
        height: 2px;
        background-color: #1d4ed8;
        margin: 8px 0;
    }
    .divider-thin {
        width: 100%;
        height: 1px;
        background-color: #e2e8f0;
        margin: 6px 0;
    }

    /* ── SECTION TITLE ── */
    .section-title {
        background-color: #1d4ed8;
        color: #ffffff;
        font-size: 8pt;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 4px 10px;
        margin-bottom: 0;
    }

    /* ── DATA TABLE (inside sections) ── */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #cbd5e1;
        margin-bottom: 8px;
    }
    .data-table td {
        padding: 5px 8px;
        vertical-align: top;
        border: 1px solid #e2e8f0;
    }
    .label {
        font-size: 7.5pt;
        color: #64748b;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        width: 30%;
        background-color: #f8fafc;
        white-space: nowrap;
    }
    .value {
        font-size: 8.5pt;
        color: #1e293b;
    }
    .value-empty {
        font-size: 8pt;
        color: #94a3b8;
        font-style: italic;
    }

    /* ── BADGE ── */
    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 8pt;
        font-weight: bold;
    }
    .badge-green {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }
    .badge-red {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }
    .badge-blue {
        background-color: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #93c5fd;
    }

    /* ── TEXTAREA FIELDS (multiline) ── */
    .text-block {
        font-size: 8.5pt;
        color: #1e293b;
        line-height: 1.5;
        padding: 6px 8px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 2px;
        width: 100%;
    }

    /* ── FIRMA ── */
    .firma-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 6px;
    }
    .firma-cell {
        width: 50%;
        padding: 0 12px;
        text-align: center;
        vertical-align: bottom;
    }
    .firma-line {
        border-top: 1.5px solid #334155;
        margin: 0 10px;
        margin-top: 40px;
    }
    .firma-label {
        font-size: 7.5pt;
        color: #475569;
        margin-top: 3px;
    }
    .firma-name {
        font-size: 8.5pt;
        font-weight: bold;
        color: #1e293b;
    }
    .firma-sub {
        font-size: 7pt;
        color: #64748b;
    }

    /* ── FOOTER ── */
    .footer {
        margin-top: 10px;
        text-align: center;
        font-size: 7pt;
        color: #94a3b8;
        border-top: 1px solid #e2e8f0;
        padding-top: 6px;
    }

    /* ── PAGE ── */
    @page {
        margin: 15mm 15mm 15mm 15mm;
        size: A4 portrait;
    }
</style>
</head>
<body>

{{-- ══════════════════════════════════════════
     ENCABEZADO DEL DOCUMENTO
══════════════════════════════════════════ --}}
<table class="header-table">
    <tr>
        <td class="header-logo-cell">
            <div class="logo-box">
                <div class="logo-box-icon">OTI</div>
                <div class="logo-box-text">TECNOLOGÍA<br>INFORMÁTICA</div>
            </div>
        </td>
        <td class="header-title-cell">
            <div class="header-title">Acta de Mantenimiento de Equipos de Cómputo</div>
            <div class="header-subtitle">Oficina de Tecnología Informática</div>
        </td>
        <td class="header-meta-cell">
            <div class="meta-box">
                <div class="meta-code">{{ $informe->codigo_informe }}</div>
                <div class="meta-row">Fecha: <span class="meta-value">{{ \Carbon\Carbon::parse($informe->fecha)->format('d/m/Y') }}</span></div>
                <div class="meta-row">Inicio: <span class="meta-value">{{ substr($informe->hora_inicio, 0, 5) }}</span></div>
                @if($informe->hora_salida)
                <div class="meta-row">Salida: <span class="meta-value">{{ substr($informe->hora_salida, 0, 5) }}</span></div>
                @endif
            </div>
        </td>
    </tr>
</table>

<div class="divider"></div>

{{-- ══════════════════════════════════════════
     SECCIÓN 1: DATOS DEL USUARIO
══════════════════════════════════════════ --}}
<div class="section-title">① Datos del Usuario</div>
<table class="data-table">
    <tr>
        <td class="label">Nombre y Apellido</td>
        <td class="value">{{ strtoupper($informe->nombre_atendido) }}</td>
        <td class="label">DNI</td>
        <td class="value">{{ $informe->dni_atendido }}</td>
    </tr>
    <tr>
        <td class="label">Persona Atendida</td>
        <td class="value">
            <span class="badge badge-blue">
                {{ ucfirst($informe->persona_atendida) }}
            </span>
        </td>
        <td class="label">Facilidades</td>
        <td class="value">
            @if($informe->brindaron_facilidad)
                <span class="badge badge-green">✔ Sí brindó</span>
            @else
                <span class="badge badge-red">✖ No brindó</span>
            @endif
        </td>
    </tr>
</table>

{{-- ══════════════════════════════════════════
     SECCIÓN 2: SEDE Y OFICINA
══════════════════════════════════════════ --}}
<div class="section-title">② Sede y Ubicación</div>
<table class="data-table">
    <tr>
        <td class="label">Sede (CEDE)</td>
        <td class="value">{{ $informe->sede->nombre ?? '—' }}</td>
        <td class="label">Oficina</td>
        <td class="value">
            @if($informe->oficina)
                {{ $informe->oficina->nombre }}
            @elseif($informe->otra_oficina)
                {{ $informe->otra_oficina }}
            @else
                <span class="value-empty">No especificada</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="label">Técnico Asignado</td>
        <td class="value" colspan="3">{{ $informe->user->name ?? '—' }}</td>
    </tr>
</table>

{{-- ══════════════════════════════════════════
     SECCIÓN 3: DATOS DEL EQUIPO
══════════════════════════════════════════ --}}
<div class="section-title">③ Información del Equipo</div>
<table class="data-table">
    <tr>
        <td class="label">Cód. Patrimonio</td>
        <td class="value">{{ $informe->codigo_patrimonial }}</td>
        <td class="label">Tipo de Equipo</td>
        <td class="value">{{ $informe->tipoEquipo->nombre ?? '—' }}</td>
    </tr>
    <tr>
        <td class="label">Marca</td>
        <td class="value">{{ $informe->marca }}</td>
        <td class="label">Modelo</td>
        <td class="value">{{ $informe->modelo }}</td>
    </tr>
    <tr>
        <td class="label">Serie</td>
        <td class="value">{{ $informe->serie }}</td>
        <td class="label">N° de Equipos</td>
        <td class="value">{{ $informe->numero_equipos }}</td>
    </tr>
</table>

{{-- ══════════════════════════════════════════
     SECCIÓN 4: DESCRIPCIÓN Y RESOLUCIÓN
══════════════════════════════════════════ --}}
<div class="section-title">④ Descripción Detallada del Mantenimiento</div>
<table class="data-table" style="margin-bottom: 4px;">
    <tr>
        <td class="label" style="width:20%; background:#f8fafc;">Problema<br>Reportado</td>
        <td style="padding: 0; border: none;">
            <div class="text-block">{{ $informe->descripcion_problema }}</div>
        </td>
    </tr>
</table>

<table class="data-table" style="margin-bottom: 4px;">
    <tr>
        <td class="label" style="width:20%; background:#f8fafc;">Resolución<br>Técnica</td>
        <td style="padding: 0; border: none;">
            <div class="text-block">{{ $informe->resolucion_tecnica }}</div>
        </td>
    </tr>
</table>

@if($informe->observaciones)
<table class="data-table">
    <tr>
        <td class="label" style="width:20%; background:#f8fafc;">Observaciones</td>
        <td style="padding: 0; border: none;">
            <div class="text-block">{{ $informe->observaciones }}</div>
        </td>
    </tr>
</table>
@endif

{{-- ══════════════════════════════════════════
     SECCIÓN 5: FACTIBILIDAD DE SOLUCIÓN
══════════════════════════════════════════ --}}
<div class="section-title">⑤ Factibilidad de Solución</div>
<table class="data-table">
    <tr>
        <td class="label">¿Se solucionó?</td>
        <td class="value" colspan="3">
            @if($informe->solucionado)
                <span class="badge badge-green">✔ SÍ — Inconveniente solucionado</span>
            @else
                <span class="badge badge-red">✖ NO — No se pudo solucionar</span>
            @endif
        </td>
    </tr>
    @if(!$informe->solucionado && $informe->motivo_no_solucion)
    <tr>
        <td class="label">Motivo</td>
        <td class="value" colspan="3">{{ $informe->motivo_no_solucion }}</td>
    </tr>
    @endif
</table>

<div class="divider-thin"></div>

{{-- ══════════════════════════════════════════
     SECCIÓN 6: FIRMAS
══════════════════════════════════════════ --}}
<table class="firma-table" style="margin-top: 14px;">
    <tr>
        <td class="firma-cell">
            <div class="firma-line"></div>
            <div class="firma-name">{{ strtoupper($informe->nombre_atendido) }}</div>
            <div class="firma-label">DNI: {{ $informe->dni_atendido }}</div>
            <div class="firma-sub">Firma del Usuario Atendido</div>
        </td>
        <td class="firma-cell">
            <div class="firma-line"></div>
            <div class="firma-name">{{ strtoupper($informe->user->name ?? '—') }}</div>
            <div class="firma-label">Técnico de OTI</div>
            <div class="firma-sub">Firma del Técnico Asignado</div>
        </td>
    </tr>
</table>

{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}
<div class="footer">
    Documento generado el {{ now()->format('d/m/Y \a \l\a\s H:i') }} &nbsp;|&nbsp;
    {{ $informe->codigo_informe }} &nbsp;|&nbsp;
    Oficina de Tecnología Informática
</div>

</body>
</html>