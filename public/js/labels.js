const bookingStatus = document.querySelectorAll(".select-option");

bookingStatus.forEach(el => {
    el.addEventListener("input", (ev) => {
        el.dataset.labeltype = ev.target.value;
    })
})
