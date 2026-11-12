// HEADER
// Headerens højde i en CSS-variabel: https://css-tricks.com/the-trick-to-viewport-units-on-mobile/

// Måler headeren og gemmer højden som en CSS-variabel (--header-height), så CSS kan bruge den til sektioner og sticky-elementers afstand.
// Kører igen ved resize, fordi headerens højde kan ændre sig med skærmbredden.
function setHeaderHeight() {
    const headerHeight = document.querySelector(".top").offsetHeight;
    document.documentElement.style.setProperty("--header-height", `${headerHeight}px`);
}

setHeaderHeight();
window.addEventListener("resize", setHeaderHeight);

// SIGTEKORN & HJØRNER
// matchMedia: https://developer.mozilla.org/en-US/docs/Web/API/Window/matchMedia
// mousemove event: https://developer.mozilla.org/en-US/docs/Web/API/Element/mousemove_event
// getBoundingClientRect: https://developer.mozilla.org/en-US/docs/Web/API/Element/getBoundingClientRect
// Sigtekorn og hjørner (Copilot-chat): https://copilot.cloud.microsoft/chat/share/eyJzaGFyZUlkIjoiOTZkYzdiYmEtMGVhYS00ZDFiLTg3OTgtYjg5MDYyZmM3MThmIiwiY29udmVyc2F0aW9uSWQiOiIxODJjZWM0Yi1jNDc4LTQwNzAtYTIzMi04YzA2NzU4NDMzM2MifQ%3D%3D

// Et sigtekorn, der følger musen. 
// Når det er over et link eller en knap, bliver der vist hjørner omkring elementet.
// Kun på enheder med mus.
const poster = document.querySelector(".poster")
const crosshair = document.querySelector(".crosshair")
const lock = document.querySelector(".lock")
const hasMouse = window.matchMedia("(pointer: fine)").matches

if (hasMouse) {
    document.documentElement.classList.add("has-crosshair")

    let currentTarget = null


    // Flytter sigtekornet til musen og tjekker, om musen er over noget interaktivt (link, knap eller submit-knap).
    // Hjørnerne flyttes kun, når musen kommer over et nyt element, ikke ved hver musebevægelse.
    window.addEventListener("mousemove", (e) => {
        crosshair.style.left = `${e.clientX}px`
        crosshair.style.top = `${e.clientY}px`

        const target = e.target.closest("a, button, input[type='submit']")

        if (target !== currentTarget) {
            currentTarget = target

            if (target) {
                showLockBrackets(target)
            } else {
                lock.classList.remove("is-visible")
            }
        }

        // Sigtekornet vises kun på posteren og interaktive elementer.
        const showCrosshair = target || e.target.closest(".poster")

        crosshair.classList.toggle("is-visible", !!showCrosshair)
    })

    // Placerer hjørnerne omkring et element, med lidt gap på alle sider.
    function showLockBrackets(element) {
        const rect = element.getBoundingClientRect();
        const gap = 6

        lock.style.left = `${rect.left - gap}px`
        lock.style.top = `${rect.top - gap}px`
        lock.style.width = `${rect.width + gap * 2}px`
        lock.style.height = `${rect.height + gap * 2}px`

        lock.classList.add("is-visible")
    }

    // Holder hjørnerne på elementet, når siden scroller, eller vinduet ændrer størrelse.
    function updateActiveTarget() {
        if (!currentTarget) return
        showLockBrackets(currentTarget)
    }

    window.addEventListener("scroll", updateActiveTarget)
    window.addEventListener("resize", updateActiveTarget)

    // CARDS
    // Transition end: https://developer.mozilla.org/en-US/docs/Web/API/Element/transitionend_event

    // Projekt cards bevæger sig ved hover.
    // Når animationen er færdig, placeres hjørnerne igen, så de passer til cardets nye position.
    document.addEventListener("transitionend", (e) => {
        if (e.target === currentTarget) {
            showLockBrackets(currentTarget)
        }
    })

    // Posteren har en lys baggrund, så sigtekornet og hjørnerne skifter til en mørk farve.
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

// POSTER BEVÆGELSE
// Elementer på posteren med data-depth attribute bevæger sig lidt når musen bevæger sig.
// Højere depth flytter sig længere, og negativ depth flytter den modsatte vej.
// Slået fra på touchskærme og for brugere, der foretrækker mindre bevægelse (reduced motion).
const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches

if (poster && !reduceMotion && hasMouse) {
    const layers = poster.querySelectorAll("[data-depth]")

    poster.addEventListener("mousemove", (e) => {
        // Musens position fra -0.5 til 0.5, hvor 0 er midten af skærmen.
        const x = e.clientX / window.innerWidth - 0.5
        const y = e.clientY / window.innerHeight - 0.5

        layers.forEach((layer) => {
            const distance = layer.dataset.depth * 16
            const move = `translate(${x * distance}px, ${y * distance}px)`

            // Plus-tegnene roterer også.
            layer.style.transform = layer.classList.contains("plus") ? `${move} rotate(${x * 90}deg)` : move
        })
    })

    // Alt går tilbage på plads, når musen forlader posteren.
    poster.addEventListener("mouseleave", () => {
        layers.forEach((layer) => {
            layer.style.transform = ""
        })
    })
}

// SCROLL HINT
// Pilene nederst på posteren vises kun, når hele posteren er synlig, og forsvinder, når man begynder at scrolle.
const scrollHint = document.querySelector(".scroll-hint")

if (scrollHint) {
    const hintObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            scrollHint.classList.toggle("is-visible", entry.intersectionRatio >= 0.95)
        })
    }, { threshold: 0.95 })

    hintObserver.observe(poster)
}

// CASE STUDY: LOKAL NAVIGATION
// Fremhæver det kapitel, man er nået til, i den lokale navigation.
// Kapitler før det kapitel man er nået til, bliver markeret som "is-past".
const chapterLinks = document.querySelectorAll(".chapter-list a")
const caseSections = document.querySelectorAll(".case-section")
const chapterList = document.querySelector(".chapter-list")
let lastChapter = null

function highlightChapter() {
    // Tjekker om man har scrollet helt i bund, så det sidste kapitel kan blive aktivt, selvom det er for kort til at nå 40 %-linjen.
    const atBottom = window.innerHeight + window.scrollY >= document.body.scrollHeight - 4
    let current = null

    // Tjekker for hvert kapitel, om toppen er scrollet over 40 % ned på skærmen, og sætter det seneste af dem som det aktive kapitel.
    caseSections.forEach((section) => {
        if (section.getBoundingClientRect().top < window.innerHeight * 0.4) {
            current = section
        }
    })

    // I bunden af siden er det sidste kapitel aktivt, også selvom det er kort.
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

    // På telefonen scroller kapitelbaren sidelæns.
    // Når kapitlet skifter, scroller baren, så det aktuelle kapitel er synligt.
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

// VIS VED SCROLL
// Kill-feedet og procestidslinjen animeres en gang, når 30% af dem er synlige.
// Derefter holdes der ikke længere øje med dem (unobserve)
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
// Et klik på en fane gør den aktiv og viser panelet med samme index.
// Alle andre paneler bliver skjult.
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
// Hver filterknap har en data-filter (all, frontend, ux/ui, visual design).
// Kort, hvis data-disciplines indeholder det samme ord som den aktive filterknap, bliver vist, og resten bliver skjult. "all" viser alle kort.
// Tælleren viser, hvor mange kort der er synlige, og en besked vises, hvis ingen er synlige.
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

// BILLEDE LIGHTBOX
// Billeder i cases åbner en <dialog> i fuld skærm.
// Billedet i fuld størrelse kommer fra data-full, og alt-teksten kopieres fra det lille billede.
// Et klik på billedet zoomer ind og ud.
// Siden bagved kan ikke scrolle, mens den er åben.
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

    // Et klik på baggrunden lukker billedet igen.
    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.close()
        }
    })

    // Zoomer ind eller ud og scroller til midten, så det zoomede billede forbliver centreret.
    lightboxImage.addEventListener("click", () => {
        lightbox.classList.toggle("is-zoomed")

        lightbox.scrollLeft = (lightbox.scrollWidth - lightbox.clientWidth) / 2
        lightbox.scrollTop = (lightbox.scrollHeight - lightbox.clientHeight) / 2
    })

    // Kører lige meget hvordan billedet bliver lukket igen (knap, escape eller ved click på baggrunden).
    // Nulstiller zoom og lader siden scrolle igen.
    lightbox.addEventListener("close", () => {
        lightbox.classList.remove("is-zoomed")
        document.body.classList.remove("is-locked")
    })
}

// KONTAKT: KOPIER EMAIL
// Clipboard writeText: https://developer.mozilla.org/en-US/docs/Web/API/Clipboard/writeText

// Kopierer email adressen fra data-email til udklipsholderen og viser en statusbesked.
// Udklipsholderen virker kun på secure servere (https), så catch viser en reservebesked, hvis det fejler.
// Beskeden forsvinder efter 3 sekunder med setTimeout. 
// clearTimeout stopper den gamle timer, så den starter forfra ved et nyt klik.
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
// Bygger tidslinjen fra milestones.json, så nye milepæle kun skal tilføjes et sted.
// Bruges på About siden (alle milepæle) og forsiden (data-show="home", kun dem med home": true).
// Status giver punktet en klasse (is-current, is-upcoming, is-goal), plus et "NOW"-mærke på den nuværende milepæl og et flag på målet.
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