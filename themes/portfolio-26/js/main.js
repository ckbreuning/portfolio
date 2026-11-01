// HEADER
// https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
function setHeaderHeight() {
    const headerHeight = document.querySelector(".top").offsetHeight;
    document.documentElement.style.setProperty("--header-height", `${headerHeight}px`);
}

setHeaderHeight();
window.addEventListener("resize", setHeaderHeight);

// CROSSHAIR & CORNERS
// https://developer.mozilla.org/en-US/docs/Web/API/Window/matchMedia
// https://developer.mozilla.org/en-US/docs/Web/API/Element/getBoundingClientRect
// https://developer.mozilla.org/en-US/docs/Web/API/Element/mousemove_event
// https://copilot.cloud.microsoft/chat/share/eyJzaGFyZUlkIjoiOTZkYzdiYmEtMGVhYS00ZDFiLTg3OTgtYjg5MDYyZmM3MThmIiwiY29udmVyc2F0aW9uSWQiOiIxODJjZWM0Yi1jNDc4LTQwNzAtYTIzMi04YzA2NzU4NDMzM2MifQ%3D%3D
const poster = document.querySelector(".poster")
const crosshair = document.querySelector(".crosshair")
const lock = document.querySelector(".lock")
const hasMouse = window.matchMedia("(pointer: fine)").matches

if (hasMouse) {
    document.documentElement.classList.add("has-crosshair")

    let currentTarget = null

    window.addEventListener("mousemove", (e) => {
        const clientX = e.clientX
        const clientY = e.clientY

        crosshair.style.left = `${clientX}px`
        crosshair.style.top = `${clientY}px`

        const target = e.target.closest("a, button")

        if (target !== currentTarget) {
            currentTarget = target

            if (target) {
                showLockBrackets(target)
            } else {
                lock.classList.remove("is-visible")
            }
        }

        const showCrosshair = target || e.target.closest(".poster")

        crosshair.classList.toggle("is-visible", !!showCrosshair)
    })

    function showLockBrackets(element) {
        const rect = element.getBoundingClientRect();
        const gap = 6

        lock.style.left = `${rect.left - gap}px`
        lock.style.top = `${rect.top - gap}px`
        lock.style.width = `${rect.width + gap * 2}px`
        lock.style.height = `${rect.height + gap * 2}px`

        lock.classList.add("is-visible")
    }

    function updateActiveTarget() {
        if (!currentTarget) return
        showLockBrackets(currentTarget)
    }

    window.addEventListener("scroll", updateActiveTarget, { passive: true })
    window.addEventListener("resize", updateActiveTarget)

    if (poster) {
        poster.addEventListener("mouseenter", () => {
            crosshair.classList.add("on-paper")
            lock.classList.add("on-paper")
        })

        poster.addEventListener("mouseleave", () => {
            crosshair.classList.remove("on-paper")
            lock.classList.remove("on-paper")
        })
    }
}

// POSTER MOTION
const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches

if (poster && !reduceMotion && hasMouse) {
    const layers = poster.querySelectorAll("[data-depth]")

    poster.addEventListener("mousemove", (e) => {
        const x = e.clientX / window.innerWidth - 0.5
        const y = e.clientY / window.innerHeight - 0.5

        layers.forEach((layer) => {
            const distance = layer.dataset.depth * 14
            const move = `translate(${x * distance}px, ${y * distance}px)`

            layer.style.transform = layer.classList.contains("plus") ? `${move} rotate(${x * 90}deg)` : move
        })
    })

    poster.addEventListener("mouseleave", () => {
        layers.forEach((layer) => {
            layer.style.transform = ""
        })
    })
}

// INTRO KILLFEED
const feed = document.querySelector(".feed")

if (feed) {
    const feedObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.intersectionRatio >= 0.5) {
                entry.target.classList.add("is-visible")
                feedObserver.unobserve(entry.target)
            }
        })
    }, { threshold: 0.5 })

    feedObserver.observe(feed)
}