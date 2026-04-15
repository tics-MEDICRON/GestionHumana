document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".menu > ol > .menu-item");

  items.forEach((item) => {
    const toggle = item.querySelector(":scope > a");
    const submenu = item.querySelector(":scope > .sub-menu");

    if (!toggle || !submenu) {
      return;
    }

    if (!submenu.children.length) {
      item.classList.add("is-empty");
      return;
    }

    item.classList.add("is-collapsible");
    toggle.setAttribute("aria-expanded", "false");

    toggle.addEventListener("click", (event) => {
      if (toggle.getAttribute("href") !== "#0") {
        return;
      }

      event.preventDefault();
      const isOpen = item.classList.contains("is-open");

      items.forEach((otherItem) => {
        otherItem.classList.remove("is-open");

        const otherToggle = otherItem.querySelector(":scope > a");
        if (otherToggle) {
          otherToggle.setAttribute("aria-expanded", "false");
        }
      });

      if (!isOpen) {
        item.classList.add("is-open");
        toggle.setAttribute("aria-expanded", "true");
      }
    });
  });
});
