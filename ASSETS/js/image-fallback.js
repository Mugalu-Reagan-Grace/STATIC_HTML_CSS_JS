window.addEventListener(
  "error",
  (event) => {
    const image = event.target;
    if (!(image instanceof HTMLImageElement) || image.dataset.fallbackApplied) {
      return;
    }

    image.dataset.fallbackApplied = "true";
    image.classList.add("image-placeholder");
    image.src = "./ASSETS/images/photo-placeholder.svg";
  },
  true
);
