// HEADER
// https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
function setHeaderHeight() {
    const headerHeight = document.querySelector(".top").offsetHeight;
    document.documentElement.style.setProperty("--header-height", `${headerHeight}px`);
}

setHeaderHeight();
window.addEventListener("resize", setHeaderHeight);

// CROSSHAIR & CORNERS
// https://developer.mozilla.org/en-US/docs/Web/API/Element/mousemove_event
// https://developer.mozilla.org/en-US/docs/Web/API/Element/getBoundingClientRect
// https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
// https://developer.mozilla.org/en-US/docs/Web/API/Window/matchMedia
if (window.matchMedia("(pointer: fine)").matches) {
    document.documentElement.classList.add("has-crosshair")

    const crosshair = document.querySelector(".crosshair")
    const lock = document.querySelector(".lock")

    function hideCrosshair() {
        crosshair.classList.remove("is-visible")
        lock.classList.remove("is-visible")
    }

    document.addEventListener("mousemove", (e) => {
        crosshair.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`

        const target = e.target.closest("a, button")
        const onPaper = e.target.closest(".poster")

        if (onPaper) {
            crosshair.classList.add("on-paper")
            lock.classList.add("on-paper")
        } else {
            crosshair.classList.remove("on-paper")
            lock.classList.remove("on-paper")
        }

        if (target) {
            const box = target.getBoundingClientRect()
            lock.style.transform = `translate(${box.left - 6}px, ${box.top - 6}px)`
            lock.style.width = `${box.width + 12}px`
            lock.style.height = `${box.height + 12}px`
            lock.classList.add("is-visible")
        } else {
            lock.classList.remove("is-visible")
        }

        if (target || onPaper) {
            crosshair.classList.add("is-visible")
        } else {
            crosshair.classList.remove("is-visible")
        }
    })

    document.addEventListener("mouseleave", hideCrosshair)
    window.addEventListener("scroll", hideCrosshair)
}

// POSTER MOTION
const poster = document.querySelector(".poster")
const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches

if (poster && !reduceMotion && window.matchMedia("(pointer: fine)").matches) {
    const layers = poster.querySelectorAll("[data-depth]")

    poster.addEventListener("mousemove", (e) => {
        const box = poster.getBoundingClientRect()
        const x = (e.clientX - box.left) / box.width - 0.5
        const y = (e.clientY - box.top) / box.height - 0.5

        layers.forEach((layer) => {
            const distance = layer.dataset.depth * 14

            if (layer.classList.contains("plus")) {
                layer.style.transform = `translate(${x * distance}px, ${y * distance}px) rotate(${x * 90}deg)`
            } else {
                layer.style.transform = `translate(${x * distance}px, ${y * distance}px)`
            }
        })
    })

    poster.addEventListener("mouseleave", () => {
        layers.forEach((layer) => {
            layer.style.transform = ""
        })
    })
}
