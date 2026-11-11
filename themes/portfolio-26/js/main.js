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

        const target = e.target.closest("a, button, input[type='submit']")

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

    window.addEventListener("scroll", updateActiveTarget)
    window.addEventListener("resize", updateActiveTarget)

    // CARDS
    // https://developer.mozilla.org/en-US/docs/Web/API/Element/transitionend_event
    document.addEventListener("transitionend", (e) => {
        if (e.target === currentTarget) {
            showLockBrackets(currentTarget)
        }
    })

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

// SCROLL HINT
const scrollHint = document.querySelector(".scroll-hint")

if (scrollHint) {
    const hintObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            scrollHint.classList.toggle("is-visible", entry.intersectionRatio >= 0.95)
        })
    }, { threshold: 0.95 })

    hintObserver.observe(poster)
}

// CASE STUDY: CHAPTER NAV
const chapterLinks = document.querySelectorAll(".chapter-list a")
const caseSections = document.querySelectorAll(".case-section")
const chapterList = document.querySelector(".chapter-list")
let lastChapter = null

function highlightChapter() {
    const atBottom = window.innerHeight + window.scrollY >= document.body.scrollHeight - 4
    let current = null

    caseSections.forEach((section) => {
        if (section.getBoundingClientRect().top < window.innerHeight * 0.4) {
            current = section
        }
    })

    if (atBottom) {
        current = caseSections[caseSections.length - 1]
    }

    let beforeCurrent = current !== null

    chapterLinks.forEach((link) => {
        const isCurrent = current !== null && link.getAttribute("href") === `#${current.id}`

        if (isCurrent) {
            beforeCurrent = false
        }

        link.classList.toggle("is-current", isCurrent)
        link.classList.toggle("is-past", beforeCurrent)
    })

    if (current !== null && current !== lastChapter) {
        const currentLink = chapterList.querySelector(".is-current")
        chapterList.scrollTo({ left: currentLink.parentElement.offsetLeft - chapterList.offsetLeft, behavior: "smooth" })
        lastChapter = current
    }
}

if (caseSections.length) {
    highlightChapter()
    window.addEventListener("scroll", highlightChapter)
}

// REVEAL ON SCROLL
const revealElements = document.querySelectorAll(".feed, .timeline")

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.intersectionRatio >= 0.3) {
            entry.target.classList.add("is-visible")
            revealObserver.unobserve(entry.target)
        }
    })
}, { threshold: 0.3 })

revealElements.forEach((element) => revealObserver.observe(element))

// SKILLS: TABS
const skillTabs = document.querySelectorAll(".skill-tab")
const skillPanels = document.querySelectorAll(".skill-panel")

skillTabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        skillTabs.forEach((otherTab, i) => {
            otherTab.classList.toggle("is-active", i === index)
        })

        skillPanels.forEach((panel, i) => {
            panel.hidden = i !== index
        })
    })
})

// WORK PAGE: FILTERS
const filterButtons = document.querySelectorAll(".filter")
const projectCards = document.querySelectorAll(".project-grid .project-card")
const projectCount = document.querySelector(".project-count")
const filterEmpty = document.querySelector(".filter-empty")

filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const filter = button.dataset.filter
        let visible = 0

        filterButtons.forEach((otherButton) => {
            otherButton.classList.toggle("is-active", otherButton === button)
        })

        projectCards.forEach((card) => {
            const matches = filter === "all" || card.dataset.disciplines.toLowerCase().includes(filter)
            card.hidden = !matches

            if (matches) visible++
        })

        projectCount.textContent = visible
        filterEmpty.hidden = visible > 0
    })
})

// IMAGE LIGHTBOX
const lightbox = document.querySelector(".lightbox")
const zoomButtons = document.querySelectorAll(".zoom")

if (lightbox) {
    const lightboxImage = lightbox.querySelector(".lightbox-image")
    const lightboxClose = lightbox.querySelector(".lightbox-close")

    zoomButtons.forEach((button) => {
        button.addEventListener("click", () => {
            lightboxImage.src = button.dataset.full
            lightboxImage.alt = button.querySelector("img").alt
            lightbox.showModal()

            document.body.classList.add("is-locked")
        })
    })

    lightboxClose.addEventListener("click", () => {
        lightbox.close()
    })

    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.close()
        }
    })

    lightboxImage.addEventListener("click", () => {
        lightbox.classList.toggle("is-zoomed")

        lightbox.scrollLeft = (lightbox.scrollWidth - lightbox.clientWidth) / 2
        lightbox.scrollTop = (lightbox.scrollHeight - lightbox.clientHeight) / 2
    })

    lightbox.addEventListener("close", () => {
        lightbox.classList.remove("is-zoomed")
        document.body.classList.remove("is-locked")
    })
}

// CONTACT: COPY EMAIL
// https://developer.mozilla.org/en-US/docs/Web/API/Clipboard/writeText
const copyButton = document.querySelector(".copy-btn")
const copyStatus = document.querySelector(".copy-status")
let copyTimer = null

async function copyEmail() {
    try {
        await navigator.clipboard.writeText(copyButton.dataset.email)
        copyStatus.textContent = "Copied to clipboard"
    } catch (error) {
        console.error(error.message)
        copyStatus.textContent = "Couldn't copy. Select the address instead."
    }

    clearTimeout(copyTimer)
    copyTimer = setTimeout(() => {
        copyStatus.textContent = ""
    }, 3000)
}

if (copyButton) {
    copyButton.addEventListener("click", copyEmail)
}

// MILESTONES
const milestonesList = document.querySelectorAll(".milestones[data-src]")

milestonesList.forEach((list) => {
    const onlyHome = list.dataset.show === "home"

    fetch(list.dataset.src)
        .then((res) => res.json())
        .then((milestones) => {
            milestones.forEach((milestone) => {
                if (onlyHome && !milestone.home) {
                    return
                }

                const item = document.createElement("li")

                if (milestone.status) {
                    item.classList.add(`is-${milestone.status}`)
                }

                let extra = ""
                if (milestone.status === "current") {
                    extra = ` <b class="milestone-now mono">Now</b>`
                }
                if (milestone.status === "goal") {
                    extra = ` <i class="fa-solid fa-flag"></i>`
                }

                item.innerHTML = `<span class="milestone-year mono">${milestone.year}</span><span>${milestone.text}${extra}</span>`
                list.appendChild(item)
            })
        })
        .catch((err) => {
            console.log(err.message)
        })
})