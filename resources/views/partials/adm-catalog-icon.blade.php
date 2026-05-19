@php
    $icon = $icon ?? 'default';
@endphp
<span class="adm-row-icon adm-row-icon--{{ $icon }}" aria-hidden="true">
@switch($icon)
    @case('bebidas')
        {{-- Botella de refresco --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect x="8" y="2" width="8" height="3" rx="1" fill="#22c55e"/>
            <path d="M9 5h6l.8 11.5H8.2L9 5z" fill="#2563eb"/>
            <path d="M9.5 8h5v2h-5V8z" fill="#fbbf24" opacity=".9"/>
            <path d="M8 16.5h8v2.5a2.5 2.5 0 0 1-2.5 2.5h-3a2.5 2.5 0 0 1-2.5-2.5v-2.5z" fill="#1d4ed8"/>
        </svg>
        @break
    @case('snacks')
        {{-- Bolsa de papas --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 4h12l2 16H4L6 4z" fill="#f97316"/>
            <path d="M8 7h8l1.2 10H6.8L8 7z" fill="#fdba74"/>
            <ellipse cx="10" cy="11" rx="1.2" ry=".8" fill="#fbbf24"/>
            <ellipse cx="14" cy="13" rx="1.2" ry=".8" fill="#fde047"/>
            <ellipse cx="11" cy="15" rx="1.2" ry=".8" fill="#fbbf24"/>
        </svg>
        @break
    @case('lacteos')
        {{-- Cartón de leche --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 4h10l2 3v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7l2-3z" fill="#f8fafc" stroke="#94a3b8" stroke-width=".8"/>
            <path d="M7 4h10v3H7V4z" fill="#38bdf8"/>
            <path d="M9 10h6v1.5H9V10z" fill="#0ea5e9" opacity=".5"/>
            <path d="M9 13h4v1H9v-1z" fill="#64748b" opacity=".4"/>
        </svg>
        @break
    @case('frutas')
        {{-- Manzana --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21c3.5 0 6-2.8 6-6.5S15 8 12 8s-6 2.8-6 6.5 2.5 6.5 6 6.5z" fill="#ef4444"/>
            <path d="M12 8c0-3 1-5 2.5-6.5" stroke="#854d0e" stroke-width="1.5" fill="none" stroke-linecap="round"/>
            <path d="M14 3c1 .5 1.5 1.2 1.5 2" fill="#22c55e"/>
            <ellipse cx="10" cy="13" rx="1.5" ry="2" fill="#fca5a5" opacity=".5"/>
        </svg>
        @break
    @case('agua')
        {{-- Botella de agua --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 3h6c0 4-1 6-1 9.5a3.5 3.5 0 0 1-4 0C10 9 9 7 9 3z" fill="#bae6fd" stroke="#0284c7" stroke-width=".8"/>
            <path d="M10 10h4c0 2-.5 4-2 5.5a2 2 0 0 1-0 0c-1.5-1.5-2-3.5-2-5.5z" fill="#0ea5e9" opacity=".7"/>
            <rect x="10" y="1.5" width="4" height="2" rx=".5" fill="#64748b"/>
        </svg>
        @break
    @default
        {{-- Caja genérica --}}
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 8l8-4 8 4v10l-8 4-8-4V8z" fill="#d1d5db"/>
            <path d="M4 8l8 4 8-4" fill="#9ca3af"/>
            <path d="M12 12v10" stroke="#6b7280" stroke-width="1"/>
            <path d="M4 8h16" stroke="#6b7280" stroke-width=".8"/>
        </svg>
@endswitch
</span>
