document.addEventListener("DOMContentLoaded", function () {
    const taskItems = document.querySelectorAll(".task-item");
    taskItems.forEach((item, index) => {
        const delay = item.getAttribute("data-delay");
        if (delay) {
            item.style.animationDelay = delay + "s";
        }
    });
});
