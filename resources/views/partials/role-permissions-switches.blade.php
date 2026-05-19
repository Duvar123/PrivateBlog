<style>
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider {
    background-color: #2196F3;
}
input:checked + .slider:before {
    transform: translateX(26px);
}
.permission-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
</style>

<input type="hidden" name="permissions" id="permissions" value="[]">

<div class="card" style="padding:20px;margin-top:20px;">
    <h3 style="margin-bottom:30px;">Permisos</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:40px;">
        @foreach ($modules as $moduleName => $modulePermissions)
        <div>
            <h4>{{ $moduleName }}</h4>
            @foreach ($modulePermissions as $item)
            <div class="permission-item">
                <span>{{ $item->description }}</span>
                <label class="switch">
                    <input type="checkbox"
                           class="permission-switch"
                           data-permission-id="{{ $item->id }}"
                           {{ !empty($item->selected) && $item->selected ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('frmRole');
    if (!form) {
        return;
    }

    form.addEventListener('submit', function () {
        const ids = [];
        document.querySelectorAll('.permission-switch:checked').forEach(function (el) {
            ids.push(parseInt(el.getAttribute('data-permission-id'), 10));
        });
        document.getElementById('permissions').value = JSON.stringify(ids);
    });
});
</script>
