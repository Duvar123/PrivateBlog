<form method="GET" action="{{ $action }}" class="adm-filter-form">
    <input type="text" name="filter" class="adm-catalog-search" placeholder="{{ $placeholder }}" value="{{ $data->filter ?? '' }}" autocomplete="off">
    <select name="records_per_page" class="adm-filter-select" aria-label="Registros por página">
        <option value="10" @selected(($data->records_per_page ?? 10) == 10)>10</option>
        <option value="15" @selected(($data->records_per_page ?? 10) == 15)>15</option>
        <option value="30" @selected(($data->records_per_page ?? 10) == 30)>30</option>
        <option value="50" @selected(($data->records_per_page ?? 10) == 50)>50</option>
    </select>
    <button type="submit" class="learn-more learn-more--sm">Buscar</button>
</form>
