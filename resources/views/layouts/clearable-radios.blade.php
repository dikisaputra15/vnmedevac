<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkedRadios = new WeakSet();

    function syncRadios() {
        document.querySelectorAll('input[type="radio"]').forEach(function (radio) {
            if (radio.checked) {
                checkedRadios.add(radio);
            } else {
                checkedRadios.delete(radio);
            }
        });
    }

    syncRadios();

    document.addEventListener('click', function (event) {
        const radio = event.target;
        if (!radio.matches('input[type="radio"]') || radio.disabled) {
            return;
        }

        if (checkedRadios.has(radio)) {
            radio.checked = false;
            radio.dispatchEvent(new Event('input', { bubbles: true }));
            radio.dispatchEvent(new Event('change', { bubbles: true }));
        }

        syncRadios();
    }, true);

    document.addEventListener('change', syncRadios);
    document.addEventListener('reset', function () {
        setTimeout(syncRadios, 0);
    });
});
</script>
