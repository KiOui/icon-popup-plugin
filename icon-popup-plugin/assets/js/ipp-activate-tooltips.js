[].slice.call(document.querySelectorAll('.ipp-badge[data-bs-toggle="tooltip"]')).map(function (tooltipTriggerEl) {
    console.log(tooltipTriggerEl);
    return new bootstrap.Tooltip(tooltipTriggerEl)
});